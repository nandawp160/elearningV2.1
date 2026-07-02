@extends('layouts.app')

@section('title', 'Scan QR Absensi')

@section('content')
<div class="space-y-6 max-w-2xl mx-auto">
    <div>
        <a href="{{ route('attendance_sessions.create') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left"></i>
            Buat Sesi Baru
        </a>
    </div>

    <div class="card text-center relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-52 h-52 bg-teal-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-52 h-52 bg-sky-500/10 rounded-full blur-3xl"></div>

        <div class="relative">
            <span class="badge badge-success mb-4 inline-flex">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sesi Absensi Aktif
            </span>

            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $attendanceSession->subject->course->name }}</h1>
            <p class="text-sm text-slate-500 mb-6">{{ $attendanceSession->subject->classRoom->name }}</p>

            <div class="bg-white p-6 rounded-2xl shadow-sm inline-block border border-slate-200 dark:border-slate-700 mb-6">
                {!! QrCode::size(260)->generate($attendanceSession->qr_token) !!}
            </div>

            <div class="space-y-3">
                <p class="text-xs text-slate-500">Silakan scan QR di atas menggunakan aplikasi mobile.</p>
                <div class="flex flex-col items-center gap-1">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Berakhir Pada</span>
                    <span class="text-2xl font-semibold text-teal-600 dark:text-teal-400">{{ $attendanceSession->expires_at->format('H:i') }} WIB</span>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="text-left">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Dibuat Oleh</p>
                        <p class="font-semibold text-slate-700 dark:text-slate-200">{{ $attendanceSession->teacher->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest">ID Sesi</p>
                        <p class="font-mono text-xs font-semibold text-teal-600 dark:text-teal-400">#{{ substr($attendanceSession->qr_token, 0, 8) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-[11px] text-slate-400 text-center uppercase tracking-widest">QR ini hanya berlaku untuk satu sesi. Jangan bagikan token di luar kelas.</p>
</div>
@endsection
