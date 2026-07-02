@extends('layouts.app')

@section('title', 'Data Absensi')

@section('content')
<div class="space-y-6" x-data="{ 
    showQrModal: false,
    qrCode: '',
    sessionSubject: '',
    expiresAt: '',
    sessionId: null,
    loadingId: null,
    timeLeft: 15,
    refreshInterval: null,
    async openQr(subjectId) {
        this.loadingId = subjectId;
        try {
            const response = await fetch('{{ route('attendance_sessions.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    subject_id: subjectId,
                    duration_minutes: 15,
                    from_attendance: true
                })
            });
            const data = await response.json();
            if (data.success) {
                this.qrCode = data.qr_code;
                this.sessionId = data.session.id;
                this.expiresAt = new Date(data.session.expires_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                this.showQrModal = true;
                this.startRefreshTimer();
            }
        } catch (e) {
            console.error(e);
        } finally {
            this.loadingId = null;
        }
    },
    startRefreshTimer() {
        if (this.refreshInterval) clearInterval(this.refreshInterval);
        this.timeLeft = 15;
        this.refreshInterval = setInterval(async () => {
            this.timeLeft--;
            if (this.timeLeft <= 0) {
                await this.refreshQr();
                this.timeLeft = 15;
            }
        }, 1000);
    },
    async refreshQr() {
        try {
            const response = await fetch(`/attendance_sessions/${this.sessionId}/refresh`);
            const data = await response.json();
            if (data.success) {
                this.qrCode = data.qr_code;
            }
        } catch (e) {
            console.error('Failed to refresh QR', e);
        }
    }
}" @keydown.window.escape="showQrModal = false; if(refreshInterval) clearInterval(refreshInterval);">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Data Absensi</h1>
                <p class="page-subtitle">Kelola kehadiran siswa per sesi pelajaran</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('attendance_sessions.index') }}" class="btn btn-outline">
                    <i class="fas fa-history"></i>
                    Riwayat QR
                </a>
                <a href="{{ route('attendances.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Catat Absensi
                </a>
            </div>
        </div>
    </div>

    <div class="card p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-ui w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-left">Pelajaran & Kelas</th>
                        <th class="px-6 py-4 text-center">Statistik Kehadiran</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessions as $session)
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $session->date->format('d M Y') }}</span>
                                <span class="text-xs text-slate-400 uppercase">{{ $session->date->format('l') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr($session->subject->course->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $session->subject->course->name }}</p>
                                    <p class="text-xs text-slate-500 uppercase tracking-widest">{{ $session->subject->classRoom->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-wrap items-center justify-center gap-2">
                                <span class="badge badge-success">Hadir: {{ $session->count_hadir }}</span>
                                <span class="badge badge-warning">Izin: {{ $session->count_izin }}</span>
                                <span class="badge badge-info">Sakit: {{ $session->count_sakit }}</span>
                                <span class="badge badge-danger">Alpa: {{ $session->count_alpa }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('attendances.create', ['subject_id' => $session->subject_id]) }}" 
                                   class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition"
                                   title="Edit / Detail">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" 
                                        @click="openQr({{ $session->subject_id }})"
                                        :disabled="loadingId === {{ $session->subject_id }}"
                                        class="p-2 rounded-lg bg-slate-800 text-white hover:bg-slate-900 transition disabled:opacity-50"
                                        title="Buka QR">
                                    <i class="fas" :class="loadingId === {{ $session->subject_id }} ? 'fa-spinner fa-spin' : 'fa-qrcode'"></i>
                                </button>

                                <form action="{{ route('attendances.destroy_session') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data absensi pada sesi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="subject_id" value="{{ $session->subject_id }}">
                                    <input type="hidden" name="date" value="{{ $session->date->format('Y-m-d') }}">
                                    <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white transition" title="Hapus Sesi">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
                                    <i class="fas fa-calendar-times text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Belum Ada Data Absensi</h3>
                                <p class="text-sm text-slate-500 mb-6">Mulai catat kehadiran kelas hari ini.</p>
                                <a href="{{ route('attendances.create') }}" class="btn btn-primary">Catat Absensi Pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="showQrModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="glass-dark w-full max-w-xl p-8 rounded-2xl relative text-white">
            <button @click="showQrModal = false; if(refreshInterval) clearInterval(refreshInterval);" class="absolute top-4 right-4 text-slate-300 hover:text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-500/10 text-emerald-300 rounded-full border border-emerald-500/20 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-[10px] font-semibold uppercase tracking-widest">Sesi QR Aktif</span>
                </div>

                <div class="relative inline-block mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <div x-html="qrCode"></div>
                    </div>
                    <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 px-4 py-2 bg-teal-600 text-white rounded-xl text-[10px] font-semibold uppercase tracking-widest border border-slate-900 flex items-center gap-2">
                        <i class="fas fa-sync-alt animate-spin" x-show="timeLeft <= 1"></i>
                        <span x-text="'Refresh: ' + timeLeft + 's'"></span>
                    </div>
                </div>

                <p class="text-slate-300 text-xs uppercase tracking-widest mb-3">QR Code berganti otomatis untuk keamanan absensi.</p>
                <div class="flex items-center justify-center gap-2 text-teal-300 font-semibold text-sm">
                    <i class="fas fa-clock"></i>
                    <span x-text="'Berakhir pukul ' + expiresAt"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
