@extends('layouts.app')

@section('title', 'Tugas & Evaluasi')

@section('content')
<style>
    @keyframes progress-indefinite {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    .animate-progress-indefinite {
        animation: progress-indefinite 1.5s infinite linear;
    }

    /* Premium Design System for Tambah Tugas Modal */
    .select-premium {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1.5px solid #cbd5e1;
        background-color: #fff;
        color: #1e293b;
        font-size: 14px;
        font-weight: 500;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 16px center;
        background-repeat: no-repeat;
        background-size: 20px;
    }
    .select-premium:focus {
        border-color: #D65A20;
        box-shadow: 0 0 0 3px rgba(214, 90, 32, 0.15);
    }
    .select-premium:disabled {
        background-color: #f1f5f9;
        cursor: not-allowed;
        color: #94a3b8;
    }
    .input-premium {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1.5px solid #cbd5e1;
        background-color: #fff;
        color: #1e293b;
        font-size: 14px;
        font-weight: 500;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-premium:focus {
        border-color: #D65A20;
        box-shadow: 0 0 0 3px rgba(214, 90, 32, 0.15);
    }
    .dropzone-premium {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 24px 20px;
        cursor: pointer;
        background-color: #f8fafc;
        transition: border-color 0.2s, background-color 0.2s, border-style 0.2s;
    }
    .dropzone-premium:not(.locked):hover {
        border-color: #D65A20;
        background-color: rgba(214, 90, 32, 0.02);
    }
    .btn-batal {
        padding: 12px 32px;
        border-radius: 30px;
        border: 1.5px solid #cbd5e1;
        background-color: #fff;
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s, border-color 0.2s;
    }
    .btn-batal:hover {
        background-color: #f1f5f9;
        border-color: #94a3b8;
    }
    .btn-simpan {
        padding: 12px 32px;
        border-radius: 30px;
        border: none;
        background-color: #D65A20;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s, box-shadow 0.2s;
    }
    .btn-simpan:hover {
        background-color: #c24e18;
        box-shadow: 0 4px 12px rgba(214, 90, 32, 0.2);
    }
</style>

{{-- ================================================================ --}}
{{-- Alpine.js root — manages modal state for "Buat Tugas Baru"       --}}
{{-- ================================================================ --}}
<div x-data="assignmentModals()" @keydown.escape.window="closeModal(); closeSubmitModal()">
    
    {{-- Modern Notification Modal --}}
    <x-notification-modal />

    {{-- ── Success Toast ─────────────────────────────────────────────── --}}
    @if(session('success'))
    <div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between fade-in-up">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-check-circle"></i>
            </div>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition p-1">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    {{-- ── Validation Error Toast (re-opens modal automatically) ──────── --}}
    @if($errors->any())
    <div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between fade-in-up"
        x-init="openModal()">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <span class="font-semibold text-sm">Terdapat kesalahan pada form. Silakan periksa kembali.</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition p-1">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @php
        $totalAssignments = $assignments->count();
        $activeCount = $assignments->where('status', 'active')->filter(fn($a) => !$a->is_overdue)->count();
        $overdueCount = $assignments->filter(fn($a) => $a->is_overdue)->count();
        
        // Fix for undefined property in lazy loaded collections when calculating total submissions
        $totalSubmissions = 0;
        if(auth()->user()->isTeacher() || auth()->user()->isSuperAdmin()) {
            $totalSubmissions = $assignments->sum(fn($a) => clone $a->submissions ? $a->submissions->count() : 0);
        }
    @endphp

    <div class="space-y-6">

        {{-- ── Page Header ─────────────────────────────────────────────── --}}
        <div class="card">
            <div class="card-header border-b-0 pb-0">
                <div>
                    <h1 class="page-title">Tugas & Evaluasi</h1>
                    <p class="page-subtitle mt-1">Kelola penugasan, pantau pengumpulan, dan nilai pekerjaan siswa.</p>
                </div>
                {{-- [DIMODIFIKASI] Tombol ini sekarang membuka modal, bukan redirect --}}
                @if(auth()->user()->isSuperAdmin() || auth()->user()->isTeacher())
                <button @click="openModal()" type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Buat Tugas Baru
                </button>
                @endif
            </div>
        </div>

        {{-- ── Stat Cards ───────────────────────────────────────────────── --}}
        @if(auth()->user()->isSuperAdmin() || auth()->user()->isTeacher())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 stagger">
            <div class="stat-card">
                <div>
                    <p class="stat-label">Total Tugas</p>
                    <p class="stat-value">{{ $totalAssignments }}</p>
                </div>
                <div class="stat-icon bg-orange-50 dark:bg-orange-900/20 text-orange-600">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="stat-label">Aktif</p>
                    <p class="stat-value text-emerald-600">{{ $activeCount }}</p>
                </div>
                <div class="stat-icon bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="stat-label">Terlewat</p>
                    <p class="stat-value text-rose-600">{{ $overdueCount }}</p>
                </div>
                <div class="stat-icon bg-rose-50 dark:bg-rose-900/20 text-rose-600">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="stat-label">Pengumpulan</p>
                    <p class="stat-value text-sky-600">{{ $totalSubmissions }}</p>
                </div>
                <div class="stat-icon bg-sky-50 dark:bg-sky-900/20 text-sky-600">
                    <i class="fas fa-file-upload text-xl"></i>
                </div>
            </div>
        </div>
        @endif

        {{-- ── DataTable ────────────────────────────────────────────────── --}}
        <div class="card p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="dataTable" class="table-ui w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left w-16">No</th>
                            <th class="px-6 py-4 text-left">Detail Tugas</th>
                            <th class="px-6 py-4 text-left">Pelajaran & Kelas</th>
                            <th class="px-6 py-4 text-left">Tenggat Waktu</th>
                            <th class="px-6 py-4 text-left">Pengumpulan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $index => $assignment)
                        <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                            <td class="px-6 py-4 text-slate-500 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3 w-max">
                                    <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-900/20 text-orange-600 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-clipboard-list text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800 dark:text-white max-w-[200px] truncate" title="{{ $assignment->title }}">{{ $assignment->title }}</h3>
                                        <p class="text-xs text-slate-500 mt-0.5 truncate max-w-[200px]">{{ Str::limit(strip_tags($assignment->description), 40) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 items-start w-max">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $assignment->subject->course->name }}</span>
                                    <span class="badge badge-info">Kelas {{ $assignment->subject->classRoom->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm w-max">
                                @php
                                    $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                                    $isPassed = $dueDate->isPast();
                                @endphp
                                <div class="flex flex-col gap-1">
                                    <span class="{{ $isPassed ? 'text-rose-600 font-semibold' : 'text-slate-700 dark:text-slate-300' }}">
                                        {{ $dueDate->format('d M Y, H:i') }}
                                    </span>
                                    @if(!$isPassed)
                                    <span class="text-xs text-slate-500">{{ $dueDate->diffForHumans() }}</span>
                                    @else
                                    <span class="text-xs text-rose-500 font-medium">Batas waktu telah lewat</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $totalStudents = $assignment->subject->classRoom->student_count ?? 0;
                                    $submitted = $assignment->submissions ? $assignment->submissions->count() : 0;
                                    $percent = $totalStudents > 0 ? min(100, ($submitted / $totalStudents) * 100) : 0;
                                @endphp
                                <div class="flex flex-col gap-1.5 w-32">
                                    <div class="flex justify-between text-xs font-medium">
                                        <span class="text-emerald-600">{{ $submitted }} Terkumpul</span>
                                        <span class="text-slate-400">/ {{ $totalStudents }}</span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($assignment->status === 'active' && !$isPassed)
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($assignment->status === 'inactive')
                                    <span class="badge badge-warning">Draft</span>
                                @else
                                    <span class="badge badge-danger">Ditutup</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center justify-center gap-1.5">
                                    <a href="{{ route('assignments.show', $assignment) }}" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-orange-500 hover:text-white transition" title="Lihat Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    @if(auth()->user()->isTeacher() || auth()->user()->isSuperAdmin())
                                    <a href="{{ route('assignments.edit', $assignment) }}" class="p-2 rounded-lg bg-amber-50 dark:bg-amber-900/20 text-amber-600 hover:bg-amber-500 hover:text-white transition" title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini? Semua data pengumpulan siswa akan ikut terhapus.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-rose-50 dark:bg-rose-900/20 text-rose-600 hover:bg-rose-500 hover:text-white transition" title="Hapus">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    @if(auth()->user()->isStudent())
                                        @php
                                            $mySub = $assignment->submissions->where('student_id', auth()->user()->student_id)->first();
                                            $isLocked = false;
                                            $tunggakanCount = 0;
                                            if(isset($tunggakanList)) {
                                                $otherTunggakan = $tunggakanList->filter(fn($id) => $id != $assignment->id);
                                                $tunggakanCount = $otherTunggakan->count();
                                                $isLocked = $tunggakanCount > 0;
                                            }
                                        @endphp
                                        @if($mySub)
                                            <button type="button"
                                                @click="openSubmitModal({{ $assignment->id }}, '{{ addslashes($assignment->title) }}', {{ $isLocked ? 'true' : 'false' }}, {{ $tunggakanCount }}, {{ $assignment->subject_id }}, {{ json_encode($mySub) }})"
                                                class="p-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 hover:bg-emerald-500 hover:text-white transition" title="Lihat Pengumpulan">
                                                <i class="fas fa-check-circle text-sm"></i>
                                            </button>
                                        @else
                                            <button @click="openSubmitModal({{ $assignment->id }}, '{{ addslashes($assignment->title) }}', {{ $isLocked ? 'true' : 'false' }}, {{ $tunggakanCount }}, {{ $assignment->subject_id }})" type="button" class="p-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 hover:bg-emerald-500 hover:text-white transition" title="Kirim Tugas">
                                                <i class="fas fa-upload text-sm"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- MODAL: Buat Tugas Baru (Hanya Guru/Admin)                        --}}
    {{-- ================================================================ --}}
    @if(auth()->user()->isSuperAdmin() || auth()->user()->isTeacher())
    <div
        x-show="open"
        x-cloak
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
        role="dialog"
        aria-modal="true"
        aria-label="Form Tambah Tugas">

        {{-- Backdrop --}}
        <div
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
            x-show="open"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="closeModal()"
            aria-hidden="true">
        </div>

        {{-- Modal Panel --}}
        <div
            class="relative w-full max-w-4xl my-auto"
            x-show="open"
            x-transition:enter="transition duration-250 ease-out"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="closeModal()">

            <div class="bg-white dark:bg-slate-900 rounded-[30px] shadow-2xl border border-slate-200/70 dark:border-slate-800/70 overflow-hidden">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-10 py-8">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah Tugas</h2>
                    <button
                        @click="closeModal()"
                        type="button"
                        class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:text-slate-800 dark:hover:text-white transition"
                        title="Tutup">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                {{-- Modal Body — the Form --}}
                <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Form inputs mapping & compatibility --}}
                    <input type="hidden" name="subject_id" :value="selectedSubjectId" required />
                    <input type="hidden" name="max_score" value="100" />
                    <input type="hidden" name="type" value="essay" />
                    <input type="hidden" name="status" value="active" />

                    <div class="px-10 pb-8 space-y-6">

                        {{-- Baris 1: Kelas & Mata Pelajaran --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="modal_kelas" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Kelas
                                </label>
                                <select id="modal_kelas" x-model="selectedClass" @change="onClassChange()"
                                    class="select-premium @error('subject_id') border-rose-500 @enderror" required>
                                    <option value="" disabled selected>Pilih kelas...</option>
                                    <template x-for="c in getUniqueClasses()" :key="c">
                                        <option :value="c" x-text="c"></option>
                                    </template>
                                </select>
                            </div>

                            <div>
                                <label for="modal_mapel" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Mata Pelajaran
                                </label>
                                <select id="modal_mapel" x-model="selectedSubjectName" @change="onSubjectChange()"
                                    class="select-premium @error('subject_id') border-rose-500 @enderror" :disabled="!selectedClass" required>
                                    <option value="" disabled selected>Pilih mata pelajaran...</option>
                                    <template x-for="s in getSubjectsForClass(selectedClass)" :key="s.id">
                                        <option :value="s.course_name" x-html="s.course_name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        @error('subject_id')
                        <p class="text-rose-500 text-xs mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                        @enderror

                        {{-- Baris 2: Judul Tugas --}}
                        <div>
                            <label for="modal_title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Judul Tugas
                            </label>
                            <input type="text" name="title" id="modal_title"
                                value="{{ old('title') }}"
                                placeholder="Masukkan judul tugas"
                                class="input-premium @error('title') border-rose-500 @enderror" required />
                            @error('title')
                            <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Baris 3: Deskripsi Tugas --}}
                        <div>
                            <label for="modal_description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Deskripsi Tugas <span class="text-slate-400 font-normal">(opsional)</span>
                            </label>
                            <textarea name="description" id="modal_description" rows="4"
                                placeholder="Masukkan deskripsi tugas"
                                style="height: 120px;"
                                class="input-premium py-3 resize-none @error('description') border-rose-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Baris 4: Deadline & File Tugas --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="modal_due_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Deadline
                                </label>
                                <input type="datetime-local" name="due_date" id="modal_due_date"
                                    value="{{ old('due_date') }}"
                                    class="input-premium @error('due_date') border-rose-500 @enderror" required />
                                @error('due_date')
                                <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    File Tugas <span class="text-slate-400 font-normal">(opsional)</span>
                                </label>

                                <div
                                    @dragover.prevent="!createFileName && (isDraggingCreate = true)"
                                    @dragleave.prevent="isDraggingCreate = false"
                                    @drop.prevent="isDraggingCreate = false; !createFileName && handleCreateFileDrop($event)"
                                    @click="!createFileName && $refs.createFileInput.click()"
                                    class="dropzone-premium relative transition-all duration-200"
                                    :class="{
                                        'locked border-emerald-500 dark:border-emerald-600 bg-emerald-50/30 dark:bg-emerald-950/20': createFileName,
                                        'border-orange-500 bg-orange-50/30': isDraggingCreate && !createFileName,
                                        'border-slate-300 dark:border-slate-700': !createFileName && !isDraggingCreate
                                    }"
                                    :style="createFileName ? 'border-style: solid !important; cursor: not-allowed !important;' : ''"
                                >
                                    <!-- Clear File Button -->
                                    <template x-if="createFileName">
                                        <button
                                            type="button"
                                            @click.stop="
                                                $refs.createFileInput.value = '';
                                                createFileName = '';
                                            "
                                            class="absolute top-3 right-3 w-8 h-8 rounded-full bg-rose-50 dark:bg-rose-950/50 hover:bg-rose-100 dark:hover:bg-rose-900/50 text-rose-500 dark:text-rose-400 flex items-center justify-center transition-all duration-200 shadow-sm z-10"
                                            title="Hapus File"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </template>

                                    <div class="flex flex-col items-center justify-center text-center">
                                        <div 
                                            class="w-10 h-10 rounded-full flex items-center justify-center mb-2 shadow-sm transition-all duration-300"
                                            :class="createFileName ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'bg-slate-50 dark:bg-slate-800 text-slate-400'"
                                        >
                                            <i class="fas text-lg" :class="createFileName ? 'fa-check-circle text-emerald-500' : 'fa-cloud-upload-alt'"></i>
                                        </div>
                                        <p 
                                            class="text-sm font-semibold transition-colors duration-200 max-w-[90%] truncate"
                                            :class="createFileName ? 'text-emerald-700 dark:text-emerald-400' : 'text-slate-700 dark:text-slate-300'"
                                            x-text="createFileName || 'Klik atau drag file ke sini'"
                                        ></p>
                                        <p 
                                            class="text-[10px] mt-1 transition-colors duration-200"
                                            :class="createFileName ? 'text-emerald-500 font-semibold' : 'text-slate-400'"
                                            x-text="createFileName ? 'File siap diupload' : 'PDF, DOCX, PPTX, ZIP (Maks. 20 MB)'"
                                        ></p>
                                    </div>
                                    <input type="file" name="attachment" x-ref="createFileInput" class="hidden"
                                        accept=".pdf,.doc,.docx,.pptx,.zip"
                                        @change="createFileName = $el.files[0] ? $el.files[0].name : ''" />
                                </div>
                                @error('attachment')
                                <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Modal Footer --}}
                    <div class="flex items-center justify-end gap-3 px-10 py-6 border-t border-slate-100 dark:border-slate-800">
                        <button
                            @click="closeModal()"
                            type="button"
                            class="btn-batal">
                            Batal
                        </button>
                        <button type="submit" class="btn-simpan">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- ================================================================ --}}
    {{-- MODAL: Kirim Tugas (Hanya Siswa)                                 --}}
    {{-- Menggunakan Selective Submission Locking yang sama.              --}}
    {{-- ================================================================ --}}
    @if(auth()->user()->isStudent())
    <div
        x-show="openSubmit"
        x-cloak
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:py-10"
        role="dialog"
        aria-modal="true"
        aria-label="Form Kirim Tugas">

        {{-- Backdrop --}}
        <div
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
            x-show="openSubmit"
            x-transition.opacity
            @click="closeSubmitModal()">
        </div>

        {{-- Modal Panel --}}
        <div
            class="relative w-full max-w-lg"
            x-show="openSubmit"
            x-transition:enter="transition duration-250 ease-out"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            @click.outside="closeSubmitModal()">

            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200/70 dark:border-slate-800/70 overflow-hidden">
                
                {{-- Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center shadow-sm border border-orange-200 dark:border-orange-800/30">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800 dark:text-white">Kirim Tugas</h2>
                            <p class="text-xs text-slate-500 font-medium truncate max-w-[200px] sm:max-w-[250px]" x-text="submitTitle"></p>
                        </div>
                    </div>
                    <button @click="closeSubmitModal()" type="button" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:text-slate-700 transition">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <div class="p-6">
                    {{-- ── KONDISI 1: TERKUNCI ───────────────────────────────── --}}
                    <template x-if="submitLocked">
                        <div class="rounded-2xl border border-rose-200 dark:border-rose-800/50 bg-rose-50 dark:bg-rose-900/10 overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
                            <div class="flex items-center gap-3 px-5 py-4 bg-rose-100/80 dark:bg-rose-900/30 border-b border-rose-200 dark:border-rose-800/40">
                                <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm animate-pulse">
                                    <i class="fas fa-lock text-base"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-rose-800 dark:text-rose-300">Pengumpulan Terkunci</h3>
                                    <p class="text-xs text-rose-600 dark:text-rose-400 mt-0.5 font-medium">
                                        <span x-text="submitTunggakan"></span> tugas belum diselesaikan
                                    </p>
                                </div>
                            </div>
                            <div class="p-5 text-center">
                                <div class="space-y-3">
                                    <p class="text-sm text-rose-700 dark:text-rose-400 leading-relaxed font-medium">
                                        Anda tidak dapat mengumpulkan tugas ini sebelum menyelesaikan tugas yang lewat tenggat waktu.
                                    </p>
                                    <div class="pt-4 border-t border-rose-200/50">
                                        <p class="text-[11px] font-bold text-rose-500 uppercase tracking-wider mb-3">Ajukan Banding Pemulihan</p>
                                        <form action="{{ route('appeals.store') }}" method="POST" class="space-y-3">
                                            @csrf
                                            <input type="hidden" name="subject_id" :value="submitSubjectId">
                                            <textarea name="reason" rows="3" class="w-full rounded-xl border-rose-200 focus:border-rose-500 focus:ring-rose-500/20 text-sm placeholder:text-rose-300" placeholder="Berikan alasan mengapa Anda terlambat (sakit, kendala teknis, dll)..." required></textarea>
                                            <button type="submit" class="w-full btn bg-rose-600 hover:bg-rose-700 text-white shadow-lg shadow-rose-600/20 py-2.5 text-xs font-bold uppercase tracking-widest">
                                                <i class="fas fa-paper-plane mr-2"></i> Kirim Alasan Banding
                                            </button>
                                        </form>
                                    </div>
                                    <button type="button" @click="closeSubmitModal()" class="text-xs text-rose-400 hover:text-rose-600 font-semibold transition py-2">
                                        Mungkin Nanti
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- ── KONDISI 2: TERBUKA (Form Submission) ──────────────── --}}
                    <template x-if="!submitLocked">
                        <div class="modal-inner-content">
                            {{-- State: Already Submitted --}}
                            <div x-show="$root.isSubmitted" x-cloak class="space-y-6 animate-in fade-in zoom-in duration-300">
                                <div class="flex flex-col items-center text-center p-6 bg-emerald-50 dark:bg-emerald-900/10 rounded-3xl border border-emerald-100 dark:border-emerald-800/30">
                                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-3xl flex items-center justify-center mb-4 shadow-lg shadow-emerald-500/20">
                                        <i class="fas fa-check-double text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-emerald-400">Tugas Berhasil Dikumpulkan</h3>
                                    <p class="text-[11px] text-emerald-600 dark:text-emerald-500 mt-1 font-medium" x-text="'Diterima pada ' + ($root.submissionData ? new Date($root.submissionData.submission_date).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute:'2-digit'}) : '')"></p>
                                </div>

                                <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 border border-slate-200 dark:border-slate-800 flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center shrink-0">
                                        <i class="fas text-2xl" :class="getFileIcon($root.submissionData?.original_name)"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="$root.submissionData?.original_name"></p>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider" x-text="formatBytes($root.submissionData?.file_size)"></p>
                                    </div>
                                    <a :href="'/storage/' + $root.submissionData?.file_path" target="_blank" class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center hover:bg-orange-500 hover:text-white transition shadow-sm border border-orange-200 dark:border-orange-800/30">
                                        <i class="fas fa-download text-sm"></i>
                                    </a>
                                </div>

                                <div class="flex items-center gap-3 pt-2">
                                    <button type="button" @click="closeSubmitModal()" class="flex-1 py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition">
                                        Tutup
                                    </button>
                                    <a :href="'/assignments/' + $root.submissionData?.assignment_id" class="flex-1 py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-700 text-white text-sm font-bold text-center hover:bg-slate-800 transition">
                                        Detail Tugas
                                    </a>
                                </div>
                            </div>

                            {{-- State: Not Submitted Yet --}}
                            <form x-show="!$root.isSubmitted" x-ref="submitFormEl" :action="`/assignments/${submitId}/submit`" method="POST" enctype="multipart/form-data" class="space-y-5" @submit.prevent="submitForm">
                                @csrf
                                
                                {{-- Hidden Input --}}
                                <input type="file" name="file" x-ref="fileInput" class="hidden" @change="handleFileSelect" accept=".pdf,.doc,.docx,.zip">

                                {{-- Drag & Drop Area --}}
                                <div 
                                    x-show="!file"
                                    @click="$refs.fileInput.click()"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="isDragging = false; handleFileSelect($event)"
                                    class="relative group cursor-pointer border-2 border-dashed rounded-2xl p-10 text-center transition-all"
                                    :class="isDragging ? 'border-orange-500 bg-orange-50/50 scale-[0.99]' : 'border-slate-200 hover:border-orange-400 bg-slate-50/50'"
                                >
                                    <div class="w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 flex items-center justify-center mx-auto mb-4 shadow-sm group-hover:-translate-y-1 transition duration-300">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-slate-300 group-hover:text-orange-500 transition-colors"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-700 dark:text-white">Klik atau seret file ke sini</h3>
                                    <p class="text-xs text-slate-400 mt-2">PDF, DOCX, ZIP • Maks 10MB</p>
                                </div>

                                {{-- Selected File Preview --}}
                                <div x-show="file" x-cloak class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 flex items-center gap-4 shadow-sm">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-900 flex items-center justify-center shrink-0">
                                        <i class="fas text-2xl" :class="fileInfo.icon"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2">
                                            <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="fileInfo.name"></p>
                                            <button type="button" @click="removeFile()" class="text-slate-400 hover:text-rose-500 transition">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-0.5" x-text="fileInfo.size"></p>
                                    </div>
                                </div>

                                {{-- Progress Indicator (Simple for Standard Form) --}}
                                <div x-show="uploading" x-cloak class="space-y-2">
                                    <div class="flex items-center justify-between text-xs font-bold text-orange-600">
                                        <span>Mengunggah...</span>
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-orange-500 h-1.5 rounded-full animate-progress-indefinite"></div>
                                    </div>
                                </div>

                                {{-- Action Button --}}
                                <button type="submit" 
                                    class="w-full btn btn-primary flex items-center justify-center py-3.5 text-sm font-bold shadow-lg shadow-orange-500/20"
                                    :class="file && !uploading ? 'opacity-100' : 'opacity-50 cursor-not-allowed grayscale'"
                                    :disabled="!file || uploading">
                                    <span x-show="!uploading">
                                        <i class="fas fa-paper-plane mr-2"></i> Kirim Sekarang
                                    </span>
                                    <span x-show="uploading">Memproses...</span>
                                </button>
                            </form>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>{{-- end Alpine root --}}

