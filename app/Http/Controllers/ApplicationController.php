<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckEligibilityRequest;
use App\Http\Requests\StoreApplicationRequest;
use App\Mail\ApplicationReceived;
use App\Mail\ApplicationRejected;
use App\Models\Application;
use App\Models\OldCandidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicationController extends Controller
{
    // ─────────────────────────────────────────────
    // PUBLIC ENDPOINTS
    // ─────────────────────────────────────────────

    /**
     * Step 1 – AJAX eligibility / duplicate check.
     */
    public function checkEligibility(CheckEligibilityRequest $request): JsonResponse
    {
        $type = $request->validated()['candidateType'];

        // ── Old candidate: verify candidateId exists ────────────
        if ($type === 'old') {
            $existing = OldCandidate::where('candidate_id', $request->candidateId)
                ->first();

            if (!$existing) {
                return response()->json([
                    'status' => 'error',
                    'errors' => ['candidateId' => ['We could not find an old candidate matching this ID. Please double check the ID and try again.']],
                ], 422);
            }

            // Passport must match
            // if ($existing->passportNumber !== $request->passportNumber) {
            //     return response()->json([
            //         'status' => 'error',
            //         'errors' => ['passportNumber' => ['Passport number does not match the candidate record.']],
            //     ], 422);
            // }

            return response()->json([
                'status' => 'success',
                'message' => 'Candidate verified. Please proceed to complete your application.',
                'data' => [
                    'usualForename' => $existing->usualForename,
                    'lastName' => $existing->lastName,
                    'email' => $existing->email,
                ],
            ]);
        }

        // ── New candidate: duplicate check ──────────────────────
        $emailExists = Application::where('email', $request->email)->exists();
        $passportExists = Application::where('passportNumber', $request->passportNumber)->exists();

        if ($emailExists || $passportExists) {
            $errors = [];
            if ($emailExists) {
                $errors['email'] = ['The email address you entered is already associated with an existing application. Please check your email for status updates, or use a different email address if this is a mistake.'];
            }
            if ($passportExists) {
                $errors['passportNumber'] = ['The passport number you entered is already registered in our system. Only one application per passport is permitted. Please verify your passport details and try again.'];
            }

            return response()->json([
                'status' => 'duplicate',
                'message' => 'We detected that you may have already submitted an application.',
                'errors' => $errors,
            ], 409);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Eligibility Confirmed! You can proceed to complete your application.',
        ]);
    }

    /**
     * Step 2 – Final form submission with files.
     */
    public function store(StoreApplicationRequest $request): JsonResponse
    {
        // Additional race-condition duplicate check before insert
        $existingQuery = Application::where('passportNumber', $request->passportNumber);
        if ($request->candidateType === 'new') {
            $existingQuery->orWhere('email', $request->email);
        }
        if ($existingQuery->exists()) {
            return response()->json([
                'status' => 'duplicate',
                'message' => 'It looks like this application has already been submitted. We have stopped this request to prevent duplicate entries.',
            ], 409);
        }

        $data = $request->except([
            '_token',
            'duplicateDisclaimer',
            'passportImage',
            'passport_bio_page',
            'valid_license',
            'mbbs_degree',
            'training_certificate',
            'internship_certificates',
            'experience_certificates',
            'signatureUpload',
        ]);

        DB::beginTransaction();

        try {
            // ── File uploads ────────────────────────────────
            if ($request->hasFile('passportImage')) {
                $data['passportImagePath'] = $request->file('passportImage')->store('documents/passports', 'public');
            }

            if ($request->hasFile('passport_bio_page')) {
                $data['bioDataPagePath'] = $request->file('passport_bio_page')->store('documents/biodata', 'public');
            }

            if ($request->hasFile('valid_license')) {
                $data['validLicensePagePath'] = $request->file('valid_license')->store('documents/licenses', 'public');
            }

            // ── Signature ───────────────────────────────────
            if ($request->hasFile('signatureUpload')) {
                $data['signature'] = $request->file('signatureUpload')->store('documents/signatures', 'public');
            } elseif ($request->filled('signature')) {
                $data['signature'] = $request->signature; // base64
            }

            // ── Experience certificates ─────────────────────
            if ($request->hasFile('experience_certificates')) {
                $paths = [];
                foreach ($request->file('experience_certificates') as $file) {
                    $paths[] = $file->store('documents/experience', 'public');
                }
                $data['experienceCertificatePath'] = json_encode($paths);
            }

            // ── Other documents (MBBS, training, internship)─
            $otherDocs = [];
            if ($request->hasFile('mbbs_degree')) {
                $otherDocs['mbbs_degree'] = $request->file('mbbs_degree')->store('documents/mbbs', 'public');
            }
            if ($request->hasFile('training_certificate')) {
                $otherDocs['training_certificate'] = $request->file('training_certificate')->store('documents/training', 'public');
            }
            if ($request->hasFile('internship_certificates')) {
                $internPaths = [];
                foreach ($request->file('internship_certificates') as $file) {
                    $internPaths[] = $file->store('documents/internship', 'public');
                }
                $otherDocs['internship_certificates'] = $internPaths;
            }
            if (!empty($otherDocs)) {
                $data['otherDocumentsPaths'] = json_encode($otherDocs);
            }

            $data['termsAccepted'] = $request->has('termsAccepted');
            $data['status'] = 'pending';

            // Build fullName — form sends 'fullNameOnRecord', stored as 'fullName'
            $data['fullName'] = $request->filled('fullNameOnRecord')
                ? $request->fullNameOnRecord
                : trim(($request->usualForename ?? '') . ' ' . ($request->lastName ?? ''));

            // Remove the form field alias to avoid mass-assignment confusion
            unset($data['fullNameOnRecord']);

            // Provide a default for eligibilityCriterion if left blank (for old candidates)
            if ($request->candidateType === 'old' && empty($data['eligibilityCriterion'])) {
                $data['eligibilityCriterion'] = 'N/A';
            }

            // dd($request->all());

            $application = Application::create($data);

            DB::commit();

            // ── Send confirmation email to candidate ─────────
            if ($application->email) {
                try {
                    Mail::to($application->email)
                        ->queue(new ApplicationReceived($application));
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send ApplicationReceived email', [
                        'application_id' => $application->id,
                        'error' => $mailEx->getMessage(),
                    ]);
                }
            }

            return response()->json([
                'status' => 'success',
                'redirect' => '/',
                'message' => 'Application submitted successfully! You will receive a confirmation email shortly.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Application store failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'We experienced a temporary issue while processing your application. No data was saved. Please wait a moment and try submitting again. If the issue persists, contact our support team.',
            ], 500);
        }
    }

    /**
     * Preview application as PDF.
     */
    public function preview(Request $request)
    {
        $data = $request->all();
        
        // Handle full name logic similar to store
        if (empty($data['fullNameOnRecord'])) {
            $data['fullNameOnRecord'] = trim(($data['usualForename'] ?? '') . ' ' . ($data['lastName'] ?? ''));
        }

        // Map preview_files from JSON strings to arrays/objects
        if (isset($data['preview_files'])) {
            foreach ($data['preview_files'] as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        $data['preview_files'][$key][$subKey] = json_decode($subValue);
                    }
                } else {
                    $data['preview_files'][$key] = json_decode($value);
                }
            }
        }

        $pdf = Pdf::loadView('pdf.application', $data);
        
        return $pdf->stream('application-preview.pdf');
    }

    // ─────────────────────────────────────────────
    // ADMIN ENDPOINTS  (used from Project-Management-System)
    // ─────────────────────────────────────────────

    /**
     * Admin – list applications with search, filter, stats.
     */
    public function adminIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $type = $request->input('type');

        $query = Application::query()
            ->search($search)
            ->when($status, fn($q, $s) => $q->where('status', $s))
            ->when($type, fn($q, $t) => $q->where('candidateType', $t))
            ->latest();

        // Stats
        $stats = [
            'total' => Application::count(),
            'pending' => Application::pending()->count(),
            'approved' => Application::approved()->count(),
            'rejected' => Application::rejected()->count(),
        ];

        // Charts – registrations over last 30 days
        $timeChartData = Application::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Status chart
        $statusChartData = [
            'labels' => ['Pending', 'Approved', 'Rejected'],
            'series' => [
                Application::pending()->count(),
                Application::approved()->count(),
                Application::rejected()->count(),
            ],
            'colors' => ['#f59e0b', '#10b981', '#ef4444'],
        ];

        $applications = $query->paginate(15)->withQueryString();

        return view('admin.applications.index', compact(
            'applications',
            'stats',
            'search',
            'status',
            'type',
            'timeChartData',
            'statusChartData'
        ));
    }

    /**
     * Admin – show single application.
     */
    public function adminShow(Application $application)
    {
        return view('admin.applications.show', compact('application'));
    }

    /**
     * Admin – update application status (approve/reject).
     */
    public function updateStatus(Request $request, Application $application): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'rejection_reason' => 'nullable|string|max:2000',
            'send_email' => 'nullable',
        ], [
            'status.required' => 'Please select a status (Approved, Rejected, or Pending) before saving.',
            'status.in' => 'The selected status is not valid. Please choose Approved, Rejected, or Pending.',
            'rejection_reason.max' => 'The rejection reason is too long. Please keep it under 2000 characters.',
        ]);

        $updateData = ['status' => $request->status];

        if ($request->status === 'rejected') {
            // Store rejection reason (optional)
            $updateData['rejection_reason'] = $request->rejection_reason;
        } else {
            // Clear rejection reason when approving or resetting to pending
            $updateData['rejection_reason'] = null;
        }

        $application->update($updateData);

        // Only send email on rejection AND only when the send_email toggle is on
        if ($request->status === 'rejected' && $request->has('send_email') && $application->email) {
            try {
                Mail::to($application->email)
                    ->queue(new ApplicationRejected($application));
            } catch (\Exception $e) {
                Log::error('Failed to send rejection email', [
                    'application_id' => $application->id,
                    'error' => $e->getMessage(),
                ]);

                return redirect()
                    ->route('admin.applications.show', $application)
                    ->with('warning', 'Application rejected but the notification email could not be sent.');
            }
        }

        $statusLabel = ucfirst($request->status);
        $emailNote = '';
        if ($request->status === 'rejected' && $request->has('send_email')) {
            $emailNote = ' A notification email has been sent to the candidate.';
        }

        return redirect()
            ->route('admin.applications.show', $application)
            ->with('success', "Application {$statusLabel} successfully.{$emailNote}");
    }
}
