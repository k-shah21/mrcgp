<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        // Already logged in — redirect to dashboard
        if (\Illuminate\Support\Facades\Auth::check() || session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle admin login attempt.
     *
     * Credentials are stored in .env and compared with bcrypt.
     * We use Hash::check() even for static credentials to prevent timing attacks.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Please enter your admin email address to log in.',
            'email.email' => 'The email address format is invalid. Please enter a valid email (e.g., admin@example.com).',
            'password.required' => 'Please enter your password to log in.',
            'password.min' => 'Your password must be at least 6 characters long.',
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = \Illuminate\Support\Facades\Auth::user();

            // Check if account is active
            if (! $user->is_active) {
                \Illuminate\Support\Facades\Auth::logout();
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Your account has been deactivated. Please contact an administrator.']);
            }

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            session([
                'admin_logged_in' => true,
                'admin_email'     => $request->email,
                'admin_role'      => $user->role,
                'admin_login_at'  => now()->toDateTimeString(),
            ]);

            Log::info('Admin login successful', ['email' => $request->email, 'role' => $user->role, 'ip' => $request->ip()]);

            return redirect()->route('admin.dashboard')
                ->with('success', "Welcome back, {$user->name}!");
        }

        Log::warning('Failed admin login attempt', ['email' => $request->email, 'ip' => $request->ip()]);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'The email or password you entered is incorrect. Please double-check your credentials and try again.']);
    }

    /**
     * Logout the admin.
     */
    public function logout(Request $request)
    {
        Log::info('Admin logout', ['email' => session('admin_email'), 'ip' => $request->ip()]);

        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
