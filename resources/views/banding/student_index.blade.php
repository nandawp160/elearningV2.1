@extends('layouts.app')

@section('title', 'Pelacakan Status Banding')

@section('content')
<div class="student-appeals-wrapper">
    {{-- Alerts for success/error feedback --}}
    @if(session('success'))
    <div class="appeals-alert appeals-alert--success">
        <div class="appeals-alert__icon"><i class="fas fa-check-circle"></i></div>
        <span class="appeals-alert__text">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="appeals-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="appeals-alert appeals-alert--danger">
        <div class="appeals-alert__icon"><i class="fas fa-exclamation-circle"></i></div>
        <span class="appeals-alert__text">{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="appeals-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif

    <!-- Breadcrumb -->
    <div class="appeals-breadcrumb">
        <span>Resolusi & Banding</span>
        <span class="appeals-breadcrumb__sep">/</span>
        <span class="appeals-breadcrumb__active">Status Banding (SSL)</span>
    </div>

    <!-- Header Area -->
    <div class="appeals-header">
        <h1 class="appeals-title">Pelacakan Status Banding</h1>
        <p class="appeals-subtitle">Pantau proses permohonan pembukaan akses tugas yang telah Anda ajukan.</p>
    </div>

    <!-- Stats Cards Grid -->
    <div class="stats-grid">
        <!-- Pending Card -->
        <div class="stats-card">
            <div class="stats-icon-box stats-icon-box--pending">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stats-info">
                <span class="stats-label">Menunggu</span>
                <span class="stats-val">{{ $pendingCount }} <span class="stats-unit">Pengajuan</span></span>
            </div>
        </div>
        
        <!-- Approved Card -->
        <div class="stats-card">
            <div class="stats-icon-box stats-icon-box--approved">
                <i class="fas fa-check-square"></i>
            </div>
            <div class="stats-info">
                <span class="stats-label">Disetujui</span>
                <span class="stats-val">{{ $approvedCount }} <span class="stats-unit">Pengajuan</span></span>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="stats-card">
            <div class="stats-icon-box stats-icon-box--rejected">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stats-info">
                <span class="stats-label">Ditolak</span>
                <span class="stats-val">{{ $rejectedCount }} <span class="stats-unit">Pengajuan</span></span>
            </div>
        </div>
    </div>

    <!-- List section: Riwayat Pengajuan -->
    <div class="appeals-history-section">
        <h3 class="section-title">Riwayat Pengajuan</h3>

        <div class="appeals-list">
            @forelse($appeals as $appeal)
                @php
                    $isPending = in_array($appeal->status, ['pending', 'ditinjau']);
                    $isApproved = in_array($appeal->status, ['approved', 'diterima']);
                    $isRejected = in_array($appeal->status, ['rejected', 'ditolak']);

                    // Time display logic
                    $timeDisplay = '';
                    if ($appeal->created_at->isToday()) {
                        $timeDisplay = 'Hari ini, ' . $appeal->created_at->format('H:i') . ' WIB';
                    } elseif ($appeal->created_at->isYesterday()) {
                        $timeDisplay = 'Kemarin, ' . $appeal->created_at->format('H:i') . ' WIB';
                    } else {
                        $timeDisplay = $appeal->created_at->format('d M Y, H:i') . ' WIB';
                    }
                @endphp

                <div class="appeal-item-card 
                    {{ $isPending ? 'appeal-item-card--pending' : '' }}
                    {{ $isApproved ? 'appeal-item-card--approved' : '' }}
                    {{ $isRejected ? 'appeal-item-card--rejected' : '' }}">
                    
                    <div class="appeal-card-main">
                        <div class="appeal-card-header">
                            <div class="header-left">
                                <h4 class="appeal-task-title">
                                    Permohonan Akses Tugas: {{ $appeal->subject->nama ?? 'Mata Pelajaran' }}
                                </h4>
                                <span class="appeal-meta-teacher">
                                    Diajukan kepada: {{ $appeal->teacher_name }}
                                </span>
                            </div>
                            <div class="header-right">
                                <span class="appeal-time">{{ $timeDisplay }}</span>
                                @if($isPending)
                                    <span class="appeal-badge appeal-badge--pending">
                                        <i class="fas fa-hourglass-half"></i> Menunggu
                                    </span>
                                @elseif($isApproved)
                                    <span class="appeal-badge appeal-badge--approved">
                                        <i class="fas fa-check"></i> Disetujui
                                    </span>
                                @elseif($isRejected)
                                    <span class="appeal-badge appeal-badge--rejected">
                                        <i class="fas fa-times"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Content Reason Box -->
                        @if($isPending)
                            <div class="appeal-content-box appeal-content-box--reason">
                                <p>"{{ $appeal->alasan }}"</p>
                            </div>
                        @else
                            <div class="appeal-content-box 
                                {{ $isApproved ? 'appeal-content-box--approved' : '' }}
                                {{ $isRejected ? 'appeal-content-box--rejected' : '' }}">
                                <p><strong>Tanggapan:</strong> "{{ $appeal->tanggapan_guru ?: ($isApproved ? 'Akses pengumpulan tugas telah dibuka kembali.' : 'Permohonan banding ditolak oleh guru.') }}"</p>
                            </div>
                        @endif

                        <!-- Actions -->
                        @if($isPending || $isRejected)
                            <div class="appeal-card-actions">
                                @if($isPending)
                                    <form action="{{ route('student.appeals.cancel', $appeal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permohonan banding ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-student btn-action-student--cancel">
                                            Batalkan
                                        </button>
                                    </form>
                                @elseif($isRejected)
                                    <button class="btn-action-student btn-action-student--done" disabled>
                                        Selesai
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="appeals-empty-card">
                    <i class="fas fa-folder-open"></i>
                    <p>Anda belum pernah mengajukan banding.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
/* CSS Styles for Pelacakan Status Banding */
.student-appeals-wrapper {
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
    color: #334155;
    padding-bottom: 40px;
}

.dark .student-appeals-wrapper {
    color: #cbd5e1;
}

/* Breadcrumb Styling */
.appeals-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 500;
    color: #94a3b8;
    margin-bottom: 16px;
}
.appeals-breadcrumb__sep {
    color: #cbd5e1;
}
.appeals-breadcrumb__active {
    color: #D65A20;
    font-weight: 700;
}

