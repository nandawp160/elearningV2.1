@extends('layouts.app')

@section('title', 'Rekap Nilai Kelas')

@section('content')
<div class="tg-wrapper" style="padding: 24px; background-color: #f8fafc; min-height: 100vh;">
    
    {{-- Breadcrumb / Top --}}
    <div class="flex items-center justify-between text-sm text-slate-500 mb-6 no-print">
        <div class="flex items-center">
            <a href="{{ route('assignments.index') }}" class="hover:text-slate-800 transition">Pengampuan Tugas</a>
            <span class="mx-2">/</span>
            <a href="{{ route('assignments.teacher.detail', ['subject' => $subject->id, 'class_name' => $subject->classRoom ? $subject->classRoom->name : null]) }}" class="hover:text-slate-800 transition">{{ $subject->course->name ?? $subject->nama ?? 'Mapel' }} - {{ $subject->classRoom->name ?? '-' }}</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-slate-800">Rekap Nilai</span>
        </div>
        <a href="{{ route('assignments.teacher.detail', ['subject' => $subject->id, 'class_name' => $subject->classRoom ? $subject->classRoom->name : null]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-[#D65A20] hover:text-[#D65A20] rounded-xl text-[13px] font-bold text-slate-600 transition shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Workspace
        </a>
    </div>

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 no-print">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 mb-1">Rekapitulasi Nilai Tugas</h1>
            <p class="text-sm text-slate-500">Tabel pemantauan nilai tugas dan perhitungan rata-rata per siswa.</p>
        </div>
        <div class="flex items-center gap-3 mt-4 md:mt-0">
            <a href="{{ route('assignments.teacher.rekap.export', ['subject' => $subject->id, 'class_name' => request('class_name')]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-green-500 text-green-600 rounded-lg text-sm font-bold hover:bg-green-50 transition shadow-sm">
                <i class="fas fa-file-excel"></i> Ekspor Excel
            </a>
            <button type="button" onclick="window.print()" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-red-500 text-red-500 rounded-lg text-sm font-bold hover:bg-red-50 transition shadow-sm">
                <i class="fas fa-file-pdf"></i> Cetak PDF
            </button>
        </div>
    </div>

    {{-- Header Laporan Resmi (Kop Sekolah) - Hanya Tampil Saat Print --}}
    <div class="print-only hidden mb-8">
        <div class="flex items-center justify-center border-b-4 border-double border-slate-900 pb-4 mb-6" style="border-bottom-style: double !important; border-bottom-width: 6px !important;">
            <!-- School Logo -->
            <img src="{{ asset('assets/logo/logo.jpeg') }}" alt="Logo" class="w-20 h-20 object-contain mr-6">
            
            <div class="text-center">
                <h2 class="text-lg font-bold uppercase tracking-wider text-slate-900 leading-tight">Pemerintah Provinsi Jawa Tengah</h2>
                <h2 class="text-lg font-bold uppercase tracking-wider text-slate-900 leading-tight">Dinas Pendidikan dan Kebudayaan</h2>
                <h1 class="text-2xl font-black uppercase tracking-widest text-slate-900 mt-1">SMA NEGERI 1 CEPOGO</h1>
                <p class="text-[11px] text-slate-600 mt-1 italic">Kecamatan Kec. Cepogo, Kabupaten Kab. Boyolali, Provinsi Prov. Jawa Tengah</p>
            </div>
        </div>
        
        <h3 class="text-[15px] font-bold text-center uppercase tracking-wide text-slate-900 mb-6">LAPORAN REKAPITULASI NILAI TUGAS</h3>
        
        <div class="grid grid-cols-2 gap-y-2 gap-x-8 text-xs max-w-3xl mx-auto mb-8 border border-slate-300 p-4 rounded-lg bg-slate-50/50">
            <div><span class="font-bold text-slate-700 inline-block w-36">Mata Pelajaran</span>: <span class="text-slate-950">{{ $subject->course->name ?? $subject->nama ?? '-' }}</span></div>
            <div><span class="font-bold text-slate-700 inline-block w-36">Kelas</span>: <span class="text-slate-950">{{ $subject->classRoom->name ?? '-' }}</span></div>
            <div><span class="font-bold text-slate-700 inline-block w-36">Guru Pengampu</span>: <span class="text-slate-950">{{ $subject->teacher->nama ?? $subject->teacher->name ?? '-' }}</span></div>
            <div><span class="font-bold text-slate-700 inline-block w-36">Tahun Ajaran</span>: <span class="text-slate-950">{{ $subject->academic_year ?? '2026/2027' }}</span></div>
        </div>
    </div>

    {{-- Card Table (Excel Style) --}}
    <div class="bg-white shadow-sm border border-slate-300 overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse border border-slate-300">
            <thead class="text-xs text-slate-800 uppercase bg-slate-100 border-b border-slate-300">
                <tr>
                    <th class="px-4 py-3 font-bold text-center w-12 border border-slate-300">NO</th>
                    <th class="px-4 py-3 font-bold text-center min-w-[200px] border border-slate-300">NAMA SISWA</th>
                    @foreach($assignments as $idx => $assignment)
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 bg-slate-50" title="{{ $assignment->title }}">
                            TUGAS {{ $idx + 1 }}
                        </th>
                    @endforeach
                    <th class="px-4 py-3 font-bold text-center border border-slate-300 bg-blue-50 text-blue-900">
                        RATA-RATA NILAI
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $idx => $row)
                    <tr class="hover:bg-yellow-50 transition border-b border-slate-200">
                        <td class="px-4 py-2 text-center text-slate-600 border border-slate-300">{{ $idx + 1 }}</td>
                        <td class="px-4 py-2 font-semibold text-slate-800 border border-slate-300 whitespace-nowrap">{{ $row['student']->nama }}</td>
                        
                        @foreach($assignments as $assignment)
                            <td class="px-4 py-2 text-center border border-slate-300" style="min-width: 80px;">
                                @if(isset($row['grades'][$assignment->id]))
                                    <span class="text-slate-800 font-medium">
                                        {{ $row['grades'][$assignment->id] }}
                                    </span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                        @endforeach
                        
                        <td class="px-4 py-2 text-center border border-slate-300 bg-blue-50/50">
                            @php
                                $avg = $row['average'];
                                $isPass = $avg >= 75; // Assuming KKM is 75
                            @endphp
                            @if($avg !== null)
                                <span class="font-bold {{ $isPass ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $avg }}
                                </span>
                            @else
                                <span class="text-slate-400 font-medium">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($assignments) + 3 }}" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-4xl text-slate-300 mb-3"></i>
                                    <p>Belum ada data nilai tugas untuk kelas ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center text-xs text-slate-500 no-print">
            <span>Menampilkan total {{ count($rekap) }} peserta didik</span>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .no-print, #sidebar, #sidebar-backdrop, nav, header, footer, button, a {
            display: none !important;
        }
        .print-only {
            display: block !important;
        }
        .tg-wrapper {
            padding: 0 !important;
            background-color: white !important;
        }
        .bg-white {
            box-shadow: none !important;
            border: none !important;
        }
        /* Reset layout width and margins for printing */
        .lg\:ml-72 {
            margin-left: 0 !important;
        }
        main {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        th, td {
            border: 1px solid #cbd5e1 !important; /* slate-300 */
            padding: 8px 12px !important;
        }
        th {
            background-color: #f1f5f9 !important; /* slate-100 */
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        /* Retain badge styling in print */
        .bg-red-50 { background-color: #fef2f2 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .bg-green-50 { background-color: #f0fdf4 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .bg-slate-100 { background-color: #f1f5f9 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .text-red-500 { color: #ef4444 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .text-green-600 { color: #16a34a !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .border-red-200 { border-color: #fecaca !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .border-green-200 { border-color: #bbf7d0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>
@endpush
