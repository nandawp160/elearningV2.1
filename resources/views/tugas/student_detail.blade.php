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
                <span><i class="fas fa-school"></i> Kelas: <strong>{{ $subject->classRoom->name ?? (auth()->user()->student?->kelas ?? '-') }}</strong></span>
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
    @if($tunggakanIds->count() >= 3 && !$recovery)
    <div class="tugas-lock-banner">
        <div class="tugas-lock-banner__left">
            <div class="tugas-lock-banner__icon-box">
                <i class="fas fa-lock"></i>
            </div>
            <div>
                <h3 class="tugas-lock-banner__title">Akses Modul Ditangguhkan</h3>
                <p class="tugas-lock-banner__desc">Anda melebihi batas toleransi keterlambatan ({{ $tunggakanIds->count() }} tugas).</p>
            </div>
        </div>
        @if($pendingAppeal)
            <span class="tugas-lock-banner__status">(Banding Anda sedang ditinjau)</span>
        @else
            <button type="button" @click="openAppealModal()" class="tugas-lock-banner__btn">
                Ajukan Banding (SSL) <i class="fas fa-chevron-right" style="font-size:10px"></i>
            </button>
        @endif
    </div>
    @elseif($tunggakanIds->isNotEmpty() && !$recovery)
    <div class="tugas-alert tugas-alert--warning" style="background:#fffbeb; border:1px solid #fef3c7; color:#b45309">
        <div class="tugas-alert__icon" style="background:#fef3c7; color:#d97706"><i class="fas fa-exclamation-triangle"></i></div>
        <div class="tugas-alert__text">
            Anda memiliki <strong>{{ $tunggakanIds->count() }}</strong> tugas yang telah lewat deadline. Selesaikan segera sebelum mencapai batas maksimal 3 tugas tertunggak yang akan mengunci seluruh akses pengumpulan Anda.
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
                        $isPassed = $assignment->due_date->isPast();
                        
                        // NEW LOCKING LOGIC
                        $isLocked = false;
                        $statusBadge = '';
                        $isCurrentRecovery = false;
                        $prereqNotCompleted = $assignment->prasyarat_materi_id && !in_array($assignment->prasyarat_materi_id, $completedMaterialIds);

                        if ($recovery) {
                            // In recovery mode: only current_assignment_id is open
                            if (!$mySub) {
                                if ($assignment->id == $recovery->current_assignment_id) {
                                    $isLocked = false;
                                    $isCurrentRecovery = true;
                                } else {
                                    $isLocked = true;
                                }
                            }
                        } else {
                            // Normal mode:
                            if (!$mySub) {
                                if ($isPassed) {
                                    // Tugas ini sendiri sudah lewat deadline -> terkunci secara individual
                                    $isLocked = true;
                                } elseif ($tunggakanIds->count() >= 3) {
                                    // Total tunggakan >= 3 -> kunci seluruh akses tugas (termasuk tugas aktif)
                                    $isLocked = true;
                                } elseif ($prereqNotCompleted) {
                                    // Belum menyelesaikan materi prasyarat -> terkunci
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
                                    {{ $assignment->due_date->format('d M Y, H:i') }}
                                </span>
                                @if(!$isPassed)
                                <span class="tugas-date-cell__remaining">{{ $assignment->due_date->diffForHumans() }}</span>
                                @else
                                <span class="tugas-date-cell__remaining tugas-date-cell--overdue">Batas waktu telah lewat</span>
                                @endif
                            </div>
                        </td>
                        <td class="tugas-td tugas-td--center">
                            @if($mySub)
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
                                <a href="{{ $assignment->attachment_url }}" target="_blank" class="tugas-info-btn" title="Download Soal">
                                    <i class="fas fa-download"></i> Soal
                                </a>
                                @endif
                                <a href="{{ route('assignments.show', $assignment) }}" class="tugas-info-btn" title="Detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        </td>
                        <td class="tugas-td tugas-td--center">
                            @if($mySub)
                                <button type="button"
                                    @click="openSubmitModal({{ $assignment->id }}, {{ json_encode($assignment->title) }}, false, 0, {{ json_encode($mySub) }}, {{ json_encode($assignment->description) }}, '{{ $assignment->due_date->format('d M Y, H:i') }} WIB')"
                                    class="tugas-submitted-btn" title="Lihat Pengumpulan">
                                    <i class="fas fa-check-circle"></i> Terkumpul
                                </button>
                            @elseif($isLocked)
                                <button type="button" class="tugas-btn-locked-state" title="Tugas Terkunci" disabled>
                                    <i class="fas fa-lock"></i> Terkunci
                                </button>
                            @else
                                <button type="button"
                                    @click="openSubmitModal({{ $assignment->id }}, {{ json_encode($assignment->title) }}, false, 0, null, {{ json_encode($assignment->description) }}, '{{ $assignment->due_date->format('d M Y, H:i') }} WIB')"
                                    class="tugas-btn-submit" title="Kirim Tugas">
                                    <i class="fas fa-upload"></i> Kirim
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

    {{-- Submit Modal --}}
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
                <div class="tugas-modal-header">
                    <h2 class="tugas-modal-header__title">Pengumpulan Tugas</h2>
                    <button @click="closeSubmitModal()" type="button" class="tugas-modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="tugas-modal-body">
                    <template x-if="submitLocked">
                        <div class="tugas-locked-box">
                            <div class="tugas-locked-box__header">
                                <i class="fas fa-lock"></i>
                                <span>Pengumpulan Terkunci</span>
                            </div>
                            <p class="tugas-locked-box__desc">
                                Anda memiliki <strong x-text="submitTunggakan"></strong> tunggakan tugas yang harus diselesaikan terlebih dahulu.
                            </p>
                            <button type="button" @click="closeSubmitModal()" class="tugas-btn-lihat" style="width:100%;justify-content:center">Tutup</button>
                        </div>
                    </template>

                    <template x-if="!submitLocked">
                        <div class="tugas-modal-inner">
                            
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

                            {{-- State: Already Submitted --}}
                            <div x-show="isSubmitted" x-cloak class="space-y-6">
                                <div class="flex flex-col items-center text-center p-4 bg-emerald-50 dark:bg-emerald-900/10 rounded-2xl border border-emerald-100 dark:border-emerald-800/30">
                                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mb-3 shadow-lg shadow-emerald-500/20">
                                        <i class="fas fa-check text-xl"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-emerald-900 dark:text-emerald-400">Tugas Sudah Dikumpulkan</h3>
                                    <p class="text-[11px] text-emerald-600 dark:text-emerald-500/70 mt-1" x-text="'Dikirim pada ' + (submissionData ? new Date(submissionData.submission_date).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute:'2-digit'}) : '')"></p>
                                </div>

                                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center shrink-0 border border-slate-100 dark:border-slate-700">
                                        <i class="fas text-2xl" :class="getFileIcon(submissionData?.original_name)"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="submissionData?.original_name"></p>
                                        <p class="text-xs text-slate-500" x-text="formatBytes(submissionData?.file_size)"></p>
                                    </div>
                                    <a :href="'/storage/' + submissionData?.file_path" target="_blank" class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center hover:bg-orange-500 hover:text-white transition shadow-sm border border-orange-100 dark:border-orange-800/30">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>

                                <div class="flex items-center gap-3 pt-2">
                                    <button type="button" @click="closeSubmitModal()" class="flex-1 py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                        Tutup
                                    </button>
                                    <a :href="'/assignments/' + submissionData?.assignment_id" class="flex-1 py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-700 text-white text-sm font-bold text-center hover:bg-slate-800 transition">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            {{-- State: Not Submitted Yet --}}
                            <form x-show="!isSubmitted" x-ref="submitFormEl" :action="`/assignments/${submitId}/submit`" method="POST" enctype="multipart/form-data" class="tugas-submit-form" @submit.prevent="submitForm">
                                @csrf
                                <input type="file" name="file" x-ref="fileInput" class="hidden" @change="handleFileSelect" accept=".pdf,.doc,.docx,.zip">

                                <div class="tugas-form-group">
                                    <label class="tugas-form-label">Unggah Jawaban <span class="text-red-500">*</span></label>
                                    
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
                                        <div class="tugas-redesign-drop__icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <div class="tugas-redesign-drop__text">Pilih file atau seret ke sini</div>
                                        <p class="tugas-redesign-drop__hint">Maksimal ukuran file: 10 MB (PDF, JPG, PNG)</p>
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

                                {{-- Notes Textarea --}}
                                <div class="tugas-form-group" style="margin-top: 16px;">
                                    <label class="tugas-form-label">Catatan Tambahan (Opsional)</label>
                                    <textarea name="content" class="tugas-redesign-textarea" placeholder="Tambahkan pesan untuk guru (misal: &quot;Maaf Pak, foto agak buram&quot;)..."></textarea>
                                </div>

                                {{-- Progress --}}
                                <div x-show="uploading" x-cloak class="mb-4" style="margin-top: 16px;">
                                    <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1 overflow-hidden mb-1">
                                        <div class="bg-orange-500 h-1 rounded-full animate-progress-indefinite"></div>
                                    </div>
                                    <p class="text-[10px] text-center text-orange-600 font-bold uppercase tracking-wider">Mengunggah...</p>
                                </div>

                                {{-- Modal Footer Buttons --}}
                                <div class="tugas-modal-footer">
                                    <button type="button" @click="closeSubmitModal()" class="tugas-btn-batal">Batal</button>
                                    <button type="submit" class="tugas-btn-kirim" :disabled="!file || uploading">
                                        Kirim Tugas
                                    </button>
                                </div>
                            </form>
                        </div>
                    </template>
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
    </div>
</div>

@push('scripts')
<script>
function studentDetailModals() {
    return {
        openSubmit: false, 
        openAppeal: false,
        submitId: null, 
        submitTitle: '', 
        submitDescription: '',
        submitDeadline: '',
        submitLocked: false, 
        submitTunggakan: 0,
        isSubmitted: false,
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
            type: 'success', // success, error, info
            message: ''
        },

        showNotification(type, message) {
            this.notification.type = type;
            this.notification.message = message;
            this.notification.show = true;
        },
        
        openSubmitModal(id, title, locked, count, submission = null, description = '', deadline = '') {
            this.submitId = id; 
            this.submitTitle = title; 
            this.submitLocked = locked; 
            this.submitTunggakan = count;
            this.isSubmitted = !!submission;
            this.submissionData = submission;
            this.submitDescription = description;
            this.submitDeadline = deadline;
            this.needsReload = false;
            this.file = null;
            this.fileInfo = { name: '', size: '', icon: '' };
            this.isDragging = false;
            this.uploading = false;
            this.openSubmit = true;
            document.body.style.overflow = 'hidden';
        },
        closeSubmitModal() {
            this.openSubmit = false;
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
            if (ext === 'zip') return 'fa-file-archive text-amber-500';
            return 'fa-file text-slate-400';
        },
        formatBytes(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },
        handleFileSelect(e) {
            const files = e.target.files || e.dataTransfer.files;
            if (files.length > 0) {
                const selectedFile = files[0];
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/x-zip-compressed'];
                const maxSize = 10 * 1024 * 1024;
                
                if (!allowedTypes.includes(selectedFile.type)) {
                    this.showNotification('error', 'Format file tidak didukung. Gunakan PDF, DOC, DOCX, atau ZIP.');
                    return;
                }
                if (selectedFile.size > maxSize) {
                    this.showNotification('error', 'Ukuran file terlalu besar. Maksimal 10MB.');
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
            // Get file from $refs to be safe as requested
            const selectedFile = this.$refs.fileInput.files[0] || this.file;
            
            if (!selectedFile || this.uploading) return;

            this.uploading = true;
            const formData = new FormData(this.$refs.submitFormEl);
            
            // Explicitly append/set file from refs or state
            formData.set('file', selectedFile);

            try {
                const response = await fetch(this.$refs.submitFormEl.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                console.log('Submission response status:', response.status);
                const result = await response.json();
                console.log('Submission result:', result);

                if (response.ok && result.success) {
                    this.isSubmitted = true;
                    this.submissionData = result.submission;
                    this.needsReload = true;
                    
                    // Show success feedback
                    this.showNotification('success', result.message || 'Tugas berhasil dikumpulkan!');
                } else {
                    // Handle validation errors (422) or other failures
                    let errorMsg = result.message || 'Terjadi kesalahan saat mengunggah.';
                    if (result.errors) {
                        errorMsg = Object.values(result.errors).flat().join('<br>');
                    }
                    this.showNotification('error', errorMsg);
                }
            } catch (error) {
                console.error('Upload error:', error);
                this.showNotification('error', 'Terjadi kesalahan jaringan atau server. Pastikan ukuran file tidak melebihi batas.');
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
/* Native File Upload logic replaced Google Picker */
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
.tugas-btn-submit { display:inline-flex; align-items:center; gap:5px; padding:6px 14px; border:1px solid #f97316; border-radius:8px; background:#fff7ed; color:#f97316; font-size:12px; font-weight:600; cursor:pointer; transition:all 0.15s; font-family:inherit; }
.tugas-btn-submit:hover { background:#f97316; color:#fff; }

.tugas-submitted-btn {
    display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border: 1px solid #10b981; border-radius: 8px;
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
.tugas-modal-backdrop { position:fixed; inset:0; background:rgba(15,23,42,0.5); backdrop-filter:blur(4px); }
.tugas-modal-panel { position:relative; width:100%; max-width:600px; }
.tugas-modal-content { background:#fff; border-radius:16px; border:1px solid #f1f5f9; box-shadow:0 20px 60px rgba(0,0,0,0.12); overflow:hidden; }
.dark .tugas-modal-content { background:#0f172a; border-color:#1e293b; }
.tugas-modal-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-bottom:1px solid #f1f5f9; }
.dark .tugas-modal-header { border-color:#1e293b; }
.tugas-modal-header__title { font-size:18px; font-weight:700; color:#1e293b; margin:0; }
.dark .tugas-modal-header__title { color:#f1f5f9; }
.tugas-modal-close { width:32px; height:32px; border-radius:50%; border:none; background:#f1f5f9; color:#64748b; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.15s; }
.tugas-modal-close:hover { background:#e2e8f0; color:#1e293b; }
.dark .tugas-modal-close { background:#1e293b; color:#94a3b8; }
.dark .tugas-modal-close:hover { background:#334155; color:#f1f5f9; }
.tugas-modal-body { padding:24px; }

/* Locked Box */
.tugas-locked-box { border:1px solid #fecaca; border-radius:12px; padding:20px; background:#fef2f2; }
.tugas-locked-box__header { display:flex; align-items:center; gap:8px; font-weight:700; color:#dc2626; font-size:14px; margin-bottom:8px; }
.tugas-locked-box__desc { font-size:13px; color:#7f1d1d; margin-bottom:16px; }

/* Redesigned Info Card */
.tugas-info-card { background:#fafbfc; border:1px solid #f1f5f9; border-radius:12px; padding:16px; margin-bottom:20px; }
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
.tugas-form-label { font-size:13.5px; font-weight:600; color:#475569; margin-bottom:8px; display:block; }
.dark .tugas-form-label { color:#cbd5e1; }

/* Redesigned Drop Zone */
.tugas-redesign-drop { cursor:pointer; border:2px dashed #3b82f6; border-radius:12px; padding:28px; text-align:center; transition:all 0.15s ease; background:#eff6ff; }
.dark .tugas-redesign-drop { border-color:#3b82f6; background:#1e293b/20; }
.tugas-redesign-drop:hover, .tugas-redesign-drop--dragging { border-color:#2563eb; background:#dbeafe; }
.tugas-redesign-drop__icon { font-size:32px; color:#3b82f6; margin-bottom:8px; }
.tugas-redesign-drop__text { font-size:13.5px; font-weight:700; color:#2563eb; }
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
.tugas-redesign-textarea { width:100%; min-height:80px; padding:12px; border-radius:8px; border:1px solid #cbd5e1; font-family:inherit; font-size:13px; outline:none; transition:all 0.15s; background:#fff; color:#1e293b; }
.dark .tugas-redesign-textarea { background:#0f172a; border-color:#334155; color:#f1f5f9; }
.tugas-redesign-textarea::placeholder { color:#94a3b8; }
.tugas-redesign-textarea:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59, 130, 246, 0.1); }

/* Modal Footer */
.tugas-modal-footer { display:flex; justify-content:space-between; align-items:center; margin-top:24px; padding-top:16px; border-top:1px solid #f1f5f9; }
.dark .tugas-modal-footer { border-color:#1e293b; }
.tugas-btn-batal { background:#fff; border:1px solid #cbd5e1; color:#475569; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.15s; font-family:inherit; }
.tugas-btn-batal:hover { background:#f8fafc; border-color:#94a3b8; color:#1e293b; }
.dark .tugas-btn-batal { background:#1e293b; border-color:#334155; color:#cbd5e1; }
.dark .tugas-btn-batal:hover { background:#334155; color:#fff; }
.tugas-btn-kirim { background:#d95726; border:none; color:#fff; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.15s; font-family:inherit; display:inline-flex; align-items:center; justify-content:center; }
.tugas-btn-kirim:hover:not(:disabled) { background:#c2471d; }
.tugas-btn-kirim:disabled { opacity:0.5; cursor:not-allowed; }

.tugas-submit-form { display:flex; flex-direction:column; }
.tugas-btn-appeal { margin-left:12px; padding:4px 12px; border-radius:6px; background:#ef4444; color:#fff; font-size:11px; font-weight:700; border:none; cursor:pointer; transition:all 0.15s; }
.tugas-btn-appeal:hover { background:#dc2626; }

/* Table Locking */
.tugas-tr--locked { background:#f8fafc; opacity:0.8; }
.tugas-tr--locked .tugas-td:not(.tugas-td--center) { filter:blur(0.5px); }
.tugas-lock-icon { color:#94a3b8; font-size:16px; }

/* Status Badges */
.tugas-status-badge--active { background:#f0f9ff; color:#0369a1; border:1px solid #bae6fd; }
.tugas-status-badge--wait { background:#f8fafc; color:#64748b; border:1px solid #e2e8f0; }
.tugas-status-badge--locked { background:#f1f5f9; color:#94a3b8; }

/* Appeal Form */
.tugas-label { display:block; font-size:13px; font-weight:700; color:#475569; margin-bottom:8px; }
.tugas-textarea { width:100%; min-height:120px; padding:12px; border-radius:10px; border:1px solid #e2e8f0; font-family:inherit; font-size:13.5px; outline:none; transition:all 0.15s; }
.tugas-textarea:focus { border-color:#ef4444; box-shadow:0 0 0 3px rgba(239, 68, 68, 0.1); }
.tugas-modal-hint { font-size:11.5px; color:#64748b; margin:16px 0; line-height:1.5; background:#f8fafc; padding:10px; border-radius:8px; }
.tugas-modal-hint i { color:#3b82f6; margin-right:4px; }

    .animate-progress-indefinite {
        animation: progress-indefinite 1.5s infinite linear;
    }
    @keyframes progress-indefinite {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    [x-cloak] { display:none !important; }
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
.animate-spin-slow { animation: spin-slow 3s linear infinite; }

/* Redesign Locked Banner (matches halaman_detail_tugas_versi_terkena_lock.png) */
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

/* Redesign Locked Action Button (matches table cards) */
.tugas-btn-locked-state {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: #f1f5f9;
    color: #94a3b8;
    border: 1px solid #e2e8f0;
    font-size: 13px;
    font-weight: 600;
    border-radius: 10px;
    cursor: not-allowed;
    pointer-events: none;
}
.dark .tugas-btn-locked-state {
    background: #1e293b;
    border-color: #334155;
    color: #475569;
}
.hidden { display: none !important; }
[x-cloak] { display: none !important; }
</style>
@endpush
@endsection