/* Header Area */
.appeals-header {
    margin-bottom: 28px;
}
.appeals-title {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
}
.dark .appeals-title {
    color: #f1f5f9;
}
.appeals-subtitle {
    font-size: 14px;
    color: #64748b;
    margin: 0;
}
.dark .appeals-subtitle {
    color: #94a3b8;
}

/* Stats Cards Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
}

.stats-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
    transition: transform 0.2s, box-shadow 0.2s;
}

.dark .stats-card {
    background: #1e293b;
    border-color: #334155;
}

.stats-icon-box {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.stats-icon-box--pending {
    background: #fef3c7;
    color: #d97706;
}
.stats-icon-box--approved {
    background: #d1fae5;
    color: #059669;
}
.stats-icon-box--rejected {
    background: #fee2e2;
    color: #dc2626;
}

.stats-info {
    display: flex;
    flex-direction: column;
}
.stats-label {
    font-size: 13px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 2px;
}
.dark .stats-label {
    color: #94a3b8;
}
.stats-val {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
}
.dark .stats-val {
    color: #f1f5f9;
}
.stats-unit {
    font-size: 13px;
    font-weight: 500;
    color: #94a3b8;
    margin-left: 2px;
}

/* History Section */
.appeals-history-section {
    margin-top: 12px;
}
.section-title {
    font-size: 16px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 16px;
}
.dark .section-title {
    color: #cbd5e1;
}

.appeals-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* Appeal Item Card */
.appeal-item-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.01);
    position: relative;
    overflow: hidden;
}

.dark .appeal-item-card {
    background: #1e293b;
    border-color: #334155;
}

