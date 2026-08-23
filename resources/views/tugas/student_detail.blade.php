@extends('layouts.app')

@section('title', 'Tugas - ' . ($subject->course->name ?? $subject->nama ?? ''))

@section('content')
<div class="tugas-student-wrapper" x-data="studentDetailModals()" @keydown.escape.window="closeSubmitModal()">
    
    {{-- Modern Notification Modal --}}
    <x-notification-modal />

    @if(session('success'))
    <div class="tugas-alert tugas-alert--success">
        <div class="tugas-alert__icon"><i class="fas fa-check-circle"></i></div>
        <span class="tugas-alert__text">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="tugas-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif

    {{-- Back Button + Header --}}
    <div class="tugas-detail-header">
        <a href="{{ route('assignments.index') }}" class="tugas-back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Mapel
        </a>
        <div class="tugas-detail-header__info">
            <h1 class="tugas-detail-header__title">{{ $subject->course->name ?? $subject->nama ?? '' }}</h1>
            <div class="tugas-detail-header__meta">
                <span><i class="fas fa-user-tie"></i> Guru Pengampu: <strong>{{ $subject->teacher->name ?? '-' }}</strong></span>
                <span class="tugas-detail-header__sep">•</span>
                <span><i class="fas fa-school"></i> Kelas: <strong>{{ $subject->classRoom->name ?? (auth()->user()->student?->resolved_kelas ?? '-') }}</strong></span>
            </div>
        </div>
    </div>

    {{-- Alert: Recovery Mode Active --}}
    @if($recovery)
    <div class="tugas-alert tugas-alert--recovery">
        <div class="tugas-alert__icon"><i class="fas fa-sync-alt fa-spin"></i></div>
        <div class="tugas-alert__text">
            <strong>Mode Pemulihan Aktif:</strong> Selesaikan tugas yang dibuka untuk membuka tugas berikutnya secara bertahap.
            <div class="tugas-alert__timer">
                <i class="fas fa-clock"></i> Sisa waktu pemulihan: 
                <span id="recovery-timer" data-expiry="{{ $recovery->expired_at->toIso8601String() }}">Menghitung...</span>
            </div>
        </div>
    </div>
    @endif

    {{-- Alert: Locked due to overdue tasks (and not in recovery) --}}
    @if(isset($accessResult) && $accessResult->isLocked())
    <div x-show="showLockBanner" x-cloak class="tugas-lock-banner" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="tugas-lock-banner__left">
            <div class="tugas-lock-banner__icon-box">
                <i class="fas fa-lock"></i>
            </div>
            <div>
                <h3 class="tugas-lock-banner__title">Akses Pengumpulan Mata Pelajaran Dikunci</h3>
                <p class="tugas-lock-banner__desc">Anda memiliki {{ $accessResult->jumlahTunggakan }} tunggakan tugas (batas toleransi {{ $accessResult->threshold }} tunggakan). Anda tetap dapat mengakses materi.</p>
            </div>
        </div>
        @if($accessResult->appealStatus === 'PENDING')
            <span class="tugas-lock-banner__status">(Banding Anda sedang ditinjau)</span>
        @elseif($accessResult->canAppeal)
            <button type="button" @click="openAppealModal()" class="tugas-lock-banner__btn">
                Ajukan Banding (SSL) <i class="fas fa-chevron-right" style="font-size:10px"></i>
            </button>
        @endif
    </div>
    @elseif(isset($accessResult) && $accessResult->isWarning())
    <div class="tugas-alert tugas-alert--warning" style="background:#fffbeb; border:1px solid #fef3c7; color:#b45309">
        <div class="tugas-alert__icon" style="background:#fef3c7; color:#d97706"><i class="fas fa-exclamation-triangle"></i></div>
        <div class="tugas-alert__text">
            <strong>Peringatan Keterlambatan:</strong> Anda memiliki {{ $accessResult->jumlahTunggakan }} tunggakan tugas. Pengumpulan masih diizinkan sebelum mencapai batas penguncian ({{ $accessResult->threshold }} tugas).
        </div>
    </div>
    @endif

    {{-- Table --}}
    <div class="tugas-card">
        <div class="tugas-table-wrap">
            <table class="tugas-table" id="detailTable">
                <thead>
                    <tr>
                        <th class="tugas-th" style="width:50px">NO</th>
                        <th class="tugas-th" style="width:90px">KODE</th>
                        <th class="tugas-th">DETAIL TUGAS</th>
                        <th class="tugas-th">TANGGAL & WAKTU</th>
                        <th class="tugas-th" style="text-align:center">STATUS</th>
                        <th class="tugas-th">SOAL & INFORMASI</th>
                        <th class="tugas-th" style="text-align:center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $i => $assignment)
                    @php
                        $mySub = $assignment->submissions->where('student_id', auth()->user()->student_id)->first();
                        $isPassed = $assignment->due_date ? $assignment->due_date->isPast() : false;
                        
                        $isLocked = false;
                        $isCurrentRecovery = false;
                        $prereqNotCompleted = $assignment->prasyarat_materi_id && !in_array($assignment->prasyarat_materi_id, $completedMaterialIds);

                        if ($recovery) {
                            if (!$mySub) {
                                if ($assignment->id == $recovery->current_assignment_id) {
                                    $isLocked = false;
                                    $isCurrentRecovery = true;
                                } else {
                                    $isLocked = true;
                                }
                            }
                        } else {
                            if (!$mySub) {
                                if ($isPassed) {
                                    $isLocked = true;
                                } elseif ($tunggakanIds->count() >= 3) {
                                    $isLocked = true;
                                } elseif ($prereqNotCompleted) {
                                    $isLocked = true;
                                }
                            }
                        }
                    @endphp
                    <tr class="tugas-tr {{ $isLocked ? 'tugas-tr--locked' : '' }}">
                        <td class="tugas-td tugas-td--num">{{ $i + 1 }}</td>
                        <td class="tugas-td">
                            <span class="tugas-code-badge">TGS-{{ str_pad($assignment->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="tugas-td">
                            <div class="tugas-detail-cell">
                                <span class="tugas-detail-cell__title">{{ $assignment->title }}</span>
                                <span class="tugas-detail-cell__desc">{{ Str::limit(strip_tags($assignment->description), 50) }}</span>
                            </div>
                        </td>
                        <td class="tugas-td">
                            <div class="tugas-date-cell">
                                <span class="tugas-date-cell__date {{ $isPassed ? 'tugas-date-cell--overdue' : '' }}">
                                    {{ $assignment->due_date ? $assignment->due_date->format('d M Y, H:i') : '-' }}
                                </span>
                                @if(!$isPassed && $assignment->due_date)
                                <span class="tugas-date-cell__remaining">{{ $assignment->due_date->diffForHumans() }}</span>
                                @else
                                <span class="tugas-date-cell__remaining tugas-date-cell--overdue">Batas waktu telah lewat</span>
                                @endif
                            </div>
                        </td>
                        <td class="tugas-td tugas-td--center">
                            @if($mySub && $mySub->is_needs_revision)
                                <span class="tugas-status-badge" style="background:#fee2e2; color:#991b1b; border:1px solid #fecaca" title="Jawaban di-return oleh guru: {{ $mySub->alasan_pengembalian }}">
                                    <i class="fas fa-undo-alt"></i> Return Jawaban
                                </span>
                            @elseif($mySub)
                                <span class="tugas-status-badge tugas-status-badge--success">
                                    <i class="fas fa-check-circle"></i> Terkumpul
                                </span>
                            @elseif($isCurrentRecovery)
                                <span class="tugas-status-badge tugas-status-badge--active">
                                    <i class="fas fa-unlock"></i> Sedang Dibuka
                                </span>
                            @elseif($recovery && $isPassed && !$isCurrentRecovery)
                                <span class="tugas-status-badge tugas-status-badge--wait">
                                    <i class="fas fa-hourglass-half"></i> Menunggu
                                </span>
                            @elseif($prereqNotCompleted)
                                <span class="tugas-status-badge tugas-status-badge--locked bg-rose-50 text-rose-700 border border-rose-100 dark:bg-rose-950/20 dark:text-rose-400 dark:border-rose-900/50" title="Belum membaca materi prasyarat">
                                    <i class="fas fa-lock"></i> Prasyarat
                                </span>
                            @elseif($isLocked)
                                <span class="tugas-status-badge tugas-status-badge--locked">
                                    <i class="fas fa-lock"></i> Locked
                                </span>
                            @elseif($isPassed)
                                <span class="tugas-status-badge tugas-status-badge--danger">
                                    <i class="fas fa-times-circle"></i> Terlewat
                                </span>
                            @else
                                <span class="tugas-status-badge tugas-status-badge--warning">
                                    <i class="fas fa-clock"></i> Belum
                                </span>
                            @endif
                        </td>
                        <td class="tugas-td">
                            <div class="tugas-info-actions">
                                @if($assignment->attachment)
                                    @if($assignment->is_attachment_url)
                                    <a href="{{ $assignment->attachment_url }}" target="_blank" rel="noopener noreferrer" class="tugas-info-btn text-rose-600 dark:text-rose-400" title="Tonton Video Instruksi Guru">
                                        <i class="fab fa-youtube"></i> Video
                                    </a>
                                    @elseif($assignment->is_attachment_video)
                                    <a href="{{ $assignment->attachment_url }}" target="_blank" class="tugas-info-btn text-rose-600 dark:text-rose-400" title="Tonton / Download Video Instruksi Guru">
                                        <i class="fas fa-play-circle"></i> Video
                                    </a>
                                    @elseif($assignment->is_attachment_image || ($assignment->isVisual() && !$assignment->is_attachment_pdf))
                                    <button type="button" @click="openQuickVisual('{{ $assignment->preview_url }}', '{{ addslashes($assignment->title) }}', '{{ addslashes(basename($assignment->attachment)) }}')" class="tugas-info-btn text-purple-600 dark:text-purple-400" title="Pratinjau Gambar Acuan Guru">
                                        <i class="fas fa-image"></i> Gambar
                                    </button>
                                    @else
                                    <a href="{{ $assignment->attachment_url }}" target="_blank" class="tugas-info-btn" title="Download Soal">
                                        <i class="fas fa-download"></i> Soal
                                    </a>
                                    @endif
                                @endif
                                <a href="{{ route('assignments.show', $assignment) }}" class="tugas-info-btn" title="Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        </td>
                        <td class="tugas-td tugas-td--center">
                            @if($mySub && $mySub->is_needs_revision)
                                <button type="button"
                                    @click="startVerification({{ $assignment->id }}, {{ json_encode($assignment->title) }}, {{ json_encode($assignment->description) }}, '{{ $assignment->due_date ? $assignment->due_date->format('d M Y, H:i') : '-' }} WIB', {{ json_encode($mySub->alasan_pengembalian ?? '') }}, '{{ $assignment->tipe_pengumpulan ?? 'dokumen' }}', '{{ $assignment->mode_audiovisual ?? 'either' }}')"
                                    class="tugas-btn-revision" title="Upload Jawaban Baru">
                                    <i class="fas fa-undo-alt"></i> Upload Ulang
                                </button>
                            @elseif($mySub)
                                <button type="button"
                                    @click="openSubmittedModal({{ $assignment->id }}, {{ json_encode($assignment->title) }}, {{ json_encode($mySub) }}, {{ json_encode($assignment->description) }}, '{{ $assignment->due_date ? $assignment->due_date->format('d M Y, H:i') : '-' }} WIB', '{{ $assignment->tipe_pengumpulan ?? 'dokumen' }}', '{{ $assignment->mode_audiovisual ?? 'either' }}')"
                                    class="tugas-submitted-btn" title="Lihat Pengumpulan">
                                    <i class="fas fa-check-circle"></i> Terkumpul
                                </button>
                            @else
                                <button type="button"
                                    @click="startVerification({{ $assignment->id }}, {{ json_encode($assignment->title) }}, {{ json_encode($assignment->description) }}, '{{ $assignment->due_date ? $assignment->due_date->format('d M Y, H:i') : '-' }} WIB', '', '{{ $assignment->tipe_pengumpulan ?? 'dokumen' }}', '{{ $assignment->mode_audiovisual ?? 'either' }}')"
                                    class="tugas-btn-submit" title="Upload Tugas">
                                    <i class="fas fa-cloud-upload-alt"></i> Upload Tugas
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="tugas-td tugas-td--empty">
                            <div class="tugas-empty-state">
                                <div class="tugas-empty-state__icon"><i class="fas fa-clipboard-list"></i></div>
                                <p class="tugas-empty-state__title">Belum ada tugas</p>
                                <p class="tugas-empty-state__desc">Guru belum memberikan tugas untuk mata pelajaran ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Interactive Verification & Submit Modal (DFD Step 3 -> 4 -> 5) --}}
    <div x-show="openSubmit" x-cloak class="tugas-modal-overlay" role="dialog" aria-modal="true">
        <div class="tugas-modal-backdrop" x-show="openSubmit" x-transition.opacity @click="closeSubmitModal()"></div>
        <div class="tugas-modal-panel" x-show="openSubmit"
             x-transition:enter="transition duration-200 ease-out"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition duration-150 ease-in"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
             @click.outside="closeSubmitModal()">

            <div class="tugas-modal-content">
                {{-- Header --}}
                <div class="tugas-modal-header" :class="{
                    'bg-slate-50/90 dark:bg-slate-850 border-b border-slate-200/80 dark:border-slate-800': verifyState === 'locked_by_returned',
                    'bg-red-500/10 border-b border-red-200 dark:border-red-900/50': verifyState === 'locked_overdue',
                    'bg-emerald-500/10 border-b border-emerald-200 dark:border-emerald-900/50': verifyState === 'passed',
                }">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold border transition-colors"
                            :class="{
                                'bg-orange-50 text-[#D65A20] border-orange-200/70 dark:bg-orange-950/60 dark:text-orange-400 dark:border-orange-800': verifyState === 'locked_by_returned',
                                'bg-red-100 text-red-600 border-red-300 dark:bg-rose-950/60 dark:text-rose-400 dark:border-rose-800': verifyState === 'locked_overdue',
                                'bg-emerald-100 text-emerald-600 border-emerald-300 dark:bg-emerald-950/60 dark:text-emerald-400 dark:border-emerald-800': verifyState === 'passed',
                                'bg-orange-50 text-orange-600 border-orange-200 dark:bg-orange-950/40 dark:text-orange-400 dark:border-orange-800/50': verifyState === 'checking' || verifyState === 'form'
                            }">
                            <i :class="{
                                'fas fa-undo-alt': verifyState === 'locked_by_returned',
                                'fas fa-lock': verifyState === 'locked_overdue',
                                'fas fa-check-circle': verifyState === 'passed',
                                'fas fa-shield-alt': verifyState === 'checking' || verifyState === 'form',
                                'fas fa-book-reader': verifyState === 'locked_prereq',
                                'fas fa-clock': verifyState === 'deadline_passed'
                            }"></i>
                        </div>
                        <div>
                            <h2 class="tugas-modal-header__title" x-text="
                                verifyState === 'locked_by_returned' ? 'Pengembalian Tugas oleh Guru (Perlu Revisi)' :
                                (verifyState === 'locked_overdue' ? 'Akses Terkunci - Sanksi SSL' :
                                (verifyState === 'passed' ? 'Verifikasi Akses Berhasil' : 'Pengumpulan Tugas & Verifikasi SSL'))
                            "></h2>
                            <p class="text-[11px] font-medium -mt-0.5" :class="{
                                'text-orange-600 dark:text-orange-400': verifyState === 'locked_by_returned',
                                'text-red-600 dark:text-rose-400': verifyState === 'locked_overdue',
                                'text-emerald-600 dark:text-emerald-400': verifyState === 'passed',
                                'text-slate-400 dark:text-slate-500': verifyState === 'checking' || verifyState === 'form'
                            }" x-text="
                                verifyState === 'locked_by_returned' ? 'Jalur Mandiri Perbaikan Berkas Jawaban' :
                                (verifyState === 'locked_overdue' ? 'Selective Submission Locking Threshold' : 'Selective Submission Locking')
                            "></p>
                        </div>
                    </div>
                    <button @click="closeSubmitModal()" type="button" class="tugas-modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="tugas-modal-body">

                    {{-- 0. STATE: ACCESS GRANTED / PASSED CONFIRMATION --}}
                    <div x-show="verifyState === 'passed'" x-cloak class="py-8 px-4 flex flex-col items-center text-center space-y-3">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400 flex items-center justify-center text-3xl shadow-xl shadow-emerald-500/20 animate-bounce">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                            Verifikasi Berhasil (Bebas Tunggakan)
                        </span>
                        <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Akses Pengumpulan Tugas Dibuka</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm">
                            Middleware SSL mengonfirmasi riwayat akademik Anda memenuhi syarat. Menyiapkan formulir pengumpulan berkas...
                        </p>
                        <div class="w-24 h-1 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden mt-2">
                            <div class="h-full bg-emerald-500 animate-pulse w-full"></div>
                        </div>
                    </div>

                    {{-- 1. STATE: ANIMATED SCANNING / CHECKING (DFD Step 4 & 5) --}}
                    <div x-show="verifyState === 'checking'" class="py-7 px-4 flex flex-col items-center text-center">
                        
                        {{-- Futuristic Hologram Orbital Scanner --}}
                        <div class="relative w-32 h-32 mb-6 flex items-center justify-center select-none">
                            
                            {{-- Outer Sonar Ripple Rings --}}
                            <div class="absolute inset-0 rounded-full bg-orange-500/10 animate-ripple-wave"></div>
                            <div class="absolute -inset-3 rounded-full bg-orange-500/5 animate-ripple-wave" style="animation-delay: 0.6s;"></div>

                            {{-- Layer 1: Outer HUD Orbit Ring with Tick Marks --}}
                            <div class="absolute -inset-2 rounded-full border border-dashed border-orange-400/50 dark:border-orange-500/40 animate-orbit-slow"></div>

                            {{-- Layer 2: Dual Arc HUD Reticle Ring (Counter-Clockwise) --}}
                            <div class="absolute inset-0.5 rounded-full border-2 border-transparent border-t-orange-500 border-b-amber-400 animate-orbit-reverse"></div>

                            {{-- Layer 3: Tech Viewfinder Corners (Holographic Brackets) --}}
                            <div class="absolute -inset-1 pointer-events-none flex flex-col justify-between p-0.5">
                                <div class="flex justify-between">
                                    <span class="w-2.5 h-2.5 border-t-2 border-l-2 border-orange-500/80 rounded-tl-sm"></span>
                                    <span class="w-2.5 h-2.5 border-t-2 border-r-2 border-orange-500/80 rounded-tr-sm"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="w-2.5 h-2.5 border-b-2 border-l-2 border-orange-500/80 rounded-bl-sm"></span>
                                    <span class="w-2.5 h-2.5 border-b-2 border-r-2 border-orange-500/80 rounded-br-sm"></span>
                                </div>
                            </div>

                            {{-- Layer 4: Orbital Particle Satellites --}}
                            <div class="absolute inset-2 animate-orbit-slow pointer-events-none">
                                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full bg-orange-400 shadow-lg shadow-orange-500/80"></span>
                                <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-amber-400 shadow-lg shadow-amber-500/80"></span>
                            </div>

                            {{-- Layer 5: Glowing Core Holographic Shield with Laser Scanner --}}
                            <div class="relative w-18 h-18 rounded-2xl bg-gradient-to-tr from-[#D65A20] via-orange-500 to-amber-400 text-white flex items-center justify-center text-3xl shadow-2xl shadow-orange-500/35 animate-hologram-glow overflow-hidden border border-white/25">
                                <i class="fas fa-shield-alt z-10 drop-shadow-md"></i>
                                
                                {{-- Laser Sweep Line --}}
                                <div class="absolute inset-x-0 h-1 bg-gradient-to-r from-transparent via-white to-transparent opacity-80 animate-scan-laser shadow-sm shadow-white"></div>
                                {{-- Holographic Shimmer --}}
                                <div class="absolute inset-0 bg-gradient-to-b from-white/20 via-transparent to-black/10 pointer-events-none"></div>
                            </div>
                        </div>

                        {{-- Live Scanning Telemetry Chip --}}
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-[10.5px] font-mono text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-slate-700 shadow-2xs mb-2">
                            <span class="w-2 h-2 rounded-full bg-orange-500 animate-ping"></span>
                            <span>PROTOKOL EVALUASI: <strong class="text-[#D65A20] dark:text-orange-400 tracking-wider" x-text="checkStep === 1 ? 'AUTH_INTEGRITY' : (checkStep === 2 ? 'PREREQUISITE_TREE' : 'SSL_ACCUMULATOR')"></strong></span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-800 dark:text-white mb-1">
                            Memverifikasi Izin Pengumpulan...
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm mb-6">
                            Sistem sedang memproses data integritas dan kepatuhan akademik tugas Anda.
                        </p>

                        {{-- DFD Live Checking Checklist --}}
                        <div class="w-full max-w-md bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 space-y-3 text-left">
                            {{-- Step 1: Middleware Auth --}}
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2.5">
                                    <template x-if="checkStep >= 1">
                                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-[10px] font-bold">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep < 1">
                                        <div class="w-5 h-5 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-[10px]">
                                            <i class="fas fa-circle-notch fa-spin text-orange-500"></i>
                                        </div>
                                    </template>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">1. Inisialisasi Middleware SSL</span>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600" x-show="checkStep >= 1">OK</span>
                            </div>

                            {{-- Step 2: Prereq Check --}}
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2.5">
                                    <template x-if="checkStep >= 2">
                                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-[10px] font-bold">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep === 1">
                                        <div class="w-5 h-5 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px]">
                                            <i class="fas fa-circle-notch fa-spin"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep < 1">
                                        <div class="w-5 h-5 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-[10px]">
                                            <i class="fas fa-circle"></i>
                                        </div>
                                    </template>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">2. Validasi Penuntasan Materi Prasyarat</span>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600" x-show="checkStep >= 2">Selesai</span>
                            </div>

                            {{-- Step 3: Overdue & Revision Check --}}
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2.5">
                                    <template x-if="checkStep >= 3 && verifyPassed">
                                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-[10px] font-bold">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep >= 3 && !verifyPassed && (verifyResult?.type === 'locked_by_returned' || verifyResult?.reason_code === 'LOCKED_BY_RETURNED_TASKS')">
                                        <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-[10px] font-bold animate-pulse">
                                            <i class="fas fa-undo-alt"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep >= 3 && !verifyPassed && verifyResult?.type !== 'locked_by_returned' && verifyResult?.reason_code !== 'LOCKED_BY_RETURNED_TASKS'">
                                        <div class="w-5 h-5 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-[10px] font-bold">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep === 2">
                                        <div class="w-5 h-5 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px]">
                                            <i class="fas fa-circle-notch fa-spin"></i>
                                        </div>
                                    </template>
                                    <template x-if="checkStep < 2">
                                        <div class="w-5 h-5 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-[10px]">
                                            <i class="fas fa-circle"></i>
                                        </div>
                                    </template>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">3. Evaluasi Riwayat & Tunggakan Tugas Mapel</span>
                                </div>
                                <template x-if="checkStep < 3">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-orange-500 animate-pulse">Memeriksa...</span>
                                </template>
                                <template x-if="checkStep >= 3 && verifyPassed">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">Bebas Tunggakan</span>
                                </template>
                                <template x-if="checkStep >= 3 && !verifyPassed && (verifyResult?.type === 'locked_by_returned' || verifyResult?.reason_code === 'LOCKED_BY_RETURNED_TASKS')">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600">Ada Retur Guru</span>
                                </template>
                                <template x-if="checkStep >= 3 && !verifyPassed && verifyResult?.type !== 'locked_by_returned' && verifyResult?.reason_code !== 'LOCKED_BY_RETURNED_TASKS'">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-rose-600">Terkunci SSL</span>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- 2A. STATE: LOCKED BY OVERDUE (SSL STRICT OVERDUE >= 3) --}}
                    <div x-show="verifyState === 'locked_overdue'" x-cloak class="space-y-4 py-2">
                        <div class="flex flex-col items-center text-center p-6 bg-red-50/90 dark:bg-rose-950/25 rounded-2xl border border-red-200 dark:border-rose-900/40">
                            <div class="w-16 h-16 bg-red-600 text-white rounded-2xl flex items-center justify-center mb-3 shadow-xl shadow-red-600/25 animate-bounce">
                                <i class="fas fa-lock text-2xl"></i>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-red-100 text-red-700 dark:bg-rose-900/50 dark:text-rose-300 mb-2">
                                Akses Pengumpulan Terkunci (SSL)
                            </span>
                            <h3 class="text-base font-extrabold text-red-950 dark:text-red-200">Batas Toleransi Keterlambatan Terlampaui</h3>
                            <p class="text-xs text-red-700 dark:text-red-300 mt-2 leading-relaxed max-w-md">
                                Middleware Selective Submission Locking mendeteksi Anda memiliki <strong class="underline font-bold text-red-900 dark:text-red-100" x-text="verifyResult?.tunggakan_count || 3"></strong> tunggakan tugas yang belum dikumpulkan pada mata pelajaran ini (Batas maksimal: 3). Akses pengumpulan tugas baru ditangguhkan sampai Anda mengajukan banding.
                            </p>
                        </div>

                        <div class="flex items-center gap-3 pt-1">
                            <button type="button" @click="closeSubmitModal()" class="flex-1 py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                Tutup
                            </button>
                            <button type="button" @click="openAppealFromLock()" class="flex-1 py-3 px-4 rounded-xl bg-red-600 text-white text-xs font-bold text-center hover:bg-red-700 transition shadow-lg shadow-red-600/20 flex items-center justify-center gap-2">
                                <i class="fas fa-gavel"></i> Ajukan Banding (SSL)
                            </button>
                        </div>
                    </div>

                    {{-- 2B. STATE: LOCKED BY RETURNED TASKS (Tugas Baru Ditangguhkan Karena Ada Tugas Diretur) --}}
                    <div x-show="verifyState === 'locked_by_returned'" x-cloak class="space-y-4 py-1">
                        <div class="p-6 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/90 dark:border-slate-800 shadow-sm text-left">
                            
                            {{-- Header Card --}}
                            <div class="flex items-start gap-4 mb-4 pb-4 border-b border-slate-100 dark:border-slate-800">
                                <div class="w-12 h-12 rounded-2xl bg-orange-50 dark:bg-orange-950/40 text-[#D65A20] dark:text-orange-400 border border-orange-200/70 dark:border-orange-800/50 flex items-center justify-center text-xl shrink-0">
                                    <i class="fas fa-undo-alt"></i>
                                </div>
                                <div class="space-y-1 min-w-0">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10.5px] font-bold bg-orange-50 text-[#D65A20] border border-orange-200 dark:bg-orange-950/50 dark:text-orange-300 dark:border-orange-800/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                        <span>Perbaikan Berkas Diperlukan</span>
                                    </div>
                                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Terdapat Tugas yang Di-Return oleh Guru</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                        Guru telah mengembalikan berkas jawaban Anda pada tugas sebelumnya. Silakan periksa catatan perbaikan di bawah ini.
                                    </p>
                                </div>
                            </div>

                            {{-- Task List (Informative Only) --}}
                            <div class="space-y-2.5" x-show="verifyResult?.returned_tasks && verifyResult?.returned_tasks.length > 0">
                                <div class="flex items-center justify-between text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 px-0.5">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas fa-list-ul text-orange-500"></i>
                                        Daftar Tugas yang Perlu Diperbaiki:
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md bg-orange-50 text-[#D65A20] dark:bg-orange-950/60 dark:text-orange-300 font-bold text-[10px]" x-text="(verifyResult?.returned_tasks?.length || 0) + ' Tugas'"></span>
                                </div>

                                <div class="max-h-56 overflow-y-auto space-y-2.5 pr-1 custom-scrollbar">
                                    <template x-for="(rt, idx) in (verifyResult?.returned_tasks || [])" :key="rt.id">
                                        <div class="p-3.5 bg-slate-50/80 dark:bg-slate-800/40 border border-slate-200/90 dark:border-slate-700/60 rounded-xl space-y-2">
                                            
                                            {{-- Task Title & Meta --}}
                                            <div class="flex items-start justify-between gap-2">
                                                <div class="flex items-start gap-2.5 min-w-0">
                                                    <div class="w-5 h-5 rounded-md bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5" x-text="idx + 1"></div>
                                                    <div>
                                                        <h4 class="font-bold text-xs text-slate-900 dark:text-white" x-text="rt.title"></h4>
                                                        <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5" x-text="'Tenggat: ' + rt.deadline"></p>
                                                    </div>
                                                </div>
                                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300 border border-amber-200/80 dark:border-amber-800/50 shrink-0">
                                                    Perlu Revisi
                                                </span>
                                            </div>

                                            {{-- Teacher Note --}}
                                            <div class="p-2.5 bg-white dark:bg-slate-900/90 rounded-lg border-l-2 border-[#D65A20] text-xs text-slate-600 dark:text-slate-300 shadow-2xs">
                                                <div class="text-[11px] font-bold text-[#D65A20] dark:text-orange-400 flex items-center gap-1.5 mb-0.5">
                                                    <i class="fas fa-comment-dots"></i> Catatan Guru:
                                                </div>
                                                <p class="text-[11.5px] leading-relaxed text-slate-600 dark:text-slate-300 italic pl-1" x-text="rt.alasan"></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            {{-- Friendly Guide Box --}}
                            <div class="mt-4 p-3.5 bg-emerald-50/60 dark:bg-emerald-950/20 border border-emerald-200/80 dark:border-emerald-900/40 rounded-xl flex items-start gap-2.5">
                                <div class="w-5 h-5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-300 flex items-center justify-center text-[10px] shrink-0 mt-0.5 font-bold">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="text-xs space-y-0.5 text-slate-600 dark:text-slate-400">
                                    <strong class="text-emerald-800 dark:text-emerald-300 font-bold">Langkah Mandiri (Tanpa Banding):</strong>
                                    <p class="text-[11px] leading-relaxed">
                                        Anda <strong>tidak perlu mengajukan banding</strong>. Silakan klik tombol di bawah untuk kembali ke tabel tugas, lalu pilih tombol <strong class="text-[#D65A20] dark:text-orange-400">"Upload Ulang"</strong> pada baris tugas yang diretur.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-1">
                            <button type="button" @click="closeSubmitModal()" class="w-full py-3 px-4 rounded-xl bg-[#D65A20] hover:bg-[#b84a17] text-white text-xs font-bold text-center transition shadow-md shadow-orange-600/15 flex items-center justify-center gap-2">
                                <i class="fas fa-arrow-left"></i> Kembali & Perbaiki Tugas di Tabel
                            </button>
                        </div>
                    </div>

                    {{-- 3. STATE: LOCKED BY PREREQUISITE MATERIAL --}}
                    <div x-show="verifyState === 'locked_prereq'" x-cloak class="space-y-6 py-2">
                        <div class="flex flex-col items-center text-center p-6 bg-amber-50 dark:bg-amber-950/20 rounded-2xl border border-amber-200 dark:border-amber-900/40">
                            <div class="w-16 h-16 bg-amber-500 text-white rounded-2xl flex items-center justify-center mb-4 shadow-xl shadow-amber-500/25">
                                <i class="fas fa-book-reader text-2xl"></i>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 mb-2">
                                Prasyarat Belum Selesai
                            </span>
                            <h3 class="text-base font-extrabold text-amber-950 dark:text-amber-300">Wajib Membaca Materi Prasyarat</h3>
                            <p class="text-xs text-amber-800 dark:text-amber-400 mt-2 leading-relaxed max-w-md">
                                Anda harus menyelesaikan materi prasyarat: <strong class="underline font-bold" x-text="verifyResult?.prereq_title"></strong> terlebih dahulu sebelum diizinkan mengumpulkan tugas ini.
                            </p>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="button" @click="closeSubmitModal()" class="flex-1 py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                Tutup
                            </button>
                            <a :href="'/materials/' + (verifyResult?.prereq_material_id || '')" class="flex-1 py-3 px-4 rounded-xl bg-orange-600 text-white text-xs font-bold text-center hover:bg-orange-700 transition shadow-lg shadow-orange-600/20 flex items-center justify-center gap-2">
                                <i class="fas fa-book-open"></i> Pelajari Materi Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- 4. STATE: DEADLINE PASSED (Below threshold < 3) --}}
                    <div x-show="verifyState === 'deadline_passed'" x-cloak class="space-y-6 py-2">
                        <div class="flex flex-col items-center text-center p-6 bg-slate-50 dark:bg-slate-800/40 rounded-2xl border border-slate-200 dark:border-slate-700">
                            <div class="w-16 h-16 bg-slate-400 text-white rounded-2xl flex items-center justify-center mb-4 shadow-md">
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-slate-200 text-slate-700 dark:bg-slate-700 dark:text-slate-300 mb-2">
                                Pengumpulan Ditutup
                            </span>
                            <h3 class="text-base font-extrabold text-slate-800 dark:text-slate-200">Batas Waktu Telah Terlewat</h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed max-w-md">
                                Mohon maaf, pengumpulan tugas ini sudah ditutup karena telah melewati batas waktu deadline.
                            </p>
                            <div class="mt-4 p-3 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/30 rounded-xl text-left w-full max-w-md">
                                <p class="text-[11.5px] text-amber-800 dark:text-amber-400 font-medium">
                                    <i class="fas fa-info-circle mr-1"></i> Anda memiliki <strong x-text="verifyResult?.tunggakan_count || 1"></strong> tugas tertunggak pada mata pelajaran ini. Pengajuan Banding (SSL) hanya dapat diajukan jika jumlah tunggakan telah mencapai batas ambang maksimal (3 tugas).
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="button" @click="closeSubmitModal()" class="w-full py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                Tutup
                            </button>
                        </div>
                    </div>

                    {{-- 5. STATE: RECOVERY MODE LOCKED MISMATCH --}}
                    <div x-show="verifyState === 'recovery_locked'" x-cloak class="space-y-6 py-2">
                        <div class="flex flex-col items-center text-center p-6 bg-blue-50 dark:bg-blue-950/20 rounded-2xl border border-blue-200 dark:border-blue-900/40">
                            <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-4 shadow-xl shadow-blue-600/25">
                                <i class="fas fa-sync-alt text-2xl"></i>
                            </div>
                            <h3 class="text-base font-extrabold text-blue-950 dark:text-blue-300">Anda Berada dalam Mode Pemulihan</h3>
                            <p class="text-xs text-blue-800 dark:text-blue-400 mt-2 leading-relaxed max-w-md">
                                Anda sedang dalam sesi pemulihan aktif. Selesaikan tugas target pemulihan yang sedang dibuka terlebih dahulu.
                            </p>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="button" @click="closeSubmitModal()" class="w-full py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                Tutup
                            </button>
                        </div>
                    </div>

                    {{-- 7. STATE: FORM SUBMISSION (ACTIVE UPLOAD) --}}
                    <div x-show="verifyState === 'form'" x-cloak class="tugas-modal-inner">
                        {{-- Returned Revision Banner inside Modal --}}
                        <template x-if="revisionNote">
                            <div class="p-4 bg-rose-50 dark:bg-rose-950/30 border border-rose-200 dark:border-rose-900/50 rounded-2xl mb-4 text-left">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 dark:bg-rose-900/50 dark:text-rose-300">
                                        <i class="fas fa-undo-alt"></i> Tugas Di-return oleh Guru (Perlu Revisi)
                                    </span>
                                </div>
                                <p class="text-xs text-rose-800 dark:text-rose-300 leading-relaxed">
                                    <strong>Catatan Guru:</strong> <span x-text="revisionNote"></span>
                                </p>
                            </div>
                        </template>

                        {{-- Info Card (Assignment Details) --}}
                        <div class="tugas-info-card" x-show="submitTitle">
                            <div class="tugas-info-card__header">
                                <div class="tugas-info-card__icon-box">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="tugas-info-card__meta">
                                    <h3 class="tugas-info-card__title" x-text="submitTitle"></h3>
                                    <p class="tugas-info-card__deadline">
                                        Tenggat: <span x-text="submitDeadline"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="tugas-info-card__divider"></div>
                            <div class="tugas-info-card__desc" x-html="submitDescription || 'Tidak ada deskripsi.'"></div>
                        </div>

                        {{-- Submission Form --}}
                        <form x-ref="submitFormEl" :action="`/assignments/${submitId}/submit`" method="POST" enctype="multipart/form-data" class="tugas-submit-form" @submit.prevent="submitForm">
                            @csrf

                            {{-- A. Media Visual, Dokumen, Kompresi, Audio Saja (Berkas Fisik) --}}
                            <div x-show="isPhysicalFileMode()" class="tugas-form-group">
                                <label class="tugas-form-label">
                                    <span x-text="getFileFieldLabel()"></span> <span class="text-red-500">*</span>
                                </label>
                                
                                <input type="file" name="file" x-ref="fileInput" class="hidden" @change="handleFileSelect" :accept="getFileAccept()">

                                {{-- Drag & Drop Area --}}
                                <div 
                                    x-show="!file"
                                    @click="$refs.fileInput.click()"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="isDragging = false; handleFileSelect($event)"
                                    class="tugas-redesign-drop"
                                    :class="isDragging ? 'tugas-redesign-drop--dragging' : ''"
                                >
                                    <div class="tugas-redesign-drop__icon"><i class="fas" :class="getFileDropIcon()"></i></div>
                                    <div class="tugas-redesign-drop__text">Pilih berkas atau seret ke sini</div>
                                    <p class="tugas-redesign-drop__hint" x-text="getFileHintText()"></p>
                                </div>

                                {{-- Selected File Info --}}
                                <div x-show="file" x-cloak class="tugas-drive-selected">
                                    <div class="tugas-drive-selected__info">
                                        <i class="fas tugas-drive-selected__icon" :class="fileInfo.icon"></i>
                                        <div>
                                            <p class="tugas-drive-selected__status">Siap Dikirim</p>
                                            <p class="tugas-drive-selected__name" x-text="fileInfo.name"></p>
                                            <p class="text-[10px] text-slate-400" x-text="fileInfo.size"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="tugas-drive-selected__remove" @click="removeFile()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- B. Audiovisual: Mode Either (Segmented Toggle) --}}
                            <div x-show="submitTipePengumpulan === 'audiovisual' && submitModeAudiovisual === 'either'" class="mb-4">
                                <label class="tugas-form-label mb-2">Pilih Metode Pengumpulan <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 p-1 bg-slate-100 dark:bg-slate-800 rounded-xl gap-1">
                                    <button type="button" @click="selectedMethod = 'audio'; submissionUrl = ''; videoPreviewEmbed = '';"
                                        class="py-2.5 px-3 text-xs font-bold rounded-lg transition-all flex items-center justify-center gap-1.5"
                                        :class="selectedMethod === 'audio' ? 'bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 shadow-sm' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'">
                                        <i class="fas fa-microphone text-xs"></i> Rekaman Audio (.mp3)
                                    </button>
                                    <button type="button" @click="selectedMethod = 'video'; removeFile();"
                                        class="py-2.5 px-3 text-xs font-bold rounded-lg transition-all flex items-center justify-center gap-1.5"
                                        :class="selectedMethod === 'video' ? 'bg-white dark:bg-slate-700 text-red-600 dark:text-red-400 shadow-sm' : 'text-slate-500 hover:text-slate-800 dark:hover:text-white'">
                                        <i class="fab fa-youtube text-xs"></i> Tautan Video (YouTube/Drive)
                                    </button>
                                </div>
                            </div>

                            {{-- C. Tautan Video Streaming (YouTube, Google Drive, Loom) --}}
                            <div x-show="isVideoMode()" class="tugas-form-group">
                                <label class="tugas-form-label">Tautan Video Tugas <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="url" name="submission_url" x-model="submissionUrl" @input="onUrlInput()"
                                        placeholder="https://www.youtube.com/watch?v=... atau https://drive.google.com/file/d/..."
                                        class="w-full px-4 py-3 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition pl-10" />
                                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-red-500">
                                        <i class="fab fa-youtube text-sm"></i>
                                    </div>
                                </div>

                                {{-- YouTube Unlisted Privacy Banner --}}
                                <div class="mt-3 p-3 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/30 rounded-xl text-left">
                                    <div class="flex items-start gap-2">
                                        <i class="fas fa-shield-alt text-amber-600 dark:text-amber-400 mt-0.5 text-xs"></i>
                                        <div class="text-[11px] text-amber-800 dark:text-amber-300 leading-relaxed">
                                            <strong>Petunjuk Privasi Video:</strong> Gunakan opsi <strong>Tidak Tercantum (Unlisted)</strong>. Video tidak muncul dalam hasil pencarian, tetapi siapa pun yang memiliki tautannya tetap dapat melihat video.
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-amber-700/80 dark:text-amber-400/80 mt-1 pl-4">
                                        Video berbasis tautan tidak menggunakan ruang penyimpanan media pada server aplikasi.
                                    </p>
                                </div>

                                {{-- Live Video Embed Preview --}}
                                <template x-if="videoPreviewEmbed">
                                    <div class="mt-3 p-3 bg-slate-900 rounded-xl text-center">
                                        <p class="text-[11px] text-slate-300 font-bold mb-2 flex items-center justify-center gap-1.5">
                                            <i class="fas fa-play-circle text-red-500"></i> Pratinjau Video Siswa
                                        </p>
                                        <div class="relative w-full aspect-video rounded-lg overflow-hidden bg-black shadow-inner">
                                            <iframe :src="videoPreviewEmbed" class="w-full h-full"
                                                sandbox="allow-scripts allow-same-origin allow-presentation"
                                                referrerpolicy="strict-origin-when-cross-origin"
                                                allowfullscreen loading="lazy"></iframe>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- D. Tautan Karya Eksternal (Canva, Figma, GitHub, Google Drive/Docs) --}}
                            <div x-show="submitTipePengumpulan === 'tautan'" class="tugas-form-group">
                                <label class="tugas-form-label">Tautan Karya Digital Siswa <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="url" name="submission_url" x-model="submissionUrl" @input="onUrlInput()"
                                        placeholder="https://www.canva.com/design/... atau https://figma.com/... atau https://github.com/..."
                                        class="w-full px-4 py-3 text-xs rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition pl-10" />
                                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500">
                                        <i class="fas fa-link text-sm"></i>
                                    </div>
                                </div>

                                <div class="mt-2.5 flex items-center gap-2 text-[11px] text-slate-500 flex-wrap">
                                    <span>Platform yang didukung:</span>
                                    <span class="px-2 py-0.5 rounded bg-cyan-50 dark:bg-cyan-950/30 text-cyan-600 font-semibold"><i class="fas fa-palette mr-1"></i> Canva</span>
                                    <span class="px-2 py-0.5 rounded bg-purple-50 dark:bg-purple-950/30 text-purple-600 font-semibold"><i class="fab fa-figma mr-1"></i> Figma</span>
                                    <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold"><i class="fab fa-github mr-1"></i> GitHub</span>
                                    <span class="px-2 py-0.5 rounded bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 font-semibold"><i class="fab fa-google-drive mr-1"></i> Google Drive</span>
                                </div>
                            </div>

                            {{-- Notes Textarea --}}
                            <div class="tugas-form-group" style="margin-top: 16px;">
                                <label class="tugas-form-label">Catatan Tambahan (Opsional)</label>
                                <textarea name="content" class="tugas-redesign-textarea" placeholder="Tambahkan pesan untuk guru jika ada..."></textarea>
                            </div>

                            {{-- Uploading Progress --}}
                            <div x-show="uploading" x-cloak class="mb-4" style="margin-top: 16px;">
                                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden mb-1">
                                    <div class="bg-orange-500 h-1.5 rounded-full animate-progress-indefinite"></div>
                                </div>
                                <p class="text-[10px] text-center text-orange-600 font-bold uppercase tracking-wider">Mengirim data tugas...</p>
                            </div>

                            {{-- Modal Footer Buttons --}}
                            <div class="tugas-modal-footer">
                                <button type="button" @click="closeSubmitModal()" class="tugas-btn-batal">Batal</button>
                                <button type="submit" class="tugas-btn-kirim" :disabled="!canSubmitForm() || uploading">
                                    <i class="fas fa-paper-plane mr-1.5 text-xs"></i> Kirim Tugas
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- 8. STATE: ALREADY SUBMITTED (VIEW ONLY) --}}
                    <div x-show="verifyState === 'submitted'" x-cloak class="space-y-6">
                        <div class="flex flex-col items-center text-center p-4 bg-emerald-50 dark:bg-emerald-900/10 rounded-2xl border border-emerald-100 dark:border-emerald-800/30">
                            <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mb-3 shadow-lg shadow-emerald-500/20">
                                <i class="fas fa-check text-xl"></i>
                            </div>
                            <h3 class="text-sm font-bold text-emerald-900 dark:text-emerald-400">Tugas Sudah Dikumpulkan</h3>
                            <p class="text-[11px] text-emerald-600 dark:text-emerald-500/70 mt-1" x-text="'Dikirim pada ' + (submissionData ? new Date(submissionData.submission_date || submissionData.tanggal_pengumpulan).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute:'2-digit'}) : '')"></p>
                        </div>

                        {{-- Submitted Content Display --}}
                        <template x-if="submissionData?.submission_url">
                            <div class="space-y-3">
                                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-950/30 text-orange-600 flex items-center justify-center font-bold">
                                            <i class="fas fa-link"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-bold text-slate-800 dark:text-white">Tautan Pengumpulan Siswa</p>
                                            <a :href="submissionData?.submission_url" target="_blank" rel="noopener noreferrer" class="text-xs text-orange-600 hover:underline truncate block" x-text="submissionData?.submission_url"></a>
                                        </div>
                                        <a :href="submissionData?.submission_url" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 rounded-lg bg-orange-600 text-white text-xs font-bold hover:bg-orange-700 transition flex items-center gap-1.5 shrink-0">
                                            <i class="fas fa-external-link-alt text-[10px]"></i> Buka Tautan
                                        </a>
                                    </div>

                                    {{-- Video Player Preview if Available --}}
                                    <template x-if="getVideoEmbedFromUrl(submissionData?.submission_url)">
                                        <div class="aspect-video w-full rounded-xl overflow-hidden bg-black shadow-sm mt-2">
                                            <iframe :src="getVideoEmbedFromUrl(submissionData?.submission_url)" class="w-full h-full"
                                                sandbox="allow-scripts allow-same-origin allow-presentation"
                                                referrerpolicy="strict-origin-when-cross-origin"
                                                allowfullscreen loading="lazy"></iframe>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <template x-if="!submissionData?.submission_url && submissionData?.file_tugas">
                            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center shrink-0 border border-slate-100 dark:border-slate-700">
                                    <i class="fas text-2xl" :class="getFileIcon(submissionData?.original_name || submissionData?.file_tugas)"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="submissionData?.original_name || submissionData?.file_tugas"></p>
                                    <p class="text-xs text-slate-500" x-text="formatBytes(submissionData?.file_size || 0)"></p>
                                </div>
                                <a :href="'/storage/' + (submissionData?.file_path || submissionData?.file_tugas)" target="_blank" class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center hover:bg-orange-500 hover:text-white transition shadow-sm border border-orange-100 dark:border-orange-800/30">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </template>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="button" @click="closeSubmitModal()" class="flex-1 py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                Tutup
                            </button>
                            <a :href="'/assignments/' + (submissionData?.assignment_id || submitId)" class="flex-1 py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-700 text-white text-xs font-bold text-center hover:bg-slate-800 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Appeal Modal --}}
    <div x-show="openAppeal" x-cloak class="tugas-modal-overlay" role="dialog" aria-modal="true">
        <div class="tugas-modal-backdrop" x-show="openAppeal" x-transition.opacity @click="closeAppealModal()"></div>
        <div class="tugas-modal-panel" x-show="openAppeal"
             x-transition:enter="transition duration-200 ease-out"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             @click.outside="closeAppealModal()">

            <div class="tugas-modal-content">
                <div class="tugas-modal-header" style="padding: 20px 24px;">
                    <h2 class="tugas-modal-header__title" style="font-size: 18px; font-weight: 700;">Form Pengajuan Banding (SSL)</h2>
                    <button @click="closeAppealModal()" type="button" class="tugas-modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="tugas-modal-body" style="padding: 24px;">
                    <form action="{{ route('appeals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        
                        {{-- Info Box (Informasi Penting) --}}
                        <div class="flex gap-3 p-4 bg-red-50 dark:bg-slate-900 border border-red-100 dark:border-slate-800 rounded-2xl mb-6">
                            <div class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-950 text-red-600 dark:text-red-400 flex items-center justify-center shrink-0">
                                <i class="fas fa-exclamation-triangle" style="font-size:12px"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-red-800 dark:text-red-400" style="margin:0">Informasi Penting</h4>
                                <p class="text-xs text-red-600 dark:text-red-500/80 mt-1" style="margin:0">
                                    Pengajuan ini mencakup <span class="font-bold">{{ $tunggakanIds->count() }}</span> tugas yang tertunda. Berikan alasan yang jelas.
                                </p>
                            </div>
                        </div>

                        {{-- Mata Pelajaran --}}
                        <div class="tugas-form-group mb-4">
                            <label class="tugas-label" style="font-size: 13.5px; font-weight: 600; color: #475569; margin-bottom: 8px;">Mata Pelajaran</label>
                            <div class="flex items-center justify-between px-4 py-3 bg-slate-50 dark:bg-slate-850 border border-slate-200 dark:border-slate-800 rounded-xl" style="height: 48px">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $subject->course->name ?? $subject->nama ?? '' }}</span>
                                <span class="px-2.5 py-1 text-[10px] font-extrabold text-slate-500 dark:text-slate-400 bg-slate-200 dark:bg-slate-750 rounded-lg">Kunci</span>
                            </div>
                        </div>

                        {{-- Alasan Keterlambatan --}}
                        <div class="tugas-form-group mb-4">
                            <label class="tugas-label" style="font-size: 13.5px; font-weight: 600; color: #475569; margin-bottom: 8px;">Alasan Keterlambatan <span class="text-red-500">*</span></label>
                            <textarea name="reason" x-model="appealReason" class="tugas-textarea" placeholder="Jelaskan secara singkat alasan Anda melebihi tenggat waktu..." required style="min-height: 100px; border-radius: 12px; font-size:13px;"></textarea>
                        </div>

                        {{-- Bukti Pendukung --}}
                        <div class="tugas-form-group mb-6">
                            <label class="tugas-label" style="font-size: 13.5px; font-weight: 600; color: #475569; margin-bottom: 8px;">Bukti Pendukung (Opsional)</label>
                            <input type="file" name="bukti_pendukung" x-ref="appealFileInput" class="hidden" @change="handleAppealFileSelect" accept=".pdf,.jpg,.png">
                            
                            <div 
                                x-show="!appealFile"
                                @click="$refs.appealFileInput.click()"
                                class="tugas-redesign-drop"
                                style="padding: 20px; border-radius: 12px;"
                            >
                                <div class="tugas-redesign-drop__icon" style="font-size: 24px; color: #3b82f6; margin-bottom: 6px;"><i class="fas fa-cloud-upload-alt"></i></div>
                                <p class="tugas-redesign-drop__text" style="font-size: 13px; color: #2563eb; font-weight: 700; margin:0">Unggah surat sakit atau dokumen relevan (Maks 5MB)</p>
                            </div>

                            <div x-show="appealFile" x-cloak class="tugas-drive-selected" style="border-radius: 12px;">
                                <div class="tugas-drive-selected__info">
                                    <i class="fas fa-file-alt tugas-drive-selected__icon"></i>
                                    <div>
                                        <p class="tugas-drive-selected__name" x-text="appealFileInfo.name"></p>
                                        <p class="text-[10px] text-slate-400" x-text="appealFileInfo.size" style="margin:0"></p>
                                    </div>
                                </div>
                                <button type="button" class="tugas-drive-selected__remove" @click="removeAppealFile()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Checkbox Komitmen --}}
                        <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-slate-900 border border-emerald-100 dark:border-slate-800 rounded-2xl mb-6">
                            <input type="checkbox" id="commitment" x-model="appealCommitment" class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" style="cursor: pointer;">
                            <label for="commitment" class="text-xs font-bold text-emerald-800 dark:text-emerald-400 cursor-pointer" style="margin: 0;">
                                Saya berkomitmen untuk menyelesaikan seluruh tugas jika disetujui.
                            </label>
                        </div>

                        {{-- Footer Buttons --}}
                        <div class="flex justify-between items-center pt-4 border-t border-slate-100 dark:border-slate-850">
                            <button type="button" @click="closeAppealModal()" class="px-5 py-2.5 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-bold rounded-xl text-xs hover:bg-slate-50 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold rounded-xl text-xs transition shadow-md shadow-red-600/10 flex items-center gap-1.5" :disabled="!appealReason.trim() || !appealCommitment">
                                <i class="fas fa-paper-plane" style="font-size:10px"></i> Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Quick Visual Media Lightbox Modal for Student Detail Page --}}
        <div x-show="quickVisualOpen" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 md:p-6" 
             role="dialog" aria-modal="true"
             @keydown.escape.window="closeQuickVisual()">
            
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-md transition-opacity" 
                 x-show="quickVisualOpen" 
                 x-transition.opacity 
                 @click="closeQuickVisual()"></div>

            <div class="relative w-full max-w-5xl max-h-[92vh] bg-slate-900 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden flex flex-col transition-all transform"
                 x-show="quickVisualOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.stop>
                
                {{-- Lightbox Toolbar Header --}}
                <div class="px-5 py-3.5 bg-slate-950/90 border-b border-slate-800 flex items-center justify-between gap-4 text-white">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center text-base flex-shrink-0">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-100 truncate" x-text="quickVisualTitle"></h3>
                            <p class="text-[10px] sm:text-[11px] text-slate-400 truncate" x-text="quickVisualFileName"></p>
                        </div>
                    </div>

                    {{-- Controls --}}
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-shrink-0">
                        <button type="button" @click="zoomOutVisual()" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition" title="Zoom Out (-)">
                            <i class="fas fa-search-minus text-xs"></i>
                        </button>
                        <span class="text-xs font-mono text-slate-400 min-w-[2.75rem] text-center" x-text="Math.round(quickVisualZoom * 100) + '%'"></span>
                        <button type="button" @click="zoomInVisual()" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition" title="Zoom In (+)">
                            <i class="fas fa-search-plus text-xs"></i>
                        </button>
                        <button type="button" @click="resetZoomVisual()" class="px-2 py-1 text-xs rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 transition" title="Reset Zoom">
                            100%
                        </button>
                        <a :href="quickVisualSrc" download target="_blank" class="px-3 py-1.5 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-semibold text-xs flex items-center gap-1.5 transition ml-1" title="Unduh Berkas">
                            <i class="fas fa-download text-xs"></i> <span class="hidden sm:inline">Unduh</span>
                        </a>
                        <button type="button" @click="closeQuickVisual()" class="w-8 h-8 rounded-lg bg-rose-500/20 hover:bg-rose-500 text-rose-300 hover:text-white flex items-center justify-center transition ml-1" title="Tutup (ESC)">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- Image View Area with Zoom Support --}}
                <div class="relative flex-1 overflow-auto p-4 sm:p-6 flex items-center justify-center bg-slate-950/60 select-none min-h-[300px]">
                    <img :src="quickVisualSrc" 
                         :alt="quickVisualTitle" 
                         class="max-w-none transition-transform duration-150 ease-out rounded-lg shadow-2xl"
                         :style="'transform: scale(' + quickVisualZoom + '); transform-origin: center center; max-height: calc(85vh - 120px);'" />
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function studentDetailModals() {
    return {
        openSubmit: false, 
        openAppeal: false,
        
        // Quick Visual Modal state
        quickVisualOpen: false,
        quickVisualSrc: '',
        quickVisualTitle: '',
        quickVisualFileName: '',
        quickVisualZoom: 1,

        openQuickVisual(src, title, fileName) {
            this.quickVisualSrc = src;
            this.quickVisualTitle = title;
            this.quickVisualFileName = fileName;
            this.quickVisualZoom = 1;
            this.quickVisualOpen = true;
        },
        closeQuickVisual() {
            this.quickVisualOpen = false;
            this.quickVisualSrc = '';
        },
        zoomInVisual() {
            this.quickVisualZoom = Math.min(3, +(this.quickVisualZoom + 0.25).toFixed(2));
        },
        zoomOutVisual() {
            this.quickVisualZoom = Math.max(0.5, +(this.quickVisualZoom - 0.25).toFixed(2));
        },
        resetZoomVisual() {
            this.quickVisualZoom = 1;
        },

        submitId: null, 
        submitTitle: '', 
        submitDescription: '',
        submitDeadline: '',
        submitTipePengumpulan: 'dokumen',
        submitModeAudiovisual: 'video_url',
        selectedMethod: 'audio', // For 'either' mode: 'audio' | 'video'
        submissionUrl: '',
        videoPreviewEmbed: '',
        revisionNote: '',
        
        // Verification State Machine: 'idle' | 'checking' | 'passed' | 'locked_overdue' | 'locked_prereq' | 'deadline_passed' | 'recovery_locked' | 'form' | 'submitted'
        verifyState: 'idle',
        checkStep: 1,
        verifyPassed: false,
        verifyResult: null,
        showLockBanner: sessionStorage.getItem('ssl_locked_student_{{ auth()->user()->student_id }}_subject_{{ $subject->id }}') === 'true' || {{ $pendingAppeal ? 'true' : 'false' }},

        submissionData: null,
        needsReload: false,
        uploading: false,
        isDragging: false,
        file: null,
        fileInfo: { name: '', size: '', icon: '' },
        
        // Appeal form fields
        appealReason: '',
        appealCommitment: false,
        appealFile: null,
        appealFileInfo: { name: '', size: '' },

        // -- Global Notification State --
        notification: {
            show: false,
            type: 'success',
            message: ''
        },

        showNotification(type, message) {
            this.notification.type = type;
            this.notification.message = message;
            this.notification.show = true;
        },

        // Helper checks for dynamic modality
        isPhysicalFileMode() {
            if (['visual', 'dokumen'].includes(this.submitTipePengumpulan)) return true;
            if (this.submitTipePengumpulan === 'audiovisual') {
                if (this.submitModeAudiovisual === 'audio_file') return true;
                if (this.submitModeAudiovisual === 'either' && this.selectedMethod === 'audio') return true;
            }
            return false;
        },

        isVideoMode() {
            if (this.submitTipePengumpulan === 'audiovisual') {
                if (this.submitModeAudiovisual === 'video_url') return true;
                if (this.submitModeAudiovisual === 'either' && this.selectedMethod === 'video') return true;
            }
            return false;
        },

        getFileFieldLabel() {
            switch(this.submitTipePengumpulan) {
                case 'visual': return 'Unggah Berkas Media Visual';
                case 'dokumen': return 'Unggah Berkas Dokumen';
                case 'audiovisual': return 'Unggah Rekaman Audio';
                default: return 'Unggah Berkas Jawaban';
            }
        },

        getFileAccept() {
            switch(this.submitTipePengumpulan) {
                case 'visual': return '.jpg,.jpeg,.png,.pdf';
                case 'dokumen': return '.pdf,.doc,.docx';
                case 'audiovisual': return '.mp3,.m4a';
                default: return '.pdf,.doc,.docx';
            }
        },

        getFileDropIcon() {
            switch(this.submitTipePengumpulan) {
                case 'visual': return 'fa-palette text-purple-500';
                case 'dokumen': return 'fa-file-lines text-blue-500';
                case 'audiovisual': return 'fa-microphone text-rose-500';
                default: return 'fa-cloud-upload-alt text-orange-500';
            }
        },

        getFileHintText() {
            switch(this.submitTipePengumpulan) {
                case 'visual': return 'Format yang didukung: JPG, JPEG, PNG, PDF (Maks. 20 MB)';
                case 'dokumen': return 'Format yang didukung: PDF, DOC, DOCX (Maks. 20 MB)';
                case 'audiovisual': return 'Format yang didukung: MP3, M4A (Maks. 10 MB)';
                default: return 'Maksimal ukuran file: 20 MB';
            }
        },

        canSubmitForm() {
            if (this.isPhysicalFileMode()) {
                return !!this.file;
            }
            if (this.isVideoMode() || this.submitTipePengumpulan === 'tautan') {
                return !!this.submissionUrl && this.submissionUrl.trim().startsWith('https://');
            }
            return false;
        },

        getVideoEmbedFromUrl(rawUrl) {
            if (!rawUrl || typeof rawUrl !== 'string') return null;
            const url = rawUrl.trim();
            if (!url.startsWith('https://')) return null;

            // YouTube (Watch / Shorts / Embed / youtu.be)
            const ytMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
            if (ytMatch && ytMatch[1]) {
                return `https://www.youtube-nocookie.com/embed/${ytMatch[1]}`;
            }

            // Google Drive
            const gDriveMatch = url.match(/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/i);
            if (gDriveMatch && gDriveMatch[1]) {
                return `https://drive.google.com/file/d/${gDriveMatch[1]}/preview`;
            }

            // Loom
            const loomMatch = url.match(/loom\.com\/share\/([a-zA-Z0-9]+)/i);
            if (loomMatch && loomMatch[1]) {
                return `https://www.loom.com/embed/${loomMatch[1]}`;
            }

            return null;
        },

        onUrlInput() {
            this.videoPreviewEmbed = this.getVideoEmbedFromUrl(this.submissionUrl);
        },

        fixSpecificTask(task) {
            // Langsung switch modal ke form pengumpulan tugas revisi yang bersangkutan
            this.submitId = task.id;
            this.submitTitle = task.title;
            this.submitDescription = task.deskripsi || '';
            this.submitDeadline = task.deadline || '';
            this.submitTipePengumpulan = task.tipe_pengumpulan || 'dokumen';
            this.submitModeAudiovisual = task.mode_audiovisual || 'either';
            this.selectedMethod = 'audio';
            this.submissionUrl = '';
            this.videoPreviewEmbed = '';
            this.revisionNote = task.alasan || '';
            this.file = null;
            this.fileInfo = { name: '', size: '', icon: '' };
            this.isDragging = false;
            this.uploading = false;
            this.needsReload = false;
            
            // Buka form revisi
            this.verifyPassed = true;
            this.verifyState = 'form';
        },

        // Triggered when clicking "Upload Tugas" (DFD Step 3 -> 4 -> 5)
        async startVerification(id, title, description = '', deadline = '', revisionReason = '', tipe = 'dokumen', mode = 'video_url') {
            this.submitId = id;
            this.submitTitle = title;
            this.submitDescription = description;
            this.submitDeadline = deadline;
            this.submitTipePengumpulan = tipe || 'dokumen';
            this.submitModeAudiovisual = mode || 'video_url';
            this.selectedMethod = 'audio';
            this.submissionUrl = '';
            this.videoPreviewEmbed = '';
            this.revisionNote = revisionReason || '';
            this.file = null;
            this.fileInfo = { name: '', size: '', icon: '' };
            this.isDragging = false;
            this.uploading = false;
            this.needsReload = false;

            // Reset verification animations
            this.verifyState = 'checking';
            this.checkStep = 1;
            this.verifyPassed = false;
            this.verifyResult = null;
            this.openSubmit = true;
            document.body.style.overflow = 'hidden';

            // Sequential step timers for visual feedback
            const step2Timer = setTimeout(() => { if (this.verifyState === 'checking') this.checkStep = 2; }, 400);
            const step3Timer = setTimeout(() => { if (this.verifyState === 'checking') this.checkStep = 3; }, 800);

            try {
                // Call verification route passing through SSL middleware
                const response = await fetch(`/assignments/${id}/verify-access`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json().catch(() => ({ success: false, message: 'Gagal memproses verifikasi.' }));

                // Keep checking animation visible for at least 1100ms so user can clearly see DFD steps
                await new Promise(r => setTimeout(r, 1150));
                this.checkStep = 3;

                if (response.ok && result.allowed) {
                    // Success / Access Granted
                    this.verifyPassed = true;
                    this.verifyState = 'passed';
                    
                    // Transition to Form after brief confirmation
                    setTimeout(() => {
                        if (this.openSubmit && this.verifyState === 'passed') {
                            this.verifyState = 'form';
                        }
                    }, 700);
                } else {
                    // Access Locked by Middleware
                    this.verifyPassed = false;
                    this.verifyResult = result;

                    if (result.type === 'prereq_locked' || result.reason_code === 'PREREQUISITE_NOT_MET') {
                        this.verifyState = 'locked_prereq';
                    } else if (result.type === 'locked_by_returned' || result.reason_code === 'LOCKED_BY_RETURNED_TASKS') {
                        this.verifyState = 'locked_by_returned';
                    } else if (result.type === 'overdue_locked' || result.reason_code === 'LOCKED_BY_SSL') {
                        this.verifyState = 'locked_overdue';
                        this.showLockBanner = true;
                        sessionStorage.setItem('ssl_locked_student_{{ auth()->user()->student_id }}_subject_{{ $subject->id }}', 'true');
                    } else if (result.type === 'deadline_passed' || result.reason_code === 'PAST_DEADLINE') {
                        this.verifyState = 'deadline_passed';
                    } else if (result.type === 'recovery_locked' || result.reason_code === 'RECOVERY_WRONG_TASK') {
                        this.verifyState = 'recovery_locked';
                    } else if (result.is_submitted) {
                        this.submissionData = result.submission;
                        this.verifyState = 'submitted';
                    } else {
                        this.verifyState = 'locked_overdue';
                    }
                }
            } catch (err) {
                console.error('Verification error:', err);
                this.verifyPassed = false;
                this.verifyState = 'deadline_passed';
                this.verifyResult = {
                    message: 'Mohon maaf, pengumpulan tugas sudah ditutup karena telah melewati batas deadline.',
                    tunggakan_count: 1
                };
            }
        },

        // Triggered when opening an already submitted assignment
        openSubmittedModal(id, title, submission, description = '', deadline = '', tipe = 'dokumen', mode = 'video_url') {
            this.submitId = id;
            this.submitTitle = title;
            this.submitDescription = description;
            this.submitDeadline = deadline;
            this.submitTipePengumpulan = tipe || 'dokumen';
            this.submitModeAudiovisual = mode || 'video_url';
            this.submissionData = submission;
            this.verifyState = 'submitted';
            this.openSubmit = true;
            document.body.style.overflow = 'hidden';
        },

        openAppealFromLock() {
            this.closeSubmitModal();
            this.openAppealModal();
        },

        closeSubmitModal() {
            this.openSubmit = false;
            this.verifyState = 'idle';
            this.revisionNote = '';
            this.submissionUrl = '';
            this.videoPreviewEmbed = '';
            this.removeFile();
            document.body.style.overflow = '';
            if (this.$refs.submitFormEl) {
                this.$refs.submitFormEl.reset();
            }
            if (this.needsReload) {
                window.location.reload();
            }
        },

        openAppealModal() {
            this.openAppeal = true;
            document.body.style.overflow = 'hidden';
        },

        closeAppealModal() {
            this.openAppeal = false;
            this.appealReason = '';
            this.appealCommitment = false;
            this.appealFile = null;
            this.appealFileInfo = { name: '', size: '' };
            if (this.$refs.appealFileInput) this.$refs.appealFileInput.value = '';
            document.body.style.overflow = '';
        },

        handleAppealFileSelect(e) {
            const files = e.target.files || e.dataTransfer.files;
            if (files.length > 0) {
                const selectedFile = files[0];
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                const maxSize = 5 * 1024 * 1024;
                
                if (!allowedTypes.includes(selectedFile.type)) {
                    this.showNotification('error', 'Format file bukti tidak didukung. Gunakan PDF, JPG, atau PNG.');
                    return;
                }
                if (selectedFile.size > maxSize) {
                    this.showNotification('error', 'Ukuran file bukti terlalu besar. Maksimal 5MB.');
                    return;
                }

                this.appealFile = selectedFile;
                this.appealFileInfo = {
                    name: selectedFile.name,
                    size: this.formatBytes(selectedFile.size)
                };
            }
        },

        removeAppealFile() {
            this.appealFile = null;
            this.appealFileInfo = { name: '', size: '' };
            if(this.$refs.appealFileInput) this.$refs.appealFileInput.value = '';
        },

        getFileIcon(filename) {
            if(!filename) return 'fa-file text-slate-400';
            const ext = filename.split('.').pop().toLowerCase();
            if (ext === 'pdf') return 'fa-file-pdf text-rose-500';
            if (['doc', 'docx'].includes(ext)) return 'fa-file-word text-blue-500';
            if (['zip', 'rar'].includes(ext)) return 'fa-file-zipper text-amber-500';
            if (['jpg', 'jpeg', 'png'].includes(ext)) return 'fa-file-image text-purple-500';
            if (['mp3', 'm4a'].includes(ext)) return 'fa-file-audio text-rose-500';
            return 'fa-file text-slate-400';
        },

        formatBytes(bytes) {
            if (!bytes || bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },

        handleFileSelect(e) {
            const files = e.target.files || e.dataTransfer.files;
            if (files.length > 0) {
                const selectedFile = files[0];
                const ext = selectedFile.name.split('.').pop().toLowerCase();
                
                let allowedExts = ['pdf', 'doc', 'docx'];
                let maxSize = 20 * 1024 * 1024;

                if (this.submitTipePengumpulan === 'visual') {
                    allowedExts = ['jpg', 'jpeg', 'png', 'pdf'];
                    maxSize = 20 * 1024 * 1024;
                } else if (this.submitTipePengumpulan === 'dokumen') {
                    allowedExts = ['pdf', 'doc', 'docx'];
                    maxSize = 20 * 1024 * 1024;
                } else if (this.submitTipePengumpulan === 'audiovisual') {
                    allowedExts = ['mp3', 'm4a'];
                    maxSize = 10 * 1024 * 1024;
                }

                if (!allowedExts.includes(ext)) {
                    this.showNotification('error', `Format berkas .${ext} tidak didukung. Format yang diizinkan: ${allowedExts.map(e => '.' + e).join(', ')}`);
                    return;
                }

                if (selectedFile.size > maxSize) {
                    this.showNotification('error', `Ukuran berkas melebihi batas maksimal (${this.formatBytes(maxSize)}).`);
                    return;
                }

                this.file = selectedFile;
                this.fileInfo = {
                    name: selectedFile.name,
                    size: this.formatBytes(selectedFile.size),
                    icon: this.getFileIcon(selectedFile.name)
                };
            }
        },

        removeFile() {
            this.file = null;
            this.fileInfo = { name: '', size: '', icon: '' };
            if(this.$refs.fileInput) this.$refs.fileInput.value = '';
        },

        async submitForm(e) {
            if (this.uploading) return;

            const isPhysical = this.isPhysicalFileMode();
            const isUrl = this.isVideoMode() || this.submitTipePengumpulan === 'tautan';

            if (isPhysical && !this.file) {
                this.showNotification('error', 'Silakan pilih berkas yang akan diunggah.');
                return;
            }

            if (isUrl && (!this.submissionUrl || !this.submissionUrl.trim().startsWith('https://'))) {
                this.showNotification('error', 'Tautan wajib diawali dengan https://');
                return;
            }

            this.uploading = true;
            const formData = new FormData(this.$refs.submitFormEl);

            if (isPhysical && this.file) {
                formData.set('file', this.file);
                formData.delete('submission_url');
            } else if (isUrl) {
                formData.set('submission_url', this.submissionUrl.trim());
                formData.delete('file');
            }

            try {
                const response = await fetch(this.$refs.submitFormEl.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    this.submissionData = result.submission;
                    this.verifyState = 'submitted';
                    this.needsReload = true;
                    this.showNotification('success', result.message || 'Tugas berhasil dikumpulkan!');

                    if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                        Toast.fire({
                            icon: 'success',
                            title: result.message || 'Tugas berhasil dikumpulkan!'
                        });
                    }
                } else {
                    let errorMsg = result.message || 'Terjadi kesalahan saat mengunggah.';
                    if (result.errors) {
                        errorMsg = Object.values(result.errors).flat().join('<br>');
                    }
                    this.showNotification('error', errorMsg);

                    if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'error',
                            title: errorMsg.replace(/<br>/g, ' ')
                        });
                    }
                }
            } catch (error) {
                console.error('Upload error:', error);
                this.showNotification('error', 'Terjadi kesalahan jaringan atau server.');
                if (typeof Swal !== 'undefined') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan saat mengirimkan tugas.'
                    });
                }
            } finally {
                this.uploading = false;
            }
        }
    }
}

