<x-layouts.dashboard title="Staff Management" description="Manage staff user accounts">

    <div class="mb-6 flex items-center justify-between">
        <div></div>
        <a href="{{ route('admin.staff.create') }}"
            class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-5 py-2 text-xs font-semibold text-white hover:bg-slate-800 transition shadow-sm">
            <i class="ri-user-add-line text-sm"></i> Add Staff Member
        </a>
    </div>

    <x-card title="All Staff Members" subtitle="Create, manage, and monitor staff accounts">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs text-slate-600">
                <thead>
                    <tr>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Name</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Email</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Status</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Approved</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Rejected</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Joined</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffUsers as $staff)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-900 font-medium">
                                {{ $staff->name }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-600">
                                {{ $staff->email }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3">
                                @if ($staff->is_active)
                                    <span
                                        class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold ring-1 ring-inset bg-emerald-50 text-emerald-700 ring-emerald-200">Active</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold ring-1 ring-inset bg-slate-100 text-slate-500 ring-slate-200">Inactive</span>
                                @endif
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-emerald-600 font-semibold">
                                {{ $staff->approved_count ?? 0 }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-rose-600 font-semibold">
                                {{ $staff->rejected_count ?? 0 }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-500">
                                {{ $staff->created_at?->format('M d, Y') }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3">
                                <div class="flex items-center gap-2">
                                    {{-- Toggle Status --}}
                                    <form method="POST" action="{{ route('admin.staff.toggle-status', $staff) }}"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-[11px] font-medium transition
                                                {{ $staff->is_active ? 'bg-rose-50 text-rose-600 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}"
                                            onclick="return confirm('{{ $staff->is_active ? 'Deactivate' : 'Activate' }} this staff member?')">
                                            <i
                                                class="{{ $staff->is_active ? 'ri-user-unfollow-line' : 'ri-user-follow-line' }} text-sm"></i>
                                            {{ $staff->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                    {{-- Resend Invite --}}
                                    <form method="POST" action="{{ route('admin.staff.resend-invite', $staff) }}"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[11px] font-medium text-slate-700 hover:bg-slate-200 transition"
                                            onclick="return confirm('Resend password setup email to {{ $staff->email }}?')">
                                            <i class="ri-mail-send-line text-sm"></i> Resend
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-xs text-slate-400">
                                No staff members found. Click "Add Staff Member" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $staffUsers->links() }}
        </div>
    </x-card>
</x-layouts.dashboard>
