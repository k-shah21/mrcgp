<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} | MRCGP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.0/dist/apexcharts.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased" style="font-family: 'Instrument Sans', sans-serif;">
    <div class="min-h-screen flex bg-slate-50">

        {{-- Sidebar --}}
        <aside
            class="hidden md:flex md:flex-col w-64 shrink-0 bg-slate-950 text-slate-100 border-r border-slate-800 sticky top-0 h-screen overflow-hidden self-start">
            <div class="flex h-16 items-center px-5 border-b border-slate-800/80">
                <div class="flex items-center gap-x-3">
                   <img src="{{asset('icon.png')}}" class="w-10 h-10 object-contain" alt="">
                    <div>
                        <p class="text-sm font-semibold tracking-tight">MRCGP</p>
                        <p class="text-[11px] text-slate-400">Application Portal</p>
                    </div>
                </div>
            </div>

            <nav class="mt-4 flex-1 px-3 space-y-1 overflow-y-auto">
                @php
                    $navItems = [
                        [
                            'label' => 'Applications',
                            'icon' => 'ri-file-list-3-line',
                            'route' =>
                                auth()->check() && auth()->user()->isAdmin()
                                    ? 'admin.applications.index'
                                    : 'user.applications.index',
                        ],
                    ];

                    // Staff Management (Admin Only)
                    if (auth()->check() && auth()->user()->isAdmin()) {
                        array_unshift($navItems, [
                            'label' => 'Dashboard',
                            'icon' => 'ri-dashboard-3-line',
                            'route' => 'admin.dashboard',
                        ]);
                        $navItems[] = [
                            'label' => 'Staff',
                            'icon' => 'ri-team-line',
                            'route' => 'admin.staff.index',
                        ];
                    }
                @endphp

                @foreach ($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['route'] . '*');
                    @endphp
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center gap-x-3 rounded-xl px-3 py-2 text-sm font-medium transition
                            {{ $isActive ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}">
                        <span
                            class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-slate-800 text-lg font-normal text-slate-200 group-hover:bg-slate-700">
                            <i class="{{ $item['icon'] }}"></i>
                        </span>
                        <span class="truncate">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="border-t border-slate-800/80 px-4 py-2">
                {{-- <div class="flex items-center gap-x-3">
                    <div class="h-9 w-9 rounded-full bg-slate-800 flex items-center justify-center text-xs font-medium text-slate-200">
                        AD
                    </div>
                    <div>
                        <p class="text-sm font-medium">Admin</p>
                        <p class="text-[11px] text-slate-400">admin@mrcgp.org</p>
                    </div>
                </div> --}}

                <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full group flex items-center gap-x-3 rounded-xl px-3 py-2 text-sm font-medium transition text-slate-300 hover:bg-slate-800/70 hover:text-white">
                        <span
                            class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-slate-800 text-lg font-normal text-slate-200 group-hover:bg-slate-700">
                            <i class="ri-logout-box-r-line text-rose-400/90 group-hover:text-rose-400"></i>
                        </span>
                        <span class="truncate text-rose-400/90 group-hover:text-rose-400">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- Navbar --}}
            <header
                class="sticky top-0 z-30 flex h-16 items-center gap-x-4 border-b border-slate-200 bg-white/90 backdrop-blur-sm px-4 lg:px-8">
                <div>
                    <h1 class="text-sm font-semibold text-slate-900">{{ $title ?? 'Dashboard' }}</h1>
                    @if (isset($description))
                        <p class="text-[11px] text-slate-500">{{ $description }}</p>
                    @endif
                </div>
            </header>

            <main class="flex-1 px-4 py-6 lg:px-8 lg:py-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'rounded-xl shadow-lg border border-slate-100',
                        title: 'text-sm font-semibold text-slate-800'
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'rounded-xl shadow-lg border border-slate-100',
                        title: 'text-sm font-semibold text-slate-800'
                    }
                });
            @endif
        });
    </script>
</body>

</html>
