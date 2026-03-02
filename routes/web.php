<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\StaffController;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/mail', function () {
    Mail::raw('MailHog test', fn($m) => $m->to('test@test.com')->subject('Test'));
});

// ------------- public application endpoints --------------------------------------
Route::post('/check-eligibility', [ApplicationController::class, 'checkEligibility'])
    ->name('application.check-eligibility');
Route::get('/check-eligibility', function () {
    return redirect('/');
});
Route::post('/apply', [ApplicationController::class, 'store'])
    ->name('application.store');
Route::get('/apply', function () {
    return redirect('/');
});
Route::post('/preview-application', [ApplicationController::class, 'preview'])
    ->name('application.preview');
Route::get('/preview-application', function () {
    return redirect('/');
});
Route::get('/check-candidate', [ApplicationController::class, 'showCheckCandidateForm'])
    ->name('candidate.check.form');
Route::post('/check-candidate', [ApplicationController::class, 'checkCandidateStatus'])
    ->name('candidate.check');

// ------------- admin auth & pages ------------------------------------------------
// Admin login/logout handled by a bespoke controller; protects the dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    // routes that require a logged-in admin/staff (session flag checked by admin.auth alias)
    Route::middleware(['auth', 'admin.auth'])->group(function () {
        // Admin only dashboard
        Route::middleware('role:admin')->group(function () {
            Route::get('dashboard', [ApplicationController::class, 'dashboard'])
                ->name('dashboard');
        });

        $applicationRoutes = function () {
            Route::get('applications', [ApplicationController::class, 'adminIndex'])
                ->name('applications.index');
            Route::get('applications/{application}', [ApplicationController::class, 'adminShow'])
                ->name('applications.show');
            Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])
                ->name('applications.update-status');
        };

        // Admin Only Routes
        Route::middleware('role:admin')->group(function () use ($applicationRoutes) {
            // entry point / dashboard -- render dashboard with stats
            Route::get('dashboard', [ApplicationController::class, 'dashboard'])
                ->name('dashboard');

            // applications resource-like endpoints used by the admin UI
            $applicationRoutes();

            // ── Staff Management (Admin Only) ──────────────────────
            Route::prefix('staff')->name('staff.')->group(function () {
                Route::get('/', [StaffController::class, 'index'])->name('index');
                Route::get('/create', [StaffController::class, 'create'])->name('create');
                Route::post('/', [StaffController::class, 'store'])->name('store');
                Route::patch('/{user}/toggle-status', [StaffController::class, 'toggleStatus'])->name('toggle-status');
                Route::post('/{user}/resend-invite', [StaffController::class, 'resendInvite'])->name('resend-invite');
            });
        });

        // Logout applies to both authenticated dashboard users
        Route::post('logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
});

// Staff (User) Application Routes
Route::middleware(['auth', 'admin.auth', 'role:staff'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('applications', [ApplicationController::class, 'adminIndex'])
            ->name('applications.index');
        Route::get('applications/{application}', [ApplicationController::class, 'adminShow'])
            ->name('applications.show');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])
            ->name('applications.update-status');
    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------- One-time utility: seed old candidates from CSV ------------------
Route::get('upload/candidate/data', function () {
    // Allow this script to run as long as needed and use enough memory for a large CSV
    set_time_limit(0);
    ini_set('memory_limit', '256M');
    // The CSV uses bare \r (old Mac) line endings — this makes fgetcsv recognise them
    ini_set('auto_detect_line_endings', true);

    $csvPath = public_path('CandidateData.csv');

    if (! file_exists($csvPath)) {
        return response()->json(['error' => 'CSV file not found at: ' . $csvPath], 404);
    }

    $handle = fopen($csvPath, 'r');

    if ($handle === false) {
        return response()->json(['error' => 'Failed to open CSV file.'], 500);
    }

    $chunkSize = 500; // rows per batch INSERT — sweet spot for memory vs speed
    $chunk     = [];
    $inserted  = 0;
    $skipped   = 0;
    $rowNumber = 0;
    $now       = now()->toDateTimeString();

    // The CSV is Windows-1252 (Latin-1) encoded — convert each value to clean UTF-8
    // mb_convert_encoding handles the conversion; iconv //IGNORE strips any bytes
    // that still can't be represented, so MySQL never sees an invalid sequence.
    $toUtf8 = function (string $value): string {
        $converted = mb_convert_encoding($value, 'UTF-8', 'Windows-1252');
        // Strip any residual invalid UTF-8 bytes as a safety net
        return iconv('UTF-8', 'UTF-8//IGNORE', $converted);
    };

    while (($row = fgetcsv($handle)) !== false) {
        $rowNumber++;

        // Skip the header row
        if ($rowNumber === 1) {
            continue;
        }

        // Guard against malformed rows
        if (count($row) < 2) {
            $skipped++;
            continue;
        }

        $candidateId = trim($toUtf8($row[0]));
        $fullName    = trim($toUtf8($row[1]));

        // Skip blank rows
        if ($candidateId === '' && $fullName === '') {
            $skipped++;
            continue;
        }

        $chunk[] = [
            'candidate_id' => $candidateId,
            'name'         => $fullName,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // Once the chunk is full, flush it to the DB in a single query
        if (count($chunk) === $chunkSize) {
            \Illuminate\Support\Facades\DB::table('old_candidates')->upsert(
                $chunk,
                ['candidate_id'],   // unique key to match on
                ['name', 'updated_at'] // columns to update if the row already exists
            );
            $inserted += count($chunk);
            $chunk = [];
        }
    }

    fclose($handle);

    // Flush any remaining rows that didn't fill the last chunk
    if (! empty($chunk)) {
        \Illuminate\Support\Facades\DB::table('old_candidates')->upsert(
            $chunk,
            ['candidate_id'],
            ['name', 'updated_at']
        );
        $inserted += count($chunk);
    }

    return response()->json([
        'message'  => 'CSV import complete.',
        'inserted' => $inserted,
        'skipped'  => $skipped,
    ]);
});

require __DIR__ . '/auth.php';
