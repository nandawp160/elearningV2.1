@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
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
    .btn-indigo-solid {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-indigo-solid:hover {
        background-color: #3730a3 !important;
    }
    .btn-rose-solid {
        background-color: #e11d48 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-rose-solid:hover {
        background-color: #be123c !important;
    }
</style>

<!-- Toast Notification -->
@if(session('success'))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-2xl shadow-sm">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('success') }}</span>
    </div>
    <div class="flex items-center gap-3">
        @if(session('download_archive_url'))
            <a href="{{ session('download_archive_url') }}" data-no-loading class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-1.5 rounded-lg shadow-sm text-xs transition duration-150 inline-flex items-center gap-2">
                <i class="fas fa-download"></i> Unduh Arsip ZIP
            </a>
        @endif
        <button onclick="this.parentElement.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('error'))
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-2xl shadow-sm">
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
    <!-- Page Header Card -->
    <div class="card p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                @if(isset($active_page) && $active_page === 'academic-year')
                <h1 class="page-title text-2xl font-extrabold text-slate-800 dark:text-white">Tahun Ajaran Aktif</h1>
                <p class="page-subtitle text-slate-500 text-sm mt-1">Kelola periode akademik yang aktif pada sistem e-learning.</p>
                @else
                <h1 class="page-title text-2xl font-extrabold text-slate-800 dark:text-white">Pengaturan Sistem</h1>
                <p class="page-subtitle text-slate-500 text-sm mt-1">Konfigurasi parameter operasional e-learning, integrasi gerbang notifikasi, dan profil sekolah.</p>
                @endif
            </div>
            <!-- Tombol Kunci Halaman dihapus dari header global dan dipindahkan khusus ke tab pemeliharaan -->
        </div>
    </div>

    @if(!isset($active_page) || $active_page !== 'academic-year')
    <!-- Tab Switching Navigation -->
    <div class="flex border-b border-slate-200 dark:border-slate-800 gap-2 mb-6">
        <button type="button" onclick="switchSettingsTab('umum')" id="tab-umum" class="px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition">
            ⚙️ Pengaturan Umum
        </button>
        <button type="button" onclick="switchSettingsTab('pemeliharaan')" id="tab-pemeliharaan" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
            🛠️ Pemeliharaan Data (Maintenance)
        </button>
    </div>
    @endif

    @if(isset($active_page) && $active_page === 'academic-year')
    <!-- Tab Navigation for Tahun Ajaran & Rombel -->
    <div class="flex border-b border-slate-200 dark:border-slate-800 gap-2 mb-6">
        <button type="button" onclick="switchAcademicTab('pengaturan')" id="tab-ac-pengaturan" class="px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition">
            ⚙️ Pengaturan Tahun Ajaran
        </button>
        <button type="button" onclick="switchAcademicTab('arsip')" id="tab-ac-arsip" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
            📂 Arsip T.A
        </button>
        <a href="{{ route('classrooms.index') }}" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
            🏫 Rombel Aktif
        </a>
    </div>

    <!-- Konten Pengaturan Tahun Ajaran -->
    <div id="ac-konten-pengaturan" class="space-y-6">
        <!-- Section 1: Periode Aktif & Form -->
        <!-- Section 1A: Periode Aktif Global -->
        <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
            <form action="{{ route('settings.global-active-year') }}" method="POST">
                @csrf
                <div class="flex items-center gap-2 pb-4 border-b border-slate-100 dark:border-slate-800 mb-6">
                    <i class="fas fa-globe text-emerald-500 text-lg"></i>
                    <h3 class="text-base font-extrabold text-slate-800 dark:text-white uppercase tracking-wider">Tahun Ajaran Global (Sistem)</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <div class="mb-4">
                            <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Tahun Ajaran Aktif Saat Ini</p>
                            <div class="flex items-center gap-3">
                                <span class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $global_tahun_ajaran_aktif }}</span>
                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 text-[10px] font-extrabold uppercase rounded-lg flex items-center gap-1"><i class="fas fa-circle text-[8px]"></i> Aktif Global</span>
                            </div>
                            @if(isset($tahun_ajaran_updated_at) && $tahun_ajaran_updated_at)
                            <p class="text-[11px] text-slate-400 mt-1.5"><i class="fas fa-clock mr-1"></i> Terakhir diperbarui: {{ \Carbon\Carbon::parse($tahun_ajaran_updated_at)->isoFormat('D MMMM Y') }}</p>
                            @endif
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-2">
                                <label class="field-label block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aktifkan Tahun Ajaran Baru</label>
                            </div>
                            <div class="flex gap-3">
                                <select name="global_tahun_ajaran" id="selectTahunAjaranAktif" onchange="handleSelectYearChange(this)" class="input font-mono flex-1 text-sm">
                                    @foreach($daftar_tahun_ajaran as $tahun)
                                        <option value="{{ $tahun }}" {{ $global_tahun_ajaran_aktif == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                    @endforeach
                                    <option value="ADD_NEW" class="text-orange-500 font-semibold">+ Tambah Baru...</option>
                                </select>
                                <button type="submit" class="btn btn-rose-solid font-extrabold px-6 py-2.5 rounded-xl shadow-lg shadow-rose-500/15 transition duration-150 flex items-center gap-2 whitespace-nowrap" onclick="return confirm('Peringatan: Mengubah Tahun Ajaran Global akan berdampak pada SELURUH PENGGUNA (Guru & Siswa). Yakin ingin melanjutkan?')">
                                    <i class="fas fa-power-off"></i> Aktifkan Global
                                </button>
                            </div>
                            @error('global_tahun_ajaran') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="bg-rose-50 dark:bg-rose-900/20 rounded-2xl p-5 border border-rose-100 dark:border-rose-800/30">
                        <p class="text-xs font-bold text-rose-600 dark:text-rose-400 uppercase tracking-wider mb-3"><i class="fas fa-exclamation-triangle mr-1"></i> Perhatian:</p>
                        <p class="text-sm text-slate-700 dark:text-slate-300">Pengaturan ini bersifat <strong>Global</strong>. Mengubah tahun ajaran di sini akan langsung mengubah data yang dilihat dan digunakan oleh <strong>seluruh Guru dan Siswa</strong> pada sistem (misal: pengumpulan tugas, entri nilai).</p>
                    </div>
                </div>
            </form>
        </div>

        <!-- Section 1B: Periode Tampilan Admin -->
        <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
            <form action="{{ route('settings.admin-view-year') }}" method="POST">
                @csrf
                <div class="flex items-center gap-2 pb-4 border-b border-slate-100 dark:border-slate-800 mb-6">
                    <i class="fas fa-eye text-indigo-500 text-lg"></i>
                    <h3 class="text-base font-extrabold text-slate-800 dark:text-white uppercase tracking-wider">Ubah Tampilan Data (Session Admin)</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <div class="mb-4">
                            <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Tahun Ajaran Yang Sedang Anda Lihat</p>
                            <div class="flex items-center gap-3">
                                <span class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $settings['tahun_ajaran_aktif'] }}</span>
                                @if($settings['tahun_ajaran_aktif'] === $global_tahun_ajaran_aktif)
                                    <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 text-[10px] font-extrabold uppercase rounded-lg">Sinkron Global</span>
                                @else
                                    <span class="px-2.5 py-1 bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400 text-[10px] font-extrabold uppercase rounded-lg"><i class="fas fa-exclamation-circle mr-1"></i> Mode Preview</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex items-center justify-between mb-2">
                                <label class="field-label block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Tahun Ajaran</label>
                                <button type="button" onclick="openManageAcademicYearsModal()" class="text-[11px] font-bold text-orange-500 hover:text-orange-600 transition flex items-center gap-1">
                                    <i class="fas fa-cog"></i> Kelola
                                </button>
                            </div>
                            <div class="flex gap-3">
                                <select name="admin_tahun_ajaran" onchange="handleSelectYearChange(this)" class="input font-mono flex-1 text-sm">
                                    @foreach($daftar_tahun_ajaran as $tahun)
                                        <option value="{{ $tahun }}" {{ $settings['tahun_ajaran_aktif'] == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                    @endforeach
                                    <option value="ADD_NEW" class="text-orange-500 font-semibold">+ Tambah Baru...</option>
                                </select>
                                <button type="submit" class="btn btn-indigo-solid font-extrabold px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-500/15 transition duration-150 flex items-center gap-2 whitespace-nowrap">
                                    <i class="fas fa-sync"></i> Ubah Tampilan
                                </button>
                            </div>
                            @error('admin_tahun_ajaran') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl p-5 border border-indigo-100 dark:border-indigo-800/30">
                        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-3"><i class="fas fa-info-circle mr-1"></i> Info Tampilan:</p>
                        <p class="text-sm text-slate-700 dark:text-slate-300">Gunakan fitur ini untuk <strong>melihat data dari tahun ajaran lain</strong> (arsip masa lalu atau persiapan tahun depan) tanpa memengaruhi operasional pengguna lain (Guru/Siswa).</p>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- Konten Arsip T.A -->
    <div id="ac-konten-arsip" class="hidden grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Section 2: Riwayat Periode Akademik -->
        <div class="card p-0 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-history text-slate-400 mr-2"></i> Riwayat Periode Akademik</h3>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @foreach($daftar_tahun_ajaran as $tahun)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-calendar text-slate-300 dark:text-slate-600"></i>
                        <span class="font-bold text-slate-700 dark:text-slate-200 font-mono text-base">{{ $tahun }}</span>
                    </div>
                    @if($settings['tahun_ajaran_aktif'] === $tahun)
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 text-xs font-extrabold uppercase rounded-lg">Aktif</span>
                            <a href="{{ route('academic-years.download-archive-detail', str_replace('/', '-', $tahun)) }}" class="px-3 py-1 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:hover:bg-emerald-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200" title="Unduh Excel">
                                <i class="fas fa-file-excel"></i>
                            </a>
                            <a href="{{ route('academic-years.archive-detail', str_replace('/', '-', $tahun)) }}" class="px-3 py-1 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 text-xs font-bold uppercase rounded-lg">Arsip</span>
                            <a href="{{ route('academic-years.download-archive-detail', str_replace('/', '-', $tahun)) }}" class="px-3 py-1 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:hover:bg-emerald-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200" title="Unduh Excel">
                                <i class="fas fa-file-excel"></i>
                            </a>
                            <a href="{{ route('academic-years.archive-detail', str_replace('/', '-', $tahun)) }}" class="px-3 py-1 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- Section 3: Arsip Data Siswa (Alumni) -->
        <div class="card p-0 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-user-graduate text-slate-400 mr-2"></i> Arsip Data Siswa (Alumni)</h3>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse($arsip_alumni as $arsip)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-graduation-cap text-slate-300 dark:text-slate-600"></i>
                        <span class="font-bold text-slate-700 dark:text-slate-200 font-mono text-base">Lulusan {{ $arsip->tahun_lulus }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400 text-[11px] font-extrabold uppercase rounded-lg">{{ $arsip->total }} Siswa</span>
                        <a href="{{ route('academic-years.download-alumni', str_replace('/', '-', $arsip->tahun_lulus)) }}" class="px-3 py-1 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:hover:bg-emerald-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200" title="Unduh Excel">
                            <i class="fas fa-file-excel"></i>
                        </a>
                        <a href="{{ route('academic-years.alumni', str_replace('/', '-', $arsip->tahun_lulus)) }}" class="px-3 py-1 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200">
                            <i class="fas fa-users mr-1"></i> Data
                        </a>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center flex-1 flex flex-col justify-center items-center">
                    <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-box-open text-2xl text-slate-300 dark:text-slate-600"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Belum ada data alumni tersimpan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Section 4: Riwayat Kelas Siswa -->
        <div class="card p-0 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-users text-slate-400 mr-2"></i> Riwayat Kelas Siswa</h3>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse($arsip_siswa as $arsip)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-archive text-slate-300 dark:text-slate-600"></i>
                        <span class="font-bold text-slate-700 dark:text-slate-200 font-mono text-base">Arsip {{ $arsip->academic_year }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400 text-[11px] font-extrabold uppercase rounded-lg">{{ $arsip->total }} Siswa</span>
                        <a href="{{ route('academic-years.download-arsip-siswa', str_replace('/', '-', $arsip->academic_year)) }}" class="px-3 py-1 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:hover:bg-emerald-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200" title="Unduh Excel">
                            <i class="fas fa-file-excel"></i>
                        </a>
                        <a href="{{ route('academic-years.arsip-siswa', str_replace('/', '-', $arsip->academic_year)) }}" class="px-3 py-1 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200">
                            <i class="fas fa-users mr-1"></i> Data
                        </a>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center flex-1 flex flex-col justify-center items-center">
                    <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-box-open text-2xl text-slate-300 dark:text-slate-600"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Belum ada riwayat siswa tersimpan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Section 5: Arsip Mutasi Siswa -->
        <div class="card p-0 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-random text-slate-400 mr-2"></i> Arsip Mutasi Siswa</h3>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse($arsip_mutasi as $arsip)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-calendar-alt text-slate-300 dark:text-slate-600"></i>
                        <span class="font-bold text-slate-700 dark:text-slate-200 font-mono text-base">Tahun {{ $arsip->tahun }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 bg-amber-50 text-amber-600 dark:bg-amber-900/20 dark:text-amber-400 text-[11px] font-extrabold uppercase rounded-lg">{{ $arsip->total }} Siswa</span>
                        <a href="{{ route('academic-years.download-mutasi', str_replace('/', '-', $arsip->tahun)) }}" class="px-3 py-1 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:hover:bg-emerald-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200" title="Unduh Excel">
                            <i class="fas fa-file-excel"></i>
                        </a>
                        <a href="{{ route('academic-years.mutasi', $arsip->tahun) }}" class="px-3 py-1 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20 text-[11px] font-bold uppercase rounded-lg transition duration-200">
                            <i class="fas fa-users mr-1"></i> Data
                        </a>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center flex-1 flex flex-col justify-center items-center">
                    <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-box-open text-2xl text-slate-300 dark:text-slate-600"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Belum ada data mutasi tersimpan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @else
    <!-- Tab Konten: Pengaturan Umum -->
    <div id="tab-konten-umum" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Side: Form Configurations -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
                <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Section 1: School Identity & Profile -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100 dark:border-slate-800">
                            <div class="w-8 h-8 rounded-xl bg-orange-50 text-[#D65A20] dark:bg-orange-950/30 flex items-center justify-center text-sm font-bold">
                                <i class="fas fa-school"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider">Profil & Informasi Instansi Sekolah</h3>
                                <p class="text-xs text-slate-400">Data ini akan digunakan pada kop laporan, cetak leger nilai, dan identitas sistem.</p>
                            </div>
                        </div>

                        <!-- Baris 1: Nama & NPSN -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Nama Sekolah <span class="text-rose-500">*</span></label>
                                <input name="school_name" type="text" required placeholder="Contoh: SMA Negeri 1 Cepogo" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold" value="{{ $settings['school_name'] }}" />
                                @error('school_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">NPSN (Nomor Pokok Sekolah Nasional)</label>
                                <input name="school_npsn" type="text" placeholder="Contoh: 20307718" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-mono" value="{{ $settings['school_npsn'] ?? '' }}" />
                                @error('school_npsn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Baris 2: Kepala Sekolah & NIP -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Nama Kepala Sekolah</label>
                                <input name="headmaster_name" type="text" placeholder="Contoh: Drs. H. Sukardi, M.Pd." class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold" value="{{ $settings['headmaster_name'] ?? '' }}" />
                                @error('headmaster_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">NIP Kepala Sekolah</label>
                                <input name="headmaster_nip" type="text" placeholder="Contoh: 19680512 199412 1 002" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-mono" value="{{ $settings['headmaster_nip'] ?? '' }}" />
                                @error('headmaster_nip') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Baris 3: Email & No. Telp -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Email Resmi Sekolah <span class="text-rose-500">*</span></label>
                                <input name="school_email" type="email" required placeholder="info@smansago.sch.id" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-mono" value="{{ $settings['school_email'] }}" />
                                @error('school_email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">No. Telepon / Hotline</label>
                                <input name="school_phone" type="text" placeholder="Contoh: (0276) 321234 / 08123456789" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" value="{{ $settings['school_phone'] ?? '' }}" />
                                @error('school_phone') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Baris 4: Website & Alamat Lengkap -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Website Resmi Sekolah</label>
                                <input name="school_website" type="text" placeholder="https://sman1cepogo.sch.id" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-mono" value="{{ $settings['school_website'] ?? '' }}" />
                                @error('school_website') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Alamat Lengkap Instansi</label>
                                <input name="school_address" type="text" placeholder="Contoh: Jl. Raya Cepogo KM. 13, Boyolali, Jawa Tengah" class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" value="{{ $settings['school_address'] ?? '' }}" />
                                @error('school_address') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Keamanan & Hak Akses -->
                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100 dark:border-slate-800">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/30 flex items-center justify-center text-sm font-bold">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider">Keamanan & Password Hak Akses</h3>
                        </div>

                        <div>
                            <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Password Halaman Hak Akses</label>
                            <input name="permissions_page_password" type="password" required class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" value="{{ $settings['permissions_page_password'] }}" />
                            <p class="text-[11px] text-slate-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Password untuk melindungi menu Pengaturan Hak Akses dari akses yang tidak berwenang (default: <code>admin123</code>).</p>
                            @error('permissions_page_password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Section 3: Selective Submission Locking (SSL) -->
                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100 dark:border-slate-800">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-[#00B074] dark:bg-emerald-950/30 flex items-center justify-center text-sm font-bold">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider">Sistem Penguncian Tugas Otomatis (SSL)</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Durasi Kunci Otomatis (Jam)</label>
                                <input name="lock_duration_hours" type="number" min="1" max="168" required class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" value="{{ $settings['lock_duration_hours'] }}" />
                                <p class="text-[11px] text-slate-400 mt-1">Tenggat toleransi tugas terlambat sebelum dikunci.</p>
                                @error('lock_duration_hours') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Dispensasi Siswa</label>
                                <select name="allow_dispensations" required class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                                    <option value="1" {{ $settings['allow_dispensations'] == '1' ? 'selected' : '' }}>Aktif (Bisa Mengajukan Banding)</option>
                                    <option value="0" {{ $settings['allow_dispensations'] == '0' ? 'selected' : '' }}>Nonaktif (Hanya Admin)</option>
                                </select>
                                <p class="text-[11px] text-slate-400 mt-1">Mengatur pengajuan banding tugas siswa.</p>
                                @error('allow_dispensations') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Proteksi Deadline Lewat</label>
                                <select name="ssl_lock_expired_deadline" required class="input w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                                    <option value="1" {{ ($settings['ssl_lock_expired_deadline'] ?? '1') == '1' ? 'selected' : '' }}>Aktif (Terkunci Ketat)</option>
                                    <option value="0" {{ ($settings['ssl_lock_expired_deadline'] ?? '1') == '0' ? 'selected' : '' }}>Nonaktif (Fleksibel Edit)</option>
                                </select>
                                <p class="text-[11px] text-slate-400 mt-1">Mengunci form deadline yang sudah kedaluwarsa.</p>
                                @error('ssl_lock_expired_deadline') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-5 border-t border-slate-100 dark:border-slate-800">
                        <button type="submit" class="btn btn-orange-solid font-extrabold px-8 py-3 rounded-2xl shadow-xl shadow-orange-500/20 text-xs transition flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>Simpan Perubahan Informasi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: School Live Preview Card & Infrastructure -->
        <div class="space-y-6">
            <!-- School Profile Preview Card -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm text-center">
                <img src="{{ asset('assets/logo/logo.jpeg') }}" alt="Logo {{ $settings['school_name'] }}" class="w-24 h-24 object-contain rounded-full shadow-md mx-auto mb-4 border-2 border-orange-500/20">
                <h3 class="text-lg font-extrabold text-slate-800 dark:text-white">{{ $settings['school_name'] }}</h3>
                
                @if(!empty($settings['school_npsn']))
                <div class="inline-block mt-1">
                    <span class="px-2.5 py-0.5 rounded-lg bg-orange-100 text-[#D65A20] dark:bg-orange-950/40 text-[11px] font-mono font-bold">NPSN: {{ $settings['school_npsn'] }}</span>
                </div>
                @endif

                <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800 text-left space-y-2.5 text-xs">
                    @if(!empty($settings['headmaster_name']))
                    <div class="flex items-start gap-2.5">
                        <i class="fas fa-user-tie text-slate-400 mt-0.5 text-xs shrink-0"></i>
                        <div class="min-w-0">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Kepala Sekolah</span>
                            <span class="font-bold text-slate-700 dark:text-slate-200 block truncate">{{ $settings['headmaster_name'] }}</span>
                            @if(!empty($settings['headmaster_nip']))
                                <span class="text-[10px] text-slate-400 font-mono">NIP. {{ $settings['headmaster_nip'] }}</span>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if(!empty($settings['school_email']))
                    <div class="flex items-start gap-2.5">
                        <i class="fas fa-envelope text-slate-400 mt-0.5 text-xs shrink-0"></i>
                        <div class="min-w-0">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Email Resmi</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-200 block font-mono truncate">{{ $settings['school_email'] }}</span>
                        </div>
                    </div>
                    @endif

                    @if(!empty($settings['school_phone']))
                    <div class="flex items-start gap-2.5">
                        <i class="fas fa-phone text-slate-400 mt-0.5 text-xs shrink-0"></i>
                        <div class="min-w-0">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Telepon</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-200 block truncate">{{ $settings['school_phone'] }}</span>
                        </div>
                    </div>
                    @endif

                    @if(!empty($settings['school_website']))
                    <div class="flex items-start gap-2.5">
                        <i class="fas fa-globe text-slate-400 mt-0.5 text-xs shrink-0"></i>
                        <div class="min-w-0">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Website</span>
                            <a href="{{ $settings['school_website'] }}" target="_blank" class="font-semibold text-[#D65A20] hover:underline block font-mono truncate">{{ $settings['school_website'] }}</a>
                        </div>
                    </div>
                    @endif

                    @if(!empty($settings['school_address']))
                    <div class="flex items-start gap-2.5">
                        <i class="fas fa-map-marker-alt text-slate-400 mt-0.5 text-xs shrink-0"></i>
                        <div class="min-w-0">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Alamat</span>
                            <span class="text-slate-600 dark:text-slate-300 block text-xs leading-relaxed">{{ $settings['school_address'] }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Server & Infrastructure Card -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-circle-info text-[#D65A20] text-sm"></i>
                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Status Infrastruktur</h4>
                </div>
                <div class="space-y-2.5 text-xs">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Versi PHP:</span>
                        <span class="font-bold text-slate-700 dark:text-slate-300 font-mono">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Versi Laravel:</span>
                        <span class="font-bold text-slate-700 dark:text-slate-300 font-mono">{{ app()->version() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Waktu Server:</span>
                        <span class="font-bold text-slate-700 dark:text-slate-300 font-mono">{{ date('d-m-Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Database:</span>
                        <span class="font-bold text-slate-700 dark:text-slate-300 font-mono">MySQL 8.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End tab-konten-umum -->

    <!-- Tab Konten: Pemeliharaan Data -->
    <div id="tab-konten-pemeliharaan" class="grid grid-cols-1 lg:grid-cols-3 gap-6 hidden">
        @if(!$maintenance_unlocked)
        <!-- Layar Kunci Pemeliharaan Data (Persis Halaman Hak Akses) -->
        <div class="lg:col-span-3 flex items-center justify-center min-h-[50vh] animate-fade-in w-full">
            <div class="loading-card" style="position: relative; top: auto; left: auto; transform: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); border: 1px solid rgba(241, 245, 249, 0.8);">
                <div class="loading-card-bg"></div>
                <div class="relative flex items-center gap-5">
                    <div class="loading-orbit" aria-hidden="true">
                        <span class="loading-dot loading-dot-1"></span>
                        <span class="loading-dot loading-dot-2"></span>
                        <span class="loading-dot loading-dot-3"></span>
                    </div>
                    <div>
                        <p class="loading-title font-bold text-slate-800 dark:text-white">Menyiapkan Halaman</p>
                        <p class="loading-subtitle text-slate-505 dark:text-slate-400">Sedang memuat data terbaru.</p>
                    </div>
                </div>
                <div class="loading-meter" aria-hidden="true">
                    <div class="loading-meter-bar"></div>
                </div>
                @error('maintenance_password')
                    <p class="text-rose-500 text-xs mt-4 font-bold text-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Hidden Unlock Form khusus Maintenance -->
        <form id="hidden-maintenance-unlock-form" action="{{ route('settings.unlock-maintenance') }}" method="POST" class="hidden">
            @csrf
            <input type="password" id="hidden-maintenance-password-input" name="password">
        </form>
        @else
        <!-- Konten Pemeliharaan Terbuka (Unlocked) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header Status Unlocked & Tombol Lock -->
            <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200 dark:bg-slate-800/50 dark:border-slate-700 rounded-xl">
                <div class="flex items-center gap-3 text-slate-700 dark:text-slate-300">
                    <i class="fas fa-lock-open text-emerald-600"></i>
                    <span class="text-sm font-medium">Sesi Pemeliharaan Aktif</span>
                </div>
                <form action="{{ route('settings.lock-maintenance') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 px-3.5 py-1.5 rounded-lg text-[11px] font-semibold flex items-center gap-1.5 shadow-sm transition">
                        <i class="fas fa-lock"></i> Kunci Sesi
                    </button>
                </form>
            </div>

            <!-- Unified Maintenance Settings Panel -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden divide-y divide-slate-100 dark:divide-slate-800/50">
                
                <!-- 1. Pembersihan Cache -->
                <div class="p-6 md:flex md:items-start md:justify-between gap-6 hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                    <div class="md:w-5/12 mb-4 md:mb-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <i class="fas fa-broom text-slate-400"></i>
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Pembersihan Cache</h3>
                        </div>
                        <p class="text-[13px] text-slate-500 leading-relaxed">
                            Bersihkan konfigurasi, view, rute, dan cache aplikasi. Gunakan ini setelah ada pembaruan kode.
                        </p>
                    </div>
                    <div class="md:w-7/12 md:flex md:justify-end">
                        <form action="{{ route('settings.bersihkan-cache') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-2 text-sm w-full md:w-auto justify-center">
                                <i class="fas fa-rotate text-slate-400"></i> Bersihkan Cache
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 2. Database -->
                <div class="p-6 hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-database text-slate-400"></i>
                        <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Pencadangan & Pemulihan Database</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-slate-50/50 dark:bg-slate-900/50 rounded-lg p-5 border border-slate-100 dark:border-slate-800/50">
                        <!-- Backup -->
                        <div>
                            <h4 class="text-[13px] font-semibold text-slate-800 dark:text-slate-300 mb-1">Ekspor Database (.sql)</h4>
                            <p class="text-[13px] text-slate-500 leading-relaxed mb-4">
                                Unduh salinan struktur tabel dan seluruh data saat ini ke komputer lokal Anda.
                            </p>
                            <a href="{{ route('settings.cadangkan-db') }}" data-no-loading class="bg-slate-800 hover:bg-slate-900 dark:bg-slate-700 dark:hover:bg-slate-600 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 inline-flex items-center gap-2 text-[13px]">
                                <i class="fas fa-download"></i> Unduh SQL
                            </a>
                        </div>

                        <!-- Restore -->
                        <div>
                            <h4 class="text-[13px] font-semibold text-slate-800 dark:text-slate-300 mb-1">Impor Database (.sql)</h4>
                            <p class="text-[13px] text-slate-500 leading-relaxed mb-4">
                                Pulihkan sistem dari berkas cadangan. Data saat ini akan ditimpa!
                            </p>
                            <form action="{{ route('settings.pulihkan-db') }}" method="POST" enctype="multipart/form-data" class="space-y-3" onsubmit="return konfirmasiAksiDestruktif(this, 'Apakah Anda yakin ingin memulihkan database?')">
                                @csrf
                                <div>
                                    <input name="berkas_sql" type="file" accept=".sql" required class="w-full text-[13px] border border-slate-200 dark:border-slate-700 rounded-md bg-white dark:bg-slate-800 p-1.5" />
                                </div>
                                <div class="flex gap-2">
                                    <input name="password" type="password" required placeholder="Password admin..." class="w-full text-[13px] border border-slate-200 dark:border-slate-700 rounded-md p-1.5 focus:border-slate-400 focus:ring-0" />
                                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-medium px-3 rounded-md shadow-sm transition text-[13px] whitespace-nowrap">
                                        <i class="fas fa-upload"></i> Pulihkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 2.5 Proteksi Deadline SSL (Quick Toggle Demo) -->
                <div class="p-6 md:flex md:items-start md:justify-between gap-6 hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                    <div class="md:w-7/12 mb-4 md:mb-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <i class="fas fa-shield-alt text-slate-400"></i>
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Proteksi Kunci Deadline Tugas (SSL Strict Mode)</h3>
                            @if(($settings['ssl_lock_expired_deadline'] ?? '1') == '1')
                                <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase">Terkunci Ketat</span>
                            @else
                                <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700 uppercase">Fleksibel Edit</span>
                            @endif
                        </div>
                        <p class="text-[13px] text-slate-500 leading-relaxed">
                            Kunci input deadline di form edit tugas ketika telah lewat batas waktu. Nonaktifkan opsi ini jika ingin demo memajukan/memundurkan deadline secara bebas.
                        </p>
                    </div>
                    <div class="md:w-5/12 md:flex md:justify-end">
                        <form action="{{ route('settings.toggle-ssl-deadline-lock') }}" method="POST">
                            @csrf
                            @if(($settings['ssl_lock_expired_deadline'] ?? '1') == '1')
                                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-2 text-sm w-full md:w-auto justify-center">
                                    <i class="fas fa-lock-open text-xs"></i> Nonaktifkan Proteksi
                                </button>
                            @else
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-2 text-sm w-full md:w-auto justify-center">
                                    <i class="fas fa-lock text-xs"></i> Aktifkan Proteksi
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- 3. Freeze & Unfreeze Storage -->
                <div class="p-6 md:flex md:items-start md:justify-between gap-6 hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                    <div class="md:w-7/12 mb-4 md:mb-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <i class="fas fa-lock text-slate-400"></i>
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Kunci Direktori Penyimpanan</h3>
                            @if(isset($storage_frozen) && $storage_frozen)
                                <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700 uppercase">Terkunci</span>
                            @else
                                <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase">Terbuka</span>
                            @endif
                        </div>
                        <p class="text-[13px] text-slate-500 leading-relaxed">
                            Hentikan seluruh aktivitas unggah berkas ke server fisik. Gunakan saat pergantian tahun ajaran.
                        </p>
                    </div>
                    <div class="md:w-5/12 md:flex md:justify-end">
                        @if(isset($storage_frozen) && $storage_frozen)
                            <form action="{{ route('settings.storage.unfreeze') }}" method="POST" onsubmit="return confirm('Buka kembali akses direktori penyimpanan ke mode Writable?')">
                                @csrf
                                <button type="submit" class="bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-2 text-sm w-full md:w-auto justify-center">
                                    <i class="fas fa-unlock"></i> Buka Kunci (Unfreeze)
                                </button>
                            </form>
                        @else
                            <form action="{{ route('settings.storage.freeze') }}" method="POST" onsubmit="return confirm('Kunci akses direktori penyimpanan ke mode Read-Only?')">
                                @csrf
                                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-2 text-sm w-full md:w-auto justify-center">
                                    <i class="fas fa-lock"></i> Kunci Direktori (Freeze)
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- 4. Arsip ZIP (Per Kelas & Lengkap) -->
                <div class="p-6 hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fas fa-file-zipper text-slate-400"></i>
                        <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Pengunduhan Arsip Berkas (.zip)</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Arsip Kelas -->
                        <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-4">
                            <h4 class="text-[13px] font-semibold text-slate-800 dark:text-slate-300 mb-1">Ekspor Kelas Tertentu</h4>
                            <p class="text-[12px] text-slate-500 mb-3">Unduh materi & jawaban spesifik untuk satu kelas.</p>
                            <form action="{{ route('settings.storage.export-class') }}" method="POST" class="space-y-2" data-no-loading>
                                @csrf
                                <select id="filterTahunAjaranArsip" class="w-full text-[13px] border border-slate-200 dark:border-slate-700 rounded-md p-1.5 bg-slate-50" onchange="filterKelasArsip()">
                                    <option value="">-- Filter Tahun Ajaran --</option>
                                    @foreach($daftar_tahun_ajaran as $ta)
                                        <option value="{{ $ta }}">{{ $ta }}</option>
                                    @endforeach
                                </select>
                                <select name="kelas_id" id="selectKelasArsip" required class="w-full text-[13px] border border-slate-200 dark:border-slate-700 rounded-md p-1.5 bg-slate-50">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($semua_kelas as $kelas)
                                        <option value="{{ $kelas->id }}" data-ta="{{ $kelas->academic_year }}">TA {{ $kelas->academic_year }} | Kelas {{ $kelas->name }}</option>
                                    @endforeach
                                </select>
                                <select name="mata_pelajaran_id" id="selectMapelArsip" class="w-full text-[13px] border border-slate-200 dark:border-slate-700 rounded-md p-1.5 bg-slate-50">
                                    <option value="">-- Semua Mata Pelajaran --</option>
                                    @foreach($semua_mapel as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-medium px-3 py-1.5 rounded-md text-[13px] transition mt-2">
                                    Unduh ZIP Kelas
                                </button>
                            </form>
                        </div>
                        
                        <!-- Arsip Lengkap -->
                        <div class="border border-slate-200 dark:border-slate-700 rounded-lg p-4 flex flex-col justify-between">
                            <div>
                                <h4 class="text-[13px] font-semibold text-slate-800 dark:text-slate-300 mb-1">Ekspor Seluruh Sistem</h4>
                                <p class="text-[12px] text-slate-500 mb-3">Unduh semua materi guru, jawaban siswa, dan salinan SQL database terkompresi sekaligus.</p>
                            </div>
                            <a href="{{ route('settings.ekspor-arsip') }}" data-no-loading class="text-center w-full bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium px-3 py-1.5 rounded-md text-[13px] transition">
                                Unduh Arsip Lengkap
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 5. Auto-Archive Alumni -->
                <div class="p-6 md:flex md:items-start md:justify-between gap-6 hover:bg-rose-50/30 dark:hover:bg-rose-900/10 transition-colors">
                    <div class="md:w-7/12 mb-4 md:mb-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <i class="fas fa-trash-can-arrow-up text-rose-500"></i>
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Auto-Archive Berkas Alumni</h3>
                        </div>
                        <p class="text-[13px] text-slate-500 leading-relaxed">
                            Bungkus file tugas dari siswa lulus menjadi ZIP lalu hapus file fisiknya dari server untuk menghemat storage. Riwayat nilai di database tetap dipertahankan.
                        </p>
                    </div>
                    <div class="md:w-5/12 md:flex md:justify-end">
                        <form action="{{ route('settings.archive-alumni') }}" method="POST" onsubmit="return confirm('Peringatan: Sistem akan menghapus seluruh file tugas milik siswa alumni dari server setelah membungkusnya menjadi arsip ZIP. Proses ini mungkin memakan waktu. Lanjutkan?')">
                            @csrf
                            <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-2 text-sm w-full md:w-auto justify-center">
                                <i class="fas fa-trash-can-arrow-up"></i> Bersihkan File Alumni
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 6. Danger Zone (Reset Data) -->
                <div class="p-6 bg-red-50/30 dark:bg-red-900/10 border border-rose-100 dark:border-rose-900/50 rounded-xl shadow-sm">
                    <div class="flex items-center gap-2 mb-4 border-b border-rose-100 dark:border-rose-900/30 pb-3">
                        <i class="fas fa-triangle-exclamation text-rose-600"></i>
                        <h3 class="text-sm font-bold text-rose-700 dark:text-rose-400">Pembersihan Data Operasional (Reset Semester Baru)</h3>
                    </div>

                    <!-- Warning Banner: Panduan Waktu Reset Data (User-Friendly & High Contrast) -->
                    <div class="mb-6 bg-amber-500/10 dark:bg-amber-950/30 border border-amber-300/80 dark:border-amber-700/60 rounded-2xl p-5 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/20 text-lg">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h4 class="text-sm md:text-base font-extrabold text-slate-800 dark:text-white uppercase tracking-wider">Perhatikan Waktu Eksekusi Pembersihan!</h4>
                                <p class="text-xs text-slate-600 dark:text-slate-300 mt-0.5">Pahami aturan urutan berikut agar data rombel dan plotting siswa baru tidak terhapus secara tidak sengaja.</p>
                            </div>
                        </div>

                        <!-- 2 Kolom Visual: Larangan vs Anjuran -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 pt-1">
                            <!-- Kotak 1: DILARANG (Merah) -->
                            <div class="bg-white dark:bg-slate-900 border-2 border-rose-300 dark:border-rose-900/60 rounded-xl p-4 flex items-start gap-3.5 shadow-sm">
                                <div class="w-8 h-8 rounded-lg bg-rose-100 dark:bg-rose-950/50 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fas fa-times-circle text-base"></i>
                                </div>
                                <div>
                                    <span class="inline-block px-2 py-0.5 rounded bg-rose-100 dark:bg-rose-950/50 text-rose-700 dark:text-rose-400 font-extrabold text-[11px] uppercase tracking-wide mb-1">
                                        ❌ JANGAN RESET JIKA:
                                    </span>
                                    <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-medium">
                                        Anda <strong>sudah menyusun Tahun Ajaran, Rombel, atau Plotting Siswa/Guru baru</strong>. Tindakan reset akan <strong>menghapus data baru tersebut</strong>!
                                    </p>
                                </div>
                            </div>

                            <!-- Kotak 2: DISARANKAN (Hijau) -->
                            <div class="bg-white dark:bg-slate-900 border-2 border-emerald-300 dark:border-emerald-900/60 rounded-xl p-4 flex items-start gap-3.5 shadow-sm">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fas fa-check-circle text-base"></i>
                                </div>
                                <div>
                                    <span class="inline-block px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 font-extrabold text-[11px] uppercase tracking-wide mb-1">
                                        ✅ WAKTU YANG TEPAT:
                                    </span>
                                    <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-medium">
                                        Lakukan saat <strong>penutupan tahun ajaran lama</strong> setelah mengunduh <strong>Backup SQL & ZIP</strong>, dan <strong>SEBELUM</strong> membuat rombel tahun baru.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('settings.reset-data') }}" method="POST" class="space-y-4" onsubmit="return konfirmasiAksiDestruktif(this, 'PERINGATAN KERAS!\n\nApakah Anda yakin ingin menghapus data transaksional terpilih secara permanen?\n\nPastikan:\n1. Anda sudah mengunduh Backup SQL dan Arsip ZIP.\n2. Anda BELUM menyusun data/rombel tahun ajaran baru.\n\nKlik OK untuk melanjutkan.')">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="flex items-start gap-2.5 p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-rose-400 transition shadow-sm">
                                <input type="checkbox" name="opsi[]" value="tugas_nilai" class="mt-0.5 rounded text-rose-500 border-slate-300" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-200 leading-tight">Tugas & Nilai</span>
                                    <span class="block text-[11px] text-slate-400 mt-0.5">Tugas, pengumpulan, & nilai</span>
                                </div>
                            </label>
                            <label class="flex items-start gap-2.5 p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-rose-400 transition shadow-sm">
                                <input type="checkbox" name="opsi[]" value="materi" class="mt-0.5 rounded text-rose-500 border-slate-300" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-200 leading-tight">Materi</span>
                                    <span class="block text-[11px] text-slate-400 mt-0.5">Seluruh berkas materi guru</span>
                                </div>
                            </label>
                            <label class="flex items-start gap-2.5 p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-rose-400 transition shadow-sm">
                                <input type="checkbox" name="opsi[]" value="plot_kelas" class="mt-0.5 rounded text-rose-500 border-slate-300" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-200 leading-tight">Plot Kelas</span>
                                    <span class="block text-[11px] text-slate-400 mt-0.5">Plotting siswa & guru kelas</span>
                                </div>
                            </label>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 items-end pt-2">
                            <div class="w-full sm:w-auto flex-1">
                                <label class="block text-[11px] font-medium text-slate-500 dark:text-slate-400 mb-1">Konfirmasi Password Admin</label>
                                <input name="password" type="password" required placeholder="Ketik password admin..." class="w-full text-sm border border-slate-300 rounded-md p-2 bg-white shadow-sm" />
                            </div>
                            <button type="submit" class="w-full sm:w-auto bg-rose-600 hover:bg-rose-700 text-white font-medium px-4 py-2 rounded-md shadow-sm transition text-sm">
                                Hapus Data Terpilih
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- Kanan: Status Server/Infrastruktur (Sama dengan tab Umum) -->
        <div class="space-y-6">
            <!-- Server Card -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-server text-slate-400"></i>
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Status Infrastruktur</h4>
                </div>
                <div class="space-y-3 text-[13px]">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-50 dark:border-slate-800/50">
                        <span class="text-slate-500">Versi PHP</span>
                        <span class="font-medium text-slate-800 dark:text-slate-300 font-mono">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-50 dark:border-slate-800/50">
                        <span class="text-slate-500">Versi Laravel</span>
                        <span class="font-medium text-slate-800 dark:text-slate-300 font-mono">{{ app()->version() }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-50 dark:border-slate-800/50">
                        <span class="text-slate-500">Waktu Server</span>
                        <span class="font-medium text-slate-800 dark:text-slate-300 font-mono">{{ date('d-m-Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Database</span>
                        <span class="font-medium text-slate-800 dark:text-slate-300 font-mono">MySQL 8.0</span>
                    </div>
                </div>
            </div>
            
            <!-- Keamanan Card -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6 space-y-3">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-shield-halved text-emerald-500"></i>
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Catatan Keamanan</h4>
                </div>
                <p class="text-[12px] text-slate-500 leading-relaxed">
                    Selalu lakukan unduhan cadangan database secara berkala sebelum melakukan restorasi database baru atau pembersihan data. Simpan file SQL cadangan di luar server lokal untuk keamanan tambahan.
                </p>
            </div>
            
            <!-- SOP Pembersihan Data -->
            <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-900/50 rounded-xl p-6 shadow-sm mt-6">
                <div class="flex items-center gap-2 mb-3 border-b border-amber-200/60 dark:border-amber-800/60 pb-3">
                    <i class="fas fa-list-ol text-amber-600 dark:text-amber-500"></i>
                    <h4 class="text-sm font-semibold text-amber-800 dark:text-amber-400">SOP Urutan Reset & Tahun Baru</h4>
                </div>
                <p class="text-[12px] text-amber-700 dark:text-amber-500/80 mb-4 leading-relaxed">
                    Penting: Ikuti urutan langkah di bawah ini secara runut untuk mencegah kehilangan data baru yang sudah disusun.
                </p>
                <ol class="space-y-4 relative border-l border-amber-200 dark:border-amber-800/50 ml-2.5">
                    <li class="pl-4 relative">
                        <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-amber-400 dark:bg-amber-600 ring-4 ring-amber-50 dark:ring-slate-900"></span>
                        <span class="block text-[12px] font-bold text-slate-700 dark:text-slate-300">1. Kunci Direktori (Freeze)</span>
                        <span class="block text-[11px] text-slate-500 mt-0.5">Hentikan lalu lintas upload (Read-Only).</span>
                    </li>
                    <li class="pl-4 relative">
                        <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-amber-400 dark:bg-amber-600 ring-4 ring-amber-50 dark:ring-slate-900"></span>
                        <span class="block text-[12px] font-bold text-slate-700 dark:text-slate-300">2. Unduh SQL & Arsip ZIP</span>
                        <span class="block text-[11px] text-slate-500 mt-0.5">Amankan database master & file tugas tahun lama.</span>
                    </li>
                    <li class="pl-4 relative">
                        <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-rose-400 dark:bg-rose-500 ring-4 ring-amber-50 dark:ring-slate-900"></span>
                        <span class="block text-[12px] font-bold text-rose-700 dark:text-rose-400">3. Eksekusi Reset Data Lama</span>
                        <span class="block text-[11px] text-slate-500 mt-0.5">Kosongkan data transaksional (Tugas, Materi, Plot).</span>
                    </li>
                    <li class="pl-4 relative">
                        <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-emerald-400 dark:bg-emerald-500 ring-4 ring-amber-50 dark:ring-slate-900"></span>
                        <span class="block text-[12px] font-bold text-emerald-700 dark:text-emerald-400">4. Buka Kunci (Unfreeze)</span>
                        <span class="block text-[11px] text-slate-500 mt-0.5">Kembalikan mode server ke Writable.</span>
                    </li>
                    <li class="pl-4 relative">
                        <span class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-indigo-500 ring-4 ring-amber-50 dark:ring-slate-900"></span>
                        <span class="block text-[12px] font-bold text-indigo-700 dark:text-indigo-400">5. Susun Tahun Ajaran & Rombel Baru</span>
                        <span class="block text-[11px] text-slate-500 mt-0.5">Baru buat TA baru, generate rombel, & plotting.</span>
                    </li>
                </ol>

                <div class="mt-4 pt-3 border-t border-amber-200/80 dark:border-amber-800/80 text-[11px] text-amber-900 dark:text-amber-300 font-bold flex items-start gap-1.5">
                    <i class="fas fa-ban text-rose-600 mt-0.5 shrink-0"></i>
                    <span>Jangan pernah jalankan Reset Data setelah langkah 5 dilakukan!</span>
                </div>
            </div>
            
            <!-- Glosarium Fitur Pemeliharaan -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6 space-y-4 mt-6">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-book text-indigo-500"></i>
                    <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200">Glosarium Fitur Pemeliharaan</h4>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h5 class="text-[12px] font-bold text-slate-700 dark:text-slate-300">Ekspor Database (.sql)</h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">
                            Mengunduh salinan mentah (SQL) struktur tabel dan data saat ini ke komputer lokal Anda sebagai cadangan utama.
                        </p>
                    </div>
                    
                    <div>
                        <h5 class="text-[12px] font-bold text-slate-700 dark:text-slate-300">Impor Database (.sql)</h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">
                            Memulihkan data sistem secara paksa menimpa data yang ada menggunakan file SQL cadangan yang pernah diunduh.
                        </p>
                    </div>
                    
                    <div>
                        <h5 class="text-[12px] font-bold text-slate-700 dark:text-slate-300">Ekspor Kelas Tertentu</h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">
                            Mengunduh arsip berisi materi dan jawaban (Tugas) spesifik hanya untuk satu kelas ke dalam format ZIP yang lebih ringan.
                        </p>
                    </div>
                    
                    <div>
                        <h5 class="text-[12px] font-bold text-slate-700 dark:text-slate-300">Ekspor Seluruh Sistem</h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">
                            Membungkus keseluruhan file materi guru, tugas siswa, sekaligus file SQL ke dalam satu file ZIP raksasa. Proses ini sangat memakan waktu.
                        </p>
                    </div>
                    
                    <div>
                        <h5 class="text-[12px] font-bold text-slate-700 dark:text-slate-300">Auto-Archive Berkas Alumni</h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">
                            Secara cerdas mencari tugas dari siswa yang sudah Lulus, membungkusnya menjadi ZIP, dan menghapus PDF fisiknya dari server untuk menghemat SSD.
                        </p>
                    </div>
                    
                    <div>
                        <h5 class="text-[12px] font-bold text-slate-700 dark:text-slate-300">Pembersihan Data Operasional</h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed">
                            Aksi destruktif (permanen) untuk mengosongkan database transaksional agar sistem kembali ringan dan siap menampung data semester baru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- End tab-konten-pemeliharaan -->
    @endif
</div>

<!-- Manage Academic Years Modal -->
<div id="manageAcademicYearsModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeManageAcademicYearsModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl w-full max-w-lg p-6 shadow-2xl transform transition-all duration-300 scale-95 opacity-0 z-50 flex flex-col max-h-[85vh]" id="manageModalPanel">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800 flex-shrink-0">
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar-days text-orange-500 text-lg"></i>
                <h3 class="text-sm font-extrabold text-slate-800 dark:text-white">Kelola Tahun Ajaran</h3>
            </div>
            <button onclick="closeManageAcademicYearsModal()" class="w-8 h-8 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <p class="text-[11px] text-slate-400 mt-3 leading-relaxed mb-4 flex-shrink-0">
            Daftar seluruh periode akademik di sistem. Anda dapat mengubah nama tahun ajaran (berlaku untuk semua data kelas terkait) atau menghapus tahun ajaran kustom yang tidak aktif dan tidak memiliki data kelas.
        </p>

        <div class="divide-y divide-slate-100 dark:divide-slate-800/50 overflow-y-auto pr-1 flex-grow space-y-1" id="customYearsList">
            @foreach($daftar_tahun_ajaran as $tahun)
                <div class="py-2.5 first:pt-0 last:pb-0" data-year-row="{{ $tahun }}">
                    <!-- View Mode -->
                    <div class="flex items-center justify-between w-full" id="view-mode-{{ str_replace('/', '-', $tahun) }}">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-orange-50 dark:bg-orange-950/20 text-orange-500 flex items-center justify-center text-xs flex-shrink-0">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300 font-mono">T.A. {{ $tahun }}</span>
                                @if($settings['tahun_ajaran_aktif'] === $tahun)
                                    <span class="ml-1.5 px-1.5 py-0.5 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 rounded text-[9px] font-extrabold uppercase">Aktif</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="enableInlineEdit('{{ $tahun }}')" class="w-8 h-8 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 dark:bg-indigo-950/40 dark:hover:bg-indigo-900/60 dark:text-indigo-400 flex items-center justify-center transition shadow-sm" title="Ubah Tahun Ajaran">
                                <i class="fas fa-pen text-[11px]"></i>
                            </button>
                            @if($settings['tahun_ajaran_aktif'] !== $tahun && in_array($tahun, $custom_years))
                                <button type="button" onclick="deleteCustomYear('{{ $tahun }}')" class="w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 dark:bg-rose-950/40 dark:hover:bg-rose-900/60 dark:text-rose-400 flex items-center justify-center transition shadow-sm" title="Hapus Tahun Ajaran">
                                    <i class="fas fa-trash text-[11px]"></i>
                                </button>
                            @else
                                <span class="w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800/50 text-slate-350 dark:text-slate-655 flex items-center justify-center text-[11px] cursor-not-allowed" title="Tahun ajaran aktif atau memiliki data kelas tidak dapat dihapus">
                                    <i class="fas fa-ban"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Edit Mode -->
                    <div class="flex items-center justify-between w-full hidden" id="edit-mode-{{ str_replace('/', '-', $tahun) }}">
                        <div class="flex items-center gap-2.5 w-full mr-4">
                            <div class="w-8 h-8 rounded-lg bg-orange-50 dark:bg-orange-950/20 text-orange-500 flex items-center justify-center text-xs flex-shrink-0">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <input type="text" id="input-{{ str_replace('/', '-', $tahun) }}" value="{{ $tahun }}" class="input font-mono text-xs py-1 h-8 w-full focus:border-orange-500" placeholder="Contoh: 2026/2027" />
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <button type="button" onclick="saveInlineEdit('{{ $tahun }}')" class="w-8 h-8 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-600 dark:bg-emerald-950/40 dark:hover:bg-emerald-900/60 dark:text-emerald-400 flex items-center justify-center transition shadow-sm" title="Simpan">
                                <i class="fas fa-check text-[11px]"></i>
                            </button>
                            <button type="button" onclick="disableInlineEdit('{{ $tahun }}')" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-400 flex items-center justify-center transition shadow-sm" title="Batal">
                                <i class="fas fa-times text-[11px]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-800 mt-4 flex-shrink-0">
            <button type="button" onclick="closeManageAcademicYearsModal()" class="btn bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 text-xs font-bold rounded-xl shadow-md transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Add Academic Year Modal -->
<div id="addAcademicYearModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeAddAcademicYearModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl w-full max-w-md p-6 shadow-2xl transform transition-all duration-300 scale-95 opacity-0 z-50" id="addModalPanel">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar-plus text-orange-500 text-lg"></i>
                <h3 class="text-sm font-extrabold text-slate-800 dark:text-white">Tambah Tahun Ajaran Baru</h3>
            </div>
            <button onclick="closeAddAcademicYearModal()" class="w-8 h-8 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="formAddAcademicYear" class="space-y-4 mt-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Tahun Ajaran Baru</label>
                <input type="text" id="addInputYear" placeholder="Contoh: 2026/2027" required class="input font-mono focus:border-orange-500" />
                <p class="text-[10px] text-slate-400 mt-1">Format tahun ajaran baru harus YYYY/YYYY (contoh: 2026/2027).</p>
            </div>

            <div class="flex justify-end gap-2.5 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeAddAcademicYearModal()" class="btn border border-slate-200 text-slate-600 dark:border-slate-800 dark:text-slate-400 px-4 py-2 text-xs font-bold rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    Batal
                </button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 text-xs font-bold rounded-xl shadow-md transition flex items-center gap-1.5">
                    <i class="fas fa-plus"></i>
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const maintenanceUnlocked = @json($maintenance_unlocked);
    let keydownListenerAktif = false;

    // Tab switching untuk halaman pengaturan
    function switchSettingsTab(tabName) {
        const tabUmum = document.getElementById('tab-umum');
        const tabPemeliharaan = document.getElementById('tab-pemeliharaan');
        const kontenUmum = document.getElementById('tab-konten-umum');
        const kontenPemeliharaan = document.getElementById('tab-konten-pemeliharaan');
        const headerCard = document.querySelector('.card.p-6'); // Header page card
        const tabNav = document.querySelector('.flex.border-b.gap-2.mb-6'); // Tab navigation

        if (tabName === 'umum') {
            tabUmum.className = 'px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition';
            tabPemeliharaan.className = 'px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition';
            kontenUmum.classList.remove('hidden');
            kontenPemeliharaan.classList.add('hidden');
            
            // Tampilkan kembali header global
            if (headerCard) headerCard.classList.remove('hidden');
            if (tabNav) tabNav.classList.remove('hidden');
        } else if (tabName === 'pemeliharaan') {
            tabPemeliharaan.className = 'px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition';
            tabUmum.className = 'px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition';
            kontenUmum.classList.add('hidden');
            kontenPemeliharaan.classList.remove('hidden');

            // Jika terkunci, sembunyikan header dan navigasi agar hanya menampilkan loading spinner penuh
            if (!maintenanceUnlocked) {
                if (headerCard) headerCard.classList.add('hidden');
                if (tabNav) tabNav.classList.add('hidden');
                
                // Aktifkan keydown listener global untuk password
                aktifkanKeydownListenerMaintenance();
            }
        }
    }

    // Keydown listener global untuk password tersembunyi
    function aktifkanKeydownListenerMaintenance() {
        if (keydownListenerAktif) return;
        keydownListenerAktif = true;

        const secretPassword = @json($password);
        let typed = "";
        
        const keydownHandler = function(e) {
            // Hanya deteksi jika tab pemeliharaan masih aktif/ditampilkan
            const kontenPemeliharaan = document.getElementById('tab-konten-pemeliharaan');
            if (kontenPemeliharaan.classList.contains('hidden')) {
                window.removeEventListener('keydown', keydownHandler);
                keydownListenerAktif = false;
                return;
            }

            if (e.key.length === 1) {
                typed += e.key;
                
                if (typed === secretPassword) {
                    window.removeEventListener('keydown', keydownHandler);
                    keydownListenerAktif = false;
                    document.getElementById('hidden-maintenance-password-input').value = secretPassword;
                    document.getElementById('hidden-maintenance-unlock-form').submit();
                }
            }
        };

        window.addEventListener('keydown', keydownHandler);
    }

    // Validasi konfirmasi untuk tindakan berbahaya (destruktif)
    function konfirmasiAksiDestruktif(form, pesan) {
        const passwordInput = form.querySelector('input[name="password"]');
        if (!passwordInput || !passwordInput.value) {
            showSystemToast('Silakan isi password konfirmasi terlebih dahulu.', 'error');
            return false;
        }
        
        // Memeriksa jika ada checkbox untuk reset data
        const checkboxes = form.querySelectorAll('input[name="opsi[]"]');
        if (checkboxes.length > 0) {
            let checkedOne = false;
            checkboxes.forEach(cb => {
                if (cb.checked) checkedOne = true;
            });
            if (!checkedOne) {
                showSystemToast('Silakan pilih minimal satu opsi data yang akan direset.', 'error');
                return false;
            }
        }
        
        return confirm(pesan);
    }

    function showSystemToast(message, type = 'success') {
        let container = document.getElementById('system-toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'system-toast-container';
            container.className = 'fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-md w-full sm:w-auto px-4 sm:px-0';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        
        let borderClass = 'border-emerald-100 dark:border-emerald-900/50';
        let bgClass = 'bg-emerald-50/95 dark:bg-emerald-950/20 backdrop-blur-md';
        let textClass = 'text-emerald-700 dark:text-emerald-400';
        let iconClass = 'fa-check-circle text-emerald-500';
        
        if (type === 'error') {
            borderClass = 'border-rose-100 dark:border-rose-900/50';
            bgClass = 'bg-rose-50/95 dark:bg-rose-950/20 backdrop-blur-md';
            textClass = 'text-rose-700 dark:text-rose-400';
            iconClass = 'fa-exclamation-circle text-rose-500';
        }

        toast.className = `glass p-4 border ${borderClass} ${bgClass} ${textClass} flex items-center justify-between rounded-2xl shadow-lg transition-all duration-300 transform translate-y-[-20px] opacity-0`;
        
        toast.innerHTML = `
            <div class="flex items-center gap-3">
                <i class="fas ${iconClass} text-lg"></i>
                <span class="font-semibold text-sm">${message}</span>
            </div>
            <button class="ml-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition">
                <i class="fas fa-times"></i>
            </button>
        `;

        toast.querySelector('button').addEventListener('click', () => {
            toast.classList.add('opacity-0', 'translate-y-[-20px]');
            setTimeout(() => toast.remove(), 300);
        });

        container.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('opacity-0', 'translate-y-[-20px]');
            toast.classList.add('opacity-100', 'translate-y-0');
        }, 10);

        setTimeout(() => {
            if (toast.parentNode) {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-[-20px]');
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);
    }

    let currentSelectedYear = "{{ $settings['tahun_ajaran_aktif'] }}";

    function handleSelectYearChange(select) {
        if (select.value === 'ADD_NEW') {
            select.value = currentSelectedYear;
            openAddAcademicYearModal();
        } else {
            currentSelectedYear = select.value;
        }
    }

    function openAddAcademicYearModal() {
        const modal = document.getElementById('addAcademicYearModal');
        const panel = document.getElementById('addModalPanel');
        const input = document.getElementById('addInputYear');
        
        modal.classList.remove('hidden');
        input.value = '';
        setTimeout(() => {
            panel.classList.remove('scale-95', 'opacity-0');
            panel.classList.add('scale-100', 'opacity-100');
            input.focus();
        }, 10);
    }

    function closeAddAcademicYearModal() {
        const modal = document.getElementById('addAcademicYearModal');
        const panel = document.getElementById('addModalPanel');
        
        panel.classList.remove('scale-100', 'opacity-100');
        panel.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.getElementById('formAddAcademicYear').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const newYearInput = document.getElementById('addInputYear');
        const newYear = newYearInput.value.trim();
        
        if (!newYear) {
            showSystemToast('Silakan isi tahun ajaran baru terlebih dahulu.', 'error');
            return;
        }
        
        const regex = /^\d{4}\/\d{4}$/;
        if (!regex.test(newYear)) {
            showSystemToast('Format tahun ajaran baru harus YYYY/YYYY (contoh: 2026/2027).', 'error');
            return;
        }
        
        fetch("{{ route('settings.add-academic-year') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tahun_ajaran: newYear
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                closeAddAcademicYearModal();
                
                const selectElement = document.getElementById('selectTahunAjaranAktif');
                let exists = false;
                
                for (let i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === data.tahun_ajaran) {
                        exists = true;
                        break;
                    }
                }
                
                if (!exists) {
                    const newOption = document.createElement('option');
                    newOption.value = data.tahun_ajaran;
                    newOption.text = 'T.A. ' + data.tahun_ajaran;
                    
                    const optionsArray = Array.from(selectElement.options);
                    const addNewOption = optionsArray.find(opt => opt.value === 'ADD_NEW');
                    const yearOptions = optionsArray.filter(opt => opt.value !== 'ADD_NEW');
                    
                    yearOptions.push(newOption);
                    yearOptions.sort((a, b) => b.value.localeCompare(a.value));
                    
                    selectElement.innerHTML = '';
                    yearOptions.forEach(opt => selectElement.add(opt));
                    if (addNewOption) {
                        selectElement.add(addNewOption);
                    }
                }
                
                selectElement.value = data.tahun_ajaran;
                currentSelectedYear = data.tahun_ajaran;
                
                const customList = document.getElementById('customYearsList');
                let row = customList.querySelector(`[data-year-row="${data.tahun_ajaran}"]`);
                if (!row) {
                    row = document.createElement('div');
                    row.className = 'py-2.5 first:pt-0 last:pb-0';
                    row.setAttribute('data-year-row', data.tahun_ajaran);
                    
                    const key = data.tahun_ajaran.replace('/', '-');
                    row.innerHTML = `
                        <!-- View Mode -->
                        <div class="flex items-center justify-between w-full" id="view-mode-${key}">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-orange-50 dark:bg-orange-950/20 text-orange-500 flex items-center justify-center text-xs flex-shrink-0">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300 font-mono">T.A. ${data.tahun_ajaran}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="enableInlineEdit('${data.tahun_ajaran}')" class="w-8 h-8 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 dark:bg-indigo-950/40 dark:hover:bg-indigo-900/60 dark:text-indigo-400 flex items-center justify-center transition shadow-sm" title="Ubah Tahun Ajaran">
                                    <i class="fas fa-pen text-[11px]"></i>
                                </button>
                                <button type="button" onclick="deleteCustomYear('${data.tahun_ajaran}')" class="w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 dark:bg-rose-950/40 dark:hover:bg-rose-900/60 dark:text-rose-400 flex items-center justify-center transition shadow-sm" title="Hapus Tahun Ajaran">
                                    <i class="fas fa-trash text-[11px]"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Edit Mode -->
                        <div class="flex items-center justify-between w-full hidden" id="edit-mode-${key}">
                            <div class="flex items-center gap-2.5 w-full mr-4">
                                <div class="w-8 h-8 rounded-lg bg-orange-50 dark:bg-orange-950/20 text-orange-500 flex items-center justify-center text-xs flex-shrink-0">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <input type="text" id="input-${key}" value="${data.tahun_ajaran}" class="input font-mono text-xs py-1 h-8 w-full focus:border-orange-500" placeholder="Contoh: 2026/2027" />
                            </div>
                            <div class="flex items-center gap-1.5 flex-shrink-0">
                                <button type="button" onclick="saveInlineEdit('${data.tahun_ajaran}')" class="w-8 h-8 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-600 dark:bg-emerald-950/40 dark:hover:bg-emerald-900/60 dark:text-emerald-400 flex items-center justify-center transition shadow-sm" title="Simpan">
                                    <i class="fas fa-check text-[11px]"></i>
                                </button>
                                <button type="button" onclick="disableInlineEdit('${data.tahun_ajaran}')" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-400 flex items-center justify-center transition shadow-sm" title="Batal">
                                    <i class="fas fa-times text-[11px]"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    customList.appendChild(row);
                }
                
                showSystemToast(data.message, 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const msg = error.errors && error.errors.tahun_ajaran ? error.errors.tahun_ajaran[0] : 'Gagal menambahkan tahun ajaran baru.';
            showSystemToast(msg, 'error');
        });
    });

    function deleteCustomYear(year) {
        if (!confirm(`Hapus tahun ajaran ${year} dari daftar pilihan?`)) {
            return;
        }

        fetch("{{ route('settings.delete-academic-year') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tahun_ajaran: year
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const selectElement = document.getElementById('selectTahunAjaranAktif');
                for (let i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === year) {
                        selectElement.remove(i);
                        break;
                    }
                }

                const row = document.querySelector(`[data-year-row="${year}"]`);
                if (row) {
                    row.remove();
                }

                showSystemToast(data.message, 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const msg = error.message ? error.message : 'Gagal menghapus tahun ajaran.';
            showSystemToast(msg, 'error');
        });
    }

    function openManageAcademicYearsModal() {
        const modal = document.getElementById('manageAcademicYearsModal');
        const panel = document.getElementById('manageModalPanel');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            panel.classList.remove('scale-95', 'opacity-0');
            panel.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeManageAcademicYearsModal() {
        const modal = document.getElementById('manageAcademicYearsModal');
        const panel = document.getElementById('manageModalPanel');
        
        const editModes = panel.querySelectorAll('[id^="edit-mode-"]');
        editModes.forEach(el => {
            if (!el.classList.contains('hidden')) {
                const year = el.id.replace('edit-mode-', '').replace('-', '/');
                disableInlineEdit(year);
            }
        });

        panel.classList.remove('scale-100', 'opacity-100');
        panel.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function enableInlineEdit(year) {
        const key = year.replace('/', '-');
        document.getElementById(`view-mode-${key}`).classList.add('hidden');
        document.getElementById(`edit-mode-${key}`).classList.remove('hidden');
        document.getElementById(`input-${key}`).focus();
    }

    function disableInlineEdit(year) {
        const key = year.replace('/', '-');
        document.getElementById(`view-mode-${key}`).classList.remove('hidden');
        document.getElementById(`edit-mode-${key}`).classList.add('hidden');
        document.getElementById(`input-${key}`).value = year;
    }

    function saveInlineEdit(oldYear) {
        const key = oldYear.replace('/', '-');
        const newYear = document.getElementById(`input-${key}`).value.trim();
        
        if (!newYear) {
            showSystemToast('Tahun ajaran baru tidak boleh kosong.', 'error');
            return;
        }
        
        const regex = /^\d{4}\/\d{4}$/;
        if (!regex.test(newYear)) {
            showSystemToast('Format tahun ajaran baru harus YYYY/YYYY (contoh: 2023/2024).', 'error');
            return;
        }
        
        fetch("{{ route('settings.edit-academic-year') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                old_tahun_ajaran: oldYear,
                new_tahun_ajaran: newYear
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const selectElement = document.getElementById('selectTahunAjaranAktif');
                for (let i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === oldYear) {
                        selectElement.options[i].value = data.new_tahun_ajaran;
                        selectElement.options[i].text = 'T.A. ' + data.new_tahun_ajaran;
                        break;
                    }
                }
                
                const optionsArray = Array.from(selectElement.options);
                const addNewOption = optionsArray.find(opt => opt.value === 'ADD_NEW');
                const yearOptions = optionsArray.filter(opt => opt.value !== 'ADD_NEW');
                
                yearOptions.sort((a, b) => b.value.localeCompare(a.value));
                
                selectElement.innerHTML = '';
                yearOptions.forEach(opt => selectElement.add(opt));
                if (addNewOption) {
                    selectElement.add(addNewOption);
                }
                
                if (data.is_active) {
                    selectElement.value = data.new_tahun_ajaran;
                    currentSelectedYear = data.new_tahun_ajaran;
                }

                const row = document.querySelector(`[data-year-row="${oldYear}"]`);
                if (row) {
                    const newKey = data.new_tahun_ajaran.replace('/', '-');
                    
                    row.setAttribute('data-year-row', data.new_tahun_ajaran);
                    
                    const viewDiv = row.querySelector(`[id="view-mode-${key}"]`);
                    const editDiv = row.querySelector(`[id="edit-mode-${key}"]`);
                    const inputField = row.querySelector(`[id="input-${key}"]`);
                    
                    viewDiv.id = `view-mode-${newKey}`;
                    editDiv.id = `edit-mode-${newKey}`;
                    inputField.id = `input-${newKey}`;
                    inputField.value = data.new_tahun_ajaran;
                    
                    const labelSpan = viewDiv.querySelector('.font-mono');
                    if (labelSpan) {
                        labelSpan.textContent = 'T.A. ' + data.new_tahun_ajaran;
                    }

                    const labelDiv = labelSpan.parentElement;
                    let badge = labelDiv.querySelector('.bg-emerald-50');
                    if (data.is_active && !badge) {
                        badge = document.createElement('span');
                        badge.className = 'ml-1.5 px-1.5 py-0.5 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 rounded text-[9px] font-extrabold uppercase';
                        badge.textContent = 'Aktif';
                        labelDiv.appendChild(badge);
                    } else if (!data.is_active && badge) {
                        badge.remove();
                    }
                    
                    const viewButtons = viewDiv.querySelectorAll('button');
                    viewButtons.forEach(btn => {
                        const onClickAttr = btn.getAttribute('onclick');
                        if (onClickAttr.includes('enableInlineEdit')) {
                            btn.setAttribute('onclick', `enableInlineEdit('${data.new_tahun_ajaran}')`);
                        } else if (onClickAttr.includes('deleteCustomYear')) {
                            btn.setAttribute('onclick', `deleteCustomYear('${data.new_tahun_ajaran}')`);
                        }
                    });
                    
                    const editButtons = editDiv.querySelectorAll('button');
                    editButtons.forEach(btn => {
                        const onClickAttr = btn.getAttribute('onclick');
                        if (onClickAttr.includes('saveInlineEdit')) {
                            btn.setAttribute('onclick', `saveInlineEdit('${data.new_tahun_ajaran}')`);
                        } else if (onClickAttr.includes('disableInlineEdit')) {
                            btn.setAttribute('onclick', `disableInlineEdit('${data.new_tahun_ajaran}')`);
                        }
                    });
                    
                    viewDiv.classList.remove('hidden');
                    editDiv.classList.add('hidden');
                }
                
                showSystemToast(data.message, 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const msg = error.message ? error.message : 'Gagal memperbarui tahun ajaran.';
            showSystemToast(msg, 'error');
        });
    }

    // Auto-switch ke tab pemeliharaan jika terdapat parameter ?tab=pemeliharaan di URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tabActive = urlParams.get('tab');
        if (tabActive === 'pemeliharaan') {
            switchSettingsTab('pemeliharaan');
        } else if (tabActive === 'arsip') {
            if (typeof switchAcademicTab === 'function') {
                switchAcademicTab('arsip');
            }
        }
    });

    function switchAcademicTab(tabName) {
        // Toggle buttons style
        const btnPengaturan = document.getElementById('tab-ac-pengaturan');
        const btnArsip = document.getElementById('tab-ac-arsip');
        
        // Content containers
        const kontenPengaturan = document.getElementById('ac-konten-pengaturan');
        const kontenArsip = document.getElementById('ac-konten-arsip');
        
        if (tabName === 'pengaturan') {
            btnPengaturan.className = "px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition";
            btnArsip.className = "px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition";
            
            kontenPengaturan.classList.remove('hidden');
            kontenArsip.classList.add('hidden');
        } else if (tabName === 'arsip') {
            btnArsip.className = "px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition";
            btnPengaturan.className = "px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition";
            
            kontenArsip.classList.remove('hidden');
            kontenPengaturan.classList.add('hidden');
        }
    }
</script>
@endpush

