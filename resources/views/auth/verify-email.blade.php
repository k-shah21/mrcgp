<x-layouts.guest title="Verify Email – MRCGP Portal">

     <!-- Header -->
    <div class="text-center mb-8">
        <div class="mb-5 flex justify-center">
            <img src="/logo-2.png" class="w-32 sm:w-72 object-contain drop-shadow-md" alt="MRCGP">
        </div>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
<h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Verify Email</h2>
        <!-- Status Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 bg-emerald-50 border border-emerald-100 rounded-xl px-4 py-3 text-emerald-700 text-sm font-medium flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-lg"></i>
                A new verification link has been sent to your email address.
            </div>
        @endif

        <div class="space-y-4">

            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold text-sm transition-all duration-200 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-indigo-200">
                    Resend Verification Email
                </button>
            </form>

            <div class="flex items-center gap-4 pt-2">
                <a href="{{ route('profile.edit') }}" class="flex-1 text-center py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold text-sm hover:bg-slate-200 transition">
                    Edit Profile
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 transition">
                        Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>

   

</x-layouts.guest>