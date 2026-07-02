@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('content')
@php
    $selectedSubjectId = request('subject_id');
    $currentSubject = $subjects->firstWhere('id', $selectedSubjectId) ?? $subjects->first();
@endphp

<div class="max-w-[1100px] mx-auto mt-5 mb-10 px-4">
    <!-- Container Utama -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[2rem] shadow-xl p-6 md:p-10">
        <!-- Header dengan Breadcrumb -->
        <div class="mb-8 border-b border-slate-100 dark:border-slate-800/60 pb-6">
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 dark:text-slate-500 mb-3">
                <a href="{{ route('materials.index') }}" class="hover:text-[#D65A20] transition">Portal Materi</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                @if($currentSubject)
                    <a href="{{ route('materials.index', ['subject_id' => $currentSubject->id]) }}" class="hover:text-[#D65A20] transition">Detail Materi</a>
                @else
                    <span class="text-slate-300">Detail Materi</span>
                @endif
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-[#D65A20]">Tambah Materi</span>
            </nav>
            <div>
                <h1 class="page-title text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Tambah Materi</h1>
                <p class="page-subtitle text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">Unggah materi pembelajaran yang akan diberikan kepada siswa.</p>
            </div>
        </div>

        <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" id="materi-form" class="space-y-6">
            @csrf

            <!-- CARD 1: Informasi Dasar -->
            <div class="bg-white dark:bg-slate-900/40 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 md:p-8 mb-6 transition hover:shadow-md duration-300">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-info-circle text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Informasi Dasar</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Pilih target kelas dan mata pelajaran pengajaran materi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Kelas</label>
                        <select id="kelas-dropdown" class="form-select w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition bg-white" onchange="syncSubjectDropdown()">
                            @foreach($subjects->pluck('classRoom')->unique('id') as $cRoom)
                                @if($cRoom)
                                <option value="{{ $cRoom->name }}" {{ ($currentSubject && $currentSubject->classRoom && $currentSubject->classRoom->name === $cRoom->name) ? 'selected' : '' }}>
                                    {{ $cRoom->name }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Mata Pelajaran</label>
                        <select id="subject-dropdown" name="subject_id" class="form-select w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition bg-white @error('subject_id') border-rose-500 @enderror" required>
                            <!-- Options populated dynamically via JavaScript -->
                        </select>
                        @error('subject_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- CARD 2: Isi Materi -->
            <div class="bg-white dark:bg-slate-900/40 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 md:p-8 mb-6 transition hover:shadow-md duration-300">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-file-alt text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Isi Materi</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Tulis judul materi beserta deskripsi pembelajaran selengkapnya.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Judul Materi</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Bab 1 Pengenalan Aljabar" 
                               class="form-input w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('title') border-rose-500 @enderror">
                        @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Deskripsi Materi</label>
                        <textarea name="description" rows="5" placeholder="Tulis deskripsi singkat mengenai materi ini..." 
                                  class="form-textarea w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('description') border-rose-500 @enderror">{{ old('description') }}</textarea>
                        @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- CARD 3: Upload & Publikasi -->
            <div class="bg-white dark:bg-slate-900/40 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 md:p-8 mb-6 transition hover:shadow-md duration-300">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 text-[#D65A20] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-cloud-upload-alt text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Upload & Publikasi</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Tentukan tipe materi, unggah file, dan atur status publikasi.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Jenis Materi</label>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                            @foreach(['pdf' => 'PDF', 'docx' => 'Word', 'pptx' => 'PPT', 'link' => 'Link'] as $val => $label)
                                <label class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 hover:border-[#D65A20] cursor-pointer transition select-none text-center gap-1.5" id="type-label-{{ $val }}">
                                    <input type="radio" name="type" value="{{ $val }}" class="hidden" {{ $val === 'pdf' ? 'checked' : '' }} onchange="updateTypeSelection(this)">
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

                    <div id="file-upload-container">
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Upload File Materi</label>
                        <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-[#D65A20] rounded-xl p-8 transition flex flex-col items-center justify-center gap-3 cursor-pointer bg-slate-50/30 dark:bg-slate-800/10 relative" 
                             id="drop-zone" onclick="document.getElementById('file-input').click()">
                            <i class="fas fa-cloud-upload-alt text-4xl text-slate-400 transition" id="upload-icon"></i>
                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300" id="file-label">Klik atau tarik file ke sini</span>
                            <span class="text-xs text-slate-400" id="file-format-info">Format: PDF, DOCX, PPTX (Maks 10MB)</span>
                            <input type="file" id="file-input" name="file" class="hidden" onchange="handleFileSelected(this)">
                        </div>
                        @error('file') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div id="link-url-container" class="hidden">
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Link URL Materi</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-400">
                                <i class="fas fa-link"></i>
                            </span>
                            <input type="url" name="link_url" id="link-url-input" value="{{ old('link_url') }}" placeholder="Masukkan link tautan materi (contoh: https://example.com)" 
                                   class="form-input w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('link_url') border-rose-500 @enderror">
                        </div>
                        @error('link_url') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>



                    <!-- Super Admin: Uploader Selection -->
                    @if(auth()->user()->isSuperAdmin())
                    <div>
                        <label class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Uploader (Guru)</label>
                        <select name="uploaded_by" class="form-select w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-[#D65A20]/20 focus:border-[#D65A20] transition @error('uploaded_by') border-rose-500 @enderror" required>
                            <option value="" disabled selected>Pilih Guru...</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('uploaded_by') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('uploaded_by') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    @endif
                </div>
            </div>

            <!-- FOOTER BAR: Kiri Batal | Kanan Simpan Draft & Publikasikan -->
            <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 pt-6 border-t border-slate-100 dark:border-slate-800/80">
                <div>
                    @if($currentSubject)
                        <a href="{{ route('materials.index', ['subject_id' => $currentSubject->id]) }}" 
                           class="border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 font-bold px-6 py-2.5 rounded-lg transition text-sm text-center block">
                            Batal
                        </a>
                    @else
                        <a href="{{ route('materials.index') }}" 
                           class="border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 font-bold px-6 py-2.5 rounded-lg transition text-sm text-center block">
                            Batal
                        </a>
                    @endif
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="bg-[#D65A20] hover:bg-orange-700 text-white font-bold px-6 py-2.5 rounded-lg transition text-sm shadow-sm shadow-orange-500/10 text-center flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan Materi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

@push('scripts')
<script>
    const subjects = @json($subjects->map(function($s) {
        return [
            'id' => $s->id,
            'class_name' => $s->classRoom->name ?? '',
            'course_name' => $s->nama
        ];
    }));

    const oldSubjectId = "{{ old('subject_id') }}";
    const selectedSubjectId = "{{ $currentSubject->id ?? '' }}";

    function syncSubjectDropdown() {
        const classVal = document.getElementById('kelas-dropdown').value;
        const subSelect = document.getElementById('subject-dropdown');
        
        // Clear previous options
        subSelect.innerHTML = '';
        
        // Filter subjects taught in this class
        const filtered = subjects.filter(s => s.class_name === classVal);
        
        filtered.forEach(s => {
            const opt = document.createElement('option');
            opt.value = s.id;
            opt.textContent = s.course_name;
            
            // Set selected state
            if (oldSubjectId && s.id.toString() === oldSubjectId) {
                opt.selected = true;
            } else if (!oldSubjectId && selectedSubjectId && s.id.toString() === selectedSubjectId) {
                opt.selected = true;
            }
            
            subSelect.appendChild(opt);
        });
    }

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
        const formatInfo = document.getElementById('file-format-info');

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
                    if (formatInfo) formatInfo.textContent = 'Format: PDF (Maks 10MB)';
                } else if (radio.value === 'docx') {
                    fileInput.setAttribute('accept', '.doc,.docx');
                    if (formatInfo) formatInfo.textContent = 'Format: DOC, DOCX (Maks 10MB)';
                } else if (radio.value === 'pptx') {
                    fileInput.setAttribute('accept', '.ppt,.pptx');
                    if (formatInfo) formatInfo.textContent = 'Format: PPT, PPTX (Maks 10MB)';
                } else if (radio.value === 'video') {
                    fileInput.setAttribute('accept', 'video/*');
                    if (formatInfo) formatInfo.textContent = 'Format: MP4, MOV, AVI, MKV, WEBM (Maks 10MB)';
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
        const zone = document.getElementById('drop-zone');
        
        if (input.files.length > 0) {
            const file = input.files[0];
            const selectedType = document.querySelector('input[name="type"]:checked')?.value || 'pdf';
            
            if (!validateFileFormat(file, selectedType)) {
                showCustomAlert(`Format berkas tidak sesuai! Untuk tipe ${selectedType.toUpperCase()}, silakan unggah berkas yang valid.`);
                input.value = '';
                label.textContent = "Klik atau tarik file ke sini";
                label.classList.remove('text-[#D65A20]');
                icon.className = "fas fa-cloud-upload-alt text-4xl text-slate-400";
                zone.classList.remove('border-emerald-500', 'bg-emerald-50/10');
                zone.classList.add('border-slate-200', 'dark:border-slate-700');
                return;
            }

            label.textContent = `${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            label.classList.add('text-[#D65A20]');
            icon.className = "fas fa-check-circle text-4xl text-emerald-500";
            zone.classList.add('border-emerald-500', 'bg-emerald-50/10');
            zone.classList.remove('border-slate-200', 'dark:border-slate-700');
        } else {
            label.textContent = "Klik atau tarik file ke sini";
            label.classList.remove('text-[#D65A20]');
            icon.className = "fas fa-cloud-upload-alt text-4xl text-slate-400";
            zone.classList.remove('border-emerald-500', 'bg-emerald-50/10');
            zone.classList.add('border-slate-200', 'dark:border-slate-700');
        }
    }



    // Setup Drag and Drop events
    document.addEventListener('DOMContentLoaded', function() {
        const zone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        
        if (zone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                zone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    zone.classList.add('border-[#D65A20]', 'bg-orange-50/10');
                }, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                zone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    zone.classList.remove('border-[#D65A20]', 'bg-orange-50/10');
                }, false);
            });
            
            zone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelected(fileInput);
                }
            }, false);
        }

        // Initialize selectors and radio highlights
        syncSubjectDropdown();
        const activeRadio = document.querySelector('input[name="type"]:checked');
        if (activeRadio) {
            updateTypeSelection(activeRadio);
        }
    });
</script>
@endpush
@endsection
