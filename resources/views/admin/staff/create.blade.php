<x-layouts.dashboard title="Add Staff Member" description="Create a new staff account">

    <div class="mb-6">
        <a href="{{ route('admin.staff.index') }}"
            class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-slate-700 transition">
            <i class="ri-arrow-left-line text-sm"></i> Back to Staff
        </a>
    </div>

    <div class="max-w-lg">
        <x-card title="New Staff Member" subtitle="A password setup email will be sent automatically">
            <form method="POST" action="{{ route('admin.staff.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Full
                        Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="e.g. John Doe"
                        class="h-9 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/70 focus:bg-white transition-all">
                    @error('name')
                        <p class="text-[11px] text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Email
                        Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="e.g. staff@mrcgp.com"
                        class="h-9 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/70 focus:bg-white transition-all">
                    @error('email')
                        <p class="text-[11px] text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="p-3 bg-indigo-50 rounded-xl border border-indigo-100">
                    <div class="flex items-start gap-2">
                        <i class="ri-information-line text-indigo-500 text-sm mt-0.5"></i>
                        <p class="text-[11px] text-indigo-700">
                            A secure password setup link will be emailed to the staff member. The link will expire as
                            per your application's password reset policy.
                        </p>
                    </div>
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white hover:bg-slate-800 transition shadow-sm">
                    <i class="ri-user-add-line text-sm"></i> Create Staff Member & Send Invite
                </button>
            </form>
        </x-card>
    </div>
</x-layouts.dashboard>
