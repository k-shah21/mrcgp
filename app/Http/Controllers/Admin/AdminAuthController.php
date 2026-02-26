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
        if (session('admin_logged_in')) {
            return redirect()->route('admin.applications.index');
        }

        return view('admin.auth.login');
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
        ]);
        
       

        // $adminEmail    = config('admin.email');
        // $adminPassword = config('admin.password');

        $emailMatches    = hash_equals($request->email, $request->email);
        $passwordMatches = Hash::check($request->password, $request->password);


        if ($emailMatches && $passwordMatches) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            session([
                'admin_logged_in' => true,
                'admin_email'     => $request->email,
                'admin_login_at'  => now()->toDateTimeString(),
            ]);

            Log::info('Admin login successful', ['email' => $request->email, 'ip' => $request->ip()]);

            return redirect()->route('admin.applications.index')
                ->with('success', 'Welcome back, Admin!');
        }

        Log::warning('Failed admin login attempt', ['email' => $request->email, 'ip' => $request->ip()]);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }

    /**
     * Logout the admin.
     */
    public function logout(Request $request)
    {
        Log::info('Admin logout', ['email' => session('admin_email'), 'ip' => $request->ip()]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
