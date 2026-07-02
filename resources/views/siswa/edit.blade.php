@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Edit Data Siswa</h1>
                <p class="page-subtitle">Perbarui informasi siswa sesuai data terbaru.</p>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('students.update', $student->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Siswa</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="field-label" for="nis">NIS <span class="text-rose-500">*</span></label>
                        <input type="text" name="nis" id="nis" value="{{ old('nis', $student->nis) }}" class="input @error('nis') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                        @error('nis')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="field-label" for="name">Nama Siswa <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="input @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                        @error('name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="field-label" for="kelas">Kelas <span class="text-rose-500">*</span></label>
                        <select name="kelas" id="kelas" required class="input @error('kelas') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                            <option value="">Pilih Kelas</option>
                            <option value="X" {{ old('kelas', $student->kelas) == 'X' ? 'selected' : '' }}>X</option>
                            <option value="XI" {{ old('kelas', $student->kelas) == 'XI' ? 'selected' : '' }}>XI</option>
                            <option value="XII" {{ old('kelas', $student->kelas) == 'XII' ? 'selected' : '' }}>XII</option>
                            @if(!in_array(old('kelas', $student->kelas), ['X', 'XI', 'XII', '']))
                                <option value="{{ old('kelas', $student->kelas) }}" selected>{{ old('kelas', $student->kelas) }} (Diplot)</option>
                            @endif
                        </select>
                        @error('kelas')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Orang Tua/Wali</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="field-label" for="parent_name">Nama Orang Tua/Wali <span class="text-rose-500">*</span></label>
                        <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name', $student->parent_name) }}" class="input @error('parent_name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                        @error('parent_name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="field-label" for="parent_phone">No. HP Orang Tua <span class="text-rose-500">*</span></label>
                        <input type="tel" name="parent_phone" id="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" class="input @error('parent_phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required />
                        @error('parent_phone')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="field-label" for="parent_email">Email Orang Tua</label>
                        <input type="email" name="parent_email" id="parent_email" value="{{ old('parent_email', $student->parent_email) }}" class="input @error('parent_email') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" />
                        @error('parent_email')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="field-label" for="address">Alamat <span class="text-rose-500">*</span></label>
                        <textarea name="address" id="address" rows="4" class="input @error('address') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>{{ old('address', $student->address) }}</textarea>
                        @error('address')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                <label class="field-label">Status <span class="text-rose-500">*</span></label>
                <div class="mt-2 flex items-center gap-6">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                        <input type="radio" name="status" value="active" {{ old('status', $student->status) == 'active' ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500" />
                        Aktif
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                        <input type="radio" name="status" value="inactive" {{ old('status', $student->status) == 'inactive' ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500" />
                        Non-aktif
                    </label>
                </div>
                @error('status')
                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
