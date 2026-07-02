<?php

$code = <<<EOT
@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
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

@if(session('error'))
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <i class="fas fa-exclamation-circle"></i>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Data Kelas</h1>
                <p class="page-subtitle">Manajemen ruang kelas, tingkat, dan jurusan siswa.</p>
            </div>
            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
            <a href="{{ route('classrooms.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Kelas
            </a>
            @endif
        </div>
    </div>

    <!-- DataTables Table Container -->
    <div class="card p-0 overflow-hidden mt-6">
        <div class="overflow-x-auto">
            <table id="dataTable" class="table-ui w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Kelas</th>
                        <th class="px-6 py-4 text-left">Tingkat/Jurusan</th>
                        <th class="px-6 py-4 text-left">Wali Kelas</th>
                        <th class="px-6 py-4 text-left">Kapasitas</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\$classrooms as \$index => \$classroom)
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                        <td class="px-6 py-4 text-slate-500">{{ \$index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-chalkboard-teacher text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-white">{{ \$classroom->name }}</h3>
                                    <p class="text-xs text-slate-500">T.A. {{ \$classroom->academic_year }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1 items-start">
                                <span class="text-xs text-slate-500 font-medium">Tingkat {{ \$classroom->grade_level }}</span>
                                <span class="badge {{ \$classroom->major === 'IPA' ? 'badge-info' : 'badge-warning' }}">
                                    {{ \$classroom->major }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                            @if(\$classroom->homeroomTeacher)
                                {{ \$classroom->homeroomTeacher->name }}
                            @else
                                <span class="text-slate-400 italic font-medium">Belum Ditentukan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1.5 min-w-[120px]">
                                <div class="flex justify-between text-xs font-medium">
                                    <span class="text-slate-500">{{ \$classroom->student_count }} Siswa</span>
                                    <span class="text-slate-400">/ {{ \$classroom->max_students }}</span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                    @php
                                        \$percentage = (\$classroom->max_students > 0) ? min(100, (\$classroom->student_count / \$classroom->max_students) * 100) : 0;
                                        \$colorClass = \$percentage >= 100 ? 'bg-rose-500' : (\$percentage >= 80 ? 'bg-amber-500' : 'bg-emerald-500');
                                    @endphp
                                    <div class="{{ \$colorClass }} h-1.5 rounded-full" style="width: {{ \$percentage }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center justify-center gap-2 w-full">
                                <a href="{{ route('classrooms.show', \$classroom) }}" class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-800 hover:text-white transition" title="Lihat Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                                <a href="{{ route('classrooms.edit', \$classroom) }}" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('classrooms.destroy', \$classroom) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white transition" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                            Belum ada ruang kelas yang ditambahkan.
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                            <div class="mt-4">
                                <a href="{{ route('classrooms.create') }}" class="btn btn-primary">Tambah Kelas Pertama</a>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: '<"flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4"<"w-full md:w-auto"B><"w-full md:w-auto"f>>' +
                 '<"flex flex-col md:flex-row justify-between items-center mb-4 gap-4"l>' + 
                 'tr' +
                 '<"flex flex-col md:flex-row justify-between items-center mt-4 gap-4"ip>',
            buttons: [
                { extend: 'copy', text: '<i class="fas fa-copy mr-1"></i> Copy', className: 'dt-button' },
                { extend: 'csv', text: '<i class="fas fa-file-csv mr-1"></i> CSV', className: 'dt-button' },
                { extend: 'excel', text: '<i class="fas fa-file-excel mr-1"></i> Excel', className: 'dt-button' },
                { extend: 'pdf', text: '<i class="fas fa-file-pdf mr-1"></i> PDF', className: 'dt-button' },
                { extend: 'print', text: '<i class="fas fa-print mr-1"></i> Print', className: 'dt-button' },
                { extend: 'colvis', text: '<i class="fas fa-columns mr-1"></i> Kolom', className: 'dt-button' }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                search: "",
                searchPlaceholder: "Cari data kelas..."
            },
            responsive: true,
            order: [[ 1, "asc" ]] // Order by Kelas name default
        });
    });
</script>
@endpush
@endsection
EOT;

file_put_contents('c:/laragon/www/sistem-e_learningV1/resources/views/classrooms/index.blade.php', $code);
echo "Berhasil update classrooms views.";
