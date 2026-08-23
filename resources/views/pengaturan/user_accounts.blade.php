@extends('layouts.app')

@section('title', 'Manajemen Akun Pengguna')

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
    
    /* Custom button styles */
    .btn-green-outline {
        border: 1px solid #00B074 !important;
        color: #00B074 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-green-outline:hover {
        background-color: rgba(0, 176, 116, 0.05) !important;
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

<div class="space-y-6">
    <!-- Page Header (Outside the main card) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Manajemen Akun Pengguna</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola kredensial login (Admin, Guru, Siswa) dan integrasi data pengguna secara terpusat.</p>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm">
        
        <!-- Segmented Tab Control (Role Filter) -->
        <div class="flex flex-wrap items-center border-b border-slate-200 dark:border-slate-800 mb-6 gap-2">
            <button type="button" onclick="filterRole('', this)" class="role-tab px-5 py-3 text-xs font-bold border-b-2 border-[#D65A20] text-[#D65A20] dark:text-white transition duration-150 flex items-center gap-2">
                <i class="fas fa-users"></i> Semua Pengguna
            </button>
            <button type="button" onclick="filterRole('Super Admin', this)" class="role-tab px-5 py-3 text-xs font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 transition duration-150 flex items-center gap-2">
                <i class="fas fa-user-shield"></i> Super Admin
            </button>
            <button type="button" onclick="filterRole('Guru', this)" class="role-tab px-5 py-3 text-xs font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 transition duration-150 flex items-center gap-2">
                <i class="fas fa-user-tie"></i> Guru
            </button>
            <button type="button" onclick="filterRole('Siswa', this)" class="role-tab px-5 py-3 text-xs font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300 transition duration-150 flex items-center gap-2">
                <i class="fas fa-user-graduate"></i> Siswa
            </button>
        </div>

        <!-- Toolbar (Search & Action buttons) -->
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4 mb-6">
            <!-- Left Filters -->
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <!-- Search Box -->
                <div class="relative w-full sm:w-72">
                    <input type="text" id="toolbarSearch" placeholder="Cari nama atau email..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>

                <!-- Toggle Show Alumni Button -->
                <a href="{{ route('admin.accounts', ['show_alumni' => $showAlumni ? 0 : 1]) }}" class="text-xs font-bold text-slate-600 dark:text-slate-300 hover:text-[#D65A20] transition flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 shadow-2xs">
                    <i class="fas {{ $showAlumni ? 'fa-eye-slash text-amber-500' : 'fa-graduation-cap text-slate-400' }}"></i>
                    <span>{{ $showAlumni ? 'Sembunyikan Alumni' : 'Tampilkan Alumni (Arsip)' }}</span>
                </a>
            </div>

            <!-- Right Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Ekspor Excel -->
                <a id="btnExportExcel" href="{{ route('admin.accounts.export', ['show_alumni' => $showAlumni ? 1 : 0]) }}" class="btn border border-emerald-200 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2 text-xs shadow-2xs" title="Ekspor daftar akun pengguna ke Excel">
                    <i class="fas fa-file-excel text-sm text-emerald-600"></i>
                    <span>Ekspor Excel</span>
                </a>

                <!-- Generate Akun Siswa -->
                <button onclick="openGenerateModal()" class="btn btn-green-outline font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2 text-xs">
                    <i class="fas fa-bolt text-xs"></i>
                    <span>Generate Akun Siswa</span>
                </button>

                <!-- Tambah Akun Manual -->
                <button onclick="openAddModal()" class="btn btn-orange-solid font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                    <span>+ Tambah Akun Manual</span>
                </button>
            </div>
        </div>

        <!-- Skeleton Loading placeholder -->
        <div id="skeletonLoading" class="hidden space-y-4">
            @for($i = 0; $i < 5; $i++)
            <div class="animate-pulse flex items-center justify-between p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl">
                <div class="flex items-center gap-3 w-1/3">
                    <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-800"></div>
                    <div class="space-y-2 flex-1">
                        <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-3/4"></div>
                        <div class="h-3 bg-slate-200 dark:bg-slate-800 rounded w-1/2"></div>
                    </div>
                </div>
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-28"></div>
                <div class="h-4 bg-slate-200 dark:bg-slate-800 rounded w-20"></div>
                <div class="h-6 bg-slate-200 dark:bg-slate-800 rounded w-16"></div>
            </div>
            @endfor
        </div>

        <!-- Data Table Container (Spreadsheet Style) -->
        <div id="usersTableContainer" class="overflow-x-auto max-h-[600px] overflow-y-auto rounded-xl border border-slate-300 dark:border-slate-700 shadow-2xs">
            <table id="usersTable" class="w-full border-collapse border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-xs whitespace-nowrap">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-2xs">
                        <th class="border border-slate-300 dark:border-slate-600 px-4 py-2 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 min-w-[65px] w-16 sticky top-0 z-20">NO</th>
                        <th class="border border-slate-300 dark:border-slate-600 px-3 py-2 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky top-0 z-20">Nama Pengguna</th>
                        <th class="border border-slate-300 dark:border-slate-600 px-3 py-2 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky top-0 z-20">Username / Email</th>
                        <th class="border border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky top-0 z-20">Peran</th>
                        <th class="border border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky top-0 z-20">Kelas / Unit</th>
                        <th class="border border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky top-0 z-20">Status</th>
                        <th class="border border-slate-300 dark:border-slate-600 px-3 py-2 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 sticky top-0 z-20">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition group">
                        <!-- No -->
                        <td class="border border-slate-300 dark:border-slate-600 px-4 py-1.5 text-center font-semibold text-slate-700 dark:text-slate-300 min-w-[65px] w-16">{{ $index + 1 }}</td>
                        
                        <!-- Nama Pengguna -->
                        <td class="border border-slate-300 dark:border-slate-600 px-3 py-1.5 font-bold text-slate-800 dark:text-slate-100">
                            <div class="flex items-center gap-2">
                                <span>{{ $user->nama }}</span>
                                @if($user->role === 'siswa' && str_ends_with($user->email, '@siswa.smansago.com'))
                                <span class="inline-block text-[9px] font-semibold bg-slate-100 dark:bg-slate-800 text-slate-500 rounded px-1 py-0.2">Auto-Gen</span>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Username / Email -->
                        <td class="border border-slate-300 dark:border-slate-600 px-3 py-1.5 font-mono text-slate-700 dark:text-slate-300">{{ $user->email }}</td>
                        
                        <!-- Peran -->
                        <td class="border border-slate-300 dark:border-slate-600 px-3 py-1.5 text-center">
                            @if($user->role === 'admin' || $user->role === 'super_admin')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">Super Admin</span>
                            @elseif($user->role === 'guru')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-400">Guru</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400">Siswa</span>
                            @endif
                        </td>

                        <!-- Kelas / Unit -->
                        <td class="border border-slate-300 dark:border-slate-600 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-200">
                            @if($user->role === 'siswa')
                                {{ $user->student?->resolved_kelas ?? $user->student?->kelas ?? '-' }}
                            @elseif($user->role === 'guru')
                                Guru Pengajar
                            @else
                                Administrator
                            @endif
                        </td>

                        <!-- Status -->
                        <td class="border border-slate-300 dark:border-slate-600 px-3 py-1.5 text-center">
                            @php
                                $status = 'aktif';
                                if ($user->role === 'guru' && $user->teacher) {
                                    $status = $user->teacher->status;
                                } elseif ($user->role === 'siswa' && $user->student) {
                                    $status = $user->student->status;
                                }
                            @endphp
                            @if($status === 'aktif' || $status === 'active')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">Aktif</span>
                            @elseif($status === 'mutasi')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400">Mutasi</span>
                            @elseif($status === 'lulus')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-400">Lulus</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400">Nonaktif</span>
                            @endif
                        </td>
                        
                        <!-- Aksi -->
                        <td class="border border-slate-300 dark:border-slate-600 px-3 py-1.5 text-center">
                            <div class="inline-flex items-center gap-1">
                                <!-- Detail Action (Independent Modal Trigger) -->
                                <button onclick="openDetailModal({{ $user->id }}, '{{ addslashes($user->nama) }}', '{{ addslashes($user->email) }}', '{{ $user->role }}', '{{ $status }}', '{{ $user->created_at ? $user->created_at->format('d-m-Y H:i') : '-' }}')" class="px-2 py-1 text-[11px] font-semibold text-slate-600 hover:text-white border border-slate-300 hover:border-slate-800 bg-white hover:bg-slate-800 rounded transition">Detail</button>

                                <!-- Edit Action (Independent Modal Trigger) -->
                                <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->nama) }}', '{{ addslashes($user->email) }}', '{{ $user->role }}', '{{ $status }}')" class="px-2 py-1 text-[11px] font-semibold text-blue-600 hover:text-white border border-blue-300 hover:border-blue-600 bg-white hover:bg-blue-600 rounded transition">Edit</button>

                                <!-- Reset Password Form -->
                                <form action="{{ route('admin.reset-password', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin me-reset password untuk pengguna ini? Password default akan disetel menjadi: password')">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 text-[11px] font-semibold text-[#D65A20] hover:text-white border border-orange-300 hover:border-[#D65A20] bg-white hover:bg-[#D65A20] rounded transition">
                                        Reset Sandi
                                    </button>
                                </form>

                                <!-- Soft Disable / Toggle Status Form (Siswa/Guru only, Admins cannot be disabled) -->
                                @if($user->role === 'guru' || $user->role === 'siswa')
                                    <form action="{{ route('admin.toggle-status', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status aktif/nonaktif akun ini?')">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 text-[11px] font-semibold {{ ($status === 'aktif' || $status === 'active') ? 'text-red-600 border-red-300 hover:border-red-600 hover:bg-red-600' : 'text-emerald-600 border-emerald-300 hover:border-emerald-600 hover:bg-emerald-600' }} hover:text-white border bg-white rounded transition">
                                            {{ ($status === 'aktif' || $status === 'active') ? 'Nonaktifkan' : 'Aktifkan' }}
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
      MODAL POPUP: DETAIL USER INDEPENDEN
     ========================================== -->
<div id="detailUserModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-center bg-white dark:bg-slate-900">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Detail Akun Pengguna</h3>
            <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Content -->
        <div class="p-6 space-y-4 text-xs">
            <div class="flex justify-between border-b border-slate-50 dark:border-slate-800/60 pb-2.5">
                <span class="text-slate-400 font-medium">User ID</span>
                <span class="font-bold text-slate-800 dark:text-slate-100" id="detailUserId">-</span>
            </div>
            <div class="flex justify-between border-b border-slate-50 dark:border-slate-800/60 pb-2.5">
                <span class="text-slate-400 font-medium">Nama Pengguna</span>
                <span class="font-bold text-slate-800 dark:text-slate-100" id="detailNama">-</span>
            </div>
            <div class="flex justify-between border-b border-slate-50 dark:border-slate-800/60 pb-2.5">
                <span class="text-slate-400 font-medium">Username / Email</span>
                <span class="font-bold text-slate-800 dark:text-slate-100 font-mono" id="detailEmail">-</span>
            </div>
            <div class="flex justify-between border-b border-slate-50 dark:border-slate-800/60 pb-2.5">
                <span class="text-slate-400 font-medium">Peran (Role)</span>
                <span id="detailPeranBadge">-</span>
            </div>
            <div class="flex justify-between border-b border-slate-50 dark:border-slate-800/60 pb-2.5">
                <span class="text-slate-400 font-medium">Status</span>
                <span id="detailStatusBadge">-</span>
            </div>
            <div class="flex justify-between pb-1.5">
                <span class="text-slate-400 font-medium">Tanggal Terdaftar</span>
                <span class="font-bold text-slate-800 dark:text-slate-100" id="detailTerdaftar">-</span>
            </div>
        </div>
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800/60 flex justify-end bg-slate-50/50 dark:bg-slate-900/30">
            <button onclick="closeDetailModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl text-xs transition">Tutup</button>
        </div>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: EDIT USER INDEPENDEN
     ========================================== -->
<div id="editUserModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-lg overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-start bg-white dark:bg-slate-900">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Ubah Data Akun Pengguna</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Silakan sesuaikan data kredensial login di bawah ini.</p>
            </div>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Form -->
        <form id="editUserForm" action="#" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            
            <!-- namaPengguna -->
            <div>
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Pengguna *</label>
                <input type="text" name="namaPengguna" id="editNamaPengguna" required placeholder="Nama Lengkap Pengguna" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
            </div>

            <!-- email -->
            <div>
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alamat Email (Username) *</label>
                <input type="email" name="email" id="editEmail" required placeholder="email@sekolah.sch.id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
            </div>

            <!-- peran & status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Peran Pengguna *</label>
                    <div class="relative">
                        <select name="peran" id="editPeran" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="admin">Admin Staf</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Akun (Hanya Siswa/Guru)</label>
                    <div class="relative">
                        <select id="editStatusDisabled" disabled class="w-full rounded-xl border border-slate-200 bg-slate-100/70 px-4 py-2.5 text-xs text-slate-400 appearance-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-500">
                            <option value="aktif">Status diubah via tombol aksi Nonaktifkan / Aktifkan</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-info-circle text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-5 border-t border-slate-100 dark:border-slate-800/60">
                <button type="button" onclick="closeEditModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs text-white transition bg-[#D65A20] hover:bg-[#be4e1a]">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: TAMBAH AKUN MANUAL
     ========================================== -->
<div id="addAdminModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-lg overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-start bg-white dark:bg-slate-900">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Tambah Akun Pengguna Baru</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Silakan isi formulir di bawah ini untuk membuat akun baru.</p>
            </div>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <!-- Form -->
        <form id="addAdminForm" action="{{ route('admin.store-admin') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <!-- namaPengguna -->
            <div>
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Pengguna *</label>
                <input type="text" name="namaPengguna" required placeholder="Nama Lengkap Pengguna" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
            </div>

            <!-- email -->
            <div>
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alamat Email (Username) *</label>
                <input type="email" name="email" required placeholder="email@sekolah.sch.id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
            </div>

            <!-- kataSandi & konfirmasiKataSandi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kata Sandi *</label>
                    <input type="password" name="kataSandi" required placeholder="Minimal 6 karakter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Konfirmasi Kata Sandi *</label>
                    <input type="password" name="konfirmasiKataSandi" required placeholder="Ulangi kata sandi" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                </div>
            </div>

            <!-- peran & status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Peran Pengguna *</label>
                    <div class="relative">
                        <select name="peran" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="admin">Admin Staf</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Akun</label>
                    <div class="relative">
                        <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-5 border-t border-slate-100 dark:border-slate-800/60">
                <button type="button" onclick="closeAddModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs text-white transition bg-[#D65A20] hover:bg-[#be4e1a]">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: GENERATE AKUN SISWA
     ========================================== -->
<div id="generateAccountsModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800/60 flex justify-between items-center bg-[#00B074]">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-bolt mr-2"></i>Generate Akun Siswa</h3>
            <button onclick="closeGenerateModal()" class="text-white hover:text-emerald-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('students.generate-accounts') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div class="text-center p-4">
                <i class="fas fa-user-gear text-5xl text-[#00B074] mb-3 animate-pulse"></i>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Generate Akun Siswa Otomatis</p>
                <p class="text-xs text-slate-400 mt-2">Sistem akan secara otomatis mendeteksi siswa yang belum memiliki kredensial masuk dan membuatkannya akun login default.</p>
            </div>

            @php $unlinkedCount = \App\Models\Siswa::whereNull('pengguna_id')->count(); @endphp
            <div class="p-4 rounded-xl bg-emerald-50 text-emerald-800 dark:bg-emerald-950/20 dark:text-emerald-400 text-xs leading-relaxed flex items-center gap-3">
                <i class="fas fa-info-circle text-lg"></i>
                <span>Terdapat <b>{{ $unlinkedCount }}</b> data siswa yang siap dibuatkan kredensial masuk otomatis.</span>
            </div>

            <div class="text-xs text-slate-400 leading-normal">
                <i class="fas fa-key mr-1"></i> Username akan diatur berupa email format <code>[nama_depan].[NIS]@siswa.smansago.com</code> dan password default <code>password</code>.
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800/60">
                <button type="button" onclick="closeGenerateModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn bg-[#00B074] hover:bg-[#009662] text-white font-bold px-5 py-2 rounded-xl shadow-lg shadow-emerald-500/10 text-xs transition">Mulai Proses</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Modal controls
    function openAddModal() {
        $('#addAdminModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeAddModal() {
        $('#addAdminModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }
    function openGenerateModal() {
        $('#generateAccountsModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeGenerateModal() {
        $('#generateAccountsModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Detail Modal Controls
    function openDetailModal(id, nama, email, role, status, terdaftar) {
        $('#detailUserId').text(id);
        $('#detailNama').text(nama);
        $('#detailEmail').text(email);
        
        let roleBadge = '';
        if (role === 'admin' || role === 'super_admin') {
            roleBadge = '<span class="badge bg-rose-50 text-rose-700 border border-rose-100 text-xs font-semibold px-2.5 py-1 rounded-lg">Super Admin</span>';
        } else if (role === 'guru') {
            roleBadge = '<span class="badge bg-sky-50 text-sky-700 border border-sky-100 text-xs font-semibold px-2.5 py-1 rounded-lg">Guru</span>';
        } else {
            roleBadge = '<span class="badge bg-amber-50 text-amber-700 border border-amber-100 text-xs font-semibold px-2.5 py-1 rounded-lg">Siswa</span>';
        }
        $('#detailPeranBadge').html(roleBadge);

        let statusBadge = '';
        if (status === 'aktif' || status === 'active') {
            statusBadge = '<span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">Aktif</span>';
        } else {
            statusBadge = '<span class="badge bg-rose-50 text-rose-700 border border-rose-100 text-xs font-semibold px-2.5 py-1 rounded-full">Nonaktif</span>';
        }
        $('#detailStatusBadge').html(statusBadge);
        $('#detailTerdaftar').text(terdaftar);

        $('#detailUserModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeDetailModal() {
        $('#detailUserModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    // Edit Modal Controls
    function openEditModal(id, nama, email, role, status) {
        // Set Action URL dynamically
        const updateUrl = '/admin-accounts/' + id;
        $('#editUserForm').attr('action', updateUrl);

        // Populate fields
        $('#editNamaPengguna').val(nama);
        $('#editEmail').val(email);
        $('#editPeran').val(role);

        $('#editUserModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeEditModal() {
        $('#editUserModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    let usersTable = null;

    window.filterRole = function(role, btn) {
        // Update active styles
        $('.role-tab').removeClass('border-[#D65A20] text-[#D65A20] dark:text-white').addClass('border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300');
        $(btn).addClass('border-[#D65A20] text-[#D65A20] dark:text-white').removeClass('border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300');
        
        if (usersTable) {
            // Search DataTable column 3 ("Peran") with exact regex or clear search
            if (role) {
                usersTable.column(3).search('^' + role + '$', true, false).draw();
            } else {
                usersTable.column(3).search('').draw();
            }
        }

        // Update Export Excel button URL dynamically
        const exportBaseUrl = "{{ route('admin.accounts.export') }}";
        const showAlumniVal = {{ $showAlumni ? 1 : 0 }};
        let exportUrl = exportBaseUrl + '?show_alumni=' + showAlumniVal;
        if (role) {
            exportUrl += '&role=' + encodeURIComponent(role);
        }
        $('#btnExportExcel').attr('href', exportUrl);
    };

    $(document).ready(function() {
        // Show loading skeleton while table is rendering
        $('#skeletonLoading').removeClass('hidden');
        $('#usersTableContainer').addClass('hidden');

        usersTable = $('#usersTable').DataTable({
            dom: 'rt<"flex flex-col md:flex-row justify-between items-center py-4 px-6 border-t border-slate-100 dark:border-slate-800 gap-4"ip>',
            language: {
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                zeroRecords: "Tidak ditemukan data akun yang sesuai",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            },
            responsive: true,
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: [0, 6] // Column 0 (NO) and 6 (Aksi) are non-sortable
                }
            ],
            order: [] // Preserve server-side order (Role -> Kelas -> Nama)
        });

        // Auto-renumbering baris berdasarkan hasil filter/sortir DataTables secara instan & efisien
        usersTable.on('order.dt search.dt', function () {
            usersTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        });

        // Hide skeleton and show table
        $('#skeletonLoading').addClass('hidden');
        $('#usersTableContainer').removeClass('hidden');

        // Binds toolbar search input to datatable search API
        $('#toolbarSearch').on('keyup', function() {
            if (usersTable) {
                usersTable.search(this.value).draw();
            }
        });

        // Add Admin Form submit mapper
        $('#addAdminForm').on('submit', function(e) {
            const nameVal = $('[name="namaPengguna"]', this).val();
            const emailVal = $('[name="email"]', this).val();
            const passVal = $('[name="kataSandi"]', this).val();
            const roleVal = $('[name="peran"]', this).val();

            $(this).append('<input type="hidden" name="name" value="' + nameVal + '">');
            $(this).append('<input type="hidden" name="password" value="' + passVal + '">');
            $(this).append('<input type="hidden" name="role" value="' + roleVal + '">');
        });

        // Edit User Form submit mapper
        $('#editUserForm').on('submit', function(e) {
            const nameVal = $('[name="namaPengguna"]', this).val();
            const emailVal = $('[name="email"]', this).val();
            const roleVal = $('[name="peran"]', this).val();

            $(this).append('<input type="hidden" name="name" value="' + nameVal + '">');
            $(this).append('<input type="hidden" name="role" value="' + roleVal + '">');
        });
    });
</script>
@endpush
@endsection
