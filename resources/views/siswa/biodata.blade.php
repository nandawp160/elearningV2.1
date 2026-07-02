@extends('layouts.app')

@section('title', $isUpdate ? 'Kenaikan Kelas' : 'Lengkapi Biodata')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">{{ $isUpdate ? 'Kenaikan Kelas' : 'Lengkapi Biodata' }}</h1>
                <p class="page-subtitle">
                    {{ $isUpdate ? 'Perbarui data Anda untuk tahun ajaran baru dan pilih kelas tujuan.' : 'Lengkapi informasi akademik dan data diri agar dapat mengakses materi.' }}
                </p>
            </div>
            <span class="badge badge-info">Profil Siswa</span>
        </div>
        <p class="mt-4 text-sm text-slate-500">Halo, {{ Auth::user()->name }}. Silakan pastikan data Anda sudah benar.</p>
    </div>

    @if (session('info'))
        <div class="glass p-4 border border-sky-100 bg-sky-50/70 text-sky-700 flex items-center gap-3">
            <i class="fas fa-info-circle"></i>
            <span class="text-sm font-semibold">{{ session('info') }}</span>
        </div>
    @endif
    
    @if (session('error'))
        <div class="glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center gap-3">
            <i class="fas fa-exclamation-circle"></i>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
    @endif

    @if (session('success'))
        <div class="glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="glass p-5 border border-amber-100 bg-amber-50/70 text-amber-700">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-triangle-exclamation"></i>
                <p class="text-sm font-semibold uppercase tracking-widest">Periksa Kembali Inputan Anda</p>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('student.biodata.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nis" class="field-label mb-2 block">NIS (Nomor Induk Siswa)</label>
                    <input id="nis" type="text" name="nis" value="{{ old('nis', $student->nis ?? '') }}" required class="input" placeholder="Masukkan NIS Anda" />
                    <x-input-error :messages="$errors->get('nis')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="class_room_id" class="field-label mb-2 block">Pilih Kelas</label>
                    <select id="class_room_id" name="class_room_id" required class="select">
                        <option value="" disabled {{ (old('class_room_id') || ($student && $student->current_class_room)) ? '' : 'selected' }}>Pilih Kelas Anda</option>
                        @foreach($classrooms as $grade => $majors)
                            @foreach($majors as $major => $list)
                                <optgroup label="KELAS {{ $grade }} - {{ $major }}">
                                    @foreach($list as $classroom)
                                        @php
                                            $isSelected = old('class_room_id') == $classroom->id || 
                                                        ($student && $student->current_class_room && $student->current_class_room->id == $classroom->id);
                                        @endphp
                                        <option value="{{ $classroom->id }}" {{ $isSelected ? 'selected' : '' }}>
                                            {{ $classroom->name }} ({{ $classroom->academic_year }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('class_room_id')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="gender" class="field-label mb-2 block">Jenis Kelamin</label>
                    <select id="gender" name="gender" required class="select">
                        <option value="" disabled {{ old('gender', $student->gender ?? '') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender', $student->gender ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $student->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="date_of_birth" class="field-label mb-2 block">Tanggal Lahir</label>
                    <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth', isset($student->date_of_birth) ? $student->date_of_birth->format('Y-m-d') : '') }}" required class="input" />
                    <x-input-error :messages="$errors->get('date_of_birth')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="entry_year" class="field-label mb-2 block">Tahun Masuk</label>
                    <input id="entry_year" type="number" name="entry_year" value="{{ old('entry_year', $student->entry_year ?? date('Y')) }}" required class="input" />
                    <x-input-error :messages="$errors->get('entry_year')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="parent_name" class="field-label mb-2 block">Nama Orang Tua / Wali</label>
                    <input id="parent_name" type="text" name="parent_name" value="{{ old('parent_name', $student->parent_name ?? '') }}" required class="input" placeholder="Nama lengkap orang tua" />
                    <x-input-error :messages="$errors->get('parent_name')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="parent_phone" class="field-label mb-2 block">No. Telepon Orang Tua</label>
                    <input id="parent_phone" type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone ?? '') }}" required class="input" placeholder="Contoh: 081234567890" />
                    <x-input-error :messages="$errors->get('parent_phone')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="parent_email" class="field-label mb-2 block">Email Orang Tua (Opsional)</label>
                    <input id="parent_email" type="email" name="parent_email" value="{{ old('parent_email', $student->parent_email ?? '') }}" class="input" placeholder="email@contoh.com" />
                    <x-input-error :messages="$errors->get('parent_email')" class="text-xs text-rose-600 mt-1" />
                </div>
            </div>

            <div>
                <label for="address" class="field-label mb-2 block">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="4" required class="input" placeholder="Tuliskan alamat lengkap sesuai domisili saat ini">{{ old('address', $student->address ?? '') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="text-xs text-rose-600 mt-1" />
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <p class="text-xs text-slate-500 text-center">Pastikan data yang Anda masukkan sudah valid dan sesuai dokumen resmi sekolah.</p>
</div>
@endsection
