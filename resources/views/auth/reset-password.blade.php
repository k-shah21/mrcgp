<x-layouts.guest title="Forgot Password – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl 
                    bg-white/10 border border-white/20 mb-5 shadow-lg backdrop-blur-md">
            <span class="text-white font-bold text-xl tracking-wider">MRC</span>
        </div>

        <h1 class="text-3xl font-bold text-white tracking-tight">
            Reset Your Password
        </h1>

        <p class="text-indigo-300 text-sm mt-2 max-w-sm mx-auto">
            Please enter your email and choose a strong new password to regain access to your account.
        </p>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-3xl p-8 shadow-2xl backdrop-blur-xl">

        <!-- Status Message -->
        @if (session('status'))
            <div class="mb-6 bg-emerald-500/15 border border-emerald-400/30 
                        rounded-xl px-4 py-3 text-emerald-300 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 bg-red-500/15 border border-red-400/30 rounded-xl px-4 py-3">
                <ul class="text-red-300 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Field -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">
                    Email Address
                </label>

                <div class="relative">
                    <i class="ri-mail-line absolute left-3.5 top-1/2 
                              -translate-y-1/2 text-indigo-400 text-lg"></i>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="admin@example.com"
                        class="w-full pl-10 pr-4 py-3 bg-white/10 
                               border border-white/20 rounded-xl 
                               text-white placeholder-indigo-300/60 text-sm
                               focus:border-indigo-400 focus:ring-2 
                               focus:ring-indigo-500/40 focus:bg-white/15
                               transition-all duration-200"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">
                    New Password
                </label>

                <div class="relative">
                    <i class="ri-lock-password-line absolute left-3.5 top-1/2 
                              -translate-y-1/2 text-indigo-400 text-lg"></i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-3 bg-white/10 
                               border border-white/20 rounded-xl 
                               text-white placeholder-indigo-300/60 text-sm
                               focus:border-indigo-400 focus:ring-2 
                               focus:ring-indigo-500/40 focus:bg-white/15
                               transition-all duration-200"
                    >
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">
                    Confirm Password
                </label>

                <div class="relative">
                    <i class="ri-lock-password-line absolute left-3.5 top-1/2 
                              -translate-y-1/2 text-indigo-400 text-lg"></i>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-3 bg-white/10 
                               border border-white/20 rounded-xl 
                               text-white placeholder-indigo-300/60 text-sm
                               focus:border-indigo-400 focus:ring-2 
                               focus:ring-indigo-500/40 focus:bg-white/15
                               transition-all duration-200"
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3 rounded-xl 
                       bg-gradient-to-r from-indigo-500 to-purple-600 
                       hover:from-indigo-600 hover:to-purple-700
                       text-white font-semibold text-sm 
                       transition-all duration-200 
                       transform hover:scale-[1.02] 
                       shadow-lg">
                Reset Password
            </button>

            <!-- Back to Login -->
            <p class="text-sm text-indigo-300 text-center">
                Remember your password?
                <a href="{{ route('login') }}"
                   class="underline hover:text-white transition">
                    Back to Login
                </a>
            </p>

        </form>
    </div>

    <!-- Footer -->
    <p class="text-center text-indigo-400/60 text-xs mt-8">
        © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
    </p>

</x-layouts.guest>