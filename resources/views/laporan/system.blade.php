@extends('layouts.app')

@section('title', 'Laporan Sistem')

@section('content')
<!-- Custom Styles for UI Redesign -->
<style>
    .btn-orange-outline {
        border: 1px solid #D65A20 !important;
        color: #D65A20 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-outline:hover {
        background-color: rgba(214, 90, 32, 0.05) !important;
    }
    .btn-red-outline {
        border: 1px solid #EF4444 !important;
        color: #EF4444 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-red-outline:hover {
        background-color: rgba(239, 68, 68, 0.05) !important;
    }
    .btn-orange-solid {
        background-color: #D65A20 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-solid:hover {
        background-color: #be4e1a !important;
    }
</style>

<!-- Toast Notification -->
@if(session('success'))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Laporan Sistem</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola dan cetak laporan sistem E-Learning SMAN 1 Cepogo.</p>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="flex border-b border-slate-200 dark:border-slate-800 mb-6 gap-2">
        <button onclick="switchTab('download')" id="tab-download" class="px-5 py-3 text-sm font-bold border-b-2 border-[#D65A20] text-[#D65A20] focus:outline-none transition">
            🎲 Unduh Laporan
        </button>
        <button onclick="switchTab('summary')" id="tab-summary" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
            📊 Ringkasan & Log Laporan
        </button>
    </div>

    <!-- ==========================================
          TAB 1: DOWNLOAD CARDS (laporan.png mockup)
         ========================================== -->
    <div id="tab-content-download" class="space-y-6">
        <!-- Date range selector -->
        <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm mb-6 flex flex-wrap items-center gap-4">
            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Rentang Waktu:</span>
            <div class="flex items-center gap-2">
                <input type="text" value="01/01/2026" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-700 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 w-28 text-center" />
                <span class="text-xs text-slate-500">s/d</span>
                <input type="text" value="31/12/2026" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-700 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 w-28 text-center" />
            </div>
            <button onclick="applyDateFilter()" class="btn border border-slate-200 bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2 rounded-xl text-xs font-bold transition">Terapkan</button>
        </div>

        <!-- 4 Reports Card Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
                <div class="flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 dark:bg-rose-950/20 dark:text-rose-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fas fa-scale-unbalanced"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Laporan Kepatuhan & Tunggakan</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Data siswa dengan tunggakan tugas terbanyak serta rekapitulasi status penguncian (SSL).</p>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-50 dark:border-slate-800/60 flex items-center gap-3">
                    <button onclick="downloadReport('PDF', 'Kepatuhan & Tunggakan')" class="btn bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-rose-100">
                        <span>Unduh PDF</span>
                    </button>
                    <button onclick="downloadReport('Excel', 'Kepatuhan & Tunggakan')" class="btn bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-emerald-100">
                        <span>Unduh Excel</span>
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
                <div class="flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/20 dark:text-blue-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Rekapitulasi Penugasan Guru</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Statistik jumlah materi dan tugas yang diunggah oleh tenaga pendidik per mata pelajaran.</p>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-50 dark:border-slate-800/60 flex items-center gap-3">
                    <button onclick="downloadReport('PDF', 'Penugasan Guru')" class="btn bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-rose-100">
                        <span>Unduh PDF</span>
                    </button>
                    <button onclick="downloadReport('Excel', 'Penugasan Guru')" class="btn bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-emerald-100">
                        <span>Unduh Excel</span>
                    </button>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
                <div class="flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 dark:bg-amber-950/20 dark:text-amber-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fas fa-clipboard-question"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Laporan Riwayat Banding Akses</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Rekam jejak pengajuan banding keterlambatan siswa, rasio disetujui, dan ditolak oleh guru.</p>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-50 dark:border-slate-800/60 flex items-center gap-3">
                    <button onclick="downloadReport('PDF', 'Banding Akses')" class="btn bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-rose-100">
                        <span>Unduh PDF</span>
                    </button>
                    <button onclick="downloadReport('Excel', 'Banding Akses')" class="btn bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-emerald-100">
                        <span>Unduh Excel</span>
                    </button>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
                <div class="flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fas fa-database"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Laporan Data Master Akademik</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">Cetak rekapitulasi data induk yang mencakup data seluruh siswa, guru, kelas, dan mapel aktif.</p>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-slate-50 dark:border-slate-800/60 flex items-center gap-3">
                    <button onclick="downloadReport('PDF', 'Master Akademik')" class="btn bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-rose-100">
                        <span>Unduh PDF</span>
                    </button>
                    <button onclick="downloadReport('Excel', 'Master Akademik')" class="btn bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-bold px-4 py-2 rounded-xl text-xs transition duration-150 flex items-center gap-1.5 border border-emerald-100">
                        <span>Unduh Excel</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
          TAB 2: SUMMARY & STATS (text requirements)
         ========================================== -->
    <div id="tab-content-summary" class="space-y-6 hidden">
        <!-- Statistics cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <!-- Total Siswa -->
            <div class="stat-card border-l-4 border-l-[#D65A20] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Siswa</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ \App\Models\Siswa::where('status', 'aktif')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>

            <!-- Total Guru -->
            <div class="stat-card border-l-4 border-l-[#3B82F6] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Guru</p>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ \App\Models\Guru::where('status', 'aktif')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/20 dark:text-blue-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>

            <!-- Total Kelas -->
            <div class="stat-card border-l-4 border-l-[#00B074] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Kelas</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ \App\Models\Kelas::count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-school"></i>
                </div>
            </div>

            <!-- Total Mapel -->
            <div class="stat-card border-l-4 border-l-purple-500 bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Mata Pelajaran</p>
                    <p class="text-2xl font-bold text-purple-600 mt-1">{{ \App\Models\JadwalPelajaran::count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-950/20 dark:text-purple-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-book-open"></i>
                </div>
            </div>
        </div>

        <!-- Toolbar (Filters & Actions) -->
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4 mt-6">
            <!-- Left Filters -->
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <!-- Search box -->
                <div class="relative w-full sm:w-64">
                    <input type="text" id="toolbarSearch" placeholder="Cari laporan..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>

                <!-- Year filter -->
                <div class="relative w-full sm:w-44">
                    <select id="filterTahun" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold">
                        <option value="">Semua Tahun Ajaran</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2024/2025">2024/2025</option>
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <!-- Class filter -->
                <div class="relative w-full sm:w-40">
                    <select id="filterKelas" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold">
                        <option value="">Semua Kelas</option>
                        @php
                            $classList = \App\Models\Kelas::orderBy('name')->get();
                        @endphp
                        @foreach($classList as $kelas)
                            <option value="{{ $kelas->name }}">{{ $kelas->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex flex-wrap items-center gap-2.5">
                <button onclick="downloadExcelReport('General')" class="btn btn-orange-outline font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2 text-xs">
                    <span>↓ Download Excel</span>
                </button>
                <button onclick="downloadPdfReport('General')" class="btn btn-red-outline font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2 text-xs">
                    <span>↓ Download PDF</span>
                </button>
                <button onclick="printReport('General')" class="btn btn-orange-solid font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                    <span>Cetak Laporan</span>
                </button>
            </div>
        </div>

        <!-- Main Table View -->
        <div class="card p-0 overflow-hidden bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm mt-6">
            <div class="overflow-x-auto">
                <table id="laporanTable" class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-6 py-4 text-left font-bold text-slate-600 dark:text-slate-400 w-16">No</th>
                            <th class="px-6 py-4 text-left font-bold text-slate-600 dark:text-slate-400">Jenis Laporan</th>
                            <th class="px-6 py-4 text-left font-bold text-slate-600 dark:text-slate-400">Periode</th>
                            <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Jumlah Data</th>
                            <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Status</th>
                            <th class="px-6 py-4 text-right font-bold text-slate-600 dark:text-slate-400 w-64">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">1</td>
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">Laporan Kepatuhan & Tunggakan</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">Semester Ganjil 2025/2026</td>
                            <td class="px-6 py-4 text-center text-slate-700 dark:text-slate-300 font-semibold">{{ $submissionsCount }} Data</td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="openDetailModal('Laporan Kepatuhan & Tunggakan', '{{ $submissionsCount }} Data', 'Semester Ganjil 2025/2026')" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition">
                                        Detail
                                    </button>
                                    <button onclick="downloadReport('Excel', 'Kepatuhan & Tunggakan')" class="px-3.5 py-1.5 text-xs font-semibold text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 bg-white hover:bg-blue-600 rounded-lg transition">
                                        Unduh
                                    </button>
                                    <button onclick="printReport('Kepatuhan & Tunggakan')" class="px-3.5 py-1.5 text-xs font-semibold text-[#D65A20] hover:text-white border border-[#D65A20]/30 hover:border-[#D65A20] bg-white hover:bg-[#D65A20] rounded-lg transition">
                                        Cetak
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">2</td>
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">Rekapitulasi Penugasan Guru</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">Semester Ganjil 2025/2026</td>
                            <td class="px-6 py-4 text-center text-slate-700 dark:text-slate-300 font-semibold">{{ $assignmentsCount }} Data</td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="openDetailModal('Rekapitulasi Penugasan Guru', '{{ $assignmentsCount }} Data', 'Semester Ganjil 2025/2026')" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition">
                                        Detail
                                    </button>
                                    <button onclick="downloadReport('Excel', 'Penugasan Guru')" class="px-3.5 py-1.5 text-xs font-semibold text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 bg-white hover:bg-blue-600 rounded-lg transition">
                                        Unduh
                                    </button>
                                    <button onclick="printReport('Penugasan Guru')" class="px-3.5 py-1.5 text-xs font-semibold text-[#D65A20] hover:text-white border border-[#D65A20]/30 hover:border-[#D65A20] bg-white hover:bg-[#D65A20] rounded-lg transition">
                                        Cetak
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">3</td>
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">Laporan Riwayat Banding Akses</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">Tahun Ajaran 2025/2026</td>
                            <td class="px-6 py-4 text-center text-slate-700 dark:text-slate-300 font-semibold">{{ $appealsCount }} Data</td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="openDetailModal('Laporan Riwayat Banding Akses', '{{ $appealsCount }} Data', 'Tahun Ajaran 2025/2026')" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition">
                                        Detail
                                    </button>
                                    <button onclick="downloadReport('Excel', 'Banding Akses')" class="px-3.5 py-1.5 text-xs font-semibold text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 bg-white hover:bg-blue-600 rounded-lg transition">
                                        Unduh
                                    </button>
                                    <button onclick="printReport('Banding Akses')" class="px-3.5 py-1.5 text-xs font-semibold text-[#D65A20] hover:text-white border border-[#D65A20]/30 hover:border-[#D65A20] bg-white hover:bg-[#D65A20] rounded-lg transition">
                                        Cetak
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">4</td>
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">Laporan Data Master Akademik</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">Tahun Ajaran 2025/2026</td>
                            @php
                                $totalMasterCount = \App\Models\Siswa::count() + \App\Models\Guru::count() + \App\Models\Kelas::count();
                            @endphp
                            <td class="px-6 py-4 text-center text-slate-700 dark:text-slate-300 font-semibold">{{ $totalMasterCount }} Data</td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="openDetailModal('Laporan Data Master Akademik', '{{ $totalMasterCount }} Data', 'Tahun Ajaran 2025/2026')" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition">
                                        Detail
                                    </button>
                                    <button onclick="downloadReport('Excel', 'Master Akademik')" class="px-3.5 py-1.5 text-xs font-semibold text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 bg-white hover:bg-blue-600 rounded-lg transition">
                                        Unduh
                                    </button>
                                    <button onclick="printReport('Master Akademik')" class="px-3.5 py-1.5 text-xs font-semibold text-[#D65A20] hover:text-white border border-[#D65A20]/30 hover:border-[#D65A20] bg-white hover:bg-[#D65A20] rounded-lg transition">
                                        Cetak
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">5</td>
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">Arsip Laporan E-Learning 2024/2025</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">Semester Genap 2024/2025</td>
                            <td class="px-6 py-4 text-center text-slate-700 dark:text-slate-300 font-semibold">1,024 Data</td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-slate-100 text-slate-600 text-xs font-semibold px-2.5 py-1 rounded-full">Arsip</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="openDetailModal('Arsip Laporan E-Learning 2024/2025', '1,024 Data', 'Semester Genap 2024/2025')" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition">
                                        Detail
                                    </button>
                                    <button onclick="downloadReport('Excel', 'Arsip 2024/2025')" class="px-3.5 py-1.5 text-xs font-semibold text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 bg-white hover:bg-blue-600 rounded-lg transition">
                                        Unduh
                                    </button>
                                    <button onclick="printReport('Arsip 2024/2025')" class="px-3.5 py-1.5 text-xs font-semibold text-[#D65A20] hover:text-white border border-[#D65A20]/30 hover:border-[#D65A20] bg-white hover:bg-[#D65A20] rounded-lg transition">
                                        Cetak
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: DETAIL LAPORAN
     ========================================== -->
<div id="modalDetailLaporan" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#D65A20]">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-file-invoice mr-2"></i>Detail Laporan Sistem</h3>
            <button onclick="closeDetailModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Content -->
        <div class="p-6 space-y-4">
            <div>
                <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Jenis Laporan</span>
                <span id="detailJenisLaporan" class="text-sm font-bold text-slate-800 dark:text-slate-100 block mt-1">Laporan Kepatuhan & Tunggakan</span>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Periode</span>
                    <span id="detailPeriode" class="text-xs font-semibold text-slate-700 dark:text-slate-300 block mt-1">Semester Ganjil 2025/2026</span>
                </div>
                <div>
                    <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Jumlah Data</span>
                    <span id="detailJumlahData" class="text-xs font-semibold text-slate-700 dark:text-slate-300 block mt-1">150 Data</span>
                </div>
            </div>
            <div>
                <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Institusi / Sekolah</span>
                <span class="text-xs font-semibold text-slate-700 dark:text-slate-300 block mt-1">{{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}</span>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeDetailModal()" class="px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition">Batal</button>
                <button type="button" onclick="printReport(document.getElementById('detailJenisLaporan').innerText)" class="btn btn-orange-solid px-4 py-2 rounded-xl text-xs font-semibold transition">Cetak</button>
                <button type="button" onclick="downloadReport('PDF', document.getElementById('detailJenisLaporan').innerText)" class="px-4 py-2 bg-white hover:bg-red-50 border border-red-500 text-red-500 rounded-xl text-xs font-semibold transition">Unduh PDF</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Tab switching controls
    function switchTab(tab) {
        if (tab === 'download') {
            $('#tab-download').addClass('border-[#D65A20] text-[#D65A20]').removeClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200');
            $('#tab-summary').addClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200').removeClass('border-[#D65A20] text-[#D65A20]');
            $('#tab-content-download').removeClass('hidden');
            $('#tab-content-summary').addClass('hidden');
        } else {
            $('#tab-summary').addClass('border-[#D65A20] text-[#D65A20]').removeClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200');
            $('#tab-download').addClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200').removeClass('border-[#D65A20] text-[#D65A20]');
            $('#tab-content-summary').removeClass('hidden');
            $('#tab-content-download').addClass('hidden');
        }
    }

    // Modal controls
    function openDetailModal(jenis, jumlah, periode) {
        document.getElementById('detailJenisLaporan').innerText = jenis;
        document.getElementById('detailJumlahData').innerText = jumlah;
        document.getElementById('detailPeriode').innerText = periode;
        $('#modalDetailLaporan').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }

    function closeDetailModal() {
        $('#modalDetailLaporan').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Actions mockups
    function applyDateFilter() {
        alert('Rentang waktu berhasil diterapkan! Menampilkan laporan tahun 2026.');
    }

    function downloadReport(format, title) {
        alert('Mengunduh ' + title + ' dalam format ' + format + '...');
    }

    function printReport(title) {
        alert('Mencetak dokumen: ' + title);
    }

    function downloadExcelReport(type) {
        alert('Mengunduh Laporan ' + type + ' dalam format Excel...');
    }

    function downloadPdfReport(type) {
        alert('Mengunduh Laporan ' + type + ' dalam format PDF...');
    }

    $(document).ready(function() {
        // Table filtering bindings
        const table = $('#laporanTable').DataTable({
            dom: 'rtip',
            language: {
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                zeroRecords: "Tidak ditemukan data laporan yang sesuai",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            },
            responsive: true,
            order: [[ 0, "asc" ]]
        });

        $('#toolbarSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#filterTahun').on('change', function() {
            table.column(2).search(this.value).draw();
        });
    });
</script>
@endpush
@endsection
