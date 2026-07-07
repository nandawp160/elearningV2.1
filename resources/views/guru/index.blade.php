@extends('layouts.app')

@section('title', 'Data Guru')

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

@if(session('unassigned'))
<div class="mb-6 glass p-4 border border-amber-200 bg-amber-50/70 text-amber-800 flex items-start justify-between rounded-2xl shadow-sm animate-fade-in">
    <div class="flex items-start gap-3">
        <i class="fas fa-exclamation-triangle text-lg mt-0.5"></i>
        <div>
            <span class="font-semibold text-sm block mb-1">Perhatian! Ada kelas yang gagal ter-plot karena semua guru telah mencapai batas maksimal 40 JTM:</span>
            <ul class="list-disc list-inside text-xs space-y-0.5">
                @foreach(session('unassigned') as $kelasUnassigned)
                    <li>{{ $kelasUnassigned }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <button onclick="this.parentElement.remove()" class="text-amber-800/70 hover:text-amber-800 transition">
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
                <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Data Guru</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola informasi dan data induk tenaga pendidik SMAN 1 Cepogo.</p>
            </div>
        </div>

        <!-- Metrik Summary Cards (Premium Minimalist Styling) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="stat-card border-l-4 border-l-[#D65A20] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Guru Terdaftar</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ $teachers->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>

            <div class="stat-card border-l-4 border-l-[#00B074] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Guru Aktif</p>
                    <p class="text-2xl font-bold text-[#00B074] mt-1">{{ $teachers->where('status', 'active')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#00B074] dark:bg-emerald-950/20 dark:text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>

            <div class="stat-card border-l-4 border-l-[#FF5B5B] bg-white dark:bg-slate-900 p-5 rounded-2xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Guru Nonaktif</p>
                    <p class="text-2xl font-bold text-[#FF5B5B] mt-1">{{ $teachers->where('status', 'inactive')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-[#FF5B5B] dark:bg-rose-950/20 dark:text-rose-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-user-slash"></i>
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
                    <input type="text" id="toolbarSearch" placeholder="Cari nama atau NIP..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>
                
                <!-- Subject Dropdown -->
                <div class="relative w-full sm:w-48">
                    <select id="toolbarSubject" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">Semua Mapel</option>
                        @php
                            $specializations = $teachers->pluck('spesialisasi')->unique()->filter()->sort();
                        @endphp
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}">{{ $spec }}</option>
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
                <!-- Dropdown: Aksi Massal / Utilitas -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" type="button" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                        <i class="fas fa-cogs text-orange-500"></i>
                        <span>Aksi Sistem</span>
                        <i class="fas fa-chevron-down text-[10px] ml-0.5"></i>
                    </button>
                    <!-- Dropdown List -->
                    <div x-show="open" style="display: none;" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5">
                        <!-- Plotting Otomatis -->
                        <button type="button" onclick="openPlottingModal(); open = false" class="w-full text-left px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-2">
                            <i class="fas fa-random text-slate-400"></i>
                            <span>🎲 Plotting Guru Otomatis</span>
                        </button>
                    </div>
                </div>

                <!-- Tambah Manual -->
                <button type="button" onclick="openAddModal()" class="btn btn-orange-solid font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Guru</span>
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
        <div id="teachersTableContainer" class="overflow-x-auto flex-1 min-h-0 overflow-y-auto pb-4">
            <table id="teachersTable" class="w-full border-collapse border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-900 text-sm whitespace-nowrap">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-sm">
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">No</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">NIP</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Nama Lengkap & Gelar</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Mata Pelajaran</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Total JTM</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Status</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky right-0 top-0 z-30">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($teachers as $teacher)
                    <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition group">
                        <!-- No -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 text-center">{{ $no++ }}</td>
                        <!-- NIP -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 font-mono text-slate-700 dark:text-slate-300">{{ $teacher->nip }}</td>
                        <!-- Profil / Nama Lengkap -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5">
                            <div class="min-w-0">
                                <span class="font-bold text-slate-800 dark:text-slate-100 block">{{ $teacher->nama }}</span>
                                <span class="text-[11px] text-slate-500 block font-mono">{{ $teacher->email }}</span>
                            </div>
                        </td>
                        <!-- Mata Pelajaran -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 font-bold">
                            {{ $teacher->mataPelajaran->nama ?? $teacher->spesialisasi ?? '-' }}
                        </td>
                        <!-- Total JTM -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                            @php
                                $jtm = $teacher->total_jtm;
                                $jtmTextClass = 'text-slate-700 dark:text-slate-300';
                                if ($jtm < 24) $jtmTextClass = 'text-rose-600 font-bold';
                                else if ($jtm > 40) $jtmTextClass = 'text-amber-600 font-bold';
                                else $jtmTextClass = 'text-emerald-600 font-bold';
                            @endphp
                            <span class="{{ $jtmTextClass }}">
                                {{ $jtm }}
                            </span>
                        </td>
                        <!-- Status -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                            @if($teacher->status === 'active')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">Nonaktif</span>
                            @endif
                        </td>
                        <!-- Aksi -->
                        <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center bg-white dark:bg-slate-900 group-even:bg-slate-50 dark:group-even:bg-slate-800/30 group-hover:bg-slate-100 dark:group-hover:bg-slate-700/50 sticky right-0 z-10 transition-colors">
                            <div class="inline-flex items-center gap-1.5">
                                @if(auth()->user()->isSuperAdmin() && !$teacher->pengguna_id)
                                <form action="{{ route('teachers.create-user', $teacher) }}" method="POST" class="inline" onsubmit="return confirm('Buat akun login untuk guru ini?')">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 text-[11px] font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-600 hover:text-white rounded transition" title="Buat Akun Login">
                                        Akun
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('teachers.show', $teacher) }}" class="px-2 py-1 text-[11px] font-medium text-slate-700 bg-slate-50 border border-slate-200 hover:bg-slate-700 hover:text-white rounded transition">
                                    Detail
                                </a>
                                <button type="button" onclick="openAturKelasModal({{ $teacher->id }}, '{{ addslashes($teacher->nama) }}', '{{ addslashes($teacher->spesialisasi ?? $teacher->mataPelajaran->nama ?? '-') }}', {{ json_encode($teacher->kelasDiampu->pluck('id')) }})" class="px-2 py-1 text-[11px] font-medium text-orange-700 bg-orange-50 border border-orange-200 hover:bg-orange-600 hover:text-white rounded transition">
                                    Kelas
                                </button>
                                <a href="{{ route('teachers.edit', $teacher) }}" class="px-2 py-1 text-[11px] font-medium text-sky-700 bg-sky-50 border border-sky-200 hover:bg-sky-600 hover:text-white rounded transition">
                                    Edit
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data guru ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-[11px] font-medium text-rose-700 bg-rose-50 border border-rose-200 hover:bg-rose-600 hover:text-white rounded transition">
                                        Hapus
                                    </button>
                                </form>
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
      MODAL POPUP: TAMBAH GURU MANUAL
     ========================================== -->
@if(auth()->user()->isSuperAdmin())
<div id="addTeacherModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800" style="width: 850px; max-w-[95%]">
        <!-- Header -->
        <div class="px-8 py-5 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-start bg-white dark:bg-slate-900">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Tambah Data Guru Baru</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Silakan isi formulir data identitas tenaga pendidik di bawah ini.</p>
            </div>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Form -->
        <form action="{{ route('teachers.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <!-- Baris 1: NIP (kiri) & Spesialisasi (kanan) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">NIP *</label>
                    <input type="text" name="nip" required placeholder="Masukkan NIP..." class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Spesialisasi Mata Pelajaran *</label>
                    <div class="relative">
                        <select name="specialization_id" required class="input w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="" disabled selected>Pilih Spesialisasi...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->nama }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Baris 2: Nama Lengkap & Gelar (full width) -->
            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Lengkap & Gelar *</label>
                <input type="text" name="name" required placeholder="Masukkan nama lengkap beserta gelar akademik..." class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
            </div>

            <!-- Baris 3: Alamat Email (kiri) & Nomor Telepon (kanan) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alamat Email *</label>
                    <input type="email" name="email" required placeholder="guru@domain.com" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nomor Telepon *</label>
                    <input type="text" name="phone" required placeholder="Contoh: 0812345678" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
            </div>

            <!-- Baris 4: Status Akun (kiri, switch toggle) & Tugas Tambahan (kanan) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="field-label mb-2 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Akun</label>
                    <div class="flex items-center h-10">
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" id="statusToggle" class="sr-only peer" checked onchange="toggleStatusValue(this)" />
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:bg-slate-700 peer-checked:bg-[#D65A20]"></div>
                            <span id="statusLabel" class="ms-3 text-sm font-semibold text-slate-700 dark:text-slate-300">Aktif</span>
                        </label>
                        <input type="hidden" name="status" id="statusValue" value="active" />
                    </div>
                </div>
                <div>
                    <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tugas Tambahan JTM (Opsional)</label>
                    <input type="number" name="tugas_tambahan_jtm" min="0" value="0" placeholder="Contoh: 12 (Kepala Lab)" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
            </div>

            <!-- Baris 5: Alamat Lengkap (textarea full width) -->
            <div>
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Alamat tinggal guru lengkap..." class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 py-2.5 resize-none"></textarea>
            </div>

            <!-- Footer / Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-5 border-t border-slate-100 dark:border-slate-800/60">
                <button type="button" onclick="closeAddModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">Simpan Data</button>
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
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#00B074]">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-file-excel mr-2"></i>Impor Data Guru</h3>
            <button onclick="closeImportModal()" class="text-white hover:text-emerald-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-5" onsubmit="event.preventDefault(); alert('Simulasi Impor: Fitur Excel Parser siap diintegrasikan!'); closeImportModal();">
            @csrf
            
            <div class="text-center p-4 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl bg-slate-50 dark:bg-slate-800/40">
                <i class="fas fa-cloud-upload-alt text-4xl text-[#00B074] mb-3"></i>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pilih berkas template excel</p>
                <p class="text-xs text-slate-400 mt-1 mb-4">Mendukung file (.xls, .xlsx)</p>
                <input type="file" required name="excel_file" class="hidden" id="excel_file_input" onchange="document.getElementById('fileNameText').innerText = this.files[0] ? this.files[0].name : ''" />
                <button type="button" onclick="document.getElementById('excel_file_input').click()" class="btn border border-[#00B074] text-[#00B074] hover:bg-emerald-50 px-4 py-2 rounded-xl text-xs font-bold transition">Pilih File</button>
                <p id="fileNameText" class="text-xs text-slate-600 dark:text-slate-400 mt-2 font-mono truncate"></p>
            </div>

            <div class="text-xs text-slate-400 leading-normal">
                <i class="fas fa-info-circle mr-1"></i> Pastikan struktur kolom template Excel sesuai format: <b>NIP | NAMA | EMAIL | NO_HP | SPESIALISASI | ALAMAT</b>.
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeImportModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl">Batal</button>
                <button type="submit" class="btn btn-teal-solid font-bold px-5 py-2 rounded-xl shadow-lg shadow-emerald-500/10">Mulai Impor</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: ATUR KELAS DIAMPU
     ========================================== -->
<div id="aturKelasModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#D65A20]">
            <div>
                <h3 class="text-lg font-bold text-white"><i class="fas fa-school mr-2"></i>Pengaturan Kelas Diampu</h3>
                <p class="text-orange-100 text-xs mt-0.5" id="modalGuruSpecialization">Nama Guru - Spesialisasi</p>
            </div>
            <button onclick="closeAturKelasModal()" class="text-white hover:text-orange-100 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Form -->
        <form id="aturKelasForm" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div>
                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-3">Informasi Guru:</h4>
                <div class="grid grid-cols-2 gap-4 bg-slate-50 dark:bg-slate-850 p-4 rounded-xl text-xs">
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider">Nama Guru</p>
                        <p class="font-bold text-slate-800 dark:text-white mt-1 text-sm" id="modalGuruName">-</p>
                    </div>
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider">Spesialisasi Mapel</p>
                        <p class="font-bold text-slate-800 dark:text-white mt-1 text-sm" id="modalGuruSubject">-</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-slate-400 font-bold uppercase tracking-wider">Jumlah Kelas Diampu</p>
                        <p class="font-bold text-slate-800 dark:text-white mt-1 text-sm" id="modalGuruClassCount">0 Kelas</p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-3">Pilih Kelas & Mata Pelajaran Diampu:</h4>
                <div class="border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden bg-slate-50/50 dark:bg-slate-900/50 shadow-inner">
                    <div class="max-h-72 overflow-y-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-800 text-xxs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider sticky top-0 z-10 border-b border-slate-200 dark:border-slate-800">
                                    <th class="py-2.5 px-4 text-center" style="width: 50px;">Pilih</th>
                                    <th class="py-2.5 px-3">Kelas</th>
                                    <th class="py-2.5 px-4 text-right" style="width: 240px;">Mata Pelajaran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900">
                                @foreach($classrooms as $kelas)
                                    <tr id="kelas-row-{{ $kelas->id }}" data-grade-level="{{ $kelas->grade_level }}" class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition cursor-pointer" onclick="toggleRowCheckbox({{ $kelas->id }})">
                                        <td class="py-2.5 px-4 text-center" onclick="event.stopPropagation()">
                                            <input type="checkbox" name="kelas[]" value="{{ $kelas->id }}" data-name="{{ $kelas->name }}" onchange="updateSelectedCount()" class="w-4 h-4 rounded text-[#D65A20] focus:ring-[#D65A20]/20 border-slate-300 dark:border-slate-700" />
                                        </td>
                                        <td class="py-2.5 px-3 text-sm font-bold text-slate-800 dark:text-slate-200">
                                            {{ $kelas->name }}
                                        </td>
                                        <td class="py-2.5 px-4 text-right" onclick="event.stopPropagation()">
                                            <div class="inline-block relative w-full">
                                                <select name="subject_ids[{{ $kelas->id }}]" id="subject-select-{{ $kelas->id }}" class="w-full rounded-lg border border-slate-200 bg-white px-2 py-1 text-xxs font-semibold text-slate-700 focus:border-[#D65A20] focus:ring-1 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 disabled:opacity-50 disabled:bg-slate-100 dark:disabled:bg-slate-800" disabled>
                                                    <option value="">-- Pilih Mapel --</option>
                                                    @foreach($courses->where('tingkat', $kelas->grade_level) as $course)
                                                        <option value="{{ $course->id }}">{{ $course->kode }} - {{ $course->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeAturKelasModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn text-white font-bold px-5 py-2 rounded-xl shadow-lg transition text-xs" style="background-color: #D65A20;">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
@endif

@if(auth()->user()->isSuperAdmin())
<!-- ==========================================
      MODAL POPUP: PLOTTING GURU OTOMATIS
     ========================================== -->
<div id="modalPlottingGuru" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-random mr-2"></i>Plotting Guru Otomatis</h3>
            <button onclick="closePlottingModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('teachers.auto-plot') }}" method="POST" class="p-6 space-y-5">
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
                <p class="font-bold text-orange-600 dark:text-orange-400 uppercase tracking-wider"><i class="fas fa-info-circle mr-1"></i> Cara Kerja Plotting Guru:</p>
                <ul class="list-disc pl-4 space-y-1">
                    <li>Sistem hanya memproses guru dengan status <b>Aktif</b> yang memiliki spesialisasi mata pelajaran.</li>
                    <li>Sistem akan mengelompokkan guru berdasarkan bidang spesialisasi mata pelajaran masing-masing.</li>
                    <li>Untuk setiap mata pelajaran, kelas-kelas pada T.A. target yang sesuai (tingkat kelas dan kelompok peminatan IPA/IPS) akan didistribusikan secara merata kepada guru pengampu.</li>
                    <li>Plotting ini akan menghapus dan memetakan ulang kelas diampu pada T.A. target terpilih.</li>
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

@push('scripts')

<script>
    // Modal controls
    function openPlottingModal() {
        $('#modalPlottingGuru').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closePlottingModal() {
        $('#modalPlottingGuru').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    function openAddModal() {
        $('#addTeacherModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeAddModal() {
        $('#addTeacherModal').addClass('hidden');
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

    // Toggle status switch label & value
    function toggleStatusValue(checkbox) {
        const hiddenInput = document.getElementById('statusValue');
        const label = document.getElementById('statusLabel');
        if (checkbox.checked) {
            hiddenInput.value = 'active';
            label.innerText = 'Aktif';
        } else {
            hiddenInput.value = 'inactive';
            label.innerText = 'Nonaktif';
        }
    }

    // Trigger DataTables Excel Export
    function downloadExcel() {
        $('#teachersTable').DataTable().button('.buttons-excel').trigger();
    }

    // Toolbar Filters Reset Function
    function resetToolbarFilters() {
        $('#toolbarSearch').val('');
        $('#toolbarSubject').val('');
        
        const table = $('#teachersTable').DataTable();
        table.search('').columns().search('').draw();
    }

    // Atur Kelas Modal controls
    function openAturKelasModal(id, name, specialization, assignedClassIds) {
        const url = "{{ route('teachers.update-teaching-classes', ':id') }}".replace(':id', id);
        $('#aturKelasForm').attr('action', url);
        $('#modalGuruName').text(name);
        $('#modalGuruSubject').text(specialization);
        $('#modalGuruSpecialization').text(`${name} — ${specialization}`);
        
        // Reset and check assigned
        $('#aturKelasModal input[type="checkbox"]').prop('checked', false);
        assignedClassIds.forEach(classId => {
            $(`#aturKelasModal input[value="${classId}"]`).prop('checked', true);
        });
        
        // Reset resolved subject dropdowns to loading state/placeholder first
        $('#aturKelasModal select[id^="subject-select-"]').val('');
        
        // Parse grade level from specialization (e.g. "Kimia X" -> "X", "Fisika XI" -> "XI")
        let targetGrade = '';
        if (specialization.includes('XII')) {
            targetGrade = 'XII';
        } else if (specialization.includes('XI')) {
            targetGrade = 'XI';
        } else if (specialization.includes('X')) {
            targetGrade = 'X';
        }
        
        // Filter classes by grade level matching teacher's specialization
        if (targetGrade) {
            $('#aturKelasModal tbody tr').each(function() {
                const rowGrade = $(this).attr('data-grade-level');
                const checkbox = $(this).find('input[type="checkbox"]');
                const select = $(this).find('select');
                if (rowGrade === targetGrade) {
                    $(this).show();
                    checkbox.prop('disabled', false);
                } else {
                    $(this).hide();
                    checkbox.prop('checked', false); // Uncheck hidden rows
                    checkbox.prop('disabled', true);  // Disable hidden checkboxes
                    select.prop('disabled', true);
                }
            });
        } else {
            $('#aturKelasModal tbody tr').each(function() {
                $(this).show();
                const checkbox = $(this).find('input[type="checkbox"]');
                checkbox.prop('disabled', false);
            });
        }
        
        updateSelectedCount();
        
        // Fetch resolved subjects
        const resolvedUrl = "{{ route('teachers.resolved-subjects', ':id') }}".replace(':id', id);
        $.getJSON(resolvedUrl, function(data) {
            Object.keys(data).forEach(kelasId => {
                const subject = data[kelasId];
                if (subject && subject.id) {
                    $(`#subject-select-${kelasId}`).val(subject.id);
                } else {
                    $(`#subject-select-${kelasId}`).val('');
                }
            });
        }).fail(function() {
            console.error('Gagal memuat mata pelajaran terpilih.');
        });
        
        $('#aturKelasModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }

    function closeAturKelasModal() {
        $('#aturKelasModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    function updateSelectedCount() {
        const checkedCount = $('#aturKelasModal input[name="kelas[]"]:checked').length;
        $('#modalGuruClassCount').text(`${checkedCount} Kelas`);
        
        // Sync disabled state of select dropdowns with checkbox state
        $('#aturKelasModal input[name="kelas[]"]').each(function() {
            const classId = $(this).val();
            const isChecked = $(this).prop('checked');
            const isDisabled = $(this).prop('disabled');
            $(`#subject-select-${classId}`).prop('disabled', isDisabled || !isChecked);
        });
    }

    function toggleRowCheckbox(kelasId) {
        const checkbox = $(`#kelas-row-${kelasId} input[type="checkbox"]`);
        if (checkbox.prop('disabled')) return;
        checkbox.prop('checked', !checkbox.prop('checked'));
        updateSelectedCount();
    }

    $(document).ready(function() {

        // Show loading skeleton while table is rendering
        $('#skeletonLoading').removeClass('hidden');
        $('#teachersTableContainer').addClass('hidden');

        const table = $('#teachersTable').DataTable({
            dom: 'rt<"flex flex-col md:flex-row justify-between items-center py-4 px-6 border-t border-slate-100 dark:border-slate-800 gap-4"ip>',
            buttons: [
                { 
                    extend: 'excel', 
                    className: 'buttons-excel',
                    title: '{{ \App\Models\Pengaturan::getValue("school_name", "SMAN 1 Cepogo") }}',
                    messageTop: 'Laporan Data Guru',
                    filename: 'Data_Guru_' + new Date().toISOString().slice(0, 10),
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5] // Mengabaikan kolom Aksi
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
            order: [[ 2, "asc" ]] // Order by Name by default
        });

        // Hide skeleton and show table
        $('#skeletonLoading').addClass('hidden');
        $('#teachersTableContainer').removeClass('hidden');
        table.columns.adjust();

        // Binds toolbar search input to datatable search API
        $('#toolbarSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Binds Subject filter dropdown
        $('#toolbarSubject').on('change', function() {
            table.column(3).search(this.value).draw();
        });
    });
</script>
@endpush
@endsection
