@extends('layouts.app')

@section('title', 'Penilaian Tugas: ' . $submission->student->name)

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Penilaian Tugas</h1>
                <p class="page-subtitle">{{ $submission->student->name }}</p>
            </div>
            <a href="{{ route('assignments.show', $submission->assignment_id) }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 space-y-6">
            <div class="card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-file-alt text-orange-500"></i>
                        Jawaban Siswa
                    </h3>
                    @if($submission->file_path)
                    <a href="{{ $submission->attachment_url }}" download="{{ $submission->original_name }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-download mr-1"></i> Download File
                    </a>
                    @endif
                </div>

                <div class="space-y-6">
                    @if($submission->is_url_submission || $submission->submission_url)
                        {{-- URL Submission Display --}}
                        <div class="space-y-4">
                            @if($submission->video_embed_url)
                                <div class="aspect-video w-full rounded-2xl overflow-hidden bg-black shadow-lg">
                                    <iframe src="{{ $submission->video_embed_url }}" class="w-full h-full"
                                        sandbox="allow-scripts allow-same-origin allow-presentation"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen loading="lazy"></iframe>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-200 dark:border-slate-800">
                                    <div class="min-w-0 flex-1 pr-3">
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 block mb-0.5">Tautan Asli Video Siswa:</span>
                                        <a href="{{ $submission->submission_url }}" target="_blank" rel="noopener noreferrer" class="text-xs text-red-600 hover:underline truncate block font-mono">
                                            {{ $submission->submission_url }}
                                        </a>
                                    </div>
                                    <a href="{{ $submission->submission_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                                        <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                    </a>
                                </div>
                            @else
                                <div class="p-8 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 text-center space-y-4">
                                    <div class="w-16 h-16 rounded-2xl bg-emerald-500 text-white flex items-center justify-center mx-auto text-2xl shadow-lg shadow-emerald-500/20">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-base font-bold text-slate-800 dark:text-white">{{ $submission->platform_data['label'] ?? 'Tautan Proyek Siswa' }}</h4>
                                        <p class="text-xs text-slate-500 mt-1">Siswa mengumpulkan karya melalui platform eksternal.</p>
                                    </div>
                                    <div class="p-3 bg-white dark:bg-slate-950/40 rounded-xl border border-slate-200 dark:border-slate-800 max-w-lg mx-auto">
                                        <a href="{{ $submission->submission_url }}" target="_blank" rel="noopener noreferrer" class="text-xs text-emerald-600 hover:underline break-all font-mono">
                                            {{ $submission->submission_url }}
                                        </a>
                                    </div>
                                    <div class="pt-2">
                                        <a href="{{ $submission->submission_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                            <i class="fas fa-external-link-alt mr-1.5"></i> Buka Hasil Karya Siswa
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                    @elseif($submission->file_path)
                    {{-- File Info Card --}}
                    <div class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl bg-white dark:bg-slate-800 shadow-sm flex items-center justify-center text-2xl">
                            @php
                                $ext = strtolower(pathinfo($submission->original_name ?? $submission->file_path, PATHINFO_EXTENSION));
                                $icon = match($ext) {
                                    'pdf' => 'fa-file-pdf text-rose-500',
                                    'doc', 'docx' => 'fa-file-word text-blue-500',
                                    'zip', 'rar' => 'fa-file-zipper text-amber-500',
                                    'jpg', 'jpeg', 'png' => 'fa-file-image text-purple-500',
                                    'mp3', 'm4a' => 'fa-file-audio text-rose-500',
                                    default => 'fa-file text-slate-400'
                                };
                            @endphp
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ $submission->original_name }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $submission->formatted_size }} • {{ strtoupper($ext) }}</p>
                        </div>
                    </div>

                    {{-- Media Previews --}}
                    @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <div class="mt-6 flex justify-center bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-slate-200 dark:border-slate-800">
                        <img src="{{ $submission->attachment_url }}" class="max-w-full max-h-[500px] rounded-xl shadow-sm object-contain" />
                    </div>
                    @elseif($ext === 'pdf')
                    <div class="mt-6">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">Pratinjau Dokumen</p>
                        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-slate-100 h-[600px]">
                            <iframe src="{{ $submission->preview_url }}#toolbar=0" class="w-full h-full border-none"></iframe>
                        </div>
                    </div>
                    @elseif(in_array($ext, ['mp3', 'm4a', 'wav', 'ogg']))
                    <div class="mt-6 p-6 bg-rose-50/50 dark:bg-rose-950/20 border border-rose-100 dark:border-rose-900/30 rounded-2xl text-center space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-500 text-white flex items-center justify-center mx-auto text-xl shadow-md">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-300">Pemutar Rekaman Audio Siswa</p>
                        <audio controls preload="metadata" class="w-full max-w-md mx-auto">
                            <source src="{{ $submission->attachment_url }}">
                            Browser Anda tidak mendukung pemutar audio.
                        </audio>
                    </div>
                    @endif

                    @else
                    <div class="bg-rose-50 dark:bg-rose-900/10 border border-rose-100 dark:border-rose-900/30 rounded-2xl p-8 text-center">
                        <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i class="fas fa-exclamation-triangle text-rose-500 text-xl"></i>
                        </div>
                        <p class="text-sm font-bold text-rose-800 dark:text-rose-400">Berkas / Tautan tidak ditemukan</p>
                        <p class="text-xs text-rose-600/70 mt-1">Siswa mungkin belum mengunggah jawaban tugas.</p>
                    </div>
                    @endif

                    @if($submission->content)
                    <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">Catatan dari Siswa</p>
                        <div class="bg-orange-50/50 dark:bg-orange-900/10 border border-orange-100/50 dark:border-orange-900/20 rounded-2xl p-4">
                            <p class="text-sm text-slate-700 dark:text-slate-300 italic leading-relaxed">
                                "{{ $submission->content }}"
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Input Nilai</h3>
                <form action="{{ route('submissions.grade', $submission) }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label class="field-label">Skor Siswa (Max: {{ $submission->assignment->max_score }})</label>
                        <input type="number" name="score" step="0.01" max="{{ $submission->assignment->max_score }}" min="0" value="{{ $submission->grade->score ?? '' }}" class="input" required>
                    </div>
                    <div>
                        <label class="field-label">Catatan Feedback</label>
                        <textarea name="feedback" rows="4" class="input" placeholder="Berikan catatan perbaikan...">{{ $submission->grade->feedback ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Simpan Nilai</button>
                </form>
            </div>

            <div class="card">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Siswa</h3>
                <div class="mt-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-semibold">
                        {{ substr($submission->student->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $submission->student->name }}</p>
                        <p class="text-xs text-slate-500">{{ $submission->student->nis }}</p>
                    </div>
                </div>
                <div class="mt-4 text-xs text-slate-500">
                    Status: <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $submission->status }}</span><br/>
                    Waktu Kumpul: {{ $submission->submission_date->format('d M, H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
