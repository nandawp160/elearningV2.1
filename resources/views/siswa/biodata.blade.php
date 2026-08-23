@extends('layouts.app')

@section('title', $isUpdate ? 'Perbarui Biodata' : 'Lengkapi Biodata')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">{{ $isUpdate ? 'Perbarui Biodata' : 'Lengkapi Biodata' }}</h1>
                <p class="page-subtitle">
                    {{ $isUpdate ? 'Perbarui dan pastikan data diri Anda sudah sesuai.' : 'Lengkapi informasi akademik dan data diri agar dapat mengakses materi.' }}
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
                    <input id="nis" type="text" name="nis" value="{{ old('nis', $student->nis ?? '') }}" required readonly class="input bg-slate-100 cursor-not-allowed" placeholder="NIS Anda" />
                    <x-input-error :messages="$errors->get('nis')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label class="field-label mb-2 block">Kelas</label>
                    <input type="text" value="{{ $student && $student->resolved_kelas ? $student->resolved_kelas : 'Belum Ditetapkan' }}" readonly class="input bg-slate-100 cursor-not-allowed" />
                </div>

                <div>
                    <label class="field-label mb-2 block">Email Login</label>
                    <input type="text" value="{{ Auth::user()->email }}" readonly class="input bg-slate-100 cursor-not-allowed" />
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

    <!-- Form Ubah Password -->
    <div class="card mt-8">
        <div class="card-header">
            <div>
                <h2 class="page-title text-xl">Ubah Kata Sandi</h2>
                <p class="page-subtitle">Siswa hanya diperbolehkan mengganti kata sandi maksimal 2 kali dalam 30 hari.</p>
            </div>
            
            @if($passwordChangesLeft > 0)
                <span class="badge badge-success">Sisa Kuota: {{ $passwordChangesLeft }} kali</span>
            @else
                <span class="badge badge-danger text-rose-600 bg-rose-100">Batas Tercapai</span>
            @endif
        </div>

        <form method="POST" action="{{ route('student.password.update') }}" class="space-y-6 mt-4">
            @csrf

            <div class="space-y-4 max-w-md">
                <div>
                    <label for="current_password" class="field-label mb-2 block">Kata Sandi Saat Ini</label>
                    <input id="current_password" type="password" name="current_password" required class="input" placeholder="Masukkan kata sandi lama" {{ $passwordChangesLeft == 0 ? 'disabled' : '' }} />
                    <x-input-error :messages="$errors->get('current_password')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="new_password" class="field-label mb-2 block">Kata Sandi Baru</label>
                    <input id="new_password" type="password" name="new_password" required class="input" placeholder="Minimal 8 karakter" {{ $passwordChangesLeft == 0 ? 'disabled' : '' }} />
                    <x-input-error :messages="$errors->get('new_password')" class="text-xs text-rose-600 mt-1" />
                </div>

                <div>
                    <label for="new_password_confirmation" class="field-label mb-2 block">Konfirmasi Kata Sandi Baru</label>
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" required class="input" placeholder="Ulangi kata sandi baru" {{ $passwordChangesLeft == 0 ? 'disabled' : '' }} />
                    <x-input-error :messages="$errors->get('new_password_confirmation')" class="text-xs text-rose-600 mt-1" />
                </div>
            </div>

            <div class="flex">
                <button type="submit" class="btn btn-primary" {{ $passwordChangesLeft == 0 ? 'disabled' : '' }}>
                    <i class="fas fa-key"></i>
                    Perbarui Kata Sandi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
