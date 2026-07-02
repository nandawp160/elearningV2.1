@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Tambah Mata Pelajaran</h1>
                <p class="page-subtitle">Buat mata pelajaran baru untuk kurikulum sekolah.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="code" class="field-label">Kode Mata Pelajaran</label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" class="input @error('code') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="MTK-10" required>
                    @error('code')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="field-label">Nama Mata Pelajaran</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="input @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Nama lengkap mata pelajaran" required>
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="grade_level" class="field-label">Tingkat Kelas</label>
                    <select name="grade_level" id="grade_level" class="select @error('grade_level') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                        <option value="X" {{ old('grade_level') == 'X' ? 'selected' : '' }}>Kelas X</option>
                        <option value="XI" {{ old('grade_level') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                        <option value="XII" {{ old('grade_level') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                    </select>
                    @error('grade_level')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="field-label">Status Kurikulum</label>
                    <select name="status" id="status" class="select @error('status') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="beban_jp" class="field-label">Beban Jam Pelajaran (JP / Minggu)</label>
                    <input type="number" name="beban_jp" id="beban_jp" value="{{ old('beban_jp', 4) }}" min="1" max="10" class="input @error('beban_jp') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('beban_jp')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="field-label">Deskripsi Mata Pelajaran</label>
                    <textarea name="description" id="description" rows="3" class="input @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Ringkasan atau silabus singkat">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan Mata Pelajaran</button>
            </div>
        </form>
    </div>
</div>
@endsection
