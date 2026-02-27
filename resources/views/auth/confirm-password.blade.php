l<x-layouts.guest title="Confirm Password – MRCGP Portal">

     <!-- Header -->
    <div class="text-center mb-8">
        <div class="mb-5 flex justify-center">
            <img src="/logo-2.png" class="w-32 sm:w-72 object-contain drop-shadow-md" alt="MRCGP">
        </div>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
<h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Confirm Password</h2>
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

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

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
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold text-sm transition-all duration-200 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-indigo-200">
                Confirm
            </button>
        </form>

    </div>

  

</x-layouts.guest>