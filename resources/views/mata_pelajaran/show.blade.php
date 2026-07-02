@extends('layouts.app')

@section('title', 'Detail Mata Pelajaran')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $course->name }}</h1>
                    <div class="text-sm text-slate-500">Kode: <span class="font-semibold">{{ $course->code }}</span> · {{ $course->credits }} SKS</div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
                <a href="{{ route('courses.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Deskripsi</h3>
                <p class="mt-3 text-sm text-slate-700 dark:text-slate-200">
                    {{ $course->description ?? 'Deskripsi mata pelajaran belum ditambahkan.' }}
                </p>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                    <div>
                        <p class="text-xs text-slate-500">Tingkat Kurikulum</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">Kelas {{ $course->grade_level }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Terakhir Diperbarui</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $course->updated_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="space-y-6">
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Status</h3>
                <div class="mt-4">
                    @if($course->status === 'active')
                        <span class="badge badge-success">Aktif</span>
                        <p class="text-xs text-slate-500 mt-2">Tersedia di kurikulum</p>
                    @else
                        <span class="badge badge-danger">Nonaktif</span>
                        <p class="text-xs text-slate-500 mt-2">Sedang tidak diajarkan</p>
                    @endif
                </div>
            </div>
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Statistik</h3>
                <div class="mt-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Total Jadwal</span>
                        <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $course->subjects_count ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Rasio SKS</span>
                        <span class="font-semibold text-teal-600">{{ $course->credits * 2 }} Jam/Mgg</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
