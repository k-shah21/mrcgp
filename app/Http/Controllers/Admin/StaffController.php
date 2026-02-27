<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    /**
     * List all staff users.
     */
    public function index()
    {
        $staffUsers = User::where('role', 'staff')
            ->withCount(['handledApplications as approved_count' => function ($q) {
                $q->where('handled_action', 'approved');
            }, 'handledApplications as rejected_count' => function ($q) {
                $q->where('handled_action', 'rejected');
            }])
            ->latest()
            ->paginate(15);

        return view('admin.staff.index', compact('staffUsers'));
    }

    /**
     * Show the create staff form.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a new staff user and send password setup email.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
        ], [
            'name.required'  => 'Please provide the staff member\'s name.',
            'email.required' => 'Please provide the staff member\'s email address.',
            'email.unique'   => 'A user with this email already exists.',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make(Str::random(32)), // Temporary random password
            'role'      => 'staff',
            'is_active' => true,
        ]);

        // Send password reset/setup link
        try {
            $status = Password::sendResetLink(['email' => $user->email]);

            if ($status === Password::RESET_LINK_SENT) {
                Log::info('Staff invitation sent', ['email' => $user->email, 'by' => auth()->user()->email]);
            } else {
                Log::warning('Failed to send staff invitation', ['email' => $user->email, 'status' => $status]);
            }
        } catch (\Exception $e) {
            Log::error('Staff invitation email failed', ['email' => $user->email, 'error' => $e->getMessage()]);
        }

        return redirect()
            ->route('admin.staff.index')
            ->with('success', "Staff member '{$user->name}' created. A password setup email has been sent.");
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot deactivate an admin user.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $action = $user->is_active ? 'activated' : 'deactivated';
        Log::info("Staff user {$action}", ['user_id' => $user->id, 'by' => auth()->user()->email]);

        return back()->with('success', "Staff member '{$user->name}' has been {$action}.");
    }

    /**
     * Resend password setup email.
     */
    public function resendInvite(User $user)
    {
        try {
            $status = Password::sendResetLink(['email' => $user->email]);

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('success', "Password setup email resent to '{$user->email}'.");
            }

            return back()->with('error', 'Failed to resend invitation. Please try again.');
        } catch (\Exception $e) {
            Log::error('Resend invite failed', ['email' => $user->email, 'error' => $e->getMessage()]);
            return back()->with('error', 'Could not send the invitation email.');
        }
    }
}
