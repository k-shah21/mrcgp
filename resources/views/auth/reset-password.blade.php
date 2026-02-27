<x-layouts.guest title="Forgot Password – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-white/20 mb-4 shadow-lg">
            <span class="text-white font-bold text-xl">MRC</span>
        </div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Forgot Password</h1>
        <p class="text-indigo-300 text-sm mt-1">
            Enter your email address and we’ll send you a link to reset your password
        </p>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 shadow-2xl">

        <!-- Status -->
        @if (session('status'))
            <div class="mb-5 bg-green-500/20 border border-green-400/30 rounded-xl px-4 py-3 text-green-300 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-5 bg-red-500/20 border border-red-400/30 rounded-xl px-4 py-3">
                <ul class="text-red-300 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">Email Address</label>
                <div class="relative">
                    <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-indigo-400 text-lg"></i>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="admin@example.com"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                    >
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                    Send Password Reset Link
                </button>
            </div>

            <!-- Back to Login -->
            <p class="mt-3 text-sm text-indigo-300 text-center">
                <a href="{{ route('login') }}" class="underline hover:text-white">Back to Login</a>
            </p>

        </form>
    </div>

    <p class="text-center text-indigo-400/60 text-xs mt-6">
        © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
    </p>

</x-layouts.guest>