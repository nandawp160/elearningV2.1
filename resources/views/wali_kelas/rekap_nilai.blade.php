@extends('layouts.app')

@section('title', 'Leger Kepatuhan Tugas')

@section('content')
<style>
    /* CSS Kustom untuk Tampilan Cetak Laporan */
    @media print {
        /* Sembunyikan navigasi, sidebar, bar pencarian/filter, tombol, dan footer */
        #sidebar, 
        #sidebar-backdrop, 
        nav.sticky, 
        footer,
        .no-print,
        form,
        button,
        .pagination-footer,
        select {
            display: none !important;
        }

        /* Hilangkan margin/padding luar agar muat di kertas A4 */
        .relative.md\:ml-72 {
            margin-left: 0 !important;
        }
        
        main {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            max-width: 100% !important;
        }
        
        .space-y-6 {
            margin-top: 0 !important;
        }

        /* Force background colors and text colors to display correctly */
        body {
            background: #ffffff !important;
            color: #000000 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Set margin kertas */
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }

        /* Tampilkan kop/header laporan formal */
        .print-report-header {
            display: block !important;
            text-align: center;
            border-bottom: 3px double #475569;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .print-report-header h2 {
            font-size: 20px;
            font-weight: 800;
            text-transform: uppercase;
            color: #000000;
            margin: 0;
        }

        .print-report-header p {
            font-size: 11px;
            color: #334155;
            margin-top: 4px;
        }

        /* Hilangkan bayangan box dan atur border agar tajam di kertas */
        .bg-white {
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
            border-radius: 12px !important;
        }

        tr {
            page-break-inside: avoid !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        th, td {
            border: 1px solid #cbd5e1 !important;
            padding: 8px 6px !important;
            font-size: 9px !important;
        }

        .border-l-2 {
            border-left: 2px solid #94a3b8 !important;
        }
    }

    /* Sembunyikan header laporan formal saat diakses via web browser */
    .print-report-header {
        display: none;
    }
</style>

<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Header Laporan Khusus Cetak -->
    <div class="print-report-header">
        <h2>Laporan Leger Kepatuhan Pengumpulan Tugas Siswa</h2>
        <p class="font-bold text-sm">Kelas {{ $classRoom->name }} — {{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}</p>
        <p class="text-xs text-slate-500 mt-1">Tahun Ajaran: {{ $classRoom->academic_year }} | Cetak oleh: {{ auth()->user()->name }} (Wali Kelas) pada {{ date('d/m/Y H:i') }} WIB</p>
    </div>

    <!-- Breadcrumb & Header -->
    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-2 no-print">
        <span>Laporan Eksekutif</span>
        <span class="text-slate-300 dark:text-slate-700">/</span>
        <span class="text-[#D65A20] font-extrabold">Leger Kepatuhan Tugas</span>
    </div>

    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Leger Kepatuhan Pengumpulan Tugas</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tabel pemantauan rekapitulasi penyelesaian dan akumulasi tunggakan tugas siswa.</p>
        </div>
        
        <div class="flex gap-3 w-full sm:w-auto no-print">
            <!-- Export Excel Button -->
            <a href="{{ route('homeroom.rekap_nilai.export') }}" class="flex-1 sm:flex-initial btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                <i class="fas fa-file-excel text-emerald-600"></i>
                <span>Ekspor Excel</span>
            </a>

            <!-- Print PDF Button -->
            <button onclick="window.print()" class="flex-1 sm:flex-initial bg-white border border-rose-250 hover:bg-rose-50 text-rose-600 font-extrabold px-5 py-2.5 rounded-xl transition flex items-center justify-center gap-2 text-xs dark:bg-slate-950 dark:border-rose-900/50 dark:hover:bg-rose-950/20">
                <i class="far fa-file-pdf text-xs"></i>
                <span>Cetak PDF</span>
            </button>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-4 flex justify-between items-center shadow-sm no-print">
        <form action="{{ route('homeroom.rekap_nilai') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full">
            <div class="relative w-full sm:w-80">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari Nama Siswa atau NIS..." class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2.5 text-xs text-slate-700 bg-white placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-100">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-[11px]"></i>
                </div>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-[#D65A20] hover:bg-[#b54917] text-white text-xs font-bold rounded-xl transition flex items-center gap-2">
                    Cari
                </button>
                @if($search)
                    <a href="{{ route('homeroom.rekap_nilai') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-650 text-xs font-bold rounded-xl flex items-center gap-2 dark:bg-slate-800 dark:hover:bg-slate-750 dark:text-slate-200 transition">
                        <i class="fas fa-times text-xxs"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800/80">
                        <th class="px-6 py-4 text-[11px] font-extrabold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center w-16">NO</th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-left min-w-64">NAMA SISWA</th>
                        @foreach($subjects as $subject)
                        <th class="px-4 py-4 text-[11px] font-extrabold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">
                            {{ strtoupper(substr($subject->course->nama, 0, 10)) }}
                        </th>
                        @endforeach
                        <!-- Vertical Border Separator & Total header -->
                        <th class="px-8 py-4 text-[11px] font-extrabold text-slate-600 dark:text-slate-300 uppercase tracking-wider text-center border-l-2 border-slate-200 dark:border-slate-800 min-w-52">
                            <span class="block">TOTAL TUNGGAKAN</span>
                            <span class="text-[9px] text-slate-400 dark:text-slate-550 block font-bold tracking-widest mt-0.5">AKUMULASI</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                    @forelse($studentsData as $idx => $data)
                    <tr class="hover:bg-slate-50/40 dark:hover:bg-slate-800/20 transition even:bg-slate-50/10 dark:even:bg-slate-900/5">
                        <!-- Number -->
                        <td class="px-6 py-4 text-xs font-semibold text-slate-500 text-center">{{ $idx + 1 }}</td>
                        
                        <!-- Student Profile -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-950 flex items-center justify-center text-slate-600 dark:text-slate-350 font-bold text-xs">
                                    {{ substr($data->student->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800 dark:text-white leading-snug">{{ $data->student->nama }}</p>
                                    <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">{{ $data->student->nis }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Subject Overdue Columns -->
                        @foreach($subjects as $subject)
                            @php
                                $subjectData = $data->tunggakan_per_subject[$subject->id] ?? ['count' => 0, 'has_assignments' => false];
                                $tunggakan = $subjectData['count'];
                                $hasAssignments = $subjectData['has_assignments'];
                            @endphp
                            <td class="px-4 py-4 text-center">
                                @if(!$hasAssignments)
                                    <span class="text-slate-400 dark:text-slate-500 text-xs italic font-medium">Tidak Ada Tugas</span>
                                @elseif($tunggakan === 0)
                                    <span class="text-emerald-500 dark:text-emerald-400 font-extrabold text-xs">Aman</span>
                                @elseif($tunggakan >= 3)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-450 border border-rose-250 dark:border-rose-900/30">
                                        {{ $tunggakan }} Tertunda
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black bg-amber-50 dark:bg-amber-950/20 text-amber-600 dark:text-amber-450 border border-amber-250 dark:border-amber-900/30">
                                        {{ $tunggakan }} Tertunda
                                    </span>
                                @endif
                            </td>
                        @endforeach

                        <!-- Total Overdue Column (Vertical divider) -->
                        <td class="px-8 py-4 text-center border-l-2 border-slate-200 dark:border-slate-800">
                            @if($data->total_lock === 0)
                                <span class="inline-block px-5 py-1.5 rounded-full text-xs font-black bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-450 border border-emerald-300 dark:border-emerald-900/50">
                                    0 Kasus
                                </span>
                            @elseif($data->total_lock >= 3)
                                <span class="inline-block px-5 py-1.5 rounded-full text-xs font-black bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-450 border border-rose-300 dark:border-rose-900/50">
                                    {{ $data->total_lock }} Kasus
                                </span>
                            @else
                                <span class="inline-block px-5 py-1.5 rounded-full text-xs font-black bg-amber-50 dark:bg-amber-950/20 text-amber-600 dark:text-amber-400 border border-amber-300 dark:border-amber-900/50">
                                    {{ $data->total_lock }} Kasus
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ count($subjects) + 3 }}" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500 font-semibold text-sm">
                            Tidak ditemukan siswa dengan kriteria "{{ $search }}" di kelas ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer / Pagination Mockup -->
        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800/80 flex flex-col sm:flex-row justify-between items-center gap-4 pagination-footer no-print">
            <span class="text-xs font-semibold text-slate-550 dark:text-slate-400">
                Menampilkan 1 hingga {{ count($studentsData) }} dari {{ count($studentsData) }} peserta didik
            </span>
            
            <div class="flex items-center gap-1 text-xs">
                <button class="w-8 h-8 rounded-lg border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-450 hover:bg-slate-100 dark:hover:bg-slate-800 transition disabled:opacity-50" disabled>
                    <i class="fas fa-chevron-left text-[10px]"></i>
                </button>
                <button class="w-8 h-8 rounded-lg bg-[#D65A20] text-white font-extrabold flex items-center justify-center">
                    1
                </button>
                <button class="w-8 h-8 rounded-lg border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-450 hover:bg-slate-100 dark:hover:bg-slate-800 transition disabled:opacity-50" disabled>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Bersihkan judul halaman (title) saat mencetak agar tidak muncul di header cetakan browser
    const originalTitle = document.title;
    window.onbeforeprint = function() {
        document.title = "";
    };
    window.onafterprint = function() {
        document.title = originalTitle;
    };
</script>
@endsection
