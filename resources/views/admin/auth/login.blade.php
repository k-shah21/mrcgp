<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – MRCGP Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', 'Segoe UI', system-ui, sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.12); }
        input:focus { outline: none; }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Logo / Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-white/20 mb-4 shadow-lg">
                <span class="text-white font-bold text-xl">MRC</span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">MRCGP Admin Portal</h1>
            <p class="text-indigo-300 text-sm mt-1">Sign in to manage applications</p>
        </div>

        {{-- Card --}}
        <div class="glass-card rounded-2xl p-8 shadow-2xl">

            {{-- Success flash --}}
            @if (session('error'))
                <div class="mb-5 flex items-center gap-3 bg-red-500/20 border border-red-400/30 rounded-xl px-4 py-3">
                    <i class="ri-error-warning-line text-red-400 text-xl shrink-0"></i>
                    <p class="text-red-300 text-sm">{{ session('error') }}</p>
                </div>
            @endif

            @if ($errors->has('email'))
                <div class="mb-5 flex items-center gap-3 bg-red-500/20 border border-red-400/30 rounded-xl px-4 py-3">
                    <i class="ri-error-warning-line text-red-400 text-xl shrink-0"></i>
                    <p class="text-red-300 text-sm">{{ $errors->first('email') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-indigo-200 mb-2" for="email">
                        Email Address
                    </label>
                    <div class="relative">
                        <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-indigo-400 text-lg"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="admin@complyeze.com"
                            class="w-full pl-10 pr-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-indigo-200 mb-2" for="password">
                        Password
                    </label>
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
                        <button type="button" id="toggle-pw" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-indigo-400 hover:text-white transition">
                            <i class="ri-eye-line text-lg" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-3 rounded-xl bg-linear-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-[1.02] shadow-lg"
                >
                    Sign In to Dashboard
                </button>
            </form>
        </div>

        <p class="text-center text-indigo-400/60 text-xs mt-6">
            © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
        </p>
    </div>

    <script>
        document.getElementById('toggle-pw').addEventListener('click', function () {
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
</body>
</html>
