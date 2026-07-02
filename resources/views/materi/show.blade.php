@extends('layouts.app')

@section('title', 'Detail Materi')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Detail Materi</h1>
                <p class="page-subtitle">{{ $material->title }}</p>
            </div>
            <a href="{{ route('materials.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $material->title }}</h2>
                <p class="text-sm text-slate-500 mt-1">{{ $material->subject->course->name ?? 'N/A' }} • {{ $material->subject->classRoom->name ?? '-' }}</p>
            </div>
            <span class="badge badge-info uppercase">{{ $material->type }}</span>
        </div>

        <div class="mt-4 text-sm text-slate-600 dark:text-slate-300">
            {{ $material->description ?? 'Tidak ada deskripsi.' }}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="card p-4">
                <p class="field-label">Uploader</p>
                <p class="text-slate-800 dark:text-slate-100 font-semibold">{{ $material->uploader->name ?? '-' }}</p>
            </div>
            <div class="card p-4">
                <p class="field-label">Tipe</p>
                <p class="text-slate-800 dark:text-slate-100 font-semibold uppercase">{{ $material->type }}</p>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex flex-wrap gap-2">
                @if($material->file_path)
                <a href="{{ route('preview.material', $material->id) }}" target="_blank" class="btn btn-secondary">
                    <i class="fas fa-eye"></i>
                    Preview Materi
                </a>
                @endif
                @if($material->file_url)
                <a href="{{ $material->file_url }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-download"></i>
                    Download
                </a>
                @endif
                @if($material->url)
                <a href="{{ $material->url }}" target="_blank" class="btn btn-outline">
                    <i class="fas fa-link"></i>
                    Kunjungi Link
                </a>
                @endif
            </div>

            @if(auth()->user()->isStudent())
                <div>
                    @if($isCompleted)
                        <form action="{{ route('materials.incomplete', $material->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition inline-flex items-center gap-2 shadow-md">
                                <i class="fas fa-check-circle text-sm"></i>
                                <span>Selesai Dibaca (Batalkan)</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('materials.complete', $material->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-[#D65A20] hover:bg-orange-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition inline-flex items-center gap-2 shadow-md">
                                <i class="fas fa-check text-sm"></i>
                                <span>Tandai Selesai Membaca</span>
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
