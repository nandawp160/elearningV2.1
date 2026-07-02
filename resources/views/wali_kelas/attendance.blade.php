@extends('layouts.app')

@section('title', 'Rekap Absensi Kelas')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Rekap Absensi - {{ $classRoom->name }}</h1>
                <p class="page-subtitle">Monitoring kehadiran siswa di seluruh mata pelajaran.</p>
            </div>
            <form action="{{ route('homeroom.attendance') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <select name="month" class="select w-44">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ sprintf('%02d', $m) }}" {{ $month == sprintf('%02d', $m) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <div class="card p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-ui w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">Siswa</th>
                        <th class="px-6 py-4 text-center">Hadir</th>
                        <th class="px-6 py-4 text-center">Sakit</th>
                        <th class="px-6 py-4 text-center">Izin</th>
                        <th class="px-6 py-4 text-center">Alpa</th>
                        <th class="px-6 py-4 text-right">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classRoom->students as $student)
                    @php
                        $attendanceStats = $student->attendances()
                            ->whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->selectRaw('status, count(*) as count')
                            ->groupBy('status')
                            ->pluck('count', 'status');
                        
                        $h = $attendanceStats['Hadir'] ?? 0;
                        $s = $attendanceStats['Sakit'] ?? 0;
                        $i = $attendanceStats['Izin'] ?? 0;
                        $a = $attendanceStats['Alpa'] ?? 0;
                        $total = $h + $s + $i + $a;
                        $percent = $total > 0 ? round(($h / $total) * 100, 1) : 100;
                    @endphp
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-semibold">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-800 dark:text-white">{{ $student->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $student->nis }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center"><span class="badge badge-success">{{ $h }}</span></td>
                        <td class="px-6 py-5 text-center"><span class="badge badge-info">{{ $s }}</span></td>
                        <td class="px-6 py-5 text-center"><span class="badge badge-warning">{{ $i }}</span></td>
                        <td class="px-6 py-5 text-center"><span class="badge {{ $a > 3 ? 'badge-danger' : 'badge-info' }}">{{ $a }}</span></td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <div class="w-20 bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                    <div class="h-full {{ $percent < 80 ? 'bg-rose-500' : 'bg-emerald-500' }}" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200">{{ $percent }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card bg-amber-50/70 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20">
        <div class="flex items-start gap-3">
            <div class="bg-amber-100 dark:bg-amber-500/20 p-2 rounded-xl text-amber-600">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <p class="text-xs text-amber-800/80">
                <span class="font-semibold uppercase tracking-widest mr-2">Info:</span>
                Siswa dengan jumlah <span class="font-semibold">Alpa</span> lebih dari 3 akan ditandai untuk koordinasi dengan orang tua melalui menu <span class="font-semibold">Siswa Saya</span>.
            </p>
        </div>
    </div>
</div>
@endsection
