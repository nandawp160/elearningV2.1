@extends('layouts.app')

@section('title', 'Riwayat Sesi Absensi')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Riwayat Sesi Absensi</h1>
                <p class="page-subtitle">Monitoring QR Code yang telah dibuat</p>
            </div>
            <a href="{{ route('attendance_sessions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Buat Sesi Baru
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($sessions as $session)
        <div class="card">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $session->subject->course->name }}</p>
                        <p class="text-xs text-slate-500">{{ $session->subject->classRoom->name }}</p>
                    </div>
                </div>
                <span class="badge {{ $session->isExpired() ? 'badge-danger' : 'badge-success' }}">
                    {{ $session->isExpired() ? 'Expired' : 'Active' }}
                </span>
            </div>

            <div class="mt-4 space-y-2 text-sm">
                <div class="flex items-center justify-between text-slate-500">
                    <span>Tanggal</span>
                    <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $session->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center justify-between text-slate-500">
                    <span>Berakhir</span>
                    <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $session->expires_at->format('H:i') }} WIB</span>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('attendance_sessions.show', $session) }}" class="btn btn-outline w-full">
                    Lihat QR
                    <i class="fas fa-external-link-alt text-xs"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="card p-10 text-center">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
                    <i class="fas fa-history text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-2">Belum Ada Riwayat Sesi</h3>
                <p class="text-slate-500">Mulai buat QR untuk absensi kelas hari ini.</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($sessions->hasPages())
    <div>
        {{ $sessions->links() }}
    </div>
    @endif
</div>
@endsection
