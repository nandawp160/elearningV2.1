@extends('layouts.app')

@section('title', 'Grafik Akademik')

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
        button,
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
            margin-bottom: 30px;
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

        /* Atur grid agar tetap 2 kolom di kertas cetak */
        .grid-cols-1.lg\:grid-cols-2 {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 20px !important;
        }

        /* Hilangkan bayangan box dan atur border agar tajam di kertas */
        .bg-white {
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
            page-break-inside: avoid !important;
            border-radius: 12px !important;
            padding: 20px !important;
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
        <h2>Laporan Analitik & Grafik Akademik</h2>
        <p class="font-bold text-sm">Kelas {{ $classRoom->name }} — {{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}</p>
        <p class="text-xs text-slate-500 mt-1">Tahun Ajaran: {{ $classRoom->academic_year }} | Cetak oleh: {{ auth()->user()->name }} (Wali Kelas) pada {{ date('d/m/Y H:i') }} WIB</p>
    </div>

    <!-- Breadcrumb & Header -->
    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-2 no-print">
        <span>Laporan Eksekutif</span>
        <span class="text-slate-300 dark:text-slate-700">/</span>
        <span class="text-[#D65A20] font-extrabold">Grafik Akademik</span>
    </div>

    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 no-print">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Analitik & Grafik Akademik</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Visualisasi data tingkat kedisiplinan dan capaian rata-rata nilai kelas {{ $classRoom->name }}.</p>
            </div>
        </div>
    </div>

    <!-- Filters & Actions Action Bar -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-4 flex flex-col lg:flex-row justify-between items-center gap-4 shadow-sm no-print" id="actionBar">
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <!-- Semester Select -->
            <div class="relative w-full sm:w-48">
                <select class="w-full rounded-xl border border-slate-200 pl-4 pr-10 py-2.5 text-xs text-slate-650 bg-white appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-100 cursor-pointer">
                    <option value="genap2026">Smt. Genap (2026)</option>
                    <option value="ganjil2025">Smt. Ganjil (2025)</option>
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <i class="fas fa-chevron-down text-[10px]"></i>
                </div>
            </div>

            <!-- Subject Select -->
            <div class="relative w-full sm:w-56">
                <select class="w-full rounded-xl border border-slate-200 pl-4 pr-10 py-2.5 text-xs text-slate-650 bg-white appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-100 cursor-pointer">
                    <option value="">Semua Matpel</option>
                    @foreach($subjects as $subj)
                        <option value="{{ $subj->id }}">{{ $subj->course->nama }}</option>
                    @endforeach
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <i class="fas fa-chevron-down text-[10px]"></i>
                </div>
            </div>
        </div>

        <div class="flex gap-3 w-full lg:w-auto">
            <!-- Download Excel Button -->
            <a href="{{ route('homeroom.academic_chart.export') }}" class="flex-1 sm:flex-initial btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                <i class="fas fa-file-excel text-emerald-600"></i>
                <span>Unduh Excel</span>
            </a>

            <!-- Print PDF Button -->
            <button onclick="window.print()" class="flex-1 sm:flex-initial bg-white border border-rose-250 hover:bg-rose-50 text-rose-600 font-extrabold px-5 py-2.5 rounded-xl transition flex items-center justify-center gap-2 text-xs dark:bg-slate-950 dark:border-rose-900/50 dark:hover:bg-rose-950/20">
                <i class="far fa-file-pdf text-xs"></i>
                <span>Cetak PDF</span>
            </button>
        </div>
    </div>

    <!-- Charts Row 1: Donut & Combo Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Populasi Zona Kedisiplinan -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div class="mb-4">
                <h3 class="text-base font-extrabold text-slate-800 dark:text-white tracking-tight">Populasi Zona Kedisiplinan</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Berdasarkan frekuensi keterlambatan</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-6 py-4 flex-1 justify-center">
                <!-- Donut Chart with Centered Number -->
                <div class="relative w-36 h-36 flex-shrink-0">
                    <canvas id="donutChartCanvas"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-3xl font-black text-slate-800 dark:text-white leading-none">{{ $totalStudents }}</span>
                        <span class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1">Siswa</span>
                    </div>
                </div>

                <!-- Custom Legend List -->
                <div class="space-y-4 min-w-0 flex-1 w-full sm:w-auto">
                    <!-- Aman -->
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 mt-1 flex-shrink-0"></span>
                        <div>
                            <span class="text-xs font-black text-slate-800 dark:text-white block">Aman ({{ $percentAman }}%)</span>
                            <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">0-1 Keterlambatan</span>
                        </div>
                    </div>

                    <!-- Rawan -->
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-amber-500 mt-1 flex-shrink-0"></span>
                        <div>
                            <span class="text-xs font-black text-slate-800 dark:text-white block">Rawan ({{ $percentRawan }}%)</span>
                            <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">2-3 Keterlambatan</span>
                        </div>
                    </div>

                    <!-- Terkunci -->
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-rose-500 mt-1 flex-shrink-0"></span>
                        <div>
                            <span class="text-xs font-black text-slate-800 dark:text-white block">Terkunci ({{ $percentTerkunci }}%)</span>
                            <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">&gt;3 ({{ $countTerkunci }} Siswa)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Korelasi Nilai vs Pelanggaran -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-base font-extrabold text-slate-800 dark:text-white tracking-tight">Korelasi Nilai vs Pelanggaran</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5 font-medium">Rata-rata Nilai (Garis) & Kasus (Batang)</p>
            </div>

            <div class="relative flex-1 py-4 h-48 sm:h-56">
                <canvas id="comboChartCanvas"></canvas>
            </div>

            <div class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 italic text-left pt-2 border-t border-slate-50 dark:border-slate-800/80">
                *Semakin tinggi bar merah (kasus), nilai rata-rata menurun.
            </div>
        </div>
    </div>

    <!-- Charts Row 2: Full Width Grouped Bar Chart -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="text-base font-extrabold text-slate-800 dark:text-white tracking-tight">Tren Status Pengumpulan Tugas (Historis)</h3>
                <p class="text-xs text-slate-400 font-semibold mt-0.5">Perbandingan persentase Tepat Waktu, Dispensasi, dan Terkunci.</p>
            </div>

            <!-- Grouped Legend -->
            <div class="flex flex-wrap items-center gap-4 text-xxs font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded bg-emerald-500"></span>
                    <span>Tepat Waktu</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded bg-amber-500"></span>
                    <span>Dispensasi</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded bg-rose-500"></span>
                    <span>Terkunci</span>
                </div>
            </div>
        </div>

        <div class="relative h-64 sm:h-72">
            <canvas id="groupedBarChartCanvas"></canvas>
        </div>
    </div>
</div>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // Bersihkan judul halaman (title) saat mencetak agar tidak muncul di header cetakan browser
    const originalTitle = document.title;
    window.onbeforeprint = function() {
        document.title = "";
    };
    window.onafterprint = function() {
        document.title = originalTitle;
    };

    // Chart.js Configuration
    document.addEventListener("DOMContentLoaded", function() {
        const isDark = document.documentElement.classList.contains('dark') || document.body.classList.contains('dark');
        const gridColor = isDark ? '#1e293b' : '#f1f5f9';
        const labelColor = isDark ? '#94a3b8' : '#64748b';

        // 1. Donut Chart (Populasi Zona Kedisiplinan)
        const donutCtx = document.getElementById('donutChartCanvas').getContext('2d');
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Aman', 'Rawan', 'Terkunci'],
                datasets: [{
                    data: [{{ $percentAman }}, {{ $percentRawan }}, {{ $percentTerkunci }}],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: isDark ? 2 : 1,
                    borderColor: isDark ? '#0f172a' : '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                }
            }
        });

        // 2. Combo Chart (Korelasi Nilai vs Pelanggaran)
        const comboCtx = document.getElementById('comboChartCanvas').getContext('2d');
        new Chart(comboCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [
                    {
                        type: 'line',
                        label: 'Rata-rata Nilai',
                        data: {!! json_encode($averageGrades) !!},
                        borderColor: '#3b82f6',
                        borderWidth: 3,
                        pointBackgroundColor: '#3b82f6',
                        pointHoverRadius: 6,
                        fill: false,
                        yAxisID: 'yNilai'
                    },
                    {
                        type: 'bar',
                        label: 'Kasus Terkunci',
                        data: {!! json_encode($lockCases) !!},
                        backgroundColor: isDark ? 'rgba(239, 68, 68, 0.4)' : 'rgba(239, 68, 68, 0.15)',
                        borderColor: '#ef4444',
                        borderWidth: 1.5,
                        borderRadius: 6,
                        yAxisID: 'yKasus'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: labelColor, font: { family: 'Plus Jakarta Sans', size: 10, weight: 'bold' } }
                    },
                    yNilai: {
                        position: 'left',
                        min: 70,
                        max: 95,
                        grid: { color: gridColor },
                        ticks: { color: labelColor, stepSize: 5, font: { family: 'Plus Jakarta Sans', size: 10 } }
                    },
                    yKasus: {
                        position: 'right',
                        min: 0,
                        max: 60,
                        grid: { display: false },
                        ticks: { color: labelColor, stepSize: 15, font: { family: 'Plus Jakarta Sans', size: 10 } }
                    }
                }
            }
        });

        // 3. Grouped Bar Chart (Tren Status Pengumpulan Historis)
        const groupedCtx = document.getElementById('groupedBarChartCanvas').getContext('2d');
        new Chart(groupedCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [
                    {
                        label: 'Tepat Waktu',
                        data: {!! json_encode($onTimeRates) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 6
                    },
                    {
                        label: 'Dispensasi',
                        data: {!! json_encode($recoveryRates) !!},
                        backgroundColor: '#f59e0b',
                        borderRadius: 6
                    },
                    {
                        label: 'Terkunci',
                        data: {!! json_encode($lockedRates) !!},
                        backgroundColor: '#ef4444',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: labelColor, font: { family: 'Plus Jakarta Sans', size: 11, weight: 'bold' } }
                    },
                    y: {
                        min: 0,
                        max: 100,
                        grid: { color: gridColor },
                        ticks: {
                            color: labelColor,
                            stepSize: 25,
                            font: { family: 'Plus Jakarta Sans', size: 10 },
                            callback: function(value) { return value + '%'; }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
