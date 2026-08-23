@extends('layouts.app')

@section('title', 'Edit Tugas - ' . $assignment->title)

@section('content')
<div class="space-y-6 max-w-[1200px] mx-auto animate-fade-in" x-data="editAssignmentForm()">

    {{-- Header (Clean, No Card) --}}
    <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800/80 pb-5">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('assignments.index') }}" class="hover:text-[#D65A20] transition font-medium">Tugas & Evaluasi</a>
                <i class="fas fa-chevron-right text-[8px] text-slate-400"></i>
                <a href="{{ route('assignments.show', $assignment) }}" class="hover:text-[#D65A20] transition font-medium">{{ Str::limit($assignment->title, 25) }}</a>
                <i class="fas fa-chevron-right text-[8px] text-slate-400"></i>
                <span class="text-slate-800 dark:text-slate-250 font-semibold">Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight flex items-center gap-2">
                Edit Tugas
            </h1>
        </div>
        <a href="{{ route('assignments.show', ['assignment' => $assignment->id, 'class_name' => request('class_name')]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <form action="{{ route('assignments.update', ['assignment' => $assignment->id, 'class_name' => request('class_name')]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Left Column: Single Unified Form Card (8 columns) --}}
            <div class="lg:col-span-8">
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-8 shadow-sm space-y-8">
                    
                    {{-- Section 1: Informasi Dasar --}}
                    <div class="space-y-5">
                        <div class="border-b border-slate-100 dark:border-slate-800 pb-3">
                            <h3 class="text-base font-bold text-slate-850 dark:text-white">Informasi Dasar</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Mata pelajaran, kelas, dan judul tugas.</p>
                        </div>

                        <div class="grid grid-cols-1 gap-5">
                            {{-- Mata Pelajaran & Kelas (LOCKED) --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 flex items-center gap-1.5">
                                    Mata Pelajaran & Kelas
                                </label>
                                @php
                                    $currentSubject = $subjects->firstWhere('id', $assignment->subject_id);
                                    $subjectLabel = $currentSubject ? ($currentSubject->course->name . ' — Kelas ' . $currentSubject->classRoom->name) : 'Bahasa Indonesia — Kelas X 2';
                                @endphp
                                <div class="px-4 py-3 bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800/80 rounded-xl text-slate-500 dark:text-slate-400 text-sm font-semibold flex items-center justify-between">
                                    <span class="flex items-center gap-2">
                                        <i class="fas fa-lock text-slate-400 text-xs"></i>
                                        {{ $subjectLabel }}
                                    </span>
                                    <span class="text-[9px] bg-slate-200 dark:bg-slate-800 px-2 py-0.5 rounded font-bold uppercase tracking-wide text-slate-500">Terkunci</span>
                                </div>
                                <input type="hidden" name="subject_id" value="{{ $assignment->subject_id }}">
                            </div>

                            {{-- Judul Tugas --}}
                            <div>
                                <label for="title" class="block text-xs font-bold text-slate-500 mb-1.5">
                                    Judul Tugas
                                </label>
                                <input type="text" name="title" id="title" x-model="title"
                                    value="{{ old('title', $assignment->title) }}" 
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('title') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                                @error('title') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Format Tugas yang Dikumpulkan Siswa --}}
                            @php
                                $hasSubmissions = $assignment->hasSubmissions();
                                $subCount = $assignment->submissions()->count();
                            @endphp
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-xs font-bold text-slate-500 flex items-center gap-1.5">
                                        Format Tugas yang Dikumpulkan Siswa
                                        @if($hasSubmissions)
                                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                                <i class="fas fa-lock text-[9px]"></i> Terkunci (Ada Pengumpulan)
                                            </span>
                                        @endif
                                    </label>
                                </div>

                                @if($hasSubmissions)
                                    <input type="hidden" name="tipe_pengumpulan" value="{{ $assignment->tipe_pengumpulan ?? 'dokumen' }}">
                                    <input type="hidden" name="mode_audiovisual" value="{{ $assignment->mode_audiovisual }}">
                                    
                                    <div class="p-3.5 rounded-xl border border-amber-200 dark:border-amber-900/40 bg-amber-50/50 dark:bg-amber-950/20 text-xs">
                                        <div class="flex items-center gap-2 font-bold text-amber-800 dark:text-amber-300">
                                            @php $typeConfig = $assignment->getConfig(); @endphp
                                            <i class="fas {{ $typeConfig['icon'] ?? 'fa-file' }}"></i>
                                            <span>Format Terpilih: {{ $typeConfig['label'] }}</span>
                                            @if($assignment->isAudiovisual())
                                                <span class="px-2 py-0.5 rounded bg-amber-200/60 dark:bg-amber-900/60 text-[10px]">
                                                    {{ $assignment->mode_audiovisual == 'audio_file' ? 'Audio Saja' : ($assignment->mode_audiovisual == 'video_url' ? 'Video Saja' : 'Audio atau Video') }}
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-[11px] text-amber-700/80 dark:text-amber-400/80 mt-1">
                                            Format pengumpulan tidak dapat diubah karena terdapat <strong>{{ $subCount }} pengumpulan siswa</strong> pada tugas ini demi menjaga integritas data.
                                        </p>
                                    </div>
                                @else
                                    <input type="hidden" name="tipe_pengumpulan" :value="tipePengumpulan" />
                                    <input type="hidden" name="mode_audiovisual" :value="tipePengumpulan === 'audiovisual' ? modeAudiovisual : ''" />

                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2.5">
                                        {{-- 1. Media Visual --}}
                                        <div @click="tipePengumpulan = 'visual'"
                                            class="relative p-3 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-2.5 select-none"
                                            :class="tipePengumpulan === 'visual' ? 'border-purple-500 bg-purple-50/40 dark:bg-purple-950/20 shadow-sm ring-1 ring-purple-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-900'">
                                            <div x-show="tipePengumpulan === 'visual'" x-cloak class="absolute top-2 right-2 w-4 h-4 rounded-full bg-purple-600 text-white flex items-center justify-center shadow-sm">
                                                <i class="fas fa-check text-[9px]"></i>
                                            </div>
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                                :class="tipePengumpulan === 'visual' ? 'bg-purple-600 text-white' : 'bg-purple-100 dark:bg-purple-950/50 text-purple-600'">
                                                <i class="fas fa-palette text-xs"></i>
                                            </div>
                                            <div class="min-w-0 pr-3">
                                                <div class="text-xs font-bold text-slate-800 dark:text-white">Media Visual</div>
                                                <div class="text-[10px] text-purple-600 dark:text-purple-400">.jpg, .png, .pdf (20MB)</div>
                                            </div>
                                        </div>

                                        {{-- 2. Berkas Dokumen --}}
                                        <div @click="tipePengumpulan = 'dokumen'"
                                            class="relative p-3 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-2.5 select-none"
                                            :class="tipePengumpulan === 'dokumen' ? 'border-blue-500 bg-blue-50/40 dark:bg-blue-950/20 shadow-sm ring-1 ring-blue-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-900'">
                                            <div x-show="tipePengumpulan === 'dokumen'" x-cloak class="absolute top-2 right-2 w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                                                <i class="fas fa-check text-[9px]"></i>
                                            </div>
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                                :class="tipePengumpulan === 'dokumen' ? 'bg-blue-600 text-white' : 'bg-blue-100 dark:bg-blue-950/50 text-blue-600'">
                                                <i class="fas fa-file-lines text-xs"></i>
                                            </div>
                                            <div class="min-w-0 pr-3">
                                                <div class="text-xs font-bold text-slate-800 dark:text-white">Berkas Dokumen</div>
                                                <div class="text-[10px] text-blue-600 dark:text-blue-400">.pdf, .docx (20MB)</div>
                                            </div>
                                        </div>

                                        {{-- 3. Multimedia Audiovisual --}}
                                        <div @click="tipePengumpulan = 'audiovisual'"
                                            class="relative p-3 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-2.5 select-none"
                                            :class="tipePengumpulan === 'audiovisual' ? 'border-rose-500 bg-rose-50/40 dark:bg-rose-950/20 shadow-sm ring-1 ring-rose-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-900'">
                                            <div x-show="tipePengumpulan === 'audiovisual'" x-cloak class="absolute top-2 right-2 w-4 h-4 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-sm">
                                                <i class="fas fa-check text-[9px]"></i>
                                            </div>
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                                :class="tipePengumpulan === 'audiovisual' ? 'bg-rose-600 text-white' : 'bg-rose-100 dark:bg-rose-950/50 text-rose-600'">
                                                <i class="fas fa-video text-xs"></i>
                                            </div>
                                            <div class="min-w-0 pr-3">
                                                <div class="text-xs font-bold text-slate-800 dark:text-white">Audiovisual</div>
                                                <div class="text-[10px] text-rose-600 dark:text-rose-400">Audio / URL Video</div>
                                            </div>
                                        </div>

                                        {{-- 4. Tautan Karya Eksternal --}}
                                        <div @click="tipePengumpulan = 'tautan'"
                                            class="relative p-3 rounded-xl border-2 cursor-pointer transition-all duration-200 flex items-start gap-2.5 select-none"
                                            :class="tipePengumpulan === 'tautan' ? 'border-emerald-500 bg-emerald-50/40 dark:bg-emerald-950/20 shadow-sm ring-1 ring-emerald-500/30' : 'border-slate-200 dark:border-slate-700 hover:border-slate-300 bg-white dark:bg-slate-900'">
                                            <div x-show="tipePengumpulan === 'tautan'" x-cloak class="absolute top-2 right-2 w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center shadow-sm">
                                                <i class="fas fa-check text-[9px]"></i>
                                            </div>
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                                :class="tipePengumpulan === 'tautan' ? 'bg-emerald-600 text-white' : 'bg-emerald-100 dark:bg-emerald-950/50 text-emerald-600'">
                                                <i class="fas fa-link text-xs"></i>
                                            </div>
                                            <div class="min-w-0 pr-3">
                                                <div class="text-xs font-bold text-slate-800 dark:text-white">Tautan Eksternal</div>
                                                <div class="text-[10px] text-emerald-600 dark:text-emerald-400">Canva, Figma, GitHub</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Sub-Opsi Audiovisual --}}
                                    <div x-show="tipePengumpulan === 'audiovisual'" x-cloak class="mt-3 p-3.5 rounded-xl bg-rose-50/60 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-900/40">
                                        <label class="block text-[11px] font-bold text-rose-900 dark:text-rose-300 mb-2">
                                            Jenis Pengumpulan Audiovisual:
                                        </label>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                            <label @click="modeAudiovisual = 'audio_file'"
                                                class="flex items-center gap-2 p-2 rounded-lg border text-xs cursor-pointer transition-colors"
                                                :class="modeAudiovisual === 'audio_file' ? 'bg-white dark:bg-slate-800 border-rose-500 text-rose-700 font-bold shadow-sm' : 'border-transparent text-slate-600 dark:text-slate-400'">
                                                <input type="radio" name="_sub_av" value="audio_file" class="hidden" x-model="modeAudiovisual" />
                                                <i class="fas fa-microphone text-xs" :class="modeAudiovisual === 'audio_file' ? 'text-rose-500' : 'text-slate-400'"></i>
                                                <span class="text-[11px]">Audio Saja (.mp3)</span>
                                            </label>
                                            <label @click="modeAudiovisual = 'video_url'"
                                                class="flex items-center gap-2 p-2 rounded-lg border text-xs cursor-pointer transition-colors"
                                                :class="modeAudiovisual === 'video_url' ? 'bg-white dark:bg-slate-800 border-rose-500 text-rose-700 font-bold shadow-sm' : 'border-transparent text-slate-600 dark:text-slate-400'">
                                                <input type="radio" name="_sub_av" value="video_url" class="hidden" x-model="modeAudiovisual" />
                                                <i class="fab fa-youtube text-xs" :class="modeAudiovisual === 'video_url' ? 'text-red-500' : 'text-slate-400'"></i>
                                                <span class="text-[11px]">Video Saja (YouTube)</span>
                                            </label>
                                            <label @click="modeAudiovisual = 'either'"
                                                class="flex items-center gap-2 p-2 rounded-lg border text-xs cursor-pointer transition-colors"
                                                :class="modeAudiovisual === 'either' ? 'bg-white dark:bg-slate-800 border-rose-500 text-rose-700 font-bold shadow-sm' : 'border-transparent text-slate-600 dark:text-slate-400'">
                                                <input type="radio" name="_sub_av" value="either" class="hidden" x-model="modeAudiovisual" />
                                                <i class="fas fa-random text-xs" :class="modeAudiovisual === 'either' ? 'text-rose-500' : 'text-slate-400'"></i>
                                                <span class="text-[11px]">Audio atau Video</span>
                                            </label>
                                        </div>
                                        <p class="text-[10px] text-rose-700/80 dark:text-rose-300/80 mt-1.5">
                                            Video berbasis tautan tidak menggunakan ruang penyimpanan media pada server aplikasi.
                                        </p>
                                    </div>
                                @endif
                                @error('tipe_pengumpulan') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Materi Prasyarat --}}
                            <div>
                                <label for="prasyarat_materi_id" class="block text-xs font-bold text-slate-500 mb-1.5">
                                    Materi Prasyarat (Restrict Access) <span class="text-slate-400 font-normal">(opsional)</span>
                                </label>
                                <div class="relative">
                                    <select name="prasyarat_materi_id" id="prasyarat_materi_id" x-model="prereqMateriId"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-805 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition appearance-none pr-10 @error('prasyarat_materi_id') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22%2394a3b8%22 class=%22bi bi-chevron-down%22 viewBox=%220 0 16 16%22><path fill-rule=%22evenodd%22 d=%22M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z%22/></svg>'); background-position: right 14px center; background-repeat: no-repeat;">
                                        <option value="">Tanpa prasyarat (Akses Langsung)</option>
                                        <template x-for="materi in filteredMaterials" :key="materi.id">
                                            <option :value="materi.id" x-text="materi.judul" :selected="materi.id == prereqMateriId"></option>
                                        </template>
                                    </select>
                                </div>
                                @error('prasyarat_materi_id') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-150 dark:border-slate-800"></div>

                    {{-- Section 2: Konten & Instruksi --}}
                    <div class="space-y-5">
                        <div class="border-b border-slate-100 dark:border-slate-800 pb-3">
                            <h3 class="text-base font-bold text-slate-850 dark:text-white">Konten & Instruksi</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Perbarui instruksi tugas dan unggah berkas pendukung.</p>
                        </div>

                        <div class="space-y-5">
                            {{-- Deskripsi --}}
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="description" class="block text-xs font-bold text-slate-500">
                                        Deskripsi & Instruksi Kerja
                                    </label>
                                    <span class="text-[10px] text-slate-400" x-text="description.length + ' karakter'"></span>
                                </div>
                                <textarea name="description" id="description" rows="8" x-model="description"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-808 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>{{ old('description', $assignment->description) }}</textarea>
                                @error('description') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Lampiran Instruksi Guru --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5 flex items-center justify-between">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas text-[10px]" :class="attachmentMeta.icon"></i>
                                        <span x-text="attachmentMeta.title">Lampiran Instruksi Guru</span>
                                        <span class="text-slate-400 font-normal">(opsional)</span>
                                    </span>
                                </label>

                                {{-- Toggle Pilihan Khusus Audiovisual Video: Berkas MP4 vs Tautan Video --}}
                                <div x-show="tipePengumpulan === 'audiovisual' && modeAudiovisual !== 'audio_file'" x-cloak class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800/80 p-1 rounded-xl mb-3 border border-slate-200/60 dark:border-slate-700/60">
                                    <button type="button" @click="teacherAttachmentMode = 'file'"
                                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-semibold transition-all flex items-center justify-center gap-1.5"
                                        :class="teacherAttachmentMode === 'file' ? 'bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'">
                                        <i class="fas fa-file-video"></i>
                                        <span>Unggah Video (.mp4) / Berkas</span>
                                    </button>
                                    <button type="button" @click="teacherAttachmentMode = 'link'"
                                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-semibold transition-all flex items-center justify-center gap-1.5"
                                        :class="teacherAttachmentMode === 'link' ? 'bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'">
                                        <i class="fab fa-youtube text-red-500"></i>
                                        <span>Tautan Video (YouTube/Drive)</span>
                                    </button>
                                </div>

                                {{-- Current attachment display (jika berkas lokal) --}}
                                @if($assignment->attachment && !$assignment->is_attachment_url)
                                <div class="flex items-center gap-3 p-3 mb-4 bg-slate-50 dark:bg-slate-950/40 rounded-xl border border-slate-200 dark:border-slate-800" x-show="!newFileName && teacherAttachmentMode === 'file'">
                                    <div class="w-9 h-9 rounded-lg bg-orange-100 dark:bg-orange-950/30 text-[#D65A20] flex items-center justify-center flex-shrink-0 text-sm">
                                        <i class="{{ $assignment->is_attachment_video ? 'fas fa-file-video' : 'far fa-file-pdf' }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0 text-left">
                                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-200 truncate">{{ basename($assignment->attachment) }}</p>
                                        <p class="text-[10px] text-slate-400">Berkas saat ini</p>
                                    </div>
                                    <a href="{{ $assignment->attachment_url }}" target="_blank" class="w-8 h-8 rounded-lg hover:bg-slate-200/50 flex items-center justify-center text-slate-500 hover:text-[#D65A20] transition" title="Unduh Berkas">
                                        <i class="fas fa-download text-xs"></i>
                                    </a>
                                </div>
                                @endif

                                {{-- Opsi 1: File drag & drop area --}}
                                <div x-show="tipePengumpulan !== 'audiovisual' || modeAudiovisual === 'audio_file' || teacherAttachmentMode === 'file'">
                                    <div class="relative" 
                                        @dragover.prevent="isDragging = true" 
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="isDragging = false; handleFileDrop($event)">
                                        
                                        <label for="attachment" 
                                            class="flex flex-col items-center justify-center gap-2.5 p-6 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200"
                                            :class="isDragging ? 'border-[#D65A20] bg-orange-50/10 dark:bg-orange-950/10' : (newFileName ? 'border-emerald-500 bg-emerald-50/10 dark:bg-emerald-950/10' : 'border-slate-200 dark:border-slate-800 hover:border-[#D65A20] hover:bg-slate-50/30')">
                                            
                                            <template x-if="!newFileName">
                                                <div class="text-center">
                                                    <i class="fas text-lg text-slate-400 mb-1" :class="attachmentMeta.icon"></i>
                                                    <p class="text-xs font-semibold text-slate-600 dark:text-slate-350" x-text="attachmentMeta.placeholder"></p>
                                                    <p class="text-[10px] text-slate-400 mt-0.5" x-text="attachmentMeta.hint"></p>
                                                </div>
                                            </template>

                                            <template x-if="newFileName">
                                                <div class="flex items-center gap-3 w-full">
                                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950/30 text-emerald-600 flex items-center justify-center flex-shrink-0 text-xs">
                                                        <i class="fas fa-file-circle-check"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0 text-left">
                                                        <p class="text-xs font-semibold text-slate-800 dark:text-slate-100 truncate" x-text="newFileName"></p>
                                                        <p class="text-[9px] text-emerald-650 mt-0.5">Berkas baru siap diunggah</p>
                                                    </div>
                                                    <button type="button" @click.prevent="clearFile()" class="w-7 h-7 rounded-lg hover:bg-slate-200/50 flex items-center justify-center text-slate-400 hover:text-rose-500 transition">
                                                        <i class="fas fa-times text-xs"></i>
                                                    </button>
                                                </div>
                                            </template>
                                        </label>
                                        <input type="file" name="attachment" id="attachment" class="sr-only" 
                                            :accept="attachmentMeta.accept"
                                            @change="handleFileSelect($event)" />
                                    </div>
                                </div>

                                {{-- Opsi 2: Input Tautan Video Online --}}
                                <div x-show="tipePengumpulan === 'audiovisual' && modeAudiovisual !== 'audio_file' && teacherAttachmentMode === 'link'" x-cloak class="space-y-3">
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-rose-500 pointer-events-none">
                                            <i class="fab fa-youtube text-sm"></i>
                                        </span>
                                        <input type="url" name="attachment_link" x-model="teacherAttachmentLink" @input="updateTeacherVideoPreview()"
                                            placeholder="https://www.youtube.com/watch?v=... atau https://drive.google.com/..."
                                            class="w-full px-4 py-3 pl-10 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 @error('attachment_link') border-rose-500 @enderror" />
                                    </div>
                                    <template x-if="teacherVideoEmbed">
                                        <div class="aspect-video w-full rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-black shadow-inner">
                                            <iframe :src="teacherVideoEmbed" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </template>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                                        <i class="fas fa-info-circle text-rose-500"></i>
                                        <span>Video dapat berupa tautan YouTube (Unlisted/Public) atau Google Drive.</span>
                                    </p>
                                </div>

                                @error('attachment') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                                @error('attachment_link') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Settings & Actions (4 columns) --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Single Unified Settings Card --}}
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-sm font-bold text-slate-850 dark:text-white">Pengaturan Tugas</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Atur masa aktif, tenggat nilai, dan publikasi.</p>
                    </div>

                    <div class="space-y-5">
                        {{-- Status Tugas (Segmented Control Switch) --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 mb-2">
                                Status Publikasi Tugas
                            </label>
                            <div class="relative p-1 bg-slate-100 dark:bg-slate-950 rounded-xl border border-slate-200 dark:border-slate-800 flex items-center" x-data="{ activeStatus: '{{ old('status', $assignment->status) }}' }">
                                <input type="hidden" name="status" :value="activeStatus">
                                <button type="button" @click="activeStatus = 'active'"
                                    class="flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-300"
                                    :class="activeStatus === 'active' ? 'bg-[#D65A20] text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-850 dark:hover:text-white'">
                                    Publikasikan
                                </button>
                                <button type="button" @click="activeStatus = 'inactive'"
                                    class="flex-1 py-2 text-xs font-bold rounded-lg transition-all duration-300"
                                    :class="activeStatus === 'inactive' ? 'bg-slate-700 text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-850 dark:hover:text-white'">
                                    Simpan Draft
                                </button>
                            </div>
                        </div>

                        {{-- Tenggat Waktu --}}
                        @php
                            $isSslLockEnabled = \App\Models\Pengaturan::getValue('ssl_lock_expired_deadline', '1') === '1';
                            $isDeadlinePassed = $isSslLockEnabled && $assignment->deadline && \Carbon\Carbon::parse($assignment->deadline)->isPast();
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="due_date" class="block text-xs font-bold text-slate-500 flex items-center gap-1.5">
                                    Tenggat Waktu (Deadline)
                                    @if($isDeadlinePassed)
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-800 shadow-2xs">
                                            <i class="fas fa-lock text-[9px]"></i> Terkunci (SSL)
                                        </span>
                                    @endif
                                </label>
                            </div>

                            @if($isDeadlinePassed)
                                <div class="relative">
                                    <input type="hidden" name="due_date" value="{{ $assignment->due_date ? $assignment->due_date->format('Y-m-d\TH:i') : '' }}">
                                    <input type="datetime-local" id="due_date"
                                        value="{{ $assignment->due_date ? $assignment->due_date->format('Y-m-d\TH:i') : '' }}" 
                                        class="w-full px-3 py-2.5 rounded-xl border border-rose-200 dark:border-rose-800/80 bg-rose-50/40 dark:bg-rose-950/20 text-sm text-slate-600 dark:text-slate-400 cursor-not-allowed transition font-medium opacity-90 select-none" 
                                        disabled />
                                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-rose-500 dark:text-rose-400 pointer-events-none">
                                        <i class="fas fa-lock text-xs"></i>
                                    </div>
                                </div>
                                <div class="mt-2 p-2.5 bg-rose-50/80 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900/50 rounded-xl text-left">
                                    <p class="text-[11px] font-bold text-rose-700 dark:text-rose-300 flex items-center gap-1.5 mb-0.5">
                                        <i class="fas fa-shield-alt text-xs"></i> Proteksi Integritas Selective Submission Locking
                                    </p>
                                    <p class="text-[10px] text-rose-600 dark:text-rose-400/90 leading-relaxed font-normal">
                                        Tugas telah melewati batas deadline. Tenggat waktu dikunci permanen agar sistem penilaian, kuota keterlambatan, dan mekanisme permohonan banding pemulihan siswa tetap konsisten serta adil.
                                    </p>
                                </div>
                            @else
                                <input type="datetime-local" name="due_date" id="due_date" x-model="dueDate"
                                    value="{{ old('due_date', $assignment->due_date ? $assignment->due_date->format('Y-m-d\TH:i') : '') }}" 
                                    class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('due_date') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                                @error('due_date') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            @endif
                        </div>

                        {{-- Skor Maksimal --}}
                        <div>
                            <label for="max_score" class="block text-xs font-bold text-slate-500 mb-1.5">
                                Skor Maksimal
                            </label>
                            <input type="number" name="max_score" id="max_score" x-model="maxScore"
                                value="{{ old('max_score', $assignment->max_score) }}" min="0" max="1000"
                                class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('max_score') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                            @error('max_score') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Summary Metadata --}}
                    <div class="border-t border-slate-100 dark:border-slate-800 pt-4 space-y-2 text-xs">
                        <div class="flex items-center justify-between text-slate-500">
                            <span>Dibuat:</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $assignment->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-500">
                            <span>Pembaruan:</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $assignment->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-500">
                            <span>Submisi Siswa:</span>
                            <span class="px-2 py-0.5 rounded bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] font-bold">{{ $assignment->submissions()->count() }} Siswa</span>
                        </div>
                    </div>

                    {{-- Form Actions Buttons --}}
                    <div class="pt-2 space-y-2.5">
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-3 bg-[#D65A20] hover:bg-[#b84b18] text-white text-xs font-bold rounded-xl transition duration-200 shadow-sm">
                            <i class="fas fa-save text-[10px]"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('assignments.show', ['assignment' => $assignment->id, 'class_name' => request('class_name')]) }}" class="w-full inline-flex items-center justify-center gap-2 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition duration-200 border border-slate-200 dark:border-slate-700">
                            Batalkan
                        </a>
                    </div>
                </div>

                {{-- Danger Zone (Slimmer & Clean) --}}
                <div class="bg-rose-50/20 dark:bg-rose-950/5 rounded-2xl border border-rose-200/50 dark:border-rose-900/20 p-5 space-y-3">
                    <h4 class="text-xs font-bold text-rose-600 dark:text-rose-455 flex items-center gap-1.5">
                        <i class="fas fa-exclamation-triangle text-[10px]"></i> Zona Bahaya
                    </h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Menghapus tugas ini akan menghapus semua file jawaban siswa dan nilai yang telah terekam secara permanen.</p>
                    <button form="delete-form" type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/30 text-rose-600 dark:text-rose-450 text-xs font-bold rounded-xl transition duration-200 border border-rose-200 dark:border-rose-900/20">
                        <i class="fas fa-trash text-[10px]"></i> Hapus Tugas
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

