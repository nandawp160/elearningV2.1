@extends('layouts.app')

@section('title', 'Pengaturan Hak Akses')

@section('content')
<!-- Custom Styles to Match Premium Design System -->
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
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Pengaturan Hak Akses</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola hak akses setiap peran pengguna pada sistem E-Learning SMAN 1 Cepogo.</p>
        </div>
        <div class="flex items-center gap-2">
            <form action="{{ route('permissions.lock') }}" method="POST">
                @csrf
                <button type="submit" class="btn-orange-outline px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-1.5">
                    <i class="fas fa-lock"></i> Kunci Halaman
                </button>
            </form>
        </div>
    </div>

    <!-- Tab Switching Navigation -->
    <div class="flex border-b border-slate-200 dark:border-slate-800 mb-6 gap-2">
        <button onclick="switchTab('matrix')" id="tab-matrix" class="px-5 py-3 text-sm font-bold border-b-2 border-[#D65A20] text-[#D65A20] focus:outline-none transition">
            🎲 Matriks Otorisasi
        </button>
        <button onclick="switchTab('roles')" id="tab-roles" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
            👥 Daftar Peran
        </button>
    </div>

    <!-- ==========================================
          TAB 1: MATRIX MODE (pengaturan_hak_akses)
         ========================================== -->
    <div id="tab-content-matrix" class="space-y-6">
        <!-- Role selector -->
        <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm flex items-center gap-4">
            <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Pilih Jabatan (Role):</label>
            <div class="relative w-72">
                <select id="selectRoleMatrix" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold" onchange="showRoleMatrix(this.value)">
                    @foreach($roles as $roleKey => $roleName)
                        <option value="{{ $roleKey }}">{{ $roleName }}</option>
                    @endforeach
                </select>
                <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>

        <!-- Table Grid Matrix Form -->
        <form action="{{ route('permissions.store') }}" method="POST" class="space-y-6">
            @csrf
            
            @foreach($roles as $roleKey => $roleName)
            <div class="role-matrix-container {{ $loop->first ? '' : 'hidden' }}" id="matrix-container-{{ $roleKey }}">
                <div class="card p-0 overflow-hidden bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
                                    <th class="px-6 py-4 text-left font-bold text-slate-600 dark:text-slate-400 w-1/3">Nama Modul di Aplikasi</th>
                                    <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Lihat</th>
                                    <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Tambah</th>
                                    <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Ubah</th>
                                    <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @foreach($modules as $groupName => $cols)
                                <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                                    <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">{{ $groupName }}</td>
                                    
                                    @foreach(['view', 'create', 'edit', 'delete'] as $colKey)
                                    <td class="px-6 py-4 text-center">
                                        @if(isset($cols[$colKey]))
                                            @php
                                                $config = $cols[$colKey];
                                                $hasPerm = in_array($config['key'], $permissions[$roleKey] ?? []);
                                            @endphp
                                            <label class="inline-flex items-center justify-center cursor-pointer">
                                                <input type="checkbox" 
                                                       name="matrix[{{ $roleKey }}][]" 
                                                       value="{{ $config['key'] }}"
                                                       {{ $hasPerm ? 'checked' : '' }}
                                                       class="w-5 h-5 rounded text-[#D65A20] border-slate-300 focus:ring-[#D65A20]/20 dark:border-slate-700 dark:bg-slate-900 dark:focus:ring-[#D65A20]/10 transition"
                                                       {{ $roleKey === 'admin' ? 'disabled checked' : '' }} />
                                            </label>
                                        @else
                                            <span class="text-slate-300 dark:text-slate-700 font-bold">—</span>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Action panel -->
            <div class="card p-5 flex flex-col sm:flex-row justify-between items-center gap-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm">
                <div class="flex items-center gap-2 text-xs text-slate-400 dark:text-slate-500">
                    <span class="font-bold">—</span>
                    <span>= Fungsi tidak relevan untuk modul ini.</span>
                </div>
                <button type="submit" class="btn btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- ==========================================
          TAB 2: ROLES MANAGEMENT MODE
         ========================================== -->
    <div id="tab-content-roles" class="space-y-6 hidden">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Total Peran -->
            <div class="stat-card border-l-4 border-l-[#D65A20] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Peran</p>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white mt-1">{{ count($roles) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-users-gear"></i>
                </div>
            </div>

            <!-- Total Hak Akses -->
            <div class="stat-card border-l-4 border-l-[#3B82F6] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Hak Akses</p>
                    @php
                        $totalPermsCount = 0;
                        foreach($modules as $moduleName => $actions) {
                            foreach(['view', 'create', 'edit', 'delete'] as $action) {
                                if (isset($actions[$action]) && isset($actions[$action]['key'])) {
                                    $totalPermsCount++;
                                }
                            }
                        }
                    @endphp
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ $totalPermsCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/20 dark:text-blue-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-key"></i>
                </div>
            </div>

            <!-- Hak Akses Aktif -->
            <div class="stat-card border-l-4 border-l-[#00B074] bg-white dark:bg-slate-900 p-5 rounded-xl shadow-sm flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Hak Akses Aktif</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $totalPermsCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fas fa-circle-check"></i>
                </div>
            </div>
        </div>

        <!-- Toolbar (Search & Actions) -->
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-4 mt-6">
            <!-- Left Search box -->
            <div class="relative w-full sm:w-72">
                <input type="text" id="toolbarSearch" placeholder="Cari peran atau hak akses..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-xs"></i>
                </div>
            </div>

            <!-- Right Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5">
                <button onclick="downloadExcel()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-2">
                    <i class="fas fa-file-excel text-emerald-600"></i>
                    <span>Download Excel</span>
                </button>
                <button onclick="openAddModal()" class="btn btn-orange-solid font-extrabold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center gap-2 text-xs">
                    <span>+ Tambah Peran</span>
                </button>
            </div>
        </div>

        <!-- Main Table View -->
        <div class="card p-0 overflow-hidden bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm mt-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-6 py-4 text-left font-bold text-slate-600 dark:text-slate-400 w-16">No</th>
                            <th class="px-6 py-4 text-left font-bold text-slate-600 dark:text-slate-400">Peran</th>
                            <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Jumlah Hak Akses</th>
                            <th class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-400">Status</th>
                            <th class="px-6 py-4 text-right font-bold text-slate-600 dark:text-slate-400 w-64">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @php $no = 1; @endphp
                        @foreach($roles as $roleKey => $roleName)
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition">
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $no++ }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-100">{{ $roleName }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-slate-100 text-slate-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                    {{ count($permissions[$roleKey] ?? []) }} Hak Akses
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="viewRoleMatrix('{{ $roleKey }}')" class="px-3.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition">
                                        Detail
                                    </button>
                                    <button onclick="editRole('{{ $roleKey }}')" class="px-3.5 py-1.5 text-xs font-semibold text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 bg-white hover:bg-blue-600 rounded-lg transition">
                                        Edit
                                    </button>
                                    <button onclick="deleteRole('{{ $roleKey }}')" class="px-3.5 py-1.5 text-xs font-semibold text-red-600 hover:text-white border border-red-200 hover:border-red-600 bg-white hover:bg-red-600 rounded-lg transition">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: TAMBAH PERAN
     ========================================== -->
<div id="modalTambahHakAkses" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-lg overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#D65A20]">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-users-gear mr-2"></i>Tambah Peran Baru</h3>
            <button onclick="closeAddModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('permissions.addRole') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nama Peran *</label>
                <input type="text" name="role_name" required placeholder="Contoh: Bendahara Keuangan" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
            </div>
            
            <div class="bg-blue-50/50 text-blue-700 p-3 rounded-xl border border-blue-100 text-xs mb-2">
                <i class="fas fa-info-circle mr-1"></i> Peran baru akan ditambahkan tanpa hak akses apa pun secara default. Anda dapat mencentang modul untuk peran ini di tab Matriks Otorisasi setelah dibuat.
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeAddModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn bg-[#D65A20] hover:bg-[#be4e1a] text-white font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">Simpan Peran</button>
            </div>
        </form>
    </div>
</div>

<form id="formDeleteRole" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
    // Tab switching controls
    function switchTab(tab) {
        if (tab === 'matrix') {
            $('#tab-matrix').addClass('border-[#D65A20] text-[#D65A20]').removeClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200');
            $('#tab-roles').addClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200').removeClass('border-[#D65A20] text-[#D65A20]');
            $('#tab-content-matrix').removeClass('hidden');
            $('#tab-content-roles').addClass('hidden');
        } else {
            $('#tab-roles').addClass('border-[#D65A20] text-[#D65A20]').removeClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200');
            $('#tab-matrix').addClass('border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200').removeClass('border-[#D65A20] text-[#D65A20]');
            $('#tab-content-roles').removeClass('hidden');
            $('#tab-content-matrix').addClass('hidden');
        }
    }

    // Matrix display toggling
    function showRoleMatrix(roleKey) {
        $('.role-matrix-container').addClass('hidden');
        $(`#matrix-container-${roleKey}`).removeClass('hidden');
    }

    // Role table actions
    function viewRoleMatrix(roleKey) {
        $('#selectRoleMatrix').val(roleKey);
        showRoleMatrix(roleKey);
        switchTab('matrix');
    }

    function editRole(roleKey) {
        alert(`Fungsi Edit Peran belum diimplementasikan.`);
    }

    function deleteRole(roleKey) {
        if (['admin', 'guru', 'wali_kelas', 'siswa'].includes(roleKey)) {
            alert('Peran bawaan sistem tidak dapat dihapus.');
            return;
        }

        window.showCustomConfirm({
            title: 'Konfirmasi Hapus',
            message: `Apakah Anda yakin ingin menghapus peran "${roleKey}"?`,
            confirmText: 'Ya, Hapus',
            type: 'danger',
            callback: () => {
                const form = document.getElementById('formDeleteRole');
                form.action = `/permissions/delete-role/${roleKey}`;
                form.submit();
            }
        });
    }

    // Modal controls
    function openAddModal() {
        $('#modalTambahHakAkses').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }

    function closeAddModal() {
        $('#modalTambahHakAkses').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }
    
    function downloadExcel() {
        alert('Simulasi: Mengunduh data hak akses ke format Excel.');
    }

    // Auto lock after 15 minutes (900,000 ms) of inactivity or leaving the page (tab inactive/hidden)
    let lockTimer;
    const lockTimeLimit = 15 * 60 * 1000; // 15 minutes

    function startLockTimer() {
        if (!lockTimer) {
            lockTimer = setTimeout(function() {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("permissions.lock") }}';
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }, lockTimeLimit);
        }
    }

    function clearLockTimer() {
        if (lockTimer) {
            clearTimeout(lockTimer);
            lockTimer = null;
        }
    }

    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
            startLockTimer();
        } else {
            clearLockTimer();
        }
    });

    let idleTimer;
    function resetIdleTimer() {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(function() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("permissions.lock") }}';
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }, lockTimeLimit);
    }
    
    window.addEventListener('mousemove', resetIdleTimer);
    window.addEventListener('keypress', resetIdleTimer);
    resetIdleTimer();
</script>
@endpush
@endsection
