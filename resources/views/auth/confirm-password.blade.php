<x-layouts.guest-layout title="Confirm Password – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-white/20 mb-4 shadow-lg">
            <span class="text-white font-bold text-xl">MRC</span>
        </div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Confirm Password</h1>
        <p class="text-indigo-300 text-sm mt-1">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 shadow-2xl">

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

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">Password</label>
                <div class="relative">
                    <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-indigo-400 text-lg"></i>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-12 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                    >
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="py-3 px-5 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                    Confirm
                </button>
            </div>
        </form>

    </div>

    <p class="text-center text-indigo-400/60 text-xs mt-6">
        © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
    </p>

</x-layouts.guest-layout>