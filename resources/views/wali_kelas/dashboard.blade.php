@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')

@section('content')
<style>
    /* Custom animations & transitions for premium look */
    .bar-chart-container {
        display: flex;
        justify-content: space-around;
        align-items: flex-end;
        height: 220px;
        padding-top: 20px;
    }
    .bar-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 80px;
        position: relative;
    }
    .bar-pill {
        width: 36px;
        border-radius: 8px 8px 0 0;
        transition: height 1s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .bar-label {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        margin-top: 10px;
        text-align: center;
        white-space: nowrap;
    }
    .bar-value {
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 6px;
    }
</style>

<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Top Header Card (Left border accent) -->
    <div class="bg-white dark:bg-slate-900 border-l-[6px] border-[#D65A20] border-y border-r border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Tinjauan Kelas {{ $classRoom->name }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 leading-relaxed">
                    Sistem Peringatan Dini (EWS) & Rekapitulasi Akademik Siswa. <span class="font-bold text-[#D65A20] bg-orange-50 dark:bg-orange-950/20 px-2 py-0.5 rounded text-xs ml-1">Mode Pemantauan.</span>
                </p>
            </div>
            <div class="text-right flex flex-col items-end">
                <span class="text-xxs font-extrabold text-slate-400 uppercase tracking-widest">Tahun Ajaran</span>
                <span class="text-lg font-bold text-[#D65A20] mt-0.5">{{ $classRoom->academic_year }}</span>
            </div>
        </div>
    </div>

    <!-- 3 Stat Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
        <!-- Card 1: Total Siswa -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-xl p-4 sm:p-5 flex items-center justify-between transition hover:shadow-md">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0 flex-1">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-sky-50 dark:bg-sky-950/30 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg sm:text-xl shadow-inner flex-shrink-0">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-xxs font-extrabold text-slate-400 uppercase tracking-wider block truncate">Total Siswa</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-800 dark:text-white block mt-0.5 truncate">{{ $stats['total_students'] }}</span>
                    <span class="text-[10px] sm:text-[11px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-950/20 px-2 py-0.5 rounded mt-1.5 inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span> Semua Aktif
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 2: Rata-Rata Akademik -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-xl p-4 sm:p-5 flex items-center justify-between transition hover:shadow-md">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0 flex-1">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg sm:text-xl shadow-inner flex-shrink-0">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-xxs font-extrabold text-slate-400 uppercase tracking-wider block truncate">Rata-Rata Akademik</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-800 dark:text-white block mt-0.5 truncate">{{ $averageGrade }}</span>
                    <span class="text-[10px] sm:text-[11px] font-semibold text-slate-500 dark:text-slate-400 block mt-1 truncate">Skala 100</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Kasus SSL (Terkunci) -->
        <div class="bg-[#fef2f2] dark:bg-red-950/10 border border-red-100 dark:border-red-900/30 shadow-sm rounded-xl p-4 sm:p-5 flex items-center justify-between transition hover:shadow-md">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0 flex-1">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-red-100 dark:bg-red-950/40 text-red-600 dark:text-red-400 flex items-center justify-center text-lg sm:text-xl shadow-inner flex-shrink-0">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="text-xxs font-extrabold text-red-500 dark:text-red-400 uppercase tracking-wider block truncate">Kasus SSL (Terkunci)</span>
                    <span class="text-xl sm:text-2xl font-black text-red-600 dark:text-red-400 block mt-0.5 truncate">{{ $totalSslLockedCount }}</span>
                    <span class="text-[10px] sm:text-[11px] font-bold text-red-500 dark:text-red-400 block mt-1 truncate">Siswa</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section: Two Columns -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left: Tren Kedisiplinan -->
        <div class="lg:col-span-5 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-base font-extrabold text-slate-800 dark:text-white tracking-tight">Tren Kedisiplinan</h3>
                <p class="text-xs text-slate-400 font-medium">Bulan Juni 2026</p>
            </div>
            
            <!-- Animated CSS Bar Chart -->
            <div class="bar-chart-container mt-6">
                <!-- Bar 1: Tepat Waktu -->
                <div class="bar-item">
                    <span class="bar-value text-emerald-600 dark:text-emerald-400">{{ $onTimePercent }}%</span>
                    <div class="bar-pill bg-emerald-500 dark:bg-emerald-600" style="height: {{ $onTimeHeight }}px;"></div>
                    <span class="bar-label dark:text-slate-400">Tepat Waktu</span>
                </div>
                
                <!-- Bar 2: Jalur SSL -->
                <div class="bar-item">
                    <span class="bar-value text-amber-600 dark:text-amber-400">{{ $sslPercent }}%</span>
                    <div class="bar-pill bg-amber-500 dark:bg-amber-600" style="height: {{ $sslHeight }}px;"></div>
                    <span class="bar-label dark:text-slate-400">Jalur SSL</span>
                </div>
                
                <!-- Bar 3: Diblokir -->
                <div class="bar-item">
                    <span class="bar-value text-red-600 dark:text-red-400">{{ $blockedPercent }}%</span>
                    <div class="bar-pill bg-red-500 dark:bg-red-600" style="height: {{ $blockedHeight }}px;"></div>
                    <span class="bar-label dark:text-slate-400">Diblokir</span>
                </div>
            </div>
            
            <div class="border-t border-slate-50 dark:border-slate-800/80 pt-4 mt-6 flex justify-between items-center text-xxs font-extrabold text-slate-400 uppercase tracking-widest">
                <span>Total Pemantauan</span>
                <span class="text-slate-700 dark:text-slate-300">100% Data Siswa</span>
            </div>
        </div>

        <!-- Right: Early Warning System (EWS) -->
        <div class="lg:col-span-7 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div class="mb-4">
                <h3 class="text-base font-extrabold text-slate-800 dark:text-white tracking-tight">Early Warning System (EWS)</h3>
                <p class="text-xs text-slate-400 font-medium">Siswa melampaui batas toleransi (&ge;3 Tugas)</p>
            </div>
            
            <!-- Header labels -->
            <div class="flex justify-between items-center text-xxs font-extrabold text-slate-400 uppercase tracking-wider px-2 mb-3">
                <span>Identitas Siswa & Kendala</span>
                <span>Status SSL</span>
            </div>

            <!-- Student Appeals Table/List (Scrollable) -->
            <div class="space-y-3 flex-1 overflow-y-auto max-h-[280px] pr-1">
                @forelse($ewsStudents as $student)
                <div class="flex items-center justify-between p-3.5 rounded-xl border border-slate-100 dark:border-slate-800 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center font-extrabold text-sm shadow-sm flex-shrink-0">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-slate-800 dark:text-slate-200">{{ $student->name }}</p>
                            <p class="text-xs text-slate-400 font-medium mt-0.5">
                                Menunggak <span class="font-bold text-red-500">{{ $student->tunggakan_count }} Tugas</span> &bull; {{ $student->subject_name }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Badges matching mockup -->
                    <div>
                        @if($student->appeal_status === 'Menunggu Guru')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xxs font-extrabold bg-amber-50 text-amber-700 border border-amber-150 dark:bg-amber-950/20 dark:text-amber-400 dark:border-amber-900/30">
                                Menunggu Guru
                            </span>
                        @elseif($student->appeal_status === 'Banding Ditolak')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xxs font-extrabold bg-red-50 text-red-700 border border-red-150 dark:bg-red-950/20 dark:text-red-400 dark:border-red-900/30">
                                Banding Ditolak
                            </span>
                        @elseif($student->appeal_status === 'Banding Diterima')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xxs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-150 dark:bg-emerald-950/20 dark:text-emerald-400 dark:border-emerald-900/30">
                                Banding Diterima
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xxs font-extrabold bg-slate-100 text-slate-600 border border-slate-200 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-700">
                                Belum Mengajukan
                            </span>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-center text-slate-400 text-sm py-8 font-medium">Tidak ada siswa yang melampaui batas toleransi tugas.</p>
                @endforelse
            </div>
            
            <!-- Info Alert Box -->
            <div class="mt-4 p-3.5 bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 rounded-xl flex gap-3">
                <i class="fas fa-info-circle text-slate-400 mt-0.5 text-sm flex-shrink-0"></i>
                <p class="text-xxs font-semibold text-slate-500 dark:text-slate-400 leading-relaxed">
                    Wali kelas memiliki hak <span class="font-extrabold text-[#D65A20]">Read Only</span> pada modul ini. Persetujuan SSL menjadi wewenang penuh Guru Mata Pelajaran bersangkutan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
