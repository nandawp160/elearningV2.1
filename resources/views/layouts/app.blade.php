<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'SMA N 1 Cepogo') }}</title>
    <link rel="icon" href="{{ asset('assets/logo/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"/>

    <!-- Custom DataTables UI Override for Minimalist Theme -->
    <style>
        /* Base Table Styling */
        table.dataTable { border-collapse: collapse !important; border-spacing: 0; width: 100% !important; margin-bottom: 1rem; border: 1px solid #f1f5f9; }
        table.dataTable thead th { border-bottom: 2px solid #f8fafc !important; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; color: #64748b; padding: 1rem 1.5rem !important; background-color: #ffffff; }
        table.dataTable tbody td { border-bottom: 1px solid #f1f5f9 !important; padding: 1rem 1.5rem !important; font-size: 0.875rem; color: #334155; vertical-align: middle; }
        table.dataTable tbody tr:hover { background-color: #f8fafc !important; }
        .dark table.dataTable { border-color: #1e293b; }
        .dark table.dataTable thead th { border-bottom-color: #1e293b !important; color: #94a3b8; background-color: #0f172a; }
        .dark table.dataTable tbody td { border-bottom-color: #1e293b !important; color: #cbd5e1; }
        .dark table.dataTable tbody tr:hover { background-color: #1e293b !important; }
        
        /* Filters and Search Wrapper */
        .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_length { margin-bottom: 1.5rem; color: #475569; font-size: 0.875rem; }
        .dataTables_wrapper .dataTables_filter input { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.5rem 1rem; margin-left: 0.5rem; outline: none; transition: border-color 0.2s; }
        .dataTables_wrapper .dataTables_filter input:focus { border-color: #f97316; box-shadow: 0 0 0 1px #f97316; }
        .dataTables_wrapper .dataTables_length select { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.4rem 1.5rem 0.4rem 0.75rem; margin: 0 0.5rem; outline: none; }
        
        /* Export Buttons - Compact Minimalist */
        .dt-buttons { margin-bottom: 1.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .dt-button { background: #ffffff !important; border: 1px solid #e2e8f0 !important; color: #475569 !important; border-radius: 0.5rem !important; padding: 0.4rem 0.75rem !important; font-size: 0.75rem !important; font-weight: 500 !important; font-family: 'Inter', sans-serif !important; box-shadow: none !important; margin: 0 !important; }
        .dt-button:hover { background: #f8fafc !important; border-color: #cbd5e1 !important; color: #1e293b !important; }
        .dark .dt-button { background: #1e293b !important; border-color: #334155 !important; color: #cbd5e1 !important; }
        .dark .dt-button:hover { background: #334155 !important; color: #f8fafc !important; }
        
        /* Pagination */
        .dataTables_wrapper .dataTables_paginate { margin-top: 1.5rem; display: flex; align-items: center; justify-content: flex-end; gap: 0.25rem; font-size: 0.875rem; }
        .dataTables_wrapper .dataTables_paginate .paginate_button { border: 1px solid #e2e8f0 !important; background: #ffffff !important; color: #475569 !important; border-radius: 0.5rem !important; padding: 0.35rem 0.75rem !important; margin: 0 !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: #f97316 !important; border-color: #f97316 !important; color: #ffffff !important; font-weight: 600; }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) { background: #f8fafc !important; border-color: #cbd5e1 !important; color: #1e293b !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled { opacity: 0.5; cursor: not-allowed; }
        .dataTables_wrapper .dataTables_info { margin-top: 1.5rem; color: #64748b; font-size: 0.875rem; }
        
        /* DataTables Sorting Icons Reset */
        table.dataTable thead th.sorting, table.dataTable thead th.sorting_asc, table.dataTable thead th.sorting_desc { background-image: none !important; position: relative; padding-right: 2rem !important; }
        table.dataTable thead th.sorting::after, table.dataTable thead th.sorting_asc::after, table.dataTable thead th.sorting_desc::after { position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); font-family: 'Font Awesome 6 Free'; font-weight: 900; content: '\f0dc'; color: #cbd5e1; opacity: 1; font-size: 0.75rem; }
        table.dataTable thead th.sorting_asc::after { content: '\f0de'; color: #f97316; }
        table.dataTable thead th.sorting_desc::after { content: '\f0dd'; color: #f97316; }
    </style>

    <!-- Custom Responsive Breakpoints (Prod Tailwind Polyfill) -->
    <style>
        @media (min-width: 1024px) {
            .lg\:translate-x-0 { transform: translateX(0px); }
            .lg\:ml-72 { margin-left: 18rem; }
            .lg\:hidden { display: none; }
        }
        
        /* FOUC Preventer for Dropdowns (Alpine JS delay on live server) */
        .preload-hide-dropdowns [x-show="open"] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 transition-colors duration-200 preload-hide-dropdowns">
    <script>
        // Remove FOUC prevention after Alpine has a chance to initialize
        window.addEventListener('load', function() {
            document.body.classList.remove('preload-hide-dropdowns');
        });
        setTimeout(function() {
            document.body.classList.remove('preload-hide-dropdowns');
        }, 1500);
    </script>
    <div class="min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content Area -->
        <div class="relative lg:ml-72 transition-all duration-300">
            <!-- Navbar -->
            @include('components.navbar')

            <!-- Page Content -->
            <main class="px-6 md:px-10 mx-auto w-full max-w-[1400px] pt-28 pb-10">
                @if(auth()->check() && (
                    (auth()->user()->isStudent() && auth()->user()->student && empty(auth()->user()->student->nis)) ||
                    (auth()->user()->isTeacher() && auth()->user()->teacher && (empty(auth()->user()->teacher->nip) || empty(auth()->user()->teacher->email)))
                ))
                <div class="mb-6 p-4 rounded-xl bg-orange-50 border border-orange-200 flex items-start gap-4 shadow-sm no-print">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 flex-shrink-0">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-orange-800">Perhatian: Data Profil Belum Lengkap!</h4>
                        <p class="text-sm text-orange-700 mt-1">Kami mendeteksi bahwa data penting seperti NIS/NIP belum terisi. Harap segera lengkapi biodata Anda melalui menu Profil agar Anda terdaftar dengan benar di sistem.</p>
                        <a href="{{ auth()->user()->isStudent() ? route('student.biodata.create') : route('profile.edit') }}" class="inline-block mt-3 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold rounded-lg transition shadow-sm">Lengkapi Sekarang</a>
                    </div>
                </div>
                @endif
                
                @yield('content')
            </main>
            <!-- Footer -->
            <footer class="mt-10 border-t border-slate-200/70 dark:border-slate-800/70">
                <div class="px-6 md:px-10 py-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-400">
                    <div>&copy; {{ date('Y') }} SMA N 1 Cepogo</div>
                    <div class="flex items-center gap-4">
                        <a href="#" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">About</a>
                        <a href="#" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Documentation</a>
                        <a href="#" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @stack('modals')
    @include('components.loading-overlay')
    
    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- DataTables JS & Plugins -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

        <!-- Smart Session Timer (Heartbeat & Idle) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let lastActivityTime = Date.now();
            const IDLE_TIMEOUT = 30 * 60 * 1000; // 30 menit
            const HEARTBEAT_INTERVAL = 3 * 60 * 1000; // 3 menit

            const updateActivity = () => { lastActivityTime = Date.now(); };
            window.addEventListener('mousemove', updateActivity);
            window.addEventListener('keydown', updateActivity);
            window.addEventListener('click', updateActivity);
            window.addEventListener('scroll', updateActivity);

            setInterval(() => {
                const currentTime = Date.now();
                if (currentTime - lastActivityTime > IDLE_TIMEOUT) {
                    const logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
                    if (logoutForm) {
                        logoutForm.submit();
                    } else {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('logout') }}';
                        const csrf = document.createElement('input');
                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                        form.appendChild(csrf);
                        document.body.appendChild(form);
                        form.submit();
                    }
                } else {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (token) {
                        fetch('{{ route('heartbeat') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            }
                        }).catch(e => console.log('Heartbeat error:', e));
                    }
                }
            }, HEARTBEAT_INTERVAL);
        });
    </script>

    @stack('scripts')
</body>
</html>






