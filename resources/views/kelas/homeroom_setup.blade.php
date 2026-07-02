@extends('layouts.app')

@section('title', 'Plotting Wali Kelas')

@section('content')
<div class="space-y-6">
    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Plotting Wali Kelas</h1>
                <p class="text-slate-500 text-sm mt-1">Petakan guru-guru aktif untuk menjabat sebagai Wali Kelas pada masing-masing ruang kelas.</p>
            </div>
            <a href="{{ route('classrooms.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700 font-semibold px-4 py-2.5 rounded-xl text-xs transition flex items-center gap-2 self-start md:self-auto">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Kembali ke Data Kelas</span>
            </a>
        </div>
    </div>

    <!-- Alert Information -->
    <div class="p-4 bg-orange-50 border border-orange-100 rounded-xl dark:bg-orange-950/10 dark:border-orange-900/30 flex gap-3">
        <i class="fas fa-info-circle text-[#D65A20] text-lg mt-0.5"></i>
        <div class="text-xs text-orange-800 dark:text-orange-300 leading-relaxed">
            <p class="font-bold text-sm">Panduan Pengaturan:</p>
            <p class="mt-1">Pilih guru dari daftar dropdown untuk setiap kelas yang tersedia. Satu guru hanya direkomendasikan memegang satu kelas perwalian. Klik tombol <b>"Simpan Plotting Wali Kelas"</b> di bagian bawah halaman untuk menerapkan seluruh perubahan secara permanen.</p>
        </div>
    </div>

    <!-- Plotting Form -->
    <form action="{{ route('homeroom-setup.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($classrooms as $index => $classroom)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-xl hover:shadow-md transition p-5 flex flex-col justify-between">
                <!-- Class Info -->
                <div class="space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#D65A20] flex items-center justify-center font-bold">
                                <i class="fas fa-school text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-slate-800 dark:text-white text-base">{{ $classroom->name }}</h3>
                                <p class="text-xs text-slate-400 font-medium">Tingkat {{ $classroom->tingkat }} &bull; {{ $classroom->jurusan }}</p>
                            </div>
                        </div>
                        <span class="text-xxs font-bold px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 rounded-lg">
                            T.A. {{ $classroom->tahunAjaran }}
                        </span>
                    </div>

                    <div class="border-t border-slate-50 dark:border-slate-800 pt-3">
                        <div class="flex justify-between text-xs text-slate-500 mb-1.5">
                            <span>Siswa Terdaftar:</span>
                            <span class="font-bold text-slate-700 dark:text-slate-300">{{ $classroom->siswa_count }} / {{ $classroom->kapasitasMaksimal }} Siswa</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1">
                            @php
                                $percent = ($classroom->kapasitasMaksimal > 0) ? min(100, ($classroom->siswa_count / $classroom->kapasitasMaksimal) * 100) : 0;
                            @endphp
                            <div class="bg-[#D65A20] h-1 rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Teacher Selector -->
                <div class="mt-5 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <label class="block text-xxs font-extrabold text-slate-400 uppercase tracking-wider mb-1.5">Wali Kelas</label>
                    <input type="hidden" name="assignments[{{ $index }}][classroom_id]" value="{{ $classroom->id }}">
                    <div class="relative">
                        <select name="assignments[{{ $index }}][teacher_id]" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                            <option value="" class="text-slate-400 italic">-- Belum Ditentukan --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $classroom->homeroom_teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nama }} (NIP. {{ $teacher->nip }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Submit Button Card -->
        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <span class="text-xs text-slate-500 font-semibold flex items-center gap-1.5">
                <i class="fas fa-check-circle text-[#D65A20] text-sm"></i> 
                <span>Semua perubahan terisi sementara hingga Anda menyimpan formulir.</span>
            </span>
            <button type="submit" class="w-full sm:w-auto bg-[#D65A20] hover:bg-[#be4e1a] text-white font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 transition flex items-center justify-center gap-2 text-xs">
                <i class="fas fa-save text-xs"></i>
                <span>Simpan Plotting Wali Kelas</span>
            </button>
        </div>
    </form>
</div>
@endsection
