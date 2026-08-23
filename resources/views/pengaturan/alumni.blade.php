@extends('layouts.app')

@section('title', 'Arsip Alumni - ' . $yearDecoded)

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-800 dark:text-slate-100 flex items-center gap-3">
                <i class="fas fa-user-graduate text-amber-500"></i> 
                Arsip Data Alumni
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Daftar siswa yang telah lulus dan menyelesaikan masa studi pada periode <span class="font-bold">{{ $yearDecoded }}</span>.
            </p>
        </div>
        <div>
            <a href="{{ route('academic-years.index') }}?tab=arsip" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto space-y-6 pb-12">
        <!-- Kartu Ringkasan Alumni -->
        <div class="bg-amber-50 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-900/50 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center shadow-sm border border-amber-100 dark:border-amber-900/50">
                    <i class="fas fa-graduation-cap text-3xl text-amber-500"></i>
                </div>
                <div>
                    <h3 class="text-amber-800 dark:text-amber-400 font-bold text-lg">Tahun Kelulusan {{ $yearDecoded }}</h3>
                    <p class="text-amber-700/80 dark:text-amber-400/80 text-sm mt-0.5">Seluruh data alumni pada halaman ini bersifat read-only.</p>
                </div>
            </div>
            <div class="flex items-center gap-4 text-center md:text-right">
                <div class="bg-white dark:bg-slate-800 px-6 py-3 rounded-xl shadow-sm border border-amber-100 dark:border-amber-900/50">
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Total Lulusan</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-slate-100">{{ count($alumni) }} <span class="text-sm font-medium text-slate-500">Siswa</span></p>
                </div>
            </div>
        </div>

        <!-- Tabel Data Siswa -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-list-ul text-slate-400 mr-2"></i> Daftar Lulusan {{ $yearDecoded }}</h3>
            </div>
            <div class="overflow-x-auto overflow-y-auto max-h-[600px] border border-slate-300 dark:border-slate-600 m-6 rounded-xl relative">
                <table class="w-full text-left border-collapse bg-white dark:bg-slate-900">
                    <thead class="bg-slate-200 dark:bg-slate-700 sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="px-4 py-3 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border-b border-slate-300 dark:border-slate-600 w-16 text-center">No</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border-b border-slate-300 dark:border-slate-600">NIS</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border-b border-slate-300 dark:border-slate-600">Nama Lengkap</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border-b border-slate-300 dark:border-slate-600">L/P</th>
                            <th class="px-4 py-3 text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider border-b border-slate-300 dark:border-slate-600">Kelas Terakhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($alumni as $index => $siswa)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-400 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-mono text-slate-600 dark:text-slate-400">{{ $siswa->nis }}</td>
                            <td class="px-4 py-3 text-sm font-bold text-slate-800 dark:text-slate-200">{{ $siswa->nama }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $siswa->jenis_kelamin === 'Laki-laki' ? 'L' : 'P' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 text-xs font-bold rounded-lg">{{ $siswa->kelas ?? '-' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center">
                                <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-box-open text-2xl text-slate-300 dark:text-slate-600"></i>
                                </div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Tidak ada data alumni untuk tahun ajaran ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
