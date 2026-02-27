<x-layouts.guest title="Admin Login – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="mb-5 flex justify-center">
            <img src="/logo-2.png" class="w-32 sm:w-72 object-contain drop-shadow-md" alt="MRCGP">
        </div>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
<h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Login</h2>
        <!-- Status -->
        <x-auth-session-status class="mb-4 text-emerald-600 text-sm font-medium" :status="session('status')" />

        <!-- Errors -->
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                <ul class="text-red-600 text-sm space-y-1 font-medium">
                    @foreach ($errors->all() as $error)
                        <li><i class="ri-error-warning-line mr-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <div class="relative">
                    <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="john@example.com"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <div class="relative">
                    <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-12 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                    <button type="button" id="toggle-pw"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-600 transition">
                        <i class="ri-eye-line text-lg" id="eye-icon"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember_me"
                        class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-4 h-4 cursor-pointer">
                    <label for="remember_me" class="ms-2 text-sm text-slate-600 cursor-pointer">Remember me</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 underline underline-offset-4">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold text-sm transition-all duration-200 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-indigo-200">
                Sign In
            </button>

        </form>
    </div>

  

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