// Countdown Timer Logic
document.addEventListener('DOMContentLoaded', function() {
    const timerEl = document.getElementById('recovery-timer');
    if (timerEl) {
        const expiryDate = new Date(timerEl.dataset.expiry).getTime();
        
        const updateTimer = () => {
            const now = new Date().getTime();
            const diff = expiryDate - now;
            
            if (diff <= 0) {
                timerEl.innerHTML = "EXPIRED";
                timerEl.style.color = "#ef4444";
                timerEl.style.fontWeight = "bold";
                return;
            }
            
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            timerEl.innerHTML = `${hours}j ${minutes}m ${seconds}d`;
        };
        
        updateTimer();
        setInterval(updateTimer, 1000);
    }
});
</script>
@endpush

@push('scripts')
<style>
/* Reuse tugas-student-wrapper styles from student_index */
.tugas-student-wrapper { max-width:100%; font-family:'Plus Jakarta Sans','Inter',-apple-system,BlinkMacSystemFont,sans-serif; }

.tugas-alert { display:flex; align-items:center; gap:12px; padding:14px 18px; border-radius:12px; margin-bottom:20px; font-size:13px; font-weight:500; }
.tugas-alert--success { background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; }
.tugas-alert--danger { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }
.tugas-alert--recovery { background:#fff7ed; border:1px solid #fed7aa; color:#9a3412; }
.tugas-alert__icon { flex-shrink:0; width:28px; height:28px; border-radius:8px; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.5); font-size:13px; }
.tugas-alert__text { flex:1; }
.tugas-alert__timer { font-size:11px; margin-top:4px; font-weight:700; display:flex; align-items:center; gap:5px; }
.tugas-alert__status { font-size:12px; font-style:italic; opacity:0.8; margin-left:8px; }
.tugas-alert__close { background:none; border:none; cursor:pointer; color:inherit; opacity:0.5; padding:4px; }

