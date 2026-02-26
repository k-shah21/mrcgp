<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Please provide your full name.',
            'name.max' => 'The name you entered is too long. Please shorten it to 255 characters or fewer.',
            'email.required' => 'An email address is required to create your account.',
            'email.email' => 'The email address format is invalid. Please enter a valid email (e.g., name@example.com).',
            'email.unique' => 'This email address is already registered. Please log in instead, or use a different email.',
            'email.lowercase' => 'The email address must be in lowercase letters.',
            'password.required' => 'Please choose a password to secure your account.',
            'password.confirmed' => 'The password confirmation does not match. Please re-enter your password in both fields.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
