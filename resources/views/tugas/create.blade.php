@extends('layouts.app')

@section('title', 'Buat Tugas Baru')

@section('content')
<div class="space-y-6" x-data="assignmentForm()">

    {{-- Header --}}
    <div class="card">
        <div class="card-header border-b-0 pb-0">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                    <a href="{{ route('assignments.index') }}" class="hover:text-orange-600 transition">Tugas & Evaluasi</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-slate-800 dark:text-white font-medium">Buat Baru</span>
                </div>
                <h1 class="page-title">Buat Tugas Baru</h1>
                <p class="page-subtitle mt-1">Buat penugasan untuk siswa Anda dengan instruksi yang jelas.</p>
            </div>
            <a href="{{ route('assignments.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="class_name" :value="selectedClass" />
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Main Form (Left Column) --}}
            <div class="lg:col-span-8 space-y-6">

                {{-- Section 1: Info Dasar --}}
                <div class="card">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Informasi Dasar</h3>
                            <p class="text-xs text-slate-500">Pilih mata pelajaran dan tentukan judul tugas.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        {{-- Mata Pelajaran --}}
                        <div>
                            <label for="subject_id" class="field-label mb-1.5 flex items-center gap-1.5">
                                <i class="fas fa-book-open text-orange-500 text-[10px]"></i>
                                Mata Pelajaran & Kelas
                            </label>
                            <select name="subject_id" id="subject_id" x-model="selectedSubject" @change="onSubjectChange($event)"
                                class="select @error('subject_id') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                                <option value="" disabled selected>Pilih mata pelajaran...</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" 
                                        data-class="{{ $subject->classRoom->name }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->course->name }} — Kelas {{ $subject->classRoom->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>

                        {{-- Judul Tugas --}}
                        <div>
                            {{-- Judul Tugas --}}
                            <div>
                                <label for="title" class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-heading text-orange-500 text-[10px]"></i>
                                    Judul Tugas
                                </label>
                                <input type="text" name="title" id="title" x-model="title"
                                    value="{{ old('title') }}" 
                                    placeholder="Contoh: Latihan Soal Bab 3 — Persamaan Linear" 
                                    class="input @error('title') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                                @error('title') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Format Tugas yang Dikumpulkan Siswa --}}
                            <div>
                                <label class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-layer-group text-orange-500 text-[10px]"></i>
                                    Format Tugas yang Dikumpulkan Siswa
                                </label>
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
                                        Jenis Pengumpulan Audiovisual yang Diizinkan:
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
                                @error('tipe_pengumpulan') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Materi Prasyarat (Restrict Access) --}}
                            <div class="md:col-span-2">
                                <label for="prasyarat_materi_id" class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-lock text-orange-500 text-[10px]"></i>
                                    Materi Prasyarat (Restrict Access)
                                    <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
                                </label>
                                <select name="prasyarat_materi_id" id="prasyarat_materi_id" x-model="prereqMateriId"
                                    class="select @error('prasyarat_materi_id') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                                    <option value="">Tanpa prasyarat (Akses Langsung)</option>
                                    <template x-for="materi in filteredMaterials" :key="materi.id">
                                        <option :value="materi.id" x-text="materi.judul" :selected="materi.id == prereqMateriId"></option>
                                    </template>
                                </select>
                                @error('prasyarat_materi_id') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Konten Tugas --}}
                    <div class="card">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-sky-100 dark:bg-sky-900/30 text-sky-600 flex items-center justify-center">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Konten & Instruksi</h3>
                                <p class="text-xs text-slate-500">Jelaskan detail tugas dengan instruksi yang jelas untuk siswa.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Deskripsi --}}
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="description" class="field-label flex items-center gap-1.5">
                                        <i class="fas fa-align-left text-sky-500 text-[10px]"></i>
                                        Deskripsi & Instruksi
                                    </label>
                                    <span class="text-xs text-slate-400" x-text="description.length + ' karakter'"></span>
                                </div>
                                <textarea name="description" id="description" rows="8" x-model="description"
                                    placeholder="Tuliskan instruksi detail mengenai tugas ini...&#10;&#10;Contoh:&#10;1. Kerjakan soal nomor 1-10 pada buku paket halaman 45&#10;2. Tuliskan langkah-langkah penyelesaiannya&#10;3. Kumpulkan dalam format PDF"
                                    class="input @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>{{ old('description') }}</textarea>
                                @error('description') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Lampiran Instruksi Guru --}}
                            <div>
                                <label class="field-label mb-1.5 flex items-center justify-between">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fas text-[10px]" :class="attachmentMeta.icon"></i>
                                        <span x-text="attachmentMeta.title">Lampiran Instruksi Guru</span>
                                        <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
                                    </span>
                                </label>

                                {{-- Toggle Pilihan Khusus: Berkas Lokal vs Tautan --}}
                                <div x-show="(tipePengumpulan === 'audiovisual' && modeAudiovisual !== 'audio_file') || tipePengumpulan === 'tautan'" x-cloak class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800/80 p-1 rounded-xl mb-3 border border-slate-200/60 dark:border-slate-700/60">
                                    <button type="button" @click="teacherAttachmentMode = 'file'"
                                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-semibold transition-all flex items-center justify-center gap-1.5"
                                        :class="teacherAttachmentMode === 'file' ? 'bg-white dark:bg-slate-700 text-[#D65A20] shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'">
                                        <i class="fas" :class="tipePengumpulan === 'audiovisual' ? 'fa-file-video' : 'fa-file-upload'"></i>
                                        <span x-text="tipePengumpulan === 'audiovisual' ? 'Unggah Video (.mp4) / Berkas' : 'Unggah Berkas Lokal'"></span>
                                    </button>
                                    <button type="button" @click="teacherAttachmentMode = 'link'"
                                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-semibold transition-all flex items-center justify-center gap-1.5"
                                        :class="teacherAttachmentMode === 'link' ? 'bg-white dark:bg-slate-700 text-[#D65A20] shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'">
                                        <i class="fas" :class="tipePengumpulan === 'audiovisual' ? 'fa-youtube text-red-500' : 'fa-link'"></i>
                                        <span x-text="tipePengumpulan === 'audiovisual' ? 'Tautan Video (YouTube/Drive)' : 'Tautan Template/Proyek'"></span>
                                    </button>
                                </div>

                                {{-- Opsi 1: File drag & drop area --}}
                                <div x-show="(!['audiovisual', 'tautan'].includes(tipePengumpulan)) || (tipePengumpulan === 'audiovisual' && modeAudiovisual === 'audio_file') || teacherAttachmentMode === 'file'">
                                    <div class="relative" 
                                        @dragover.prevent="isDragging = true" 
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="isDragging = false; handleFileDrop($event)">
                                        
                                        {{-- Empty state / drop zone --}}
                                        <label for="attachment" 
                                            class="flex flex-col items-center justify-center gap-3 p-6 border-2 border-dashed rounded-2xl cursor-pointer transition-all duration-200"
                                            :class="isDragging ? 'border-[#D65A20] bg-orange-50/50 dark:bg-orange-900/10' : (fileName ? 'border-emerald-300 bg-emerald-50/50 dark:bg-emerald-900/10' : 'border-slate-200 dark:border-slate-700 hover:border-[#D65A20] hover:bg-slate-50/30')">
                                            
                                            <template x-if="!fileName">
                                                <div class="text-center">
                                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-2 text-slate-500 dark:text-slate-400">
                                                        <i class="fas text-xl" :class="attachmentMeta.icon"></i>
                                                    </div>
                                                    <p class="text-sm font-medium text-slate-600 dark:text-slate-300" x-text="attachmentMeta.placeholder"></p>
                                                    <p class="text-xs text-slate-400 mt-1" x-text="attachmentMeta.hint"></p>
                                                </div>
                                            </template>

                                            <template x-if="fileName">
                                                <div class="flex items-center gap-3 w-full">
                                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                                        <i class="fas fa-file-circle-check"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 truncate" x-text="fileName"></p>
                                                        <p class="text-xs text-emerald-600">Berkas siap diunggah</p>
                                                    </div>
                                                    <button type="button" @click.prevent="clearFile()" class="text-slate-400 hover:text-rose-500 transition p-1">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </template>
                                        </label>
                                        <input type="file" name="attachment" id="attachment" class="sr-only" 
                                            :accept="attachmentMeta.accept"
                                            @change="handleFileSelect($event)" />
                                    </div>
                                </div>

                                {{-- Opsi 2: Input Tautan Online --}}
                                <div x-show="(['audiovisual', 'tautan'].includes(tipePengumpulan)) && !(tipePengumpulan === 'audiovisual' && modeAudiovisual === 'audio_file') && teacherAttachmentMode === 'link'" x-cloak class="space-y-3">
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none" :class="tipePengumpulan === 'audiovisual' ? 'text-rose-500' : 'text-emerald-500'">
                                            <i class="fas" :class="tipePengumpulan === 'audiovisual' ? 'fa-youtube text-sm' : 'fa-link text-sm'"></i>
                                        </span>
                                        <input type="url" name="attachment_link" x-model="teacherAttachmentLink" @input="updateTeacherVideoPreview()"
                                            :placeholder="tipePengumpulan === 'audiovisual' ? 'https://www.youtube.com/watch?v=... atau https://drive.google.com/...' : 'https://www.canva.com/... atau tautan proyek lainnya'"
                                            class="w-full px-4 py-3 pl-10 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] @error('attachment_link') border-rose-500 @enderror" />
                                    </div>
                                    <template x-if="teacherVideoEmbed && tipePengumpulan === 'audiovisual'">
                                        <div class="aspect-video w-full rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-black shadow-inner">
                                            <iframe :src="teacherVideoEmbed" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </template>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5" x-show="tipePengumpulan === 'audiovisual'">
                                        <i class="fas fa-info-circle text-rose-500"></i>
                                        <span>Video dapat berupa tautan YouTube (Unlisted/Public) atau Google Drive.</span>
                                    </p>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5" x-show="tipePengumpulan === 'tautan'">
                                        <i class="fas fa-info-circle text-emerald-500"></i>
                                        <span>Tautan dapat berupa referensi Figma, Canva, GitHub, atau website lainnya.</span>
                                    </p>
                                </div>

                                @error('attachment') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                                @error('attachment_link') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar (Right Column) --}}
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-6 space-y-6">

                    {{-- Pengaturan Tugas --}}
                    <div class="card">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-800 dark:text-white">Pengaturan</h3>
                                <p class="text-xs text-slate-500">Deadline & skor.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Tenggat Waktu --}}
                            <div>
                                <label for="due_date" class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-calendar-alt text-amber-500 text-[10px]"></i>
                                    Tenggat Waktu
                                </label>
                                <input type="datetime-local" name="due_date" id="due_date" x-model="dueDate"
                                    value="{{ old('due_date') }}" 
                                    class="input @error('due_date') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                                @error('due_date') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>

                            {{-- Skor Maksimal --}}
                            <div>
                                <label for="max_score" class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-star text-amber-500 text-[10px]"></i>
                                    Skor Maksimal
                                </label>
                                <input type="number" name="max_score" id="max_score" x-model="maxScore"
                                    value="{{ old('max_score', 100) }}" min="0"
                                    class="input @error('max_score') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                                @error('max_score') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Preview Card --}}
                    <div class="card border-2 border-dashed border-slate-200 dark:border-slate-700" x-show="title || selectedSubject" x-transition>
                        <h4 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-3">
                            <i class="fas fa-eye mr-1"></i> Preview
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-lg font-semibold text-slate-900 dark:text-white leading-snug" x-text="title || 'Judul tugas...'"></p>
                            </div>
                            <div class="flex flex-wrap gap-2" x-show="selectedSubject">
                                <span class="badge badge-info" x-text="selectedSubjectLabel"></span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-500 pt-2 border-t border-slate-100 dark:border-slate-800">
                                <span x-show="dueDate" class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span x-text="formatDate(dueDate)"></span>
                                </span>
                                <span x-show="maxScore" class="flex items-center gap-1">
                                    <i class="fas fa-star"></i>
                                    <span x-text="maxScore + ' Poin'"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Tips --}}
                    <div class="card bg-gradient-to-br from-orange-50 to-amber-50/50 dark:from-orange-900/10 dark:to-amber-900/10 border-orange-100/70 dark:border-orange-800/30">
                        <h4 class="text-xs font-semibold uppercase tracking-widest text-orange-700 dark:text-orange-400 mb-3">
                            <i class="fas fa-lightbulb mr-1"></i> Tips
                        </h4>
                        <ul class="space-y-2.5 text-xs text-slate-600 dark:text-slate-400">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-orange-500 mt-0.5 flex-shrink-0"></i>
                                <span>Berikan instruksi yang <strong>jelas dan terstruktur</strong> agar siswa mudah memahami.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-orange-500 mt-0.5 flex-shrink-0"></i>
                                <span>Tetapkan deadline yang wajar, minimal <strong>1-2 hari</strong> ke depan.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-orange-500 mt-0.5 flex-shrink-0"></i>
                                <span>Lampirkan file pendukung jika diperlukan.</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="space-y-3">
                        <button type="submit" class="btn btn-primary w-full justify-center text-base py-3">
                            <i class="fas fa-paper-plane"></i>
                            Publikasikan Tugas
                        </button>
                        <a href="{{ route('assignments.index') }}" class="btn btn-outline w-full justify-center">
                            Batalkan
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function assignmentForm() {
    return {
        title: '{{ old("title", "") }}',
        description: '{{ old("description", "") }}',
        selectedSubject: '{{ old("subject_id", "") }}',
        selectedClass: '{{ old("class_name", "") }}',
        tipePengumpulan: '{{ old("tipe_pengumpulan", "dokumen") }}',
        modeAudiovisual: '{{ old("mode_audiovisual", "video_url") }}',
        teacherAttachmentMode: 'file',
        teacherAttachmentLink: '{{ old("attachment_link", "") }}',
        teacherVideoEmbed: '',
        dueDate: '{{ old("due_date", "") }}',
        maxScore: '{{ old("max_score", "100") }}',
        fileName: '',
        isDragging: false,
        prereqMateriId: '{{ old("prasyarat_materi_id", "") }}',
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

        onSubjectChange(e) {
            const opt = e.target.options[e.target.selectedIndex];
            this.selectedClass = opt ? opt.getAttribute('data-class') : '';
        },
        
        get filteredMaterials() {
            if (!this.selectedSubject) return [];
            return this.allMaterials.filter(m => m.mata_pelajaran_id == this.selectedSubject);
        },

        get selectedSubjectLabel() {
            const select = document.getElementById('subject_id');
            if (select && select.selectedIndex > 0) {
                return select.options[select.selectedIndex].text;
            }
            return '';
        },

        formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        },

        handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                this.fileName = file.name;
            }
        },

        handleFileDrop(e) {
            const file = e.dataTransfer.files[0];
            if (file) {
                const input = document.getElementById('attachment');
                input.files = e.dataTransfer.files;
                this.fileName = file.name;
            }
        },

        clearFile() {
            this.fileName = '';
            document.getElementById('attachment').value = '';
        }
    }
}
</script>
@endpush
@endsection
