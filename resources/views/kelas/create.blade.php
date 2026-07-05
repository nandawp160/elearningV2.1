@extends('layouts.app')

@section('title', 'Tambah Kelas Baru')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Tambah Kelas Baru</h1>
                <p class="page-subtitle">Daftarkan ruang kelas baru beserta wali kelas.</p>
            </div>
            <a href="{{ route('classrooms.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('classrooms.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="field-label">Nama Kelas</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Contoh: X IPA 1" required>
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label">Tingkat</label>
                    <select name="grade_level" class="select @error('grade_level') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                        <option value="">Pilih Tingkat</option>
                        <option value="X" {{ old('grade_level') == 'X' ? 'selected' : '' }}>Kelas X</option>
                        <option value="XI" {{ old('grade_level') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                        <option value="XII" {{ old('grade_level') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                    </select>
                    @error('grade_level') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label">Fase Kurikulum</label>
                    <select name="jurusan" class="select @error('jurusan') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                        <option value="">Pilih Fase</option>
                        <option value="Fase E" {{ old('jurusan') == 'Fase E' ? 'selected' : '' }}>Fase E (Umum - Kelas X)</option>
                        <option value="Fase F" {{ old('jurusan') == 'Fase F' ? 'selected' : '' }}>Fase F (Pilihan - Kelas XI & XII)</option>
                    </select>
                    @error('jurusan') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="field-label">Wali Kelas (Opsional)</label>
                    <select name="homeroom_teacher_id" class="select @error('homeroom_teacher_id') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                        <option value="">Tidak ada wali kelas</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('homeroom_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }} [{{ $teacher->nip }}]
                            </option>
                        @endforeach
                    </select>
                    @error('homeroom_teacher_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label">Tahun Ajaran</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', '2025/2026') }}" class="input @error('academic_year') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('academic_year') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="field-label">Kapasitas Maksimal</label>
                    <input type="number" name="max_students" value="{{ old('max_students', 36) }}" min="1" max="50" class="input @error('max_students') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('max_students') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Daftarkan Kelas</button>
            </div>
        </form>
    </div>
</div>
@endsection
