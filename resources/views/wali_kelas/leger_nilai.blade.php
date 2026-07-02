@extends('layouts.app')

@section('title', 'Leger Nilai Akademik')

@section('content')
<style>
    /* CSS Kustom untuk Tampilan Cetak Laporan */
    @media print {
        #sidebar, 
        #sidebar-backdrop, 
        nav.sticky, 
        footer,
        .no-print,
        form,
        button,
        .pagination-footer {
            display: none !important;
        }

        .relative.md\:ml-72 { margin-left: 0 !important; }
        main { padding-top: 0 !important; padding-bottom: 0 !important; max-width: 100% !important; }
        
        body {
            background: #ffffff !important;
            color: #000000 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @page {
            size: A4 landscape; /* Karena matriks lebar, gunakan landscape saat cetak */
            margin: 1.5cm;
        }

        .print-report-header {
            display: block !important;
            text-align: center;
            border-bottom: 3px double #475569;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .print-report-header h2 { font-size: 20px; font-weight: 800; text-transform: uppercase; margin: 0; }
        .print-report-header p { font-size: 11px; margin-top: 4px; }

        .bg-white { border: 1px solid #cbd5e1 !important; box-shadow: none !important; border-radius: 12px !important; }
        tr { page-break-inside: avoid !important; }
        table { width: 100% !important; border-collapse: collapse !important; }
        th, td { border: 1px solid #cbd5e1 !important; padding: 6px 4px !important; font-size: 8px !important; }
    }

    .print-report-header { display: none; }
</style>

<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Header Laporan Khusus Cetak -->
    <div class="print-report-header">
        <h2>Laporan Leger Nilai Mentah Siswa</h2>
        <p class="font-bold text-sm">Kelas {{ $classRoom->name }} — {{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}</p>
        <p class="text-xs text-slate-500 mt-1">Tahun Ajaran: {{ $classRoom->academic_year }} | Cetak oleh: {{ auth()->user()->name }} (Wali Kelas) pada {{ date('d/m/Y H:i') }} WIB</p>
    </div>

    <!-- Breadcrumb & Header -->
    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-2 no-print">
        <span>Laporan Eksekutif</span>
        <span class="text-slate-300 dark:text-slate-700">/</span>
        <span class="text-[#D65A20] font-extrabold">Leger Nilai Mentah</span>
    </div>

    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Leger Nilai Mentah</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tabel matriks seluruh nilai murni tugas siswa dari semua mata pelajaran.</p>
        </div>
        
        <div class="flex gap-3 w-full sm:w-auto no-print">
            <button onclick="window.print()" class="flex-1 sm:flex-initial bg-white border border-rose-250 hover:bg-rose-50 text-rose-600 font-extrabold px-5 py-2.5 rounded-xl transition flex items-center justify-center gap-2 text-xs dark:bg-slate-950 dark:border-rose-900/50 dark:hover:bg-rose-950/20">
                <i class="far fa-file-pdf text-xs"></i>
                <span>Cetak PDF</span>
            </button>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-4 flex justify-between items-center shadow-sm no-print">
        <form action="{{ route('homeroom.leger_nilai') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full">
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
                    <a href="{{ route('homeroom.leger_nilai') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-650 text-xs font-bold rounded-xl flex items-center gap-2 dark:bg-slate-800 dark:hover:bg-slate-750 dark:text-slate-200 transition">
                        <i class="fas fa-times text-xxs"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card (Matrix) -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
        @if($totalAssignments === 0)
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-folder-open text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-700 dark:text-slate-300 mb-1">Belum Ada Data Tugas</h3>
                <p class="text-sm text-slate-500 dark:text-slate-500">Guru mata pelajaran belum memberikan tugas apapun di kelas ini.</p>
            </div>
        @else
            <!-- Container khusus scroll -->
            <div class="overflow-x-auto overflow-y-hidden" style="max-width: 100%;">
                <table class="w-full border-collapse whitespace-nowrap min-w-max">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800/80">
                            <th rowspan="2" class="px-4 py-4 text-[11px] font-extrabold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center sticky left-0 bg-slate-50/95 dark:bg-slate-900/95 backdrop-blur-sm z-20 border-r border-slate-200 dark:border-slate-800">NO</th>
                            <th rowspan="2" class="px-6 py-4 text-[11px] font-extrabold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-left sticky left-[52px] bg-slate-50/95 dark:bg-slate-900/95 backdrop-blur-sm z-20 shadow-[4px_0_12px_rgba(0,0,0,0.03)] border-r border-slate-200 dark:border-slate-800">NAMA SISWA</th>
                            
                            @foreach($subjects as $subject)
                                @php $assignmentCount = count($assignmentsBySubject[$subject->id]); @endphp
                                @if($assignmentCount > 0)
                                    <th colspan="{{ $assignmentCount }}" class="px-4 py-3 text-[11px] font-extrabold text-slate-600 dark:text-slate-300 uppercase tracking-wider text-center border-b border-l border-slate-200 dark:border-slate-700">
                                        {{ strtoupper($subject->course->nama) }}
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                        <tr class="bg-slate-50/30 dark:bg-slate-900/30 border-b border-slate-200 dark:border-slate-700">
                            @foreach($subjects as $subject)
                                @foreach($assignmentsBySubject[$subject->id] as $idx => $assignment)
                                    <th class="px-3 py-2 text-[9px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center border-l border-slate-200 dark:border-slate-700" title="{{ $assignment->judul }}">
                                        TGS {{ $idx + 1 }}
                                    </th>
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                        @forelse($students as $idx => $student)
                        <tr class="hover:bg-slate-50/40 dark:hover:bg-slate-800/40 transition even:bg-slate-50/10 dark:even:bg-slate-900/5 group">
                            <!-- Number -->
                            <td class="px-4 py-3 text-xs font-semibold text-slate-500 text-center sticky left-0 bg-white dark:bg-slate-900 group-hover:bg-slate-50/90 dark:group-hover:bg-slate-800 z-10 border-r border-slate-100 dark:border-slate-800 transition-colors">
                                {{ $idx + 1 }}
                            </td>
                            
                            <!-- Student Profile -->
                            <td class="px-6 py-3 sticky left-[52px] bg-white dark:bg-slate-900 group-hover:bg-slate-50/90 dark:group-hover:bg-slate-800 z-10 shadow-[4px_0_12px_rgba(0,0,0,0.03)] border-r border-slate-100 dark:border-slate-800 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-950 flex items-center justify-center text-slate-600 dark:text-slate-350 font-bold text-[10px]">
                                        {{ substr($student->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-white leading-tight">{{ $student->nama }}</p>
                                        <p class="text-[9px] font-semibold text-slate-400 dark:text-slate-500 mt-0.5">{{ $student->nis }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Raw Grades Matrix -->
                            @foreach($subjects as $subject)
                                @foreach($assignmentsBySubject[$subject->id] as $assignment)
                                    @php
                                        $score = $submissionMap[$student->id][$assignment->id] ?? '-';
                                    @endphp
                                    <td class="px-3 py-3 text-center border-l border-slate-100 dark:border-slate-800/80">
                                        @if($score === '-')
                                            <span class="text-slate-300 dark:text-slate-600 text-sm font-light">-</span>
                                        @elseif($score === 'Dinilai...')
                                            <span class="inline-flex items-center justify-center bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 rounded px-1.5 py-0.5 text-[9px] font-bold border border-amber-200 dark:border-amber-800">
                                                <i class="fas fa-clock mr-1 text-[8px]"></i> DINILAI
                                            </span>
                                        @else
                                            @if(is_numeric($score) && $score < 75)
                                                <span class="text-rose-600 dark:text-rose-400 font-extrabold text-sm">{{ $score }}</span>
                                            @elseif(is_numeric($score) && $score >= 85)
                                                <span class="text-emerald-600 dark:text-emerald-400 font-extrabold text-sm">{{ $score }}</span>
                                            @else
                                                <span class="text-amber-600 dark:text-amber-500 font-extrabold text-sm">{{ $score }}</span>
                                            @endif
                                        @endif
                                    </td>
                                @endforeach
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500 font-semibold text-sm">
                                Tidak ditemukan siswa dengan kriteria "{{ $search }}" di kelas ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
        
        <!-- Table Footer / Pagination Mockup -->
        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800/80 flex justify-between items-center no-print">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                <i class="fas fa-info-circle mr-1"></i> Gulir tabel ke kanan untuk melihat tugas lainnya
            </span>
            <span class="text-[11px] font-semibold text-slate-500">
                Total: {{ count($students) }} Siswa
            </span>
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
