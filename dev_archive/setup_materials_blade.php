<?php

$code = <<<EOT
@extends('layouts.app')

@section('title', 'Materi Pelajaran')

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

<div class="space-y-6">
    <div class="card">
        <div class="card-header border-b-0 pb-0">
            <div>
                <h1 class="page-title">Materi Pelajaran</h1>
                <p class="page-subtitle">Kelola dan unggah materi pembelajaran untuk siswa.</p>
            </div>
            @if(auth()->user()->isSuperAdmin() || auth()->user()->isTeacher())
            <a href="{{ route('materials.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Unggah Materi
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
                        <th class="px-6 py-4 text-left w-16">No</th>
                        <th class="px-6 py-4 text-left">Judul Materi</th>
                        <th class="px-6 py-4 text-left">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-left">Tipe</th>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\$materials as \$index => \$material)
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                        <td class="px-6 py-4 text-slate-500 font-medium">{{ \$index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-start gap-3 w-max">
                                @if(\$material->type === 'pdf')
                                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-file-pdf text-xl"></i>
                                    </div>
                                @elseif(\$material->type === 'video')
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-play-circle text-xl"></i>
                                    </div>
                                @elseif(\$material->type === 'document')
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-file-word text-xl"></i>
                                    </div>
                                @elseif(\$material->type === 'link')
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-link text-xl"></i>
                                    </div>
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-file text-xl"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-white max-w-[250px] truncate" title="{{ \$material->title }}">{{ \$material->title }}</h3>
                                    <p class="text-xs text-slate-500 mt-0.5 truncate max-w-[250px]">{{ Str::limit(\$material->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1 items-start w-max">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ \$material->subject->course->name }}</span>
                                <span class="badge badge-info">
                                    Kelas {{ \$material->subject->classRoom->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[11px] font-medium rounded-md tracking-wide uppercase 
                                @if(\$material->type === 'pdf') bg-red-50 text-red-600
                                @elseif(\$material->type === 'video') bg-indigo-50 text-indigo-600
                                @elseif(\$material->type === 'document') bg-blue-50 text-blue-600
                                @elseif(\$material->type === 'link') bg-emerald-50 text-emerald-600
                                @else bg-slate-100 text-slate-600 
                                @endif">
                                {{ \$material->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col text-sm text-slate-600 dark:text-slate-300 w-max">
                                <span>{{ \$material->created_at->format('d M Y') }}</span>
                                <span class="text-xs text-slate-400">Oleh: {{ \$material->uploader->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex items-center justify-center gap-2">
                                <a href="{{ route('materials.show', \$material) }}" class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-800 hover:text-white transition" title="Lihat Materi">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                @if(auth()->user()->isTeacher() || auth()->user()->isSuperAdmin())
                                <a href="{{ route('materials.edit', \$material) }}" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('materials.destroy', \$material) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')" class="inline">
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
                            Belum ada materi pelajaran.
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
                searchPlaceholder: "Cari judul materi..."
            },
            responsive: true,
            order: [[ 4, "desc" ]] // Order by Date default (newest)
        });
    });
</script>
@endpush
@endsection
EOT;

file_put_contents('c:/laragon/www/sistem-e_learningV1/resources/views/materials/index.blade.php', $code);
echo "Berhasil update materials views.";
