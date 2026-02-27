<x-layouts.guest title="Register – MRCGP Portal">

      <!-- Header -->
    <div class="text-center mb-8">
        <div class="mb-5 flex justify-center">
            <img src="/logo-2.png" class="w-32 sm:w-72 object-contain drop-shadow-md" alt="MRCGP">
        </div>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
<h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Register</h2>
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                <ul class="text-red-600 text-sm space-y-1 font-medium">
                    @foreach ($errors->all() as $error)
                        <li><i class="ri-error-warning-line mr-1"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                <div class="relative">
                    <i class="ri-user-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Dr. John Doe"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <div class="relative">
                    <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="admin@example.com"
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
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                </div>
            </div>

            <!-- Submit & Login Link -->
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 transition underline underline-offset-4">
                    Already registered?
                </a>
                <button type="submit"
                    class="py-3 px-8 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold text-sm transition-all duration-200 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-indigo-200">
                    Register
                </button>
            </div>

        </form>
    </div>

   

</x-layouts.guest>