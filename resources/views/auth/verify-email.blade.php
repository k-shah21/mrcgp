<x-layouts.guest-layout title="Verify Email – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-white/20 mb-4 shadow-lg">
            <span class="text-white font-bold text-xl">MRC</span>
        </div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Verify Your Email</h1>
        <p class="text-indigo-300 text-sm mt-1">
            Thanks for signing up! Before getting started, please verify your email address.
        </p>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 shadow-2xl">

        <!-- Status Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-5 bg-green-500/20 border border-green-400/30 rounded-xl px-4 py-3 text-green-300 text-sm">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <div class="space-y-5">

            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                    Resend Verification Email
                </button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-xl border border-white/20 text-white text-sm hover:bg-white/10 transition">
                    Log Out
                </button>
            </form>

        </div>
    </div>

    <p class="text-center text-indigo-400/60 text-xs mt-6">
        © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
    </p>

</x-layouts.guest-layout>