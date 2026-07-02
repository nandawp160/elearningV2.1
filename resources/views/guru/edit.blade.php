@extends('layouts.app')

@section('title', 'Edit Data Guru')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Edit Data Guru</h1>
                <p class="page-subtitle">Perbarui informasi untuk guru: <span class="font-semibold text-teal-600">{{ $teacher->name }}</span></p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                @if(!$teacher->user)
                <form action="{{ route('teachers.create-user', $teacher) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline" onclick="return confirm('Apakah Anda yakin ingin membuat akun login untuk guru ini? Password default: password')">
                        <i class="fas fa-user-plus"></i>
                        Buat Akun
                    </button>
                </form>
                @else
                <span class="badge badge-success">Akun Aktif</span>
                @endif
                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-secondary">
                    <i class="fas fa-eye"></i>
                    Lihat Detail
                </a>
                <a href="{{ route('teachers.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('teachers.update', $teacher) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nip" class="field-label">Nomor Induk Pegawai (NIP)</label>
                    <input type="text" name="nip" id="nip" value="{{ old('nip', $teacher->nip) }}" class="input @error('nip') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('nip')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="field-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $teacher->name) }}" class="input @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="field-label">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}" class="input @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="field-label">Nomor Telepon/WA</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $teacher->phone) }}" class="input @error('phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                    @error('phone')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="specialization_id" class="field-label">Mata Pelajaran / Spesialisasi *</label>
                    <select name="specialization_id" id="specialization_id" class="select @error('specialization_id') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                        <option value="" disabled>Pilih Spesialisasi...</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('specialization_id', $teacher->specialization_id) == $course->id ? 'selected' : '' }}>{{ $course->nama }}</option>
                        @endforeach
                    </select>
                    @error('specialization_id')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="field-label">Tagging Jenjang Kelas (Diizinkan Mengajar)</label>
                    <div class="flex items-center gap-4 mt-2">
                        @php
                            $allowedGrades = old('allowed_grades', $teacher->allowed_grades ?? []);
                            if (!is_array($allowedGrades)) $allowedGrades = [];
                        @endphp
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="allowed_grades[]" value="X" class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]" {{ in_array('X', $allowedGrades) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-700">Kelas X</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="allowed_grades[]" value="XI" class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]" {{ in_array('XI', $allowedGrades) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-700">Kelas XI</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="allowed_grades[]" value="XII" class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]" {{ in_array('XII', $allowedGrades) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-700">Kelas XII</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika bisa mengajar semua tingkat.</p>
                    @error('allowed_grades')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="field-label">Status Kepegawaian</label>
                    <select name="status" id="status" class="select @error('status') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" required>
                        <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="tugas_tambahan_jtm" class="field-label">Tugas Tambahan JTM (Jam Tatap Muka) - Opsional</label>
                    <input type="number" name="tugas_tambahan_jtm" id="tugas_tambahan_jtm" value="{{ old('tugas_tambahan_jtm', $teacher->tugas_tambahan_jtm ?? 0) }}" min="0" class="input @error('tugas_tambahan_jtm') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Misal: 12 (Kepala Lab), 2 (Wali Kelas)">
                    <p class="text-xs text-slate-500 mt-1">Isi dengan angka untuk menambal kekurangan JTM (contoh: Kepala Perpus 12 JTM).</p>
                    @error('tugas_tambahan_jtm')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="address" class="field-label">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" class="input @error('address') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">{{ old('address', $teacher->address) }}</textarea>
                    @error('address')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="reset" class="btn btn-secondary">Batalkan Perubahan</button>
                <button type="submit" class="btn btn-primary">Perbarui Data Guru</button>
            </div>
        </form>
    </div>
</div>
@endsection
