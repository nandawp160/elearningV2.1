@extends('layouts.app')

@section('title', 'Tugas - ' . ($subject->course->name ?? $subject->nama ?? '') . ' - ' . ($subject->classRoom->name ?? ''))

@section('content')
<style>
.tg-wrapper { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; position: relative; }
[x-cloak] { display: none !important; }

/* Alerts */
.tg-alert { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 13.5px; font-weight: 500; }
.tg-alert--success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
.tg-alert--danger { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
.tg-alert__icon { flex-shrink: 0; width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.5); font-size: 13px; }
.tg-alert__text { flex: 1; }
.tg-alert__close { background: none; border: none; cursor: pointer; color: inherit; opacity: 0.5; padding: 4px; }

/* Topbar */
.tgd-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
.tgd-back { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #e2e8f0; border-radius: 10px; background: #fff; color: #64748b; font-size: 13px; font-weight: 500; text-decoration: none; transition: all 0.15s; }
.tgd-back:hover { border-color: #f97316; color: #f97316; }
.dark .tgd-back { background: #1e293b; border-color: #334155; color: #94a3b8; }

.tgd-btn-new { display: inline-flex; align-items: center; gap: 8px; padding: 9px 20px; border: none; border-radius: 10px; background: #f97316; color: #fff; font-size: 13.5px; font-weight: 600; cursor: pointer; transition: background 0.15s; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2); }
.tgd-btn-new:hover { background: #ea580c; }

/* Header */
.tgd-subject-header { margin-bottom: 24px; }
.tgd-subject-title { font-size: 22px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0; }
.dark .tgd-subject-title { color: #f1f5f9; }
.tgd-subject-meta { display: flex; align-items: center; gap: 10px; font-size: 13.5px; color: #64748b; flex-wrap: wrap; }
.tgd-subject-meta i { font-size: 12px; color: #94a3b8; }
.tgd-subject-meta strong { color: #334155; }
.dark .tgd-subject-meta strong { color: #e2e8f0; }
.tgd-sep { color: #cbd5e1; }

/* Card & Table */
.tg-card { background: #fff; border: 1px solid #f1f5f9; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
.dark .tg-card { background: #0f172a; border-color: #1e293b; }

.tgd-toolbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 12px; }
.dark .tgd-toolbar { border-color: #1e293b; }
.tgd-toolbar__left { display: flex; align-items: center; gap: 10px; }
.tgd-show-label { font-size: 13px; color: #64748b; }

.tg-select { padding: 7px 30px 7px 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; color: #475569; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 10px center; appearance: none; outline: none; cursor: pointer; transition: border 0.15s; }
.tg-select:focus { border-color: #f97316; }
.dark .tg-select { background-color: #1e293b; border-color: #334155; color: #e2e8f0; }

.tg-search { position: relative; }
.tg-search__icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 12px; pointer-events: none; }
.tg-search__input { padding: 8px 12px 8px 34px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; color: #334155; background: #fff; outline: none; width: 220px; transition: border 0.15s; }
.tg-search__input::placeholder { color: #94a3b8; }
.tg-search__input:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.08); }
.dark .tg-search__input { background: #1e293b; border-color: #334155; color: #e2e8f0; }

.tg-table-wrap { overflow-x: auto; }
.tg-table { width: 100%; border-collapse: collapse; }
.tg-thead-row { background: #fafbfc; }
.dark .tg-thead-row { background: #1e293b; }
.tg-th { padding: 14px 18px; text-align: left; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #94a3b8; border-bottom: 1px solid #f1f5f9; white-space: nowrap; }
.dark .tg-th { border-color: #1e293b; color: #64748b; }
.tg-th--center { text-align: center; }

.tg-row:nth-child(even) { background: #fafbfc; }
.dark .tg-row:nth-child(even) { background: #0c1526; }
.tg-row:nth-child(odd) { background: #fff; }
.dark .tg-row:nth-child(odd) { background: #0f172a; }
.tg-row { transition: background 0.12s; }
.tg-row:hover { background: #fff4ee !important; }
.dark .tg-row:hover { background: #1e293b !important; }
.tg-row:not(:last-child) .tg-td { border-bottom: 1px solid #f8fafc; }
.dark .tg-row:not(:last-child) .tg-td { border-bottom-color: #1e293b; }

.tg-td { padding: 15px 18px; font-size: 13.5px; color: #334155; vertical-align: middle; }
.dark .tg-td { color: #cbd5e1; }
.tg-td--num { color: #94a3b8; font-weight: 500; width: 48px; }
.tg-td--center { text-align: center; }
.tg-td--empty { padding: 60px 20px; text-align: center; }

.tgd-code { display: inline-block; padding: 3px 10px; border-radius: 6px; background: #f8fafc; border: 1px solid #e2e8f0; font-size: 11.5px; font-weight: 600; color: #64748b; font-family: monospace; }
.dark .tgd-code { background: #1e293b; border-color: #334155; color: #94a3b8; }

.tgd-detail { display: flex; flex-direction: column; gap: 2px; max-width: 260px; }
.tgd-detail__title { font-weight: 700; color: #1e293b; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.dark .tgd-detail__title { color: #f1f5f9; }
.tgd-detail__desc { font-size: 12px; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.tgd-date { display: flex; flex-direction: column; gap: 2px; }
.tgd-date--ok { font-size: 13.5px; color: #334155; font-weight: 600; white-space: nowrap; }
.tgd-date--over { font-size: 13.5px; color: #ef4444; font-weight: 700; white-space: nowrap; }
.tgd-date__time { font-size: 12px; color: #94a3b8; }

.tgd-method { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10.5px; font-weight: 700; letter-spacing: 0.05em; }
.tgd-method--essay, .tgd-method--online { background: #eff6ff; color: #2563eb; }
.tgd-method--offline { background: #f0fdf4; color: #16a34a; }

.tgd-soal { display: flex; flex-direction: column; gap: 3px; }
.tgd-dl-btn { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 700; color: #f97316; text-decoration: none; }
.tgd-no-soal { font-size: 12px; color: #cbd5e1; }
.tgd-soal__type { font-size: 11px; color: #94a3b8; }

.tg-collect { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.tg-collect__label { font-weight: 700; font-size: 12.5px; color: #f97316; }
.tg-collect__sep { color: #cbd5e1; font-size: 12px; }
.tg-collect__total { font-size: 12.5px; color: #94a3b8; }
.tg-collect__bar { width: 100%; height: 4px; background: #f1f5f9; border-radius: 2px; overflow: hidden; flex-basis: 100%; margin-top: 4px; }
.tg-collect__fill { height: 100%; background: #16a34a; border-radius: 2px; transition: width 0.4s; }

.tgd-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; }
.tgd-badge--aktif { background: #ecfdf5; color: #059669; }
.tgd-badge--ditutup { background: #fef2f2; color: #dc2626; }
.tgd-badge--draft { background: #fffbeb; color: #d97706; }

.tgd-actions { display: flex; justify-content: center; gap: 6px; }
.tgd-icon-btn { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 10px; border: 1px solid #e2e8f0; background: #fff; color: #64748b; font-size: 13px; text-decoration: none; cursor: pointer; transition: all 0.15s; }
.tgd-icon-btn:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; transform: translateY(-1px); }
.tgd-icon-btn--edit:hover { background: #fffbeb; border-color: #fde68a; color: #d97706; }
.tgd-icon-btn--del:hover { background: #fef2f2; border-color: #fecaca; color: #dc2626; }
.dark .tgd-icon-btn { background: #1e293b; border-color: #334155; color: #94a3b8; }

.tg-table-footer { display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 12px; }
.tg-info { font-size: 13px; color: #94a3b8; }
.tg-pagination { display: flex; gap: 4px; }
.tg-page-btn { min-width: 32px; height: 32px; padding: 0 10px; border: 1px solid #e2e8f0; border-radius: 8px; background: #fff; color: #64748b; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.15s; display: inline-flex; align-items: center; justify-content: center; }
.tg-page-btn--active { background: #f97316 !important; border-color: #f97316 !important; color: #fff !important; }
.tg-page-btn:disabled { opacity: 0.35; cursor: not-allowed; }

/* Empty state */
.tg-empty { display: flex; flex-direction: column; align-items: center; gap: 12px; }
.tg-empty__icon { width: 56px; height: 56px; border-radius: 18px; background: #fff7ed; color: #f97316; display: flex; align-items: center; justify-content: center; font-size: 22px; }
.tg-empty__title { font-size: 15px; font-weight: 700; color: #475569; margin: 0; }
.tg-empty__desc { font-size: 13.5px; color: #94a3b8; margin: 0; text-align: center; max-width: 300px; }

/* Modal Styles */
.tgd-modal-overlay { position: fixed; inset: 0; z-index: 1000; display: flex; align-items: center; justify-content: center; padding: 16px; }
.tgd-modal-backdrop { position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(6px); }
.tgd-modal-panel { position: relative; width: 100%; max-width: 680px; z-index: 1001; }
.tgd-modal-content { background: #fff; border-radius: 20px; border: 1px solid #f1f5f9; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); overflow: hidden; max-height: 90vh; display: flex; flex-direction: column; }
.dark .tgd-modal-content { background: #0f172a; border-color: #1e293b; }

.tgd-modal-header { display: flex; align-items: center; gap: 14px; padding: 20px 24px; border-bottom: 1px solid #f1f5f9; flex-shrink: 0; }
.tgd-modal__icon { width: 44px; height: 44px; border-radius: 14px; background: #fff7ed; color: #f97316; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.tgd-modal__title { font-size: 16px; font-weight: 800; color: #1e293b; margin: 0; }
.tgd-modal__sub { font-size: 13px; color: #94a3b8; margin: 2px 0 0 0; }
.tgd-modal__close { margin-left: auto; width: 34px; height: 34px; border-radius: 10px; border: none; background: transparent; color: #94a3b8; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.15s; }
.tgd-modal__close:hover { background: #f1f5f9; color: #1e293b; }

.tgd-modal__body { padding: 24px; overflow-y: auto; }
.tgd-form-grid { display: grid; grid-template-cols: repeat(2, 1fr); gap: 20px; }
.tgd-form-group--full { grid-column: span 2; }
.tgd-label { display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px; }
.tgd-input { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #334155; background: #fff; outline: none; transition: all 0.15s; font-family: inherit; }
.tgd-input:focus { border-color: #f97316; box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1); }
textarea.tgd-input { resize: vertical; min-height: 100px; }

.tgd-file-wrapper { position: relative; border: 2px dashed #e2e8f0; border-radius: 12px; padding: 24px; text-align: center; transition: all 0.15s; }
.tgd-file-wrapper:hover { border-color: #f97316; background: #fffbf5; }
.tgd-file-input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
.tgd-file-dummy { display: flex; flex-direction: column; align-items: center; gap: 8px; color: #94a3b8; }
.tgd-file-dummy i { font-size: 24px; color: #cbd5e1; }
.tgd-file-dummy span { font-size: 13px; font-weight: 600; }

.tgd-modal__footer { display: flex; justify-content: flex-end; gap: 10px; padding: 18px 24px; border-top: 1px solid #f1f5f9; background: #fafbfc; flex-shrink: 0; }
.tgd-btn-outline { padding: 10px 20px; border: 1.5px solid #e2e8f0; border-radius: 10px; background: #fff; color: #64748b; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.15s; }
.tgd-btn-outline:hover { border-color: #cbd5e1; color: #1e293b; background: #f8fafc; }
.tgd-btn-primary { padding: 10px 24px; border: none; border-radius: 10px; background: #f97316; color: #fff; font-size: 14px; font-weight: 700; cursor: pointer; transition: background 0.15s; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2); }
.tgd-btn-primary:hover { background: #ea580c; }

/* Premium Design System for Tambah Tugas Modal */
.select-premium {
    width: 100%;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1.5px solid #cbd5e1;
    background-color: #fff;
    color: #1e293b;
    font-size: 14px;
    font-weight: 500;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 16px center;
    background-repeat: no-repeat;
    background-size: 20px;
}
.select-premium:focus {
    border-color: #D65A20;
    box-shadow: 0 0 0 3px rgba(214, 90, 32, 0.15);
}
.select-premium:disabled {
    background-color: #f1f5f9;
    cursor: not-allowed;
    color: #94a3b8;
}
.input-premium {
    width: 100%;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1.5px solid #cbd5e1;
    background-color: #fff;
    color: #1e293b;
    font-size: 14px;
    font-weight: 500;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.input-premium:focus {
    border-color: #D65A20;
    box-shadow: 0 0 0 3px rgba(214, 90, 32, 0.15);
}
.dropzone-premium {
    border: 2px dashed #cbd5e1;
    border-radius: 16px;
    padding: 24px 20px;
    cursor: pointer;
    background-color: #f8fafc;
    transition: border-color 0.2s, background-color 0.2s, border-style 0.2s;
}
.dropzone-premium:not(.locked):hover {
    border-color: #D65A20;
    background-color: rgba(214, 90, 32, 0.02);
}
.btn-batal {
    padding: 12px 32px;
    border-radius: 30px;
    border: 1.5px solid #cbd5e1;
    background-color: #fff;
    color: #64748b;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s, border-color 0.2s;
}
.btn-batal:hover {
    background-color: #f1f5f9;
    border-color: #94a3b8;
}
.btn-simpan {
    padding: 12px 32px;
    border-radius: 30px;
    border: none;
    background-color: #D65A20;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s, box-shadow 0.2s;
}
.btn-simpan:hover {
    background-color: #c24e18;
    box-shadow: 0 4px 12px rgba(214, 90, 32, 0.2);
}
</style>
<div class="tg-wrapper" x-data="teacherDetailModals()" @keydown.escape.window="closeCreateModal()">

    {{-- Success/Error Alerts --}}
    @if(session('success'))
    <div class="tg-alert tg-alert--success">
        <div class="tg-alert__icon"><i class="fas fa-check-circle"></i></div>
        <span class="tg-alert__text">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="tg-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif

    @if($errors->any())
    <div class="tg-alert tg-alert--danger" x-init="openCreateModal()">
        <div class="tg-alert__icon"><i class="fas fa-exclamation-circle"></i></div>
        <span class="tg-alert__text">Terdapat kesalahan pada input. Silakan periksa kembali form.</span>
        <button onclick="this.parentElement.remove()" class="tg-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif

    {{-- Top Navigation & Action --}}
    <div class="tgd-topbar">
        <a href="{{ route('assignments.index') }}" class="tgd-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengampuan
        </a>
        <div class="flex items-center gap-2 flex-wrap">
            <button type="button" class="tgd-btn-new" style="background-color: #4f46e5; color: white;" @click="openSslModal()">
                <i class="fas fa-shield-alt"></i>
                <span>Aturan SSL: {{ $effectiveSslThreshold }} Tunggakan · {{ $sslThresholdSource === 'TEACHER_OVERRIDE' ? 'Custom Kelas' : 'Default Sekolah' }}</span>
            </button>
            <a href="{{ route('assignments.teacher.rekap', ['subject' => $subject->id, 'class_name' => $subject->classRoom ? $subject->classRoom->name : null]) }}" class="tgd-btn-new" style="background-color: #f59e0b; color: white;">
                <i class="fas fa-table"></i> Lihat Rekap Nilai
            </a>
            <button type="button" class="tgd-btn-new" @click="openCreateModal()">
                <i class="fas fa-plus"></i> Buat Tugas Baru
            </button>
        </div>
    </div>

    {{-- Subject Header Info --}}
    <div class="tgd-subject-header">
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="flex items-center space-x-2 text-[13px] text-slate-500">
                <li><a href="{{ route('assignments.index') }}" class="hover:text-orange-500 transition font-medium">Tugas</a></li>
                <li><span class="text-slate-300">></span></li>
                <li class="font-bold text-slate-600">{{ $subject->classRoom->name ?? '' }}</li>
                <li><span class="text-slate-300">></span></li>
                <li class="font-bold text-slate-700">{{ $subject->course->name ?? $subject->nama ?? '' }}</li>
            </ol>
        </nav>
        <h1 class="tgd-subject-title" style="font-size: 24px; margin-bottom:4px;">Workspace Tugas</h1>
        <div class="tgd-subject-meta" style="margin-bottom: 20px;">
            <span><i class="fas fa-user-tie"></i> Guru: <strong>{{ $subject->teacher->name ?? '-' }}</strong></span>
            <span class="tgd-sep">•</span>
            <span><i class="fas fa-calendar-alt"></i> TA: <strong>{{ $subject->classRoom->academic_year ?? \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026') }}</strong></span>
        </div>

        <!-- Metrik Ringkas -->
        <div class="flex items-center gap-6 mb-2 px-1 mt-2">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tugas</span>
                <span class="text-base font-extrabold text-slate-800">{{ $totalTugas ?? 0 }}</span>
            </div>
            <div class="w-px h-8 bg-slate-200"></div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Sudah Dikumpulkan</span>
                <span class="text-base font-extrabold text-emerald-600">{{ $totalSubmissions ?? 0 }} <span class="text-sm font-semibold text-slate-400">/ {{ $totalSlots ?? 0 }}</span></span>
            </div>
            <div class="w-px h-8 bg-slate-200"></div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Perlu Dinilai</span>
                <span class="text-base font-extrabold text-rose-600">{{ $perluDinilai ?? 0 }}</span>
            </div>
        </div>
    </div>

    {{-- Main Content Table --}}
    <div class="tg-card">
        <div class="tgd-toolbar">
            <div class="tgd-toolbar__left">
                <label class="tgd-show-label">Tampilkan</label>
                <select id="perPageSel" class="tg-select" style="width:75px">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span class="tgd-show-label">entri</span>
            </div>
            <div class="tg-search">
                <i class="fas fa-search tg-search__icon"></i>
                <input type="text" id="detailSearch" class="tg-search__input" placeholder="Cari tugas...">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse border border-slate-300" id="detailTable">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700" style="width:48px">NO</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700" style="width:80px">KODE</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">DETAIL TUGAS</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">TANGGAL & WAKTU</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">METODE</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">SOAL & INFORMASI</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">PENGUMPULAN</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">STATUS</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">AKSI</th>
                    </tr>
                </thead>
                <tbody id="detailBody">
                    @forelse($assignments as $i => $a)
                    @php
                        $isPast   = $a->due_date->isPast();
                        $subCount = $a->submissions->count();
                        $pct      = $studentCount > 0 ? min(100, ($subCount / $studentCount) * 100) : 0;
                        $isActive = $a->status === 'active' && !$isPast;
                    @endphp
                    <tr class="tg-row hover:bg-yellow-50 transition border-b border-slate-200" data-search="{{ strtolower($a->title.' '.$a->description) }}">
                        <td class="px-4 py-2 border border-slate-300 text-slate-600 text-center tgd-rownum">{{ $i+1 }}</td>
                        <td class="px-4 py-2 border border-slate-300 text-slate-800 text-center whitespace-nowrap">
                            TGS-{{ str_pad($a->id, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-slate-800">
                            <div class="font-bold text-slate-800">{{ $a->title }}</div>
                            <div class="text-xs text-slate-500">{{ Str::limit(strip_tags($a->description), 45) }}</div>
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-slate-800 whitespace-nowrap">
                            <div class="{{ $isPast ? 'text-rose-600 font-semibold' : 'text-slate-800 font-semibold' }}">{{ $a->due_date->format('d M Y') }}</div>
                            <div class="text-xs text-slate-500">{{ $a->due_date->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-slate-800 text-center whitespace-nowrap">
                            @php
                                $typeConfig = $a->getConfig();
                                $isAv = $a->isAudiovisual();
                                $avSub = $a->mode_audiovisual == 'audio_file' ? 'Audio' : ($a->mode_audiovisual == 'video_url' ? 'Video' : 'Audio/Video');
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold {{ $typeConfig['badge_class'] ?? 'bg-slate-100 text-slate-700' }}">
                                <i class="fas {{ $typeConfig['icon'] ?? 'fa-file' }} text-[11px]"></i>
                                {{ $typeConfig['label'] ?? 'Dokumen' }}
                                @if($isAv)
                                    <span class="text-[10px] opacity-80">({{ $avSub }})</span>
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-slate-800 whitespace-nowrap">
                            @if($a->attachment)
                            <a href="{{ $a->attachment_url }}" target="_blank" class="text-[#D65A20] hover:underline font-semibold text-xs inline-flex items-center gap-1">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                            @else
                            <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-slate-800 text-center whitespace-nowrap">
                            {{ $subCount }} / {{ $studentCount }}
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-center whitespace-nowrap">
                            @if($isActive)
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded text-xs font-bold">Aktif</span>
                            @elseif($a->status === 'inactive')
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold">Draft</span>
                            @else
                                <span class="bg-rose-100 text-rose-700 px-2 py-1 rounded text-xs font-bold">Ditutup</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-4 text-lg">
                                <a href="{{ route('assignments.show', ['assignment' => $a->id, 'class_name' => request('class_name') ?? ($subject->classRoom ? $subject->classRoom->name : '')]) }}" class="flex flex-col items-center gap-1 text-blue-500 hover:text-blue-700 transition group" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                    <span class="text-[9px] font-bold tracking-wider group-hover:underline">LIHAT</span>
                                </a>
                                <a href="{{ route('assignments.edit', ['assignment' => $a->id, 'class_name' => request('class_name') ?? ($subject->classRoom ? $subject->classRoom->name : '')]) }}" class="flex flex-col items-center gap-1 text-amber-500 hover:text-amber-700 transition group" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                    <span class="text-[9px] font-bold tracking-wider group-hover:underline">EDIT</span>
                                </a>
                                <form action="{{ route('assignments.destroy', ['assignment' => $a->id, 'class_name' => request('class_name') ?? ($subject->classRoom ? $subject->classRoom->name : '')]) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')" class="m-0">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="flex flex-col items-center gap-1 text-rose-500 hover:text-rose-700 transition group bg-transparent border-none p-0 cursor-pointer" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                        <span class="text-[9px] font-bold tracking-wider group-hover:underline">HAPUS</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center border border-slate-300 text-slate-500">
                            <p class="font-semibold text-sm">Belum ada tugas untuk mata pelajaran ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tg-table-footer">
            <span class="tg-info" id="detailInfo"></span>
            <div class="tg-pagination" id="detailPag"></div>
        </div>
    </div>

    {{-- Create Modal Overlay (Alpine.js) --}}
    <div
        x-show="openCreate"
        x-cloak
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
        role="dialog"
        aria-modal="true"
        aria-label="Form Tambah Tugas">

        {{-- Backdrop --}}
        <div
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
            x-show="openCreate"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="closeCreateModal()"
            aria-hidden="true">
        </div>

        {{-- Modal Panel --}}
        <div
            class="relative w-full max-w-4xl my-auto"
            x-show="openCreate"
            x-transition:enter="transition duration-250 ease-out"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="closeCreateModal()">

            <div class="bg-white dark:bg-slate-900 rounded-[30px] shadow-2xl border border-slate-200/70 dark:border-slate-800/70 overflow-hidden">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-10 py-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah Tugas</h2>
                    <button
                        @click="closeCreateModal()"
                        type="button"
                        class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:text-slate-800 dark:hover:text-white transition"
                        title="Tutup">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                {{-- Modal Body — the Form --}}
                <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Form inputs mapping & compatibility --}}
                    <input type="hidden" name="subject_id" :value="selectedSubjectId" required />
                    <input type="hidden" name="class_name" :value="selectedClass" />
                    <input type="hidden" name="max_score" value="100" />
                    <input type="hidden" name="type" value="essay" />

                    <div class="px-10 pb-8 space-y-6">

                        {{-- Baris 1: Kelas & Mata Pelajaran --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="modal_kelas" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Kelas
                                </label>
                                <select id="modal_kelas" x-model="selectedClass" @change="onClassChange()"
                                    class="select-premium @error('subject_id') border-rose-500 @enderror" disabled required>
                                    <option value="" disabled selected>Pilih kelas...</option>
                                    @foreach($subjects->pluck('classRoom.name')->filter()->unique()->sort() as $c)
                                        <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="modal_mapel" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Mata Pelajaran
                                </label>
                                <select id="modal_mapel" x-model="selectedSubjectName" @change="onSubjectChange()"
                                    class="select-premium @error('subject_id') border-rose-500 @enderror" disabled required>
                                    <option value="" disabled selected>Pilih mata pelajaran...</option>
                                    @foreach($subjects as $subj)
                                        <option value="{{ $subj->course->name ?? $subj->nama }}">{{ $subj->course->name ?? $subj->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('subject_id')
                        <p class="text-rose-500 text-xs mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                        @enderror

                        {{-- Baris 2: Jenis & Format Pengumpulan Tugas --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Format Tugas yang Dikumpulkan Siswa <span class="text-rose-500">*</span>
                            </label>
                            <input type="hidden" name="tipe_pengumpulan" :value="tipePengumpulan" />
                            <input type="hidden" name="mode_audiovisual" :value="tipePengumpulan === 'audiovisual' ? modeAudiovisual : ''" />

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                {{-- 1. Media Visual --}}
                                <div @click="tipePengumpulan = 'visual'"
                                    class="relative p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-3 select-none"
                                    :class="tipePengumpulan === 'visual' ? 'border-purple-500 bg-purple-50/40 dark:bg-purple-950/20 shadow-sm ring-1 ring-purple-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-800/60'">
                                    <div x-show="tipePengumpulan === 'visual'" x-cloak class="absolute top-2.5 right-2.5 w-4 h-4 rounded-full bg-purple-600 text-white flex items-center justify-center shadow-sm">
                                        <i class="fas fa-check text-[9px]"></i>
                                    </div>
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-colors"
                                        :class="tipePengumpulan === 'visual' ? 'bg-purple-600 text-white' : 'bg-purple-100 dark:bg-purple-950/50 text-purple-600'">
                                        <i class="fas fa-palette text-sm"></i>
                                    </div>
                                    <div class="min-w-0 pr-3">
                                        <div class="text-xs font-bold text-slate-800 dark:text-white">Media Visual</div>
                                        <div class="text-[11px] text-slate-500 line-clamp-1">Poster, sketsa, foto karya</div>
                                        <div class="text-[10px] font-semibold text-purple-600 dark:text-purple-400 mt-1">.jpg, .png, .pdf (20MB)</div>
                                    </div>
                                </div>

                                {{-- 2. Berkas Dokumen --}}
                                <div @click="tipePengumpulan = 'dokumen'"
                                    class="relative p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-3 select-none"
                                    :class="tipePengumpulan === 'dokumen' ? 'border-blue-500 bg-blue-50/40 dark:bg-blue-950/20 shadow-sm ring-1 ring-blue-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-800/60'">
                                    <div x-show="tipePengumpulan === 'dokumen'" x-cloak class="absolute top-2.5 right-2.5 w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                        <i class="fas fa-check text-[9px]"></i>
                                    </div>
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-colors"
                                        :class="tipePengumpulan === 'dokumen' ? 'bg-blue-600 text-white' : 'bg-blue-100 dark:bg-blue-950/50 text-blue-600'">
                                        <i class="fas fa-file-lines text-sm"></i>
                                    </div>
                                    <div class="min-w-0 pr-3">
                                        <div class="text-xs font-bold text-slate-800 dark:text-white">Berkas Dokumen</div>
                                        <div class="text-[11px] text-slate-500 line-clamp-1">Makalah, esai, laporan</div>
                                        <div class="text-[10px] font-semibold text-blue-600 dark:text-blue-400 mt-1">.pdf, .docx (20MB)</div>
                                    </div>
                                </div>

                                {{-- 3. Multimedia Audiovisual --}}
                                <div @click="tipePengumpulan = 'audiovisual'"
                                    class="relative p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-3 select-none"
                                    :class="tipePengumpulan === 'audiovisual' ? 'border-rose-500 bg-rose-50/40 dark:bg-rose-950/20 shadow-sm ring-1 ring-rose-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-800/60'">
                                    <div x-show="tipePengumpulan === 'audiovisual'" x-cloak class="absolute top-2.5 right-2.5 w-4 h-4 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-sm">
                                        <i class="fas fa-check text-[9px]"></i>
                                    </div>
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-colors"
                                        :class="tipePengumpulan === 'audiovisual' ? 'bg-rose-600 text-white' : 'bg-rose-100 dark:bg-rose-950/50 text-rose-600'">
                                        <i class="fas fa-video text-sm"></i>
                                    </div>
                                    <div class="min-w-0 pr-3">
                                        <div class="text-xs font-bold text-slate-800 dark:text-white">Multimedia Audiovisual</div>
                                        <div class="text-[11px] text-slate-500 line-clamp-1">Audio / Video streaming</div>
                                        <div class="text-[10px] font-semibold text-rose-600 dark:text-rose-400 mt-1">Audio .mp3 / URL Video</div>
                                    </div>
                                </div>

                                {{-- 4. Tautan Karya Eksternal --}}
                                <div @click="tipePengumpulan = 'tautan'"
                                    class="relative p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-3 select-none"
                                    :class="tipePengumpulan === 'tautan' ? 'border-emerald-500 bg-emerald-50/40 dark:bg-emerald-950/20 shadow-sm ring-1 ring-emerald-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-800/60'">
                                    <div x-show="tipePengumpulan === 'tautan'" x-cloak class="absolute top-2.5 right-2.5 w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-sm">
                                        <i class="fas fa-check text-[9px]"></i>
                                    </div>
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-colors"
                                        :class="tipePengumpulan === 'tautan' ? 'bg-emerald-600 text-white' : 'bg-emerald-100 dark:bg-emerald-950/50 text-emerald-600'">
                                        <i class="fas fa-link text-sm"></i>
                                    </div>
                                    <div class="min-w-0 pr-3">
                                        <div class="text-xs font-bold text-slate-800 dark:text-white">Tautan Karya Eksternal</div>
                                        <div class="text-[11px] text-slate-500 line-clamp-1">Canva, Figma, GitHub, Drive</div>
                                        <div class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 mt-1">Tautan HTTPS Proyek</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Sub-Opsi Audiovisual --}}
                            <div x-show="tipePengumpulan === 'audiovisual'" x-cloak class="mt-4 p-4 rounded-xl bg-rose-50/60 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-900/40 transition-all">
                                <label class="block text-xs font-bold text-rose-900 dark:text-rose-300 mb-2">
                                    <i class="fas fa-sliders-h mr-1"></i> Jenis Pengumpulan Audiovisual yang Diizinkan:
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                    <label @click="modeAudiovisual = 'audio_file'"
                                        class="flex items-center gap-2 p-2.5 rounded-lg border text-xs font-medium cursor-pointer transition-colors"
                                        :class="modeAudiovisual === 'audio_file' ? 'bg-white dark:bg-slate-800 border-rose-500 text-rose-700 dark:text-rose-300 shadow-sm font-bold' : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-rose-100/50'">
                                        <input type="radio" name="_sub_av" value="audio_file" class="hidden" x-model="modeAudiovisual" />
                                        <i class="fas fa-microphone" :class="modeAudiovisual === 'audio_file' ? 'text-rose-500' : 'text-slate-400'"></i>
                                        <span>Rekaman Audio Saja (.mp3, .m4a)</span>
                                    </label>
                                    <label @click="modeAudiovisual = 'video_url'"
                                        class="flex items-center gap-2 p-2.5 rounded-lg border text-xs font-medium cursor-pointer transition-colors"
                                        :class="modeAudiovisual === 'video_url' ? 'bg-white dark:bg-slate-800 border-rose-500 text-rose-700 dark:text-rose-300 shadow-sm font-bold' : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-rose-100/50'">
                                        <input type="radio" name="_sub_av" value="video_url" class="hidden" x-model="modeAudiovisual" />
                                        <i class="fab fa-youtube" :class="modeAudiovisual === 'video_url' ? 'text-red-500' : 'text-slate-400'"></i>
                                        <span>Tautan Video Saja (YouTube/Drive)</span>
                                    </label>
                                    <label @click="modeAudiovisual = 'either'"
                                        class="flex items-center gap-2 p-2.5 rounded-lg border text-xs font-medium cursor-pointer transition-colors"
                                        :class="modeAudiovisual === 'either' ? 'bg-white dark:bg-slate-800 border-rose-500 text-rose-700 dark:text-rose-300 shadow-sm font-bold' : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-rose-100/50'">
                                        <input type="radio" name="_sub_av" value="either" class="hidden" x-model="modeAudiovisual" />
                                        <i class="fas fa-random" :class="modeAudiovisual === 'either' ? 'text-rose-500' : 'text-slate-400'"></i>
                                        <span>Audio atau Video Bebas</span>
                                    </label>
                                </div>
                                <p class="text-[11px] text-rose-700/80 dark:text-rose-300/80 mt-2">
                                    <i class="fas fa-info-circle mr-1"></i> Video berbasis tautan tidak menggunakan ruang penyimpanan media pada server aplikasi.
                                </p>
                            </div>
                        </div>

                        {{-- Baris 3: Judul Tugas --}}
                        <div>
                            <label for="modal_title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Judul Tugas
                            </label>
                            <input type="text" name="title" id="modal_title"
                                value="{{ old('title') }}"
                                placeholder="Masukkan judul tugas"
                                class="input-premium @error('title') border-rose-500 @enderror" required />
                            @error('title')
                            <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Baris 4: Deskripsi Tugas --}}
                        <div>
                            <label for="modal_description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Deskripsi Tugas <span class="text-slate-400 font-normal">(opsional)</span>
                            </label>
                            <textarea name="description" id="modal_description" rows="4"
                                placeholder="Masukkan deskripsi tugas"
                                style="height: 120px;"
                                class="input-premium py-3 resize-none @error('description') border-rose-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Baris 5: Deadline & Lampiran Instruksi Guru --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="modal_due_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Deadline
                                </label>
                                <input type="datetime-local" name="due_date" id="modal_due_date"
                                    value="{{ old('due_date') }}"
                                    class="input-premium @error('due_date') border-rose-500 @enderror" required />
                                @error('due_date')
                                <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center justify-between">
                                    <span>
                                        <span x-text="attachmentMeta.title">Lampiran Instruksi Guru</span>
                                        <span class="text-slate-400 font-normal">(opsional)</span>
                                    </span>
                                </label>

                                {{-- Toggle Pilihan Khusus Audiovisual Video: Berkas MP4 vs Tautan Video --}}
                                <div x-show="tipePengumpulan === 'audiovisual' && modeAudiovisual !== 'audio_file'" x-cloak class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800/80 p-1 rounded-xl mb-3 border border-slate-200/60 dark:border-slate-700/60">
                                    <button type="button" @click="teacherAttachmentMode = 'file'"
                                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-semibold transition-all flex items-center justify-center gap-1.5"
                                        :class="teacherAttachmentMode === 'file' ? 'bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'">
                                        <i class="fas fa-file-video"></i>
                                        <span>Unggah Video (.mp4) / Berkas</span>
                                    </button>
                                    <button type="button" @click="teacherAttachmentMode = 'link'"
                                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-semibold transition-all flex items-center justify-center gap-1.5"
                                        :class="teacherAttachmentMode === 'link' ? 'bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'">
                                        <i class="fab fa-youtube text-red-500"></i>
                                        <span>Tautan Video (YouTube/Drive)</span>
                                    </button>
                                </div>

                                {{-- Opsi 1: File Dropzone (Default atau saat mode 'file') --}}
                                <div x-show="tipePengumpulan !== 'audiovisual' || modeAudiovisual === 'audio_file' || teacherAttachmentMode === 'file'">
                                    <div
                                        @dragover.prevent="!createFileName && (isDraggingCreate = true)"
                                        @dragleave.prevent="isDraggingCreate = false"
                                        @drop.prevent="isDraggingCreate = false; !createFileName && handleCreateFileDrop($event)"
                                        @click="!createFileName && $refs.createFileInput.click()"
                                        class="dropzone-premium relative transition-all duration-200"
                                        :class="{
                                            'locked border-emerald-500 dark:border-emerald-600 bg-emerald-50/30 dark:bg-emerald-950/20': createFileName,
                                            'border-orange-500 bg-orange-50/30': isDraggingCreate && !createFileName,
                                            'border-slate-300 dark:border-slate-700': !createFileName && !isDraggingCreate
                                        }"
                                        :style="createFileName ? 'border-style: solid !important; cursor: not-allowed !important;' : ''"
                                    >
                                        <!-- Clear File Button -->
                                        <template x-if="createFileName">
                                            <button
                                                type="button"
                                                @click.stop="
                                                    $refs.createFileInput.value = '';
                                                    createFileName = '';
                                                "
                                                class="absolute top-3 right-3 w-8 h-8 rounded-full bg-rose-50 dark:bg-rose-950/50 hover:bg-rose-100 dark:hover:bg-rose-900/50 text-rose-500 dark:text-rose-400 flex items-center justify-center transition-all duration-200 shadow-sm z-10"
                                                title="Hapus File"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </template>

                                        <div class="flex flex-col items-center justify-center text-center">
                                            <div 
                                                class="w-10 h-10 rounded-full flex items-center justify-center mb-2 shadow-sm transition-all duration-300"
                                                :class="createFileName ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400'"
                                            >
                                                <i class="fas text-lg" :class="createFileName ? 'fa-check-circle text-emerald-500' : attachmentMeta.icon"></i>
                                            </div>
                                            <p 
                                                class="text-sm font-semibold transition-colors duration-200 max-w-[90%] truncate"
                                                :class="createFileName ? 'text-emerald-700 dark:text-emerald-400' : 'text-slate-700 dark:text-slate-300'"
                                                x-text="createFileName || attachmentMeta.placeholder"
                                            ></p>
                                            <p 
                                                class="text-[10px] mt-1 transition-colors duration-200"
                                                :class="createFileName ? 'text-emerald-500 font-semibold' : 'text-slate-400'"
                                                x-text="createFileName ? 'Berkas siap diunggah' : attachmentMeta.hint"
                                            ></p>
                                        </div>
                                        <input type="file" name="attachment" x-ref="createFileInput" class="hidden"
                                            :accept="attachmentMeta.accept"
                                            @change="createFileName = $el.files[0] ? $el.files[0].name : ''" />
                                    </div>
                                </div>

                                {{-- Opsi 2: Input Tautan Video Guru (Saat mode 'link') --}}
                                <div x-show="tipePengumpulan === 'audiovisual' && modeAudiovisual !== 'audio_file' && teacherAttachmentMode === 'link'" x-cloak class="space-y-3">
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-rose-500 pointer-events-none">
                                            <i class="fab fa-youtube text-sm"></i>
                                        </span>
                                        <input type="url" name="attachment_link" x-model="teacherAttachmentLink" @input="updateTeacherVideoPreview()"
                                            placeholder="https://www.youtube.com/watch?v=... atau https://drive.google.com/..."
                                            class="input-premium pl-10 text-xs @error('attachment_link') border-rose-500 @enderror" />
                                    </div>
                                    <template x-if="teacherVideoEmbed">
                                        <div class="aspect-video w-full rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-black shadow-inner">
                                            <iframe :src="teacherVideoEmbed" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </template>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                                        <i class="fas fa-info-circle text-rose-500"></i>
                                        <span>Video dapat berupa tautan YouTube (Unlisted/Public) atau Google Drive.</span>
                                    </p>
                                </div>

                                @error('attachment')
                                <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                                @enderror
                                @error('attachment_link')
                                <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Baris 5: Status Tugas --}}
                        <div>
                            <label for="modal_status" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Status Tugas
                            </label>
                            <div class="relative flex bg-slate-100 dark:bg-slate-800 p-1 rounded-xl w-full max-w-md">
                                <div class="absolute top-1 bottom-1 w-[calc(50%-4px)] rounded-lg shadow-sm transition-all duration-300 ease-in-out" 
                                     :class="status === 'active' ? 'left-1 bg-[#D65A20] border border-[#c24e18]' : 'left-[calc(50%+2px)] bg-white dark:bg-slate-700 border border-slate-200/50 dark:border-slate-600'"></div>
                                
                                <label class="flex-1 text-center cursor-pointer relative z-10 py-2.5 text-[13px] font-bold transition-colors duration-200" 
                                       :class="status === 'active' ? 'text-white' : 'text-slate-500 hover:text-slate-700'">
                                    <input type="radio" name="status" value="active" class="hidden" x-model="status" />
                                    <i class="fas fa-globe mr-1"></i> Publikasikan
                                </label>
                                
                                <label class="flex-1 text-center cursor-pointer relative z-10 py-2.5 text-[13px] font-bold transition-colors duration-200" 
                                       :class="status === 'inactive' ? 'text-slate-800 dark:text-white' : 'text-slate-500 hover:text-slate-700'">
                                    <input type="radio" name="status" value="inactive" class="hidden" x-model="status" />
                                    <i class="fas fa-file-alt mr-1"></i> Simpan Draft
                                </label>
                            </div>
                            <p class="text-[12px] text-slate-500 mt-2" x-show="status === 'active'"><i class="fas fa-info-circle text-[#D65A20] mr-1"></i> Siswa dapat melihat dan mengerjakan tugas ini.</p>
                            <p class="text-[12px] text-slate-500 mt-2" x-show="status === 'inactive'" x-cloak><i class="fas fa-info-circle text-slate-400 mr-1"></i> Tugas disembunyikan. Hanya Anda yang dapat melihatnya.</p>

                            @error('status')
                            <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex items-center justify-end gap-3 px-10 py-6 border-t border-slate-100 dark:border-slate-800">
                        <button
                            @click="closeCreateModal()"
                            type="button"
                            class="btn-batal">
                            Batal
                        </button>
                        <button type="submit" class="btn-simpan">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- MODAL PENGATURAN AMBANG BATAS SSL GURU                           --}}
    {{-- ================================================================ --}}
    <div
        x-show="openSsl"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-ssl-title"
        role="dialog"
        aria-modal="true">

        {{-- Backdrop --}}
        <div
            x-show="openSsl"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
            @click="closeSslModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div
                x-show="openSsl"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-slate-100 dark:border-slate-800">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-8 py-6 border-b border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800 dark:text-white" id="modal-ssl-title">
                                Aturan Ambang Batas SSL
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5 font-medium">
                                {{ $subject->course->name ?? $subject->nama }} · Kelas {{ $subject->classRoom->name ?? '' }}
                            </p>
                        </div>
                    </div>
                    <button
                        @click="closeSslModal()"
                        type="button"
                        class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <i class="fas fa-times text-base"></i>
                    </button>
                </div>

                {{-- Modal Body Form --}}
                <form @submit.prevent="submitSslForm()">
                    <div class="p-8 space-y-6 max-h-[75vh] overflow-y-auto">

                        {{-- 1. Pilihan Mode --}}
                        <div class="space-y-3">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                Kebijakan Ambang Batas Penguncian Tugas:
                            </label>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                {{-- Mode Default Sekolah --}}
                                <label
                                    @click="sslMode = 'default'"
                                    :class="sslMode === 'default' ? 'border-indigo-500 bg-indigo-50/50 dark:bg-indigo-950/30 text-indigo-900 dark:text-indigo-200 ring-2 ring-indigo-500/20' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-50'"
                                    class="p-4 rounded-2xl border cursor-pointer transition flex flex-col justify-between space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold flex items-center gap-2">
                                            <i class="fas fa-school text-indigo-500"></i> Default Sekolah
                                        </span>
                                        <input type="radio" name="ssl_mode_radio" value="default" :checked="sslMode === 'default'" class="text-indigo-600 focus:ring-indigo-500">
                                    </div>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                        Mengikuti standar global: <strong>{{ $schoolDefaultSsl }} Tunggakan</strong>
                                    </p>
                                </label>

                                {{-- Mode Custom Guru --}}
                                <label
                                    @click="sslMode = 'custom'"
                                    :class="sslMode === 'custom' ? 'border-indigo-500 bg-indigo-50/50 dark:bg-indigo-950/30 text-indigo-900 dark:text-indigo-200 ring-2 ring-indigo-500/20' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-50'"
                                    class="p-4 rounded-2xl border cursor-pointer transition flex flex-col justify-between space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold flex items-center gap-2">
                                            <i class="fas fa-sliders-h text-indigo-500"></i> Custom Guru
                                        </span>
                                        <input type="radio" name="ssl_mode_radio" value="custom" :checked="sslMode === 'custom'" class="text-indigo-600 focus:ring-indigo-500">
                                    </div>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                        Atur batas toleransi khusus (1 – 10 tunggakan)
                                    </p>
                                </label>
                            </div>
                        </div>

                        {{-- 2. Presets & Angka Custom (Hanya tampil jika mode custom) --}}
                        <div x-show="sslMode === 'custom'" x-transition class="p-5 bg-slate-50 dark:bg-slate-800/40 rounded-2xl border border-slate-200 dark:border-slate-700 space-y-4">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                Pilih Batas Toleransi Tunggakan:
                            </label>

                            {{-- Preset Cards --}}
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                <button
                                    type="button"
                                    @click="sslThreshold = 1"
                                    :class="sslThreshold == 1 ? 'bg-rose-500 text-white font-bold shadow-md shadow-rose-500/20' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:border-rose-400'"
                                    class="py-3 px-2 rounded-xl text-center transition">
                                    <span class="block text-sm font-extrabold">1 Tugas</span>
                                    <span class="block text-[9px] uppercase tracking-wider mt-0.5 opacity-90">Sangat Ketat</span>
                                </button>

                                <button
                                    type="button"
                                    @click="sslThreshold = 2"
                                    :class="sslThreshold == 2 ? 'bg-amber-500 text-white font-bold shadow-md shadow-amber-500/20' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:border-amber-400'"
                                    class="py-3 px-2 rounded-xl text-center transition">
                                    <span class="block text-sm font-extrabold">2 Tugas</span>
                                    <span class="block text-[9px] uppercase tracking-wider mt-0.5 opacity-90">Ketat</span>
                                </button>

                                <button
                                    type="button"
                                    @click="sslThreshold = 3"
                                    :class="sslThreshold == 3 ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-500/20' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:border-indigo-400'"
                                    class="py-3 px-2 rounded-xl text-center transition">
                                    <span class="block text-sm font-extrabold">3 Tugas</span>
                                    <span class="block text-[9px] uppercase tracking-wider mt-0.5 opacity-90">Standar</span>
                                </button>

                                <button
                                    type="button"
                                    @click="sslThreshold = 5"
                                    :class="sslThreshold == 5 ? 'bg-emerald-600 text-white font-bold shadow-md shadow-emerald-500/20' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:border-emerald-400'"
                                    class="py-3 px-2 rounded-xl text-center transition">
                                    <span class="block text-sm font-extrabold">5 Tugas</span>
                                    <span class="block text-[9px] uppercase tracking-wider mt-0.5 opacity-90">Fleksibel</span>
                                </button>
                            </div>

                            {{-- Input Stepper Manual --}}
                            <div class="flex items-center justify-between pt-2 border-t border-slate-200 dark:border-slate-700/60">
                                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">
                                    Atau tentukan angka bebas (1 – 10):
                                </span>
                                <div class="flex items-center gap-2">
                                    <button
                                        type="button"
                                        @click="if(sslThreshold > 1) sslThreshold--"
                                        class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold hover:bg-slate-300 transition flex items-center justify-center">
                                        -
                                    </button>
                                    <input
                                        type="number"
                                        min="1"
                                        max="10"
                                        x-model.number="sslThreshold"
                                        class="w-14 text-center font-bold text-sm py-1 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-100 outline-none focus:border-indigo-500">
                                    <button
                                        type="button"
                                        @click="if(sslThreshold < 10) sslThreshold++"
                                        class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold hover:bg-slate-300 transition flex items-center justify-center">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- 3. Scope Penerapan (Hanya kelas ini vs Semua kelas) --}}
                        <div class="space-y-3 pt-2">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                    Cakupan Penerapan Aturan:
                                </label>
                                <span class="text-[11px] font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/50 px-2 py-0.5 rounded-md">
                                    Crosscheck Sasaran
                                </span>
                            </div>

                            <div class="space-y-2.5">
                                {{-- Option 1: Hanya Kelas Ini --}}
                                <div class="p-3.5 rounded-xl border transition"
                                    :class="!sslApplyAll ? 'border-indigo-500 bg-indigo-50/20 dark:bg-indigo-950/20 ring-1 ring-indigo-500/20' : 'border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/60'">
                                    <label class="flex items-start gap-3 cursor-pointer">
                                        <input type="radio" name="ssl_scope_radio" :value="false" x-model="sslApplyAll" class="mt-0.5 text-indigo-600 focus:ring-indigo-500">
                                        <div class="flex-1">
                                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">
                                                Hanya terapkan pada kelas {{ $subject->classRoom->name ?? '' }}
                                            </span>
                                            <span class="text-[11px] text-slate-500 block mt-0.5">
                                                Kelas lain yang Anda ampu tidak akan mengalami perubahan aturan.
                                            </span>
                                        </div>
                                    </label>
                                </div>

                                {{-- Option 2: Semua Kelas Yang Diampu --}}
                                @if($allTaughtClasses->count() > 1)
                                <div class="p-3.5 rounded-xl border transition"
                                    :class="sslApplyAll ? 'border-indigo-500 bg-indigo-50/30 dark:bg-indigo-950/30 ring-1 ring-indigo-500/30' : 'border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/60'">
                                    <label class="flex items-start gap-3 cursor-pointer">
                                        <input type="radio" name="ssl_scope_radio" :value="true" x-model="sslApplyAll" class="mt-0.5 text-indigo-600 focus:ring-indigo-500">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2 flex-wrap">
                                                <span class="text-xs font-bold text-indigo-900 dark:text-indigo-200 flex items-center gap-1.5">
                                                    <i class="fas fa-layer-group text-indigo-500"></i>
                                                    Terapkan ke SEMUA ({{ $allTaughtClasses->count() }}) kelas pada mapel <u>{{ $subject->course->name ?? $subject->nama }}</u>
                                                </span>
                                            </div>
                                            <div class="mt-1.5 flex items-center justify-between gap-2 flex-wrap">
                                                <span class="text-[11px] text-slate-500 dark:text-slate-400">
                                                    Daftar kelas: <strong class="text-slate-700 dark:text-slate-200">{{ $allTaughtClasses->pluck('kelas.name')->filter()->implode(', ') }}</strong>
                                                </span>
                                                <button
                                                    type="button"
                                                    @click.stop="showAllClassesDetail = !showAllClassesDetail"
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 transition shadow-xs">
                                                    <i class="fas fa-list-check text-[10px]"></i>
                                                    <span x-text="showAllClassesDetail ? 'Tutup Detail Kelas' : 'Lihat Detail Perubahan Kelas ({{ $allTaughtClasses->count() }})'"></span>
                                                    <i class="fas text-[9px] transition-transform duration-200" :class="showAllClassesDetail ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </label>

                                    {{-- Dropdown Detail Crosscheck Kelas --}}
                                    <div
                                        x-show="showAllClassesDetail"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 -translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 -translate-y-1"
                                        x-cloak
                                        class="mt-3 p-3.5 bg-white dark:bg-slate-900 rounded-xl border border-indigo-100 dark:border-indigo-900/60 shadow-xs space-y-2">
                                        <div class="flex items-center justify-between text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider pb-1.5 border-b border-slate-100 dark:border-slate-800">
                                            <span>Kelas & Status Saat Ini</span>
                                            <span class="text-indigo-600 dark:text-indigo-400">Target Perubahan Baru</span>
                                        </div>

                                        <div class="space-y-1.5 max-h-48 overflow-y-auto pr-1">
                                            @foreach($allTaughtClasses as $gkItem)
                                                @php
                                                    $kName = $gkItem->kelas->name ?? '-';
                                                    $curThresh = $gkItem->ssl_threshold;
                                                    $isCurrent = ($subject->classRoom && $gkItem->kelas_id === $subject->classRoom->id);
                                                @endphp
                                                <div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 dark:bg-slate-800/70 border border-slate-200/60 dark:border-slate-700/60 text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-bold text-slate-800 dark:text-white">{{ $kName }}</span>
                                                        @if($isCurrent)
                                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-indigo-100 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300">
                                                                Kelas Ini
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-[11px] text-slate-500">
                                                            @if($curThresh !== null)
                                                                <span class="px-1.5 py-0.5 rounded bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 font-semibold">Custom ({{ $curThresh }})</span>
                                                            @else
                                                                <span class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-semibold">Default ({{ $schoolDefaultSsl }})</span>
                                                            @endif
                                                        </span>
                                                        <i class="fas fa-arrow-right text-[10px] text-indigo-400"></i>
                                                        <span class="font-bold text-indigo-600 dark:text-indigo-400" x-text="sslMode === 'default' ? 'Default ({{ $schoolDefaultSsl }})' : sslThreshold + ' Tugas'"></span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- 4. Info Konsekuensi & Keamanan --}}
                        <div class="p-4 bg-amber-50/80 dark:bg-amber-950/20 rounded-2xl border border-amber-200/80 dark:border-amber-900/40 flex items-start gap-3">
                            <i class="fas fa-info-circle text-amber-600 dark:text-amber-400 text-base mt-0.5 flex-shrink-0"></i>
                            <div class="text-xs text-amber-900 dark:text-amber-200 space-y-1">
                                <p class="font-bold">Konsekuensi Penguncian Tugas Siswa:</p>
                                <p class="leading-relaxed">
                                    Siswa yang memiliki tugas lewat tenggat $\ge$ <span class="font-bold underline" x-text="sslMode === 'default' ? '{{ $schoolDefaultSsl }}' : sslThreshold"></span> tugas akan langsung dikunci otomatis pada mata pelajaran ini hingga siswa menyelesaikan tugas target atau mengajukan banding. Sesi pemulihan aktif tidak akan dibatalkan.
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex items-center justify-end gap-3 px-8 py-5 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                        <button
                            @click="closeSslModal()"
                            type="button"
                            :disabled="sslSaving"
                            class="btn-batal">
                            Batal
                        </button>
                        <button
                            type="submit"
                            :disabled="sslSaving"
                            class="btn-simpan"
                            style="background-color: #4f46e5;">
                            <span x-show="!sslSaving" class="flex items-center gap-2">
                                <i class="fas fa-save"></i> Simpan Pengaturan SSL
                            </span>
                            <span x-show="sslSaving" class="flex items-center gap-2" x-cloak>
                                <i class="fas fa-spinner fa-spin"></i> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function teacherDetailModals() {
    return {
        openCreate: {{ $errors->any() ? 'true' : 'false' }},
        descLen: {{ strlen(old('description', '')) }},
        descContent: @json(old('description', '')),
        attachName: 'Pilih file...',

        // -- Subjects Data --
        subjectsList: [
            @foreach($subjects as $subj)
            {
                id: {{ $subj->id }},
                course_name: "{!! addslashes($subj->course->name ?? $subj->nama) !!}",
                class_name: "{!! addslashes($subj->classRoom->name ?? '') !!}"
            },
            @endforeach
        ],
        selectedClass: "{!! addslashes(old('class_name', request('class_name') ?? ($subject->classRoom ? $subject->classRoom->name : ''))) !!}",
        selectedSubjectName: '',
        selectedSubjectId: "{{ old('subject_id', $subject->id) }}",
        tipePengumpulan: "{{ old('tipe_pengumpulan', 'dokumen') }}",
        modeAudiovisual: "{{ old('mode_audiovisual', 'video_url') }}",
        teacherAttachmentMode: 'file',
        teacherAttachmentLink: "{{ old('attachment_link', '') }}",
        teacherVideoEmbed: '',
        isDraggingCreate: false,
        createFileName: '',
        status: "{{ old('status', 'active') }}",

        get attachmentMeta() {
            switch(this.tipePengumpulan) {
                case 'visual':
                    return {
                        title: 'Lampiran Contoh Visual / Lembar Kerja',
                        placeholder: 'Klik atau drag contoh gambar / sketsa acuan',
                        hint: 'Format: JPG, PNG, JPEG, PDF (Maks. 20 MB)',
                        accept: '.jpg,.jpeg,.png,.pdf',
                        icon: 'fa-palette text-purple-500',
                        color: 'purple',
                        badge: 'Media Visual'
                    };
                case 'audiovisual':
                    if (this.modeAudiovisual === 'audio_file') {
                        return {
                            title: 'Lampiran Audio / Soal Listening Guru',
                            placeholder: 'Klik atau drag rekaman audio / panduan suara',
                            hint: 'Format: MP3, M4A, WAV, PDF (Maks. 20 MB)',
                            accept: '.mp3,.m4a,.wav,.ogg,.pdf',
                            icon: 'fa-microphone text-rose-500',
                            color: 'rose',
                            badge: 'Rekaman Audio'
                        };
                    }
                    return {
                        title: 'Lampiran Video (.mp4) / Naskah Panduan',
                        placeholder: 'Klik atau drag berkas video (.mp4) atau dokumen panduan',
                        hint: 'Format: MP4, PDF, DOCX, ZIP (Maks. 50 MB)',
                        accept: '.mp4,.m4v,.mov,.pdf,.docx,.doc,.mp3,.zip',
                        icon: 'fa-video text-rose-500',
                        color: 'rose',
                        badge: 'Video MP4 / Link'
                    };
                case 'tautan':
                    return {
                        title: 'Lampiran Brief Desain / Panduan Proyek',
                        placeholder: 'Klik atau drag template brief / panduan proyek',
                        hint: 'Format: PDF, DOCX, PNG, ZIP (Maks. 20 MB)',
                        accept: '.pdf,.docx,.doc,.png,.jpg,.zip',
                        icon: 'fa-link text-emerald-500',
                        color: 'emerald',
                        badge: 'Tautan Karya'
                    };
                case 'dokumen':
                default:
                    return {
                        title: 'Lampiran Lembar Soal / Rubrik Dokumen',
                        placeholder: 'Klik atau drag lembar soal / dokumen tugas',
                        hint: 'Format: PDF, DOCX, DOC, PPTX (Maks. 20 MB)',
                        accept: '.pdf,.doc,.docx,.pptx',
                        icon: 'fa-file-lines text-blue-500',
                        color: 'blue',
                        badge: 'Berkas Dokumen'
                    };
            }
        },

        updateTeacherVideoPreview() {
            if (!this.teacherAttachmentLink) {
                this.teacherVideoEmbed = '';
                return;
            }
            const ytMatch = this.teacherAttachmentLink.match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
            if (ytMatch) {
                this.teacherVideoEmbed = 'https://www.youtube-nocookie.com/embed/' + ytMatch[1];
                return;
            }
            const driveMatch = this.teacherAttachmentLink.match(/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/i);
            if (driveMatch) {
                this.teacherVideoEmbed = 'https://drive.google.com/file/d/' + driveMatch[1] + '/preview';
                return;
            }
            this.teacherVideoEmbed = '';
        },

        getUniqueClasses() {
            const classes = this.subjectsList.map(s => s.class_name).filter(Boolean);
            return [...new Set(classes)].sort();
        },

        getSubjectsForClass(className) {
            if (!className) return [];
            return this.subjectsList.filter(s => s.class_name === className);
        },

        onClassChange() {
            this.selectedSubjectName = '';
            this.selectedSubjectId = '';
        },

        onSubjectChange() {
            const match = this.subjectsList.find(s => s.class_name === this.selectedClass && s.course_name === this.selectedSubjectName);
            this.selectedSubjectId = match ? match.id : '';
        },

        handleCreateFileDrop(e) {
            if (this.createFileName) return;
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                this.$refs.createFileInput.files = files;
                this.createFileName = files[0].name;
            }
        },

        openCreateModal() {
            this.openCreate = true;
            document.body.style.overflow = 'hidden';
        },

        closeCreateModal() {
            this.openCreate = false;
            document.body.style.overflow = '';
        },

        init() {
            let match = null;
            
            // Try to match both ID and Class Name (most accurate)
            if (this.selectedSubjectId && this.selectedClass) {
                match = this.subjectsList.find(s => s.id == this.selectedSubjectId && s.class_name == this.selectedClass);
            }
            
            // Fallback to just ID
            if (!match && this.selectedSubjectId) {
                match = this.subjectsList.find(s => s.id == this.selectedSubjectId);
            }
            
            // Fallback to page's subject ID + selectedClass
            if (!match) {
                match = this.subjectsList.find(s => s.id == {{ $subject->id }} && s.class_name == this.selectedClass);
            }

            // Ultimate fallback to just page's subject ID
            if (!match) {
                match = this.subjectsList.find(s => s.id == {{ $subject->id }});
            }
            
            if (match) {
                this.selectedClass = match.class_name;
                this.selectedSubjectName = match.course_name;
                this.selectedSubjectId = match.id;
            }
        },

        // -- SSL Configuration State & Methods --
        openSsl: false,
        sslMode: "{{ $teacherOverrideSsl !== null ? 'custom' : 'default' }}",
        sslThreshold: {{ $teacherOverrideSsl !== null ? (int)$teacherOverrideSsl : $schoolDefaultSsl }},
        sslApplyAll: false,
        sslSaving: false,
        showAllClassesDetail: false,

        openSslModal() {
            this.openSsl = true;
            this.showAllClassesDetail = false;
            document.body.style.overflow = 'hidden';
        },

        closeSslModal() {
            this.openSsl = false;
            this.sslSaving = false;
            this.showAllClassesDetail = false;
            document.body.style.overflow = '';
        },

        async submitSslForm() {
            if (this.sslSaving) return;
            this.sslSaving = true;

            const url = "{{ route('assignments.teacher.ssl-threshold.update', ['subject' => $subject->id, 'kelas' => $subject->classRoom ? $subject->classRoom->id : 0]) }}";
            
            try {
                const response = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        mode: this.sslMode,
                        ssl_threshold: this.sslMode === 'custom' ? parseInt(this.sslThreshold) : null,
                        apply_all_classes: this.sslApplyAll
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    if (typeof Swal !== 'undefined') {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: result.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                    window.location.reload();
                } else {
                    const err = result.message || (result.errors ? Object.values(result.errors).flat().join('\n') : 'Terjadi kesalahan saat menyimpan pengaturan.');
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            text: err
                        });
                    } else {
                        alert(err);
                    }
                    this.sslSaving = false;
                }
            } catch (error) {
                console.error('SSL update error:', error);
                alert('Terjadi kesalahan jaringan atau server.');
                this.sslSaving = false;
            }
        }
    }
}

(function(){
    var PER_PAGE = 10, page = 1, filtered = [];
    var tbody = document.getElementById('detailBody');
    var rows = tbody ? Array.from(tbody.querySelectorAll('tr.tg-row')) : [];
    var info = document.getElementById('detailInfo');
    var pag = document.getElementById('detailPag');
    var sel = document.getElementById('perPageSel');
    var srch = document.getElementById('detailSearch');

    function filter(){
        var q = (srch ? srch.value : '').toLowerCase().trim();
        filtered = rows.filter(function(r){
            return !q || (r.dataset.search || '').includes(q);
        });
        page = 1;
        render();
    }

    function render(){
        rows.forEach(function(r){ r.style.display = 'none'; });
        PER_PAGE = sel ? parseInt(sel.value) : 10;
        var t = filtered.length,
            tp = Math.max(1, Math.ceil(t / PER_PAGE)),
            s = (page - 1) * PER_PAGE,
            e = Math.min(s + PER_PAGE, t);

        for(var i = s; i < e; i++){
            filtered[i].style.display = '';
            filtered[i].querySelector('.tgd-rownum').textContent = i + 1;
        }
        if(info) info.textContent = t === 0 ? 'Tidak ada data' : 'Menampilkan ' + (s + 1) + ' sampai ' + e + ' dari ' + t + ' data';
        buildPag(tp);
    }

    function buildPag(tp){
        if(!pag) return;
        pag.innerHTML = '';
        if(tp <= 1) return;
        pag.appendChild(mkBtn('‹', page > 1, function(){ page--; render(); }));
        for(var p = 1; p <= tp; p++){
            (function(pp){
                var b = mkBtn(pp, true, function(){ page = pp; render(); });
                if(pp === page) b.classList.add('tg-page-btn--active');
                pag.appendChild(b);
            })(p);
        }
        pag.appendChild(mkBtn('›', page < tp, function(){ page++; render(); }));
    }

    function mkBtn(l, en, fn){
        var b = document.createElement('button');
        b.type = 'button';
        b.innerHTML = l;
        b.className = 'tg-page-btn';
        b.disabled = !en;
        if(en) b.addEventListener('click', fn);
        return b;
    }

    if(srch) srch.addEventListener('input', filter);
    if(sel) sel.addEventListener('change', filter);
    filtered = rows.slice();
    render();
})();
</script>


@endpush
@endsection
