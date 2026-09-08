@extends('layouts.app')

@section('title', 'Detail Tugas: ' . $assignment->title)

@section('content')
@php
    $user = auth()->user();
    $isOwner = $user->isSuperAdmin() || ($user->isTeacher() && $assignment->guru_id == $user->teacher_id);
@endphp


@if($isOwner)
    <!-- REDESIGNED TEACHER VIEW -->
    <div class="space-y-6" x-data="teacherAssignmentPreview()">
        @php
            $backUrl = auth()->user()->isTeacher() 
                ? route('assignments.teacher.detail', ['subject' => $assignment->mata_pelajaran_id, 'class_name' => request('class_name')]) 
                : route('assignments.index');
        @endphp
        {{-- Breadcrumb & Title --}}
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                <a href="{{ $backUrl }}" class="hover:text-[#D65A20] transition font-medium">Tugas</a>
                <span class="text-slate-350">/</span>
                <a href="{{ $backUrl }}" class="hover:text-[#D65A20] transition font-medium">Daftar Tugas</a>
                <span class="text-slate-355">/</span>
                <span class="text-[#D65A20] font-bold">Detail Tugas</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ $backUrl }}" class="text-slate-900 dark:text-white hover:text-[#D65A20] transition text-3xl font-extrabold flex items-center gap-3">
                    <i class="fas fa-chevron-left text-2xl"></i>
                    {{ $assignment->title }}
                </a>
            </div>
        </div>

        {{-- Card Informasi Tugas --}}
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm flex flex-col md:flex-row justify-between items-stretch gap-6">
            {{-- Bagian Kiri --}}
            <div class="flex-1 flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl bg-orange-50 dark:bg-orange-950/30 text-[#D65A20] flex items-center justify-center text-2xl flex-shrink-0 border border-orange-100 dark:border-orange-900/20">
                    <i class="far fa-file-alt"></i>
                </div>
                <div class="space-y-1">
                    <h2 class="text-base font-bold text-slate-850 dark:text-white">
                        Kelas {{ $assignment->subject->classRoom->name ?? '' }} • {{ $assignment->subject->course->name ?? $assignment->subject->nama ?? '' }}
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Batas Waktu: {{ $assignment->due_date->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB
                    </p>
                    <div class="flex items-center gap-2 flex-wrap pt-2">
                        @if($assignment->attachment)
                            @if($assignment->is_attachment_url)
                                <a href="{{ $assignment->attachment }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 text-xs font-bold rounded-xl transition border border-rose-200/50" title="Buka Video Instruksi">
                                    <i class="fab fa-youtube text-red-500"></i>
                                    Tautan Video Instruksi Guru
                                    <i class="fas fa-external-link-alt text-[10px] ml-1"></i>
                                </a>
                            @elseif($assignment->is_attachment_video)
                                <button type="button" @click="initPreview('{{ $assignment->preview_url }}', '{{ addslashes(basename($assignment->attachment)) }}', 'video')" class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 text-xs font-bold rounded-xl transition border border-rose-200/50" title="Putar Video Instruksi">
                                    <i class="fas fa-play text-rose-500"></i>
                                    {{ basename($assignment->attachment) }}
                                </button>
                            @else
                                <button type="button" @click="initPreview('{{ $assignment->preview_url }}', '{{ addslashes(basename($assignment->attachment)) }}')" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition" title="Lihat/Unduh Lampiran">
                                    <i class="fas fa-paperclip text-slate-500"></i>
                                    {{ basename($assignment->attachment) }}
                                </button>
                            @endif
                        @else
                            <span class="text-xs text-slate-400 italic">Tidak ada lampiran</span>
                        @endif

                        @if($assignment->description)
                            <button type="button" @click="initInstructionPreview()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                                <i class="fas fa-align-left text-slate-500"></i>
                                Pratinjau Deskripsi
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Pembatas Vertikal --}}
            <div class="hidden md:block w-px bg-slate-200 dark:bg-slate-800 my-1"></div>
            
            {{-- Bagian Kanan --}}
            <div class="flex items-center justify-between md:justify-end gap-8 md:w-80">
                <div>
                    <p class="text-xs text-slate-400 font-bold mb-1">Terkumpul</p>
                    <div class="flex items-baseline">
                        <span class="text-5xl font-black text-slate-800 dark:text-white">
                            @php
                                $terkumpulCount = $studentMonitoring->filter(function($monitor) { return $monitor->submission !== null; })->count();
                            @endphp
                            {{ $terkumpulCount }}
                        </span>
                        <span class="text-lg text-slate-400 font-bold ml-1.5">
                            / {{ $studentMonitoring->count() }}
                        </span>
                    </div>
                </div>
                
                <div>
                    <a href="{{ route('assignments.edit', ['assignment' => $assignment->id, 'class_name' => request('class_name')]) }}" class="inline-flex items-center justify-center px-5 py-3 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        Edit Instruksi
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Monitoring Pengumpulan --}}
        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            {{-- Toolbar --}}
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex flex-1 items-center gap-4 flex-wrap">
                    {{-- Search Box --}}
                    <div class="relative w-full sm:max-w-xs">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="searchSiswa" placeholder="Cari nama siswa..." class="pl-9 pr-4 py-2.5 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-705 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition" />
                    </div>
                    
                    {{-- Dropdown Status --}}
                    <div class="relative w-full sm:max-w-xs">
                        <select id="statusFilter" class="px-4 py-2.5 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-705 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition appearance-none pr-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22%2394a3b8%22 class=%22bi bi-chevron-down%22 viewBox=%220 0 16 16%22><path fill-rule=%22evenodd%22 d=%22M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z%22/></svg>'); background-position: right 14px center; background-repeat: no-repeat;">
                            <option value="all">Semua Status</option>
                            <option value="sudah_dikoreksi">Sudah Dikoreksi</option>
                            <option value="perlu_koreksi">Perlu Koreksi</option>
                            <option value="perlu_revisi">Return Jawaban (Perlu Revisi)</option>
                            <option value="terlambat">Terlambat</option>
                            <option value="belum_kumpul">Belum Kumpul</option>
                        </select>
                    </div>
                    
                    {{-- Dropdown Urutan --}}
                    <div class="relative w-full sm:max-w-xs">
                        <select id="sortFilter" class="px-4 py-2.5 w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-705 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition appearance-none pr-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22%2394a3b8%22 class=%22bi bi-chevron-down%22 viewBox=%220 0 16 16%22><path fill-rule=%22evenodd%22 d=%22M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z%22/></svg>'); background-position: right 14px center; background-repeat: no-repeat;">
                            <option value="default">Urutan Standar</option>
                            <option value="terbaru">Paling Akhir Mengumpulkan</option>
                            <option value="terlama">Paling Awal Mengumpulkan</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <a href="{{ route('assignments.export-rekap', ['assignment' => $assignment->id, 'class_name' => request('class_name')]) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-[#E8EEF5] hover:bg-[#dbe3ed] text-[#4A5568] text-sm font-bold rounded-xl transition">
                        <i class="fas fa-file-excel mr-2 text-emerald-600"></i> Unduh Rekap
                    </a>
                </div>
            </div>

            {{-- Tabel Monitoring --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse border border-slate-300 dark:border-slate-700" id="tabelSiswa">
                    <thead>
                        <tr class="bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                            <th class="px-4 py-3 w-16 border border-slate-300 dark:border-slate-700 text-center">NO</th>
                            <th class="px-4 py-3 border border-slate-300 dark:border-slate-700">NAMA SISWA</th>
                            <th class="px-4 py-3 border border-slate-300 dark:border-slate-700">WAKTU KUMPUL</th>
                            <th class="px-4 py-3 border border-slate-300 dark:border-slate-700 text-center">STATUS PEMERIKSAAN</th>
                            <th class="px-4 py-3 border border-slate-300 dark:border-slate-700 text-center">AKSI KOREKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($studentMonitoring as $index => $monitor)
                        @php
                            $telat = false;
                            $waktuKumpulText = '';
                            $statusLabel = '';
                            $statusClass = '';
                            $statusType = '';
                            
                            if ($monitor->submission) {
                                $waktuKumpulText = $monitor->submission->tanggal_pengumpulan ? $monitor->submission->tanggal_pengumpulan->locale('id')->isoFormat('D MMMM Y, HH:mm') . ' WIB' : '-';
                                if ($monitor->submission->tanggal_pengumpulan && $monitor->submission->tanggal_pengumpulan->gt($assignment->deadline)) {
                                    $telat = true;
                                    $waktuKumpulText .= ' (Telat)';
                                }
                                
                                if ($monitor->submission->is_needs_revision) {
                                    $statusLabel = 'Perlu Revisi';
                                    $statusClass = 'badge-needs-revision';
                                    $statusType = 'perlu_revisi';
                                } elseif ($monitor->submission->grade) {
                                    $statusLabel = 'Sudah Dikoreksi';
                                    $statusClass = 'badge-dikoreksi';
                                    $statusType = 'sudah_dikoreksi';
                                } else {
                                    if ($telat) {
                                        $statusLabel = 'Terlambat';
                                        $statusClass = 'badge-terlambat';
                                        $statusType = 'terlambat';
                                    } else {
                                        $statusLabel = 'Perlu Koreksi';
                                        $statusClass = 'badge-perlu-koreksi';
                                        $statusType = 'perlu_koreksi';
                                    }
                                }
                            } else {
                                $waktuKumpulText = 'Belum ada file';
                                $statusLabel = 'Belum Kumpul';
                                $statusClass = 'badge-belum-kumpul';
                                $statusType = 'belum_kumpul';
                            }
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition table-row-item" 
                            data-nama="{{ strtolower($monitor->student->name) }}" 
                            data-nis="{{ $monitor->student->nis }}" 
                            data-time="{{ $monitor->submission ? ($monitor->submission->tanggal_pengumpulan ? $monitor->submission->tanggal_pengumpulan->timestamp : 0) : 0 }}"
                            @if($monitor->submission)
                            id="submission-row-{{ $monitor->submission->id }}"
                            :data-status="submissions[{{ $monitor->submission->id }}].status_type"
                            @else
                            data-status="belum_kumpul"
                            @endif
                        >
                            <td class="px-4 py-3 text-sm text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-700 text-center index-column">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 border border-slate-300 dark:border-slate-700">
                                <div class="font-bold text-slate-800 dark:text-slate-100 text-sm">
                                    {{ $monitor->student->name }}
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                    NIS: {{ $monitor->student->nis }}
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm border border-slate-300 dark:border-slate-700">
                                @if($monitor->submission)
                                    <span class="{{ $telat ? 'text-rose-600 dark:text-rose-400 font-semibold' : 'text-slate-700 dark:text-slate-300' }}">
                                        {{ $waktuKumpulText }}
                                    </span>
                                @else
                                    <span class="text-slate-400 dark:text-slate-500 italic text-xs">
                                        {{ $waktuKumpulText }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm border border-slate-300 dark:border-slate-700 text-center">
                                @if($monitor->submission)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold status-badge"
                                        :class="submissions[{{ $monitor->submission->id }}].status_class">
                                        <span x-text="submissions[{{ $monitor->submission->id }}].status_label"></span>
                                        <template x-if="submissions[{{ $monitor->submission->id }}].score !== null && submissions[{{ $monitor->submission->id }}].score !== ''">
                                            <span class="ml-1 px-1.5 py-0.5 rounded text-[10px] bg-white/30" x-text="submissions[{{ $monitor->submission->id }}].score + '/{{ $assignment->max_score }}'"></span>
                                        </template>
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center border border-slate-300 dark:border-slate-700">
                                @if($monitor->submission)
                                    @php
                                        $subId = $monitor->submission->id;
                                    @endphp
                                    <div class="flex items-center justify-center gap-2 actions-container">
                                        {{-- Button Pratinjau --}}
                                        <button type="button" 
                                            @click="initPreview(submissions[{{ $subId }}].preview_url, submissions[{{ $subId }}].original_name, 'Jawaban dari: ' + submissions[{{ $subId }}].student_name, {{ $subId }})" 
                                            class="inline-flex items-center justify-center gap-1 px-3.5 py-2 border border-slate-300 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition shadow-sm">
                                            <i class="fas fa-eye mr-1"></i> Pratinjau
                                        </button>

                                        {{-- Tandai Selesai --}}
                                        <template x-if="!submissions[{{ $subId }}].is_graded">
                                            <button type="button" 
                                                @click="openFeedbackModal = true; feedbackActionUrl = '{{ route('submissions.toggle-koreksi', $monitor->submission) }}'; feedbackCatatan = submissions[{{ $subId }}].feedback || ''; feedbackNilai = submissions[{{ $subId }}].score || ''; feedbackSubmissionId = {{ $subId }};" 
                                                class="inline-flex items-center justify-center gap-1 px-3.5 py-2 bg-[#D65A20] hover:bg-[#b84b18] text-xs font-bold text-white rounded-xl transition shadow-sm">
                                                <i class="fas fa-check mr-1"></i> Tandai Selesai
                                            </button>
                                        </template>
                                    </div>
                                @else
                                    <span class="text-slate-400 font-medium">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 text-sm border border-slate-300 dark:border-slate-700">Belum ada siswa terdaftar di kelas ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Floating Preview Modal --}}
        <div
            x-show="openPreview"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
            role="dialog"
            aria-modal="true"
            aria-label="Pratinjau Tugas">

            {{-- Backdrop --}}
            <div
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
                x-show="openPreview"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="closePreview()"
                aria-hidden="true">
            </div>

            {{-- Modal Panel --}}
            <div
                class="relative w-full max-w-5xl my-auto"
                x-show="openPreview"
                x-transition:enter="transition duration-250 ease-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.outside="closePreview()">

                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-2xl border border-slate-200/70 dark:border-slate-800/70 overflow-hidden flex flex-col max-h-[90vh]">

                    {{-- Modal Header --}}
                    <div class="flex items-center justify-between px-8 py-5 border-b border-slate-100 dark:border-slate-800 shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-950/30 text-[#D65A20] flex items-center justify-center text-lg">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-slate-800 dark:text-white" x-text="previewName || 'Pratinjau Soal'"></h2>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400" x-text="previewSubtitle"></p>
                            </div>
                        </div>
                        <button
                            @click="closePreview()"
                            type="button"
                            class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-750 flex items-center justify-center text-slate-500 hover:text-slate-800 dark:hover:text-white transition"
                            title="Tutup">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="p-8 overflow-y-auto flex-1">
                        {{-- Loading State --}}
                        <div x-show="previewLoading" class="flex flex-col items-center justify-center py-20">
                            <div class="w-12 h-12 border-4 border-orange-200 border-t-[#D65A20] rounded-full animate-spin mb-4"></div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Sedang memuat pratinjau...</p>
                        </div>

                        {{-- Error State --}}
                        <div x-show="previewError" class="text-center py-20" x-cloak>
                            <div class="w-16 h-16 rounded-2xl bg-rose-50 dark:bg-rose-950/20 text-rose-500 flex items-center justify-center mx-auto mb-4 text-2xl">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h4 class="text-slate-800 dark:text-white font-bold mb-2">Pratinjau Gagal Dimuat</h4>
                            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-md mx-auto mb-6">Format file tidak didukung untuk pratinjau langsung, atau file tidak dapat diakses.</p>
                            <a :href="previewUrl" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 dark:bg-slate-700 dark:hover:bg-slate-650 text-white text-xs font-bold rounded-xl transition">
                                <i class="fas fa-download"></i> Unduh File Lampiran
                            </a>
                        </div>

                        {{-- Success Content --}}
                        <div x-show="!previewLoading && !previewError" class="space-y-6" x-cloak>
                            {{-- Attachment Content Div --}}
                            <div x-html="previewContent" class="w-full"></div>

                            {{-- Catatan / Pesan Pengumpulan dari Siswa --}}
                            <template x-if="currentSubmissionCatatan">
                                <div class="p-5 bg-amber-50/80 dark:bg-amber-950/30 rounded-2xl border border-amber-200/80 dark:border-amber-800/60 shadow-xs space-y-2">
                                    <h3 class="text-[11px] font-bold text-amber-800 dark:text-amber-300 uppercase tracking-widest flex items-center gap-2">
                                        <i class="fas fa-comment-dots text-amber-600 dark:text-amber-400 text-sm"></i>
                                        Catatan / Pesan Pengumpulan dari Siswa
                                    </h3>
                                    <div class="text-xs sm:text-sm text-slate-800 dark:text-slate-200 leading-relaxed font-medium bg-white/70 dark:bg-slate-900/60 p-3.5 rounded-xl border border-amber-100 dark:border-amber-900/40 whitespace-pre-line">
                                        <span x-text="currentSubmissionCatatan"></span>
                                    </div>
                                </div>
                            </template>

                            {{-- Assignment Text Description (Instruksi) --}}
                            @if($assignment->description)
                            <div class="bg-slate-50 dark:bg-slate-800/20 rounded-2xl border border-slate-200/50 dark:border-slate-800/80 p-6">
                                <h3 class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                                    <i class="fas fa-align-left"></i> Instruksi & Deskripsi Tugas
                                </h3>
                                <div class="prose dark:prose-invert max-w-none text-slate-750 dark:text-slate-300 text-sm leading-relaxed">
                                    {!! nl2br(e($assignment->description)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex items-center justify-between gap-3 px-8 py-5 border-t border-slate-100 dark:border-slate-800 shrink-0">
                        <div>
                            <template x-if="currentSubmissionId">
                                <div class="flex items-center gap-2.5 flex-wrap">
                                    {{-- Tombol Return Jawaban di Modal Preview --}}
                                    <button
                                        type="button"
                                        @click="openRevisionFromPreview()"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 dark:hover:bg-rose-900/60 text-rose-700 dark:text-rose-400 border border-rose-300 dark:border-rose-800/80 text-xs font-bold rounded-xl transition shadow-xs">
                                        <i class="fas fa-undo-alt"></i> Return Jawaban
                                    </button>

                                    {{-- Tombol Beri Nilai / Koreksi di Modal Preview --}}
                                    <button
                                        type="button"
                                        @click="openFeedbackFromPreview()"
                                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#D65A20] hover:bg-[#b84b18] text-white text-xs font-bold rounded-xl transition shadow-xs">
                                        <i class="fas fa-check-circle"></i> Beri Nilai / Tandai Selesai
                                    </button>
                                </div>
                            </template>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                @click="closePreview()"
                                type="button"
                                class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                                Tutup
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- Floating Feedback Options Modal --}}
        <div
            x-show="openFeedbackModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
            role="dialog"
            aria-modal="true"
            aria-label="Pilihan Selesai Koreksi">

            {{-- Backdrop --}}
            <div
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
                x-show="openFeedbackModal"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="openFeedbackModal = false"
                aria-hidden="true">
            </div>

            {{-- Modal Panel --}}
            <div
                class="relative w-full max-w-md my-auto"
                x-show="openFeedbackModal"
                x-transition:enter="transition duration-250 ease-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.outside="openFeedbackModal = false">

                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-2xl border border-slate-200/70 dark:border-slate-800/70 overflow-hidden flex flex-col">

                    {{-- Modal Header --}}
                    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-800 shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-950/30 text-[#D65A20] flex items-center justify-center text-lg">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-slate-800 dark:text-white">Selesai Koreksi</h2>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Pilih opsi penandaan tugas siswa</p>
                            </div>
                        </div>
                        <button
                            @click="openFeedbackModal = false"
                            type="button"
                            class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-750 flex items-center justify-center text-slate-500 hover:text-slate-800 dark:hover:text-white transition"
                            title="Tutup">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <form @submit.prevent="submitFeedbackForm()" class="p-6 flex flex-col space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-2">
                                Nilai (0 - {{ $assignment->max_score }})
                            </label>
                            <input
                                type="number"
                                name="nilai"
                                x-model="feedbackNilai"
                                min="0"
                                max="{{ $assignment->max_score }}"
                                required
                                placeholder="Masukkan nilai..."
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm p-3 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition dark:text-slate-300"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-2">
                                Catatan Koreksi / Feedback (Opsional)
                            </label>
                            <textarea
                                name="catatan"
                                x-model="feedbackCatatan"
                                placeholder="Berikan catatan perbaikan atau feedback untuk siswa..."
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm p-3 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition dark:text-slate-300"
                                rows="4"></textarea>
                        </div>

                        {{-- Modal Footer Actions --}}
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                            <button
                                @click="openFeedbackModal = false"
                                type="button"
                                class="px-4 py-2 border border-slate-300 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                Batal
                            </button>
                            
                            {{-- Selesai Saja (Hanya jika Nilai telah diisi) --}}
                            <button
                                type="button"
                                @click="submitFeedbackForm(false)"
                                :disabled="!isValidNilai()"
                                :class="isValidNilai() ? 'bg-slate-800 hover:bg-slate-900 text-white dark:bg-slate-700 dark:hover:bg-slate-600 cursor-pointer shadow-sm' : 'bg-slate-100 text-slate-400 dark:bg-slate-800/60 dark:text-slate-600 cursor-not-allowed border border-slate-200 dark:border-slate-800'"
                                class="px-4 py-2 text-xs font-bold rounded-xl transition">
                                Selesai Saja
                            </button>

                            {{-- Selesai dengan Catatan (Wajib Nilai & Catatan terisi) --}}
                            <button
                                type="button"
                                @click="submitFeedbackForm(true)"
                                :disabled="!isValidNilai() || !hasCatatan()"
                                :class="(isValidNilai() && hasCatatan()) ? 'bg-[#D65A20] hover:bg-[#b84b18] text-white cursor-pointer shadow-sm' : 'bg-slate-200 text-slate-400 dark:bg-slate-800 dark:text-slate-600 cursor-not-allowed'"
                                class="px-4 py-2 text-xs font-bold rounded-xl transition">
                                Selesai dengan Catatan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Floating Revision Modal (Kembalikan Jawaban / Minta Revisi) --}}
        <div
            x-show="openRevisionModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
            role="dialog"
            aria-modal="true"
            aria-label="Kembalikan Jawaban Siswa">

            {{-- Backdrop --}}
            <div
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
                x-show="openRevisionModal"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="openRevisionModal = false"
                aria-hidden="true">
            </div>

            {{-- Modal Panel --}}
            <div
                class="relative w-full max-w-md my-auto"
                x-show="openRevisionModal"
                x-transition:enter="transition duration-250 ease-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.outside="openRevisionModal = false">

                <div class="bg-white dark:bg-slate-900 rounded-[24px] shadow-2xl border border-rose-200/70 dark:border-rose-900/40 overflow-hidden flex flex-col">

                    {{-- Modal Header --}}
                    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-800 shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-950/40 text-rose-600 flex items-center justify-center text-lg">
                                <i class="fas fa-undo-alt"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-slate-800 dark:text-white">Return Jawaban Siswa</h2>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Siswa: <strong x-text="revisionStudentName"></strong></p>
                            </div>
                        </div>
                        <button
                            @click="openRevisionModal = false"
                            type="button"
                            class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-750 flex items-center justify-center text-slate-500 hover:text-slate-800 dark:hover:text-white transition"
                            title="Tutup">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <form @submit.prevent="submitRevisionForm()" class="p-6 flex flex-col space-y-4">
                        <div class="p-3.5 bg-rose-50 dark:bg-rose-950/20 border border-rose-100 dark:border-rose-900/30 rounded-xl text-xs text-rose-800 dark:text-rose-300">
                            <i class="fas fa-info-circle mr-1"></i> Mengembalikan / return jawaban akan membatalkan status pengumpulan dan mewajibkan siswa mengunggah ulang perbaikan jawaban yang valid.
                        </div>

                        {{-- Pilihan Dropdown Alasan Cepat / Template --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-2">
                                Template Alasan (Pilih atau Isi Manual)
                            </label>
                            <select
                                x-model="revisionPreset"
                                @change="applyRevisionPreset()"
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm p-3 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition dark:text-slate-300">
                                <option value="">-- Pilih Template / Alasan Cepat --</option>
                                <option value="Berkas rusak / corrupt / tidak dapat dibuka atau dibaca.">Berkas rusak / corrupt / tidak dapat dibuka</option>
                                <option value="Berkas kosong atau halaman lembar jawaban tidak lengkap.">Berkas kosong / halaman tidak lengkap</option>
                                <option value="Jawaban tidak sesuai dengan instruksi / topik tugas yang diberikan.">Jawaban tidak sesuai instruksi / topik tugas</option>
                                <option value="Format berkas tidak sesuai ketentuan tugas (harap unggah dokumen PDF / Dokumen asli).">Format berkas tidak sesuai ketentuan</option>
                                <option value="Jawaban terindikasi plagiarisme / menyalin karya siswa lain.">Indikasi plagiarisme / salinan siswa lain</option>
                                <option value="custom">Tulis Alasan Manual / Kustom...</option>
                            </select>
                        </div>

                        {{-- Textarea Alasan (Bisa diedit atau diisi manual) --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                    Alasan / Catatan Pengembalian (Wajib)
                                </label>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 font-normal">bisa diedit manual</span>
                            </div>
                            <textarea
                                name="alasan"
                                x-model="revisionAlasan"
                                x-ref="revisionTextarea"
                                required
                                placeholder="Pilih template di atas atau ketik catatan perbaikan secara manual di sini..."
                                class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm p-3 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition dark:text-slate-300"
                                rows="4"></textarea>
                        </div>

                        {{-- Modal Footer Actions --}}
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                            <button
                                @click="openRevisionModal = false"
                                type="button"
                                class="px-4 py-2 border border-slate-300 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                Batal
                            </button>
                            
                            <button
                                type="submit"
                                :disabled="!revisionAlasan || revisionAlasan.trim().length < 3"
                                :class="(revisionAlasan && revisionAlasan.trim().length >= 3) ? 'bg-rose-600 hover:bg-rose-700 text-white cursor-pointer shadow-sm' : 'bg-slate-200 text-slate-400 dark:bg-slate-800 dark:text-slate-600 cursor-not-allowed'"
                                class="px-4 py-2 text-xs font-bold rounded-xl transition">
                                <i class="fas fa-undo-alt mr-1"></i> Return Jawaban
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div x-show="toastShow" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed bottom-5 right-5 z-50 bg-[#D65A20] text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm font-bold"
             style="display: none;"
             x-cloak>
            <i class="fas fa-check-circle"></i>
            <span x-text="toastMessage"></span>
        </div>
    </div>
@else
    <!-- REDESIGNED STUDENT VIEW -->
    <div class="space-y-6 max-w-4xl mx-auto" x-data="studentAppeal()">
        
        {{-- Breadcrumb & Title --}}
        <div class="mb-6">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                <a href="{{ route('assignments.index') }}" class="hover:text-[#D65A20] transition font-medium">Tugas</a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('assignments.student.detail', $assignment->mata_pelajaran_id) }}" class="hover:text-[#D65A20] transition font-medium">Daftar Tugas</a>
                <span class="text-slate-300">/</span>
                <span class="text-[#D65A20] font-bold">Detail Tugas</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('assignments.student.detail', $assignment->mata_pelajaran_id) }}" class="text-slate-900 dark:text-white hover:text-[#D65A20] transition text-3xl font-extrabold flex items-center gap-3">
                    <i class="fas fa-chevron-left text-2xl"></i>
                    {{ $assignment->title }}
                </a>
            </div>
        </div>

        @php
            $mySub = $assignment->submissions->first();
            $prereqNotCompleted = $assignment->prasyarat_materi_id && !in_array($assignment->prasyarat_materi_id, $completedMaterialIds);
        @endphp

        {{-- Alert & Locking UI --}}
        @if($prereqNotCompleted)
            {{-- Locked due to Prerequisite --}}
            <div class="bg-rose-50/70 dark:bg-rose-950/20 border border-rose-100 dark:border-rose-900/30 rounded-2xl p-6 flex gap-4 items-start shadow-sm shadow-rose-500/5">
                <div class="w-12 h-12 rounded-xl bg-rose-100 dark:bg-rose-900/40 text-rose-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="space-y-1.5 flex-1">
                    <h3 class="text-sm font-bold text-rose-800 dark:text-rose-455 uppercase tracking-wider">Akses Pengumpulan Dikunci (Prasyarat)</h3>
                    @php
                        $prereq = \App\Models\Tugas::find($assignment->prasyarat_materi_id);
                    @endphp
                    <p class="text-xs text-rose-700 dark:text-rose-350 leading-relaxed font-medium">
                        Tugas ini terkunci karena Anda belum menyelesaikan materi prasyarat: <strong>{{ $prereq ? $prereq->judul : 'Materi Prasyarat' }}</strong>
                    </p>
                    <div class="pt-2">
                        @if($prereq)
                            <a href="{{ route('materials.show', $prereq->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-rose-500/10">
                                <i class="fas fa-book-open"></i> Buka Materi: {{ $prereq->judul }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        {{-- 
            [HIDDEN FOR DEMO/CENTRALIZED DFD VERIFICATION]
            Banner Akses Pengumpulan Dikunci & Tombol Banding di halaman detail disembunyikan
            agar seluruh pengajuan banding terpusat melalui halaman daftar tugas mata pelajaran.
        --}}
        @elseif(false && $isLocked)
            {{-- Locked due to Overdue / Tunggakan limit --}}
            <div class="bg-amber-50/70 dark:bg-amber-950/20 border border-amber-100 dark:border-amber-900/30 rounded-2xl p-6 flex gap-4 items-start shadow-sm shadow-amber-500/5">
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/40 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="space-y-1.5 flex-1">
                    <h3 class="text-sm font-bold text-amber-800 dark:text-amber-400 uppercase tracking-wider">Akses Pengumpulan Dikunci (Tunggakan)</h3>
                    <p class="text-xs text-amber-700 dark:text-amber-350 leading-relaxed font-medium">
                        @if($assignment->is_overdue)
                            Tugas ini telah melewati tenggat waktu pengumpulan ({{ $assignment->due_date->format('d M Y, H:i') }} WIB).
                        @else
                            Anda memiliki {{ $tunggakanCount }} tunggakan tugas aktif lainnya. Batas maksimal tunggakan adalah 3 tugas.
                        @endif
                        Silakan hubungi guru pengampu atau ajukan banding pemulihan pengumpulan melalui tombol di bawah ini.
                    </p>
                    
                    @if($pendingAppeal)
                        <div class="pt-2">
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-200 dark:bg-amber-900 text-amber-800 dark:text-amber-300 text-xs font-bold rounded-xl border border-amber-300/40">
                                <i class="fas fa-clock"></i> Banding Sedang Ditinjau Guru
                            </span>
                        </div>
                    @else
                        <div class="pt-2">
                            <button type="button" @click="showAppealModal = true" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-amber-500/10">
                                <i class="fas fa-gavel"></i> Ajukan Banding Pengumpulan
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Task Info Card --}}
        <div class="card bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-2xl shadow-sm space-y-4">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="space-y-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-orange-50 text-orange-700 border border-orange-100 dark:bg-orange-950/30 dark:text-orange-400 dark:border-orange-900/50 uppercase tracking-wider">
                        {{ $assignment->subject->course->name ?? $assignment->subject->nama ?? 'N/A' }}
                    </span>
                    <h2 class="text-xl font-extrabold text-slate-900 dark:text-white pt-1">{{ $assignment->title }}</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                        Oleh: <strong>{{ $assignment->creator->name ?? '-' }}</strong> • Kelas: <strong>{{ $assignment->subject->classRoom->name ?? '-' }}</strong>
                    </p>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Skor Maksimal</span>
                    <span class="text-2xl font-black text-slate-800 dark:text-white block">{{ $assignment->max_score }} Poin</span>
                </div>
            </div>

            <div class="border-t border-b border-slate-100 dark:border-slate-800/80 py-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-semibold">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-slate-500 text-sm">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-normal text-[10px] uppercase">Tenggat Waktu</span>
                        <span class="text-slate-700 dark:text-slate-300 font-bold block">{{ $assignment->due_date->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB</span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-slate-500 text-sm">
                        <i class="far fa-clock"></i>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-normal text-[10px] uppercase">Sisa Waktu</span>
                        <span class="text-slate-700 dark:text-slate-300 font-bold block {{ $assignment->is_overdue ? 'text-rose-500 font-bold' : '' }}">
                            {{ $assignment->time_remaining }}
                        </span>
                    </div>
                </div>
            </div>

            @if($assignment->description)
                <div class="space-y-2 pt-2">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                        <i class="fas fa-align-left text-slate-500"></i>
                        Instruksi & Deskripsi Tugas
                    </h4>
                    <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 text-sm leading-relaxed p-5 bg-slate-50/50 dark:bg-slate-850/30 rounded-2xl border border-slate-100 dark:border-slate-800/50">
                        {!! nl2br(e($assignment->description)) !!}
                    </div>
                </div>
            @endif

            @if($assignment->attachment)
                @if($assignment->is_attachment_image || ($assignment->isVisual() && !$assignment->is_attachment_pdf))
                    {{-- Visual Media Preview Card (Image / Poster / Artwork) --}}
                    <div class="pt-3 space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold text-purple-600 dark:text-purple-400 uppercase tracking-wider flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-purple-100 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs">
                                    <i class="fas fa-palette"></i>
                                </span>
                                <span>Media Visual Acuan Guru</span>
                            </h4>
                            <div class="flex items-center gap-2">
                                <button type="button" @click="openImageLightbox('{{ $assignment->preview_url }}', '{{ addslashes($assignment->title) }}', '{{ addslashes(basename($assignment->attachment)) }}')" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-50 hover:bg-purple-100 dark:bg-purple-950/40 dark:hover:bg-purple-900/40 text-purple-700 dark:text-purple-300 font-bold text-xs rounded-xl border border-purple-200/60 dark:border-purple-800/60 transition shadow-xs">
                                    <i class="fas fa-expand-alt"></i> Pratinjau Penuh
                                </button>
                                <a href="{{ $assignment->attachment_url }}" target="_blank" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs rounded-xl transition">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                            </div>
                        </div>

                        {{-- Interactive Visual Preview Container --}}
                        <div class="group relative rounded-2xl overflow-hidden border border-purple-150 dark:border-purple-900/40 bg-slate-900/5 dark:bg-slate-950/50 shadow-inner flex flex-col items-center justify-center transition-all">
                            {{-- Image Display with Click to Zoom --}}
                            <div class="relative w-full flex items-center justify-center p-4 cursor-pointer"
                                 @click="openImageLightbox('{{ $assignment->preview_url }}', '{{ addslashes($assignment->title) }}', '{{ addslashes(basename($assignment->attachment)) }}')">
                                <img src="{{ $assignment->preview_url }}" 
                                     alt="Media Visual: {{ $assignment->title }}"
                                     loading="lazy"
                                     class="max-h-[480px] w-auto max-w-full rounded-xl object-contain shadow-md transition-transform duration-300 group-hover:scale-[1.01]" />
                                
                                {{-- Hover Overlay Badge --}}
                                <div class="absolute inset-0 bg-slate-950/0 group-hover:bg-slate-950/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100 backdrop-blur-[1px] rounded-2xl">
                                    <span class="px-4 py-2 bg-black/75 text-white text-xs font-bold rounded-xl shadow-lg flex items-center gap-2 transform translate-y-2 group-hover:translate-y-0 transition-all">
                                        <i class="fas fa-search-plus text-purple-400"></i> Klik untuk Perbesar Layar Penuh
                                    </span>
                                </div>
                            </div>
                            {{-- Caption Footer --}}
                            <div class="w-full px-4 py-2.5 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm border-t border-purple-100 dark:border-purple-900/30 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2 truncate text-slate-600 dark:text-slate-300 font-medium">
                                    <i class="far fa-image text-purple-500"></i>
                                    <span class="truncate">{{ basename($assignment->attachment) }}</span>
                                </div>
                                <span class="text-[10px] text-purple-600 dark:text-purple-400 font-bold uppercase tracking-wider bg-purple-50 dark:bg-purple-950/60 px-2 py-0.5 rounded-md">
                                    Gambar Acuan
                                </span>
                            </div>
                        </div>
                    </div>
                @elseif($assignment->is_attachment_pdf)
                    {{-- PDF Preview Card --}}
                    <div class="pt-3 space-y-3">
                        <div class="flex items-center justify-between p-4 bg-rose-50/50 dark:bg-rose-950/20 rounded-2xl border border-rose-100 dark:border-rose-900/40">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-11 h-11 rounded-xl bg-rose-100 dark:bg-rose-900/50 text-rose-600 flex items-center justify-center text-xl flex-shrink-0 shadow-xs">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block truncate">{{ basename($assignment->attachment) }}</span>
                                    <span class="text-[10px] text-rose-600 dark:text-rose-400 font-semibold block">Dokumen Acuan / Lembar Kerja (PDF)</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <button type="button" @click="openPdfModal('{{ $assignment->preview_url }}', '{{ addslashes(basename($assignment->attachment)) }}')" class="px-3.5 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl transition shadow-xs flex items-center gap-1.5">
                                    <i class="fas fa-eye"></i> Buka Pratinjau
                                </button>
                                <a href="{{ $assignment->attachment_url }}" target="_blank" class="px-3.5 py-2 bg-white hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs rounded-xl border border-slate-200 dark:border-slate-700 transition flex items-center gap-1.5">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif($assignment->is_attachment_video)
                    {{-- Native Video Player Card --}}
                    <div class="pt-3 space-y-2">
                        <h4 class="text-xs font-bold text-rose-600 dark:text-rose-400 uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-play-circle"></i> Video Panduan / Instruksi Guru
                        </h4>
                        <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-black aspect-video">
                            <video controls class="w-full h-full" preload="metadata">
                                <source src="{{ $assignment->preview_url }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video HTML5.
                            </video>
                        </div>
                    </div>
                @elseif($assignment->is_attachment_url)
                    {{-- Video URL Embed (YouTube / Drive) --}}
                    <div class="pt-3 space-y-2">
                        <h4 class="text-xs font-bold text-rose-600 dark:text-rose-400 uppercase tracking-wider flex items-center gap-2">
                            <i class="fab fa-youtube text-red-500"></i> Video Panduan / Instruksi Guru
                        </h4>
                        @if($assignment->attachment_embed_url)
                            <div class="rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-black aspect-video shadow-md">
                                <iframe src="{{ $assignment->attachment_embed_url }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="p-4 bg-slate-50 dark:bg-slate-850 rounded-xl border border-slate-200 dark:border-slate-700 flex items-center justify-between">
                                <div class="flex items-center gap-2 text-xs font-semibold">
                                    <i class="fas fa-link text-rose-500"></i>
                                    <span class="truncate">{{ $assignment->attachment }}</span>
                                </div>
                                <a href="{{ $assignment->attachment }}" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 bg-rose-600 text-white font-bold text-xs rounded-xl">
                                    Buka Link
                                </a>
                            </div>
                        @endif
                    </div>
                @else
                    {{-- Generic Attachment Download Box --}}
                    <div class="pt-2 flex items-center justify-between p-4 bg-slate-50/50 dark:bg-slate-850/30 rounded-2xl border border-slate-100 dark:border-slate-800/50">
                        <div class="flex items-center gap-3 bg-transparent">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center text-lg">
                                <i class="fas fa-paperclip"></i>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300 block truncate max-w-xs">{{ basename($assignment->attachment) }}</span>
                                <span class="text-[10px] text-slate-400 font-semibold block">Berkas Pendukung</span>
                            </div>
                        </div>
                        <a href="{{ $assignment->attachment_url }}" target="_blank" class="px-4 py-2 bg-orange-100 hover:bg-[#D65A20] text-[#D65A20] hover:text-white font-bold text-xs rounded-xl transition shadow-sm">
                            <i class="fas fa-download mr-1"></i> Unduh
                        </a>
                    </div>
                @endif
            @endif
        </div>

        {{-- Submission Area --}}
        @if($mySub && $mySub->is_needs_revision)
            {{-- Returned / Needs Revision --}}
            <div class="card bg-rose-50/60 dark:bg-rose-950/20 border-2 border-rose-300 dark:border-rose-900/50 p-6 rounded-2xl shadow-sm space-y-5">
                <div class="flex items-center justify-between border-b border-rose-200 dark:border-rose-900/40 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-900/50 text-rose-600 flex items-center justify-center text-lg">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-rose-800 dark:text-rose-300">Tugas Dikembalikan oleh Guru (Perlu Revisi)</h3>
                            <p class="text-[11px] text-rose-600 dark:text-rose-400 font-semibold mt-0.5">
                                Dikembalikan pada: {{ $mySub->dikembalikan_pada ? $mySub->dikembalikan_pada->locale('id')->isoFormat('D MMMM Y, HH:mm') . ' WIB' : '-' }}
                            </p>
                        </div>
                    </div>
                    <span class="px-3.5 py-1 bg-rose-100 text-rose-800 dark:bg-rose-900/60 dark:text-rose-200 rounded-xl text-xs font-bold border border-rose-300 dark:border-rose-800">
                        Wajib Unggah Ulang
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-rose-200 dark:border-rose-800/80 shadow-xs">
                        <h4 class="text-xs font-bold text-rose-700 dark:text-rose-400 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <i class="fas fa-comment-dots"></i> Catatan & Alasan Pengembalian dari Guru:
                        </h4>
                        <div class="text-sm text-slate-800 dark:text-slate-100 font-medium leading-relaxed bg-rose-50/50 dark:bg-slate-800 p-3 rounded-lg border border-rose-100 dark:border-slate-700">
                            {{ $mySub->alasan_pengembalian ?: 'Harap periksa kembali berkas jawaban Anda dan unggah ulang berkas yang valid sesuai instruksi tugas.' }}
                        </div>
                    </div>

                    <form action="{{ route('submissions.store', $assignment) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Unggah Berkas Perbaikan / Revisi Baru:
                            </label>
                            <input type="file" name="file" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#D65A20] file:text-white hover:file:bg-[#b84b18] file:cursor-pointer transition" />
                        </div>
                        <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Catatan Perbaikan / Pesan untuk Guru (Opsional):
                            </label>
                            <textarea name="catatan" rows="2" class="w-full text-xs p-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-slate-200 outline-none focus:border-[#D65A20]" placeholder="Tambahkan penjelasan perbaikan jika ada..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#D65A20] hover:bg-[#b84b18] text-white text-xs font-bold rounded-xl transition shadow-md shadow-orange-500/10">
                                <i class="fas fa-paper-plane"></i> Kirim Jawaban Revisi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @elseif($mySub)
            {{-- Submitted --}}
            <div class="card bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-2xl shadow-sm space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-850 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 flex items-center justify-center text-lg">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 dark:text-white">Tugas Telah Dikumpulkan</h3>
                            <p class="text-[10px] text-slate-400 font-semibold mt-0.5">
                                Dikirim pada: {{ $mySub->tanggal_pengumpulan ? $mySub->tanggal_pengumpulan->locale('id')->isoFormat('D MMMM Y, HH:mm') . ' WIB' : '-' }}
                            </p>
                        </div>
                    </div>
                    @if($mySub->grade)
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-950/30 dark:text-emerald-400 dark:border-emerald-900/50 rounded-xl text-xs font-bold">
                            Sudah Dinilai
                        </span>
                    @else
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 dark:bg-blue-950/30 dark:text-blue-400 dark:border-blue-900/50 rounded-xl text-xs font-bold">
                            Menunggu Koreksi
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                    {{-- Left column --}}
                    <div class="md:col-span-8 space-y-4">
                        <div class="space-y-2">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block">Berkas Pengumpulan Anda</span>
                            <div class="flex items-center justify-between p-3.5 bg-slate-50 dark:bg-slate-855/50 rounded-xl border border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <i class="fas fa-file-pdf text-rose-500 text-lg"></i>
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate block">{{ $mySub->original_name ?: basename($mySub->file_tugas) }}</span>
                                </div>
                                <a href="{{ route('download.submission', $mySub->id) }}" target="_blank" class="text-xs text-[#D65A20] hover:text-orange-700 font-bold whitespace-nowrap pl-2">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                            </div>
                        </div>

                        @if($mySub->catatan)
                            <div class="space-y-2">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block">Catatan Pengumpulan Anda</span>
                                <div class="p-4 bg-amber-50/60 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-900/30 rounded-2xl text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-medium whitespace-pre-line">
                                    <i class="fas fa-comment-dots text-amber-600 dark:text-amber-400 mr-1.5"></i> {{ $mySub->catatan }}
                                </div>
                            </div>
                        @endif

                        @if($mySub->grade && $mySub->grade->notes)
                            <div class="space-y-2">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest block">Catatan dari Guru</span>
                                <div class="p-4 bg-slate-50 dark:bg-slate-855/50 border border-slate-100 dark:border-slate-850 rounded-2xl text-xs text-slate-600 dark:text-slate-300 leading-relaxed font-medium">
                                    {{ $mySub->grade->notes }}
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Right column (Score Card) --}}
                    <div class="md:col-span-4 flex flex-col items-center justify-center p-5 bg-slate-50/50 dark:bg-slate-850/20 border border-slate-100 dark:border-slate-800 rounded-2xl text-center">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nilai Tugas</span>
                        @if($mySub->grade)
                            <div class="mt-2 flex items-baseline justify-center">
                                <span class="text-5xl font-black text-emerald-600">{{ $mySub->grade->score }}</span>
                                <span class="text-sm font-bold text-slate-400 ml-1">/{{ $assignment->max_score }}</span>
                            </div>
                            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold mt-2 uppercase tracking-wide">Lulus Kriteria</span>
                        @else
                            <div class="mt-2 text-slate-400 flex flex-col items-center justify-center">
                                <i class="fas fa-hourglass-half text-3xl mb-1"></i>
                                <span class="text-xs font-bold block pt-1">Belum Dinilai</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        {{-- 
            [HIDDEN FOR DEMO/CENTRALIZED DFD VERIFICATION]
            Form Kirim Lembar Jawaban di halaman detail disembunyikan agar seluruh pengumpulan 
            berjalan melalui modal verifikasi middleware SSL pada halaman daftar tugas.
        --}}
        @elseif(false && !$isLocked)
            {{-- Submit Form --}}
            <div class="card bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-2xl shadow-sm space-y-4">
                <div class="flex items-center gap-3 border-b border-slate-100 dark:border-slate-850 pb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center text-lg">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white">Kirim Lembar Jawaban</h3>
                        <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Unggah berkas tugas Anda sebelum batas waktu berakhir.</p>
                    </div>
                </div>

                <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4" @submit="uploading = true">
                    @csrf
                    
                    <div class="relative" 
                        @dragover.prevent="isDragging = true" 
                        @dragleave.prevent="isDragging = false"
                        @drop.prevent="isDragging = false; handleFileDrop($event)">
                        
                        <input type="file" name="file" id="tugasFileInput" class="sr-only" 
                            accept=".pdf,.doc,.docx,.zip"
                            @change="handleFileChange($event)" required />
                        
                        <label for="tugasFileInput" 
                            class="flex flex-col items-center justify-center gap-3 p-8 border-2 border-dashed rounded-2xl cursor-pointer transition-all duration-200"
                            :class="isDragging ? 'border-orange-400 bg-orange-50/30' : (fileSelected ? 'border-emerald-300 bg-emerald-50/20 dark:bg-emerald-950/10' : 'border-slate-200 dark:border-slate-700 hover:border-orange-300 hover:bg-orange-50/20')">
                            
                            <template x-if="!fileSelected">
                                <div class="text-center">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-cloud-upload-alt text-xl text-slate-400"></i>
                                    </div>
                                    <p class="text-sm font-bold text-slate-650 dark:text-slate-300">Pilih berkas jawaban atau <span class="text-[#D65A20]">seret ke sini</span></p>
                                    <p class="text-[10px] text-slate-400 font-semibold mt-1">PDF, DOC, DOCX, ZIP (maks 10MB)</p>
                                </div>
                            </template>

                            <template x-if="fileSelected">
                                <div class="flex items-center gap-3 w-full p-1">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 flex items-center justify-center flex-shrink-0 text-lg">
                                        <i class="fas" :class="fileIcon"></i>
                                    </div>
                                    <div class="flex-1 min-w-0 text-left">
                                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100 truncate" x-text="fileName"></p>
                                        <p class="text-[10px] text-slate-400" x-text="fileSize"></p>
                                    </div>
                                    <button type="button" @click.prevent="removeSelectedFile()" class="text-slate-400 hover:text-rose-500 transition p-1.5 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-955/20">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </template>
                        </label>
                    </div>

                    <div>
                        <button type="submit" :disabled="uploading || !fileSelected" 
                            :class="(!fileSelected || uploading) ? 'bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-650 cursor-not-allowed' : 'bg-[#D65A20] hover:bg-orange-700 text-white shadow-md shadow-orange-500/10'" 
                            class="w-full inline-flex items-center justify-center px-6 py-3 font-bold rounded-xl text-sm transition">
                            <template x-if="!uploading">
                                <span><i class="fas fa-paper-plane mr-1.5"></i> Kirim Lembar Jawaban</span>
                            </template>
                            <template x-if="uploading">
                                <span><i class="fas fa-spinner animate-spin mr-1.5"></i> Mengirim Tugas...</span>
                            </template>
                        </button>
                    </div>
                </form>
            </div>
        @endif

        {{-- Appeal Modal --}}
        <div x-show="showAppealModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" x-show="showAppealModal" x-transition.opacity @click="showAppealModal = false"></div>
            <div class="relative w-full max-w-lg my-auto bg-white dark:bg-slate-900 rounded-[24px] shadow-2xl border border-slate-200/70 dark:border-slate-800/70 overflow-hidden flex flex-col transition" x-show="showAppealModal" x-transition>
                
                {{-- Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-800 shrink-0">
                    <div class="flex items-center gap-3 bg-transparent">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center text-lg">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800 dark:text-white">Banding Pemulihan Pengumpulan</h2>
                            <p class="text-[10px] text-slate-400 mt-0.5">Kirim pengajuan dispensasi agar akses tugas dibuka kembali.</p>
                        </div>
                    </div>
                    <button @click="showAppealModal = false" type="button" class="w-8 h-8 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-850 flex items-center justify-center text-slate-400 hover:text-slate-700 dark:hover:text-white transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                {{-- Body --}}
                <form action="{{ route('siswa.assignments.banding', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label for="kategori_alasan" class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Kategori Alasan</label>
                        <select name="kategori_alasan" id="kategori_alasan" class="select" required>
                            <option value="" disabled selected>Pilih alasan utama...</option>
                            <option value="Sakit">Sakit (Memerlukan Surat Dokter)</option>
                            <option value="Kendala Teknis/Jaringan">Kendala Teknis/Jaringan internet</option>
                            <option value="Izin Resmi">Izin Resmi Kegiatan Sekolah</option>
                            <option value="Lainnya">Alasan Mendesak Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="penjelasan" class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Penjelasan Detail</label>
                        <textarea name="penjelasan" id="penjelasan" rows="4" x-model="penjelasanText" placeholder="Jelaskan kendala Anda secara kronologis (minimal 50 karakter)..." class="input p-3 text-sm focus:outline-none" required></textarea>
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-[10px] font-semibold" :class="penjelasanText.length >= 50 ? 'text-emerald-500' : 'text-slate-400'"><span x-text="penjelasanText.length"></span> / 50 karakter</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Unggah Bukti Pendukung <span class="text-rose-500">*</span></label>
                        <div class="relative" 
                            @dragover.prevent="appealDragging = true" 
                            @dragleave.prevent="appealDragging = false"
                            @drop.prevent="appealDragging = false; appealDrop($event)">
                            <input type="file" name="bukti_pendukung" id="appealFileInput" class="sr-only" accept=".pdf,.jpg,.jpeg,.png" @change="handleAppealFileChange($event)" required />
                            
                            <label for="appealFileInput" 
                                class="flex flex-col items-center justify-center gap-2 p-5 border-2 border-dashed rounded-2xl cursor-pointer transition-all duration-200"
                                :class="appealDragging ? 'border-orange-400 bg-orange-50/20' : (appealFileSelected ? 'border-emerald-300 bg-emerald-50/10' : 'border-slate-200 dark:border-slate-700 hover:border-orange-300')">
                                
                                <template x-if="!appealFileSelected">
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-lg text-slate-400 mb-1"></i>
                                        <p class="text-xs font-bold text-slate-600 dark:text-slate-300">Pilih berkas bukti atau seret ke sini</p>
                                        <p class="text-[9px] text-slate-400">PDF, JPG, JPEG, PNG (maks 2MB)</p>
                                    </div>
                                </template>

                                <template x-if="appealFileSelected">
                                    <div class="flex items-center gap-3 w-full">
                                        <i class="fas" :class="appealFileIcon" class="text-lg flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0 text-left">
                                            <p class="text-xs font-bold text-slate-800 dark:text-slate-100 truncate" x-text="appealFileName"></p>
                                            <p class="text-[9px] text-slate-400" x-text="appealFileSize"></p>
                                        </div>
                                        <button type="button" @click.prevent="removeAppealFile()" class="text-slate-400 hover:text-rose-500 transition p-1">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </template>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5 pt-1">
                        <input type="checkbox" name="commitment" id="appealCommitment" x-model="hasCommitted" class="w-4 h-4 text-orange-600 border-slate-300 rounded focus:ring-orange-500 mt-0.5" required />
                        <label for="appealCommitment" class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 leading-snug">
                            Saya berkomitmen untuk mengerjakan tugas ini dengan jujur dan bersungguh-sungguh segera setelah akses dibuka.
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <button type="button" @click="showAppealModal = false" class="px-4 py-2 border border-slate-300 dark:border-slate-700 text-xs font-bold text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            Batal
                        </button>
                        <button type="submit" :disabled="!hasCommitted || penjelasanText.length < 50" :class="(!hasCommitted || penjelasanText.length < 50) ? 'bg-slate-100 text-slate-400 cursor-not-allowed dark:bg-slate-800 dark:text-slate-600' : 'bg-[#D65A20] hover:bg-orange-700 text-white'" class="px-5 py-2.5 text-xs font-bold rounded-xl transition">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Image Lightbox Modal for Visual Media --}}
        <div x-show="lightboxOpen" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 md:p-6" 
             role="dialog" aria-modal="true"
             @keydown.escape.window="closeImageLightbox()">
            
            {{-- Backdrop with Blur --}}
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-md transition-opacity" 
                 x-show="lightboxOpen" 
                 x-transition.opacity 
                 @click="closeImageLightbox()"></div>

            {{-- Modal Content --}}
            <div class="relative w-full max-w-5xl max-h-[92vh] bg-slate-900 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden flex flex-col transition-all transform"
                 x-show="lightboxOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.stop>
                
                {{-- Lightbox Toolbar Header --}}
                <div class="px-5 py-3.5 bg-slate-950/90 border-b border-slate-800 flex items-center justify-between gap-4 text-white">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center text-base flex-shrink-0">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-100 truncate" x-text="lightboxTitle"></h3>
                            <p class="text-[10px] sm:text-[11px] text-slate-400 truncate" x-text="lightboxFileName"></p>
                        </div>
                    </div>

                    {{-- Controls --}}
                    <div class="flex items-center gap-1.5 sm:gap-2 flex-shrink-0">
                        <button type="button" @click="zoomOut()" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition" title="Zoom Out (-)">
                            <i class="fas fa-search-minus text-xs"></i>
                        </button>
                        <span class="text-xs font-mono text-slate-400 min-w-[2.75rem] text-center" x-text="Math.round(lightboxZoom * 100) + '%'"></span>
                        <button type="button" @click="zoomIn()" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 flex items-center justify-center transition" title="Zoom In (+)">
                            <i class="fas fa-search-plus text-xs"></i>
                        </button>
                        <button type="button" @click="resetZoom()" class="px-2 py-1 text-xs rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 transition" title="Reset Zoom">
                            100%
                        </button>
                        <a :href="lightboxSrc" download target="_blank" class="px-3 py-1.5 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-semibold text-xs flex items-center gap-1.5 transition ml-1" title="Unduh Berkas">
                            <i class="fas fa-download text-xs"></i> <span class="hidden sm:inline">Unduh</span>
                        </a>
                        <button type="button" @click="closeImageLightbox()" class="w-8 h-8 rounded-lg bg-rose-500/20 hover:bg-rose-500 text-rose-300 hover:text-white flex items-center justify-center transition ml-1" title="Tutup (ESC)">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- Image View Area with Zoom Support --}}
                <div class="relative flex-1 overflow-auto p-4 sm:p-6 flex items-center justify-center bg-slate-950/60 select-none min-h-[300px]">
                    <img :src="lightboxSrc" 
                         :alt="lightboxTitle" 
                         class="max-w-none transition-transform duration-150 ease-out rounded-lg shadow-2xl"
                         :style="'transform: scale(' + lightboxZoom + '); transform-origin: center center; max-height: calc(85vh - 120px);'" />
                </div>
            </div>
        </div>

        {{-- PDF Preview Modal for Student --}}
        <div x-show="pdfModalOpen" x-cloak 
             class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 md:p-6" 
             role="dialog" aria-modal="true"
             @keydown.escape.window="closePdfModal()">
            
            <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-md transition-opacity" 
                 x-show="pdfModalOpen" 
                 x-transition.opacity 
                 @click="closePdfModal()"></div>

            <div class="relative w-full max-w-5xl h-[90vh] bg-slate-900 rounded-3xl shadow-2xl border border-slate-700 overflow-hidden flex flex-col transition-all"
                 x-show="pdfModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.stop>
                
                <div class="px-5 py-3.5 bg-slate-950/90 border-b border-slate-800 flex items-center justify-between text-white">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-base">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3 class="text-xs sm:text-sm font-bold text-slate-100 truncate" x-text="pdfModalTitle"></h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <a :href="pdfModalSrc" download target="_blank" class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-500 text-white font-semibold text-xs flex items-center gap-1.5 transition">
                            <i class="fas fa-download text-xs"></i> <span class="hidden sm:inline">Unduh</span>
                        </a>
                        <button type="button" @click="closePdfModal()" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-rose-500 text-slate-300 hover:text-white flex items-center justify-center transition">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                </div>
                <div class="flex-1 w-full bg-slate-950">
                    <iframe :src="pdfModalSrc" class="w-full h-full border-0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
<div class="fixed bottom-5 left-5 z-50 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-xl shadow-lg shadow-emerald-500/10 max-w-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        <span class="font-semibold text-xs">{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition pl-4">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif

@if(session('error'))
<div class="fixed bottom-5 left-5 z-50 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-xl shadow-lg shadow-rose-500/10 max-w-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-exclamation-circle"></i>
        <span class="font-semibold text-xs">{{ session('error') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition pl-4">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif

@endsection

@push('scripts')
<script>
    function studentAppeal() {
        return {
            showAppealModal: false,
            fileSelected: false,
            fileName: '',
            fileSize: '',
            fileIcon: 'fa-file text-slate-400',
            isDragging: false,
            uploading: false,
            
            // Lightbox Modal for Image
            lightboxOpen: false,
            lightboxSrc: '',
            lightboxTitle: '',
            lightboxFileName: '',
            lightboxZoom: 1,

            // PDF Modal
            pdfModalOpen: false,
            pdfModalSrc: '',
            pdfModalTitle: '',
            
            appealFileSelected: false,
            appealFileName: '',
            appealFileSize: '',
            appealFileIcon: 'fa-file text-slate-400',
            appealDragging: false,
            hasCommitted: false,
            penjelasanText: '',

            openImageLightbox(src, title, fileName) {
                this.lightboxSrc = src;
                this.lightboxTitle = title;
                this.lightboxFileName = fileName;
                this.lightboxZoom = 1;
                this.lightboxOpen = true;
            },
            closeImageLightbox() {
                this.lightboxOpen = false;
                this.lightboxSrc = '';
            },
            zoomIn() {
                this.lightboxZoom = Math.min(3, +(this.lightboxZoom + 0.25).toFixed(2));
            },
            zoomOut() {
                this.lightboxZoom = Math.max(0.5, +(this.lightboxZoom - 0.25).toFixed(2));
            },
            resetZoom() {
                this.lightboxZoom = 1;
            },

            openPdfModal(src, title) {
                this.pdfModalSrc = src;
                this.pdfModalTitle = title;
                this.pdfModalOpen = true;
            },
            closePdfModal() {
                this.pdfModalOpen = false;
                this.pdfModalSrc = '';
            },

            handleFileChange(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    this.selectFile(files[0]);
                }
            },
            handleFileDrop(e) {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    this.selectFile(files[0]);
                }
            },
            selectFile(file) {
                const ext = file.name.split('.').pop().toLowerCase();
                const allowed = ['pdf', 'doc', 'docx', 'zip'];
                if (!allowed.includes(ext)) {
                    alert('Format file tidak didukung. Gunakan PDF, DOC, DOCX, atau ZIP.');
                    return;
                }
                if (file.size > 10 * 1024 * 1024) {
                    alert('Ukuran file maksimal 10MB.');
                    return;
                }
                this.fileSelected = true;
                this.fileName = file.name;
                this.fileSize = (file.size / 1024).toFixed(1) + ' KB';
                
                if (ext === 'pdf') this.fileIcon = 'fa-file-pdf text-rose-500';
                else if (['doc', 'docx'].includes(ext)) this.fileIcon = 'fa-file-word text-blue-500';
                else if (ext === 'zip') this.fileIcon = 'fa-file-archive text-amber-500';
                else this.fileIcon = 'fa-file text-slate-450';
            },
            removeSelectedFile() {
                this.fileSelected = false;
                this.fileName = '';
                this.fileSize = '';
                this.fileIcon = 'fa-file text-slate-400';
                const input = document.getElementById('tugasFileInput');
                if (input) input.value = '';
            },

            handleAppealFileChange(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    this.selectAppealFile(files[0]);
                }
            },
            appealDrop(e) {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    this.selectAppealFile(files[0]);
                }
            },
            selectAppealFile(file) {
                const ext = file.name.split('.').pop().toLowerCase();
                const allowed = ['pdf', 'jpg', 'jpeg', 'png'];
                if (!allowed.includes(ext)) {
                    alert('Format file tidak didukung. Gunakan PDF, JPG, atau PNG.');
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB.');
                    return;
                }
                this.appealFileSelected = true;
                this.appealFileName = file.name;
                this.appealFileSize = (file.size / 1024).toFixed(1) + ' KB';
                
                if (ext === 'pdf') this.appealFileIcon = 'fa-file-pdf text-rose-500';
                else if (['jpg', 'jpeg', 'png'].includes(ext)) this.appealFileIcon = 'fa-file-image text-emerald-500';
                else this.appealFileIcon = 'fa-file text-slate-455';
            },
            removeAppealFile() {
                this.appealFileSelected = false;
                this.appealFileName = '';
                this.appealFileSize = '';
                this.appealFileIcon = 'fa-file text-slate-400';
                const input = document.getElementById('appealFileInput');
                if (input) input.value = '';
            }
        };
    }

    function teacherAssignmentPreview() {
        return {
            openPreview: false,
            previewUrl: '',
            previewName: '',
            previewSubtitle: 'Pratinjau Soal & Instruksi Tugas',
            previewLoading: false,
            previewError: false,
            previewContent: '',
            openFeedbackModal: false,
            feedbackActionUrl: '',
            feedbackCatatan: '',
            feedbackNilai: '',
            feedbackSubmissionId: null,
            openRevisionModal: false,
            revisionActionUrl: '',
            revisionAlasan: '',
            revisionPreset: '',
            revisionSubmissionId: null,
            revisionStudentName: '',
            currentSubmissionId: null,
            currentSubmissionCatatan: '',
            toastShow: false,
            toastMessage: '',
            submissions: {
                @foreach($studentMonitoring as $monitor)
                    @if($monitor->submission)
                        @php
                            $telat = $monitor->submission->tanggal_pengumpulan && $monitor->submission->tanggal_pengumpulan->gt($assignment->deadline);
                            if ($monitor->submission->is_needs_revision) {
                                $sLabel = 'Return Jawaban';
                                $sClass = 'badge-needs-revision';
                                $sType = 'perlu_revisi';
                            } elseif ($monitor->submission->grade) {
                                $sLabel = 'Sudah Dikoreksi';
                                $sClass = 'badge-dikoreksi';
                                $sType = 'sudah_dikoreksi';
                            } else {
                                if ($telat) {
                                    $sLabel = 'Terlambat';
                                    $sClass = 'badge-terlambat';
                                    $sType = 'terlambat';
                                } else {
                                    $sLabel = 'Perlu Koreksi';
                                    $sClass = 'badge-perlu-koreksi';
                                    $sType = 'perlu_koreksi';
                                }
                            }
                        @endphp
                        "{{ $monitor->submission->id }}": {
                            is_graded: {{ $monitor->submission->grade ? 'true' : 'false' }},
                            status_label: '{{ $sLabel }}',
                            status_class: '{{ $sClass }}',
                            status_type: '{{ $sType }}',
                            score: '{{ $monitor->submission->grade ? $monitor->submission->grade->score : '' }}',
                            feedback: '{{ $monitor->submission->grade ? addslashes($monitor->submission->grade->feedback) : '' }}',
                            alasan_pengembalian: '{{ addslashes($monitor->submission->alasan_pengembalian ?? "") }}',
                            catatan: '{{ addslashes($monitor->submission->catatan ?? "") }}',
                            original_name: '{{ addslashes($monitor->submission->original_name ?? $monitor->submission->submission_url ?? "Tautan Pengumpulan") }}',
                            attachment_url: '{{ $monitor->submission->attachment_url }}',
                            preview_url: '{{ $monitor->submission->preview_url }}',
                            submission_url: '{{ $monitor->submission->submission_url }}',
                            video_embed_url: '{{ $monitor->submission->video_embed_url }}',
                            is_video_embeddable: {{ $monitor->submission->is_video_embeddable ? 'true' : 'false' }},
                            is_url_submission: {{ $monitor->submission->is_url_submission ? 'true' : 'false' }},
                            platform_data: @json($monitor->submission->platform_data),
                            student_name: '{{ addslashes($monitor->student->name) }}'
                        },
                    @endif
                @endforeach
            },
            
            initPreview(url, name, subtitle = 'Pratinjau Soal & Instruksi Tugas', submissionId = null) {
                this.previewUrl = url;
                this.previewName = name;
                this.previewSubtitle = subtitle;
                this.currentSubmissionId = submissionId;
                const sub = submissionId ? this.submissions[submissionId] : null;
                this.currentSubmissionCatatan = (sub && sub.catatan) ? sub.catatan : '';
                this.openPreview = true;
                this.previewLoading = true;
                this.previewError = false;
                this.previewContent = '';
                document.body.style.overflow = 'hidden';

                // 1. Tautan Pengumpulan Video Streaming (YouTube, Google Drive, Loom)
                if (sub && sub.video_embed_url) {
                    this.previewContent = `
                        <div class="space-y-4">
                            <div class="aspect-video w-full rounded-2xl overflow-hidden bg-black shadow-lg">
                                <iframe src="${sub.video_embed_url}" class="w-full h-full"
                                    sandbox="allow-scripts allow-same-origin allow-presentation"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen loading="lazy"></iframe>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-200 dark:border-slate-700">
                                <div class="min-w-0 flex-1 pr-3">
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300 block mb-0.5">Tautan Asli Video Siswa:</span>
                                    <a href="${sub.submission_url}" target="_blank" rel="noopener noreferrer" class="text-xs text-red-600 dark:text-red-400 hover:underline truncate block font-mono">
                                        ${sub.submission_url}
                                    </a>
                                </div>
                                <a href="${sub.submission_url}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl transition flex items-center gap-1.5 shrink-0 shadow-sm">
                                    <i class="fas fa-external-link-alt text-[10px]"></i> Buka di Tab Baru
                                </a>
                            </div>
                        </div>
                    `;
                    this.previewLoading = false;
                    return;
                }

                // 2. Tautan Karya Platform Eksternal (Canva, Figma, GitHub, Google Drive/Docs)
                if (sub && sub.is_url_submission && !sub.is_video_embeddable) {
                    const pLabel = sub.platform_data ? sub.platform_data.label : 'Tautan Proyek Siswa';
                    this.previewContent = `
                        <div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 text-center space-y-4">
                            <div class="w-16 h-16 rounded-2xl bg-emerald-500 text-white flex items-center justify-center mx-auto text-2xl shadow-lg shadow-emerald-500/20">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-800 dark:text-white">${pLabel}</h4>
                                <p class="text-xs text-slate-500 mt-1">Siswa mengumpulkan karya melalui tautan platform eksternal.</p>
                            </div>
                            <div class="p-3 bg-white dark:bg-slate-950/40 rounded-xl border border-slate-200 dark:border-slate-800 max-w-lg mx-auto">
                                <a href="${sub.submission_url}" target="_blank" rel="noopener noreferrer" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline break-all font-mono">
                                    ${sub.submission_url}
                                </a>
                            </div>
                            <div class="pt-2">
                                <a href="${sub.submission_url}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-emerald-600/20">
                                    <i class="fas fa-external-link-alt"></i> Buka Hasil Karya Siswa (Tab Baru)
                                </a>
                            </div>
                        </div>
                    `;
                    this.previewLoading = false;
                    return;
                }

                // 3. Berkas Fisik (Visual / Dokumen / Audio / Arsip)
                if (!name || !url) {
                    this.previewLoading = false;
                    this.previewError = true;
                    return;
                }
                
                const ext = name.split('.').pop().toLowerCase();
                
                if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(ext)) {
                    this.previewContent = `<div class="flex justify-center items-center bg-slate-50 dark:bg-slate-950/20 rounded-2xl p-4 border border-slate-200 dark:border-slate-800"><img src="${url}" class="max-w-full max-h-[60vh] rounded-xl shadow-sm object-contain" /></div>`;
                    this.previewLoading = false;
                } else if (ext === 'pdf') {
                    this.previewContent = `<iframe src="${url}#toolbar=0&navpanes=0&scrollbar=0" class="w-full h-[600px] border-none rounded-2xl"></iframe>`;
                    this.previewLoading = false;
                } else if (['mp3', 'm4a', 'wav', 'ogg'].includes(ext)) {
                    this.previewContent = `
                        <div class="p-8 bg-gradient-to-br from-rose-50 to-orange-50 dark:from-slate-900 dark:to-slate-800 rounded-2xl border border-rose-100 dark:border-slate-700 text-center space-y-4">
                            <div class="w-16 h-16 rounded-2xl bg-rose-500 text-white flex items-center justify-center mx-auto text-2xl shadow-lg shadow-rose-500/20">
                                <i class="fas fa-microphone"></i>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-800 dark:text-white">Rekaman Audio Siswa</h4>
                                <p class="text-xs text-slate-500 mt-1">${name}</p>
                            </div>
                            <div class="max-w-md mx-auto">
                                <audio controls preload="metadata" class="w-full">
                                    <source src="${url}">
                                    Browser Anda tidak mendukung pemutar audio.
                                </audio>
                            </div>
                            <div class="pt-2">
                                <a href="${url}" target="_blank" download class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition">
                                    <i class="fas fa-download"></i> Unduh Berkas Audio
                                </a>
                            </div>
                        </div>
                    `;
                    this.previewLoading = false;
                } else if (['zip', 'rar', '7z'].includes(ext)) {
                    this.previewContent = `
                        <div class="p-8 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-700 text-center space-y-4">
                            <div class="w-16 h-16 rounded-2xl bg-amber-500 text-white flex items-center justify-center mx-auto text-2xl shadow-lg shadow-amber-500/20">
                                <i class="fas fa-file-zipper"></i>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-800 dark:text-white">Berkas Terkompresi (${name})</h4>
                                <p class="text-xs text-slate-500 mt-1">Unduh berkas arsip untuk mengekstrak dan memeriksa karya proyek siswa.</p>
                            </div>
                            <div class="pt-2">
                                <a href="${url}" target="_blank" download class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-amber-600/20">
                                    <i class="fas fa-download"></i> Unduh Berkas Arsip (.zip / .rar)
                                </a>
                            </div>
                        </div>
                    `;
                    this.previewLoading = false;
                } else if (ext === 'docx') {
                    this.loadDocxPreview(url);
                } else {
                    this.previewLoading = false;
                    this.previewError = true;
                }
            },

            applyRevisionPreset() {
                if (this.revisionPreset === 'custom') {
                    this.revisionAlasan = '';
                    this.$nextTick(() => {
                        this.$refs.revisionTextarea?.focus();
                    });
                } else if (this.revisionPreset) {
                    this.revisionAlasan = this.revisionPreset;
                }
            },

            openRevisionFromPreview() {
                if (!this.currentSubmissionId) return;
                const subId = this.currentSubmissionId;
                this.closePreview();
                this.openRevisionModal = true;
                this.revisionPreset = '';
                this.revisionActionUrl = '/submissions/' + subId + '/return-revision';
                this.revisionAlasan = this.submissions[subId]?.alasan_pengembalian || '';
                this.revisionSubmissionId = subId;
                this.revisionStudentName = this.submissions[subId]?.student_name || '';
            },

            openFeedbackFromPreview() {
                if (!this.currentSubmissionId) return;
                const subId = this.currentSubmissionId;
                this.closePreview();
                this.openFeedbackModal = true;
                this.feedbackActionUrl = '/submissions/' + subId + '/toggle-koreksi';
                this.feedbackCatatan = this.submissions[subId]?.feedback || '';
                this.feedbackNilai = this.submissions[subId]?.score || '';
                this.feedbackSubmissionId = subId;
            },
            
            async loadDocxPreview(url) {
                try {
                    if (typeof mammoth === 'undefined') {
                        await this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.6.0/mammoth.browser.min.js');
                    }
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('File not accessible');
                    
                    const arrayBuffer = await response.arrayBuffer();
                    const result = await mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
                    
                    this.previewContent = `
                        <div class="prose dark:prose-invert max-w-none preview-docx-content p-6 bg-slate-50 dark:bg-slate-950/20 rounded-2xl border border-slate-200 dark:border-slate-800 max-h-[60vh] overflow-y-auto">
                            ${result.value}
                        </div>
                    `;
                    this.previewLoading = false;
                    this.previewError = false;
                } catch (e) {
                    console.error('Docx Preview Error:', e);
                    this.previewLoading = false;
                    this.previewError = true;
                }
            },
            
            initInstructionPreview() {
                this.previewUrl = '';
                this.previewName = 'Instruksi Tugas';
                this.previewSubtitle = 'Pratinjau Soal & Instruksi Tugas';
                this.currentSubmissionId = null;
                this.currentSubmissionCatatan = '';
                this.openPreview = true;
                this.previewLoading = false;
                this.previewError = false;
                this.previewContent = '';
                document.body.style.overflow = 'hidden';
            },
            
            closePreview() {
                this.openPreview = false;
                this.previewContent = '';
                this.currentSubmissionId = null;
                this.currentSubmissionCatatan = '';
                document.body.style.overflow = '';
            },
            
            loadScript(src) {
                return new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.src = src;
                    script.onload = resolve;
                    script.onerror = reject;
                    document.head.appendChild(script);
                });
            },
            
            isValidNilai() {
                if (this.feedbackNilai === '' || this.feedbackNilai === null || this.feedbackNilai === undefined) {
                    return false;
                }
                const num = Number(this.feedbackNilai);
                return !isNaN(num) && num >= 0 && num <= {{ $assignment->max_score }};
            },
            
            hasCatatan() {
                return !!(this.feedbackCatatan && this.feedbackCatatan.trim().length > 0);
            },
            
            showToast(msg) {
                this.toastMessage = msg;
                this.toastShow = true;
                setTimeout(() => {
                    this.toastShow = false;
                }, 3000);
            },
            
            async submitFeedbackForm(requireCatatan = false) {
                if (!this.feedbackActionUrl) return;
                
                if (!this.isValidNilai()) {
                    alert('Harap masukkan nilai valid (0 - {{ $assignment->max_score }}) terlebih dahulu.');
                    return;
                }
                
                if (requireCatatan && !this.hasCatatan()) {
                    alert('Harap masukkan catatan koreksi / feedback.');
                    return;
                }
                
                const catatanToSend = requireCatatan ? this.feedbackCatatan.trim() : (this.feedbackCatatan ? this.feedbackCatatan.trim() : '');
                
                try {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const headers = {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    };
                    if (token) {
                        headers['X-CSRF-TOKEN'] = token;
                    }
                    
                    const response = await fetch(this.feedbackActionUrl, {
                        method: 'POST',
                        headers: headers,
                        body: JSON.stringify({ 
                            catatan: catatanToSend,
                            nilai: this.feedbackNilai 
                        })
                    });
                    
                    if (!response.ok) throw new Error('Request failed');
                    const result = await response.json();
                    
                    if (result.success) {
                        if (this.feedbackSubmissionId) {
                            const subId = this.feedbackSubmissionId;
                            this.submissions[subId].is_graded = result.is_graded;
                            this.submissions[subId].status_label = result.status_label;
                            this.submissions[subId].status_class = result.status_class;
                            this.submissions[subId].status_type = result.status_type;
                            this.submissions[subId].score = result.score;
                            this.submissions[subId].feedback = result.feedback;
                        }
                        
                        this.openFeedbackModal = false;
                        this.showToast(result.message);
                    }
                } catch (e) {
                    console.error('AJAX Error:', e);
                    alert('Gagal memproses koreksi. Silakan coba lagi.');
                }
            },

            async submitRevisionForm() {
                if (!this.revisionActionUrl) return;
                if (!this.revisionAlasan || this.revisionAlasan.trim().length < 3) {
                    alert('Harap masukkan catatan / alasan pengembalian tugas minimal 3 karakter.');
                    return;
                }

                try {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await fetch(this.revisionActionUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token || ''
                        },
                        body: JSON.stringify({ alasan: this.revisionAlasan.trim() })
                    });

                    if (!response.ok) throw new Error('Request failed');
                    const result = await response.json();

                    if (result.success) {
                        if (this.revisionSubmissionId) {
                            const subId = this.revisionSubmissionId;
                            this.submissions[subId].is_graded = false;
                            this.submissions[subId].status_label = result.status_label;
                            this.submissions[subId].status_class = result.status_class;
                            this.submissions[subId].status_type = result.status_type;
                            this.submissions[subId].score = '';
                            this.submissions[subId].alasan_pengembalian = result.alasan_pengembalian;
                            this.submissions[subId].feedback = result.alasan_pengembalian;
                        }
                        this.openRevisionModal = false;
                        this.showToast(result.message);
                    } else {
                        alert(result.message || 'Gagal mengembalikan tugas.');
                    }
                } catch (e) {
                    console.error('Revision error:', e);
                    alert('Terjadi kesalahan saat memproses pengembalian tugas.');
                }
            },
            
            async performToggleKoreksi(url, submissionId) {
                try {
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const headers = {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    };
                    if (token) {
                        headers['X-CSRF-TOKEN'] = token;
                    }
                    
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: headers,
                    });
                    
                    if (!response.ok) throw new Error('Request failed');
                    const result = await response.json();
                    
                    if (result.success) {
                        this.submissions[submissionId].is_graded = result.is_graded;
                        this.submissions[submissionId].status_label = result.status_label;
                        this.submissions[submissionId].status_class = result.status_class;
                        this.submissions[submissionId].status_type = result.status_type;
                        this.showToast(result.message);
                    }
                } catch (e) {
                    console.error('AJAX Error:', e);
                    alert('Gagal memproses koreksi. Silakan coba lagi.');
                }
            }
        }
    }

    function filePreview(url, fileName) {
        return {
            loading: true,
            error: false,
            init() {
                this.loadPreview();
            },
            async loadPreview() {
                const container = document.getElementById('file-preview-content');
                if (!container || !url) {
                    this.loading = false;
                    this.error = true;
                    return;
                }

                try {
                    if (fileName.endsWith('.pdf')) {
                        container.innerHTML = `<iframe src="${url}#toolbar=0&navpanes=0&scrollbar=0" class="w-full h-[700px] border-none rounded-2xl"></iframe>`;
                        this.loading = false;
                        this.error = false;
                    } 
                    else if (fileName.endsWith('.docx')) {
                        const response = await fetch(url);
                        if (!response.ok) throw new Error('File not accessible');
                        
                        const arrayBuffer = await response.arrayBuffer();
                        const result = await mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
                        
                        container.innerHTML = `
                            <div class="prose dark:prose-invert max-w-none preview-docx-content">
                                ${result.value}
                            </div>
                        `;
                        this.loading = false;
                        this.error = false;
                    } 
                    else {
                        this.loading = false;
                        this.error = true;
                    }
                } catch (e) {
                    console.error('File Preview Error:', e);
                    this.loading = false;
                    this.error = true;
                }
            }
        }
    }

    // Client-side search and status filter for teacher monitoring table
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchSiswa');
        const statusFilter = document.getElementById('statusFilter');
        const sortFilter = document.getElementById('sortFilter');
        const tableBody = document.getElementById('tabelSiswa') ? document.getElementById('tabelSiswa').querySelector('tbody') : null;
        let rows = tableBody ? Array.from(tableBody.querySelectorAll('tr.table-row-item')) : [];

        function filterTable() {
            if (!tableBody) return;
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const status = statusFilter ? statusFilter.value : 'all';
            const sortOrder = sortFilter ? sortFilter.value : 'default';
            
            // Sort rows based on selected order
            rows.sort((a, b) => {
                if (sortOrder === 'terbaru') {
                    const timeA = parseInt(a.getAttribute('data-time') || 0);
                    const timeB = parseInt(b.getAttribute('data-time') || 0);
                    // time=0 means not submitted, put at bottom
                    if (timeA === 0) return 1;
                    if (timeB === 0) return -1;
                    return timeB - timeA;
                } else if (sortOrder === 'terlama') {
                    const timeA = parseInt(a.getAttribute('data-time') || 0);
                    const timeB = parseInt(b.getAttribute('data-time') || 0);
                    if (timeA === 0) return 1;
                    if (timeB === 0) return -1;
                    return timeA - timeB;
                } else {
                    // default order (by name)
                    const nameA = a.getAttribute('data-nama') || '';
                    const nameB = b.getAttribute('data-nama') || '';
                    return nameA.localeCompare(nameB);
                }
            });

            let visibleCount = 0;
            rows.forEach((row) => {
                const nama = row.getAttribute('data-nama') || '';
                const nis = row.getAttribute('data-nis') || '';
                const rowStatus = row.getAttribute('data-status') || '';
                
                const matchSearch = nama.includes(query) || nis.includes(query);
                const matchStatus = status === 'all' || rowStatus === status;
                
                if (matchSearch && matchStatus) {
                    row.style.display = '';
                    visibleCount++;
                    const indexCell = row.querySelector('.index-column');
                    if (indexCell) indexCell.textContent = visibleCount;
                } else {
                    row.style.display = 'none';
                }
                
                // Re-append row to table to reflect new sort order
                tableBody.appendChild(row);
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (statusFilter) statusFilter.addEventListener('change', filterTable);
        if (sortFilter) sortFilter.addEventListener('change', filterTable);
    });
</script>
<style>
    /* Redesign Guru Detail Status Badges */
    .badge-dikoreksi {
        background-color: #D1FAE5;
        color: #065F46;
    }
    .dark .badge-dikoreksi {
        background-color: rgba(6, 95, 70, 0.2);
        color: #34d399;
    }
    .badge-perlu-koreksi {
        background-color: #FEF3C7;
        color: #92400E;
    }
    .dark .badge-perlu-koreksi {
        background-color: rgba(146, 64, 14, 0.2);
        color: #fbbf24;
    }
    .badge-needs-revision {
        background-color: #FFE4E6;
        color: #9F1239;
        border: 1px solid #FECDD3;
    }
    .dark .badge-needs-revision {
        background-color: rgba(159, 18, 57, 0.2);
        color: #fb7185;
        border: 1px solid rgba(251, 113, 133, 0.3);
    }
    .badge-terlambat {
        background-color: #FEE2E2;
        color: #991B1B;
    }
    .dark .badge-terlambat {
        background-color: rgba(153, 27, 27, 0.2);
        color: #f87171;
    }
    .badge-belum-kumpul {
        background-color: #E2E8F0;
        color: #475569;
    }
    .dark .badge-belum-kumpul {
        background-color: #334155;
        color: #cbd5e1;
    }
    #tabelSiswa tbody tr:nth-child(even) {
        background-color: #FAFBFD;
    }
    .dark #tabelSiswa tbody tr:nth-child(even) {
        background-color: #0f172a;
    }
    #tabelSiswa tbody tr:hover {
        background-color: #FFF5F0 !important;
    }
    .dark #tabelSiswa tbody tr:hover {
        background-color: #1e293b !important;
    }

    .animate-progress-indefinite {
        animation: progress-indefinite 1.5s infinite linear;
    }
    @keyframes progress-indefinite {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    .animate-spin-slow {
        animation: spin 3s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Selective Submission Locking Styles */
    .alert-locked {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        background-color: #fef3c7;
        border: 1px solid #f59e0b;
        border-left: 4px solid #f59e0b;
        border-radius: 8px;
        margin-bottom: 16px;
        color: #78350f;
    }
    .alert-locked__icon { flex-shrink: 0; margin-top: 2px; }
    .alert-locked__title { font-weight: 600; margin-bottom: 4px; font-size: 14px; }
    .alert-locked__message { font-size: 13px; margin: 0; }

    .submission-locked-box {
        border: 1.5px solid #f59e0b;
        border-radius: 12px;
        padding: 20px;
        background-color: #fffbeb;
    }
    .submission-locked-box__header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        font-size: 15px;
        color: #92400e;
        margin-bottom: 8px;
    }
    .submission-locked-box__desc {
        font-size: 13px;
        color: #78350f;
        margin-bottom: 16px;
    }
    .submission-locked-box__list-title {
        font-size: 12px;
        font-weight: 600;
        color: #92400e;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }
    .submission-locked-box__item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 14px;
        background: white;
        border: 1px solid #fde68a;
        border-radius: 8px;
        margin-bottom: 6px;
        text-decoration: none;
        color: inherit;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .submission-locked-box__item:hover {
        border-color: #f59e0b;
        box-shadow: 0 1px 4px rgba(245,158,11,0.15);
    }
    .submission-locked-box__item-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .submission-locked-box__item-subject {
        font-size: 11px;
        font-weight: 600;
        color: #b45309;
        text-transform: uppercase;
    }
    .submission-locked-box__item-title {
        font-size: 13px;
        color: #1c1917;
    }
    .submission-locked-box__item-date {
        font-size: 12px;
        color: #78350f;
        text-align: right;
        white-space: nowrap;
    }
</style>
@endpush
