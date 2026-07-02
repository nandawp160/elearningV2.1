@extends('layouts.app')

@section('content')
<!-- Background Image (Absolute untuk menembus batas max-width, tapi tetap punya space/margin konstan di sekelilingnya) -->
<div class="absolute top-[85px] md:top-[95px] left-4 right-4 md:left-8 md:right-8 h-[370px] md:h-[540px] z-0 rounded-3xl overflow-hidden shadow-2xl ring-1 ring-white/10 group">
    <!-- Gambar dengan filter 'Matte Film' (Brightness diturunkan sedikit agar lebih estetis) -->
    <img src="{{ asset('assets/images/landing2.jpg') }}" alt="Pemandangan Sekolah" class="absolute inset-0 w-full h-full object-cover object-center brightness-90 contrast-[0.95] saturate-[1.1] sepia-[0.15] hue-rotate-[-5deg] transition-transform duration-1000 group-hover:scale-105">
    
    <!-- Efek 'Light Leak' (Cahaya Bocor khas kamera analog) -->
    <div class="absolute inset-0 bg-gradient-to-tr from-amber-500/30 via-transparent to-rose-500/20 mix-blend-screen opacity-80"></div>
    
    <!-- Efek Cinematic Shadows (Dipergelap sedikit dari sebelumnya untuk kontras yang lebih baik) -->
    <div class="absolute inset-0 bg-gradient-to-b from-slate-900/20 via-slate-900/40 to-slate-900/70 mix-blend-multiply"></div>

    <!-- Tipografi & Layout (Glassmorphism & Clean DKV Style) -->
    <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
        <!-- Kotak Kaca Fros / Frosted Glass -->
        <div class="max-w-2xl mt-8 md:mt-16 backdrop-blur-md bg-white/5 border border-white/20 p-8 md:p-10 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.12)] transition-all duration-500 hover:bg-white/10">
            <h2 class="text-white/95 text-sm md:text-base lg:text-lg font-light tracking-wide leading-relaxed mb-6" style="text-shadow: 0 2px 10px rgba(0,0,0,0.4);">
                "Tujuan paling utama dari pendidikan adalah untuk menciptakan manusia yang mampu melakukan hal-hal baru di masa depan, bukan sekadar mengulangi apa yang telah dilakukan oleh generasi masa lalu."
            </h2>
            <div class="flex items-center justify-center gap-4">
                <div class="h-[1px] w-12 bg-white/40"></div>
                <p class="text-white font-bold tracking-[0.25em] uppercase text-[10px] md:text-xs" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                    Jean Piaget
                </p>
                <div class="h-[1px] w-12 bg-white/40"></div>
            </div>
        </div>
    </div>
</div>

<!-- Area Informasi Kontak (Di Bawah Gambar, dibuat lebih menempel) -->
<div class="relative z-10 mt-[380px] md:mt-[530px] pb-10 flex flex-wrap items-center justify-center gap-8 md:gap-16 text-slate-600 dark:text-slate-400">
    <a href="#" class="flex items-center gap-3 hover:text-sky-600 dark:hover:text-sky-400 transition-colors group">
        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 flex items-center justify-center group-hover:border-sky-300 dark:group-hover:border-sky-700 transition-colors">
            <i class="fas fa-globe text-sky-500"></i>
        </div>
        <span class="font-medium text-sm">www.sman1cepogo.sch.id</span>
    </a>
    
    <a href="#" class="flex items-center gap-3 hover:text-rose-500 dark:hover:text-rose-400 transition-colors group">
        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 flex items-center justify-center group-hover:border-rose-300 dark:group-hover:border-rose-700 transition-colors">
            <i class="fab fa-instagram text-rose-500"></i>
        </div>
        <span class="font-medium text-sm">@sman1cepogo</span>
    </a>
    
    <a href="#" class="flex items-center gap-3 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors group">
        <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 flex items-center justify-center group-hover:border-emerald-300 dark:group-hover:border-emerald-700 transition-colors">
            <i class="fas fa-phone-alt text-emerald-500"></i>
        </div>
        <span class="font-medium text-sm">(0276) 324155</span>
    </a>
</div>
@endsection
