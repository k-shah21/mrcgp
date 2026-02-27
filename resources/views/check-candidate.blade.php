<x-layouts.guest title="Check Candidate – MRCGP Portal">

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="mb-5 flex justify-center">
            <img src="/logo-2.png" class="w-32 sm:w-72 object-contain drop-shadow-md" alt="MRCGP">
        </div>
    </div>

    <!-- Card -->
    <div class="glass-card rounded-2xl p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
        
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight flex items-center justify-between">
            Check Candidate
            <a href="{{ url('/') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition">
                <i class="ri-arrow-left-line"></i> Back
            </a>
        </h2>

        <p class="text-sm text-slate-500 mt-2 mb-6">
            Enter the Candidate ID to verify their status.
        </p>

        <form method="POST" action="{{ route('candidate.check') }}" class="space-y-5">
            @csrf

            <!-- Candidate ID -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Candidate ID</label>
                <div class="relative">
                    <i class="ri-id-card-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                    <input
                        type="text"
                        name="candidate_id"
                        value="{{ old('candidate_id') }}"
                        required
                        autofocus
                        placeholder="e.g. 12345"
                        class="w-full pl-4 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none"
                    >
                </div>
                @error('candidate_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold text-sm transition-all duration-200 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg shadow-indigo-200 flex justify-center items-center gap-2">
                <i class="ri-search-line"></i> Check Candidate Status
            </button>
        </form>
    </div>

    <!-- SweetAlert Integration -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Candidate Found',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#4f46e5',
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Not Found',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#4f46e5',
                });
            });
        </script>
    @endif

</x-layouts.guest>
