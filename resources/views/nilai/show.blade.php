@extends('layouts.app')

@section('title', 'Detail Nilai: ' . ($grade->submission->assignment->title ?? $grade->subject->course->name))

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Detail Nilai</h1>
                <p class="page-subtitle">{{ $grade->submission->assignment->title ?? 'Penilaian Manual' }}</p>
            </div>
            <a href="{{ route('grades.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 space-y-6">
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Penilaian</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-slate-500">Mata Pelajaran</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $grade->subject->course->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Tipe Penilaian</p>
                        <p class="text-sm font-semibold text-teal-600 uppercase">{{ $grade->type }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Tanggal Dinilai</p>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $grade->graded_at ? $grade->graded_at->format('d M Y, H:i') : $grade->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Catatan & Feedback Guru</h3>
                <div class="mt-4">
                    @if($grade->feedback)
                        <p class="text-sm text-slate-700 dark:text-slate-200 italic">"{{ $grade->feedback }}"</p>
                    @else
                        <p class="text-sm text-slate-500">Tidak ada catatan feedback untuk penilaian ini.</p>
                    @endif
                </div>
                @if($grade->grader)
                <div class="mt-4 text-sm text-slate-500">
                    Dinilai oleh: <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $grade->grader->name }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="card text-center">
                <p class="text-xs text-slate-500 uppercase tracking-widest">Skor Akhir</p>
                <div class="text-5xl font-semibold text-teal-600 my-4">{{ round($grade->score) }}</div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-slate-500">Skor Maksimal</span><span class="font-semibold">{{ $grade->max_score }}</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Grade Huruf</span><span class="font-semibold">{{ $grade->letter_grade }}</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Persentase</span><span class="font-semibold">{{ $grade->percentage }}%</span></div>
                </div>
            </div>

            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Siswa</h3>
                <div class="mt-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-semibold">
                        {{ substr($grade->student->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $grade->student->name }}</p>
                        <p class="text-xs text-slate-500">{{ $grade->student->nis }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
