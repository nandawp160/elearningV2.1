@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')
<div class="space-y-6" x-data="editAssignmentForm()">

    {{-- Header --}}
    <div class="card">
        <div class="card-header border-b-0 pb-0">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                    <a href="{{ route('assignments.index') }}" class="hover:text-orange-600 transition">Tugas & Evaluasi</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <a href="{{ route('assignments.show', $assignment) }}" class="hover:text-orange-600 transition">{{ Str::limit($assignment->title, 30) }}</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-slate-800 dark:text-white font-medium">Edit</span>
                </div>
                <h1 class="page-title">Edit Tugas</h1>
                <p class="page-subtitle mt-1">Perbarui detail penugasan.</p>
            </div>
            <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                            <p class="text-xs text-slate-500">Ubah mata pelajaran dan judul tugas.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        {{-- Mata Pelajaran --}}
                        <div>
                            <label for="subject_id" class="field-label mb-1.5 flex items-center gap-1.5">
                                <i class="fas fa-book-open text-orange-500 text-[10px]"></i>
                                Mata Pelajaran & Kelas
                            </label>
                            <select name="subject_id" id="subject_id" x-model="selectedSubject"
                                class="select @error('subject_id') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $assignment->subject_id) == $subject->id ? 'selected' : '' }}>
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
                                value="{{ old('title', $assignment->title) }}" 
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
                            <p class="text-xs text-slate-500">Perbarui instruksi dan lampiran tugas.</p>
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
                                class="input @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>{{ old('description', $assignment->description) }}</textarea>
                            @error('description') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>

                        {{-- Lampiran --}}
                        <div>
                            <label class="field-label mb-1.5 flex items-center gap-1.5">
                                <i class="fas fa-paperclip text-sky-500 text-[10px]"></i>
                                Lampiran File
                                <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
                            </label>

                            {{-- Existing attachment info --}}
                            @if($assignment->attachment)
                            <div class="flex items-center gap-3 p-3 mb-3 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-200 dark:border-slate-700" x-show="!newFileName">
                                <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-900/30 text-sky-600 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-file"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-700 dark:text-slate-200 truncate">{{ basename($assignment->attachment) }}</p>
                                    <p class="text-xs text-slate-400">Lampiran saat ini</p>
                                </div>
                                <a href="{{ $assignment->attachment_url }}" target="_blank" class="text-orange-600 hover:text-orange-700 text-sm font-medium">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                            @endif

                            <div class="relative" 
                                @dragover.prevent="isDragging = true" 
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="isDragging = false; handleFileDrop($event)">
                                
                                <label for="attachment" 
                                    class="flex flex-col items-center justify-center gap-3 p-5 border-2 border-dashed rounded-2xl cursor-pointer transition-all duration-200"
                                    :class="isDragging ? 'border-orange-400 bg-orange-50/50 dark:bg-orange-900/10' : (newFileName ? 'border-emerald-300 bg-emerald-50/50 dark:bg-emerald-900/10' : 'border-slate-200 dark:border-slate-700 hover:border-orange-300 hover:bg-orange-50/30')">
                                    
                                    <template x-if="!newFileName">
                                        <div class="text-center">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-2">
                                                <i class="fas fa-cloud-upload-alt text-lg text-slate-400"></i>
                                            </div>
                                            <p class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ $assignment->attachment ? 'Upload file baru untuk mengganti' : 'Klik untuk pilih file atau seret ke sini' }}</p>
                                            <p class="text-xs text-slate-400 mt-1">PDF, DOC, DOCX, ZIP, JPG, PNG (maks 10MB)</p>
                                        </div>
                                    </template>

                                    <template x-if="newFileName">
                                        <div class="flex items-center gap-3 w-full">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-file-check"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100 truncate" x-text="newFileName"></p>
                                                <p class="text-xs text-emerald-600">File baru siap diupload</p>
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
                                <p class="text-xs text-slate-500">Deadline, skor & status.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Status Tugas --}}
                            <div>
                                <label for="status" class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-toggle-on text-amber-500 text-[10px]"></i>
                                    Status Tugas
                                </label>
                                <select name="status" id="status" class="select" required>
                                    <option value="active" {{ old('status', $assignment->status) == 'active' ? 'selected' : '' }}>
                                        ✅ Aktif — Siswa dapat mengumpulkan
                                    </option>
                                    <option value="inactive" {{ old('status', $assignment->status) == 'inactive' ? 'selected' : '' }}>
                                        ⏸️ Nonaktif — Tugas disembunyikan
                                    </option>
                                </select>
                            </div>

                            {{-- Tenggat Waktu --}}
                            <div>
                                <label for="due_date" class="field-label mb-1.5 flex items-center gap-1.5">
                                    <i class="fas fa-calendar-alt text-amber-500 text-[10px]"></i>
                                    Tenggat Waktu
                                </label>
                                <input type="datetime-local" name="due_date" id="due_date" x-model="dueDate"
                                    value="{{ old('due_date', $assignment->due_date->format('Y-m-d\TH:i')) }}" 
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
                                    value="{{ old('max_score', $assignment->max_score) }}" min="0"
                                    class="input @error('max_score') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                                @error('max_score') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Assignment Info (metadata) --}}
                    <div class="card">
                        <h4 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-3">
                            <i class="fas fa-info-circle mr-1"></i> Info Tugas
                        </h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Dibuat</span>
                                <span class="font-medium text-slate-700 dark:text-slate-200">{{ $assignment->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Terakhir diubah</span>
                                <span class="font-medium text-slate-700 dark:text-slate-200">{{ $assignment->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Pengumpulan</span>
                                <span class="font-semibold text-orange-600">{{ $assignment->submissions()->count() }} siswa</span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="space-y-3">
                        <button type="submit" class="btn btn-primary w-full justify-center text-base py-3">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-outline w-full justify-center">
                            Batalkan
                        </a>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="card border-rose-200/70 dark:border-rose-800/30 bg-rose-50/30 dark:bg-rose-900/5">
                        <h4 class="text-xs font-semibold uppercase tracking-widest text-rose-600 dark:text-rose-400 mb-3">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Zona Bahaya
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">Menghapus tugas akan menghapus semua data pengumpulan siswa secara permanen.</p>
                        <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin? Semua data pengumpulan siswa akan DIHAPUS PERMANEN.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-full justify-center text-sm">
                                <i class="fas fa-trash"></i>
                                Hapus Tugas Ini
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function editAssignmentForm() {
    return {
        title: @json(old('title', $assignment->title)),
        description: @json(old('description', $assignment->description)),
        selectedSubject: '{{ old("subject_id", $assignment->subject_id) }}',
        dueDate: '{{ old("due_date", $assignment->due_date->format("Y-m-d\TH:i")) }}',
        maxScore: '{{ old("max_score", $assignment->max_score) }}',
        newFileName: '',
        isDragging: false,
        prereqMateriId: '{{ old("prasyarat_materi_id", $assignment->prasyarat_materi_id) }}',
        allMaterials: @json($allMaterials),
        
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
        }
    }
}
</script>
@endpush
@endsection
