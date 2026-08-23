@extends('layouts.app')

@section('title', 'Dashboard')
@section('hide_global_alert', true)

@section('content')
<div class="space-y-8">
    @if(auth()->user()->isStudent() && !isset($myClass))
    <div class="card p-8 md:p-10">
        <div class="flex flex-col items-center text-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i class="fas fa-user-clock text-2xl"></i>
            </div>
            <h2 class="text-2xl md:text-3xl font-semibold text-slate-900 dark:text-white">Pendaftaran Sedang Diverifikasi</h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl">
                Halo, <strong>{{ auth()->user()->name }}</strong>! Biodata Anda telah kami terima. Saat ini akun Anda menunggu proses verifikasi dan penempatan kelas oleh Admin.
            </p>
            <div class="badge badge-warning px-4 py-2 text-sm">
                Status: Menunggu Persetujuan Admin
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <div class="glass p-5">
                <h4 class="font-semibold text-slate-800 dark:text-slate-100 mb-2">Apa langkah selanjutnya?</h4>
                <p class="text-sm text-slate-500">Admin akan meninjau data Anda dan menempatkan ke kelas yang sesuai.</p>
            </div>
            <div class="glass p-5">
                <h4 class="font-semibold text-slate-800 dark:text-slate-100 mb-2">Kapan akun saya aktif?</h4>
                <p class="text-sm text-slate-500">Proses ini biasanya memakan waktu 1-2 hari kerja.</p>
            </div>
            <div class="glass p-5">
                <h4 class="font-semibold text-slate-800 dark:text-slate-100 mb-2">Butuh bantuan?</h4>
                <p class="text-sm text-slate-500">Hubungi petugas Tata Usaha jika mengalami kendala.</p>
            </div>
        </div>
    </div>
    @elseif(auth()->user()->isStudent())

    <!-- Custom CSS styles specific to the student dashboard -->
    <style>
        /* Hide the global layout navbar only on the student dashboard page */
        nav.sticky.top-0 {
            display: none !important;
        }
        body div.relative.md\:ml-72 main {
            padding-top: 2rem !important;
        }

        /* Float animation and styling for 3D mascot video */
        .asset-maskot {
            mix-blend-mode: multiply; 
            filter: brightness(1.2) contrast(1.5);
            animation: floatAnimation 4s ease-in-out infinite;
        }
        @keyframes floatAnimation {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Custom hover transition */
        .card-hover-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover-transition:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="space-y-6">
        <!-- 2. Header Dashboard -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-200/70 dark:border-slate-800/70">
            <!-- Left Side: Indonesian Date & Mobile Toggle -->
            <div class="flex items-center gap-3.5">
                <!-- Hamburger menu button on mobile -->
                <button onclick="openSidebar()" class="md:hidden text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white focus:outline-none transition-colors duration-150 mr-1">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Dashboard Portal</p>
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white mt-1">
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                    </h2>
                </div>
            </div>

            <!-- Right Side: Student Profile Information -->
            <div class="flex items-center gap-3 md:justify-end">
                <div class="text-left md:text-right">
                    <h4 class="text-base font-bold text-slate-800 dark:text-white leading-none mb-1">{{ auth()->user()->name }}</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-semibold">
                        Kelas {{ auth()->user()->student->resolved_kelas ?? 'Belum Terdaftar' }} • NIS {{ auth()->user()->student->nis ?? '-' }}
                    </p>
                </div>
                <div class="w-11 h-11 rounded-full bg-[#fdf2ec] text-[#D65A20] flex items-center justify-center overflow-hidden border border-orange-100 flex-shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=fdf2ec&color=D65A20&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        @include('components.profile-alert')

        <!-- Layout Grid: 2 columns left, 1 column right on desktop -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Panel (Greeting + Hero Asset Placeholder) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- 3. Area Sapaan -->
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-8 rounded-3xl shadow-sm card-hover-transition">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        Halo, {{ auth()->user()->name }}!
                    </h1>
                    <p class="text-lg md:text-xl font-medium text-slate-500 dark:text-slate-400 mt-3">
                        Mari selesaikan tugas-tugasmu hari ini.
                    </p>
                </div>

                <!-- 4. Hero Asset Area -->
                <div class="bg-white dark:bg-slate-900 border-2 border-dashed border-slate-300 dark:border-slate-800 rounded-3xl p-16 flex flex-col items-center justify-center text-center gap-4 min-h-[380px] shadow-sm relative overflow-hidden">
                    <!-- Background aura subtle matching main theme #D65A20 -->
                    <div class="absolute w-64 h-64 bg-orange-100/30 dark:bg-orange-950/10 rounded-full filter blur-3xl -top-20 -left-20"></div>
                    <div class="absolute w-64 h-64 bg-orange-100/20 dark:bg-orange-950/5 rounded-full filter blur-3xl -bottom-20 -right-20"></div>
                    
                    <div class="flex justify-center items-center w-full p-4 z-10">
                        <video autoplay loop muted playsinline class="w-full max-w-[320px] h-auto object-contain asset-maskot">
                            <source src="{{ asset('assets/maskot/maskot_dashboard.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <!-- Right Panel (Card Log Version) -->
            <div class="lg:col-span-1">
                <!-- 5. Card Log Version -->
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-6 rounded-3xl shadow-sm card-hover-transition h-full flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                            <i class="fa-regular fa-code-branch text-[#D65A20] text-xl"></i>
                            Log Version:
                        </h3>
                        <div class="relative pl-6 border-l border-slate-200 dark:border-slate-800 space-y-6">
                            <!-- Timeline Item 1 -->
                            <div class="relative">
                                <span class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#D65A20] border-2 border-white dark:border-slate-900 shadow-sm"></span>
                                <span class="text-xs font-bold text-[#D65A20] block mb-1">01-06-2026 10:57</span>
                                <ul class="space-y-1.5 text-xs font-semibold text-slate-600 dark:text-slate-400 pl-1 list-disc list-inside">
                                    <li>Fitur Baru: Aktifkan Akun E-learning Siswa</li>
                                    <li>Fitur Baru: Penguncian tugas otomatis aktif</li>
                                </ul>
                            </div>
                            
                            <!-- Timeline Item 2 -->
                            <div class="relative">
                                <span class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-slate-350 dark:bg-slate-700 border-2 border-white dark:border-slate-900 shadow-sm"></span>
                                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 block mb-1">10-05-2026 15:42</span>
                                <ul class="space-y-1.5 text-xs font-semibold text-slate-600 dark:text-slate-400 pl-1 list-disc list-inside">
                                    <li>Fitur Angket: Wajib mengisi evaluasi guru</li>
                                </ul>
                            </div>

                            <!-- Timeline Item 3 -->
                            <div class="relative">
                                <span class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-slate-350 dark:bg-slate-700 border-2 border-white dark:border-slate-900 shadow-sm"></span>
                                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 block mb-1">08-01-2026 22:40</span>
                                <ul class="space-y-1.5 text-xs font-semibold text-slate-600 dark:text-slate-400 pl-1 list-disc list-inside">
                                    <li>Update: Sinkronisasi nilai dari sistem pusat</li>
                                    <li>Perbaikan: Notifikasi batas waktu pengumpulan</li>
                                </ul>
                            </div>

                            <!-- Timeline Item 4 -->
                            <div class="relative">
                                <span class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-slate-350 dark:bg-slate-700 border-2 border-white dark:border-slate-900 shadow-sm"></span>
                                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 block mb-1">11-07-2025 13:17</span>
                                <ul class="space-y-1.5 text-xs font-semibold text-slate-600 dark:text-slate-400 pl-1 list-disc list-inside">
                                    <li>Update fitur publikasi tugas / laporan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @elseif(auth()->user()->isTeacher())
    @php
        $teacherId = auth()->user()->teacher_id;
        $kelasDiampu = $mySubjects->pluck('classRoom.name')->filter()->unique()->count();
        $menungguKoreksiCount = \App\Models\Pengumpulan::where('status', 'terkumpul')
            ->whereHas('assignment', function($q) use ($teacherId) {
                $q->where('guru_id', $teacherId);
            })->count();
        $bandingAktifCount = \App\Models\Banding::where('status', 'ditinjau')
            ->whereHas('assignment', function($q) use ($teacherId) {
                $q->where('guru_id', $teacherId);
            })->count();

        // Item B: Tugas Harian Aljabar (ungraded submissions assignment)
        $uncompletedGrading = \App\Models\Tugas::where('guru_id', $teacherId)
            ->whereHas('submissions', function($q) {
                $q->where('status', 'terkumpul');
            })->withCount(['submissions' => function($q) {
                $q->where('status', 'terkumpul');
            }])->orderBy('submissions_count', 'desc')->first();

        // Item C: Evaluasi Kompetensi (tugas that has 0 submissions or standard create task)
        $noSubmissionTask = \App\Models\Tugas::where('guru_id', $teacherId)
            ->whereDoesntHave('submissions')
            ->first();
    @endphp

    <!-- Dashboard Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="page-title text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Selamat Pagi</h1>
            <p class="page-subtitle text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Pantau aktivitas pengumpulan tugas dan pengajuan banding siswa hari ini.</p>
        </div>
        <div class="flex items-center gap-3 bg-white dark:bg-slate-900 px-4 py-2.5 rounded-2xl border border-slate-100/80 dark:border-slate-800 shadow-sm">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">Sistem Online & Stabil</span>
        </div>
    </div>

    <!-- Statistik Ringkas (3 Card) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 stagger">
        <!-- Card 1: Kelas Diampu -->
        <div class="stat-card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-5 flex items-center justify-between">
            <div>
                <p class="stat-label text-slate-400 font-bold uppercase tracking-wider text-xs">Kelas Diampu</p>
                <p class="stat-value text-slate-800 dark:text-white text-2xl font-bold mt-1">{{ $kelasDiampuCount }} Kelas</p>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400">
                <i class="fas fa-school text-lg"></i>
            </div>
        </div>

        <!-- Card 2: Menunggu Koreksi -->
        <div class="stat-card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-5 flex items-center justify-between">
            <div>
                <p class="stat-label text-slate-400 font-bold uppercase tracking-wider text-xs">Menunggu Koreksi</p>
                <p class="stat-value text-slate-800 dark:text-white text-2xl font-bold mt-1">{{ $menungguKoreksiCount }} Berkas</p>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-rose-50 text-rose-600 dark:bg-rose-950/20 dark:text-rose-400">
                <i class="fas fa-file-signature text-lg"></i>
            </div>
        </div>

        <!-- Card 3: Banding (SSL) Aktif -->
        <div class="stat-card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-5 flex items-center justify-between">
            <div>
                <p class="stat-label text-slate-400 font-bold uppercase tracking-wider text-xs">Banding (SSL) Aktif</p>
                <p class="stat-value text-slate-800 dark:text-white text-2xl font-bold mt-1">{{ $bandingAktifCount }} Pengajuan</p>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-orange-50 text-[#D65A20] dark:bg-orange-950/20 dark:text-orange-400">
                <i class="fas fa-file-shield text-lg"></i>
            </div>
        </div>
    </div>

    <!-- Layout Dua Kolom -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Kolom Kiri (Lebih Lebar) -->
        <div class="xl:col-span-2 card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Progres Pengumpulan Tugas Aktif</h3>
                        <p class="text-xs text-slate-500 mt-1">Daftar tugas yang sedang berjalan dan pengumpulan siswa.</p>
                    </div>
                    <a href="{{ route('assignments.index') }}" class="btn btn-secondary text-xs">Lihat Semua</a>
                </div>

                <div class="mt-6 space-y-5">
                    @forelse($upcomingAssignments as $assignment)
                        @php
                            $isOverdue = $assignment->deadline->isPast();
                            $totalStudentsInClass = $assignment->subject->classRoom ? $assignment->subject->classRoom->students()->count() : 0;
                            $submittedCount = $assignment->submissions->count();
                            $percentage = $totalStudentsInClass > 0 ? min(100, round(($submittedCount / $totalStudentsInClass) * 100)) : 0;
                            
                            if ($isOverdue) {
                                $barColor = 'bg-rose-500';
                                $textColor = 'text-rose-600';
                                $badgeColor = 'bg-rose-50 text-rose-700 border border-rose-100';
                                $statusText = 'Tenggat Terlewati';
                            } elseif ($percentage >= 80) {
                                $barColor = 'bg-emerald-500';
                                $textColor = 'text-emerald-600';
                                $badgeColor = 'bg-emerald-50 text-emerald-700 border border-emerald-100';
                                $statusText = 'Hampir Selesai';
                            } else {
                                $barColor = 'bg-amber-500';
                                $textColor = 'text-amber-600';
                                $badgeColor = 'bg-amber-50 text-amber-700 border border-amber-100';
                                $statusText = 'Sedang Berjalan';
                            }
                        @endphp
                        <div class="p-4 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-slate-100 text-[15px]">{{ $assignment->judul }}</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        <i class="fas fa-school mr-1.5"></i>{{ $assignment->subject->classRoom->name ?? 'N/A' }} 
                                        <span class="mx-2">•</span> 
                                        <i class="fas fa-clock mr-1.5"></i>Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="badge {{ $badgeColor }} text-[10px] px-2 py-0.5 font-bold uppercase tracking-wider">{{ $statusText }}</span>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $submittedCount }}/{{ $totalStudentsInClass }} Siswa</span>
                                </div>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="w-full bg-slate-200 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                <div class="h-full {{ $barColor }} transition-all duration-500" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-[11px] font-semibold text-slate-400">Tingkat Pengumpulan</span>
                                <span class="text-[11px] font-extrabold {{ $textColor }}">{{ $percentage }}%</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8 text-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                                <i class="fas fa-clipboard-list text-lg"></i>
                            </div>
                            <p class="text-sm font-semibold text-slate-500">Tidak ada pengumpulan tugas aktif saat ini.</p>
                            <a href="{{ route('assignments.create') }}" class="btn btn-primary text-xs mt-1">Buat Tugas Baru</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kolom Kanan (Perlu Tindakan) -->
        <div class="xl:col-span-1 card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div>
                <div class="pb-4 border-b border-slate-100 dark:border-slate-800 mb-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Perlu Tindakan</h3>
                    <p class="text-xs text-slate-500 mt-1">Aktivitas mendesak yang butuh perhatian Anda.</p>
                </div>

                <div class="space-y-6">
                    <!-- Tindakan A: Permohonan Banding -->
                    <div class="p-4 rounded-xl border border-orange-100/50 bg-orange-50/20 dark:border-orange-950/20 dark:bg-orange-950/10 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-orange-100 text-[#D65A20] dark:bg-orange-950 dark:text-orange-400 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-shield"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ $bandingAktifCount }} Permohonan Banding</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">Siswa mengajukan banding pembukaan kunci tugas.</p>
                            </div>
                        </div>
                        <a href="{{ route('appeals.index') }}" class="text-xs font-extrabold text-[#D65A20] hover:text-orange-700 transition flex items-center gap-1.5 self-end">
                            Tinjau Sekarang <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                    <!-- Tindakan B: Berkas Tugas Menunggu Koreksi -->
                    @if($uncompletedGrading)
                    <div class="p-4 rounded-xl border border-rose-100/50 bg-rose-50/20 dark:border-rose-950/20 dark:bg-rose-950/10 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-rose-100 text-rose-600 dark:bg-rose-950 dark:text-rose-400 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate max-w-[180px] md:max-w-none">{{ $uncompletedGrading->judul }}</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ $uncompletedGrading->submissions_count }} berkas tugas terkumpul</p>
                            </div>
                        </div>
                        <a href="{{ route('assignments.show', $uncompletedGrading->id) }}" class="text-xs font-extrabold text-rose-600 hover:text-rose-700 transition flex items-center gap-1.5 self-end">
                            Mulai Koreksi <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                    @else
                    <div class="p-4 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">Koreksi Selesai</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">Semua berkas terkumpul sudah dinilai.</p>
                            </div>
                        </div>
                        <a href="{{ route('assignments.index') }}" class="text-xs font-extrabold text-slate-500 hover:text-slate-600 transition flex items-center gap-1.5 self-end">
                            Lihat Penugasan <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                    @endif

                    <!-- Tindakan C: Tugas Baru / Siapkan Tugas -->
                    @if($noSubmissionTask)
                    <div class="p-4 rounded-xl border border-sky-100/50 bg-sky-50/20 dark:border-sky-950/20 dark:bg-sky-950/10 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-sky-100 text-sky-600 dark:bg-sky-950 dark:text-sky-400 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clipboard-question"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate max-w-[180px] md:max-w-none">{{ $noSubmissionTask->judul }}</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">Mempersiapkan evaluasi atau instruksi tambahan.</p>
                            </div>
                        </div>
                        <a href="{{ route('assignments.edit', $noSubmissionTask->id) }}" class="text-xs font-extrabold text-sky-600 hover:text-sky-700 transition flex items-center gap-1.5 self-end">
                            Siapkan Tugas <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                    @else
                    <div class="p-4 rounded-xl border border-sky-100/50 bg-sky-50/20 dark:border-sky-950/20 dark:bg-sky-950/10 flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-sky-100 text-sky-600 dark:bg-sky-950 dark:text-sky-400 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clipboard-question"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">Evaluasi Kompetensi</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">Mempersiapkan bahan tugas atau ujian susulan.</p>
                            </div>
                        </div>
                        <a href="{{ route('assignments.create') }}" class="text-xs font-extrabold text-sky-600 hover:text-sky-700 transition flex items-center gap-1.5 self-end">
                            Siapkan Tugas <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @else
        <!-- Administrator Dashboard -->
        <div class="space-y-8 animate-fade-in">
            <!-- Title & Welcome -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Dashboard</h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-1.5 font-medium">Selamat datang kembali, Administrator</p>
                </div>
                <div class="flex items-center gap-3 bg-white dark:bg-slate-900 px-4 py-2.5 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">Sistem Online & Stabil</span>
                </div>
            </div>

            <!-- KPI Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- Siswa Card -->
                <a href="{{ route('students.index') }}" class="stat-card hover:border-blue-500 border-l-4 border-l-blue-500 transition duration-200">
                    <div>
                        <p class="stat-label">Total Siswa</p>
                        <p class="stat-value text-blue-600 dark:text-blue-400">{{ number_format($totalStudents ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400 mt-1 font-medium">Klik untuk kelola data</p>
                    </div>
                    <div class="stat-icon bg-blue-50 text-blue-600 dark:bg-blue-950/30 dark:text-blue-400">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </a>

                <!-- Guru Card -->
                <a href="{{ route('teachers.index') }}" class="stat-card hover:border-emerald-500 border-l-4 border-l-emerald-500 transition duration-200">
                    <div>
                        <p class="stat-label">Total Guru</p>
                        <p class="stat-value text-emerald-600 dark:text-emerald-400">{{ number_format($totalTeachers ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400 mt-1 font-medium">Tenaga Pengajar Aktif</p>
                    </div>
                    <div class="stat-icon bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </a>

                <!-- Kelas Card -->
                <a href="{{ route('classrooms.index') }}" class="stat-card hover:border-rose-500 border-l-4 border-l-rose-500 transition duration-200">
                    <div>
                        <p class="stat-label">Total Kelas</p>
                        <p class="stat-value text-rose-600 dark:text-rose-400">{{ number_format($totalClasses ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400 mt-1 font-medium">Ruang Kelas Aktif</p>
                    </div>
                    <div class="stat-icon bg-rose-50 text-rose-600 dark:bg-rose-950/30 dark:text-rose-400">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                </a>

                <!-- Mapel Card -->
                <a href="{{ route('subjects.index') }}" class="stat-card hover:border-amber-500 border-l-4 border-l-amber-500 transition duration-200">
                    <div>
                        <p class="stat-label">Mata Pelajaran</p>
                        <p class="stat-value text-amber-600 dark:text-amber-400">{{ number_format($totalSubjects ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400 mt-1 font-medium">Kurikulum SMANSAGO</p>
                    </div>
                    <div class="stat-icon bg-amber-50 text-amber-600 dark:bg-amber-950/30 dark:text-amber-400">
                        <i class="fas fa-book-open"></i>
                    </div>
                </a>

                <!-- Admin Card -->
                <a href="{{ route('admin.accounts') }}" class="stat-card hover:border-violet-500 border-l-4 border-l-violet-500 transition duration-200">
                    <div>
                        <p class="stat-label">Total Admin</p>
                        <p class="stat-value text-violet-600 dark:text-violet-400">{{ number_format($totalAdmins ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400 mt-1 font-medium">Pengelola Sistem</p>
                    </div>
                    <div class="stat-icon bg-violet-50 text-violet-600 dark:bg-violet-950/30 dark:text-violet-400">
                        <i class="fas fa-users-gear"></i>
                    </div>
                </a>
            </div>

            <!-- Graph and Activity Row -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Column: Aktivitas Terbaru -->
                <div class="lg:col-span-5 card p-0 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aktivitas Terbaru</h3>
                            <p class="text-xs text-slate-500 mt-1">Log audit sistem dan penugasan waktu nyata</p>
                        </div>
                        <div class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach(($recentActivities ?? []) as $activity)
                            <div class="p-4 flex items-start gap-3.5 hover:bg-slate-50 dark:hover:bg-slate-900/40 transition">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700">
                                    <i class="fas {{ $activity->icon ?? 'fa-info-circle' }} text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[13.5px] font-semibold text-slate-800 dark:text-white leading-tight mb-1">{{ $activity->title }}</p>
                                    <span class="text-[11px] text-slate-400 dark:text-slate-500 font-medium font-mono">
                                        {{ is_string($activity->time) ? $activity->time : \Carbon\Carbon::parse($activity->time)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800 flex justify-center">
                        <a href="{{ route('permissions.index') }}" class="text-xs font-bold text-orange-500 hover:text-orange-600 transition flex items-center gap-1.5">
                            <i class="fas fa-list-check"></i> Lihat Semua Log
                        </a>
                    </div>
                </div>

                <!-- Right Column: User activity chart -->
                <div class="lg:col-span-7 card flex flex-col justify-between">
                    <div class="p-2">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Statistik Pengguna</h3>
                                <p class="text-xs text-slate-500 mt-1">Tingkat keaktifan interaksi harian</p>
                            </div>
                            <!-- Timeframe selector -->
                            <div class="flex items-center bg-slate-100 dark:bg-slate-800 p-1 rounded-xl w-fit">
                                <button onclick="updateChartRange('7d', this)" class="chart-range-btn px-3 py-1 rounded-lg text-xs font-bold bg-orange-500 text-white shadow-sm transition">7 Hari</button>
                                <button onclick="updateChartRange('30d', this)" class="chart-range-btn px-3 py-1 rounded-lg text-xs font-bold text-slate-600 dark:text-slate-300 hover:text-slate-800 transition">30 Hari</button>
                                <button onclick="updateChartRange('3m', this)" class="chart-range-btn px-3 py-1 rounded-lg text-xs font-bold text-slate-600 dark:text-slate-300 hover:text-slate-800 transition">3 Bulan</button>
                                <button onclick="updateChartRange('1y', this)" class="chart-range-btn px-3 py-1 rounded-lg text-xs font-bold text-slate-600 dark:text-slate-300 hover:text-slate-800 transition">1 Tahun</button>
                            </div>
                        </div>
                        <div class="relative w-full h-72">
                            <canvas id="userStatsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('userStatsChart');
    if (ctx) {
        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Siswa Aktif',
                    data: [120, 150, 180, 190, 160, 90, 105],
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Guru Aktif',
                    data: [25, 30, 28, 35, 32, 12, 15],
                    borderColor: '#0f766e',
                    backgroundColor: 'rgba(15, 118, 110, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 12
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(226, 232, 240, 0.5)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Function to update chart data (dummy interaction for high fidelity)
        window.updateChartRange = function(range, element) {
            // Remove active classes
            document.querySelectorAll('.chart-range-btn').forEach(btn => {
                btn.classList.remove('bg-orange-500', 'text-white', 'shadow-sm');
                btn.classList.add('text-slate-600', 'dark:text-slate-300', 'hover:text-slate-800');
            });
            // Add active class to clicked
            element.classList.remove('text-slate-600', 'dark:text-slate-300', 'hover:text-slate-800');
            element.classList.add('bg-orange-500', 'text-white', 'shadow-sm');

            let data1, data2, labels;
            if (range === '7d') {
                labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                data1 = [120, 150, 180, 190, 160, 90, 105];
                data2 = [25, 30, 28, 35, 32, 12, 15];
            } else if (range === '30d') {
                labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                data1 = [450, 520, 480, 610];
                data2 = [85, 90, 88, 95];
            } else if (range === '3m') {
                labels = ['Maret', 'April', 'Mei'];
                data1 = [1200, 1400, 1650];
                data2 = [180, 210, 245];
            } else {
                labels = ['2023', '2024', '2025', '2026'];
                data1 = [2500, 3100, 4200, 4800];
                data2 = [450, 520, 680, 750];
            }

            chart.data.labels = labels;
            chart.data.datasets[0].data = data1;
            chart.data.datasets[1].data = data2;
            chart.update();
        };
    }
});
</script>
@endpush


