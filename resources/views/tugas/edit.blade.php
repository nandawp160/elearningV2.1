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

                            {{-- Lampiran File --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1.5">
                                    Berkas Lampiran Soal <span class="text-slate-400 font-normal">(opsional)</span>
                                </label>

                                {{-- Current attachment display --}}
                                @if($assignment->attachment)
                                <div class="flex items-center gap-3 p-3 mb-4 bg-slate-50 dark:bg-slate-950/40 rounded-xl border border-slate-200 dark:border-slate-800" x-show="!newFileName">
                                    <div class="w-9 h-9 rounded-lg bg-orange-100 dark:bg-orange-950/30 text-[#D65A20] flex items-center justify-center flex-shrink-0 text-sm">
                                        <i class="far fa-file-pdf"></i>
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

                                {{-- File drag & drop area --}}
                                <div class="relative" 
                                    @dragover.prevent="isDragging = true" 
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="isDragging = false; handleFileDrop($event)">
                                    
                                    <label for="attachment" 
                                        class="flex flex-col items-center justify-center gap-2.5 p-6 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200"
                                        :class="isDragging ? 'border-[#D65A20] bg-orange-50/10 dark:bg-orange-950/10' : (newFileName ? 'border-emerald-500 bg-emerald-50/10 dark:bg-emerald-950/10' : 'border-slate-200 dark:border-slate-800 hover:border-[#D65A20] hover:bg-slate-50/30')">
                                        
                                        <template x-if="!newFileName">
                                            <div class="text-center">
                                                <i class="fas fa-cloud-upload-alt text-lg text-slate-400 mb-1"></i>
                                                <p class="text-xs font-semibold text-slate-600 dark:text-slate-350">{{ $assignment->attachment ? 'Pilih berkas baru untuk mengganti' : 'Klik untuk pilih file atau seret ke sini' }}</p>
                                                <p class="text-[10px] text-slate-400 mt-0.5">PDF, DOC, DOCX, ZIP, JPG, PNG (Maks 10MB)</p>
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
                                        accept=".pdf,.doc,.docx,.zip,.jpg,.png"
                                        @change="handleFileSelect($event)" />
                                </div>
                                @error('attachment') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
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
                        <div>
                            <label for="due_date" class="block text-xs font-bold text-slate-500 mb-1.5">
                                Tenggat Waktu (Deadline)
                            </label>
                            <input type="datetime-local" name="due_date" id="due_date" x-model="dueDate"
                                value="{{ old('due_date', $assignment->due_date->format('Y-m-d\TH:i')) }}" 
                                class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('due_date') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                            @error('due_date') <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
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
