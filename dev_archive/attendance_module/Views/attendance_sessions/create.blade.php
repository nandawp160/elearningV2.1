@extends('layouts.app')

@section('title', 'Buat QR Absensi')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto">
    <div>
        <a href="{{ route('attendances.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data Absensi
        </a>
    </div>

    <div class="card">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-teal-600 rounded-xl flex items-center justify-center text-white">
                <i class="fas fa-qrcode"></i>
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Buat QR Absensi</h1>
                <p class="text-sm text-slate-500">Generate QR token untuk discan siswa.</p>
            </div>
        </div>

        <form action="{{ route('attendance_sessions.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="field-label mb-2 block">Pilih Mata Pelajaran & Kelas</label>
                    <select name="subject_id" required class="select">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->course->name }} - {{ $subject->classRoom->name }} ({{ $subject->day }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="field-label mb-2 block">Durasi Berlaku (Menit)</label>
                    <div class="relative">
                        <input type="number" name="duration_minutes" value="15" min="1" max="120" required class="input pr-20" />
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">Menit</span>
                    </div>
                    <p class="mt-2 text-xs text-slate-500">QR akan otomatis tidak bisa discan setelah waktu habis.</p>
                </div>

                <div>
                    <label class="field-label mb-2 block">Status Sesi</label>
                    <div class="flex items-center gap-3 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 px-4 py-3 border border-emerald-100 dark:border-emerald-500/20">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-300 uppercase tracking-widest">Langsung Aktif</span>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn btn-primary w-full">
                    Generate QR Code
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
