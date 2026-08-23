@extends('layouts.app')

@section('title', 'Pengampuan Guru (Plotting Hak Akses)')

@section('content')
<!-- Custom Styles -->
<style>
    /* DataTables Pagination Override */
    .dataTables_wrapper .dataTables_paginate {
        display: inline-flex !important;
        gap: 0.25rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        color: #475569 !important;
        border-radius: 0.5rem !important;
        padding: 0.4rem 0.75rem !important;
        font-size: 0.825rem !important;
        font-weight: 500 !important;
        transition: all 0.15s ease !important;
        cursor: pointer !important;
        margin: 0 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) {
        background: #f8fafc !important;
        border-color: #cbd5e1 !important;
        color: #1e293b !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #D65A20 !important;
        border-color: #D65A20 !important;
        color: #ffffff !important;
        font-weight: 600 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        background: #f8fafc !important;
        border-color: #e2e8f0 !important;
        color: #94a3b8 !important;
        cursor: not-allowed !important;
        opacity: 0.6 !important;
    }
    .dataTables_wrapper .dataTables_info {
        color: #64748b !important;
        font-size: 0.825rem !important;
        font-weight: 500 !important;
    }
    .dt-buttons {
        display: none !important;
    }
    
    .btn-orange-solid {
        background-color: #D65A20 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-solid:hover {
        background-color: #be4e1a !important;
    }
    .btn-orange-outline {
        border: 1px solid #D65A20 !important;
        color: #D65A20 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-outline:hover {
        background-color: rgba(214, 90, 32, 0.05) !important;
    }

    /* Custom Scrollbar for Comboboxes */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 9999px;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #475569;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Active Combobox Trigger Ring */
    .combobox-active-ring {
        border-color: #D65A20 !important;
        box-shadow: 0 0 0 3px rgba(214, 90, 32, 0.15) !important;
    }
</style>

