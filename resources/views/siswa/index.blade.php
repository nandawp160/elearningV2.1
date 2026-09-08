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
                        @foreach($classList as $kelas)
                            <option value="{{ $kelas->name }}">{{ $kelas->name }}</option>
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
                        <option value="">Semua Status</option>
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
                    <div x-show="open" style="display: none;" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5">
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
            <table id="studentsTable" class="w-full border-collapse border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-900 text-sm whitespace-nowrap">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-sm">
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">No</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">NIS</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Nama Lengkap</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Email</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Kelas</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">L/P</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Status</th>
                        <th class="hidden">Tahun Lulus</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky right-0 top-0 z-30">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($students as $student)
                    <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition group">
                        <!-- No -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 text-center">{{ $no++ }}</td>
                        <!-- NIS -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 font-mono text-slate-700 dark:text-slate-300">{{ $student->nis ?? '-' }}</td>
                        <!-- Nama Lengkap -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 font-bold text-slate-800 dark:text-slate-100">{{ $student->nama }}</td>
                        <!-- Email -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-500 dark:text-slate-400">{{ $student->user->email ?? '-' }}</td>
                        <!-- Kelas (Resolved dynamically) -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center text-slate-800 dark:text-slate-300 font-bold">{{ $student->resolved_kelas ?? '-' }}</td>
                        <!-- L/P -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center text-slate-700 dark:text-slate-300">{{ $student->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                        <!-- Status -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                            @if($student->status === 'active')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Aktif</span>
                            @elseif($student->status === 'lulus')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-400">Lulus</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">Nonaktif</span>
                            @endif
                        </td>
                        <!-- Tahun Lulus (Hidden) -->
                        <td class="hidden">{{ $student->tahun_lulus ?? '-' }}</td>
                        <!-- Aksi -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center bg-white dark:bg-slate-900 group-even:bg-slate-50 dark:group-even:bg-slate-800/30 group-hover:bg-slate-100 dark:group-hover:bg-slate-700/50 sticky right-0 z-10 transition-colors">
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
@endif

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
        <form id="formMutasiKeluar" method="POST" action="" enctype="multipart/form-data" class="p-6 space-y-5">
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

            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Lampiran Surat / Dokumen (Opsional)</label>
                <input type="file" name="surat_mutasi" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 dark:file:bg-slate-800 dark:file:text-slate-300 dark:hover:file:bg-slate-700 transition" />
            </div>

            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeMutasiKeluarModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs">Batal</button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs">Proses Mutasi</button>
            </div>
        </form>
    </div>
</div>
@endcan



@push('scripts')
<script>
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

        // Custom filtering function for Class and Status
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            if (settings.nTable.id !== 'studentsTable') {
                return true;
            }

            var classFilter = $('#toolbarClass').val();
            var statusFilter = $('#toolbarStatus').val();

            var classText = data[4] || '';
            var statusHtml = data[6] || '';
            
            // Extract text from HTML just in case
            var statusText = $('<div>').html(statusHtml).text().trim();
            classText = classText.trim();

            // Check Class
            if (classFilter && classFilter !== '') {
                if (classText !== classFilter) {
                    return false;
                }
            }

            // Check Status
            if (statusFilter && statusFilter !== '' && statusFilter !== 'aktif_nonaktif') {
                if (statusText !== statusFilter) {
                    return false;
                }
            }

            return true;
        });

        // Binds Class filter dropdown
        $('#toolbarClass').on('change', function() {
            table.draw();
        });

        // Binds Status filter dropdown
        $('#toolbarStatus').on('change', function() {
            table.draw();
        });
    });
</script>
@endpush
@endsection
