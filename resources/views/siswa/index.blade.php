@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<!-- Custom Styles for Table and Buttons -->
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
        background: #e87722 !important;
        border-color: #e87722 !important;
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

<div class="flex flex-col gap-6" style="height: calc(100vh - 152px);"> <!-- 152px is approx padding top & bottom from layout -->
    <!-- Static Header & Summary Cards Container -->
    <div class="flex-shrink-0 space-y-6">
        <!-- Page Header (Clean, outside the card) -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Data Siswa</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola informasi dan data induk siswa SMAN 1 Cepogo.</p>
            </div>
        </div>

        <!-- Metrik Summary Cards (Premium Minimalist Styling) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="stat-card border-l-4 border-l-[#e87722] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Siswa Terdaftar</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $students->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#e87722] dark:bg-orange-950/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>

            <div class="stat-card border-l-4 border-l-[#00B074] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Siswa Aktif</p>
                    <p class="text-2xl font-bold text-[#00B074] mt-1">{{ $students->where('status', 'active')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#00B074] dark:bg-emerald-950/20 dark:text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>

            <div class="stat-card border-l-4 border-l-[#3B82F6] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Siswa Laki-Laki</p>
                    <p class="text-2xl font-bold text-[#3B82F6] mt-1">{{ $students->where('jenis_kelamin', 'Laki-laki')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#3B82F6] dark:bg-blue-950/20 dark:text-blue-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-mars"></i>
                </div>
            </div>

            <div class="stat-card border-l-4 border-l-[#EC4899] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Siswa Perempuan</p>
                    <p class="text-2xl font-bold text-[#EC4899] mt-1">{{ $students->where('jenis_kelamin', 'Perempuan')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-pink-50 text-[#EC4899] dark:bg-pink-950/20 dark:text-pink-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-venus"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm flex-1 flex flex-col min-h-0">
        <!-- Academic Toolbar (Filter Area) -->
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4 mb-6 flex-shrink-0">
            <!-- Left Filters -->
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <input type="text" id="toolbarSearch" placeholder="Cari nama atau NIS..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>
                
                <!-- Class Dropdown -->
                <div class="relative w-full sm:w-48">
                    <select id="toolbarClass" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Kelas</option>
                        @php
                            $classes = $students->pluck('kelas')->unique()->filter()->sort();
                        @endphp
                        @foreach($classes as $kelas)
                            <option value="{{ $kelas }}">{{ $kelas }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <!-- Status Dropdown -->
                <div class="relative w-full sm:w-48">
                    <select id="toolbarStatus" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="aktif_nonaktif">Aktif & Nonaktif</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                        <option value="Lulus">Lulus (Alumni)</option>
                        <option value="">Semua Status</option>
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <!-- Tahun Lulus Dropdown -->
                <div class="relative w-full sm:w-40" id="filterTahunLulusContainer" style="display: none;">
                    <select id="toolbarGraduationYear" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Angkatan</option>
                        @foreach($tahunLulusList as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <!-- Reset Button -->
                <button onclick="resetToolbarFilters()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 text-xxs font-bold px-3 py-2.5 rounded-xl flex items-center gap-1.5 transition">
                    <i class="fas fa-arrows-rotate text-xxs"></i>
                    <span>Reset</span>
                </button>
            </div>

            <!-- Right Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Dropdown: Data Excel -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" type="button" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                        <i class="fas fa-file-excel text-emerald-600"></i>
                        <span>Data Excel</span>
                        <i class="fas fa-chevron-down text-[10px] ml-0.5"></i>
                    </button>
                    <!-- Dropdown List -->
                    <div x-show="open" style="display: none;" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-10 py-1.5">
                        <button type="button" onclick="downloadExcel(); open = false" class="w-full text-left px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-2">
                            <i class="fas fa-download text-slate-400"></i>
                            <span>Download Excel</span>
                        </button>
                        @if(auth()->user()->isSuperAdmin())
                        <button type="button" onclick="openImportModal(); open = false" class="w-full text-left px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-2">
                            <i class="fas fa-upload text-slate-400"></i>
                            <span>Import Excel</span>
                        </button>
                        @endif
                    </div>
                </div>

                @if(auth()->user()->isSuperAdmin())
                <!-- Dropdown: Aksi Massal / Utilitas -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" type="button" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                        <i class="fas fa-cogs text-orange-500"></i>
                        <span>Aksi Sistem</span>
                        <i class="fas fa-chevron-down text-[10px] ml-0.5"></i>
                    </button>
                    <!-- Dropdown List -->
                    <div x-show="open" style="display: none;" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-10 py-1.5">
                        <!-- Generate Akun -->
                        <form action="{{ route('students.generate-accounts') }}" method="POST" onsubmit="return confirm('Generate akun login otomatis untuk siswa yang belum memilikinya?')">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                                <i class="fas fa-users-cog text-sky-500 w-4 text-center"></i>
                                <span class="font-medium">Generate Akun Login</span>
                            </button>
                        </form>
                        <!-- Plotting Otomatis -->
                        <button type="button" onclick="openPlottingModal(); open = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                            <i class="fas fa-random text-indigo-500 w-4 text-center"></i>
                            <span class="font-medium">Plotting Siswa Otomatis</span>
                        </button>
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                        <!-- Kenaikan & Kelulusan -->
                        <button type="button" onclick="openKelulusanKenaikanModal(); open = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-orange-500 w-4 text-center"></i>
                            <span class="font-medium">Kenaikan & Kelulusan</span>
                        </button>
                    </div>
                </div>

                <!-- Tambah Manual -->
                <button type="button" onclick="openAddModal()" class="btn bg-orange-500 hover:bg-orange-600 text-white font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Siswa</span>
                </button>
                @endif
            </div>
        </div>

        <!-- Skeleton Loading -->
        <div id="skeletonLoading" class="hidden space-y-4 flex-shrink-0">
            @for($i = 0; $i < 5; $i++)
            <div class="animate-pulse flex items-center justify-between p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl">
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
        <div id="studentsTableContainer" class="overflow-x-auto flex-1 min-h-0 overflow-y-auto pb-4">
            <table id="studentsTable" class="w-full border-collapse border border-slate-300 dark:border-slate-600 bg-white text-sm whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-100 dark:bg-slate-800 border-b border-slate-300 dark:border-slate-600">
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">No</th>
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-left font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">NIS</th>
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-left font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">Nama Lengkap</th>
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-left font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">Email</th>
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">Kelas</th>
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">L/P</th>
                        <th class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">Status</th>
                        <th class="hidden">Tahun Lulus</th>
                        <th class="px-3 py-2 text-center font-semibold text-slate-800 dark:text-slate-200 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($students as $student)
                    <tr class="hover:bg-sky-50 dark:hover:bg-slate-700/50 transition border-b border-slate-300 dark:border-slate-600">
                        <!-- No -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-slate-700 dark:text-slate-300 text-center">{{ $no++ }}</td>
                        <!-- NIS -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 font-mono text-slate-700 dark:text-slate-300">{{ $student->nis }}</td>
                        <!-- Nama Lengkap -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 font-medium text-slate-800 dark:text-slate-100">{{ $student->nama }}</td>
                        <!-- Email -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-slate-500 dark:text-slate-400">{{ $student->user->email ?? '-' }}</td>
                        <!-- Kelas -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center text-slate-700 dark:text-slate-300">{{ $student->kelas ?? '-' }}</td>
                        <!-- L/P -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center text-slate-700 dark:text-slate-300">{{ $student->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                        <!-- Status -->
                        <td class="border-r border-slate-300 dark:border-slate-600 px-3 py-2 text-center">
                            @if($student->status == 'active')
                            <span class="text-emerald-600 font-medium">Aktif</span>
                            @elseif($student->status == 'lulus')
                            <span class="text-slate-500 font-medium">Lulus</span>
                            @else
                            <span class="text-rose-600 font-medium">Nonaktif</span>
                            @endif
                        </td>
                        <!-- Tahun Lulus (Hidden) -->
                        <td class="hidden">{{ $student->tahun_lulus ?? '-' }}</td>
                        <!-- Aksi -->
                        <td class="px-3 py-2 text-center">
                            <div class="inline-flex items-center gap-1.5">
                                @if(auth()->user()->isSuperAdmin() && $student->status == 'inactive')
                                <form action="{{ route('students.approve', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 text-[11px] font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-600 hover:text-white rounded transition" title="Setujui (ACC)">
                                        ACC
                                    </button>
                                </form>
                                @endif
                                @can('edit_siswa')
                                @if($student->status == 'active')
                                <button type="button" onclick="openMutasiKeluarModal({{ $student->id }}, '{{ addslashes($student->nama) }}')" class="px-2 py-1 text-[11px] font-medium text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-600 hover:text-white rounded transition" title="Mutasi Keluar">
                                    Mutasi
                                </button>
                                @endif
                                @endcan
                                @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('students.edit', $student->id) }}" class="px-2 py-1 text-[11px] font-medium text-sky-700 bg-sky-50 border border-sky-200 hover:bg-sky-600 hover:text-white rounded transition">
                                    Edit
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data siswa ini?')">
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
      MODAL POPUP: TAMBAH SISWA MANUAL
     ========================================== -->
@if(auth()->user()->isSuperAdmin())
<div id="addStudentModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-user-plus mr-2"></i>Tambah Siswa Baru</h3>
            <button onclick="closeAddModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('students.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- NIS -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nomor Induk Siswa (NIS)</label>
                    <input type="text" name="nis" required placeholder="Contoh: 23241001" class="input" />
                </div>
                <!-- Nama Lengkap -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Nama Lengkap Siswa" class="input" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Jenis Kelamin -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jenis Kelamin</label>
                    <select name="gender" required class="input">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <!-- Tanggal Lahir -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" required class="input" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Kelas -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas</label>
                    <select name="kelas" required class="input">
                        <option value="">Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <!-- Status Akademik -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Akademik</label>
                    <select name="status" required class="input">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Nama Ortu -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Orang Tua / Wali</label>
                    <input type="text" name="parent_name" placeholder="Nama Orang Tua/Wali" class="input" />
                </div>
                <!-- HP Ortu -->
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">No HP Orang Tua / Wali</label>
                    <input type="text" name="phone" placeholder="Contoh: 0812345678" class="input" />
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Alamat tinggal siswa..." class="input py-2 resize-none"></textarea>
            </div>

            <!-- Mutasi Masuk (Siswa Pindahan) -->
            <div class="border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                <label class="flex items-center gap-2 cursor-pointer mb-3">
                    <input type="checkbox" name="is_pindahan" value="1" id="isPindahanCheckbox" onchange="togglePindahanFields()" class="rounded border-slate-300 text-orange-500 focus:ring-orange-500" />
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Merupakan Siswa Pindahan?</span>
                </label>
                <div id="pindahanFields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-5 bg-orange-50/50 dark:bg-slate-800/30 p-4 rounded-xl border border-orange-100 dark:border-slate-700/50">
                    <div>
                        <label class="field-label mb-1.5 block text-xs font-bold text-orange-700 dark:text-orange-400 uppercase tracking-wider">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" id="asalSekolahInput" placeholder="Contoh: SMA N 2 Surakarta" class="input bg-white dark:bg-slate-900" />
                    </div>
                    <div>
                        <label class="field-label mb-1.5 block text-xs font-bold text-orange-700 dark:text-orange-400 uppercase tracking-wider">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" id="tanggalMasukInput" class="input bg-white dark:bg-slate-900" />
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeAddModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl">Batal</button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10">Simpan Siswa</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: IMPOR DATA EXCEL
     ========================================== -->
<div id="importExcelModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-file-excel mr-2"></i>Impor Data Siswa</h3>
            <button onclick="closeImportModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-5" onsubmit="event.preventDefault(); alert('Simulasi Impor: Fitur Excel Parser siap diintegrasikan!'); closeImportModal();">
            @csrf
            
            <div class="text-center p-4 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl bg-slate-50 dark:bg-slate-800/40">
                <i class="fas fa-cloud-upload-alt text-4xl text-orange-500 mb-3"></i>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pilih berkas template excel</p>
                <p class="text-xs text-slate-400 mt-1 mb-4">Mendukung file (.xls, .xlsx)</p>
                <input type="file" required name="excel_file" class="hidden" id="excel_file_input" onchange="document.getElementById('fileNameText').innerText = this.files[0] ? this.files[0].name : ''" />
                <button type="button" onclick="document.getElementById('excel_file_input').click()" class="btn border border-orange-500 text-orange-500 hover:bg-orange-50 px-4 py-2 rounded-xl text-xs font-bold transition">Pilih File</button>
                <p id="fileNameText" class="text-xs text-slate-600 dark:text-slate-400 mt-2 font-mono truncate"></p>
            </div>

            <div class="text-xs text-slate-400 leading-normal">
                <i class="fas fa-info-circle mr-1"></i> Pastikan struktur kolom template Excel sesuai format: <b>NIS | NAMA | KELAS | JENIS_KELAMIN | NAMA_ORTU | NO_HP</b>.
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeImportModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl">Batal</button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-lg shadow-orange-500/10">Mulai Impor</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: PLOTTING SISWA OTOMATIS
     ========================================== -->
<div id="modalPlottingSiswa" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-random mr-2"></i>Plotting Siswa Otomatis</h3>
            <button onclick="closePlottingModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('students.auto-plot') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div class="space-y-2">
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Tahun Ajaran Target</label>
                <div class="relative">
                    <select name="tahun_ajaran" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        @php
                            $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
                            $academicYearsList = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                                ->select('academic_year')
                                ->distinct()
                                ->orderBy('academic_year', 'desc')
                                ->pluck('academic_year')
                                ->toArray();
                            
                            $customYears = json_decode(\App\Models\Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
                            if (is_array($customYears)) {
                                $academicYearsList = array_unique(array_merge($academicYearsList, $customYears));
                            }
                            rsort($academicYearsList);
                            if (empty($academicYearsList)) {
                                $academicYearsList = [$activeYear];
                            }
                        @endphp
                        @foreach($academicYearsList as $year)
                            <option value="{{ $year }}" {{ $year == $activeYear ? 'selected' : '' }}>T.A. {{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-orange-50/50 dark:bg-slate-800/50 border border-orange-100 dark:border-slate-800 space-y-2 text-xxs text-slate-500 dark:text-slate-400 leading-relaxed">
                <p class="font-bold text-orange-600 dark:text-orange-400 uppercase tracking-wider"><i class="fas fa-info-circle mr-1"></i> Cara Kerja Plotting:</p>
                <ul class="list-disc pl-4 space-y-1">
                    <li>Sistem hanya memproses siswa dengan status <b>Aktif</b>.</li>
                    <li>Siswa dengan kelas spesifik (misal: "X IPA 1") akan langsung ditempatkan di kelas tersebut. Jika kelas belum ada di T.A. target, sistem akan membuatnya secara otomatis.</li>
                    <li>Siswa dengan kelas kelompok (misal: "X IPA") akan didistribusikan secara merata ke kelas-kelas aktif sesuai sisa kapasitas masing-masing kelas.</li>
                    <li>Siswa dengan kelas kosong/tidak valid akan dilewati.</li>
                </ul>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closePlottingModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl">Batal</button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-lg shadow-orange-500/10">Mulai Plotting</button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- ==========================================
      MODAL POPUP: MUTASI KELUAR
     ========================================== -->
@can('edit_siswa')
<div id="modalMutasiKeluar" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-door-open mr-2"></i>Form Mutasi Keluar</h3>
            <button onclick="closeMutasiKeluarModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form id="formMutasiKeluar" method="POST" action="" class="p-6 space-y-5">
            @csrf
            
            <div class="p-3 bg-orange-50 dark:bg-slate-800/50 rounded-xl border border-orange-100 dark:border-slate-700">
                <p class="text-xs text-orange-700 dark:text-orange-400 font-semibold mb-1">Nama Siswa:</p>
                <p class="text-sm font-bold text-slate-800 dark:text-slate-100" id="mutasiStudentName">Nama Siswa</p>
            </div>

            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jenis Mutasi</label>
                <select name="jenis_mutasi" required class="input">
                    <option value="keluar">Pindah Sekolah</option>
                    <option value="dikeluarkan">Dikeluarkan</option>
                    <option value="mengundurkan diri">Mengundurkan Diri</option>
                </select>
            </div>
            
            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal Mutasi</label>
                <input type="date" name="tanggal_mutasi" required value="{{ date('Y-m-d') }}" class="input" />
            </div>

            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Keterangan / Tujuan (Opsional)</label>
                <input type="text" name="keterangan_sekolah" placeholder="Contoh: Pindah ke SMA N 2 Solo" class="input" />
            </div>
            
            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alasan (Opsional)</label>
                <textarea name="alasan" rows="2" placeholder="Alasan pindah atau dikeluarkan..." class="input py-2 resize-none"></textarea>
            </div>

            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeMutasiKeluarModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs">Batal</button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs">Proses Mutasi</button>
            </div>
        </form>
    </div>
</div>
@endcan

<!-- ==========================================
      MODAL POPUP: KELULUSAN & KENAIKAN KELAS
     ========================================== -->
<div id="modalKelulusanKenaikan" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800 flex flex-col max-h-[90vh]">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500 flex-shrink-0">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-graduation-cap mr-2"></i>Kelulusan & Kenaikan Kelas Massal</h3>
            <button onclick="closeKelulusanKenaikanModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        
        <!-- Tab Navigation -->
        <div class="flex border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 flex-shrink-0">
            <button type="button" onclick="switchTab('kelulusan')" id="tab-kelulusan" class="w-1/2 py-3 text-sm font-bold text-orange-500 border-b-2 border-orange-500 transition">
                🎓 Kelulusan Kelas XII
            </button>
            <button type="button" onclick="switchTab('kenaikan')" id="tab-kenaikan" class="w-1/2 py-3 text-sm font-bold text-slate-500 hover:text-slate-750 dark:hover:text-slate-350 border-b-2 border-transparent transition">
                📈 Kenaikan Kelas (X & XI)
            </button>
        </div>

        <!-- Form & Content -->
        <div class="p-6 overflow-y-auto flex-grow">
            <!-- TAB: KELULUSAN -->
            <form id="formKelulusan" action="{{ route('students.bulk-graduate') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Kelas XII Yang Lulus</label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="toggleAllClasses(true)" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Centang Semua</button>
                            <button type="button" onclick="toggleAllClasses(false)" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Hapus Semua</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="kelasTwelveContainer">
                        @foreach($daftarKelasAsal->filter(fn($c) => stripos($c, 'xii') === 0 || stripos($c, '12') === 0) as $kelas)
                            <label class="flex items-center gap-2 p-2.5 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer">
                                <input type="checkbox" name="kelas[]" value="{{ $kelas }}" onchange="loadStudentsForGraduation()" class="kelas-checkbox rounded border-slate-300 text-orange-500 focus:ring-orange-500" />
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $kelas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Student List Area for Graduation -->
                <div id="gradStudentsSection" class="space-y-2 hidden">
                    <div class="flex items-center justify-between">
                        <label class="field-label block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Daftar Siswa (Centang yang Lulus)</label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="toggleAllCheckboxes('gradStudentsList', true, 'updateGradCount')" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Centang Semua</button>
                            <button type="button" onclick="toggleAllCheckboxes('gradStudentsList', false, 'updateGradCount')" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Hapus Semua</button>
                            <span class="text-[10px] text-slate-400 font-bold ml-1" id="gradSelectedCount">0 siswa terpilih</span>
                        </div>
                    </div>
                    
                    <!-- Search Input inside Modal -->
                    <div class="relative">
                        <input type="text" id="searchGradStudents" placeholder="Cari nama siswa..." class="w-full rounded-xl border border-slate-200 bg-white pl-9 pr-4 py-2 text-xs text-slate-700 placeholder-slate-400 focus:border-orange-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fas fa-search text-xs"></i>
                        </div>
                    </div>

                    <!-- Scrollable list of checkboxes -->
                    <div class="border border-slate-200 dark:border-slate-800 rounded-xl max-h-48 overflow-y-auto p-3 space-y-2" id="gradStudentsList">
                        <!-- Populated via Javascript -->
                    </div>
                </div>

                <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="closeKelulusanKenaikanModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs">Batal</button>
                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs">Proses Kelulusan</button>
                </div>
            </form>

            <!-- TAB: KENAIKAN -->
            <form id="formKenaikan" action="{{ route('students.bulk-promote') }}" method="POST" class="space-y-4 hidden">
                @csrf
                <div class="mb-2 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-100 dark:border-slate-800">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed max-w-md">
                        Pilih kelas tujuan untuk masing-masing kelas asal. Kosongkan kelas tujuan jika kelas tersebut tidak ingin dinaikkan massal saat ini.
                    </p>
                    <button type="button" onclick="autoMatchClasses()" class="btn bg-orange-50 hover:bg-orange-100 text-orange-600 border border-orange-200 dark:bg-orange-950/20 dark:border-orange-500/30 dark:text-orange-400 text-xxs font-bold px-3 py-2 rounded-xl flex items-center gap-1.5 transition flex-shrink-0 shadow-sm">
                        <i class="fas fa-magic text-xxs"></i>
                        <span>Cocokkan Otomatis</span>
                    </button>
                </div>
                
                <div class="max-h-[50vh] overflow-y-auto border border-slate-200 dark:border-slate-800 rounded-xl">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 sticky top-0 z-10">
                            <tr>
                                <th class="py-2 px-4 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider border-b border-slate-200 dark:border-slate-800">Kelas Asal (X / XI)</th>
                                <th class="py-2 px-4 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider border-b border-slate-200 dark:border-slate-800">Kelas Tujuan (XI / XII)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                            @foreach($daftarKelasAsal->filter(fn($c) => stripos($c, 'xii') !== 0 && stripos($c, '12') !== 0) as $index => $kelas)
                            <tr class="odd:bg-white even:bg-slate-50/50 dark:odd:bg-slate-900 dark:even:bg-slate-800/10 hover:bg-slate-100/50 dark:hover:bg-slate-800/35 transition-colors">
                                <td class="py-2.5 px-4 w-1/2">
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $kelas }}</span>
                                    <input type="hidden" name="mapping[{{ $index }}][asal]" value="{{ $kelas }}">
                                </td>
                                <td class="py-2.5 px-4 w-1/2">
                                    <select name="mapping[{{ $index }}][tujuan]" class="input py-1.5 px-3 text-xs w-full auto-mapping-select" data-asal="{{ $kelas }}">
                                        <option value="">-- Jangan Naikkan Dulu --</option>
                                        @php
                                            $parts = explode(' ', trim($kelas));
                                            $jurusan = count($parts) > 1 ? $parts[1] : '';
                                            $tingkatAsal = strtoupper($parts[0]);
                                            $tingkatTujuan = [];
                                            
                                            // Tentukan tingkat tujuan berdasarkan tingkat asal
                                            if ($tingkatAsal === 'X' || $tingkatAsal === '10') $tingkatTujuan = ['XI', '11'];
                                            elseif ($tingkatAsal === 'XI' || $tingkatAsal === '11') $tingkatTujuan = ['XII', '12'];
                                            
                                            $classroomsRaw = \App\Models\Kelas::orderBy('name', 'asc')->get();
                                            $filteredClasses = $classroomsRaw->filter(function($c) use ($jurusan, $tingkatTujuan) {
                                                $name = strtoupper($c->name);
                                                // Filter jurusan (IPA/IPS dll)
                                                if ($jurusan !== '' && strpos($name, strtoupper($jurusan)) === false) return false;
                                                
                                                // Filter tingkat kelas selanjutnya
                                                if (!empty($tingkatTujuan)) {
                                                    $matchTingkat = false;
                                                    foreach ($tingkatTujuan as $t) {
                                                        if (strpos($name, $t . ' ') === 0 || $name === $t) {
                                                            $matchTingkat = true; break;
                                                        }
                                                    }
                                                    if (!$matchTingkat) return false;
                                                }
                                                return true;
                                            });
                                        @endphp
                                        @foreach($filteredClasses as $k)
                                            <option value="{{ $k->name }}">{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="closeKelulusanKenaikanModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs">Batal</button>
                    <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs">Proses Kenaikan Massal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Kelulusan & Kenaikan Modal controls
    function openKelulusanKenaikanModal() {
        $('#modalKelulusanKenaikan').removeClass('hidden');
        $('body').addClass('overflow-hidden');
        switchTab('kelulusan');
        resetKelulusanKenaikanForm();
    }

    function closeKelulusanKenaikanModal() {
        $('#modalKelulusanKenaikan').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    function resetKelulusanKenaikanForm() {
        const cbs = document.querySelectorAll('#kelasTwelveContainer .kelas-checkbox');
        cbs.forEach(cb => cb.checked = false);
        $('#gradStudentsList').html('');
        $('#gradStudentsSection').addClass('hidden');
        $('#gradSelectedCount').text('0 siswa terpilih');
        
        // Reset mapping select dropdowns to empty state if any
        document.querySelectorAll('.auto-mapping-select').forEach(select => {
            select.selectedIndex = 0;
        });
    }

    function switchTab(tab) {
        if (tab === 'kenaikan') {
            $('#tab-kenaikan').addClass('text-orange-500 border-orange-500').removeClass('text-slate-500 border-transparent');
            $('#tab-kelulusan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            
            $('#formKenaikan').removeClass('hidden');
            $('#formKelulusan').addClass('hidden');
        }
        if (tab === 'kelulusan') {
            $('#tab-kelulusan').addClass('text-orange-500 border-orange-500').removeClass('text-slate-500 border-transparent');
            $('#tab-kenaikan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            
            $('#formKelulusan').removeClass('hidden');
            $('#formKenaikan').addClass('hidden');
        }
    }

    function loadStudentsForGraduation() {
        const checkedClasses = [];
        $('#kelasTwelveContainer input[name="kelas[]"]:checked').each(function() {
            checkedClasses.push($(this).val());
        });

        if (checkedClasses.length === 0) {
            $('#gradStudentsList').html('');
            $('#gradStudentsSection').addClass('hidden');
            $('#gradSelectedCount').text('0 siswa terpilih');
            return;
        }

        fetch(`{{ route('students.by-classes') }}?kelas=${checkedClasses.join(',')}`)
            .then(res => res.json())
            .then(data => {
                let html = '';
                if (data.length === 0) {
                    html = '<p class="text-xs text-slate-400 text-center py-4">Tidak ada siswa aktif di kelas ini.</p>';
                } else {
                    data.forEach(student => {
                        html += `
                            <label class="flex items-center justify-between p-2 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg cursor-pointer border border-transparent hover:border-slate-100 dark:hover:border-slate-700/50 student-item" data-name="${student.nama.toLowerCase()}">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="id_siswa[]" value="${student.id}" checked class="student-checkbox rounded border-slate-300 text-orange-500 focus:ring-orange-500" onchange="updateGradCount()" />
                                    <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">${student.nama} <span class="text-xxs text-slate-400 font-mono">(${student.nis})</span></span>
                                </div>
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 dark:text-slate-400 rounded-md font-mono">${student.kelas}</span>
                            </label>
                        `;
                    });
                }
                $('#gradStudentsList').html(html);
                $('#gradStudentsSection').removeClass('hidden');
                updateGradCount();
            });
    }

    function updateGradCount() {
        const total = $('#gradStudentsList input[type="checkbox"]').length;
        const checked = $('#gradStudentsList input[type="checkbox"]:checked').length;
        $('#gradSelectedCount').text(`${checked} dari ${total} siswa terpilih`);
    }

    // Bind event handler for search input inside modal
    $(document).on('keyup', '#searchGradStudents', function() {
        const keyword = $(this).val().toLowerCase();
        $('#gradStudentsList .student-item').each(function() {
            const name = $(this).attr('data-name');
            if (name.includes(keyword)) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    });
    function toggleAllClasses(isChecked) {
        const container = document.getElementById('kelasTwelveContainer');
        if (!container) return;
        const checkboxes = container.querySelectorAll('.kelas-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = isChecked;
        });
        loadStudentsForGraduation();
    }

    function toggleAllCheckboxes(containerId, isChecked, updateCallback) {
        const container = document.getElementById(containerId);
        if (!container) return;
        const checkboxes = container.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => {
            // Only affect visible (non-filtered) checkboxes
            if (cb.closest('label') && cb.closest('label').style.display !== 'none') {
                cb.checked = isChecked;
            }
        });
        if (updateCallback === 'updateGradCount' && typeof updateGradCount === 'function') updateGradCount();
        if (updateCallback === 'updatePromoCount' && typeof updatePromoCount === 'function') updatePromoCount();
    }

    // Auto Match Classes function
    function autoMatchClasses() {
        document.querySelectorAll('.auto-mapping-select').forEach(select => {
            const asal = select.getAttribute('data-asal');
            if (!asal) return;
            
            const cleanAsal = asal.trim().toUpperCase();
            
            // Tentukan pola nama kelas tujuan yang diharapkan (misal XI F 1 -> XII F 1)
            let targetName = '';
            if (cleanAsal.startsWith('XI ')) {
                targetName = cleanAsal.replace(/^XI /, 'XII ');
            } else if (cleanAsal.startsWith('XI.')) {
                targetName = cleanAsal.replace(/^XI\./, 'XII.');
            } else if (cleanAsal.startsWith('XI')) {
                targetName = cleanAsal.replace(/^XI/, 'XII');
            } else if (cleanAsal.startsWith('X ')) {
                targetName = cleanAsal.replace(/^X /, 'XI ');
            } else if (cleanAsal.startsWith('X.')) {
                targetName = cleanAsal.replace(/^X\./, 'XI.');
            } else if (cleanAsal.startsWith('X')) {
                targetName = cleanAsal.replace(/^X/, 'XI');
            }
            
            // 1. Coba pencocokan nama secara persis (Exact Match)
            let found = false;
            for (let i = 0; i < select.options.length; i++) {
                const optVal = select.options[i].value.trim().toUpperCase();
                if (optVal === targetName) {
                    select.selectedIndex = i;
                    found = true;
                    break;
                }
            }
            
            // 2. Jika tidak cocok persis (misal ada rombel yang berubah format), cocokkan berdasarkan akhiran/suffix (misal F 1, F 2.1)
            if (!found && targetName) {
                const parts = cleanAsal.split(' ');
                if (parts.length > 1) {
                    const suffix = parts.slice(1).join(' ');
                    for (let i = 0; i < select.options.length; i++) {
                        const optVal = select.options[i].value.trim().toUpperCase();
                        if (optVal.endsWith(suffix)) {
                            select.selectedIndex = i;
                            found = true;
                            break;
                        }
                    }
                }
            }

            // 3. Khusus Kelas X (X.1 s.d X.7) yang dipetakan ke XI penjurusan (XI F 1 s.d XI F 4.2)
            if (!found && (cleanAsal.startsWith('X.') || cleanAsal.startsWith('X '))) {
                const numMatch = cleanAsal.match(/\d+$/);
                if (numMatch) {
                    const num = parseInt(numMatch[0]);
                    let targetKeyword = '';
                    if (num === 1) targetKeyword = 'F 1';
                    else if (num === 2) targetKeyword = 'F 2.1';
                    else if (num === 3) targetKeyword = 'F 3.1';
                    else if (num === 4) targetKeyword = 'F 4.1';
                    else if (num === 5) targetKeyword = 'F 2.2';
                    else if (num === 6) targetKeyword = 'F 3.2';
                    else if (num === 7) targetKeyword = 'F 4.2';
                    
                    if (targetKeyword) {
                        for (let i = 0; i < select.options.length; i++) {
                            const optVal = select.options[i].value.trim().toUpperCase();
                            if (optVal.includes(targetKeyword)) {
                                select.selectedIndex = i;
                                found = true;
                                break;
                            }
                        }
                    }
                }
            }
        });
    }

    // Toggle Fields for Siswa Pindahan
    function togglePindahanFields() {
        const checkbox = document.getElementById('isPindahanCheckbox');
        const fields = document.getElementById('pindahanFields');
        const asalSekolah = document.getElementById('asalSekolahInput');
        const tanggalMasuk = document.getElementById('tanggalMasukInput');
        
        if (checkbox && checkbox.checked) {
            fields.classList.remove('hidden');
            asalSekolah.required = true;
            tanggalMasuk.required = true;
        } else if (checkbox) {
            fields.classList.add('hidden');
            asalSekolah.required = false;
            tanggalMasuk.required = false;
        }
    }

    // Modal Mutasi Keluar
    function openMutasiKeluarModal(studentId, studentName) {
        const form = document.getElementById('formMutasiKeluar');
        form.action = `/students/${studentId}/mutasi`;
        document.getElementById('mutasiStudentName').textContent = studentName;
        
        $('#modalMutasiKeluar').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    
    function closeMutasiKeluarModal() {
        $('#modalMutasiKeluar').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Modal controls
    function openAddModal() {
        $('#addStudentModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeAddModal() {
        $('#addStudentModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }
    function openImportModal() {
        $('#importExcelModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeImportModal() {
        $('#importExcelModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }
    function openPlottingModal() {
        $('#modalPlottingSiswa').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closePlottingModal() {
        $('#modalPlottingSiswa').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Trigger DataTables Excel Export
    function downloadExcel() {
        $('#studentsTable').DataTable().button('.buttons-excel').trigger();
    }

    // Toolbar Filters Reset Function
    function resetToolbarFilters() {
        $('#toolbarSearch').val('');
        $('#toolbarClass').val('');
        $('#toolbarStatus').val('aktif_nonaktif');
        $('#toolbarGraduationYear').val('');
        $('#filterTahunLulusContainer').hide();
        
        const table = $('#studentsTable').DataTable();
        table.search('')
             .columns().search('')
             .column(6).search('Aktif|Nonaktif', true, false)
             .draw();
    }

    $(document).ready(function() {
        // Show loading skeleton while table is rendering
        $('#skeletonLoading').removeClass('hidden');
        $('#studentsTableContainer').addClass('hidden');

        const table = $('#studentsTable').DataTable({
            dom: 'rt<"flex flex-col md:flex-row justify-between items-center py-4 px-6 border-t border-slate-100 dark:border-slate-800 gap-4"ip>',
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'buttons-excel',
                    title: '{{ \App\Models\Pengaturan::getValue("school_name", "SMAN 1 Cepogo") }}',
                    messageTop: 'Laporan Data Siswa',
                    filename: 'Data_Siswa_' + new Date().toISOString().slice(0, 10),
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7] // Mengabaikan kolom Aksi (indeks 8)
                    }
                }
            ],
            language: {
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            },
        // responsive removed
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0
                }
            ],
            order: [[ 4, "asc" ]] // Order by Kelas by default
        });

        // Auto-renumbering baris berdasarkan hasil filter/sortir DataTables
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        });

        // Hide skeleton and show table
        $('#skeletonLoading').addClass('hidden');
        $('#studentsTableContainer').removeClass('hidden');
        table.columns.adjust();

        // Binds toolbar search input to datatable search API
        $('#toolbarSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Binds Class filter dropdown
        $('#toolbarClass').on('change', function() {
            table.column(4).search(this.value).draw();
        });

        // Binds Status filter dropdown with custom logic for 'aktif_nonaktif'
        $('#toolbarStatus').on('change', function() {
            if (this.value === 'aktif_nonaktif') {
                table.column(6).search('Aktif|Nonaktif', true, false).draw();
                $('#filterTahunLulusContainer').hide();
                $('#toolbarGraduationYear').val('');
                table.column(7).search('').draw();
            } else if (this.value === 'Lulus') {
                table.column(6).search('Lulus').draw();
                $('#filterTahunLulusContainer').show();
            } else {
                table.column(6).search(this.value).draw();
                $('#filterTahunLulusContainer').hide();
                $('#toolbarGraduationYear').val('');
                table.column(7).search('').draw();
            }
        });

        // Binds Graduation Year filter dropdown
        $('#toolbarGraduationYear').on('change', function() {
            table.column(7).search(this.value).draw();
        });

        // Apply default status filter on load (Show Aktif & Nonaktif only, hide Lulus/Alumni)
        table.column(6).search('Aktif|Nonaktif', true, false).draw();
    });
</script>
@endpush
@endsection
