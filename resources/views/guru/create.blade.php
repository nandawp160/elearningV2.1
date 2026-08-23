@extends('layouts.app')

@section('title', 'Tambah Guru Baru')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Tambah Guru Baru</h1>
                <p class="page-subtitle">Masukkan informasi lengkap untuk tenaga pengajar.</p>
            </div>
            <a href="{{ route('teachers.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('teachers.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nip" class="field-label">Nomor Induk Pegawai (NIP)</label>
                    <input type="text" name="nip" id="nip" value="{{ old('nip') }}" class="input @error('nip') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="198501012010011001" required>
                    @error('nip')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="field-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="input @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="field-label">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="input @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="nama@sekolah.sch.id" required>
                    @error('email')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="field-label">Nomor Telepon/WA</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="input @error('phone') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="08xxxxxxxxxx" required>
                    @error('phone')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="field-label">Mata Pelajaran yang Diajarkan *</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-2 p-4 border border-slate-200 rounded-lg max-h-60 overflow-y-auto">
                        @foreach($courses as $course)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="mata_pelajaran_diajarkan[]" value="{{ $course->id }}" 
                                    class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]"
                                    {{ (is_array(old('mata_pelajaran_diajarkan')) && in_array($course->id, old('mata_pelajaran_diajarkan'))) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-slate-700">{{ $course->nama }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('mata_pelajaran_diajarkan')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="field-label">Tagging Jenjang Kelas (Diizinkan Mengajar)</label>
                    <div class="flex items-center gap-4 mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="allowed_grades[]" value="X" class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]" {{ (is_array(old('allowed_grades')) && in_array('X', old('allowed_grades'))) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-700">Kelas X</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="allowed_grades[]" value="XI" class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]" {{ (is_array(old('allowed_grades')) && in_array('XI', old('allowed_grades'))) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-700">Kelas XI</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="allowed_grades[]" value="XII" class="form-checkbox text-[#D65A20] rounded border-slate-300 focus:ring-[#D65A20]" {{ (is_array(old('allowed_grades')) && in_array('XII', old('allowed_grades'))) ? 'checked' : '' }}>
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
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="tugas_tambahan_jtm" class="field-label">Tugas Tambahan JTM (Jam Tatap Muka) - Opsional</label>
                    <input type="number" name="tugas_tambahan_jtm" id="tugas_tambahan_jtm" value="{{ old('tugas_tambahan_jtm', 0) }}" min="0" class="input @error('tugas_tambahan_jtm') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Misal: 12 (Kepala Lab), 2 (Wali Kelas)">
                    <p class="text-xs text-slate-500 mt-1">Isi dengan angka untuk menambal kekurangan JTM (contoh: Kepala Perpus 12 JTM).</p>
                    @error('tugas_tambahan_jtm')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="address" class="field-label">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" class="input @error('address') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror" placeholder="Masukkan alamat domisili guru">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan Data Guru</button>
            </div>
        </form>
    </div>
</div>
@endsection
