@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header border-b-0 pb-0">
            <div>
                <h1 class="page-title">Data Nilai Siswa</h1>
                <p class="page-subtitle">Monitoring hasil evaluasi dan pencapaian akademik.</p>
            </div>

        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <div class="card p-0 overflow-hidden mt-6">
        <div class="overflow-x-auto">
            <table id="gradesTable" class="table-ui w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Siswa</th>
                        <th class="px-6 py-4 text-left">Pelajaran & Kelas</th>
                        <th class="px-6 py-4 text-left">Tipe Penilaian</th>
                        <th class="px-6 py-4 text-left">Nilai Angka</th>
                        <th class="px-6 py-4 text-left">Predikat</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades as $index => $grade)
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                        <td class="px-6 py-4 text-slate-500 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($grade->student->name) }}&background=0f766e&color=fff&bold=true&rounded=true" class="w-10 h-10 rounded-xl" alt="Avatar">
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-white">{{ $grade->student->name }}</h3>
                                    <p class="text-xs text-slate-500">{{ $grade->student->nis }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1 items-start">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $grade->subject->course->name }}</span>
                                <span class="badge badge-info">Kelas {{ $grade->subject->classRoom->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-50 text-indigo-600 px-2.5 py-1 text-[11px] font-medium rounded-md tracking-wide uppercase">
                                {{ $grade->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-lg {{ $grade->score < 75 ? 'text-rose-500' : 'text-emerald-600' }}">
                                {{ $grade->score }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $score = $grade->score;
                                $badgeColor = $score >= 90 ? 'badge-success' : ($score >= 80 ? 'badge-info' : ($score >= 75 ? 'badge-warning' : 'badge-danger'));
                                $gradeLetter = $score >= 90 ? 'A (Sangat Baik)' : ($score >= 80 ? 'B (Baik)' : ($score >= 75 ? 'C (Cukup)' : 'D (Kurang)'));
                            @endphp
                            <span class="badge {{ $badgeColor }}">{{ $gradeLetter }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center justify-center gap-2">
                                <a href="{{ route('grades.show', $grade) }}" class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-800 hover:text-white transition" title="Lihat Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Ensure we don't have multiple initializations
        if ($.fn.DataTable.isDataTable('#gradesTable')) {
            $('#gradesTable').DataTable().destroy();
        }

        setTimeout(function() {
            $('#gradesTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                    search: "",
                    searchPlaceholder: "Cari daftar nilai..."
                },
                order: [[ 1, "asc" ]],
                responsive: false // Disable responsive temporarily for stability
            });
        }, 100);
    });
</script>
@endpush
@endsection