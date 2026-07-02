@extends('layouts.app')

@section('title', 'Edit Materi')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto">
    <!-- Header Card -->
    <div class="card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('materials.index', ['subject_id' => $material->subject_id]) }}" class="w-10 h-10 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center justify-center" title="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="page-title text-xl md:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Edit Materi Pembelajaran</h1>
                    <p class="page-subtitle text-xs text-slate-500 mt-0.5">Perbarui informasi dan dokumen materi belajar siswa.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <form action="{{ route('materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Mata Pelajaran & Kelas (ReadOnly or Select) -->
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Mata Pelajaran & Kelas</label>
                <select name="subject_id" class="form-select w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('subject_id') border-rose-500 @enderror" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id', $material->subject_id) == $subject->id ? 'selected' : '' }}>
                            {{ $subject->nama }} (Kelas {{ $subject->classRoom->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('subject_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Judul Materi -->
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Judul Materi</label>
                <input type="text" name="title" value="{{ old('title', $material->title) }}" required 
                       class="form-input w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('title') border-rose-500 @enderror">
                @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Jenis Materi -->
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Jenis Materi</label>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                    @foreach(['pdf' => 'PDF', 'docx' => 'Word', 'pptx' => 'PPT', 'link' => 'Link'] as $val => $label)
                        <label class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 hover:border-[#D65A20] cursor-pointer transition select-none text-center gap-1.5" id="type-label-{{ $val }}">
                            <input type="radio" name="type" value="{{ $val }}" class="hidden" {{ old('type', $material->type) === $val ? 'checked' : '' }} onchange="updateTypeSelection(this)">
                            @if($val === 'pdf')
                                <i class="fas fa-file-pdf text-2xl text-red-500"></i>
                            @elseif($val === 'docx')
                                <i class="fas fa-file-word text-2xl text-blue-500"></i>
                            @elseif($val === 'pptx')
                                <i class="fas fa-file-powerpoint text-2xl text-orange-500"></i>
                            @elseif($val === 'video')
                                <i class="fas fa-video text-2xl text-[#D65A20]"></i>
                            @else
                                <i class="fas fa-link text-2xl text-emerald-500"></i>
                            @endif
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-300 mt-1">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- File Upload -->
            <div id="file-upload-container">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">File Materi (Opsional)</label>
                <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-[#D65A20] rounded-xl p-4 transition flex flex-col items-center justify-center gap-2 cursor-pointer bg-slate-50/30 dark:bg-slate-800/10 relative" onclick="document.getElementById('file-input').click()">
                    <i class="fas fa-cloud-upload-alt text-2xl text-slate-400" id="upload-icon"></i>
                    <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 text-center" id="file-label">Pilih berkas baru jika ingin mengganti file saat ini</span>
                    <input type="file" id="file-input" name="file" class="hidden" onchange="handleFileSelected(this)">
                </div>
                @if($material->file_path && !filter_var($material->file_path, FILTER_VALIDATE_URL) && !str_starts_with($material->file_path, 'http://') && !str_starts_with($material->file_path, 'https://'))
                    <div class="mt-3 flex items-center gap-2 p-2.5 rounded-lg bg-orange-50/50 dark:bg-orange-950/10 border border-orange-100/50 dark:border-orange-900/30 w-fit" id="current-file-preview">
                        <i class="fas fa-file-alt text-[#D65A20]"></i>
                        <span class="text-xs text-slate-600 dark:text-slate-400">File saat ini:</span>
                        <a href="{{ route('download.material', $material->id) }}" target="_blank" class="text-xs font-bold text-[#D65A20] hover:underline flex items-center gap-1">
                            Lihat Dokumen <i class="fas fa-external-link-alt text-[9px]"></i>
                        </a>
                    </div>
                @endif
                @error('file') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Link URL -->
            <div id="link-url-container" class="hidden">
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Link URL Materi</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <i class="fas fa-link"></i>
                    </span>
                    <input type="url" name="link_url" id="link-url-input" 
                           value="{{ old('link_url', $material->url) }}" 
                           placeholder="Masukkan link tautan materi (contoh: https://example.com)" 
                           class="form-input w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('link_url') border-rose-500 @enderror">
                </div>
                @error('link_url') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Deskripsi Materi -->
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Deskripsi</label>
                <textarea name="description" rows="4" 
                          class="form-textarea w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('description') border-rose-500 @enderror">{{ old('description', $material->description) }}</textarea>
                @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>



            <!-- Super Admin: Uploader Selection -->
            @if(auth()->user()->isSuperAdmin())
            <div>
                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Uploader (Guru)</label>
                <select name="uploaded_by" class="form-select w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('uploaded_by') border-rose-500 @enderror" required>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('uploaded_by', $material->uploaded_by) == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->nama }}
                        </option>
                    @endforeach
                </select>
                @error('uploaded_by') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            @endif

            <!-- Submit & Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('materials.index', ['subject_id' => $material->subject_id]) }}" class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition text-sm">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#D65A20] hover:bg-orange-700 text-white font-semibold transition text-sm shadow-sm shadow-orange-500/10 flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function validateFileFormat(file, type) {
        const extension = file.name.split('.').pop().toLowerCase();
        if (type === 'pdf') {
            return extension === 'pdf';
        } else if (type === 'docx') {
            return ['doc', 'docx'].includes(extension);
        } else if (type === 'pptx') {
            return ['ppt', 'pptx'].includes(extension);
        } else if (type === 'video') {
            return ['mp4', 'mov', 'avi', 'mkv', 'webm'].includes(extension) || file.type.startsWith('video/');
        }
        return true;
    }

    function updateTypeSelection(radio) {
        // Reset border classes on labels
        document.querySelectorAll('label[id^="type-label-"]').forEach(lbl => {
            lbl.classList.remove('border-[#D65A20]', 'bg-orange-50/20');
            lbl.classList.add('border-slate-200', 'dark:border-slate-700');
        });
        
        // Highlight active radio label
        const activeLabel = document.getElementById('type-label-' + radio.value);
        if (activeLabel) {
            activeLabel.classList.remove('border-slate-200', 'dark:border-slate-700');
            activeLabel.classList.add('border-[#D65A20]', 'bg-orange-50/20');
        }

        const fileContainer = document.getElementById('file-upload-container');
        const linkContainer = document.getElementById('link-url-container');
        const fileInput = document.getElementById('file-input');
        const linkInput = document.getElementById('link-url-input');

        // Clear file input on type change to prevent leftover mismatches
        if (fileInput) {
            fileInput.value = '';
            handleFileSelected(fileInput);
        }

        if (radio.value === 'link') {
            if (fileContainer) fileContainer.classList.add('hidden');
            if (linkContainer) linkContainer.classList.remove('hidden');
            if (fileInput) fileInput.disabled = true;
            if (linkInput) {
                linkInput.disabled = false;
                linkInput.required = true;
            }
        } else {
            if (fileContainer) fileContainer.classList.remove('hidden');
            if (linkContainer) linkContainer.classList.add('hidden');
            if (linkInput) {
                linkInput.disabled = true;
                linkInput.required = false;
            }
            if (fileInput) {
                fileInput.disabled = false;
                
                // Set correct accept extensions
                if (radio.value === 'pdf') {
                    fileInput.setAttribute('accept', '.pdf');
                } else if (radio.value === 'docx') {
                    fileInput.setAttribute('accept', '.doc,.docx');
                } else if (radio.value === 'pptx') {
                    fileInput.setAttribute('accept', '.ppt,.pptx');
                } else if (radio.value === 'video') {
                    fileInput.setAttribute('accept', 'video/*');
                }
            }
        }
    }

    function showCustomAlert(message) {
        if (document.getElementById('custom-alert-overlay')) return;
        
        const overlay = document.createElement('div');
        overlay.id = 'custom-alert-overlay';
        overlay.style.zIndex = '999999';
        overlay.className = 'fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all duration-300 opacity-0';
        overlay.innerHTML = `
            <div id="custom-alert-box" class="bg-white dark:bg-slate-900 rounded-[1.5rem] border border-slate-100 dark:border-slate-800/80 shadow-2xl p-6 md:p-8 max-w-sm w-full transform scale-95 opacity-0 transition-all duration-300 flex flex-col items-center">
                <div class="w-14 h-14 rounded-2xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center mb-5 text-2xl animate-bounce">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white mb-2 text-center tracking-tight">Format Berkas Salah</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 text-center mb-6 font-medium leading-relaxed">${message}</p>
                <button type="button" id="close-custom-alert-btn" class="w-full bg-[#D65A20] hover:bg-orange-700 text-white font-bold py-2.5 rounded-xl transition text-sm text-center shadow-sm shadow-orange-500/10 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20">
                    Saya Mengerti
                </button>
            </div>
        `;
        document.body.appendChild(overlay);
        
        const box = document.getElementById('custom-alert-box');
        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');
            if (box) {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }
        }, 10);
        
        const closeAlert = () => {
            if (box) {
                box.classList.remove('scale-100', 'opacity-100');
                box.classList.add('scale-95', 'opacity-0');
            }
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            setTimeout(() => { overlay.remove(); }, 300);
        };
        
        document.getElementById('close-custom-alert-btn').addEventListener('click', closeAlert);
        overlay.addEventListener('click', (e) => { if (e.target === overlay) closeAlert(); });
    }

    function handleFileSelected(input) {
        const label = document.getElementById('file-label');
        const icon = document.getElementById('upload-icon');
        
        if (input.files.length > 0) {
            const file = input.files[0];
            const selectedType = document.querySelector('input[name="type"]:checked')?.value || 'pdf';
            
            if (!validateFileFormat(file, selectedType)) {
                showCustomAlert(`Format berkas tidak sesuai! Untuk tipe ${selectedType.toUpperCase()}, silakan unggah berkas yang valid.`);
                input.value = '';
                label.textContent = "Pilih berkas baru jika ingin mengganti file saat ini";
                label.classList.remove('text-[#D65A20]');
                icon.className = "fas fa-cloud-upload-alt text-2xl text-slate-400";
                return;
            }

            label.textContent = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            label.classList.add('text-[#D65A20]');
            icon.className = "fas fa-check-circle text-2xl text-emerald-500";
        } else {
            label.textContent = "Pilih berkas baru jika ingin mengganti file saat ini";
            label.classList.remove('text-[#D65A20]');
            icon.className = "fas fa-cloud-upload-alt text-2xl text-slate-400";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const activeRadio = document.querySelector('input[name="type"]:checked');
        if (activeRadio) {
            updateTypeSelection(activeRadio);
        }
    });
</script>
@endpush
@endsection
