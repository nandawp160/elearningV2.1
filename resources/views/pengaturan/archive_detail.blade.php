@extends('layouts.app')

@section('title', ($isActive ? 'Detail Periode - ' : 'Detail Arsip - ') . $yearDecoded)

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100 flex items-center gap-3">
                <i class="fas {{ $isActive ? 'fa-calendar-alt text-emerald-500' : 'fa-archive text-indigo-500' }}"></i> 
                {{ $isActive ? 'Detail Periode' : 'Detail Arsip' }}
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Informasi administratif untuk periode tahun ajaran yang telah berakhir.
            </p>
        </div>
        <div>
            <a href="{{ route('academic-years.index') }}?tab=arsip" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto space-y-6 pb-12">
        <!-- Peringatan / Info -->
        @if($isActive)
        <div class="bg-emerald-50 dark:bg-emerald-500/10 border-l-4 border-emerald-500 rounded-r-xl p-4 md:p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-emerald-800 dark:text-emerald-300 font-bold text-sm">Periode Aktif (Read-Only)</h3>
                    <p class="text-emerald-700/80 dark:text-emerald-400/80 text-xs mt-1 leading-relaxed">
                        Periode tahun ajaran <span class="font-bold">{{ $yearDecoded }}</span> saat ini sedang aktif digunakan untuk operasional LMS. Data yang tampil di sini adalah cerminan dari data yang berjalan saat ini.
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-amber-50 dark:bg-amber-500/10 border-l-4 border-amber-500 rounded-r-xl p-4 md:p-5 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-info-circle text-amber-500 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-amber-800 dark:text-amber-300 font-bold text-sm">Mode Arsip Administrasi (Read-Only)</h3>
                    <p class="text-amber-700/80 dark:text-amber-400/80 text-xs mt-1 leading-relaxed">
                        Periode tahun ajaran <span class="font-bold">{{ $yearDecoded }}</span> telah selesai digunakan. 
                        Data periode ini tetap dipertahankan sebagai arsip administrasi. 
                        Untuk menjaga ruang lingkup dan integritas LMS, sistem hanya menyediakan ringkasan informasi arsip dan tidak mengubah konteks operasional aplikasi.
                    </p>
                </div>
            </div>
        </div>
        @endif


        <!-- Kartu Identitas Periode -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-calendar-check text-slate-400 mr-2"></i> Identitas Periode</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tahun Ajaran</p>
                        <p class="text-xl font-black text-slate-800 dark:text-slate-100">{{ $yearDecoded }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status Sistem</p>
                        @if($isActive)
                            <span class="inline-flex px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-800 dark:text-emerald-400 text-xs font-bold uppercase rounded-lg">Aktif Berjalan</span>
                        @else
                            <span class="inline-flex px-3 py-1 bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 text-xs font-bold uppercase rounded-lg">Arsip Tertutup</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kelas Pertama Dibuat</p>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                            {{ $createdAt ? \Carbon\Carbon::parse($createdAt)->translatedFormat('l, d F Y') : 'Tidak diketahui' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Aktivitas Kelas Terakhir</p>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                            {{ $updatedAt ? \Carbon\Carbon::parse($updatedAt)->translatedFormat('l, d F Y') : 'Tidak diketahui' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Ringkasan Akademik -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-chart-pie text-slate-400 mr-2"></i> Ringkasan Akademik</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl mb-3">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        <p class="text-3xl font-black text-slate-800 dark:text-slate-100 mb-1">{{ number_format($jumlahKelas) }}</p>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jumlah Kelas</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl mb-3">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <p class="text-3xl font-black text-slate-800 dark:text-slate-100 mb-1">{{ number_format($jumlahGuruPengampu) }}</p>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Guru Pengampu</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl mb-3">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <p class="text-3xl font-black text-slate-800 dark:text-slate-100 mb-1">{{ number_format($jumlahWaliKelas) }}</p>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Wali Kelas</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <p class="text-3xl font-black text-slate-800 dark:text-slate-100 mb-1">{{ number_format($jumlahSiswaAktif) }}</p>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Siswa Terdaftar</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-full bg-rose-100 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xl mb-3">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <p class="text-3xl font-black text-slate-800 dark:text-slate-100 mb-1">{{ number_format($jumlahAlumni) }}</p>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alumni Lulus</p>
                    </div>
                </div>
                <!-- Tabel Daftar Kelas & Wali Kelas -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-list-ol text-slate-400 mr-2"></i> Daftar Kelas & Wali Kelas</h3>
            </div>
            <div class="overflow-x-auto overflow-y-auto max-h-[600px] border border-slate-300 dark:border-slate-600 rounded-b-2xl">
                <table class="w-full text-left border-collapse bg-white dark:bg-slate-900">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-slate-200 dark:bg-slate-700">
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600 w-16 text-center">No</th>
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600">Nama Kelas</th>
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600">Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarKelas as $index => $kelas)
                        <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition">
                            <td class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 border border-slate-300 dark:border-slate-600 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-600">{{ $kelas->name }}</td>
                            <td class="px-4 py-2 text-sm text-slate-600 dark:text-slate-400 border border-slate-300 dark:border-slate-600">
                                @if($kelas->homeroomTeacher)
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                            {{ substr($kelas->homeroomTeacher->nama, 0, 1) }}
                                        </div>
                                        <span>{{ $kelas->homeroomTeacher->nama }}</span>
                                    </div>
                                @else
                                    <span class="text-slate-400 italic">Belum ditentukan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-500 text-sm border border-slate-300 dark:border-slate-600">Tidak ada data kelas untuk periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Daftar Guru Pengampu -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-chalkboard-teacher text-slate-400 mr-2"></i> Plotting Pengampuan Guru</h3>
            </div>
            <div class="overflow-x-auto overflow-y-auto max-h-[600px] border border-slate-300 dark:border-slate-600 rounded-b-2xl">
                <table class="w-full text-left border-collapse bg-white dark:bg-slate-900">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-slate-200 dark:bg-slate-700">
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600 w-16 text-center">No</th>
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600">Nama Kelas</th>
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600">Guru Pengampu</th>
                            <th class="px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border border-slate-300 dark:border-slate-600">Mata Pelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarPengampu as $index => $pengampu)
                        <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition">
                            <td class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 border border-slate-300 dark:border-slate-600 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 border border-slate-300 dark:border-slate-600">{{ $pengampu->kelas_nama }}</td>
                            <td class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 border border-slate-300 dark:border-slate-600">{{ $pengampu->guru_nama }}</td>
                            <td class="px-4 py-2 border border-slate-300 dark:border-slate-600">
                                <span class="px-2 py-1 bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-200 text-xs font-bold rounded-md">
                                    {{ $pengampu->mapel_nama ?? 'Umum' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-500 text-sm border border-slate-300 dark:border-slate-600">Tidak ada data plotting pengampuan untuk periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection
