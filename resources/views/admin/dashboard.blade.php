<x-layouts.dashboard title="Dashboard" description="Overview of application statistics">

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

    {{-- Top 5 Applications & Handled By Chart --}}
    <div class="flex flex-col lg:flex-row gap-6 mb-6">
        {{-- Top 5 Pending Applications --}}
        <div class="w-full lg:w-1/2">
            <x-card title="Top 5 Pending Applications" subtitle="Most recent pending reviews">
                @if ($topApplications->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-xs text-slate-600">
                            <thead>
                                <tr>
                                    <th
                                        class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-2.5">
                                        Name</th>
                                    <th
                                        class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-2.5">
                                        Type</th>
                                    <th
                                        class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-2.5">
                                        Submitted</th>
                                    <th
                                        class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-4 py-2.5">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topApplications as $app)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td
                                            class="border-b border-slate-100 px-4 py-2.5 text-xs text-slate-900 font-medium">
                                            {{ $app->usualForename }} {{ $app->lastName }}
                                        </td>
                                        <td class="border-b border-slate-100 px-4 py-2.5">
                                            <x-badge :variant="$app->candidateType === 'new' ? 'info' : 'neutral'">
                                                {{ ucfirst($app->candidateType) }}
                                            </x-badge>
                                        </td>
                                        <td class="border-b border-slate-100 px-4 py-2.5 text-xs text-slate-500">
                                            {{ $app->created_at?->format('M d, Y') }}
                                        </td>
                                        <td class="border-b border-slate-100 px-4 py-2.5">
                                            <a href="{{ route('admin.applications.show', $app) }}"
                                                class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1 text-[11px] font-medium text-slate-700 hover:bg-slate-200 transition">
                                                <i class="ri-eye-line text-sm"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-6">
                        <i class="ri-checkbox-circle-line text-3xl text-emerald-300"></i>
                        <p class="text-xs text-slate-400 mt-2">No pending applications at this time.</p>
                    </div>
                @endif
            </x-card>
        </div>

        {{-- Handled By Analytics Chart (Admin Only) --}}
        @if (auth()->check() && auth()->user()->isAdmin() && count($handledByChart['labels']) > 0)
            <div class="w-full lg:w-1/2">
                <x-card title="Handled By Analytics" subtitle="Applications processed per user">
                    <div id="handledByChart" class="h-72"></div>
                </x-card>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Registrations Over Time Chart
                var timeDates = {!! json_encode($timeChartData->pluck('date')) !!};
                var timeCounts = {!! json_encode($timeChartData->pluck('count')) !!};

                new ApexCharts(document.querySelector("#registrationsTimeChart"), {
                    chart: {
                        type: 'area',
                        height: 300,
                        toolbar: {
                            show: false
                        },
                        foreColor: '#9ca3af'
                    },
                    colors: ['#6366f1'],
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.45,
                            opacityTo: 0.05
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb'
                    },
                    series: [{
                        name: 'Applications',
                        data: timeCounts
                    }],
                    xaxis: {
                        categories: timeDates,
                        labels: {
                            style: {
                                colors: '#9ca3af',
                                fontSize: '10px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#9ca3af'
                            }
                        }
                    },
                    tooltip: {
                        theme: 'light'
                    },
                    dataLabels: {
                        enabled: false
                    },
                }).render();

                // Status Donut Chart
                new ApexCharts(document.querySelector("#statusDonutChart"), {
                    chart: {
                        type: 'donut',
                        height: 300,
                        toolbar: {
                            show: false
                        },
                        foreColor: '#9ca3af'
                    },
                    colors: {!! json_encode($statusChartData['colors']) !!},
                    labels: {!! json_encode($statusChartData['labels']) !!},
                    series: {!! json_encode($statusChartData['series']) !!},
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%'
                            }
                        }
                    },
                }).render();

                // Handled By Stacked Bar Chart (if element exists)
                var handledEl = document.querySelector("#handledByChart");
                if (handledEl) {
                    new ApexCharts(handledEl, {
                        chart: {
                            type: 'bar',
                            height: 300,
                            stacked: true,
                            toolbar: {
                                show: false
                            },
                            foreColor: '#9ca3af'
                        },
                        colors: ['#10b981', '#ef4444'],
                        series: [{
                                name: 'Approved',
                                data: {!! json_encode($handledByChart['approved']) !!}
                            },
                            {
                                name: 'Rejected',
                                data: {!! json_encode($handledByChart['rejected']) !!}
                            }
                        ],
                        xaxis: {
                            categories: {!! json_encode($handledByChart['labels']) !!},
                            labels: {
                                style: {
                                    colors: '#9ca3af',
                                    fontSize: '10px'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#9ca3af'
                                }
                            },
                            title: {
                                text: 'Applications',
                                style: {
                                    color: '#9ca3af',
                                    fontSize: '11px'
                                }
                            }
                        },
                        grid: {
                            borderColor: '#e5e7eb'
                        },
                        legend: {
                            position: 'top'
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 4,
                                columnWidth: '50%'
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        tooltip: {
                            theme: 'light'
                        },
                    }).render();
                }
            });
        </script>
    @endpush
</x-layouts.dashboard>
