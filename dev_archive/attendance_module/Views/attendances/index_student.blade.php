@extends('layouts.app')

@section('title', 'Riwayat Kehadiran')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Riwayat Kehadiran</h1>
                <p class="page-subtitle">Laporan absensi Anda secara keseluruhan</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="stat-card">
            <div>
                <p class="stat-label">Hadir</p>
                <p class="stat-value text-emerald-600">{{ $attendances->where('status', 'Hadir')->count() }}</p>
            </div>
            <div class="stat-icon bg-emerald-50 text-emerald-600">
                <i class="fas fa-check"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Izin / Sakit</p>
                <p class="stat-value text-amber-600">{{ $attendances->whereIn('status', ['Izin', 'Sakit'])->count() }}</p>
            </div>
            <div class="stat-icon bg-amber-50 text-amber-600">
                <i class="fas fa-notes-medical"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Alpa</p>
                <p class="stat-value text-rose-600">{{ $attendances->where('status', 'Alpa')->count() }}</p>
            </div>
            <div class="stat-icon bg-rose-50 text-rose-600">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <p class="stat-label">Total Sesi</p>
                <p class="stat-value text-slate-700 dark:text-slate-100">{{ $attendances->count() }}</p>
            </div>
            <div class="stat-icon bg-slate-100 text-slate-600">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>

    <div class="card p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-ui w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-left">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                        <td class="px-6 py-5">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $attendance->date->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $attendance->subject->course->name }}</p>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="badge
                                @if($attendance->status == 'Hadir') badge-success
                                @elseif($attendance->status == 'Alpa') badge-danger
                                @else badge-warning @endif">
                                {{ $attendance->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $attendance->notes ?: '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada catatan kehadiran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
