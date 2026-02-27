<x-layouts.dashboard title="Applications" description="Candidate application management">

    {{-- Filters --}}
    <x-card title="All Applications" subtitle="Search and filter candidates">
        <form action="{{ route('admin.applications.index') }}" method="GET" class="flex flex-wrap items-end gap-3 mb-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Search</label>
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Name, email, candidate ID..."
                    class="h-9 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:bg-white transition-all">
            </div>
            <div>
                <label
                    class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Status</label>
                <select name="status"
                    class="h-9 rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/70 transition-all">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div>
                <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Type</label>
                <select name="type"
                    class="h-9 rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/70 transition-all">
                    <option value="">All Types</option>
                    <option value="new" {{ $type === 'new' ? 'selected' : '' }}>New</option>
                    <option value="old" {{ $type === 'old' ? 'selected' : '' }}>Old</option>
                </select>
            </div>
            <button type="submit"
                class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-5 py-2 text-xs font-semibold text-white hover:bg-slate-800 transition shadow-sm h-9">
                <i class="ri-filter-3-line text-sm"></i> Filter
            </button>
            @if (request()->hasAny(['search', 'status', 'type']))
                <a href="{{ route('admin.applications.index') }}"
                    class="px-4 py-2 text-xs font-medium text-slate-500 hover:text-slate-700 transition">
                    Clear
                </a>
            @endif
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs text-slate-600">
                <thead>
                    <tr>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            ID</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Name</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Email</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Type</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Status</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Date</th>
                        <th
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $app)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-600 font-medium">
                                {{ $app->candidateId ?? '#' . $app->id }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-900 font-medium">
                                {{ $app->usualForename }} {{ $app->lastName }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-600">
                                {{ $app->email ?? '—' }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3">
                                <x-badge :variant="$app->candidateType === 'new' ? 'info' : 'neutral'">
                                    {{ ucfirst($app->candidateType) }}
                                </x-badge>
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3">
                                @php
                                    $variant = match ($app->status) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning',
                                    };
                                @endphp
                                <x-badge :variant="$variant">
                                    {{ ucfirst($app->status ?? 'pending') }}
                                </x-badge>
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3 text-xs text-slate-500">
                                {{ $app->created_at?->format('M d, Y') }}
                            </td>
                            <td class="border-b border-slate-100 px-4 py-3">
                                <a href="{{ route('admin.applications.show', $app) }}"
                                    class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-[11px] font-medium text-slate-700 hover:bg-slate-200 transition">
                                    <i class="ri-eye-line text-sm"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-xs text-slate-400">
                                No applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </x-card>

</x-layouts.dashboard>
