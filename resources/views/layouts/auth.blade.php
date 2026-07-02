<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Pembayaran') }} - @yield('title', 'Authentication')</title>
    <link rel="icon" href="{{ asset('assets/logo/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-800 dark:text-slate-100">
    <main class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-slate-50 dark:bg-slate-950"></div>
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-sky-500/10 rounded-full blur-3xl"></div>

        <div class="relative min-h-screen flex items-center justify-center px-6 py-16">
            <div class="w-full max-w-5xl grid lg:grid-cols-2 gap-8 items-stretch">
                <div class="hidden lg:flex flex-col justify-between rounded-3xl bg-gradient-to-br from-teal-600 to-sky-600 text-white p-10 shadow-xl">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center mb-6">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h2 class="text-3xl font-semibold mb-3">EduLearn</h2>
                        <p class="text-white/80">Kelola aktivitas akademik, penilaian, dan administrasi sekolah dalam satu platform.</p>
                    </div>
                    <div class="text-sm text-white/70">
                        Aman, cepat, dan mudah digunakan untuk guru, siswa, dan admin.
                    </div>
                </div>

                <div class="glass p-8 md:p-10 shadow-xl">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="relative px-6 pb-8">
            @include('components.footer')
        </div>

        @include('components.loading-overlay')
    </main>

    @stack('scripts')
</body>
</html>