@push('scripts')
<script>
    /* ── Component assignmentModals() manages both Teacher & Student modals ── */
    function assignmentModals() {
        return {
            // -- Teacher/Admin Create Modal State --
            open: {{ $errors->any() ? 'true' : 'false' }},
            descLen: {{ strlen(old('description', '')) }},
            descContent: @json(old('description', '')),
            attachName: 'Pilih file...',

            // -- Subjects Data --
            subjectsList: [
                @foreach($subjects as $subject)
                {
                    id: {{ $subject->id }},
                    course_name: "{!! addslashes($subject->course->name ?? $subject->nama) !!}",
                    class_name: "{!! addslashes($subject->classRoom->name ?? '') !!}"
                },
                @endforeach
            ],
            selectedClass: '',
            selectedSubjectName: '',
            selectedSubjectId: "{{ old('subject_id', '') }}",
            isDraggingCreate: false,
            createFileName: '',

            getUniqueClasses() {
                const classes = this.subjectsList.map(s => s.class_name).filter(Boolean);
                return [...new Set(classes)].sort();
            },

            getSubjectsForClass(className) {
                if (!className) return [];
                return this.subjectsList.filter(s => s.class_name === className);
            },

            onClassChange() {
                this.selectedSubjectName = '';
                this.selectedSubjectId = '';
            },

            onSubjectChange() {
                const match = this.subjectsList.find(s => s.class_name === this.selectedClass && s.course_name === this.selectedSubjectName);
                this.selectedSubjectId = match ? match.id : '';
            },

            handleCreateFileDrop(e) {
                if (this.createFileName) return;
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    this.$refs.createFileInput.files = files;
                    this.createFileName = files[0].name;
                }
            },

            init() {
                // If subject_id old value exists, restore class and subject name selection
                if (this.selectedSubjectId) {
                    const match = this.subjectsList.find(s => s.id == this.selectedSubjectId);
                    if (match) {
                        this.selectedClass = match.class_name;
                        this.selectedSubjectName = match.course_name;
                    }
                }
            },

            // -- Global Notification State --
            notification: {
                show: false,
                type: 'success', // success, error, info
                message: ''
            },

            showNotification(type, message) {
                this.notification.type = type;
                this.notification.message = message;
                this.notification.show = true;
            },

            // -- Student Submit Modal State --
            openSubmit: false,
            submitId: null,
            submitTitle: '',
            submitLocked: false,
            submitTunggakan: 0,
            submitSubjectId: null,
            isSubmitted: false,
            submissionData: null,
            needsReload: false,
            uploading: false,
            isDragging: false,
            file: null,
            fileInfo: { name: '', size: '', icon: '' },

            openModal() {
                this.open = true;
                document.body.style.overflow = 'hidden';
            },

            closeModal() {
                this.open = false;
                if(!this.openSubmit) document.body.style.overflow = '';
            },

            openSubmitModal(id, title, locked, count, subjectId = null, submission = null) {
                this.submitId = id;
                this.submitTitle = title;
                this.submitLocked = locked;
                this.submitTunggakan = count;
                this.submitSubjectId = subjectId;
                this.isSubmitted = !!submission;
                this.submissionData = submission;
                this.needsReload = false;
                this.uploading = false;
                this.file = null;
                this.fileInfo = { name: '', size: '', icon: '' };
                this.isDragging = false;
                this.openSubmit = true;
                
                document.body.style.overflow = 'hidden';
            },

            handleFileSelect(e) {
                const files = e.target.files || e.dataTransfer.files;
                if (files.length > 0) {
                    const selectedFile = files[0];
                    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/x-zip-compressed'];
                    const maxSize = 10 * 1024 * 1024;
                    
                    if (!allowedTypes.includes(selectedFile.type)) {
                        this.showNotification('error', 'Format file tidak didukung. Gunakan PDF, DOC, DOCX, atau ZIP.');
                        return;
                    }
                    if (selectedFile.size > maxSize) {
                        this.showNotification('error', 'Ukuran file terlalu besar. Maksimal 10MB.');
                        return;
                    }

                    this.file = selectedFile;
                    this.fileInfo = {
                        name: selectedFile.name,
                        size: this.formatBytes(selectedFile.size),
                        icon: this.getFileIcon(selectedFile.name)
                    };
                }
            },

            removeFile() {
                this.file = null;
                this.fileInfo = { name: '', size: '', icon: '' };
                if(this.$refs.fileInput) this.$refs.fileInput.value = '';
            },

            closeSubmitModal() {
                this.openSubmit = false;
                if(!this.open) document.body.style.overflow = '';
                if(this.needsReload) {
                    window.location.reload();
                }
            },

            getFileIcon(filename) {
                if(!filename) return 'fa-file text-slate-400';
                const ext = filename.split('.').pop().toLowerCase();
                if (ext === 'pdf') return 'fa-file-pdf text-rose-500';
                if (['doc', 'docx'].includes(ext)) return 'fa-file-word text-blue-500';
                if (ext === 'zip') return 'fa-file-archive text-amber-500';
                return 'fa-file text-slate-400';
            },

            formatBytes(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            },

            async submitForm(e) {
                // Get file from $refs to be safe as requested
                const selectedFile = this.$refs.fileInput.files[0] || this.file;

                if (!selectedFile || this.uploading) return;

                this.uploading = true;
                const formData = new FormData(this.$refs.submitFormEl);
                
                // Explicitly append/set file from refs or state
                formData.set('file', selectedFile);

                try {
                    const response = await fetch(this.$refs.submitFormEl.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    console.log('Submission response status:', response.status);
                    const result = await response.json();
                    console.log('Submission result:', result);

                    if (response.ok && result.success) {
                        this.isSubmitted = true;
                        this.submissionData = result.submission;
                        this.needsReload = true;

                        // Show success feedback
                        this.showNotification('success', result.message || 'Tugas berhasil dikumpulkan!');
                    } else {
                        // Handle validation errors (422) or other failures
                        let errorMsg = result.message || 'Terjadi kesalahan saat mengunggah.';
                        if (result.errors) {
                            errorMsg = Object.values(result.errors).flat().join('<br>');
                        }
                        this.showNotification('error', errorMsg);
                    }
                } catch (error) {
                    console.error('Upload error:', error);
                    this.showNotification('error', 'Terjadi kesalahan jaringan atau server. Pastikan ukuran file tidak melebihi batas.');
                } finally {
                    this.uploading = false;
                }
            }
        }
    }

    /* ── Google Picker logic removed (replaced by native upload) ── */

    /* ── DataTable ─────────────────────────────────────────────────────── */
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: '<"flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4"<"w-full md:w-auto"B><"w-full md:w-auto"f>>' +
                 '<"flex flex-col md:flex-row justify-between items-center mb-4 gap-4"l>' +
                 'tr' +
                 '<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            buttons: [
                { extend: 'copy',   text: '<i class="fas fa-copy mr-1"></i> Copy',   className: 'dt-button' },
                { extend: 'csv',    text: '<i class="fas fa-file-csv mr-1"></i> CSV', className: 'dt-button' },
                { extend: 'excel',  text: '<i class="fas fa-file-excel mr-1"></i> Excel', className: 'dt-button' },
                { extend: 'pdf',    text: '<i class="fas fa-file-pdf mr-1"></i> PDF', className: 'dt-button' },
                { extend: 'print',  text: '<i class="fas fa-print mr-1"></i> Print',  className: 'dt-button' },
                { extend: 'colvis', text: '<i class="fas fa-columns mr-1"></i> Kolom', className: 'dt-button' }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                search: "",
                searchPlaceholder: "Cari tugas..."
            },
            responsive: true,
            order: [[ 3, "desc" ]]
        });
    });
</script>
@endpush


@endsection