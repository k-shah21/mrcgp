<x-layouts.guest-layout title="Register – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 border border-white/20 mb-4 shadow-lg">
            <span class="text-white font-bold text-xl">MRC</span>
        </div>
        <h1 class="text-2xl font-bold text-white tracking-tight">MRCGP Registration</h1>
        <p class="text-indigo-300 text-sm mt-1">Create a new account to access the portal</p>
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

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Your Name"
                    class="w-full pl-3 pr-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                >
            </div>

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
                        autocomplete="username"
                        placeholder="admin@complyeze.com"
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
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-12 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                    >
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-indigo-200 mb-2">Confirm Password</label>
                <div class="relative">
                    <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-indigo-400 text-lg"></i>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-12 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-indigo-300/60 text-sm focus:border-indigo-400 focus:bg-white/15 transition"
                    >
                </div>
            </div>

            <!-- Submit & Login Link -->
            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('login') }}" class="underline text-sm text-indigo-300 hover:text-white">
                    Already registered?
                </a>
                <button type="submit"
                    class="py-3 px-5 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm transition-all duration-200 transform hover:scale-[1.02] shadow-lg">
                    Register
                </button>
            </div>

        </form>
    </div>

    <p class="text-center text-indigo-400/60 text-xs mt-6">
        © {{ date('Y') }} South Asia MRCGP [INT] Examination Board
    </p>

</x-layouts.guest-layout>