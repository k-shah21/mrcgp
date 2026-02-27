<x-layouts.guest title="Admin Login – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <!-- <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-white/20 mb-4 shadow-lg">
            <span class="text-white font-bold text-xl">MRC</span>
        </div> -->
        <h1 class="text-2xl font-bold text-white tracking-tight">MRCGP Admin Portal</h1>
        <p class="text-indigo-300 text-sm mt-1">Sign in to manage applications</p>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 shadow-2xl">

        <!-- Status -->
        <x-auth-session-status class="mb-4 text-green-400 text-sm" :status="session('status')" />

        <!-- Errors -->
        @if ($errors->any())
            <div class="mb-5 bg-red-500/20 border border-red-400/30 rounded-xl px-4 py-3">
                <ul class="text-red-300 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">Email Address</label>
                <div class="relative">
                    <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-indigo-400 text-lg"></i>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="admin@example.com"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                    >
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">Password</label>
                <div class="relative">
                    <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-indigo-400 text-lg"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-12 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                    >
                    <button type="button" id="toggle-pw"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-indigo-400 hover:text-white transition">
                        <i class="ri-eye-line text-lg" id="eye-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm text-indigo-200">Remember me</span>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                Sign In
            </button>

            <!-- Forgot Password
            @if (Route::has('password.request'))
                <p class="mt-3 text-sm text-indigo-300 text-center">
                    <a href="{{ route('password.request') }}" class="underline hover:text-white">Forgot your password?</a>
                </p>
            @endif -->

        </form>
    </div>

    <p class="text-center text-indigo-400/60 text-xs mt-6">
        © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
    </p>

    <script>
        document.getElementById('toggle-pw')?.addEventListener('click', function () {
            const pw = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.className = 'ri-eye-off-line text-lg';
            } else {
                pw.type = 'password';
                icon.className = 'ri-eye-line text-lg';
            }
        });
    </script>
</x-layouts.guest>