<!-- Toast Notification -->
@if(session('success'))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-2xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('error'))
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-2xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Pengampuan Guru</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola pengampuan (hak akses) Guru, Kelas, dan Mata Pelajaran secara manual maupun otomatis.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button type="button" onclick="document.getElementById('autoPlotModal').classList.remove('hidden')" class="btn-orange-outline font-bold px-4 py-2.5 rounded-xl shadow-sm text-sm flex items-center gap-2">
                <i class="fas fa-magic"></i> Auto-Plot Kelas X (18 Mapel)
            </button>
        </div>
    </div>

    <!-- Summary Metrics & Monitoring Coverage Audit (Sesuai Laporan) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm border-l-4 border-l-blue-500 flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Rombel Kelas</p>
                <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ count($classes) }} <span class="text-xs text-slate-400 font-normal">Kelas</span></p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-base">
                <i class="fas fa-school"></i>
            </div>
        </div>

        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm border-l-4 border-l-emerald-500 flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas Lengkap Mapel</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1"><span id="metricCompleteCount">{{ $completeClassesCount }}</span> <span class="text-xs text-slate-400 font-normal">Kelas</span></p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-base">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <div class="p-5 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm border-l-4 border-l-amber-500 flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas Belum Lengkap</p>
                <p class="text-2xl font-bold text-amber-600 mt-1"><span id="metricIncompleteCount">{{ $incompleteClassesCount }}</span> <span class="text-xs text-slate-400 font-normal">Kelas</span></p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-base">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>

    <!-- Monitoring Distribusi Mapel per Kelas (Raw, Real-Time & Transparan) -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-3xl p-4 sm:p-5 shadow-xs transition-all">
        <!-- Header Banner (Clickable Toggle) -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 cursor-pointer select-none group" onclick="toggleMonitoringPanel()">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-orange-500/10 text-[#D65A20] dark:bg-orange-500/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0 group-hover:scale-105 transition-transform">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 class="font-extrabold text-sm text-slate-800 dark:text-white group-hover:text-[#D65A20] transition">Monitoring Distribusi Mapel per Kelas</h4>
                        <span class="px-2.5 py-0.5 rounded-full bg-orange-100 text-orange-800 dark:bg-orange-950/60 dark:text-orange-300 text-[11px] font-bold">
                            {{ count($classes) }} Rombel
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-0.5">Rekapitulasi sebaran mata pelajaran dan guru pengampu yang aktif di seluruh rombel kelas (Tingkat X, XI, dan XII).</p>
                </div>
            </div>

            <!-- Action Toggle Button -->
            <div class="flex items-center gap-2 self-end sm:self-auto flex-shrink-0">
                <button type="button" class="px-3.5 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 group-hover:bg-orange-50 dark:group-hover:bg-slate-700 text-[#D65A20] text-xs font-bold transition flex items-center gap-1.5 pointer-events-none">
                    <span id="monToggleText">Lihat Rincian</span>
                    <i class="fas fa-chevron-down text-[10px] transition-transform duration-300" id="monToggleChevron"></i>
                </button>
            </div>
        </div>

        <!-- Collapsible Content (Hidden by default) -->
        <div id="monitoringContentContainer" class="hidden mt-4 pt-4 border-t border-slate-100 dark:border-slate-800 space-y-4 animate-fade-in">
            <!-- Filter Bar: Grade Tabs + Fast Search + Checklist All -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 border-b border-slate-100 dark:border-slate-800 pb-3">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-[11px] font-bold text-slate-400 mr-1 uppercase">Tingkat:</span>
                    <button type="button" onclick="filterMonitoringGrade('ALL', this)" class="mon-grade-btn px-3 py-1 rounded-xl bg-[#D65A20] text-white text-xs font-bold transition">Semua ({{ count($classes) }})</button>
                    <button type="button" onclick="filterMonitoringGrade('X', this)" class="mon-grade-btn px-3 py-1 rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 text-xs font-bold hover:bg-slate-200 transition">Kelas X ({{ $classes->where('grade_level', 'X')->count() }})</button>
                    <button type="button" onclick="filterMonitoringGrade('XI', this)" class="mon-grade-btn px-3 py-1 rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 text-xs font-bold hover:bg-slate-200 transition">Kelas XI ({{ $classes->where('grade_level', 'XI')->count() }})</button>
                    <button type="button" onclick="filterMonitoringGrade('XII', this)" class="mon-grade-btn px-3 py-1 rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 text-xs font-bold hover:bg-slate-200 transition">Kelas XII ({{ $classes->where('grade_level', 'XII')->count() }})</button>
                </div>

                <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                    <!-- Tombol Checklist All & Reset All -->
                    <button type="button" onclick="toggleChecklistAll(true, this)" 
                            id="btnChecklistAll"
                            class="px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-600 hover:text-white dark:bg-emerald-950/40 dark:text-emerald-400 dark:hover:bg-emerald-600 dark:hover:text-white border border-emerald-200 dark:border-emerald-800 text-xs font-extrabold transition flex items-center gap-1.5 shadow-2xs whitespace-nowrap"
                            title="Tandai seluruh rombel kelas sebagai Lengkap">
                        <i class="fas fa-check-double"></i>
                        <span>Checklist Semua</span>
                    </button>
                    <button type="button" onclick="toggleChecklistAll(false, this)"
                            id="btnUncheckAll" 
                            class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700 text-xs font-bold transition flex items-center gap-1 shadow-2xs whitespace-nowrap"
                            title="Reset status semua kelas menjadi Belum Lengkap">
                        <i class="fas fa-undo text-[10px]"></i>
                        <span>Reset</span>
                    </button>

                    <div class="relative w-full sm:w-56">
                        <input type="text" id="monSearchInput" onkeyup="filterMonitoringSearch()" placeholder="Cari kelas, mapel, guru..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-8 pr-3 py-1.5 text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-[#D65A20] focus:ring-1 focus:ring-[#D65A20] dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200" />
                        <div class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fas fa-search text-[11px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Class Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5" id="monKelasGrid">
                @foreach($kelasMonitoring as $km)
                    <div class="mon-class-card bg-slate-50/60 dark:bg-slate-800/40 p-4 rounded-2xl border border-slate-200/70 dark:border-slate-800 space-y-3 hover:border-orange-300 dark:hover:border-orange-900 transition shadow-2xs"
                         data-grade="{{ $km['grade_level'] }}"
                         data-name="{{ strtolower($km['kelas_name']) }}">
                        <!-- Card Header -->
                        <div class="flex items-center justify-between border-b border-slate-200/60 dark:border-slate-700/60 pb-2.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-orange-100 text-[#D65A20] dark:bg-orange-950/50 flex items-center justify-center text-xs font-extrabold shadow-2xs">
                                    <i class="fas fa-chalkboard"></i>
                                </div>
                                <div>
                                    <h5 class="font-extrabold text-sm text-slate-800 dark:text-white">{{ $km['kelas_name'] }}</h5>
                                    <span class="text-[10px] text-slate-400 font-semibold">Tingkat {{ $km['grade_level'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="text-right">
                                    <span class="px-2 py-0.5 rounded-md bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 text-xs font-extrabold border border-slate-200/80 dark:border-slate-700 shadow-2xs">
                                        {{ $km['total_mapel'] }} Mapel
                                    </span>
                                    <div class="text-[10px] text-slate-400 font-bold mt-0.5">{{ $km['total_jp'] }} JP</div>
                                </div>
                                <!-- Tombol Checklist Verifikasi Lengkap -->
                                <button type="button" 
                                        onclick="togglePlotVerified({{ $km['kelas_id'] }}, this)" 
                                        data-verified="{{ $km['is_complete'] ? '1' : '0' }}"
                                        title="{{ $km['is_complete'] ? 'Klik untuk membatalkan status lengkap' : 'Klik untuk menandai kelas ini telah lengkap plot mapelnya' }}"
                                        class="btn-toggle-verify px-2.5 py-1 rounded-xl text-[11px] font-extrabold transition-all flex items-center gap-1.5 shadow-2xs {{ $km['is_complete'] ? 'bg-emerald-500 hover:bg-emerald-600 text-white' : 'bg-slate-100 hover:bg-amber-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-500 hover:text-amber-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700' }}">
                                    <i class="{{ $km['is_complete'] ? 'fas fa-check-circle text-white' : 'far fa-circle text-slate-400' }}"></i>
                                    <span>{{ $km['is_complete'] ? 'Lengkap' : 'Tandai' }}</span>
                                </button>
                            </div>
                        </div>

                        <!-- Subjects List in Class -->
                        <div class="space-y-1.5 max-h-48 overflow-y-auto pr-1 custom-scrollbar mon-plot-list">
                            @forelse($km['plottings'] as $plot)
                                <div class="mon-plot-item flex items-center justify-between p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-xs"
                                     data-mapel="{{ strtolower($plot['mapel_nama']) }}"
                                     data-guru="{{ strtolower($plot['guru_nama']) }}">
                                    <div class="min-w-0 pr-2">
                                        <span class="font-bold text-slate-800 dark:text-slate-200 truncate block text-[11px]">{{ $plot['mapel_nama'] }}</span>
                                        <span class="text-[10px] text-slate-500 dark:text-slate-400 truncate block">{{ $plot['guru_nama'] }}</span>
                                    </div>
                                    <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-orange-50 text-[#D65A20] dark:bg-orange-950/40 dark:text-orange-300 flex-shrink-0">
                                        {{ $plot['beban_jp'] }} JP
                                    </span>
                                </div>
                            @empty
                                <div class="py-6 text-center text-xs text-slate-400 italic">
                                    Belum ada mapel di-plot untuk kelas ini
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @php
        // Helper metadata categorization for Subjects
        $getMapelMeta = function($nama) {
            $namaLower = strtolower($nama ?? '');
            if (str_contains($namaLower, 'matematika')) {
                $isLanjut = str_contains($namaLower, 'lanjut');
                return [
                    'icon' => 'fa-calculator',
                    'color' => 'text-blue-600 bg-blue-50 dark:bg-blue-950/40 border-blue-200',
                    'badge' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
                    'group' => $isLanjut ? 'MIPA' : 'Wajib'
                ];
            }
            if (str_contains($namaLower, 'fisika')) return ['icon' => 'fa-atom', 'color' => 'text-cyan-600 bg-cyan-50 dark:bg-cyan-950/40 border-cyan-200', 'badge' => 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900/40 dark:text-cyan-300', 'group' => 'MIPA'];
            if (str_contains($namaLower, 'kimia')) return ['icon' => 'fa-flask', 'color' => 'text-teal-600 bg-teal-50 dark:bg-teal-950/40 border-teal-200', 'badge' => 'bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-300', 'group' => 'MIPA'];
            if (str_contains($namaLower, 'biologi')) return ['icon' => 'fa-dna', 'color' => 'text-emerald-600 bg-emerald-50 dark:bg-emerald-950/40 border-emerald-200', 'badge' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300', 'group' => 'MIPA'];
            if (str_contains($namaLower, 'ekonomi')) return ['icon' => 'fa-chart-pie', 'color' => 'text-amber-600 bg-amber-50 dark:bg-amber-950/40 border-amber-200', 'badge' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300', 'group' => 'IPS'];
            if (str_contains($namaLower, 'geografi')) return ['icon' => 'fa-earth-asia', 'color' => 'text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 border-emerald-200', 'badge' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300', 'group' => 'IPS'];
            if (str_contains($namaLower, 'sosiologi')) return ['icon' => 'fa-users', 'color' => 'text-indigo-600 bg-indigo-50 dark:bg-indigo-950/40 border-indigo-200', 'badge' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300', 'group' => 'IPS'];
            if (str_contains($namaLower, 'sejarah')) return ['icon' => 'fa-landmark', 'color' => 'text-amber-800 bg-amber-50 dark:bg-amber-950/40 border-amber-200', 'badge' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'inggris')) {
                $isLanjut = str_contains($namaLower, 'lanjut');
                return [
                    'icon' => 'fa-language',
                    'color' => 'text-sky-600 bg-sky-50 dark:bg-sky-950/40 border-sky-200',
                    'badge' => 'bg-sky-100 text-sky-800 dark:bg-sky-900/40 dark:text-sky-300',
                    'group' => $isLanjut ? 'Bahasa' : 'Wajib'
                ];
            }
            if (str_contains($namaLower, 'indonesia')) {
                $isLanjut = str_contains($namaLower, 'lanjut');
                return [
                    'icon' => 'fa-book-atlas',
                    'color' => 'text-rose-600 bg-rose-50 dark:bg-rose-950/40 border-rose-200',
                    'badge' => 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300',
                    'group' => $isLanjut ? 'Bahasa' : 'Wajib'
                ];
            }
            if (str_contains($namaLower, 'agama') || str_contains($namaLower, 'islam')) return ['icon' => 'fa-mosque', 'color' => 'text-emerald-600 bg-emerald-50 dark:bg-emerald-950/40 border-emerald-200', 'badge' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'pancasila')) return ['icon' => 'fa-shield-halved', 'color' => 'text-red-600 bg-red-50 dark:bg-red-950/40 border-red-200', 'badge' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'jasmani') || str_contains($namaLower, 'pjok')) return ['icon' => 'fa-volleyball', 'color' => 'text-orange-600 bg-orange-50 dark:bg-orange-950/40 border-orange-200', 'badge' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/40 dark:text-orange-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'seni')) return ['icon' => 'fa-palette', 'color' => 'text-purple-600 bg-purple-50 dark:bg-purple-950/40 border-purple-200', 'badge' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'informatika')) return ['icon' => 'fa-laptop-code', 'color' => 'text-blue-600 bg-blue-50 dark:bg-blue-950/40 border-blue-200', 'badge' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'konseling') || str_contains($namaLower, 'bk')) return ['icon' => 'fa-comments', 'color' => 'text-teal-600 bg-teal-50 dark:bg-teal-950/40 border-teal-200', 'badge' => 'bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'daerah') || str_contains($namaLower, 'lokal')) return ['icon' => 'fa-feather-pointed', 'color' => 'text-amber-700 bg-amber-50 dark:bg-amber-950/40 border-amber-200', 'badge' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300', 'group' => 'Wajib'];
            if (str_contains($namaLower, 'prakarya')) return ['icon' => 'fa-lightbulb', 'color' => 'text-yellow-600 bg-yellow-50 dark:bg-yellow-950/40 border-yellow-200', 'badge' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300', 'group' => 'Terapan'];
            return ['icon' => 'fa-book-open', 'color' => 'text-slate-600 bg-slate-50 dark:bg-slate-950/40 border-slate-200', 'badge' => 'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300', 'group' => 'Umum'];
        };
    @endphp

    <!-- Plotting Form Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4"><i class="fas fa-user-plus text-[#D65A20] mr-2"></i>Tambah Pengampuan Manual</h2>
        <form action="{{ route('teaching-assignments.store') }}" method="POST" id="manualPlottingForm" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Select Guru (Custom Searchable Combobox) -->
                <div class="relative" id="guruComboboxWrapper">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                        <span>Guru Pengampu <span class="text-rose-500">*</span></span>
                        <span class="text-[11px] text-slate-400 font-normal">Cari & pilih guru pengajar</span>
                    </label>

                    <!-- Hidden Input for Form Submission -->
                    <input type="hidden" name="guru_id" id="guru_select" required value="">

                    <!-- Trigger Box -->
                    <div id="guruComboboxTrigger" onclick="toggleGuruDropdown(event)" tabindex="0"
                        class="w-full min-h-[48px] rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3.5 py-2 text-sm text-slate-700 dark:text-slate-200 cursor-pointer flex items-center justify-between transition-all hover:border-[#D65A20] focus:outline-none select-none shadow-2xs">
                        <div id="guruTriggerContent" class="flex items-center gap-2.5 min-w-0 pr-2">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xs flex-shrink-0">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <span class="text-slate-400 dark:text-slate-500 text-xs font-medium">-- Pilih Guru --</span>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0 text-slate-400">
                            <button type="button" id="clearGuruBtn" onclick="clearSelectedGuru(event)" class="hidden w-6 h-6 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400 hover:text-rose-500 flex items-center justify-center transition" title="Hapus pilihan guru">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="guruChevronIcon"></i>
                        </div>
                    </div>

                    <!-- Floating Dropdown Panel -->
                    <div id="guruDropdownMenu" class="hidden absolute z-30 left-0 right-0 mt-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-2xl p-3 space-y-2 animate-fade-in">
                        <!-- Search Box -->
                        <div class="relative">
                            <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="guruSearchInput" placeholder="Ketik nama guru atau spesialisasi..." onkeyup="filterGuruList()"
                                class="w-full pl-9 pr-8 py-2.5 text-xs rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:bg-white focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 transition" autocomplete="off" />
                            <button type="button" id="clearGuruSearchInputBtn" onclick="resetGuruSearch()" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>

                        <!-- Teacher List Container -->
                        <div class="max-h-64 overflow-y-auto space-y-1.5 pr-1 custom-scrollbar" id="guruListContainer">
                            @foreach($teachers as $guru)
                                @php
                                    $totalJp = $guru->calculated_jp ?? 0;
                                    $jpClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300';
                                    if ($totalJp < 24) $jpClass = 'bg-amber-100 text-amber-800 dark:bg-amber-950/50 dark:text-amber-300';
                                    elseif ($totalJp > 44) $jpClass = 'bg-rose-100 text-rose-800 dark:bg-rose-950/50 dark:text-rose-300';
                                @endphp
                                <div class="guru-item-card flex items-center justify-between p-2.5 rounded-xl border border-slate-100 dark:border-slate-800/80 hover:border-orange-300 dark:hover:border-orange-600/50 hover:bg-orange-50/60 dark:hover:bg-slate-800/80 cursor-pointer transition select-none group"
                                     data-id="{{ $guru->id }}"
                                     data-nama="{{ strtolower($guru->nama) }}"
                                     data-display-nama="{{ $guru->nama }}"
                                     data-spec="{{ strtolower($guru->spesialisasi ?? '') }}"
                                     data-display-spec="{{ $guru->spesialisasi ?? 'Umum' }}"
                                     data-jp="{{ $totalJp }}"
                                     onclick="selectGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}', '{{ addslashes($guru->spesialisasi ?? '') }}', {{ $totalJp }})">
                                    <div class="flex items-center gap-3 min-w-0 pr-2">
                                        <div class="w-8 h-8 rounded-xl bg-orange-100 text-[#D65A20] dark:bg-orange-950/50 dark:text-orange-300 flex items-center justify-center font-bold text-xs flex-shrink-0 group-hover:scale-105 transition-transform">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-1.5 flex-wrap">
                                                <h5 class="text-xs font-bold text-slate-800 dark:text-white truncate">{{ $guru->nama }}</h5>
                                                @if($guru->spesialisasi)
                                                    @php
                                                        $specs = array_map('trim', explode(',', $guru->spesialisasi));
                                                    @endphp
                                                    @foreach($specs as $sp)
                                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700">{{ $sp }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <p class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-2">
                                                <span>NIP: <span class="font-medium text-slate-600 dark:text-slate-300">{{ $guru->nip ?? '-' }}</span></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-md {{ $jpClass }}">
                                            {{ $totalJp }} JP
                                        </span>
                                        <div class="guru-check-icon hidden w-5 h-5 rounded-full bg-[#D65A20] text-white flex items-center justify-center text-[10px]">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Empty State -->
                        <div id="guruEmptyState" class="hidden py-6 text-center text-slate-400">
                            <i class="fas fa-user-slash text-2xl mb-1 text-slate-300 dark:text-slate-600"></i>
                            <p class="text-xs">Tidak ada nama guru atau spesialisasi yang cocok.</p>
                        </div>
                    </div>
                </div>

                <!-- Select Mata Pelajaran (Custom Searchable Combobox with Smart Recommendation) -->
                <div class="relative" id="mapelComboboxWrapper">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center justify-between">
                        <span>Mata Pelajaran <span class="text-rose-500">*</span></span>
                        <span class="text-[11px] text-slate-400 font-normal">Pilih mapel kurikulum yang diampu</span>
                    </label>

                    <!-- Hidden Input for Form Submission -->
                    <input type="hidden" name="mata_pelajaran_id" id="mapel_select" required value="">

                    <!-- Trigger Box -->
                    <div id="mapelComboboxTrigger" onclick="toggleMapelDropdown(event)" tabindex="0"
                        class="w-full min-h-[48px] rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3.5 py-2 text-sm text-slate-700 dark:text-slate-200 cursor-pointer flex items-center justify-between transition-all hover:border-[#D65A20] focus:outline-none select-none shadow-2xs">
                        <div id="mapelTriggerContent" class="flex items-center gap-2.5 min-w-0 pr-2">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xs flex-shrink-0">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <span class="text-slate-400 dark:text-slate-500 text-xs font-medium">-- Pilih Mapel --</span>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0 text-slate-400">
                            <button type="button" id="clearMapelBtn" onclick="clearSelectedMapel(event)" class="hidden w-6 h-6 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400 hover:text-rose-500 flex items-center justify-center transition" title="Hapus pilihan mapel">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" id="mapelChevronIcon"></i>
                        </div>
                    </div>

                    <!-- Floating Dropdown Panel -->
                    <div id="mapelDropdownMenu" class="hidden absolute z-30 left-0 right-0 mt-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-2xl p-3 space-y-2 animate-fade-in">
                        <!-- Search Box -->
                        <div class="relative">
                            <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="mapelSearchInput" placeholder="Ketik nama mata pelajaran (cth: Matematika, Kimia)..." onkeyup="filterMapelList()"
                                class="w-full pl-9 pr-8 py-2.5 text-xs rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:bg-white focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 transition" autocomplete="off" />
                            <button type="button" id="clearMapelSearchInputBtn" onclick="resetMapelSearch()" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>

                        <!-- Dynamic Recommendation Box (Highlighted when Teacher is selected) -->
                        <div id="mapelRecommendationContainer" class="hidden p-2.5 rounded-xl bg-orange-50/70 dark:bg-orange-950/30 border border-orange-200 dark:border-orange-900/50 space-y-1.5">
                            <div class="flex items-center justify-between px-1">
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#D65A20] flex items-center gap-1.5">
                                    <i class="fas fa-star text-amber-500"></i> Rekomendasi Sesuai Spesialisasi Guru
                                </span>
                            </div>
                            <div id="mapelRecommendationList" class="space-y-1">
                                <!-- Injected dynamically via JS -->
                            </div>
                        </div>

                        <!-- Subjects List Container -->
                        <div class="max-h-64 overflow-y-auto space-y-1.5 pr-1 custom-scrollbar" id="mapelListContainer">
                            @foreach($subjects as $mapel)
                                @php
                                    $meta = $getMapelMeta($mapel->nama);
                                @endphp
                                <div class="mapel-item-card flex items-center justify-between p-2.5 rounded-xl border border-slate-100 dark:border-slate-800/80 hover:border-orange-300 dark:hover:border-orange-600/50 hover:bg-orange-50/60 dark:hover:bg-slate-800/80 cursor-pointer transition select-none group"
                                     data-id="{{ $mapel->id }}"
                                     data-nama="{{ strtolower($mapel->nama) }}"
                                     data-display-nama="{{ $mapel->nama }}"
                                     data-jp="{{ $mapel->beban_jp ?? 0 }}"
                                     data-group="{{ $meta['group'] }}"
                                     data-icon="{{ $meta['icon'] }}"
                                     data-color="{{ $meta['color'] }}"
                                     data-badge="{{ $meta['badge'] }}"
                                     onclick="selectMapel({{ $mapel->id }}, '{{ addslashes($mapel->nama) }}', '{{ $meta['group'] }}', {{ $mapel->beban_jp ?? 0 }}, '{{ $meta['icon'] }}', '{{ $meta['color'] }}', '{{ $meta['badge'] }}')">
                                    <div class="flex items-center gap-3 min-w-0 pr-2">
                                        <div class="w-8 h-8 rounded-xl {{ $meta['color'] }} flex items-center justify-center font-bold text-xs flex-shrink-0 group-hover:scale-105 transition-transform">
                                            <i class="fas {{ $meta['icon'] }}"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <h5 class="text-xs font-bold text-slate-800 dark:text-white truncate">{{ $mapel->nama }}</h5>
                                            <div class="flex items-center gap-1.5 mt-0.5">
                                                <span class="text-[9px] font-bold px-1.5 py-0.2 rounded {{ $meta['badge'] }}">{{ $meta['group'] }}</span>
                                                <span class="text-[11px] text-slate-400">{{ $mapel->beban_jp ?? 0 }} JP / Minggu</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <div class="mapel-check-icon hidden w-5 h-5 rounded-full bg-[#D65A20] text-white flex items-center justify-center text-[10px]">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Empty State -->
                        <div id="mapelEmptyState" class="hidden py-6 text-center text-slate-400">
                            <i class="fas fa-book text-2xl mb-1 text-slate-300 dark:text-slate-600"></i>
                            <p class="text-xs">Tidak ada mata pelajaran yang cocok dengan kata kunci.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Select Kelas (Checkboxes) -->
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300">Pilih Kelas Diampu (Bisa lebih dari satu) <span class="text-rose-500">*</span></label>
                </div>
                
                @php
                    $groupedClasses = $classes->groupBy('grade_level');
                @endphp
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                    @foreach($groupedClasses as $grade => $gradeClasses)
                        <div>
                            <div class="flex items-center justify-between mb-3 border-b border-slate-200 dark:border-slate-700 pb-2">
                                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                    <i class="fas fa-layer-group text-slate-400 mr-1.5"></i> Kelas {{ $grade }}
                                </h3>
                                <label class="flex items-center gap-1.5 cursor-pointer group">
                                    <input type="checkbox" onclick="toggleGradeClasses(this, '{{ $grade }}')" class="w-3.5 h-3.5 rounded border-slate-300 text-[#D65A20] focus:ring-[#D65A20] dark:border-slate-600 dark:bg-slate-700 dark:checked:bg-[#D65A20]">
                                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider group-hover:text-[#D65A20] transition">Semua</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-2 gap-y-3 gap-x-2 grade-classes-{{ $grade }}">
                                @foreach($gradeClasses as $kelas)
                                    <label class="flex items-center gap-1.5 cursor-pointer group">
                                        <input type="checkbox" name="kelas_id[]" value="{{ $kelas->id }}" class="w-4 h-4 rounded border-slate-300 text-[#D65A20] focus:ring-[#D65A20] dark:border-slate-600 dark:bg-slate-700 dark:checked:bg-[#D65A20]">
                                        <span class="text-xs text-slate-600 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white transition font-semibold">{{ $kelas->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> Simpan Pengampuan
                </button>
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        
        <!-- Table Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white"><i class="fas fa-list-ul text-[#D65A20] mr-2"></i>Daftar Pengampuan Guru (TA: {{ $activeYear }})</h2>
            
            <div class="relative w-full sm:w-72">
                <input type="text" id="customSearchInput" placeholder="Cari pengampuan..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-xs"></i>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto flex-1 min-h-0 overflow-y-auto pb-4">
            <table id="plottingTable" class="w-full border-collapse border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-left">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-sm">
                        <th class="border border-slate-300 dark:border-slate-700 px-3.5 py-2.5 text-center font-extrabold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-100 dark:!bg-slate-800 w-12">No</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3.5 py-2.5 text-left font-extrabold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-100 dark:!bg-slate-800 w-64">Nama Guru</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3.5 py-2.5 text-left font-extrabold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-100 dark:!bg-slate-800">Mata Pelajaran & Rincian Kelas Diampu</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3.5 py-2.5 text-center font-extrabold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-100 dark:!bg-slate-800 w-28">Total Beban</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3.5 py-2.5 text-center font-extrabold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-100 dark:!bg-slate-800 w-32">Status Beban</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @php
                        $groupedPlottings = $plottings->groupBy('guru_id');
                        $iterator = 1;
                    @endphp
                    @foreach($groupedPlottings as $guruId => $guruPlots)
                        @php
                            $firstPlot = $guruPlots->first();
                            $guru = $firstPlot->guru;
                            $totalJp = $teacherJp[$guru->id] ?? 0;
                            
                            $statusText = 'Normal';
                            $statusClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800';
                            $statusIcon = 'fa-check-circle text-emerald-600';
                            
                            if ($totalJp < 24) {
                                $statusText = 'Kurang';
                                $statusClass = 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800';
                                $statusIcon = 'fa-exclamation-triangle text-amber-600';
                            } elseif ($totalJp > 44) {
                                $statusText = 'Lebih';
                                $statusClass = 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border border-rose-200 dark:border-rose-800';
                                $statusIcon = 'fa-exclamation-circle text-rose-600';
                            }

                            $plotsBySubject = $guruPlots->groupBy('mata_pelajaran_id');
                        @endphp
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition group align-top">
                            <td class="border border-slate-300 dark:border-slate-700 px-3 py-3 text-center text-slate-600 dark:text-slate-400 font-semibold">{{ $iterator++ }}</td>
                            <td class="border border-slate-300 dark:border-slate-700 px-3.5 py-3">
                                <div class="flex items-start gap-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-orange-100 text-[#D65A20] dark:bg-orange-950/50 dark:text-orange-400 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5 shadow-2xs">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h5 class="font-extrabold text-xs text-slate-800 dark:text-white leading-tight">{{ $guru->nama ?? '-' }}</h5>
                                        <p class="text-[11px] text-slate-400 mt-0.5">NIP: <span class="font-medium text-slate-600 dark:text-slate-300">{{ $guru->nip ?? '-' }}</span></p>
                                    </div>
                                </div>
                            </td>
                            <td class="border border-slate-300 dark:border-slate-700 px-3.5 py-3">
                                <div class="space-y-2">
                                    @foreach($plotsBySubject as $mapelId => $mPlots)
                                        @php
                                            $subject = $mPlots->first()->subject;
                                            $meta = $getMapelMeta($subject->nama ?? '');
                                            $subjectJp = $mPlots->sum('calculated_jp') ?: ($mPlots->count() * ($subject->beban_jp ?? 2));
                                        @endphp
                                        <div class="p-2.5 rounded-xl bg-slate-50/70 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-700/70">
                                            <div class="flex items-center justify-between gap-2 mb-1.5 pb-1 border-b border-slate-200/60 dark:border-slate-700/60">
                                                <div class="flex items-center gap-1.5 flex-wrap">
                                                    <span class="text-xs font-extrabold text-slate-800 dark:text-white flex items-center gap-1.5">
                                                        <i class="fas {{ $meta['icon'] }} text-[#D65A20] text-xs"></i> {{ $subject->nama ?? '-' }}
                                                    </span>
                                                    <span class="text-[9px] font-bold px-1.5 py-0.2 rounded {{ $meta['badge'] }}">{{ $meta['group'] }}</span>
                                                </div>
                                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                                    <span class="text-[10px] font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-700 px-2 py-0.5 rounded-md border border-slate-200 dark:border-slate-600 shadow-2xs">
                                                        {{ $mPlots->count() }} Rombel • {{ $subjectJp }} JP
                                                    </span>
                                                    <form action="{{ route('teaching-assignments.destroy-group', ['guruId' => $guruId, 'mapelId' => $mapelId]) }}" method="POST" onsubmit="return confirm('Hapus seluruh pengampuan {{ $subject->nama ?? 'mapel ini' }} ({{ $mPlots->count() }} kelas) untuk {{ $guru->nama }}?');" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-2 py-0.5 rounded-md text-[10px] font-bold text-rose-500 hover:text-white hover:bg-rose-500 border border-rose-200 hover:border-rose-500 dark:border-rose-900/50 dark:hover:bg-rose-600 transition flex items-center gap-1 cursor-pointer" title="Hapus seluruh rombel untuk mapel ini sekaligus">
                                                            <i class="fas fa-trash-alt text-[9px]"></i> Hapus Mapel
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach($mPlots as $plot)
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg text-xs font-semibold shadow-2xs">
                                                        <span>{{ $plot->kelas->name ?? '-' }}</span>
                                                        <form action="{{ route('teaching-assignments.destroy', $plot->id) }}" method="POST" onsubmit="return confirm('Hapus hak akses mengajar kelas {{ $plot->kelas->name }} untuk guru ini?');" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-rose-400 hover:text-rose-600 font-bold ml-0.5 text-xs focus:outline-none cursor-pointer" title="Hapus plotting kelas ini">&times;</button>
                                                        </form>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="border border-slate-300 dark:border-slate-700 px-3 py-3 text-center">
                                <span class="text-sm font-extrabold text-slate-800 dark:text-white">{{ $totalJp }} JP</span>
                            </td>
                            <td class="border border-slate-300 dark:border-slate-700 px-3 py-3 text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-extrabold {{ $statusClass }}">
                                    <i class="fas {{ $statusIcon }}"></i>
                                    {{ $statusText }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Auto Plot Modal Khusus Kelas X (Fase E - 18 Mapel) -->
<div id="autoPlotModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm animate-fade-in" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="document.getElementById('autoPlotModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full border border-slate-100 dark:border-slate-800">
            <div class="bg-white dark:bg-slate-900 px-5 pt-6 pb-5 sm:p-7 relative">
                <!-- Close Button -->
                <button type="button" onclick="document.getElementById('autoPlotModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-2xl bg-orange-100 text-[#D65A20] dark:bg-orange-950/60 dark:text-orange-400">
                        <i class="fas fa-magic text-xl"></i>
                    </div>
                    <div class="w-full">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white" id="modal-title">
                                Auto-Plot Khusus Kelas X (Fase E)
                            </h3>
                            <span class="px-2.5 py-0.5 rounded-full bg-orange-100 text-[#D65A20] dark:bg-orange-950/60 dark:text-orange-300 text-[11px] font-extrabold">
                                18 Mata Pelajaran
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            Otomatisasi pengampuan guru khusus seluruh rombel Kelas X (Fase E) berbasis Kurikulum Merdeka.
                        </p>
                    </div>
                </div>

                <!-- Info Box Khusus Kelas X -->
                <div class="mt-4 p-4 bg-orange-50/70 dark:bg-orange-950/30 border border-orange-200/80 dark:border-orange-900/50 rounded-2xl space-y-2.5">
                    <div class="flex items-center gap-2 text-[#D65A20] dark:text-orange-400 text-xs font-bold">
                        <i class="fas fa-info-circle text-sm"></i>
                        <span>Ketentuan Auto-Plot Fase E (Kelas X):</span>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Pada Kurikulum Merdeka Fase E, seluruh siswa Kelas X menempuh <b>18 mata pelajaran yang seragam</b> (Dasar IPA, Dasar IPS, Mapel Umum, dan Projek P5). Sistem akan mendistribusikan ke-18 mapel tersebut ke seluruh rombel kelas X secara optimal dan proporsional.
                    </p>
                    <div class="p-2.5 bg-blue-50/80 dark:bg-blue-950/40 border border-blue-200/70 dark:border-blue-900/50 rounded-xl text-xs text-blue-900 dark:text-blue-200 flex items-start gap-2">
                        <i class="fas fa-hand-point-right text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0"></i>
                        <span><b>Pengampuan Kelas XI & XII:</b> Mohon di-plot secara <u>manual</u> melalui form input pengampuan untuk penyesuaian paket mata pelajaran pilihan/peminatan masing-masing rombel.</span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-1.5 pt-2 border-t border-orange-200/60 dark:border-orange-900/50 text-[11px] text-slate-700 dark:text-slate-300 font-semibold">
                        <span class="flex items-center gap-1.5"><i class="fas fa-check-circle text-emerald-500 text-[10px]"></i> 9 Mapel @ 3 JP</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-check-circle text-emerald-500 text-[10px]"></i> 9 Mapel @ 2 JP</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-check-circle text-emerald-500 text-[10px]"></i> Total 45 JP / Rombel</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-check-circle text-emerald-500 text-[10px]"></i> Fasilitator Projek P5</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-user-check text-orange-500 text-[10px]"></i> Sesuai Spesialisasi</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-sliders-h text-blue-600 text-[10px]"></i> XI & XII Plot Manual</span>
                    </div>
                </div>

                <!-- Form Target Tahun Ajaran -->
                <form id="autoPlotForm" action="{{ route('teachers.auto-plot') }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label for="tahun_ajaran" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Target Tahun Ajaran</label>
                        <div class="relative">
                            <select name="tahun_ajaran" id="tahun_ajaran" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold">
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ $year === $activeYear ? 'selected' : '' }}>
                                        {{ $year }} {{ $year === $activeYear ? '(Tahun Ajaran Aktif)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Hanya rombel Tingkat X pada tahun ajaran ini yang akan diperbarui.</p>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="bg-slate-50 dark:bg-slate-800/50 px-5 py-3.5 sm:px-7 sm:flex sm:flex-row-reverse gap-2 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('autoPlotForm').submit()" class="w-full inline-flex justify-center items-center gap-2 rounded-xl border border-transparent shadow-sm px-5 py-2.5 bg-[#D65A20] hover:bg-[#be4e1a] text-sm font-bold text-white focus:outline-none transition cursor-pointer">
                    <i class="fas fa-magic"></i> Jalankan Auto-Plot Kelas X
                </button>
                <button type="button" onclick="document.getElementById('autoPlotModal').classList.add('hidden')" class="mt-2 sm:mt-0 w-full inline-flex justify-center items-center rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm px-4 py-2.5 bg-white dark:bg-slate-800 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 focus:outline-none transition cursor-pointer">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS for Sorting and Pagination -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    // Global datasets
    window.subjectsData = @json($subjects ?? []);
    window.teachersData = @json($teachers ?? []);
    const existingAssignmentsMap = @json($existingAssignmentsMap ?? []);

    let currentGuruRumpunFilter = 'ALL';
    let currentMapelGroupFilter = 'ALL';
    let selectedGuruData = null;
    let selectedMapelData = null;
    let pendingBatchClassIds = [];

    $(document).ready(function() {
        var table = $('#plottingTable').DataTable({
            responsive: true,
            pageLength: 20,
            lengthChange: false,
            ordering: true,
            info: true,
            dom: '<"top"i>rt<"bottom"p><"clear">',
            language: {
                search: "",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ plotting",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 plotting",
                infoFiltered: "(disaring dari total _MAX_ plotting)",
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                },
                emptyTable: '<div class="flex flex-col items-center justify-center py-8"><i class="fas fa-inbox text-4xl mb-3 text-slate-300 dark:text-slate-600"></i><p>Belum ada data pengampuan guru.</p></div>',
                zeroRecords: "Tidak ada plotting yang cocok dengan pencarian"
            }
        });

        // Custom Search Input for Table
        $('#customSearchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Form Validation on Manual Submit
        $('#manualPlottingForm').on('submit', function(e) {
            const guruVal = $('#guru_select').val();
            const mapelVal = $('#mapel_select').val();
            const checkedClasses = $('input[name="kelas_id[]"]:checked').length;

            if (!guruVal) {
                e.preventDefault();
                toggleGuruDropdown(null, true);
                $('#guruComboboxTrigger').addClass('combobox-active-ring border-rose-500');
                if (window.Swal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Guru Belum Dipilih',
                        text: 'Silakan pilih guru pengampu terlebih dahulu.',
                        confirmButtonColor: '#D65A20'
                    });
                }
                return false;
            }

            if (!mapelVal) {
                e.preventDefault();
                toggleMapelDropdown(null, true);
                $('#mapelComboboxTrigger').addClass('combobox-active-ring border-rose-500');
                if (window.Swal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mata Pelajaran Belum Dipilih',
                        text: 'Silakan pilih mata pelajaran yang akan diampu.',
                        confirmButtonColor: '#D65A20'
                    });
                }
                return false;
            }

            if (checkedClasses === 0) {
                e.preventDefault();
                if (window.Swal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kelas Belum Dipilih',
                        text: 'Pilih minimal satu kelas yang akan diampu oleh guru ini.',
                        confirmButtonColor: '#D65A20'
                    });
                } else {
                    alert('Pilih minimal satu kelas yang diampu.');
                }
                return false;
            }
        });

        // Close dropdowns on document click outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#guruComboboxWrapper').length) {
                closeGuruDropdown();
            }
            if (!$(e.target).closest('#mapelComboboxWrapper').length) {
                closeMapelDropdown();
            }
        });

        // Keyboard handler (Escape key)
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                closeGuruDropdown();
                closeMapelDropdown();
            }
        });
    });

    /* =========================================================================
       MONITORING VIEW LOGIC
       ========================================================================= */
    function toggleMonitoringPanel() {
        const container = document.getElementById('monitoringContentContainer');
        const chevron = document.getElementById('monToggleChevron');
        const text = document.getElementById('monToggleText');

        if (container.classList.contains('hidden')) {
            container.classList.remove('hidden');
            if (chevron) chevron.classList.add('rotate-180');
            if (text) text.innerText = 'Sembunyikan';
        } else {
            container.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
            if (text) text.innerText = 'Lihat Rincian';
        }
    }

    function filterMonitoringGrade(grade, btnEl) {
        $('.mon-grade-btn').removeClass('bg-[#D65A20] text-white')
            .addClass('bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300');
        $(btnEl).removeClass('bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300')
            .addClass('bg-[#D65A20] text-white');

        filterMonitoringSearch();
    }

    function filterMonitoringSearch() {
        const activeGradeBtn = $('.mon-grade-btn.bg-\\[\\#D65A20\\]');
        let selectedGrade = 'ALL';
        if (activeGradeBtn.length) {
            const btnText = activeGradeBtn.text();
            if (btnText.includes('Kelas X (')) selectedGrade = 'X';
            else if (btnText.includes('Kelas XI (')) selectedGrade = 'XI';
            else if (btnText.includes('Kelas XII (')) selectedGrade = 'XII';
        }

        const query = ($('#monSearchInput').val() || '').toLowerCase().trim();

        $('.mon-class-card').each(function() {
            const grade = $(this).attr('data-grade');
            const name = $(this).attr('data-name') || '';
            const itemsText = $(this).find('.mon-plot-list').text().toLowerCase();

            const matchGrade = (selectedGrade === 'ALL' || grade === selectedGrade);
            const matchQuery = (query === '' || name.includes(query) || itemsText.includes(query));

            if (matchGrade && matchQuery) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    }    function fastBatchPlotSubject(mapelId, mapelNama, kelasIds) {
        // 1. Store pending batch class IDs
        pendingBatchClassIds = Array.isArray(kelasIds) ? kelasIds : [];

        // 2. Resolve mapelId if null
        if (!mapelId && window.subjectsData && window.subjectsData.length > 0) {
            const found = window.subjectsData.find(s => s.nama.trim().toLowerCase() === mapelNama.trim().toLowerCase());
            if (found) mapelId = found.id;
        }

        // 3. Select Mapel in combobox
        if (mapelId) {
            const card = $(`.mapel-item-card[data-id="${mapelId}"]`);
            if (card.length) {
                card.trigger('click');
            } else {
                $('#mapel_select').val(mapelId);
            }
        }

        // 4. Check target classes
        $('input[name="kelas_id[]"]').prop('checked', false);
        if (Array.isArray(kelasIds)) {
            kelasIds.forEach(id => {
                $('input[name="kelas_id[]"][value="' + id + '"]').prop('checked', true);
            });
        }

        // 5. Smooth scroll down to form
        const formEl = document.getElementById('manualPlottingForm');
        if (formEl) {
            formEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // 6. Open Guru Dropdown after scroll
        setTimeout(() => {
            toggleGuruDropdown(null, true);
        }, 350);
    }

    /* =========================================================================
       GURU COMBOBOX LOGIC
       ========================================================================= */
    function toggleGuruDropdown(e, forceOpen = false) {
        if (e) e.stopPropagation();
        closeMapelDropdown();

        const menu = $('#guruDropdownMenu');
        const chevron = $('#guruChevronIcon');
        const trigger = $('#guruComboboxTrigger');

        if (menu.hasClass('hidden') || forceOpen) {
            menu.removeClass('hidden');
            chevron.addClass('rotate-180 text-[#D65A20]');
            trigger.addClass('combobox-active-ring');
            setTimeout(() => $('#guruSearchInput').focus(), 50);
        } else {
            closeGuruDropdown();
        }
    }

    function closeGuruDropdown() {
        $('#guruDropdownMenu').addClass('hidden');
        $('#guruChevronIcon').removeClass('rotate-180 text-[#D65A20]');
        $('#guruComboboxTrigger').removeClass('combobox-active-ring border-rose-500');
    }

    function filterGuruList() {
        const query = ($('#guruSearchInput').val() || '').toLowerCase().trim();
        $('#clearGuruSearchInputBtn').toggleClass('hidden', query.length === 0);

        let visibleCount = 0;
        $('.guru-item-card').each(function() {
            const nama = $(this).attr('data-nama') || '';
            const spec = $(this).attr('data-spec') || '';

            const matchQuery = (nama.includes(query) || spec.includes(query));

            if (matchQuery) {
                $(this).removeClass('hidden');
                visibleCount++;
            } else {
                $(this).addClass('hidden');
            }
        });

        $('#guruEmptyState').toggleClass('hidden', visibleCount > 0);
    }

    function resetGuruSearch() {
        $('#guruSearchInput').val('');
        filterGuruList();
        $('#guruSearchInput').focus();
    }

    function selectGuru(id, nama, spesialisasi, jp) {
        selectedGuruData = { id, nama, spesialisasi, jp };
        $('#guru_select').val(id);

        // Highlight selected item card
        $('.guru-item-card').removeClass('border-orange-500 bg-orange-50/70 dark:bg-orange-950/30');
        $('.guru-check-icon').addClass('hidden');
        const activeCard = $(`.guru-item-card[data-id="${id}"]`);
        activeCard.addClass('border-orange-500 bg-orange-50/70 dark:bg-orange-950/30');
        activeCard.find('.guru-check-icon').removeClass('hidden');

        // Update trigger UI
        let specsHtml = '';
        if (spesialisasi) {
            const specArr = spesialisasi.split(',').map(s => s.trim());
            specArr.forEach(sp => {
                specsHtml += `<span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-orange-100 text-orange-800 dark:bg-orange-950/50 dark:text-orange-300 border border-orange-200 dark:border-orange-800">${sp}</span>`;
            });
        } else {
            specsHtml = `<span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300">Umum</span>`;
        }

        let jpClass = 'text-emerald-600 dark:text-emerald-400';
        if (jp < 24) jpClass = 'text-amber-600 dark:text-amber-400';
        else if (jp > 44) jpClass = 'text-rose-600 dark:text-rose-400';

        $('#guruTriggerContent').html(`
            <div class="w-8 h-8 rounded-lg bg-orange-500 text-white flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-2xs">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="min-w-0 text-left">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-xs font-extrabold text-slate-800 dark:text-white truncate">${nama}</span>
                    ${specsHtml}
                </div>
                <div class="text-[10px] text-slate-400 mt-0.5">
                    Beban Saat Ini: <span class="font-bold ${jpClass}">${jp} JP</span>
                </div>
            </div>
        `);

        $('#clearGuruBtn').removeClass('hidden');
        closeGuruDropdown();

        // Update Smart Recommendations in Mapel Dropdown (without auto-filling)
        updateMapelRecommendations(spesialisasi);

        // Sync Checkboxes
        syncClassCheckboxes();
    }

    function clearSelectedGuru(e) {
        if (e) e.stopPropagation();
        selectedGuruData = null;
        pendingBatchClassIds = [];
        $('#guru_select').val('');
        $('#guruTriggerContent').html(`
            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xs flex-shrink-0">
                <i class="fas fa-user-tie"></i>
            </div>
            <span class="text-slate-400 dark:text-slate-500 text-xs font-medium">-- Pilih Guru Pengampu --</span>
        `);
        $('#clearGuruBtn').addClass('hidden');
        $('.guru-item-card').removeClass('border-orange-500 bg-orange-50/70 dark:bg-orange-950/30');
        $('.guru-check-icon').addClass('hidden');

        // Clear Mapel Recommendation
        $('#mapelRecommendationContainer').addClass('hidden');
        $('#mapelRecommendationList').empty();

        syncClassCheckboxes();
    }

    /* =========================================================================
       MAPEL COMBOBOX LOGIC
       ========================================================================= */
    function toggleMapelDropdown(e, forceOpen = false) {
        if (e) e.stopPropagation();
        closeGuruDropdown();

        const menu = $('#mapelDropdownMenu');
        const chevron = $('#mapelChevronIcon');
        const trigger = $('#mapelComboboxTrigger');

        if (menu.hasClass('hidden') || forceOpen) {
            menu.removeClass('hidden');
            chevron.addClass('rotate-180 text-[#D65A20]');
            trigger.addClass('combobox-active-ring');
            setTimeout(() => $('#mapelSearchInput').focus(), 50);
        } else {
            closeMapelDropdown();
        }
    }

    function closeMapelDropdown() {
        $('#mapelDropdownMenu').addClass('hidden');
        $('#mapelChevronIcon').removeClass('rotate-180 text-[#D65A20]');
        $('#mapelComboboxTrigger').removeClass('combobox-active-ring border-rose-500');
    }

    function filterMapelList() {
        const query = ($('#mapelSearchInput').val() || '').toLowerCase().trim();
        $('#clearMapelSearchInputBtn').toggleClass('hidden', query.length === 0);

        let visibleCount = 0;
        $('.mapel-item-card').each(function() {
            const nama = $(this).attr('data-nama') || '';
            const group = $(this).attr('data-group') || '';

            const matchQuery = (nama.includes(query) || group.toLowerCase().includes(query));

            if (matchQuery) {
                $(this).removeClass('hidden');
                visibleCount++;
            } else {
                $(this).addClass('hidden');
            }
        });

        $('#mapelEmptyState').toggleClass('hidden', visibleCount > 0);
    }

    function resetMapelSearch() {
        $('#mapelSearchInput').val('');
        filterMapelList();
        $('#mapelSearchInput').focus();
    }

    function updateMapelRecommendations(spesialisasi) {
        if (!spesialisasi) {
            $('#mapelRecommendationContainer').addClass('hidden');
            $('#mapelRecommendationList').empty();
            return;
        }

        const specs = spesialisasi.split(',').map(s => s.trim().toLowerCase());
        const recContainer = $('#mapelRecommendationContainer');
        const recList = $('#mapelRecommendationList');
        recList.empty();

        let matchCount = 0;

        $('.mapel-item-card').each(function() {
            const mapelNama = $(this).attr('data-nama') || '';
            const isMatch = specs.some(sp => mapelNama.includes(sp) || sp.includes(mapelNama));

            if (isMatch) {
                matchCount++;
                const mapelId = $(this).attr('data-id');
                const displayNama = $(this).attr('data-display-nama');
                const group = $(this).attr('data-group');
                const jp = $(this).attr('data-jp');
                const icon = $(this).attr('data-icon');
                const color = $(this).attr('data-color');
                const badge = $(this).attr('data-badge');

                recList.append(`
                    <div class="flex items-center justify-between p-2 rounded-xl bg-white dark:bg-slate-900 border border-orange-300 dark:border-orange-700/80 hover:bg-orange-50 dark:hover:bg-slate-800 cursor-pointer transition select-none"
                         onclick="selectMapel(${mapelId}, '${displayNama.replace(/'/g, "\\'")}', '${group}', ${jp}, '${icon}', '${color}', '${badge}')">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg ${color} flex items-center justify-center text-xs">
                                <i class="fas ${icon}"></i>
                            </div>
                            <div>
                                <h6 class="text-xs font-bold text-slate-800 dark:text-white">${displayNama}</h6>
                                <span class="text-[9px] font-bold text-orange-600 dark:text-orange-400">Cocok dengan spesialisasi guru</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-orange-100 text-orange-800 dark:bg-orange-950/50 dark:text-orange-300">Pilih Mapel Ini</span>
                    </div>
                `);
            }
        });

        if (matchCount > 0) {
            recContainer.removeClass('hidden');
        } else {
            recContainer.addClass('hidden');
        }
    }

    function selectMapel(id, nama, group, jp, icon = 'fa-book-open', color = 'text-slate-600 bg-slate-50', badge = 'bg-slate-100 text-slate-800') {
        selectedMapelData = { id, nama, group, jp, icon, color, badge };
        $('#mapel_select').val(id);

        // Highlight active mapel card
        $('.mapel-item-card').removeClass('border-orange-500 bg-orange-50/70 dark:bg-orange-950/30');
        $('.mapel-check-icon').addClass('hidden');
        const activeCard = $(`.mapel-item-card[data-id="${id}"]`);
        activeCard.addClass('border-orange-500 bg-orange-50/70 dark:bg-orange-950/30');
        activeCard.find('.mapel-check-icon').removeClass('hidden');

        // Update trigger UI
        $('#mapelTriggerContent').html(`
            <div class="w-8 h-8 rounded-lg ${color} flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-2xs">
                <i class="fas ${icon}"></i>
            </div>
            <div class="min-w-0 text-left">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-xs font-extrabold text-slate-800 dark:text-white truncate">${nama}</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md ${badge}">${group}</span>
                </div>
                <div class="text-[10px] text-slate-400 mt-0.5">
                    Beban: <span class="font-bold text-slate-600 dark:text-slate-300">${jp} JP / Minggu</span>
                </div>
            </div>
        `);

        $('#clearMapelBtn').removeClass('hidden');
        closeMapelDropdown();

        // Sync Checkboxes
        syncClassCheckboxes();
    }

    function clearSelectedMapel(e) {
        if (e) e.stopPropagation();
        selectedMapelData = null;
        pendingBatchClassIds = [];
        $('#mapel_select').val('');
        $('#mapelTriggerContent').html(`
            <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xs flex-shrink-0">
                <i class="fas fa-book-open"></i>
            </div>
            <span class="text-slate-400 dark:text-slate-500 text-xs font-medium">-- Pilih Mapel --</span>
        `);
        $('#clearMapelBtn').addClass('hidden');
        $('.mapel-item-card').removeClass('border-orange-500 bg-orange-50/70 dark:bg-orange-950/30');
        $('.mapel-check-icon').addClass('hidden');

        syncClassCheckboxes();
    }

    /* =========================================================================
       CHECKBOX & SYNC LOGIC
       ========================================================================= */
    function syncClassCheckboxes() {
        var guruId = $('#guru_select').val();
        var mapelId = $('#mapel_select').val();

        // 1. If in batch mode from monitoring "Plot Guru", preserve batch checked classes
        if (pendingBatchClassIds && pendingBatchClassIds.length > 0) {
            $('input[name="kelas_id[]"]').prop('checked', false);
            pendingBatchClassIds.forEach(function(classId) {
                $('input[name="kelas_id[]"][value="' + classId + '"]').prop('checked', true);
            });
            // If this guru already has existing plottings for this mapel, merge them
            if (guruId && mapelId) {
                var key = guruId + '_' + mapelId;
                if (existingAssignmentsMap[key] && existingAssignmentsMap[key].length > 0) {
                    existingAssignmentsMap[key].forEach(function(classId) {
                        $('input[name="kelas_id[]"][value="' + classId + '"]').prop('checked', true);
                    });
                }
            }
            return;
        }

        // 2. Standard sync when not in batch mode
        $('input[name="kelas_id[]"]').prop('checked', false);
        $('input[onclick^="toggleGradeClasses"]').prop('checked', false);

        if (!guruId || !mapelId) return;

        var key = guruId + '_' + mapelId;
        if (existingAssignmentsMap[key] && existingAssignmentsMap[key].length > 0) {
            var assignedClassIds = existingAssignmentsMap[key];
            assignedClassIds.forEach(function(classId) {
                $('input[name="kelas_id[]"][value="' + classId + '"]').prop('checked', true);
            });
        }
    }

    function filterCheckboxByRumpun(targetRumpun) {
        $('input[name="kelas_id[]"]').each(function() {
            var r = $(this).attr('data-rumpun');
            if (targetRumpun === 'all' || r === targetRumpun || r === 'Fase E') {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    }

    function toggleGradeClasses(checkbox, grade) {
        const checkboxes = document.querySelectorAll('.grade-classes-' + grade + ' input[type="checkbox"]');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
        });
    }

    /* =========================================================================
       TOGGLE CHECKLIST LENGKAP MAPEL KELAS (INSTANT AJAX)
       ========================================================================= */
    function togglePlotVerified(kelasId, btn) {
        const isCurrentlyVerified = $(btn).attr('data-verified') === '1';
        const originalHtml = $(btn).html();
        
        $(btn).prop('disabled', true).addClass('opacity-75');

        fetch(`{{ url('/teaching-assignments/toggle-class-verified') }}/${kelasId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            $(btn).prop('disabled', false).removeClass('opacity-75');
            if (data.success) {
                const isVerified = data.is_verified;
                $(btn).attr('data-verified', isVerified ? '1' : '0');
                
                if (isVerified) {
                    $(btn).removeClass('bg-slate-100 hover:bg-amber-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-500 hover:text-amber-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700')
                          .addClass('bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xs');
                    $(btn).html('<i class="fas fa-check-circle text-white"></i> <span>Lengkap</span>');
                    $(btn).attr('title', 'Klik untuk membatalkan status lengkap');
                } else {
                    $(btn).removeClass('bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xs')
                          .addClass('bg-slate-100 hover:bg-amber-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-500 hover:text-amber-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700');
                    $(btn).html('<i class="far fa-circle text-slate-400"></i> <span>Tandai</span>');
                    $(btn).attr('title', 'Klik untuk menandai kelas ini telah lengkap plot mapelnya');
                }

                // Update metric counters on top
                $('#metricCompleteCount').text(data.complete_count);
                $('#metricIncompleteCount').text(data.incomplete_count);

                // Toast Feedback
                if (typeof Swal !== 'undefined') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: isVerified ? 'success' : 'info',
                        title: data.message
                    });
                }
            } else {
                $(btn).html(originalHtml);
                alert(data.message || 'Gagal mengubah status verifikasi kelas.');
            }
        })
        .catch(err => {
            $(btn).prop('disabled', false).removeClass('opacity-75').html(originalHtml);
            console.error(err);
            alert('Terjadi kesalahan jaringan saat memperbarui status.');
        });
    }

    /* =========================================================================
       TOGGLE CHECKLIST ALL (BATCH AJAX)
       ========================================================================= */
    function toggleChecklistAll(status, btn) {
        const originalHtml = $(btn).html();
        $(btn).prop('disabled', true).addClass('opacity-75');

        fetch(`{{ route('teaching-assignments.toggle-all-verified') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            $(btn).prop('disabled', false).removeClass('opacity-75');
            if (data.success) {
                // Update all individual buttons on class cards
                $('.btn-toggle-verify').each(function() {
                    $(this).attr('data-verified', status ? '1' : '0');
                    if (status) {
                        $(this).removeClass('bg-slate-100 hover:bg-amber-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-500 hover:text-amber-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700')
                              .addClass('bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xs');
                        $(this).html('<i class="fas fa-check-circle text-white"></i> <span>Lengkap</span>');
                        $(this).attr('title', 'Klik untuk membatalkan status lengkap');
                    } else {
                        $(this).removeClass('bg-emerald-500 hover:bg-emerald-600 text-white shadow-2xs')
                              .addClass('bg-slate-100 hover:bg-amber-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-500 hover:text-amber-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700');
                        $(this).html('<i class="far fa-circle text-slate-400"></i> <span>Tandai</span>');
                        $(this).attr('title', 'Klik untuk menandai kelas ini telah lengkap plot mapelnya');
                    }
                });

                // Update metric counters on top
                $('#metricCompleteCount').text(data.complete_count);
                $('#metricIncompleteCount').text(data.incomplete_count);

                // Toast Feedback
                if (typeof Swal !== 'undefined') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: status ? 'success' : 'info',
                        title: data.message
                    });
                }
            } else {
                alert(data.message || 'Gagal mengubah status semua kelas.');
            }
        })
        .catch(err => {
            $(btn).prop('disabled', false).removeClass('opacity-75');
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
        });
    }

</script>
@endpush
@endsection