/* Detail Header */
.tugas-detail-header { margin-bottom:24px; }
.tugas-back-btn {
    display:inline-flex; align-items:center; gap:8px; padding:8px 16px; border:1px solid #e2e8f0; border-radius:10px;
    background:#fff; color:#64748b; font-size:13px; font-weight:500; text-decoration:none; margin-bottom:16px; transition:all 0.15s;
}
.tugas-back-btn:hover { border-color:#f97316; color:#f97316; }
.dark .tugas-back-btn { background:#1e293b; border-color:#334155; color:#94a3b8; }
.tugas-detail-header__title { font-size:22px; font-weight:700; color:#1e293b; margin:0 0 8px 0; }
.dark .tugas-detail-header__title { color:#f1f5f9; }
.tugas-detail-header__meta { display:flex; align-items:center; gap:8px; font-size:13px; color:#64748b; flex-wrap:wrap; }
.tugas-detail-header__meta strong { color:#334155; font-weight:600; }
.dark .tugas-detail-header__meta strong { color:#e2e8f0; }
.tugas-detail-header__meta i { font-size:11px; color:#94a3b8; margin-right:2px; }
.tugas-detail-header__sep { color:#cbd5e1; }

/* Card & Table */
.tugas-card { background:#fff; border:1px solid #f1f5f9; border-radius:16px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.04); }
.dark .tugas-card { background:#0f172a; border-color:#1e293b; }
.tugas-table-wrap { overflow-x:auto; }
.tugas-table { width:100%; border-collapse:collapse; }
.tugas-th { padding:14px 18px; text-align:left; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.06em; color:#94a3b8; background:#fafbfc; border-bottom:1px solid #f1f5f9; white-space:nowrap; }
.dark .tugas-th { background:#0f172a; border-color:#1e293b; color:#64748b; }
.tugas-tr { transition:background 0.15s; }
.tugas-tr:hover { background:#fafbfc; }
.dark .tugas-tr:hover { background:#1e293b; }
.tugas-tr:not(:last-child) .tugas-td { border-bottom:1px solid #f8fafc; }
.dark .tugas-tr:not(:last-child) .tugas-td { border-bottom-color:#1e293b; }
.tugas-td { padding:14px 18px; font-size:13px; color:#334155; vertical-align:middle; }
.dark .tugas-td { color:#cbd5e1; }
.tugas-td--num { color:#94a3b8; font-weight:500; }
.tugas-td--center { text-align:center; }
.tugas-td--empty { padding:48px 20px; text-align:center; }

/* Code Badge */
.tugas-code-badge { display:inline-block; padding:3px 10px; border-radius:6px; background:#f8fafc; border:1px solid #e2e8f0; font-size:11.5px; font-weight:600; color:#64748b; font-family:monospace; }
.dark .tugas-code-badge { background:#1e293b; border-color:#334155; color:#94a3b8; }

/* Detail Cell */
.tugas-detail-cell { display:flex; flex-direction:column; gap:2px; max-width:280px; }
.tugas-detail-cell__title { font-weight:600; color:#1e293b; font-size:13px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.dark .tugas-detail-cell__title { color:#f1f5f9; }
.tugas-detail-cell__desc { font-size:12px; color:#94a3b8; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

/* Date Cell */
.tugas-date-cell { display:flex; flex-direction:column; gap:2px; }
.tugas-date-cell__date { font-size:13px; color:#334155; font-weight:500; white-space:nowrap; }
.tugas-date-cell__remaining { font-size:11.5px; color:#94a3b8; }
.tugas-date-cell--overdue { color:#ef4444 !important; font-weight:600; }

/* Status Badges */
.tugas-status-badge { display:inline-flex; align-items:center; gap:4px; padding:4px 10px; border-radius:20px; font-size:11.5px; font-weight:600; white-space:nowrap; }
.tugas-status-badge i { font-size:10px; }
.tugas-status-badge--success { background:#f0fdf4; color:#16a34a; }
.tugas-status-badge--danger { background:#fef2f2; color:#ef4444; }
.tugas-status-badge--warning { background:#fffbeb; color:#d97706; }

/* Info Actions */
.tugas-info-actions { display:flex; gap:6px; flex-wrap:wrap; }
.tugas-info-btn { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; border:1px solid #e2e8f0; border-radius:6px; background:#fff; color:#64748b; font-size:11.5px; font-weight:500; text-decoration:none; transition:all 0.15s; white-space:nowrap; }
.tugas-info-btn:hover { border-color:#f97316; color:#f97316; }
.dark .tugas-info-btn { background:#1e293b; border-color:#334155; color:#94a3b8; }

/* Submit Button */
.tugas-btn-submit { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border:1px solid #f97316; border-radius:10px; background:#fff7ed; color:#ea580c; font-size:12px; font-weight:700; cursor:pointer; transition:all 0.15s; font-family:inherit; box-shadow:0 1px 2px rgba(234,88,12,0.1); }
.tugas-btn-submit:hover { background:#ea580c; color:#fff; transform:translateY(-1px); box-shadow:0 4px 8px rgba(234,88,12,0.2); }
.dark .tugas-btn-submit { background:#431407; border-color:#ea580c; color:#fb923c; }
.dark .tugas-btn-submit:hover { background:#ea580c; color:#fff; }

/* Revision Upload Button */
.tugas-btn-revision { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border:1px solid #ea580c; border-radius:10px; background:#ea580c; color:#ffffff !important; font-size:12px; font-weight:700; cursor:pointer; transition:all 0.15s ease; font-family:inherit; box-shadow:0 2px 4px rgba(234,88,12,0.25); text-decoration:none; }
.tugas-btn-revision:hover { background:#c2410c; border-color:#c2410c; color:#ffffff !important; transform:translateY(-1px); box-shadow:0 4px 10px rgba(234,88,12,0.35); }
.dark .tugas-btn-revision { background:#ea580c; border-color:#ea580c; color:#ffffff !important; }
.dark .tugas-btn-revision:hover { background:#c2410c; color:#ffffff !important; }

.tugas-submitted-btn {
    display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border: 1px solid #10b981; border-radius: 10px;
    background: #f0fdf4; color: #10b981; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.15s;
}
.tugas-submitted-btn:hover { background: #10b981; color: #fff; }
.tugas-submitted-btn i { font-size: 14px; }

/* Lihat btn reuse */
.tugas-btn-lihat { display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border:1px solid #e2e8f0; border-radius:8px; background:#fff; color:#475569; font-size:12.5px; font-weight:500; text-decoration:none; cursor:pointer; transition:all 0.15s; font-family:inherit; }

/* Empty State */
.tugas-empty-state { display:flex; flex-direction:column; align-items:center; gap:8px; }
.tugas-empty-state__icon { width:52px; height:52px; border-radius:16px; background:#fff7ed; color:#f97316; display:flex; align-items:center; justify-content:center; font-size:20px; }
.tugas-empty-state__title { font-size:14px; font-weight:600; color:#475569; margin:0; }
.tugas-empty-state__desc { font-size:12.5px; color:#94a3b8; margin:0; }

/* Modal */
.tugas-modal-overlay { position:fixed; inset:0; z-index:50; display:flex; align-items:center; justify-content:center; padding:16px; }
.tugas-modal-backdrop { position:fixed; inset:0; background:rgba(15,23,42,0.6); backdrop-filter:blur(6px); }
.tugas-modal-panel { position:relative; width:100%; max-width:580px; }
.tugas-modal-content { background:#fff; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 25px 70px rgba(0,0,0,0.18); overflow:hidden; }
.dark .tugas-modal-content { background:#0f172a; border-color:#1e293b; }
.tugas-modal-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-bottom:1px solid #f1f5f9; }
.dark .tugas-modal-header { border-color:#1e293b; }
.tugas-modal-header__title { font-size:16px; font-weight:800; color:#1e293b; margin:0; }
.dark .tugas-modal-header__title { color:#f1f5f9; }
.tugas-modal-close { width:32px; height:32px; border-radius:50%; border:none; background:#f1f5f9; color:#64748b; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.15s; }
.tugas-modal-close:hover { background:#e2e8f0; color:#1e293b; }
.dark .tugas-modal-close { background:#1e293b; color:#94a3b8; }
.dark .tugas-modal-close:hover { background:#334155; color:#f1f5f9; }
.tugas-modal-body { padding:24px; }

/* Redesigned Info Card */
.tugas-info-card { background:#fafbfc; border:1px solid #f1f5f9; border-radius:14px; padding:16px; margin-bottom:20px; }
.dark .tugas-info-card { background:#111827; border-color:#1e293b; }
.tugas-info-card__header { display:flex; align-items:center; gap:12px; }
.tugas-info-card__icon-box { width:40px; height:40px; border-radius:10px; background:#fffbeb; color:#d97706; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
.dark .tugas-info-card__icon-box { background:#3f2e0a; color:#f59e0b; }
.tugas-info-card__meta { display:flex; flex-direction:column; }
.tugas-info-card__title { font-size:14.5px; font-weight:700; color:#1e293b; margin:0 0 2px 0; }
.dark .tugas-info-card__title { color:#f1f5f9; }
.tugas-info-card__deadline { font-size:12px; font-weight:600; color:#d95726; margin:0; }
.tugas-info-card__divider { border-top:1px dashed #e2e8f0; margin:12px 0; }
.dark .tugas-info-card__divider { border-top-color:#1e293b; }
.tugas-info-card__desc { font-size:12.5px; font-style:italic; color:#64748b; line-height:1.5; margin:0; }
.dark .tugas-info-card__desc { color:#94a3b8; }

/* Redesigned Form Elements */
.tugas-form-group { display:flex; flex-direction:column; }
.tugas-form-label { font-size:13px; font-weight:700; color:#475569; margin-bottom:8px; display:block; }
.dark .tugas-form-label { color:#cbd5e1; }

/* Redesigned Drop Zone */
.tugas-redesign-drop { cursor:pointer; border:2px dashed #ea580c; border-radius:14px; padding:28px; text-align:center; transition:all 0.15s ease; background:#fff7ed; }
.dark .tugas-redesign-drop { border-color:#ea580c; background:rgba(67, 20, 7, 0.2); }
.tugas-redesign-drop:hover, .tugas-redesign-drop--dragging { border-color:#c2410c; background:#ffedd5; }
.tugas-redesign-drop__icon { font-size:32px; color:#ea580c; margin-bottom:8px; }
.tugas-redesign-drop__text { font-size:13.5px; font-weight:700; color:#ea580c; }
.tugas-redesign-drop__hint { font-size:11px; color:#64748b; margin-top:4px; }
.dark .tugas-redesign-drop__hint { color:#94a3b8; }

/* Selected File Info */
.tugas-drive-selected { display:flex; align-items:center; justify-content:space-between; padding:14px 16px; border:1px solid #e2e8f0; border-radius:12px; background:#f8fafc; }
.dark .tugas-drive-selected { background:#1e293b; border-color:#334155; }
.tugas-drive-selected__info { display:flex; align-items:center; gap:12px; }
.tugas-drive-selected__icon { font-size:22px; color:#16a34a; }
.tugas-drive-selected__status { font-size:10px; font-weight:700; color:#16a34a; text-transform:uppercase; letter-spacing:0.05em; margin:0; }
.tugas-drive-selected__name { font-size:13px; font-weight:600; color:#1e293b; margin:0; }
.dark .tugas-drive-selected__name { color:#f1f5f9; }
.tugas-drive-selected__remove { background:none; border:none; color:#94a3b8; cursor:pointer; padding:4px; }
.tugas-drive-selected__remove:hover { color:#ef4444; }

/* Textarea Redesign */
.tugas-redesign-textarea { width:100%; min-height:80px; padding:12px; border-radius:10px; border:1px solid #cbd5e1; font-family:inherit; font-size:13px; outline:none; transition:all 0.15s; background:#fff; color:#1e293b; }
.dark .tugas-redesign-textarea { background:#0f172a; border-color:#334155; color:#f1f5f9; }
.tugas-redesign-textarea::placeholder { color:#94a3b8; }
.tugas-redesign-textarea:focus { border-color:#ea580c; box-shadow:0 0 0 3px rgba(234, 88, 12, 0.15); }

/* Modal Footer */
.tugas-modal-footer { display:flex; justify-content:space-between; align-items:center; margin-top:24px; padding-top:16px; border-top:1px solid #f1f5f9; }
.dark .tugas-modal-footer { border-color:#1e293b; }
.tugas-btn-batal { background:#fff; border:1px solid #cbd5e1; color:#475569; border-radius:10px; padding:10px 24px; font-size:13px; font-weight:700; cursor:pointer; transition:all 0.15s; font-family:inherit; }
.tugas-btn-batal:hover { background:#f8fafc; border-color:#94a3b8; color:#1e293b; }
.dark .tugas-btn-batal { background:#1e293b; border-color:#334155; color:#cbd5e1; }
.dark .tugas-btn-batal:hover { background:#334155; color:#fff; }
.tugas-btn-kirim { background:#ea580c; border:none; color:#fff; border-radius:10px; padding:10px 24px; font-size:13px; font-weight:700; cursor:pointer; transition:all 0.15s; font-family:inherit; display:inline-flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(234, 88, 12, 0.25); }
.tugas-btn-kirim:hover:not(:disabled) { background:#c2410c; transform:translateY(-1px); }
.tugas-btn-kirim:disabled { opacity:0.5; cursor:not-allowed; }

.tugas-submit-form { display:flex; flex-direction:column; }

/* Table Locking */
.tugas-tr--locked { background:#fcfcfd; }
.tugas-tr--locked .tugas-td:not(.tugas-td--center) { opacity:0.85; }

/* Status Badges */
.tugas-status-badge--active { background:#f0f9ff; color:#0369a1; border:1px solid #bae6fd; }
.tugas-status-badge--wait { background:#f8fafc; color:#64748b; border:1px solid #e2e8f0; }
.tugas-status-badge--locked { background:#fef2f2; color:#ef4444; border:1px solid #fee2e2; }

/* Appeal Form */
.tugas-label { display:block; font-size:13px; font-weight:700; color:#475569; margin-bottom:8px; }
.tugas-textarea { width:100%; min-height:120px; padding:12px; border-radius:10px; border:1px solid #e2e8f0; font-family:inherit; font-size:13.5px; outline:none; transition:all 0.15s; }
.tugas-textarea:focus { border-color:#ef4444; box-shadow:0 0 0 3px rgba(239, 68, 68, 0.1); }

/* Animations */
@keyframes progress-indefinite {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.animate-progress-indefinite { animation: progress-indefinite 1.5s infinite linear; }

@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-spin-slow { animation: spin-slow 8s linear infinite; }

@keyframes orbit-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-orbit-slow { animation: orbit-slow 6s linear infinite; }

@keyframes orbit-reverse {
    from { transform: rotate(360deg); }
    to { transform: rotate(0deg); }
}
.animate-orbit-reverse { animation: orbit-reverse 3.5s linear infinite; }

@keyframes scan-laser {
    0% { top: 8%; opacity: 0; }
    30% { opacity: 1; }
    70% { opacity: 1; }
    100% { top: 88%; opacity: 0; }
}
.animate-scan-laser { animation: scan-laser 1.1s ease-in-out infinite; }

@keyframes hologram-glow {
    0%, 100% { transform: scale(1); filter: drop-shadow(0 8px 16px rgba(214, 90, 32, 0.25)); }
    50% { transform: scale(1.05); filter: drop-shadow(0 12px 24px rgba(214, 90, 32, 0.45)); }
}
.animate-hologram-glow { animation: hologram-glow 2s ease-in-out infinite; }

@keyframes ripple-wave {
    0% { transform: scale(0.75); opacity: 0.8; }
    100% { transform: scale(1.5); opacity: 0; }
}
.animate-ripple-wave { animation: ripple-wave 1.6s cubic-bezier(0, 0.2, 0.8, 1) infinite; }

/* Redesign Locked Banner */
.tugas-lock-banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fef2f2;
    border: 1px solid #fee2e2;
    padding: 20px 24px;
    border-radius: 16px;
    margin-bottom: 24px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}
.tugas-lock-banner__left {
    display: flex;
    align-items: center;
    gap: 16px;
}
.tugas-lock-banner__icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #fecaca;
    color: #ef4444;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.tugas-lock-banner__title {
    font-size: 16px;
    font-weight: 800;
    color: #991b1b;
    margin: 0 0 4px 0;
}
.tugas-lock-banner__desc {
    font-size: 13px;
    color: #dc2626;
    margin: 0;
}
.tugas-lock-banner__btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #ef4444;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.15s ease;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
}
.tugas-lock-banner__btn:hover {
    background: #dc2626;
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.3);
}
.tugas-lock-banner__status {
    font-size: 13px;
    font-style: italic;
    color: #991b1b;
    font-weight: 600;
}
.dark .tugas-lock-banner {
    background: rgba(239, 68, 68, 0.05);
    border-color: rgba(239, 68, 68, 0.2);
}
.dark .tugas-lock-banner__icon-box {
    background: rgba(239, 68, 68, 0.15);
    color: #f87171;
}
.dark .tugas-lock-banner__title {
    color: #f87171;
}
.dark .tugas-lock-banner__desc {
    color: #f87171;
}

.hidden { display: none !important; }
[x-cloak] { display: none !important; }
</style>
@endpush
@endsection
