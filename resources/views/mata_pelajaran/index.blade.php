@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
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

<div class="flex flex-col gap-6" style="height: calc(100vh - 152px);"> <!-- 152px is approx padding top & bottom from layout -->
    <!-- Static Header & Summary Cards Container -->
    <div class="flex-shrink-0 space-y-6">
        <!-- Page Header (Clean, outside the card) -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Data Mata Pelajaran</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola data induk kurikulum mata pelajaran SMAN 1 Cepogo.</p>
            </div>
        </div>

        <!-- Metrik Summary Cards (Premium Minimalist Styling - 4 Columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Mata Pelajaran -->
            <div class="stat-card border-l-4 border-l-[#D65A20] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Mata Pelajaran</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $courses->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-book"></i>
                </div>
            </div>

            <!-- Tingkat X -->
            <div class="stat-card border-l-4 border-l-[#00B074] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tingkat X</p>
                    <p class="text-2xl font-bold text-[#00B074] mt-1">{{ $courses->where('tingkat', 'X')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#00B074] dark:bg-emerald-950/20 dark:text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-bookmark"></i>
                </div>
            </div>

            <!-- Tingkat XI -->
            <div class="stat-card border-l-4 border-l-[#3B82F6] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tingkat XI</p>
                    <p class="text-2xl font-bold text-[#3B82F6] mt-1">{{ $courses->where('tingkat', 'XI')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#3B82F6] dark:bg-blue-950/20 dark:text-blue-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-bookmark"></i>
                </div>
            </div>

            <!-- Tingkat XII -->
            <div class="stat-card border-l-4 border-l-[#8B5CF6] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tingkat XII</p>
                    <p class="text-2xl font-bold text-[#8B5CF6] mt-1">{{ $courses->where('tingkat', 'XII')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-[#8B5CF6] dark:bg-purple-950/20 dark:text-purple-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-bookmark"></i>
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
                    <input type="text" id="toolbarSearch" placeholder="Cari kode atau nama mata pelajaran..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>
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
                    <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5">
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
                <!-- Tambah Manual -->
                <button type="button" onclick="openAddModal()" class="btn btn-orange-solid font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Mata Pelajaran</span>
                </button>
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
        <div id="coursesTableContainer" class="overflow-x-auto flex-1 min-h-0 overflow-y-auto pb-4">
            <table id="coursesTable" class="w-full border-collapse border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-900 text-sm whitespace-nowrap">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-sm">
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">No</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Kode</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Nama Mata Pelajaran</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Tingkat</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Status</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky right-0 top-0 z-30">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $index => $course)
                    <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition group">
                        <!-- No -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 text-center">{{ $index + 1 }}</td>
                        <!-- Kode -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 font-mono text-slate-700 dark:text-slate-300">{{ $course->kode }}</td>
                        <!-- Nama Mata Pelajaran -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5">
                            <div class="min-w-0">
                                <span class="font-bold text-slate-800 dark:text-slate-100 block">{{ $course->nama }}</span>
                                <span class="text-[11px] text-slate-500 block">{{ $course->deskripsi ?? 'Tidak ada deskripsi' }}</span>
                            </div>
                        </td>
                        <!-- Tingkat -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                            <span class="text-slate-700 dark:text-slate-300 font-bold">Kelas {{ $course->tingkat }}</span>
                        </td>
                        <!-- Status -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                            @if($course->status === 'active')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">Nonaktif</span>
                            @endif
                        </td>
                        <!-- Aksi -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center bg-white dark:bg-slate-900 group-even:bg-slate-50 dark:group-even:bg-slate-800/30 group-hover:bg-slate-100 dark:group-hover:bg-slate-700/50 sticky right-0 z-10 transition-colors">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('courses.show', $course) }}" class="px-2 py-1 text-[11px] font-medium text-slate-700 bg-slate-50 border border-slate-200 hover:bg-slate-700 hover:text-white rounded transition" title="Detail Pelajaran">
                                    Detail
                                </a>
                                @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('courses.edit', $course) }}" class="px-2 py-1 text-[11px] font-medium text-sky-700 bg-sky-50 border border-sky-200 hover:bg-sky-600 hover:text-white rounded transition" title="Edit Pelajaran">
                                    Edit
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Hapus mata pelajaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-[11px] font-medium text-rose-700 bg-rose-50 border border-rose-200 hover:bg-rose-600 hover:text-white rounded transition" title="Hapus Pelajaran">
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
      MODAL POPUP: TAMBAH PELAJARAN MANUAL
     ========================================== -->
@if(auth()->user()->isSuperAdmin())
<div id="addCourseModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800" style="width: 700px; max-w-[95%]">
        <!-- Header -->
        <div class="px-8 py-5 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-start bg-white dark:bg-slate-900">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Tambah Data Mata Pelajaran Baru</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Silakan isi formulir identitas mata pelajaran kurikulum di bawah ini.</p>
            </div>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Form -->
        <form action="{{ route('courses.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <!-- Baris 1: Kode & Nama Pelajaran -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kode Mata Pelajaran *</label>
                    <input type="text" name="code" required placeholder="Contoh: MTK-X, FIS-XI" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Mata Pelajaran *</label>
                    <input type="text" name="name" required placeholder="Contoh: Matematika Wajib" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
            </div>

            <!-- Baris 2: Tingkat & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tingkat Kelas *</label>
                    <div class="relative">
                        <select name="grade_level" required class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="X">Kelas X</option>
                            <option value="XI">Kelas XI</option>
                            <option value="XII">Kelas XII</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Kurikulum *</label>
                    <div class="relative">
                        <select name="status" required class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Baris 3: Deskripsi (full-width) -->
            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Deskripsi / Silabus Singkat</label>
                <textarea name="description" rows="3" placeholder="Deskripsi mata pelajaran kurikulum..." class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 py-2.5 resize-none"></textarea>
            </div>

            <!-- Footer / Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-5 border-t border-slate-100 dark:border-slate-800/60">
                <button type="button" onclick="closeAddModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">Simpan Pelajaran</button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- ==========================================
      MODAL POPUP: IMPOR DATA EXCEL
     ========================================== -->
@if(auth()->user()->isSuperAdmin())
<div id="importExcelModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#00B074]">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-file-excel mr-2"></i>Impor Mata Pelajaran</h3>
            <button onclick="closeImportModal()" class="text-white hover:text-emerald-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-5" onsubmit="event.preventDefault(); alert('Simulasi Impor: Fitur Excel Parser siap diintegrasikan!'); closeImportModal();">
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
                <i class="fas fa-info-circle mr-1"></i> Pastikan struktur kolom template Excel sesuai format: <b>KODE | NAMA | DESKRIPSI | TINGKAT | STATUS</b>.
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

@push('scripts')
<script>
    // Modal controls
    function openAddModal() {
        $('#addCourseModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeAddModal() {
        $('#addCourseModal').addClass('hidden');
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

    // Trigger DataTables Excel Export
    function downloadExcel() {
        $('#coursesTable').DataTable().button('.buttons-excel').trigger();
    }

    $(document).ready(function() {
        // Show loading skeleton while table is rendering
        $('#skeletonLoading').removeClass('hidden');
        $('#coursesTableContainer').addClass('hidden');

        const table = $('#coursesTable').DataTable({
            dom: 'rt<"flex flex-col md:flex-row justify-between items-center py-4 px-6 border-t border-slate-100 dark:border-slate-800 gap-4"ip>',
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'buttons-excel',
                    title: '{{ \App\Models\Pengaturan::getValue("school_name", "SMAN 1 Cepogo") }}',
                    messageTop: 'Laporan Data Mata Pelajaran',
                    filename: 'Data_Mapel_' + new Date().toISOString().slice(0, 10),
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Mengabaikan kolom Aksi
                    }
                }
            ],
            language: {
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                zeroRecords: "Tidak ditemukan data mata pelajaran yang sesuai",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            },
        // responsive removed
            order: [[ 1, "asc" ]] // Order by Kode default
        });

        // Hide skeleton and show table
        $('#skeletonLoading').addClass('hidden');
        $('#coursesTableContainer').removeClass('hidden');
        table.columns.adjust();

        // Binds toolbar search input to datatable search API
        $('#toolbarSearch').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endpush
@endsection
