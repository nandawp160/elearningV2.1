@extends('layouts.app')

@section('title', 'Edit Data Kelas')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Edit Data Kelas</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Perbarui informasi kelas: <span class="font-semibold text-[#D65A20]">{{ $classroom->name }}</span></p>
        </div>
        <a href="{{ route('classrooms.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2.5 rounded-xl text-xs transition flex items-center gap-2 self-start md:self-auto">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 md:p-8">
        <form id="editClassroomForm" action="{{ route('classrooms.update', $classroom) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Baris 1: namaKelas -->
            <div>
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Kelas *</label>
                <input type="text" id="inputNamaKelas" name="namaKelas" value="{{ old('namaKelas', $classroom->name) }}" required placeholder="Contoh: X IPA 1" class="w-full rounded-xl border @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 @enderror bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                @error('name')
                    <p class="text-rose-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Baris 2: tingkat & jurusan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tingkat -->
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tingkat Kelas *</label>
                    <div class="relative">
                        <select name="tingkat" required class="w-full rounded-xl border @error('tingkat') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-[#D65A20] focus:ring-[#D65A20]/20 @enderror bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:ring-2 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="">Pilih Tingkat</option>
                            <option value="X" {{ old('tingkat', $classroom->tingkat) == 'X' ? 'selected' : '' }}>Kelas X</option>
                            <option value="XI" {{ old('tingkat', $classroom->tingkat) == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                            <option value="XII" {{ old('tingkat', $classroom->tingkat) == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                    @error('tingkat')
                        <p class="text-rose-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jurusan -->
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jurusan *</label>
                    <div class="relative">
                        <select name="jurusan" required class="w-full rounded-xl border @error('jurusan') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-[#D65A20] focus:ring-[#D65A20]/20 @enderror bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:ring-2 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="">Pilih Jurusan</option>
                            <option value="IPA" {{ old('jurusan', $classroom->jurusan) == 'IPA' ? 'selected' : '' }}>IPA</option>
                            <option value="IPS" {{ old('jurusan', $classroom->jurusan) == 'IPS' ? 'selected' : '' }}>IPS</option>
                            <option value="Bahasa" {{ old('jurusan', $classroom->jurusan) == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                    @error('jurusan')
                        <p class="text-rose-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Baris 3: waliKelas & tahunAjaran -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Wali Kelas -->
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Wali Kelas (Opsional)</label>
                    <div class="relative">
                        <select id="selectWaliKelas" name="waliKelas" class="w-full rounded-xl border @error('homeroom_teacher_id') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-[#D65A20] focus:ring-[#D65A20]/20 @enderror bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:ring-2 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="">Tidak ada wali kelas</option>
                            @php
                                $teachersList = \App\Models\Guru::active()->orderBy('nama')->get();
                            @endphp
                            @foreach($teachersList as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('waliKelas', $classroom->homeroom_teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }} [{{ $teacher->nip }}]</option>
                            @endforeach
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                    @error('homeroom_teacher_id')
                        <p class="text-rose-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Ajaran -->
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tahun Ajaran *</label>
                    <input type="text" name="tahunAjaran" value="{{ old('tahunAjaran', $classroom->tahunAjaran) }}" required class="w-full rounded-xl border @error('tahunAjaran') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 @enderror bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" placeholder="Contoh: 2025/2026" />
                    @error('tahunAjaran')
                        <p class="text-rose-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Baris 4: kapasitasMaksimal & status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kapasitas Maksimal -->
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kapasitas Maksimal *</label>
                    <input type="number" name="kapasitasMaksimal" value="{{ old('kapasitasMaksimal', $classroom->kapasitasMaksimal) }}" min="1" max="50" required class="w-full rounded-xl border @error('kapasitasMaksimal') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-200 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 @enderror bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                    @error('kapasitasMaksimal')
                        <p class="text-rose-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Kelas</label>
                    <div class="relative">
                        <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Baris 5: keterangan -->
            <div>
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Keterangan</label>
                <textarea name="keterangan" rows="2" placeholder="Keterangan tambahan..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 resize-none"></textarea>
            </div>

            <!-- Footer / Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-5 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('classrooms.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</a>
                <button type="submit" class="btn font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs text-white transition bg-[#D65A20] hover:bg-[#be4e1a]">Perbarui Kelas</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Form parameter mapper
        $('#editClassroomForm').on('submit', function(e) {
            // Map namaKelas -> name
            const nameVal = $('#inputNamaKelas').val();
            // Map waliKelas -> homeroom_teacher_id
            const waliVal = $('#selectWaliKelas').val();

            $(this).append('<input type="hidden" name="name" value="' + nameVal + '">');
            if (waliVal) {
                $(this).append('<input type="hidden" name="homeroom_teacher_id" value="' + waliVal + '">');
            } else {
                $(this).append('<input type="hidden" name="homeroom_teacher_id" value="">');
            }
        });
    });
</script>
@endpush
@endsection
