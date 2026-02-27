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

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
        {{-- Registrations Over Time --}}
        <div class="w-full">
            <x-card title="Registrations Over Time" subtitle="Last 30 days">
                <div id="registrationsTimeChart" class="h-80"></div>
            </x-card>
        </div>

        {{-- Application Status Distribution --}}
        <div class="w-full">
            <x-card title="Application Status" subtitle="Distribution">
                <div id="statusDonutChart" class="h-80"></div>
            </x-card>
        </div>

        {{-- Handled By Analytics (Admin Only) --}}
        {{-- @if (auth()->check() && auth()->user()->isAdmin() && count($handledByChart['labels']) > 0) --}}
            <div class="w-full">
                <x-card title="Handled By Analytics" subtitle="Processed per user">
                    <div id="handledByChart" class="h-80"></div>
                </x-card>
            </div>
        {{-- @endif --}}
    </div>

    {{-- Top 5 Recent Pending Applications - Full Width --}}
    <div class="mb-6">
        <x-card title="Top 5 Pending Applications" subtitle="Requiring immediate review">
            @if ($topApplications->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-xs text-slate-600">
                        <thead>
                            <tr>
                                <th
                                    class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-6 py-3.5">
                                    Name</th>
                                <th
                                    class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-6 py-3.5">
                                    Email</th>
                                <th
                                    class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-6 py-3.5">
                                    Type</th>
                                <th
                                    class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-6 py-3.5">
                                    Submitted</th>
                                <th
                                    class="border-b border-slate-100 bg-slate-50/80 text-[11px] uppercase tracking-[0.16em] text-slate-500 font-semibold px-6 py-3.5">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($topApplications as $app)
                                <tr class="hover:bg-slate-50/50 transition duration-200">
                                    <td class="px-6 py-4 text-xs text-slate-900 font-medium">
                                        {{ $app->usualForename }} {{ $app->lastName }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-500">
                                        {{ $app->email ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-badge :variant="$app->candidateType === 'new' ? 'info' : 'neutral'">
                                            {{ ucfirst($app->candidateType) }}
                                        </x-badge>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-500">
                                        {{ $app->created_at?->format('M d, Y') }}
                                        <span
                                            class="block text-[10px] text-slate-400 mt-0.5">{{ $app->created_at?->diffForHumans() }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.applications.show', $app) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1.5 text-[11px] font-semibold text-indigo-600 hover:bg-indigo-100 transition duration-200 shadow-sm">
                                            <i class="ri-eye-line text-sm"></i> Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div
                        class="mx-auto w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4">
                        <i class="ri-checkbox-circle-line text-2xl"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-600">All caught up!</p>
                    <p class="text-xs text-slate-400 mt-1">There are no pending applications awaiting review.</p>
                </div>
            @endif
        </x-card>
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
                        height: 320,
                        toolbar: {
                            show: false
                        },
                        parentHeightOffset: 0,
                        foreColor: '#94a3b8'
                    },
                    colors: ['#6366f1'],
                    stroke: {
                        curve: 'smooth',
                        width: 2.5
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.4,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 4
                    },
                    series: [{
                        name: 'Applications',
                        data: timeCounts
                    }],
                    xaxis: {
                        categories: timeDates,
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: '#94a3b8',
                                fontSize: '10px',
                                fontWeight: 500
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#94a3b8',
                                fontSize: '10px',
                                fontWeight: 500
                            }
                        }
                    },
                    tooltip: {
                        theme: 'light',
                        x: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                }).render();

                // Status Donut Chart
                new ApexCharts(document.querySelector("#statusDonutChart"), {
                    chart: {
                        type: 'donut',
                        height: 320,
                        toolbar: {
                            show: false
                        },
                        foreColor: '#94a3b8'
                    },
                    stroke: {
                        width: 0
                    },
                    colors: {!! json_encode($statusChartData['colors']) !!},
                    labels: {!! json_encode($statusChartData['labels']) !!},
                    series: {!! json_encode($statusChartData['series']) !!},
                    legend: {
                        position: 'bottom',
                        fontSize: '11px',
                        fontWeight: 500,
                        markers: {
                            radius: 12
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '75%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        fontSize: '12px',
                                        fontWeight: 600,
                                        color: '#64748b',
                                        formatter: function(w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        }
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                }).render();

                // Handled By Stacked Bar Chart (if element exists)
                var handledEl = document.querySelector("#handledByChart");
                if (handledEl) {
                    new ApexCharts(handledEl, {
                        chart: {
                            type: 'bar',
                            height: 320,
                            stacked: true,
                            toolbar: {
                                show: false
                            },
                            foreColor: '#94a3b8'
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
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            labels: {
                                style: {
                                    colors: '#94a3b8',
                                    fontSize: '10px',
                                    fontWeight: 500
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#94a3b8',
                                    fontSize: '10px',
                                    fontWeight: 500
                                }
                            }
                        },
                        grid: {
                            borderColor: '#f1f5f9',
                            strokeDashArray: 4
                        },
                        legend: {
                            position: 'bottom',
                            fontSize: '11px',
                            fontWeight: 500,
                            markers: {
                                radius: 12
                            }
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                columnWidth: '40%'
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
