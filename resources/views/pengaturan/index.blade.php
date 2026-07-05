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
</style>

<!-- Toast Notification -->
@if(session('success'))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-2xl shadow-sm">
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
                <h1 class="page-title text-2xl font-extrabold text-slate-800 dark:text-white">Pengaturan Sistem</h1>
                <p class="page-subtitle text-slate-500 text-sm mt-1">Konfigurasi parameter operasional e-learning, integrasi gerbang notifikasi, dan profil sekolah.</p>
            </div>
            <!-- Tombol Kunci Halaman dihapus dari header global dan dipindahkan khusus ke tab pemeliharaan -->
        </div>
    </div>

    <!-- Tab Switching Navigation -->
    <div class="flex border-b border-slate-200 dark:border-slate-800 gap-2 mb-6">
        <button type="button" onclick="switchSettingsTab('umum')" id="tab-umum" class="px-5 py-3 text-sm font-bold border-b-2 border-orange-500 text-orange-500 focus:outline-none transition">
            ⚙️ Pengaturan Umum
        </button>
        <button type="button" onclick="switchSettingsTab('pemeliharaan')" id="tab-pemeliharaan" class="px-5 py-3 text-sm font-bold border-b-2 border-transparent text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none transition">
            🛠️ Pemeliharaan Data (Maintenance)
        </button>
    </div>

    <!-- Tab Konten: Pengaturan Umum -->
    <div id="tab-konten-umum" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Side: Form Configurations -->
        <div class="lg:col-span-2">
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
                <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Section 1: School Identity -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                            <i class="fas fa-school text-orange-500 text-sm"></i>
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Identitas Instansi Sekolah</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Sekolah</label>
                                <input name="school_name" type="text" required class="input" value="{{ $settings['school_name'] }}" />
                                @error('school_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email Resmi Sekolah</label>
                                <input name="school_email" type="email" required class="input" value="{{ $settings['school_email'] }}" />
                                @error('school_email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Password Halaman Hak Akses</label>
                                <input name="permissions_page_password" type="password" required class="input" value="{{ $settings['permissions_page_password'] }}" />
                                <p class="text-[11px] text-slate-400 mt-1">Password untuk melindungi halaman Pengaturan Hak Akses (default: admin123). Karakter tidak terlihat saat diisi.</p>
                                @error('permissions_page_password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Selective Submission Locking -->
                    <div class="space-y-4 pt-4">
                        <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                            <i class="fas fa-lock-open text-orange-500 text-sm"></i>
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Sistem Penguncian Tugas Otomatis</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Durasi Kunci Otomatis (Jam)</label>
                                <input name="lock_duration_hours" type="number" min="1" max="168" required class="input" value="{{ $settings['lock_duration_hours'] }}" />
                                <p class="text-[11px] text-slate-400 mt-1">Lama waktu tugas dapat dikirim terlambat setelah deadline sebelum dikunci total.</p>
                                @error('lock_duration_hours') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Metode Dispensasi Siswa</label>
                                <select name="allow_dispensations" required class="input">
                                    <option value="1" {{ $settings['allow_dispensations'] == '1' ? 'selected' : '' }}>Aktif (Siswa Dapat Mengajukan Banding)</option>
                                    <option value="0" {{ $settings['allow_dispensations'] == '0' ? 'selected' : '' }}>Nonaktif (Kunci Mutlak Terbuka Hanya Oleh Admin)</option>
                                </select>
                                <p class="text-[11px] text-slate-400 mt-1">Mengatur apakah siswa dapat mengirimkan banding dispensasi tugas terlambat.</p>
                                @error('allow_dispensations') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: WhatsApp Fonnte Integration -->
                    <div class="space-y-4 pt-4 hidden">
                        <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                            <i class="fab fa-whatsapp text-orange-500 text-sm"></i>
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Integrasi WhatsApp (Fonnte API)</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Notifikasi</label>
                                <select name="wa_notification_status" required class="input">
                                    <option value="1" {{ $settings['wa_notification_status'] == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ $settings['wa_notification_status'] == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">API Token Fonnte</label>
                                <input name="fonnte_token" type="password" class="input" value="{{ $settings['fonnte_token'] }}" placeholder="Masukkan Fonnte API Token..." />
                                @error('fonnte_token') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <p class="text-xxs text-slate-400 leading-normal"><i class="fas fa-info-circle mr-1"></i> Notifikasi WhatsApp Fonnte digunakan untuk mengirimkan peringatan otomatis kepada orang tua ketika siswa terlambat mengumpulkan tugas sekolah.</p>
                    </div>

                    <!-- Section 1.5: Tahun Ajaran Aktif -->
                    <div class="space-y-4 pt-4">
                        <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                            <i class="fas fa-calendar-alt text-orange-500 text-sm"></i>
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Periode Akademik Aktif</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div class="max-w-md">
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="field-label block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tahun Ajaran Aktif</label>
                                    <button type="button" onclick="openManageAcademicYearsModal()" class="text-[11px] font-bold text-orange-500 hover:text-orange-600 transition flex items-center gap-1">
                                        <i class="fas fa-cog"></i>
                                        Kelola Tahun Ajaran
                                    </button>
                                </div>
                                <select name="tahun_ajaran_aktif" id="selectTahunAjaranAktif" onchange="handleSelectYearChange(this)" class="input font-mono">
                                    @foreach($daftar_tahun_ajaran as $tahun)
                                        <option value="{{ $tahun }}" {{ $settings['tahun_ajaran_aktif'] == $tahun ? 'selected' : '' }}>T.A. {{ $tahun }}</option>
                                    @endforeach
                                    <option value="ADD_NEW" class="text-orange-500 font-semibold">+ Tambah Tahun Ajaran Baru...</option>
                                </select>
                                <p class="text-[11px] text-slate-400 mt-1">Pilih periode akademik aktif untuk seluruh sistem saat ini, atau pilih "+ Tambah Tahun Ajaran Baru..." untuk mendaftarkan periode baru.</p>
                                @error('tahun_ajaran_aktif') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-800">
                        <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-extrabold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/15 transition duration-150 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Logo & System Info Card -->
        <div class="space-y-6">
            <!-- Logo Card -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm text-center">
                <img src="{{ asset('assets/logo/logo.jpeg') }}" alt="Logo {{ $settings['school_name'] }}" class="w-24 h-24 object-contain rounded-full shadow-md mx-auto mb-4 border-2 border-orange-500/10">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">{{ $settings['school_name'] }}</h3>
                <p class="text-xs text-slate-400 font-mono mt-0.5">{{ $settings['school_name'] }}</p>
            </div>

            <!-- Server Card -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-circle-info text-orange-500 text-sm"></i>
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
            <div class="flex items-center justify-between p-4 bg-emerald-50/70 border border-emerald-100 dark:bg-emerald-950/20 dark:border-emerald-900/50 rounded-2xl">
                <div class="flex items-center gap-2 text-emerald-800 dark:text-emerald-400">
                    <i class="fas fa-lock-open text-xs"></i>
                    <span class="text-xs font-bold">Modul Pemeliharaan Terbuka (Sesi Aktif)</span>
                </div>
                <form action="{{ route('settings.lock-maintenance') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-orange-outline px-3.5 py-1.5 rounded-xl text-[10px] font-extrabold flex items-center gap-1.5 shadow-sm">
                        <i class="fas fa-lock"></i> Kunci Modul
                    </button>
                </form>
            </div>

            <!-- 1. Pembersihan Cache -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-broom text-orange-500 text-sm"></i>
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Pembersihan Cache Sistem</h3>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Bersihkan konfigurasi, view, rute, dan cache aplikasi. Tindakan ini berguna untuk memastikan perubahan kode program atau konfigurasi langsung diterapkan tanpa hambatan cache server.
                </p>
                <form action="{{ route('settings.bersihkan-cache') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 flex items-center gap-2 text-xs">
                        <i class="fas fa-broom"></i> Bersihkan Cache Aplikasi
                    </button>
                </form>
            </div>

            <!-- 2. Pencadangan & Pemulihan Database -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-database text-orange-500 text-sm"></i>
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Pencadangan & Pemulihan Database</h3>
                </div>
                
                <!-- Sub-panel Backup -->
                <div class="space-y-2.5 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Ekspor Database (.sql)</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Unduh salinan struktur tabel dan seluruh data saat ini ke komputer lokal Anda dalam format dokumen SQL.
                    </p>
                    <a href="{{ route('settings.cadangkan-db') }}" data-no-loading class="btn bg-[#D65A20] hover:bg-[#be4e1a] text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 inline-flex items-center gap-2 text-xs">
                        <i class="fas fa-download"></i> Unduh Cadangan Database
                    </a>
                </div>

                <!-- Sub-panel Restore -->
                <div class="space-y-3 pt-2">
                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Impor Database (.sql)</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Pulihkan kondisi sistem dari berkas cadangan SQL. Tindakan ini akan menimpa seluruh data saat ini secara permanen.
                    </p>
                    <form action="{{ route('settings.pulihkan-db') }}" method="POST" enctype="multipart/form-data" class="space-y-4" onsubmit="return konfirmasiAksiDestruktif(this, 'Apakah Anda yakin ingin memulihkan database? Seluruh data saat ini akan terhapus dan digantikan oleh berkas cadangan.')">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Berkas SQL</label>
                                <input name="berkas_sql" type="file" accept=".sql" required class="input py-2 text-xs" />
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Konfirmasi Password Admin</label>
                                <input name="password" type="password" required placeholder="Masukkan password Anda..." class="input text-xs" />
                            </div>
                        </div>
                        <button type="submit" class="btn bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 flex items-center gap-2 text-xs">
                            <i class="fas fa-upload"></i> Pulihkan Database
                        </button>
                    </form>
                </div>
            </div>

            <!-- 2.5. Manajemen Arsip & Akses Berkas -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-folder-tree text-orange-500 text-sm"></i>
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Manajemen Akses Berkas & Arsip</h3>
                </div>
                
                <!-- Kunci Direktori (Freeze) -->
                <div class="space-y-3 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Kunci Direktori Penyimpanan (Freeze Storage)</h4>
                            <p class="text-xs text-slate-500 leading-relaxed mt-1">
                                Kunci seluruh aktivitas unggah berkas (tugas dan jawaban) ke server fisik. Fitur ini biasa digunakan saat tahun ajaran ditutup agar struktur direktori tidak lagi berubah secara sengaja maupun tidak sengaja (Read-Only).
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            @if(isset($storage_frozen) && $storage_frozen)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 font-bold text-xs border border-rose-200">
                                    <i class="fas fa-lock"></i> Terkunci
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 font-bold text-xs border border-emerald-200">
                                    <i class="fas fa-lock-open"></i> Terbuka
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        @if(isset($storage_frozen) && $storage_frozen)
                            <form action="{{ route('settings.storage.unfreeze') }}" method="POST" onsubmit="return confirm('Buka kembali akses direktori penyimpanan ke mode Writable?')">
                                @csrf
                                <button type="submit" class="btn bg-slate-600 hover:bg-slate-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 flex items-center gap-2 text-xs">
                                    <i class="fas fa-unlock"></i> Buka Kunci Direktori (Unfreeze)
                                </button>
                            </form>
                        @else
                            <form action="{{ route('settings.storage.freeze') }}" method="POST" onsubmit="return confirm('Kunci akses direktori penyimpanan ke mode Read-Only? Siswa dan Guru tidak akan bisa mengunggah tugas baru ke server sebelum kunci dibuka kembali.')">
                                @csrf
                                <button type="submit" class="btn bg-rose-600 hover:bg-rose-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 flex items-center gap-2 text-xs">
                                    <i class="fas fa-lock"></i> Kunci Direktori (Freeze)
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Ekspor Arsip Kelas -->
                <div class="space-y-3 pt-1">
                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Ekspor Arsip Kelas (Per Kelas)</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Unduh salinan fisik seluruh soal tugas dari guru beserta file jawaban dari siswa spesifik untuk satu kelas, dibungkus secara rapi dalam format arsip ZIP.
                    </p>
                    
                    <form action="{{ route('settings.storage.export-class') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tahun Ajaran</label>
                                <select id="filterTahunAjaranArsip" class="input py-2 text-xs font-mono" onchange="filterKelasArsip()">
                                    <option value="">-- Semua Tahun Ajaran --</option>
                                    @foreach($daftar_tahun_ajaran as $ta)
                                        <option value="{{ $ta }}">TA {{ $ta }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Kelas</label>
                                <select name="kelas_id" id="selectKelasArsip" required class="input py-2 text-xs font-mono">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($semua_kelas as $kelas)
                                        <option value="{{ $kelas->id }}" data-ta="{{ $kelas->academic_year }}">TA {{ $kelas->academic_year }} | Kelas {{ $kelas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <script>
                            function filterKelasArsip() {
                                const filterTa = document.getElementById('filterTahunAjaranArsip').value;
                                const selectKelas = document.getElementById('selectKelasArsip');
                                const options = selectKelas.querySelectorAll('option:not([value=""])');
                                
                                selectKelas.value = ""; // reset selection
                                
                                options.forEach(opt => {
                                    if (filterTa === "" || opt.getAttribute('data-ta') === filterTa) {
                                        opt.style.display = "";
                                    } else {
                                        opt.style.display = "none";
                                    }
                                });
                            }
                        </script>
                        <button type="submit" class="btn bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 flex items-center gap-2 text-xs">
                            <i class="fas fa-box-archive"></i> Ekspor Arsip Kelas (.zip)
                        </button>
                    </form>
                </div>
            </div>
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-file-archive text-orange-500 text-sm"></i>
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Ekspor Arsip Lengkap (.zip)</h3>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Ekspor seluruh berkas lampiran materi dari guru, berkas jawaban pengumpulan tugas dari siswa, dan salinan database SQL terkompresi ke dalam satu file arsip ZIP untuk pencadangan total.
                </p>
                <a href="{{ route('settings.ekspor-arsip') }}" data-no-loading class="btn bg-[#D65A20] hover:bg-[#be4e1a] text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 inline-flex items-center gap-2 text-xs">
                    <i class="fas fa-file-zipper"></i> Unduh Arsip Lengkap (.zip)
                </a>
            </div>

            <!-- 4. Danger Zone (Reset Data) -->
            <div class="card p-6 bg-rose-50/55 dark:bg-rose-950/10 border border-rose-100 dark:border-rose-900/50 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-rose-100 dark:border-rose-900/40">
                    <i class="fas fa-exclamation-triangle text-rose-500 text-sm"></i>
                    <h3 class="text-sm font-bold text-rose-700 dark:text-rose-400 uppercase tracking-wider font-extrabold font-mono">Zona Bahaya: Reset Data Tahun Ajaran Baru</h3>
                </div>
                <p class="text-xs text-rose-600/90 leading-relaxed font-semibold">
                    Lakukan pembersihan data operasional lama secara selektif untuk menyambut semester atau tahun ajaran baru. Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                </p>
                <form action="{{ route('settings.reset-data') }}" method="POST" class="space-y-4" onsubmit="return konfirmasiAksiDestruktif(this, 'Apakah Anda sangat yakin ingin membersihkan data terpilih? Semua data transaksional tersebut akan dihapus secara permanen dari server.')">
                    @csrf
                    
                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Pilih Data yang Akan Dihapus:</label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="flex items-start gap-3 p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-rose-400 transition">
                                <input type="checkbox" name="opsi[]" value="tugas_nilai" class="mt-0.5 rounded text-rose-500 focus:ring-rose-400" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-250">Tugas, Nilai & Banding</span>
                                    <span class="block text-[10px] text-slate-400 leading-normal mt-0.5">Menghapus data penugasan guru, nilai, file pengumpulan siswa, beserta riwayat banding keterlambatan.</span>
                                </div>
                            </label>

                            <label class="flex items-start gap-3 p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-rose-400 transition">
                                <input type="checkbox" name="opsi[]" value="materi" class="mt-0.5 rounded text-rose-500 focus:ring-rose-400" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-250">Materi Pembelajaran</span>
                                    <span class="block text-[10px] text-slate-400 leading-normal mt-0.5">Menghapus seluruh file dan berkas link materi pembelajaran yang diunggah oleh guru mata pelajaran.</span>
                                </div>
                            </label>

                            <label class="flex items-start gap-3 p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-rose-400 transition">
                                <input type="checkbox" name="opsi[]" value="kehadiran" class="mt-0.5 rounded text-rose-500 focus:ring-rose-400" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-250">Absensi / Kehadiran</span>
                                    <span class="block text-[10px] text-slate-400 leading-normal mt-0.5">Menghapus seluruh log riwayat presensi harian siswa dan sesi pertemuan kelas.</span>
                                </div>
                            </label>

                            <label class="flex items-start gap-3 p-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-rose-400 transition">
                                <input type="checkbox" name="opsi[]" value="plot_kelas" class="mt-0.5 rounded text-rose-500 focus:ring-rose-400" />
                                <div>
                                    <span class="block text-xs font-bold text-slate-800 dark:text-slate-250">Plotting Kelas & Pengampuan</span>
                                    <span class="block text-[10px] text-slate-400 leading-normal mt-0.5">Mengosongkan penugasan kelas siswa (unenroll) serta melepaskan plotting pengampuan guru.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="max-w-md pt-2">
                        <label class="field-label mb-1.5 block text-xs font-bold text-rose-700 dark:text-rose-400 uppercase tracking-wider">Konfirmasi Password Admin</label>
                        <input name="password" type="password" required placeholder="Masukkan password admin untuk validasi..." class="input border-rose-200 focus:border-rose-500 text-xs" />
                    </div>

                    <button type="submit" class="btn bg-rose-600 hover:bg-rose-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition duration-150 flex items-center gap-2 text-xs">
                        <i class="fas fa-exclamation-triangle"></i> Bersihkan Data Terpilih Permanen
                    </button>
                </form>
            </div>
        </div>

        <!-- Kanan: Status Server/Infrastruktur (Sama dengan tab Umum) -->
        <div class="space-y-6">
            <!-- Server Card -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-circle-info text-orange-500 text-sm"></i>
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
            
            <!-- Keamanan Card -->
            <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100 dark:border-slate-800">
                    <i class="fas fa-shield-halved text-orange-500 text-sm"></i>
                    <h4 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Saran Keamanan</h4>
                </div>
                <p class="text-[11px] text-slate-400 leading-normal">
                    Selalu lakukan unduhan cadangan database secara berkala sebelum melakukan restorasi database baru atau pembersihan data tahun ajaran. Simpan file SQL cadangan di luar server lokal untuk keamanan tambahan.
                </p>
            </div>
        </div>
        @endif
    </div>
    <!-- End tab-konten-pemeliharaan -->
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
        }
    });
</script>
@endpush

