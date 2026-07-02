@extends('layouts.app')

@section('title', 'Daftar Pengajuan Banding - ' . $classId)

@section('content')
<div class="tg-wrapper" x-data="classroomAppealsManager()" @keydown.escape.window="showModal = false">
    {{-- Alerts for success/error feedback --}}
    @if(session('success'))
    <div class="tg-alert tg-alert--success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="tg-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="tg-alert bg-rose-50 border border-rose-200 text-rose-700">
        <div class="w-7 h-7 flex-shrink-0 flex items-center justify-center bg-white/50 rounded-lg text-sm"><i class="fas fa-exclamation-circle"></i></div>
        <span class="flex-1">{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="tg-alert__close text-rose-700"><i class="fas fa-times"></i></button>
    </div>
    @endif

    <!-- Breadcrumb & Header -->
    <div class="mb-5 flex items-center gap-2 text-[13px] font-medium text-slate-400">
        <span>Daftar pengajuan banding</span>
        <span class="text-slate-300">/</span>
        <span class="text-[#D65A20] font-bold">{{ $classId }}</span>
    </div>

    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('appeals.index') }}" class="flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700" title="Kembali">
                <i class="fas fa-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100 mb-1">Daftar Pengajuan Banding - {{ $classId }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 m-0">Mata Pelajaran: <strong>{{ $subjectName }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 shadow-sm flex flex-col gap-1">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Menunggu Tinjauan</span>
            <span class="text-3xl font-black text-amber-600">{{ $pendingCount }}</span>
        </div>
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5 shadow-sm flex flex-col gap-1">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Banding Disetujui</span>
            <span class="text-3xl font-black text-emerald-600">{{ $approvedCount }}</span>
        </div>
        <div class="bg-rose-50 border border-rose-200 rounded-2xl p-5 shadow-sm flex flex-col gap-1">
            <span class="text-xs font-bold uppercase tracking-wider text-rose-700">Banding Ditolak</span>
            <span class="text-3xl font-black text-rose-600">{{ $rejectedCount }}</span>
        </div>
    </div>

    <!-- Filters & Table Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl overflow-hidden shadow-[0_1px_4px_rgba(0,0,0,0.04)]">
        <!-- Search & Filter Bar -->
        <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex justify-between items-end flex-wrap gap-4">
            <div>
                <h2 class="text-[17px] font-bold text-slate-800 dark:text-slate-100 mb-1">Daftar Permohonan</h2>
                <p class="text-[13px] text-slate-500 m-0">Kelola dan tinjau pengajuan banding siswa di kelas ini.</p>
            </div>
            <div class="flex gap-3 items-center flex-wrap">
                <select class="px-3.5 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-[13px] text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 focus:border-orange-500 focus:ring-[3px] focus:ring-orange-500/20 outline-none cursor-pointer transition-all" x-model="filterStatus" @change="applyFilters()">
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="approved">Disetujui</option>
                    <option value="rejected">Ditolak</option>
                </select>
                <div class="relative">
                    <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[13px] pointer-events-none"></i>
                    <input type="text" class="pl-9 pr-3.5 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-[13px] text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 outline-none w-[220px] transition-all focus:border-orange-500 focus:ring-[3px] focus:ring-orange-500/20 placeholder-slate-400" placeholder="Cari nama siswa..." x-model="searchQuery" @input.debounce.500ms="applyFilters()">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse border border-slate-300">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700" style="width: 52px">NO</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">NAMA SISWA</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">TUGAS TERLAMBAT</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">ALASAN SINGKAT & WAKTU</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700" style="width: 140px">STATUS</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700" style="width: 100px">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appeals as $i => $appeal)
                    @php
                        // Fetch the oldest overdue task for this student & subject context
                        $oldestOverdue = \App\Models\Tugas::tugas()
                            ->where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
                            ->where('status', 'aktif')
                            ->where('deadline', '<', $appeal->created_at)
                            ->whereDoesntHave('submissions', function($q) use ($appeal) {
                                $q->where('siswa_id', $appeal->siswa_id);
                            })
                            ->orderBy('deadline', 'asc')
                            ->first();

                        $taskTitle = $oldestOverdue ? $oldestOverdue->title : ($appeal->assignment->title ?? 'Semua Tugas');
                        $daysOverdue = 0;
                        if ($oldestOverdue) {
                            $daysOverdue = max(1, $oldestOverdue->deadline->diffInDays($appeal->created_at));
                        } elseif ($appeal->assignment && $appeal->assignment->deadline) {
                            $daysOverdue = max(1, $appeal->assignment->deadline->diffInDays($appeal->created_at));
                        }

                        // Short reason
                        $shortReason = Str::limit($appeal->alasan, 40);

                        // Relative or formatted time
                        $timeFormatted = $appeal->created_at->isToday() 
                            ? 'Hari ini, ' . $appeal->created_at->format('H:i') . ' WIB'
                            : ($appeal->created_at->isYesterday()
                                ? 'Kemarin, ' . $appeal->created_at->format('H:i') . ' WIB'
                                : $appeal->created_at->format('d M Y, H:i') . ' WIB');
                    @endphp
                    <tr class="tg-row hover:bg-yellow-50 transition border-b border-slate-200">
                        <td class="px-4 py-2 border border-slate-300 text-slate-600 text-center">{{ $appeals->firstItem() + $i }}</td>
                        <td class="px-4 py-2 border border-slate-300">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 font-bold flex items-center justify-center flex-shrink-0 text-xs">
                                    {{ strtoupper(substr($appeal->student->name, 0, 1)) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800 whitespace-nowrap">{{ $appeal->student->name }}</span>
                                    <span class="text-xs text-slate-500">NIS: {{ $appeal->student->nis }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-2 border border-slate-300">
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-700 whitespace-nowrap">{{ $taskTitle }}</span>
                                @if($daysOverdue > 0)
                                <span class="text-xs font-bold text-rose-500">Telat {{ $daysOverdue }} Hari</span>
                                @else
                                <span class="text-xs text-slate-400">Batas waktu terlewati</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-2 border border-slate-300">
                            <div class="flex flex-col">
                                <span class="italic text-slate-600">"{{ $shortReason }}"</span>
                                <span class="text-xs text-slate-400 mt-1"><i class="far fa-clock mr-1"></i>{{ $timeFormatted }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-center whitespace-nowrap">
                            @if($appeal->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-600 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                                </span>
                            @elseif($appeal->status == 'approved')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Disetujui
                                </span>
                            @elseif($appeal->status == 'rejected')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-600 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-center whitespace-nowrap">
                            @if($appeal->status == 'pending')
                                <button type="button" @click="openReview({{ $appeal->id }})" class="border border-[#D65A20] text-[#D65A20] hover:bg-[#D65A20] hover:text-white rounded px-3 py-1 text-xs font-bold transition inline-block text-center whitespace-nowrap" title="Tinjau Banding">
                                    Tinjau
                                </button>
                            @else
                                <button type="button" @click="openReview({{ $appeal->id }})" class="border border-slate-300 text-slate-600 hover:bg-slate-100 rounded px-3 py-1 text-xs font-bold transition inline-block text-center whitespace-nowrap" title="Lihat Detail">
                                    Detail
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center border border-slate-300 text-slate-500">
                            <i class="fas fa-clipboard-question text-slate-300 mb-3 text-4xl block"></i>
                            <p class="font-semibold text-sm">Tidak ada pengajuan banding di kelas ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-slate-200 bg-white">
            {{ $appeals->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- Review Modal (Tinjau Pengajuan Banding) -->
    <div x-show="showModal" class="appeal-modal-overlay" x-cloak>
        <div class="appeal-modal-backdrop" @click="showModal = false" x-show="showModal" x-transition.opacity></div>
        <div class="appeal-modal-panel" x-show="showModal"
             x-transition:enter="transition duration-200 ease-out"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition duration-150 ease-in"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2">
            
            <template x-if="loading">
                <div class="appeal-modal-loading" style="padding: 40px; text-align: center; color: #64748b;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 8px;"></i>
                    <p style="margin: 0; font-size: 13px; font-weight: 600;">Memuat data pengajuan...</p>
                </div>
            </template>

            <template x-if="!loading && modalData">
                <div class="appeal-modal-content">
                    <div class="appeal-modal-header">
                        <h2 class="appeal-modal-header__title">Tinjau Pengajuan Banding</h2>
                        <button @click="showModal = false" class="appeal-modal-close"><i class="fas fa-times"></i></button>
                    </div>
                    
                    <div class="appeal-modal-body">
                        <div class="modal-body-wrapper">
                            {{-- Left Column: Form and Details --}}
                            <div class="modal-split-left">
                                <!-- Student & Task Info Box -->
                                <div class="modal-info-box">
                                    <div class="modal-info-box__left">
                                        <div class="modal-student-avatar" x-text="((modalData.appeal.student?.nama || modalData.appeal.student?.name || '').charAt(0) || '?').toUpperCase()"></div>
                                        <div>
                                            <h4 class="modal-student-name" x-text="modalData.appeal.student?.nama || modalData.appeal.student?.name || 'Siswa'"></h4>
                                            <p class="modal-student-meta" x-text="'NIS: ' + (modalData.appeal.student?.nis || '-') + ' • Kelas ' + '{{ $classId }}'"></p>
                                        </div>
                                    </div>
                                    <div class="modal-info-box__right">
                                        <h4 class="modal-task-title" x-text="modalData.overdue && modalData.overdue.length > 0 ? (modalData.overdue[0].title || modalData.overdue[0].judul) : (modalData.appeal?.assignment ? (modalData.appeal.assignment.title || modalData.appeal.assignment.judul) : 'Semua Tugas')"></h4>
                                        <p class="modal-task-overdue" x-text="getOverdueText()"></p>
                                    </div>
                                </div>

                                <!-- Reason -->
                                <div class="modal-field-group">
                                    <label class="modal-label">Alasan Keterlambatan</label>
                                    <div class="modal-reason-box">
                                        <p style="margin: 0; font-style: italic; color: #334155;" x-text="'&quot;' + (modalData.appeal?.alasan || modalData.appeal?.reason || 'Tidak ada alasan') + '&quot;'"></p>
                                    </div>
                                </div>

                                <!-- Proof Attachment (If exists) -->
                                <div class="modal-field-group" x-show="modalData.appeal?.bukti_pendukung || modalData.appeal?.attachment">
                                    <label class="modal-label">Bukti Lampiran</label>
                                    <div class="modal-proof-box">
                                        <div class="modal-proof-box__left">
                                            <div class="pdf-icon-box"><i class="fas" :class="getFileIconClass(modalData.appeal?.bukti_pendukung || modalData.appeal?.attachment)"></i></div>
                                            <div>
                                                <span class="proof-filename" x-text="getFilename(modalData.appeal?.bukti_pendukung || modalData.appeal?.attachment)"></span>
                                                <span class="proof-filesize" x-text="modalData.appeal?.bukti_pendukung_size || 'Dokumen Pendukung'"></span>
                                            </div>
                                        </div>
                                        <a :href="'/storage/' + (modalData.appeal?.bukti_pendukung || modalData.appeal?.attachment)" target="_blank" class="link-view-proof">Lihat Surat</a>
                                    </div>
                                </div>

                                <!-- Teacher Response (Tanggapan Guru) -->
                                <div class="modal-field-group">
                                    <label class="modal-label">Tanggapan Guru (Opsional)</label>
                                    <template x-if="['pending', 'ditinjau'].includes(modalData.appeal?.status)">
                                        <textarea x-model="tanggapanGuru" class="modal-textarea" placeholder="Ketik catatan atau pesan untuk siswa di sini..."></textarea>
                                    </template>
                                    <template x-if="!['pending', 'ditinjau'].includes(modalData.appeal?.status)">
                                        <div class="modal-reason-box" style="background: #fafbfc; border-color: #f1f5f9;">
                                            <p style="margin: 0; color: #475569;" x-text="modalData.appeal?.tanggapan_guru || '(Tidak ada tanggapan)'"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="appeal-modal-footer">
                        <!-- Action Forms for Pending appeals -->
                        <template x-if="['pending', 'ditinjau'].includes(modalData.appeal?.status)">
                            <div class="flex gap-3 justify-end w-full" style="display: flex; gap: 12px; justify-content: flex-end; width: 100%;">
                                {{-- Reject Form --}}
                                <form :action="`/teacher/submission-appeals/${modalData.appeal?.id}/reject`" method="POST">
                                    @csrf
                                    <input type="hidden" name="tanggapan_guru" :value="tanggapanGuru">
                                    <button type="submit" class="btn-modal-action btn-modal-action--reject">
                                        Tolak Banding
                                    </button>
                                </form>
                                {{-- Approve Form --}}
                                <form :action="`/teacher/submission-appeals/${modalData.appeal?.id}/approve`" method="POST">
                                    @csrf
                                    <input type="hidden" name="tanggapan_guru" :value="tanggapanGuru">
                                    <input type="hidden" name="duration" value="48">
                                    <button type="submit" class="btn-modal-action btn-modal-action--approve">
                                        Setujui Banding
                                    </button>
                                </form>
                            </div>
                        </template>
                        <template x-if="!['pending', 'ditinjau'].includes(modalData.appeal?.status)">
                            <div class="flex justify-end w-full" style="display: flex; justify-content: flex-end; width: 100%;">
                                <button @click="showModal = false" class="btn-modal-action btn-modal-action--close">Tutup</button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<style>


/* Modal Peninjauan Styling */
.appeal-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.appeal-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(4px);
}

.appeal-modal-panel {
    position: relative;
    width: 100%;
    max-width: 650px;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.dark .appeal-modal-panel {
    background: #0f172a;
    border: 1px solid #1e293b;
}

.appeal-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-bottom: 1px solid #f1f5f9;
}

.dark .appeal-modal-header {
    border-bottom-color: #1e293b;
}

.appeal-modal-header__title {
    font-size: 16.5px;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
}

.dark .appeal-modal-header__title {
    color: #f1f5f9;
}

.appeal-modal-close {
    background: none;
    border: none;
    color: #94a3b8;
    font-size: 18px;
    cursor: pointer;
}

.appeal-modal-close:hover {
    color: #64748b;
}

.appeal-modal-body {
    padding: 24px;
    max-height: 480px;
    overflow-y: auto;
}

/* Modal Info Box profile */
.modal-info-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    background: #f8fafc;
    border: 1px solid #f1f5f9;
    border-radius: 14px;
    margin-bottom: 20px;
}

.dark .modal-info-box {
    background: #1e293b;
    border-color: #334155;
}

.modal-info-box__left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.modal-student-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #dbeafe;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    font-weight: 800;
}

.modal-student-name {
    margin: 0 0 2px 0;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
}

.dark .modal-student-name {
    color: #f1f5f9;
}

.modal-student-meta {
    margin: 0;
    font-size: 11px;
    color: #64748b;
}

.modal-info-box__right {
    text-align: right;
}

.modal-task-title {
    margin: 0 0 2px 0;
    font-size: 13.5px;
    font-weight: 700;
    color: #334155;
}

.dark .modal-task-title {
    color: #cbd5e1;
}

.modal-task-overdue {
    margin: 0;
    font-size: 11.5px;
    color: #ef4444;
    font-weight: 700;
}

/* Modal fields */
.modal-field-group {
    margin-bottom: 20px;
}

.modal-label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 8px;
}

.dark .modal-label {
    color: #cbd5e1;
}

.modal-reason-box {
    width: 100%;
    padding: 14px 18px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    font-size: 13.5px;
    line-height: 1.6;
}

.dark .modal-reason-box {
    background: #1e293b;
    border-color: #334155;
}

/* Attached proof box */
.modal-proof-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 18px;
    background: #fff;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
}

.dark .modal-proof-box {
    background: #0f172a;
    border-color: #334155;
}

.modal-proof-box__left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.pdf-icon-box {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    background: #fef2f2;
    color: #ef4444;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.proof-filename {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #334155;
}

.dark .proof-filename {
    color: #cbd5e1;
}

.proof-filesize {
    display: block;
    font-size: 10px;
    color: #94a3b8;
}

.link-view-proof {
    font-size: 12.5px;
    font-weight: 700;
    color: #2563eb;
    text-decoration: none;
}

.link-view-proof:hover {
    text-decoration: underline;
}

.modal-textarea {
    width: 100%;
    min-height: 90px;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background: #fff;
    font-size: 13.5px;
    outline: none;
    transition: all 0.2s;
}

.modal-textarea:focus {
    border-color: #D65A20;
    box-shadow: 0 0 0 2px rgba(214, 90, 32, 0.1);
}

.dark .modal-textarea {
    background: #1e293b;
    border-color: #334155;
    color: #f1f5f9;
}

/* Modal Footer & Action Buttons */
.appeal-modal-footer {
    padding: 18px 24px;
    background: #fafbfc;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
}

.dark .appeal-modal-footer {
    background: #0f172a;
    border-top-color: #1e293b;
}

.btn-modal-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    border: none;
}

.btn-modal-action--reject {
    background: #fff;
    color: #ef4444;
    border: 1.5px solid #fca5a5;
}

.btn-modal-action--reject:hover {
    background: #fef2f2;
    border-color: #ef4444;
}

.dark .btn-modal-action--reject {
    background: #1e293b;
    color: #f87171;
    border-color: #7f1d1d;
}

.dark .btn-modal-action--reject:hover {
    background: #2d1616;
    border-color: #ef4444;
}

.btn-modal-action--approve {
    background: #10b981;
    color: #fff;
}

.btn-modal-action--approve:hover {
    background: #059669;
}

.btn-modal-action--close {
    background: #e2e8f0;
    color: #475569;
}

.btn-modal-action--close:hover {
    background: #cbd5e1;
}

.dark .btn-modal-action--close {
    background: #334155;
    color: #cbd5e1;
}

.dark .btn-modal-action--close:hover {
    background: #475569;
}

/* Modal Split Layout for File Preview */
.appeal-modal-panel {
    transition: max-width 0.25s ease-in-out;
}
.appeal-modal-panel--split {
    max-width: 1200px !important;
}
.appeal-modal-body--split {
    max-height: 680px !important;
}
.modal-body-wrapper {
    display: flex;
    flex-direction: column;
}
.modal-body-wrapper--split {
    flex-direction: row;
    gap: 24px;
}
.modal-split-left {
    flex: 1.2;
    min-width: 0;
}
.modal-split-right {
    flex: 1.1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    border-left: 1px solid #f1f5f9;
    padding-left: 24px;
}
.dark .modal-split-right {
    border-left-color: #1e293b;
}
.preview-title {
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.dark .preview-title {
    color: #cbd5e1;
}
.preview-frame-wrap {
    flex: 1;
    min-height: 430px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-body-wrapper--split .preview-frame-wrap {
    min-height: 580px;
}
.dark .preview-frame-wrap {
    background: #0f172a;
    border-color: #334155;
}
</style>

<script>
function classroomAppealsManager() {
    return {
        showModal: false,
        loading: false,
        modalData: null,
        tanggapanGuru: '',
        showPreview: false,
        searchQuery: new URLSearchParams(window.location.search).get('search') || '',
        filterStatus: new URLSearchParams(window.location.search).get('status') || '',

        applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.set('search', this.searchQuery);
            url.searchParams.set('status', this.filterStatus);
            url.searchParams.set('page', 1);
            window.location.href = url.href;
        },

        async openReview(appealId) {
            this.showModal = true;
            this.loading = true;
            this.tanggapanGuru = '';
            this.showPreview = false;
            try {
                const response = await fetch(`/teacher/submission-appeals/${appealId}/overdue`);
                this.modalData = await response.json();
                if (this.modalData && this.modalData.appeal) {
                    this.tanggapanGuru = this.modalData.appeal.tanggapan_guru || '';
                }
            } catch (error) {
                alert('Gagal memuat data pengajuan.');
                this.showModal = false;
            } finally {
                this.loading = false;
            }
        },

        getOverdueText() {
            if (!this.modalData || !this.modalData.appeal) return '';
            
            // Calculate overdue time based on oldest overdue assignment or assignment context
            const appealDate = new Date(this.modalData.appeal.created_at || new Date());
            const overdueTask = (this.modalData.overdue && this.modalData.overdue.length > 0)
                ? this.modalData.overdue[0] 
                : this.modalData.appeal.assignment;

            if (!overdueTask) return 'Batas waktu terlewati';
            const deadlineVal = overdueTask.deadline || overdueTask.due_date;
            if (!deadlineVal) return 'Batas waktu terlewati';

            const deadlineDate = new Date(deadlineVal);
            const diffTime = Math.abs(appealDate - deadlineDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            return `Telat ${diffDays} Hari`;
        },

        getFilename(path) {
            if (!path) return 'dokumen.pdf';
            return path.split('/').pop();
        },

        getFileIconClass(filename) {
            if (!filename) return 'fa-file-pdf';
            const ext = filename.split('.').pop().toLowerCase();
            if (ext === 'pdf') return 'fa-file-pdf';
            if (['jpg', 'jpeg', 'png'].includes(ext)) return 'fa-file-image';
            return 'fa-file-alt';
        },

        getFileExtension(path) {
            if (!path) return '';
            return path.split('.').pop().toLowerCase();
        }
    }
}
</script>
@endsection
