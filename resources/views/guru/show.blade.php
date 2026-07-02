@extends('layouts.app')

@section('title', 'Detail Profil Guru')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl font-semibold">
                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $teacher->name }}</h1>
                    <p class="text-sm text-slate-500">NIP: <span class="font-mono font-semibold">{{ $teacher->nip }}</span></p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i>
                    Edit Profil
                </a>
                <a href="{{ route('teachers.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Status Kepegawaian</h3>
                <div class="mt-4">
                    @if($teacher->status === 'active')
                        <span class="badge badge-success">Aktif</span>
                        <p class="text-xs text-slate-500 mt-2">Guru aktif mengajar</p>
                    @else
                        <span class="badge badge-danger">Nonaktif</span>
                        <p class="text-xs text-slate-500 mt-2">Tidak aktif mengajar</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Kontak</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <p class="text-xs text-slate-500">Email</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $teacher->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Telepon/WA</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $teacher->phone }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Akademik & Pribadi</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-xs text-slate-500">Spesialisasi / Mata Pelajaran</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $teacher->mataPelajaran->nama ?? $teacher->spesialisasi ?? 'Belum Ditentukan' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Tagging Kelas (Diizinkan Mengajar)</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                            @if(is_array($teacher->allowed_grades) && count($teacher->allowed_grades) > 0)
                                Kelas {{ implode(', ', $teacher->allowed_grades) }}
                            @else
                                <span class="text-slate-400 italic">Semua Tingkat (Default)</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Terdaftar Sejak</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $teacher->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs text-slate-500">Alamat Domisili</p>
                        <p class="text-sm text-slate-700 dark:text-slate-200">{{ $teacher->address ?? 'Alamat belum diisi.' }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Kelas Diampu</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    @forelse($teacher->kelasDiampu as $kelas)
                        <span class="px-3 py-1 bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] dark:text-orange-400 text-sm font-semibold rounded-xl border border-orange-100 dark:border-orange-900/30">
                            {{ $kelas->name }}
                        </span>
                    @empty
                        <span class="text-sm text-slate-500 italic">Belum ada kelas yang diampu</span>
                    @endforelse
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="card">
                    <p class="text-xs text-slate-500">Total Mata Pelajaran</p>
                    <p class="text-2xl font-semibold text-slate-800 dark:text-slate-100">{{ $teacher->subjects->count() }}</p>
                </div>
                <div class="card">
                    <p class="text-xs text-slate-500">Kelas Perwalian</p>
                    <p class="text-2xl font-semibold text-slate-800 dark:text-slate-100">{{ $teacher->kelasPerwalian->count() }}</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
