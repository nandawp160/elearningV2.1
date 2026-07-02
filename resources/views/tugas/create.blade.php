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

                        {{-- Lampiran --}}
                        <div>
                            <label class="field-label mb-1.5 flex items-center gap-1.5">
                                <i class="fas fa-paperclip text-sky-500 text-[10px]"></i>
                                Lampiran File
                                <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
                            </label>
                            <div class="relative" 
                                @dragover.prevent="isDragging = true" 
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="isDragging = false; handleFileDrop($event)">
                                
                                {{-- Empty state / drop zone --}}
                                <label for="attachment" 
                                    class="flex flex-col items-center justify-center gap-3 p-6 border-2 border-dashed rounded-2xl cursor-pointer transition-all duration-200"
                                    :class="isDragging ? 'border-orange-400 bg-orange-50/50 dark:bg-orange-900/10' : (fileName ? 'border-emerald-300 bg-emerald-50/50 dark:bg-emerald-900/10' : 'border-slate-200 dark:border-slate-700 hover:border-orange-300 hover:bg-orange-50/30')">
                                    
                                    <template x-if="!fileName">
                                        <div class="text-center">
                                            <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-2">
                                                <i class="fas fa-cloud-upload-alt text-xl text-slate-400"></i>
                                            </div>
                                            <p class="text-sm font-medium text-slate-600 dark:text-slate-300">Klik untuk pilih file atau <span class="text-orange-600">seret ke sini</span></p>
                                            <p class="text-xs text-slate-400 mt-1">PDF, DOC, DOCX, ZIP, JPG, PNG (maks 10MB)</p>
                                        </div>
                                    </template>

                                    <template x-if="fileName">
                                        <div class="flex items-center gap-3 w-full">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-file-check"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 truncate" x-text="fileName"></p>
                                                <p class="text-xs text-emerald-600">File siap diupload</p>
                                            </div>
                                            <button type="button" @click.prevent="clearFile()" class="text-slate-400 hover:text-rose-500 transition p-1">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </template>
                                </label>
                                <input type="file" name="attachment" id="attachment" class="sr-only" 
                                    accept=".pdf,.doc,.docx,.zip,.jpg,.png"
                                    @change="handleFileSelect($event)" />
                            </div>
                            @error('attachment') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
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
        dueDate: '{{ old("due_date", "") }}',
        maxScore: '{{ old("max_score", "100") }}',
        fileName: '',
        isDragging: false,
        prereqMateriId: '{{ old("prasyarat_materi_id", "") }}',
        allMaterials: @json($allMaterials),

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
