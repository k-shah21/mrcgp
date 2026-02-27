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
            });
        </script>
    @endpush
</x-layouts.dashboard>
