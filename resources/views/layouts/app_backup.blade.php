<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'SMA N 1 Cepogo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 transition-colors duration-200">
    <div class="min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content Area -->
        <div class="relative md:ml-72 transition-all duration-300">
            <!-- Navbar -->
            @include('components.navbar')

            <!-- Page Content -->
            <main class="px-6 md:px-10 mx-auto w-full max-w-[1400px] pt-28 pb-10">
                @yield('content')
            </main>
            <!-- Footer -->
            <footer class="mt-10 border-t border-slate-200/70 dark:border-slate-800/70">
                <div class="px-6 md:px-10 py-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-400">
                    <div>© {{ date('Y') }} SMA N 1 Cepogo</div>
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
    @stack('scripts')
</body>
</html>