/* Left Accent borders */
.appeal-item-card--pending {
    border-left: 5px solid #d97706;
}
.appeal-item-card--approved {
    border-left: 5px solid #10b981;
}
.appeal-item-card--rejected {
    border-left: 5px solid #ef4444;
}

.appeal-card-main {
    padding: 20px 24px;
}

.appeal-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 14px;
    flex-wrap: wrap;
    gap: 12px;
}

.header-left {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.appeal-task-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.dark .appeal-task-title {
    color: #f1f5f9;
}

.appeal-meta-teacher {
    font-size: 12.5px;
    color: #64748b;
    font-weight: 500;
}
.dark .appeal-meta-teacher {
    color: #94a3b8;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.appeal-time {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 500;
}

/* Status Badges */
.appeal-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 700;
}

.appeal-badge--pending {
    background: #fef3c7;
    color: #d97706;
}
.appeal-badge--approved {
    background: #d1fae5;
    color: #065f46;
}
.appeal-badge--rejected {
    background: #fee2e2;
    color: #991b1b;
}

/* Content reason/response boxes */
.appeal-content-box {
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 14px;
    font-size: 13.5px;
}

.appeal-content-box p {
    margin: 0;
    line-height: 1.5;
}

.appeal-content-box--reason {
    background: #f8fafc;
    color: #475569;
    font-style: italic;
    border: 1px solid #f1f5f9;
}
.dark .appeal-content-box--reason {
    background: #0f172a;
    color: #94a3b8;
    border-color: #1e293b;
}

.appeal-content-box--approved {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #d1fae5;
}
.dark .appeal-content-box--approved {
    background: #022c22;
    color: #a7f3d0;
    border-color: #064e3b;
}

.appeal-content-box--rejected {
    background: #fdf2f2;
    color: #991b1b;
    border: 1px solid #fee2e2;
}
.dark .appeal-content-box--rejected {
    background: #450a0a;
    color: #fca5a5;
    border-color: #7f1d1d;
}

/* Actions */
.appeal-card-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 14px;
}

.btn-action-student {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 24px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    text-decoration: none;
}

.btn-action-student--cancel {
    background: #fff;
    color: #334155;
    border: 1.5px solid #cbd5e1;
}
.btn-action-student--cancel:hover {
    background: #f8fafc;
    border-color: #94a3b8;
    color: #0f172a;
}
.dark .btn-action-student--cancel {
    background: #1e293b;
    color: #cbd5e1;
    border-color: #475569;
}
.dark .btn-action-student--cancel:hover {
    background: #0f172a;
    border-color: #94a3b8;
    color: #f1f5f9;
}

.btn-action-student--done {
    background: #e2e8f0;
    color: #475569;
    cursor: not-allowed;
    opacity: 0.7;
}
.dark .btn-action-student--done {
    background: #334155;
    color: #94a3b8;
}

/* Alerts styling */
.appeals-alert {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
    animation: fadeIn 0.2s ease-out;
}
.appeals-alert--success {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
.appeals-alert--danger {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}
.appeals-alert__icon {
    margin-right: 12px;
    font-size: 16px;
}
.appeals-alert__text {
    flex: 1;
}
.appeals-alert__close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    font-size: 14px;
    padding: 0;
    opacity: 0.6;
    transition: opacity 0.15s;
}
.appeals-alert__close:hover {
    opacity: 1;
}

/* Empty Card */
.appeals-empty-card {
    background: #fff;
    border: 1px dashed #cbd5e1;
    border-radius: 16px;
    padding: 48px;
    text-align: center;
    color: #94a3b8;
}
.dark .appeals-empty-card {
    background: #1e293b;
    border-color: #475569;
}
.appeals-empty-card i {
    font-size: 36px;
    margin-bottom: 12px;
    opacity: 0.5;
}
.appeals-empty-card p {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-4px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 640px) {
    .appeal-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .header-right {
        width: 100%;
        justify-content: space-between;
        margin-top: 4px;
    }
}
</style>
@endsection
