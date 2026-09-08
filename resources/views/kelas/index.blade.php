@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
@php
    $emptyClasses = $emptyClasses ?? \App\Models\Kelas::whereNull('homeroom_teacher_id')->get(['id', 'name']);
    $availableTeachers = $availableTeachers ?? \App\Models\Guru::whereNotIn('id', \App\Models\Kelas::whereNotNull('homeroom_teacher_id')->pluck('homeroom_teacher_id'))->active()->get(['id', 'nama']);
@endphp
<!-- Custom Styles for Table, Buttons, and Pagination -->
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
    
    /* Custom Styling for elements to match design */
    .btn-orange-outline {
        border: 1px solid #D65A20 !important;
        color: #D65A20 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-outline:hover {
        background-color: rgba(214, 90, 32, 0.05) !important;
    }
    .btn-teal-solid {
        background-color: #00B074 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-teal-solid:hover {
        background-color: #009662 !important;
    }
    .btn-orange-solid {
        background-color: #D65A20 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-solid:hover {
        background-color: #be4e1a !important;
    }
    .btn-blue-outline {
        border: 1px solid #3B82F6 !important;
        color: #3B82F6 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-blue-outline:hover {
        background-color: #3B82F6 !important;
        color: #ffffff !important;
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

@if(session('info'))
<div class="mb-6 glass p-4 border border-sky-100 bg-sky-50/70 text-sky-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-info-circle text-lg text-sky-500"></i>
        <span class="font-semibold text-sm">{{ session('info') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-sky-700/70 hover:text-sky-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('error'))
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<!-- Tab Navigation for Tahun Ajaran & Rombel -->
<div class="flex border-b border-slate-200 dark:border-slate-800 gap-2 mb-6">
    <a href="{{ route('academic-years.index') }}" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
        ⚙️ Pengaturan Tahun Ajaran
    </a>
    <a href="{{ route('academic-years.index') }}?tab=arsip" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
        🗃️ Arsip T.A
    </a>
    <a href="{{ route('classrooms.index') }}" class="px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition">
        🏫 Rombel Aktif
    </a>
</div>

<div class="flex flex-col gap-6" style="height: calc(100vh - 152px);"> <!-- 152px is approx padding top & bottom from layout -->
    <!-- Static Header & Summary Cards Container -->
    <div class="flex-shrink-0 space-y-6">
        <!-- Page Header (Clean, outside the card) -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Data Kelas</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola informasi kelas, tingkat, kapasitas siswa, dan wali kelas.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Reserved for top right buttons if needed in the future -->
            </div>
        </div>

        <!-- Metrik Summary Cards (Premium Minimalist Styling) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Total Kelas -->
            <div class="stat-card border-l-4 border-l-[#D65A20] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Kelas Terdaftar</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $classrooms->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-school"></i>
                </div>
            </div>

            <!-- Total Siswa Terkelas -->
            <div class="stat-card border-l-4 border-l-[#00B074] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Siswa Terkelas</p>
                    <p class="text-2xl font-bold text-[#00B074] mt-1">
                        {{ $classrooms->sum('siswa_count') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#00B074] dark:bg-emerald-950/20 dark:text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>

            <!-- Kelas Tanpa Wali -->
            <div class="stat-card border-l-4 border-l-[#FF5B5B] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas Tanpa Wali</p>
                    <p class="text-2xl font-bold text-[#FF5B5B] mt-1">{{ $classrooms->whereNull('homeroom_teacher_id')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-[#FF5B5B] dark:bg-rose-950/20 dark:text-rose-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm flex-1 flex flex-col min-h-0">
        
        <!-- Academic Toolbar (Filter Area) -->
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4 mb-6 flex-shrink-0">
            <!-- Left Filters -->
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <input type="text" id="toolbarSearch" placeholder="Cari data kelas..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>

                <!-- Grade Dropdown -->
                <div class="relative w-full sm:w-48">
                    <select id="toolbarGrade" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Tingkat</option>
                        <option value="Kelas X">Kelas X</option>
                        <option value="Kelas XI">Kelas XI</option>
                        <option value="Kelas XII">Kelas XII</option>
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <!-- Tahun Ajaran Dropdown -->
                <form action="{{ route('classrooms.index') }}" method="GET" id="filterTahunAjaranForm" class="relative w-full sm:w-48">
                    <select name="tahun_ajaran" onchange="document.getElementById('filterTahunAjaranForm').submit()" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="all" {{ $selectedYear == 'all' ? 'selected' : '' }}>Semua Tahun Ajaran</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>T.A. {{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </form>
            </div>

            <!-- Right Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5">
                @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                <!-- Dropdown: Aksi Sistem -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" type="button" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2 shadow-sm">
                        <i class="fas fa-cogs text-blue-500"></i>
                        <span>Aksi Sistem</span>
                        <i class="fas fa-chevron-down text-[10px] ml-0.5"></i>
                    </button>
                    <!-- Dropdown List -->
                    <div x-show="open" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5">
                        <button type="button" onclick="openPlottingModal(); open = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                            <span class="text-sm">🎲</span>
                            <span class="font-medium">Plotting Wali Kelas</span>
                        </button>
                        {{-- 
                        [HIDDEN FOR DEMO]
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                        <button type="button" onclick="openCloneModal(); open = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                            <i class="fas fa-copy text-orange-500 w-4 text-center"></i>
                            <span class="font-medium">Salin Data Kelas</span>
                        </button>
                        --}}
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                        <button type="button" onclick="openPlottingSiswaModal(); open = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                            <i class="fas fa-random text-indigo-500 w-4 text-center"></i>
                            <span class="font-medium">Plotting Siswa Otomatis</span>
                        </button>
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                        <button type="button" onclick="openKelulusanKenaikanModal(); open = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-orange-500 w-4 text-center"></i>
                            <span class="font-medium">Kenaikan & Kelulusan</span>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Dropdown: Data Excel -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" type="button" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                        <i class="fas fa-file-excel text-emerald-600"></i>
                        <span>Data Excel</span>
                        <i class="fas fa-chevron-down text-[10px] ml-0.5"></i>
                    </button>
                    <!-- Dropdown List -->
                    <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5">
                        <button type="button" onclick="downloadExcel(); open = false" class="w-full text-left px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-2">
                            <i class="fas fa-download text-slate-400"></i>
                            <span>Download Excel</span>
                        </button>
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                        <button type="button" onclick="openImportModal(); open = false" class="w-full text-left px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-2">
                            <i class="fas fa-upload text-slate-400"></i>
                            <span>Import Excel</span>
                        </button>
                        @endif
                    </div>
                </div>

                @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                <!-- Generate & Tambah Rombel -->
                <div class="flex items-center gap-2">
                    <button type="button" onclick="showGenerateInfo()" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-orange-100 hover:text-orange-500 transition flex items-center justify-center" title="Cara Penggunaan (SOP)">
                        <i class="fas fa-info-circle text-lg"></i>
                    </button>
                    <button type="button" onclick="openGenerateMasterModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 font-bold px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2 text-xs">
                        <i class="fas fa-magic text-[#D65A20]"></i>
                        <span>Generate dari Master</span>
                    </button>
                    <button type="button" onclick="openAddModal()" class="btn btn-orange-solid font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Kelas</span>
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Skeleton Loading -->
        <div id="skeletonLoading" class="hidden space-y-4 flex-shrink-0">
            @for($i = 0; $i < 5; $i++)
            <div class="animate-pulse flex items-center justify-between p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl">
                <div class="flex items-center gap-3 w-1/3">
                    <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-800"></div>
                    <div class="space-y-2 flex-1">
                        <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-3/4"></div>
                        <div class="h-3 bg-slate-200 dark:bg-slate-800 rounded w-1/2"></div>
                    </div>
                </div>
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-20"></div>
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-28"></div>
                <div class="h-6 bg-slate-200 dark:bg-slate-800 rounded w-16"></div>
            </div>
            @endfor
        </div>

        <!-- Main Table View -->
        <div id="classroomsTableContainer" class="overflow-x-auto flex-1 min-h-0 overflow-y-auto pb-4">
            <table id="classroomsTable" class="w-full border-collapse border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-900 text-sm whitespace-nowrap">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-sm">
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">No</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Kelas</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Tingkat / Jurusan</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Wali Kelas</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Jumlah Siswa</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Kapasitas</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Status</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky right-0 top-0 z-30">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classrooms as $index => $classroom)
                    <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition group">
                        <!-- No -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 text-center">{{ $index + 1 }}</td>
                        
                        <!-- Kelas -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5">
                            <div class="min-w-0">
                                <span class="font-bold text-slate-800 dark:text-slate-100 block">{{ $classroom->name }}</span>
                                <span class="text-[11px] text-slate-500 block font-mono">T.A. {{ $classroom->tahunAjaran }}</span>
                            </div>
                        </td>
                        
                        <!-- Tingkat / Jurusan -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5">
                            <span class="text-slate-800 dark:text-slate-100 font-bold">Kelas {{ $classroom->tingkat }}</span>
                            <span class="text-slate-500 ml-1">({{ $classroom->jurusan }})</span>
                        </td>
                        
                        <!-- Wali Kelas -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 font-bold">
                            @if($classroom->waliKelas)
                                <span class="font-bold">{{ $classroom->waliKelas->name }}</span>
                            @else
                                <span class="text-slate-400 italic font-normal">Belum Ditentukan</span>
                            @endif
                        </td>
                        
                        <!-- Jumlah Siswa -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-300">
                            {{ $classroom->siswa_count }}
                        </td>
                        
                        <!-- Kapasitas -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center text-slate-500 dark:text-slate-400">
                            {{ $classroom->kapasitasMaksimal }}
                        </td>
                        
                        <!-- Status -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                            @php
                                $percent = ($classroom->kapasitasMaksimal > 0) ? ($classroom->siswa_count / $classroom->kapasitasMaksimal) * 100 : 0;
                            @endphp
                            @if($percent >= 100)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">Penuh</span>
                            @elseif($percent >= 80)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400">Hampir Penuh</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Tersedia</span>
                            @endif
                        </td>
                        
                        <!-- Aksi -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center bg-white dark:bg-slate-900 group-even:bg-slate-50 dark:group-even:bg-slate-800/30 group-hover:bg-slate-100 dark:group-hover:bg-slate-700/50 sticky right-0 z-10 transition-colors">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('classrooms.show', $classroom) }}" class="px-2 py-1 text-[11px] font-medium text-slate-700 bg-slate-50 border border-slate-200 hover:bg-slate-700 hover:text-white rounded transition">
                                    Detail
                                </a>
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                                <a href="{{ route('classrooms.edit', $classroom) }}" class="px-2 py-1 text-[11px] font-medium text-sky-700 bg-sky-50 border border-sky-200 hover:bg-sky-600 hover:text-white rounded transition">
                                    Edit
                                </a>
                                <form action="{{ route('classrooms.destroy', $classroom) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-[11px] font-medium text-rose-700 bg-rose-50 border border-rose-200 hover:bg-rose-600 hover:text-white rounded transition">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: TAMBAH KELAS DARI MASTER KELAS
     ========================================== -->
@if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
<div id="addClassroomModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl w-full max-w-4xl overflow-hidden animate-scale-up border border-slate-100 dark:border-slate-800 my-auto">
        <!-- Header -->
        <div class="px-8 py-5 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-center bg-white dark:bg-slate-900">
            <div>
                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white flex items-center gap-2.5">
                    <i class="fas fa-plus-circle text-[#D65A20]"></i>
                    <span>Tambah Rombel dari Master Kelas</span>
                </h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5">Pilih salah satu data Master Kelas di bawah, lalu tentukan wali kelas dan kapasitas siswa.</p>
            </div>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Form -->
        <form id="addClassroomForm" action="{{ route('classrooms.store') }}" method="POST" class="p-8 space-y-6" onsubmit="return validateClassroomForm()">
            @csrf
            
            <!-- Hidden Fields (Diambil otomatis saat memilih Master Kelas) -->
            <input type="hidden" id="inputNamaKelas" name="name" required />
            <input type="hidden" id="inputTingkat" name="tingkat" required />
            <input type="hidden" id="inputJurusan" name="jurusan" required />

            <!-- Area 1: Master Data Kelas Selector (Spacious Card Panel) -->
            <div class="space-y-3" id="masterClassPickerContainer">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <label class="field-label block text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">
                        1. Pilih Master Data Kelas <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <span id="validationWarning" class="text-rose-500 font-bold hidden text-xs animate-pulse">
                            <i class="fas fa-exclamation-circle mr-1"></i>Silakan pilih salah satu kelas di bawah
                        </span>
                        <a href="{{ route('master-classes.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-[#D65A20] bg-orange-50 hover:bg-orange-100 dark:bg-orange-950/40 dark:hover:bg-orange-900/60 border border-orange-200/80 dark:border-orange-800 transition shadow-sm" title="Kelola / Tambah Data Kelas Baru di Master Kelas">
                            <i class="fas fa-plus-circle text-[11px]"></i>
                            <span>+ Tambah di Master Kelas</span>
                            <i class="fas fa-external-link-alt text-[9px] ml-0.5 opacity-70"></i>
                        </a>
                    </div>
                </div>

                <!-- Filter & Search Toolbar -->
                <div class="flex flex-col sm:flex-row items-center gap-3 bg-slate-50 dark:bg-slate-800/60 p-2.5 rounded-2xl border border-slate-200/80 dark:border-slate-700">
                    <!-- Grade Filter Tabs -->
                    <div class="flex items-center gap-1.5 w-full sm:w-auto bg-white dark:bg-slate-900 p-1 rounded-xl border border-slate-200/80 dark:border-slate-700 shadow-sm flex-shrink-0">
                        <button type="button" onclick="filterMasterClassByGrade('ALL', this)" class="master-grade-tab px-3.5 py-1.5 text-xs font-bold rounded-lg bg-[#D65A20] text-white shadow-sm transition">
                            Semua
                        </button>
                        <button type="button" onclick="filterMasterClassByGrade('X', this)" class="master-grade-tab px-3.5 py-1.5 text-xs font-semibold rounded-lg text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition">
                            Kelas X
                        </button>
                        <button type="button" onclick="filterMasterClassByGrade('XI', this)" class="master-grade-tab px-3.5 py-1.5 text-xs font-semibold rounded-lg text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition">
                            Kelas XI
                        </button>
                        <button type="button" onclick="filterMasterClassByGrade('XII', this)" class="master-grade-tab px-3.5 py-1.5 text-xs font-semibold rounded-lg text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition">
                            Kelas XII
                        </button>
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" id="masterClassSearchInput" onkeyup="searchMasterClassItems(this.value)" placeholder="Ketik nama kelas untuk memfilter (misal: X 1, XI F 2, XII...)..." class="w-full rounded-xl border border-slate-200 bg-white dark:bg-slate-900 dark:border-slate-700 pl-9 pr-4 py-2 text-xs text-slate-700 dark:text-slate-200 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 transition shadow-sm" />
                    </div>
                </div>

                <!-- 3-Column Responsive Grid List -->
                <div class="max-h-72 overflow-y-auto p-2 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl bg-slate-50/40 dark:bg-slate-900/40" id="masterClassOptionsContainer">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2.5" id="masterClassOptionsList">
                        @php
                            $existingClassNamesInYear = $classrooms->pluck('name')->toArray();
                        @endphp
                        @foreach($masterClasses as $mc)
                            @php
                                $isAlreadyExist = in_array($mc->name, $existingClassNamesInYear);
                            @endphp
                            @if($isAlreadyExist)
                                <!-- Card Master Kelas (Sudah Terdaftar / Non-Selectable) -->
                                <div class="master-class-item flex items-center justify-between p-3 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/40 opacity-55 cursor-not-allowed select-none transition-all"
                                     data-id="{{ $mc->id }}"
                                     data-name="{{ $mc->name }}"
                                     data-grade="{{ $mc->grade_level }}"
                                     data-major="{{ $mc->major ?? 'Umum' }}"
                                     data-disabled="true"
                                     title="Rombel {{ $mc->name }} sudah dibuat di Tahun Ajaran ini">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-8 h-8 rounded-xl flex items-center justify-center font-bold text-xs shrink-0 bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500">
                                            {{ $mc->grade_level }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-bold text-sm text-slate-500 dark:text-slate-400 truncate">
                                                {{ $mc->name }}
                                            </div>
                                            <div class="text-[10px] text-slate-400 dark:text-slate-500 truncate">
                                                {{ $mc->major ?? 'Umum' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5 shrink-0 ml-1">
                                        <span class="text-[10px] px-2 py-0.5 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400 font-bold flex items-center gap-1">
                                            <i class="fas fa-check text-[8px]"></i> Sudah Ada
                                        </span>
                                    </div>
                                </div>
                            @else
                                <!-- Card Master Kelas (Tersedia / Dapat Dipilih) -->
                                <div class="master-class-item flex items-center justify-between p-3 rounded-2xl border-2 border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 hover:border-[#D65A20] hover:shadow-md hover:bg-orange-50/40 dark:hover:bg-slate-750 cursor-pointer transition-all duration-150 group"
                                     data-id="{{ $mc->id }}"
                                     data-name="{{ $mc->name }}"
                                     data-grade="{{ $mc->grade_level }}"
                                     data-major="{{ $mc->major ?? 'Umum' }}"
                                     data-disabled="false"
                                     onclick="selectMasterClassItem('{{ $mc->id }}', '{{ $mc->name }}', '{{ $mc->grade_level }}', '{{ $mc->major ?? 'Umum' }}')">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <div class="w-8 h-8 rounded-xl flex items-center justify-center font-black text-xs shrink-0
                                            {{ $mc->grade_level === 'X' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' : ($mc->grade_level === 'XI' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300') }}">
                                            {{ $mc->grade_level }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="font-extrabold text-sm text-slate-800 dark:text-white group-hover:text-[#D65A20] transition truncate">
                                                {{ $mc->name }}
                                            </div>
                                            <div class="text-[10px] text-slate-400 dark:text-slate-400 truncate">
                                                {{ $mc->major ?? 'Umum' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1.5 shrink-0 ml-1">
                                        <span class="text-[9px] px-1.5 py-0.5 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-700 dark:bg-emerald-900/30 dark:border-emerald-700 dark:text-emerald-300 font-semibold">Tersedia</span>
                                        <div class="w-5 h-5 rounded-full border border-slate-300 dark:border-slate-600 flex items-center justify-center checkmark-box group-hover:border-[#D65A20]">
                                            <i class="fas fa-check text-[10px] text-white opacity-0 checkmark-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Shortcut Info Footer -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-700 text-xs">
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                        <i class="fas fa-info-circle text-[#D65A20] text-sm shrink-0"></i>
                        <span>Kelas yang Anda cari belum ada di daftar Master Kelas?</span>
                    </div>
                    <a href="{{ route('master-classes.index') }}" class="inline-flex items-center gap-1 font-bold text-[#D65A20] hover:underline shrink-0">
                        <span>Buka Master Kelas</span>
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Selected Master Class Summary Banner -->
                <div id="selectedClassBanner" class="p-3 rounded-2xl bg-orange-50 dark:bg-orange-950/30 border border-orange-200 dark:border-orange-800/50 flex items-center justify-between transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-[#D65A20] text-white flex items-center justify-center text-xs shadow-sm">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-orange-600 dark:text-orange-400 block uppercase tracking-wider">Kelas Terpilih</span>
                            <div id="selectedMasterClassDisplay" class="font-bold text-sm text-slate-800 dark:text-white">
                                <span class="text-slate-400 font-normal italic text-xs">Belum ada kelas yang dipilih (klik salah satu kartu di atas)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="masterClassEmptyState" class="hidden py-8 text-center text-slate-400 text-xs">
                    <i class="fas fa-search mb-2 text-slate-300 text-xl"></i>
                    <p>Tidak ditemukan master kelas yang sesuai dengan filter/pencarian.</p>
                    <a href="{{ route('master-classes.index') }}" class="inline-flex items-center gap-1.5 mt-3 px-4 py-2 rounded-xl text-xs font-bold text-white bg-[#D65A20] hover:bg-[#b84a16] transition shadow-md">
                        <i class="fas fa-plus"></i> Tambah Kelas Baru di Master Kelas
                    </a>
                </div>
            </div>

            <!-- Area 2: Pengaturan Wali Kelas, Tahun Ajaran & Kapasitas (Grid 3 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-2 border-t border-slate-100 dark:border-slate-800/60">
                <!-- Wali Kelas -->
                <div class="md:col-span-2">
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">
                        2. Wali Kelas (Opsional)
                    </label>
                    <div class="relative">
                        <select id="selectWaliKelas" name="homeroom_teacher_id" class="input w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-medium shadow-sm">
                            <option value="">-- Belum Ditentukan (Bisa diatur nanti) --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->nama }} [{{ $teacher->nip ?? 'Guru' }}]</option>
                            @endforeach
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>

                <!-- Tahun Ajaran -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">
                        3. Target Tahun Ajaran <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="tahunAjaran" value="{{ $selectedYear && $selectedYear !== 'all' ? $selectedYear : ($activeYear ?? '2026/2027') }}" required class="input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-xs text-slate-700 font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 shadow-sm cursor-not-allowed" readonly />
                </div>

                <!-- Kapasitas Siswa -->
                <div class="md:col-span-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 mb-1.5">
                        <label class="field-label block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">
                            4. Kapasitas Maksimal Siswa <span class="text-rose-500">*</span>
                        </label>
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] text-slate-400 mr-1">Preset Cepat:</span>
                            <button type="button" onclick="document.querySelector('input[name=kapasitasMaksimal]').value=32" class="text-[11px] px-2.5 py-0.5 rounded-lg bg-slate-100 hover:bg-orange-100 hover:text-[#D65A20] text-slate-600 dark:bg-slate-800 dark:text-slate-300 font-bold transition">32 Siswa</button>
                            <button type="button" onclick="document.querySelector('input[name=kapasitasMaksimal]').value=36" class="text-[11px] px-2.5 py-0.5 rounded-lg bg-orange-100 text-[#D65A20] dark:bg-orange-950/40 font-bold transition">36 Siswa (Standar)</button>
                            <button type="button" onclick="document.querySelector('input[name=kapasitasMaksimal]').value=40" class="text-[11px] px-2.5 py-0.5 rounded-lg bg-slate-100 hover:bg-orange-100 hover:text-[#D65A20] text-slate-600 dark:bg-slate-800 dark:text-slate-300 font-bold transition">40 Siswa</button>
                        </div>
                    </div>
                    <input type="number" name="kapasitasMaksimal" value="36" min="1" max="50" required class="input w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-bold shadow-sm" />
                </div>
            </div>

            <!-- Footer / Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-5 border-t border-slate-100 dark:border-slate-800/60">
                <button type="button" onclick="closeAddModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-bold px-6 py-2.5 rounded-2xl text-xs transition">
                    Batal
                </button>
                <button type="submit" class="btn btn-orange-solid font-extrabold px-8 py-2.5 rounded-2xl shadow-xl shadow-orange-500/20 text-xs transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Rombel Baru</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- ==========================================
      MODAL POPUP: IMPOR DATA EXCEL
     ========================================== -->
@if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
<div id="importExcelModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#00B074]">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-file-excel mr-2"></i>Impor Data Kelas</h3>
            <button onclick="closeImportModal()" class="text-white hover:text-emerald-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('classrooms.import') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            
            <div class="text-center p-4 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/40">
                <i class="fas fa-cloud-upload-alt text-4xl text-[#00B074] mb-3"></i>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pilih berkas template excel</p>
                <p class="text-xs text-slate-400 mt-1 mb-4">Mendukung file (.xls, .xlsx)</p>
                <input type="file" required name="excel_file" class="hidden" id="excel_file_input" onchange="document.getElementById('fileNameText').innerText = this.files[0] ? this.files[0].name : ''" />
                <button type="button" onclick="document.getElementById('excel_file_input').click()" class="btn border border-[#00B074] text-[#00B074] hover:bg-emerald-50 px-4 py-2 rounded-xl text-xs font-bold transition">Pilih File</button>
                <p id="fileNameText" class="text-xs text-slate-600 dark:text-slate-400 mt-2 font-mono truncate"></p>
            </div>

            <div class="text-xs text-slate-400 leading-normal">
                <i class="fas fa-info-circle mr-1"></i> Pastikan struktur kolom template Excel sesuai format: <b>NAMA | TINGKAT | JURUSAN | TAHUN_AJARAN | KAPASITAS</b>.
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeImportModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl">Batal</button>
                <button type="submit" class="btn btn-teal-solid font-bold px-5 py-2 rounded-xl shadow-lg shadow-emerald-500/10">Mulai Impor</button>
            </div>
        </form>
    </div>
</div>
@endif

@if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
<!-- ==========================================
      MODAL POPUP: PLOTTING WALI KELAS OTOMATIS
     ========================================== -->
<div id="modalPlottingWaliKelas" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-lg overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-5 flex justify-between items-start bg-white dark:bg-slate-900">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Plotting Wali Kelas Otomatis</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Sistem akan menetapkan wali kelas secara otomatis untuk kelas yang masih kosong.</p>
            </div>
            <button onclick="closePlottingModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <!-- Content -->
        <div class="px-6 pb-6 space-y-5">
            <!-- Card Informasi Status -->
            <div class="p-4 border border-blue-100 bg-blue-50/40 dark:border-blue-900/30 dark:bg-blue-950/10 rounded-xl flex gap-3 items-start">
                <div class="w-8 h-8 rounded-full bg-blue-500 dark:bg-blue-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                    <i class="fas fa-info"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-700 dark:text-blue-400">Status Data Saat Ini:</h4>
                    <ul class="text-xs text-blue-600 dark:text-blue-300 mt-1.5 space-y-1 list-disc pl-4">
                        <li>Ditemukan <span class="font-bold">{{ $emptyClasses->count() }}</span> kelas dengan wali kelas kosong.</li>
                        <li>Tersedia <span class="font-bold">{{ $availableTeachers->count() }}</span> guru yang belum memegang jabatan wali kelas.</li>
                    </ul>
                </div>
            </div>

            <!-- Parameter Pengacakan -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-200">Parameter Pengacakan Sistem:</h4>
                <div class="space-y-2.5">
                    <label class="flex items-start gap-2.5 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" checked disabled class="mt-0.5 rounded text-[#D65A20] focus:ring-[#D65A20]" />
                        <span>Hanya gunakan guru dengan status kepegawaian tetap.</span>
                    </label>
                    <label class="flex items-start gap-2.5 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" checked disabled class="mt-0.5 rounded text-[#D65A20] focus:ring-[#D65A20]" />
                        <span>Distribusikan beban secara merata pada seluruh tingkatan kelas.</span>
                    </label>
                </div>
            </div>

            <!-- Footer / Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closePlottingModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="button" onclick="generateAndSavePlotting()" class="btn btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">
                    <span>🎲 Generate Acak & Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Salin Kelas -->
<div id="modalCloneKelas" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity opacity-0" id="backdropCloneKelas"></div>
    
    <!-- Modal Content -->
    <div class="absolute inset-0 flex items-center justify-center p-4 sm:p-6">
        <div class="bg-white dark:bg-slate-900 w-full max-w-md rounded-2xl shadow-2xl scale-95 opacity-0 transition-all duration-300 transform" id="panelCloneKelas">
            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 dark:bg-orange-500/20 flex items-center justify-center text-sm">
                        <i class="fas fa-copy"></i>
                    </div>
                    Salin Data Kelas
                </h3>
                <button onclick="closeCloneModal()" class="text-slate-400 hover:text-rose-500 transition-colors p-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-500/10">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6">
                <form id="formCloneKelas" action="{{ route('classrooms.clone') }}" method="POST">
                    @csrf
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-5 leading-relaxed">
                        Fitur ini akan menyalin seluruh struktur data ruang kelas (tanpa memindahkan wali kelas) dari Tahun Ajaran Sumber ke Tahun Ajaran Tujuan.
                    </p>

                    <div class="space-y-4">
                        <div>
                            <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tahun Ajaran Sumber (Dari)</label>
                            <select name="tahun_ajaran_sumber" required class="input bg-white dark:bg-slate-800">
                                <option value="">Pilih Tahun Ajaran Sumber...</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tahun Ajaran Tujuan (Ke)</label>
                            <select name="tahun_ajaran_tujuan" required class="input bg-white dark:bg-slate-800">
                                <option value="">Pilih Tahun Ajaran Tujuan...</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="flex justify-end items-center gap-3 px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 rounded-b-2xl">
                <button type="button" onclick="closeCloneModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="button" onclick="document.getElementById('formCloneKelas').submit()" class="btn btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">
                    <span>Proses Penyalinan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generate Rombel dari Master Kelas -->
<div id="modalGenerateMaster" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity opacity-0" id="backdropGenerateMaster" onclick="closeGenerateMasterModal()"></div>
    
    <!-- Modal Content -->
    <div class="absolute inset-0 flex items-center justify-center p-4 sm:p-6 pointer-events-none">
        <div class="bg-white dark:bg-slate-900 w-full max-w-md rounded-2xl shadow-2xl scale-95 opacity-0 transition-all duration-300 transform pointer-events-auto border border-slate-100 dark:border-slate-800" id="panelGenerateMaster">
            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 dark:bg-orange-500/20 flex items-center justify-center text-sm">
                        <i class="fas fa-magic"></i>
                    </div>
                    Generate dari Master
                </h3>
                <button onclick="closeGenerateMasterModal()" class="text-slate-400 hover:text-rose-500 transition-colors p-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-500/10">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6">
                <form id="formGenerateMaster" action="{{ route('classrooms.generate') }}" method="POST">
                    @csrf
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 leading-relaxed">
                        Fitur ini akan men-generate rombel baru berdasarkan struktur <strong>Master Kelas</strong> ke Tahun Ajaran yang Anda pilih.
                    </p>

                    <!-- Info Box Master Kelas -->
                    <div class="mb-5 p-3.5 rounded-xl bg-orange-50/70 dark:bg-orange-500/10 border border-orange-200/60 dark:border-orange-500/20 flex items-start gap-3">
                        <i class="fas fa-sitemap text-orange-500 mt-0.5 text-sm shrink-0"></i>
                        <div class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            <span class="font-bold text-orange-600 dark:text-orange-400">{{ $totalMasterClasses ?? \App\Models\MasterKelas::count() }} Master Kelas</span> siap di-generate. Jika rombel sudah ada pada tahun ajaran target, sistem tidak akan menduplikasinya.
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Tahun Ajaran Sumber / Basis Master -->
                        <div>
                            <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">
                                Basis Master / Tahun Ajaran Asal (Dari) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="source_master_year" class="input bg-white dark:bg-slate-800 w-full text-xs font-semibold appearance-none pr-8">
                                    <option value="all">-- Semua Master Kelas (22 Kelas Template Utama) --</option>
                                    @foreach($academicYears as $year)
                                        @if($year !== 'all')
                                        <option value="{{ $year }}">
                                            Tahun Ajaran {{ $year }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun Ajaran Tujuan -->
                        <div>
                            <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">
                                Tahun Ajaran Tujuan (Ke) <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="target_year" required class="input bg-white dark:bg-slate-800 w-full text-xs font-semibold appearance-none pr-8">
                                    <option value="">Pilih Tahun Ajaran Tujuan...</option>
                                    @foreach($academicYears as $year)
                                        @if($year !== 'all')
                                        <option value="{{ $year }}" {{ ($selectedYear !== 'all' ? $selectedYear : '') == $year ? 'selected' : '' }}>
                                            Tahun Ajaran {{ $year }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="flex justify-end items-center gap-3 px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 rounded-b-2xl">
                <button type="button" onclick="closeGenerateMasterModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="button" onclick="submitGenerateMaster()" id="btnSubmitGenerateMaster" class="btn btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition flex items-center gap-2">
                    <i class="fas fa-magic"></i>
                    <span>Ya, Generate Rombel</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================


@include('kelas.partials.aksi_sistem_modals')
@include('kelas.partials.aksi_sistem_js')

<!-- SOP Modal -->
<div id="sopModal" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeSopModal()"></div>
    <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-[90%] max-w-lg p-6 animate-in zoom-in-95 duration-200">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <i class="fas fa-info-circle text-orange-500"></i> SOP Pergantian Tahun Ajaran
            </h3>
            <button type="button" onclick="closeSopModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 w-8 h-8 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="text-slate-600 dark:text-slate-300 space-y-4 text-sm leading-relaxed">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center font-bold shrink-0 mt-0.5">1</div>
                <p><strong>Luluskan Siswa Kelas XII</strong> di menu Data Siswa.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center font-bold shrink-0 mt-0.5">2</div>
                <p><strong>Ganti Tahun Ajaran Baru</strong> di menu Pengaturan.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center font-bold shrink-0 mt-0.5">3</div>
                <p>Klik tombol <strong>'Generate dari Master'</strong> ini untuk menduplikasi seluruh kerangka kelas ke tahun ajaran yang baru.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center font-bold shrink-0 mt-0.5">4</div>
                <p><strong>Promosikan (Naikkan Kelas)</strong> siswa kelas X dan XI lama ke dalam ruang-ruang kelas baru tersebut.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center font-bold shrink-0 mt-0.5">5</div>
                <p><strong>Input data</strong> Siswa Baru (Kelas X).</p>
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <button type="button" onclick="closeSopModal()" class="btn btn-orange-solid px-6 py-2 rounded-xl text-sm font-bold shadow-md shadow-orange-500/20">
                Tutup Panduan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Dynamic lists for plotting
    const emptyClasses = @json($emptyClasses ?? []);
    const availableTeachers = @json($availableTeachers ?? []);

    function openPlottingModal() {
        $('#modalPlottingWaliKelas').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }

    function closePlottingModal() {
        $('#modalPlottingWaliKelas').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Modal Salin Data Kelas Functions
    function openCloneModal() {
        const modal = document.getElementById('modalCloneKelas');
        const backdrop = document.getElementById('backdropCloneKelas');
        const panel = document.getElementById('panelCloneKelas');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'scale-95');
        }, 10);
    }

    function closeCloneModal() {
        const modal = document.getElementById('modalCloneKelas');
        const backdrop = document.getElementById('backdropCloneKelas');
        const panel = document.getElementById('panelCloneKelas');
        
        backdrop.classList.add('opacity-0');
        panel.classList.add('opacity-0', 'scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.getElementById('formCloneKelas').reset();
        }, 300);
    }

    // Modal Generate Master Kelas Functions
    function openGenerateMasterModal() {
        const modal = document.getElementById('modalGenerateMaster');
        const backdrop = document.getElementById('backdropGenerateMaster');
        const panel = document.getElementById('panelGenerateMaster');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'scale-95');
        }, 10);
    }

    function closeGenerateMasterModal() {
        const modal = document.getElementById('modalGenerateMaster');
        const backdrop = document.getElementById('backdropGenerateMaster');
        const panel = document.getElementById('panelGenerateMaster');
        
        backdrop.classList.add('opacity-0');
        panel.classList.add('opacity-0', 'scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function submitGenerateMaster() {
        const form = document.getElementById('formGenerateMaster');
        const select = form.querySelector('select[name="target_year"]');
        if (!select.value) {
            alert('Silakan pilih Tahun Ajaran Tujuan terlebih dahulu.');
            select.focus();
            return;
        }
        const btn = document.getElementById('btnSubmitGenerateMaster');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        form.submit();
    }

    function generateAndSavePlotting() {
        let teachers = [...availableTeachers];
        let classes = [...emptyClasses];
        
        if (classes.length === 0) {
            alert('Tidak ada kelas dengan wali kelas kosong.');
            closePlottingModal();
            return;
        }

        if (teachers.length === 0) {
            alert('Tidak ada guru yang tersedia untuk dijadikan wali kelas.');
            closePlottingModal();
            return;
        }

        // Shuffle teachers array using Fisher-Yates algorithm
        for (let i = teachers.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [teachers[i], teachers[j]] = [teachers[j], teachers[i]];
        }
        
        // Create form dynamically
        const form = $('<form>', {
            action: '{{ route("homeroom-setup.store") }}',
            method: 'POST'
        });
        
        // Add CSRF Token
        form.append($('<input>', {
            type: 'hidden',
            name: '_token',
            value: '{{ csrf_token() }}'
        }));
        
        // Assign teachers to empty classes
        classes.forEach((classroom, index) => {
            const teacher = teachers[index] || null;
            
            form.append($('<input>', {
                type: 'hidden',
                name: `assignments[${index}][classroom_id]`,
                value: classroom.id
            }));
            
            form.append($('<input>', {
                type: 'hidden',
                name: `assignments[${index}][teacher_id]`,
                value: teacher ? teacher.id : ''
            }));
        });
        
        // Append to body and submit
        $('body').append(form);
        form.submit();
    }
    // Modal controls
    let currentGradeFilter = 'ALL';
    let currentSearchKeyword = '';

    function openAddModal() {
        // Reset form & picker state
        document.getElementById('addClassroomForm').reset();
        document.getElementById('inputNamaKelas').value = '';
        document.getElementById('inputTingkat').value = '';
        document.getElementById('inputJurusan').value = '';
        document.getElementById('validationWarning').classList.add('hidden');
        document.getElementById('selectedMasterClassDisplay').innerHTML = `
            <span class="text-slate-400 font-normal italic text-xs">Belum ada kelas yang dipilih (klik salah satu kartu di atas)</span>
        `;
        document.querySelectorAll('.master-class-item').forEach(el => {
            el.classList.remove('!border-[#D65A20]', '!bg-orange-50/70', 'ring-2', 'ring-[#D65A20]/20', 'dark:!bg-orange-950/30');
            const check = el.querySelector('.checkmark-icon');
            const checkBx = el.querySelector('.checkmark-box');
            if (check) check.classList.add('opacity-0');
            if (checkBx) checkBx.classList.remove('!bg-[#D65A20]', '!border-[#D65A20]');
        });

        // Reset filter
        currentGradeFilter = 'ALL';
        currentSearchKeyword = '';
        const searchInput = document.getElementById('masterClassSearchInput');
        if (searchInput) searchInput.value = '';
        document.querySelectorAll('.master-grade-tab').forEach((el, idx) => {
            if (idx === 0) {
                el.className = 'master-grade-tab px-3.5 py-1.5 text-xs font-bold rounded-lg bg-[#D65A20] text-white shadow-sm transition';
            } else {
                el.className = 'master-grade-tab px-3.5 py-1.5 text-xs font-semibold rounded-lg text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition';
            }
        });
        applyMasterClassFilters();

        $('#addClassroomModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }

    function closeAddModal() {
        $('#addClassroomModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    function filterMasterClassByGrade(grade, btn) {
        currentGradeFilter = grade;
        document.querySelectorAll('.master-grade-tab').forEach(el => {
            el.className = 'master-grade-tab px-3.5 py-1.5 text-xs font-semibold rounded-lg text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition';
        });
        btn.className = 'master-grade-tab px-3.5 py-1.5 text-xs font-bold rounded-lg bg-[#D65A20] text-white shadow-sm transition';
        applyMasterClassFilters();
    }

    function searchMasterClassItems(keyword) {
        currentSearchKeyword = (keyword || '').toLowerCase().trim();
        applyMasterClassFilters();
    }

    function applyMasterClassFilters() {
        let visibleCount = 0;
        const items = document.querySelectorAll('.master-class-item');
        items.forEach(item => {
            const itemGrade = item.getAttribute('data-grade');
            const itemName = (item.getAttribute('data-name') || '').toLowerCase();
            const itemMajor = (item.getAttribute('data-major') || '').toLowerCase();

            const matchGrade = (currentGradeFilter === 'ALL' || itemGrade === currentGradeFilter);
            const matchSearch = (!currentSearchKeyword || itemName.includes(currentSearchKeyword) || itemMajor.includes(currentSearchKeyword));

            if (matchGrade && matchSearch) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });

        const emptyState = document.getElementById('masterClassEmptyState');
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }

    function selectMasterClassItem(id, name, grade, major) {
        document.getElementById('inputNamaKelas').value = name;
        document.getElementById('inputTingkat').value = grade;
        document.getElementById('inputJurusan').value = major;
        document.getElementById('validationWarning').classList.add('hidden');

        const gradeBadgeClass = grade === 'X' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' : (grade === 'XI' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300');
        
        document.getElementById('selectedMasterClassDisplay').innerHTML = `
            <div class="flex items-center gap-2 mt-0.5">
                <span class="font-extrabold text-slate-900 dark:text-white text-base">${name}</span>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold ${gradeBadgeClass}">Kelas ${grade}</span>
                <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold bg-white/80 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700">${major}</span>
            </div>
        `;

        document.querySelectorAll('.master-class-item').forEach(el => {
            const check = el.querySelector('.checkmark-icon');
            const checkBx = el.querySelector('.checkmark-box');
            if (el.getAttribute('data-id') === id) {
                el.classList.add('!border-[#D65A20]', '!bg-orange-50/70', 'ring-2', 'ring-[#D65A20]/20', 'dark:!bg-orange-950/30');
                if (check) check.classList.remove('opacity-0');
                if (checkBx) checkBx.classList.add('!bg-[#D65A20]', '!border-[#D65A20]');
            } else {
                el.classList.remove('!border-[#D65A20]', '!bg-orange-50/70', 'ring-2', 'ring-[#D65A20]/20', 'dark:!bg-orange-950/30');
                if (check) check.classList.add('opacity-0');
                if (checkBx) checkBx.classList.remove('!bg-[#D65A20]', '!border-[#D65A20]');
            }
        });
    }

    function validateClassroomForm() {
        const name = document.getElementById('inputNamaKelas').value;
        if (!name) {
            document.getElementById('validationWarning').classList.remove('hidden');
            const container = document.getElementById('masterClassPickerContainer');
            if (container) container.scrollIntoView({ behavior: 'smooth' });
            return false;
        }
        return true;
    }
    function openImportModal() {
        $('#importExcelModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeImportModal() {
        $('#importExcelModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Trigger DataTables Excel Export
    function downloadExcel() {
        $('#classroomsTable').DataTable().button('.buttons-excel').trigger();
    }

    $(document).ready(function() {
        // Show loading skeleton while table is rendering
        $('#skeletonLoading').removeClass('hidden');
        $('#classroomsTableContainer').addClass('hidden');

        const table = $('#classroomsTable').DataTable({
            dom: 'rt<"flex flex-col md:flex-row justify-between items-center py-4 px-6 border-t border-slate-100 dark:border-slate-800 gap-4"ip>',
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'buttons-excel',
                    title: '{{ \App\Models\Pengaturan::getValue("school_name", "SMAN 1 Cepogo") }}',
                    messageTop: 'Laporan Data Kelas',
                    filename: 'Data_Kelas_' + new Date().toISOString().slice(0, 10),
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6] // Mengabaikan kolom Aksi
                    }
                }
            ],
            language: {
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                zeroRecords: "Tidak ditemukan data kelas yang sesuai",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            },
        // responsive removed
            order: [[ 1, "asc" ]] // Order by name default
        });

        // Hide skeleton and show table
        $('#skeletonLoading').addClass('hidden');
        $('#classroomsTableContainer').removeClass('hidden');
        table.columns.adjust();

        // Binds toolbar search input to datatable search API
        $('#toolbarSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Binds toolbar grade level dropdown filter
        $('#toolbarGrade').on('change', function() {
            if (this.value) {
                // Use regex with word boundaries to match exact grade (e.g. "Kelas X" but not "Kelas XI" or "Kelas XII")
                table.column(2).search('\\b' + this.value + '\\b', true, false).draw();
            } else {
                table.column(2).search('').draw();
            }
        });

        // Form parameter mapper
        $('#addClassroomForm').on('submit', function(e) {
            // Map namaKelas -> name
            const nameVal = $('#inputNamaKelas').val();
            // Map waliKelas -> homeroom_teacher_id
            const waliVal = $('#selectWaliKelas').val();

            $(this).append('<input type="hidden" name="name" value="' + nameVal + '">');
            if (waliVal) {
                $(this).append('<input type="hidden" name="homeroom_teacher_id" value="' + waliVal + '">');
            }
        });
    });

    function showGenerateInfo() {
        document.getElementById('sopModal').classList.remove('hidden');
        document.getElementById('sopModal').classList.add('flex');
    }

    function closeSopModal() {
        document.getElementById('sopModal').classList.add('hidden');
        document.getElementById('sopModal').classList.remove('flex');
    }
</script>
@endpush
@endsection