<form id="delete-form" action="{{ route('assignments.destroy', ['assignment' => $assignment->id, 'class_name' => request('class_name')]) }}" method="POST" 
    onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini? Semua data pengumpulan siswa akan DIHAPUS PERMANEN.')">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
function editAssignmentForm() {
    return {
        title: @json(old('title', $assignment->title)),
        description: @json(old('description', $assignment->description)),
        selectedSubject: '{{ old("subject_id", $assignment->subject_id) }}',
        tipePengumpulan: '{{ old("tipe_pengumpulan", $assignment->tipe_pengumpulan ?? "dokumen") }}',
        modeAudiovisual: '{{ old("mode_audiovisual", $assignment->mode_audiovisual ?? "video_url") }}',
        teacherAttachmentMode: '{{ $assignment->is_attachment_url ? "link" : "file" }}',
        teacherAttachmentLink: @json(old('attachment_link', $assignment->is_attachment_url ? $assignment->attachment : '')),
        teacherVideoEmbed: '',
        dueDate: '{{ old("due_date", $assignment->due_date->format("Y-m-d\TH:i")) }}',
        maxScore: '{{ old("max_score", $assignment->max_score) }}',
        newFileName: '',
        isDragging: false,
        prereqMateriId: '{{ old("prasyarat_materi_id", $assignment->prasyarat_materi_id) }}',
        allMaterials: @json($allMaterials),

        get attachmentMeta() {
            switch(this.tipePengumpulan) {
                case 'visual':
                    return {
                        title: 'Lampiran Contoh Visual / Lembar Kerja',
                        placeholder: 'Klik atau drag contoh gambar / sketsa acuan',
                        hint: 'Format: JPG, PNG, JPEG, PDF (Maks. 20 MB)',
                        accept: '.jpg,.jpeg,.png,.pdf',
                        icon: 'fa-palette text-purple-500',
                        badge: 'Media Visual'
                    };
                case 'audiovisual':
                    if (this.modeAudiovisual === 'audio_file') {
                        return {
                            title: 'Lampiran Audio / Soal Listening Guru',
                            placeholder: 'Klik atau drag rekaman audio / panduan suara',
                            hint: 'Format: MP3, M4A, WAV, PDF (Maks. 20 MB)',
                            accept: '.mp3,.m4a,.wav,.ogg,.pdf',
                            icon: 'fa-microphone text-rose-500',
                            badge: 'Rekaman Audio'
                        };
                    }
                    return {
                        title: 'Lampiran Video (.mp4) / Naskah Panduan',
                        placeholder: 'Klik atau drag berkas video (.mp4) atau dokumen panduan',
                        hint: 'Format: MP4, PDF, DOCX, ZIP (Maks. 50 MB)',
                        accept: '.mp4,.m4v,.mov,.pdf,.docx,.doc,.mp3,.zip',
                        icon: 'fa-video text-rose-500',
                        badge: 'Video MP4 / Link'
                    };
                case 'tautan':
                    return {
                        title: 'Lampiran Brief Desain / Panduan Proyek',
                        placeholder: 'Klik atau drag template brief / panduan proyek',
                        hint: 'Format: PDF, DOCX, PNG, ZIP (Maks. 20 MB)',
                        accept: '.pdf,.docx,.doc,.png,.jpg,.zip',
                        icon: 'fa-link text-emerald-500',
                        color: 'emerald',
                        badge: 'Tautan Karya'
                    };
                case 'dokumen':
                default:
                    return {
                        title: 'Lampiran Lembar Soal / Rubrik Dokumen',
                        placeholder: 'Klik atau drag lembar soal / dokumen tugas',
                        hint: 'Format: PDF, DOCX, DOC, PPTX (Maks. 20 MB)',
                        accept: '.pdf,.doc,.docx,.pptx',
                        icon: 'fa-file-lines text-blue-500',
                        badge: 'Berkas Dokumen'
                    };
            }
        },

        updateTeacherVideoPreview() {
            if (!this.teacherAttachmentLink) {
                this.teacherVideoEmbed = '';
                return;
            }
            const ytMatch = this.teacherAttachmentLink.match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
            if (ytMatch) {
                this.teacherVideoEmbed = 'https://www.youtube-nocookie.com/embed/' + ytMatch[1];
                return;
            }
            const driveMatch = this.teacherAttachmentLink.match(/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/i);
            if (driveMatch) {
                this.teacherVideoEmbed = 'https://drive.google.com/file/d/' + driveMatch[1] + '/preview';
                return;
            }
            this.teacherVideoEmbed = '';
        },
        
        get filteredMaterials() {
            if (!this.selectedSubject) return [];
            return this.allMaterials.filter(m => m.mata_pelajaran_id == this.selectedSubject);
        },

        formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        },

        handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) this.newFileName = file.name;
        },

        handleFileDrop(e) {
            const file = e.dataTransfer.files[0];
            if (file) {
                const input = document.getElementById('attachment');
                input.files = e.dataTransfer.files;
                this.newFileName = file.name;
            }
        },

        clearFile() {
            this.newFileName = '';
            document.getElementById('attachment').value = '';
        },

        init() {
            if (this.teacherAttachmentLink) {
                this.updateTeacherVideoPreview();
            }
        }
    }
}
</script>
@endpush
@endsection
