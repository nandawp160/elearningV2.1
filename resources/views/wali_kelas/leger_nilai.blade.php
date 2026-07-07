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
            size: A4 portrait; /* Buku style menggunakan portrait */
            margin: 1.5cm;
        }

        .page-break-after {
            page-break-after: always;
        }

        .print-report-header {
            display: block !important;
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .print-report-header h2 { font-size: 18px; font-weight: bold; text-transform: uppercase; margin: 0; color: #000; line-height: 1.2; }
        .print-report-header p { font-size: 12px; margin-top: 4px; color: #000; }

        /* Reset web styles for formal print */
        .bg-white, .subject-table-card { border: none !important; box-shadow: none !important; border-radius: 0 !important; background: transparent !important; margin-bottom: 30px !important; }
        
        /* Fix Table Scrollbars & Height */
        .overflow-x-auto, .overflow-y-auto { overflow: visible !important; max-height: none !important; }
        
        /* Formal Table Styling */
        tr { page-break-inside: avoid !important; }
        table { width: 100% !important; border-collapse: collapse !important; border: 1px solid #000 !important; margin-top: 10px !important; }
        th, td { border: 1px solid #000 !important; padding: 6px 4px !important; font-size: 10px !important; color: #000 !important; background: transparent !important; }
        th { background-color: #f3f4f6 !important; font-weight: bold !important; text-align: center !important; }
        
        /* Subject Header */
        .subject-table-card > div:first-child { border: none !important; padding: 0 !important; background: transparent !important; margin-bottom: 5px !important; }
        .subject-table-card h2 { color: #000 !important; font-size: 14px !important; text-align: left !important; }
        
        /* Hide styling spans if they get in the way */
        .shadow-sm { box-shadow: none !important; }
    }

    .print-report-header { display: none; }
</style>

<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Header Laporan Khusus Cetak -->
    <div class="print-report-header">
        <h2>Laporan Leger Nilai Tugas Siswa</h2>
        <p class="font-bold text-sm">Kelas {{ $classRoom->name }} — {{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}</p>
        <p class="text-xs text-slate-500 mt-1">Tahun Ajaran: {{ $classRoom->academic_year }} | Cetak oleh: {{ auth()->user()->name }} (Wali Kelas) pada {{ date('d/m/Y H:i') }} WIB</p>
    </div>

    <!-- Breadcrumb & Header -->
    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-2 no-print">
        <span>Laporan Eksekutif</span>
        <span class="text-slate-300 dark:text-slate-700">/</span>
        <span class="text-[#D65A20] font-extrabold">Leger Nilai Tugas</span>
    </div>

    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Leger Nilai Tugas</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tabel matriks seluruh nilai murni tugas siswa dari semua mata pelajaran.</p>
        </div>
        
        <div class="flex gap-3 w-full sm:w-auto no-print">
            <!-- Export Excel Button -->
            <a href="{{ route('homeroom.leger_nilai.export') }}" class="flex-1 sm:flex-initial btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
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

    <!-- Table Cards per Subject (Buku Style) -->
    @if(count($subjects) > 0)
    <!-- Subject Tabs Navigation -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-2 mb-6 shadow-sm overflow-x-auto flex gap-2 no-print custom-scrollbar" id="subject-tabs">
        @foreach($subjects as $idx => $subject)
            <button onclick="showSubjectTab('subject-{{ $subject->id }}')" id="btn-subject-{{ $subject->id }}" class="subject-tab-btn px-4 py-2 rounded-lg text-xs font-bold whitespace-nowrap transition-colors {{ $idx === 0 ? 'bg-[#D65A20] text-white shadow-sm' : 'bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-750' }}">
                {{ $subject->course->nama }}
            </button>
        @endforeach
    </div>
    @endif

    @if(count($subjects) === 0)
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden p-12 text-center">
            <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-folder-open text-2xl text-slate-400"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-700 dark:text-slate-300 mb-1">Belum Ada Mata Pelajaran</h3>
            <p class="text-sm text-slate-500 dark:text-slate-500">Tidak ada mata pelajaran yang di-plot untuk kelas ini.</p>
        </div>
    @else
        @foreach($subjects as $idx => $subject)
        <!-- Table Card for specific Subject -->
        <div id="subject-{{ $subject->id }}" class="subject-table-card bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden mb-8 page-break-after {{ $idx !== 0 ? 'hidden print:block' : 'print:block' }}">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                <h2 class="font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide">{{ $subject->course->nama }}</h2>
            </div>
            
            <div class="overflow-x-auto overflow-y-auto" style="max-height: 600px;">
                <table class="w-full border-collapse border border-slate-300 dark:border-slate-700 text-xs min-w-max">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                            <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-center font-bold w-12 shadow-sm">NO</th>
                            <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-left font-bold min-w-64 shadow-sm">NAMA SISWA</th>
                            
                            @php $assignmentCount = count($assignmentsBySubject[$subject->id]); @endphp
                            
                            @if($assignmentCount > 0)
                                @foreach($assignmentsBySubject[$subject->id] as $idx => $assignment)
                                    <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-center font-bold shadow-sm" title="{{ $assignment->judul }}">
                                        TGS {{ $idx + 1 }}
                                    </th>
                                @endforeach
                            @else
                                <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-center font-bold shadow-sm">
                                    BELUM ADA TUGAS
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($students as $idx => $student)
                            <tr class="hover:bg-sky-50 dark:hover:bg-slate-800 transition-colors text-slate-700 dark:text-slate-300">
                                <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5 text-center text-slate-400 bg-slate-50/50 dark:bg-slate-900/50">{{ $idx + 1 }}</td>
                                <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5">
                                    <span class="font-bold text-slate-800 dark:text-white">{{ $student->nama }}</span>
                                    <span class="font-mono text-[10px] font-semibold text-slate-400 dark:text-slate-500 ml-2 block sm:inline">NIS. {{ $student->nis }}</span>
                                </td>
                                
                                @if($assignmentCount > 0)
                                    @foreach($assignmentsBySubject[$subject->id] as $assignment)
                                        @php
                                            $score = $submissionMap[$student->id][$assignment->id] ?? '-';
                                        @endphp
                                        <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5 text-center">
                                            @if($score === '-')
                                                <span class="text-slate-300 dark:text-slate-600 italic">-</span>
                                            @elseif($score === 'Dinilai...')
                                                <span class="text-amber-600 dark:text-amber-500 font-bold text-[10px]">DINILAI</span>
                                            @else
                                                @if(is_numeric($score) && $score < 75)
                                                    <span class="text-rose-600 dark:text-rose-450 font-black">{{ $score }}</span>
                                                @elseif(is_numeric($score) && $score >= 85)
                                                    <span class="text-emerald-600 dark:text-emerald-450 font-black">{{ $score }}</span>
                                                @else
                                                    <span class="text-amber-600 dark:text-amber-450 font-black">{{ $score }}</span>
                                                @endif
                                            @endif
                                        </td>
                                    @endforeach
                                @else
                                    <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5 text-center bg-slate-50/30 dark:bg-slate-900/30">
                                        <span class="text-slate-300 dark:text-slate-600 italic">-</span>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="border border-slate-300 dark:border-slate-700 px-3 py-8 text-center text-slate-400 font-medium">
                                    Tidak ditemukan siswa dengan kriteria "{{ $search }}" di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-3 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800/80 flex justify-end items-center no-print">
                <span class="text-[11px] font-semibold text-slate-500">
                    Total: {{ count($students) }} Siswa
                </span>
            </div>
        </div>
        @endforeach
    @endif
</div>

<script>
    function showSubjectTab(targetId) {
        // Sembunyikan semua tabel
        document.querySelectorAll('.subject-table-card').forEach(card => {
            if (!card.classList.contains('hidden')) {
                card.classList.add('hidden');
            }
        });
        
        // Tampilkan tabel target
        document.getElementById(targetId).classList.remove('hidden');

        // Reset gaya semua tombol
        document.querySelectorAll('.subject-tab-btn').forEach(btn => {
            btn.classList.remove('bg-[#D65A20]', 'text-white', 'shadow-sm');
            btn.classList.add('bg-slate-50', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-400', 'hover:bg-slate-100', 'dark:hover:bg-slate-750');
        });
        
        // Aktifkan tombol yang di-klik
        const activeBtn = document.getElementById('btn-' + targetId);
        activeBtn.classList.remove('bg-slate-50', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-400', 'hover:bg-slate-100', 'dark:hover:bg-slate-750');
        activeBtn.classList.add('bg-[#D65A20]', 'text-white', 'shadow-sm');
    }

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
