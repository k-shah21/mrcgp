<x-layouts.dashboard title="Applications" description="Candidate application management">

    {{-- Stats Cards --}}
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4 mb-6">
        <x-card title="Total Applications" subtitle="All-time">
            <p class="text-2xl font-semibold text-slate-900">{{ number_format($stats['total']) }}</p>
        </x-card>
        <x-card title="Pending" subtitle="Awaiting review">
            <p class="text-2xl font-semibold text-amber-600">{{ number_format($stats['pending']) }}</p>
        </x-card>
        <x-card title="Approved" subtitle="Confirmed candidates">
            <p class="text-2xl font-semibold text-emerald-600">{{ number_format($stats['approved']) }}</p>
        </x-card>
        <x-card title="Rejected" subtitle="Declined applications">
            <p class="text-2xl font-semibold text-rose-600">{{ number_format($stats['rejected']) }}</p>
        </x-card>
    </div>

    {{-- Charts --}}
    <div class="flex flex-col lg:flex-row gap-6 mb-6">
        <div class="w-full lg:w-3/5">
            <x-card title="Registrations Over Time" subtitle="Last 30 days">
                <div id="registrationsTimeChart" class="h-72"></div>
            </x-card>
        </div>
        <div class="w-full lg:w-2/5">
            <x-card title="Application Status" subtitle="Distribution">
                <div id="statusDonutChart" class="h-72"></div>
            </x-card>
        </div>
    </div>

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
                <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Status</label>
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
            @if(request()->hasAny(['search', 'status', 'type']))
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
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">ID</th>
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">Name</th>
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">Email</th>
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">Type</th>
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">Status</th>
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">Date</th>
                        <th class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-3">Action</th>
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
                                    $variant = match($app->status) {
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

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Registrations Over Time Chart
                var timeDates = {!! json_encode($timeChartData->pluck('date')) !!};
                var timeCounts = {!! json_encode($timeChartData->pluck('count')) !!};

                new ApexCharts(document.querySelector("#registrationsTimeChart"), {
                    chart: { type: 'area', height: 300, toolbar: { show: false }, foreColor: '#9ca3af' },
                    colors: ['#6366f1'],
                    stroke: { curve: 'smooth', width: 2 },
                    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.45, opacityTo: 0.05 }},
                    grid: { borderColor: '#e5e7eb' },
                    series: [{ name: 'Applications', data: timeCounts }],
                    xaxis: { categories: timeDates, labels: { style: { colors: '#9ca3af', fontSize: '10px' }}},
                    yaxis: { labels: { style: { colors: '#9ca3af' }}},
                    tooltip: { theme: 'light' },
                    dataLabels: { enabled: false },
                }).render();

                // Status Donut Chart
                new ApexCharts(document.querySelector("#statusDonutChart"), {
                    chart: { type: 'donut', height: 300, toolbar: { show: false }, foreColor: '#9ca3af' },
                    colors: {!! json_encode($statusChartData['colors']) !!},
                    labels: {!! json_encode($statusChartData['labels']) !!},
                    series: {!! json_encode($statusChartData['series']) !!},
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '65%' }}},
                }).render();
            });
        </script>
    @endpush
</x-layouts.dashboard>
