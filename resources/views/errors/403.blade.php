<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Akses Ditolak - {{ config('app.name', 'SMANSAGO') }}</title>
    <link rel="icon" href="{{ asset('assets/logo/logo.png') }}" type="image/png">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 min-h-screen flex items-center justify-center relative overflow-hidden">
    
    <div class="absolute -top-24 -right-24 w-72 h-72 bg-red-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-orange-500/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-lg w-full px-6 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 dark:bg-red-900/30 text-red-500 mb-8">
            <i class="fas fa-lock text-4xl"></i>
        </div>
        
        <h1 class="text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-500 mb-4 tracking-tight">403</h1>
        <h2 class="text-2xl font-bold mb-4">Akses Ditolak</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-8">Maaf, Anda tidak memiliki hak akses atau izin yang diperlukan untuk melihat halaman ini.</p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="javascript:history.back()" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ url('/') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-orange-500 text-white font-semibold hover:from-red-600 hover:to-orange-600 transition shadow-sm shadow-red-500/20">
                <i class="fas fa-home mr-2"></i> Ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
