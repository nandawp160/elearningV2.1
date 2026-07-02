@extends('layouts.app')

@section('title', 'Pembagian Mengajar (Plotting Guru)')

@section('content')
<!-- Custom Styles -->
<style>
    /* DataTables Pagination Override */
    .dataTables_wrapper .dataTables_paginate {
        display: inline-flex !important;
        gap: 0.25rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        color: #475569 !important;
        border-radius: 0.5rem !important;
        padding: 0.4rem 0.75rem !important;
        font-size: 0.825rem !important;
        font-weight: 500 !important;
        transition: all 0.15s ease !important;
        cursor: pointer !important;
        margin: 0 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) {
        background: #f8fafc !important;
        border-color: #cbd5e1 !important;
        color: #1e293b !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #D65A20 !important;
        border-color: #D65A20 !important;
        color: #ffffff !important;
        font-weight: 600 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        background: #f8fafc !important;
        border-color: #e2e8f0 !important;
        color: #94a3b8 !important;
        cursor: not-allowed !important;
        opacity: 0.6 !important;
    }
    .dataTables_wrapper .dataTables_info {
        color: #64748b !important;
        font-size: 0.825rem !important;
        font-weight: 500 !important;
    }
    .dt-buttons {
        display: none !important;
    }
    
    .btn-orange-solid {
        background-color: #D65A20 !important;
        color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-solid:hover {
        background-color: #be4e1a !important;
    }
    .btn-orange-outline {
        border: 1px solid #D65A20 !important;
        color: #D65A20 !important;
        background-color: #ffffff !important;
        transition: all 0.15s ease;
    }
    .btn-orange-outline:hover {
        background-color: rgba(214, 90, 32, 0.05) !important;
    }
</style>

<!-- Toast Notification -->
@if(session('success'))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-2xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-emerald-700/70 hover:text-emerald-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('error'))
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-2xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Pembagian Mengajar</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola plotting (pemetaan) Guru, Kelas, dan Mata Pelajaran secara manual maupun otomatis.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button type="button" onclick="document.getElementById('autoPlotModal').classList.remove('hidden')" class="btn-orange-outline font-bold px-4 py-2.5 rounded-xl shadow-sm text-sm flex items-center gap-2">
                <i class="fas fa-magic"></i> Auto-Plot Otomatis
            </button>
        </div>
    </div>

    <!-- Plotting Form Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4"><i class="fas fa-user-plus text-[#D65A20] mr-2"></i>Tambah Plotting Manual</h2>
        <form action="{{ route('teaching-assignments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @csrf
            
            <!-- Select Guru -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Guru <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select name="guru_id" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }} {{ $guru->spesialisasi ? '(' . $guru->spesialisasi . ')' : '' }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <!-- Select Kelas -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Kelas <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select name="kelas_id" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <!-- Select Mata Pelajaran -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Mata Pelajaran <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select name="mata_pelajaran_id" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($subjects as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn-orange-solid font-bold px-4 py-2.5 rounded-xl shadow-sm w-full flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Plotting
                </button>
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        
        <!-- Table Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white"><i class="fas fa-list-ul text-[#D65A20] mr-2"></i>Daftar Plotting Mengajar</h2>
            
            <div class="relative w-full sm:w-72">
                <input type="text" id="customSearchInput" placeholder="Cari plotting..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-xs"></i>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700">
            <table id="plottingTable" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16">No</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Guru</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($plottings as $plot)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                        <td class="py-3 px-4 text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $plot->guru->nama ?? '-' }}</td>
                        <td class="py-3 px-4 text-sm text-slate-600 dark:text-slate-300"><span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded text-xs font-semibold">{{ $plot->kelas->name ?? '-' }}</span></td>
                        <td class="py-3 px-4 text-sm text-slate-600 dark:text-slate-300">{{ $plot->subject->nama ?? '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('teaching-assignments.destroy', $plot->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus plotting mengajar ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 dark:bg-rose-900/30 dark:hover:bg-rose-900/50 flex items-center justify-center transition tooltip" data-tip="Hapus Plotting">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-500 dark:text-slate-400 text-sm">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl mb-3 text-slate-300 dark:text-slate-600"></i>
                                <p>Belum ada data plotting mengajar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Auto Plot Modal (Integrated with GuruController) -->
<div id="autoPlotModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm animate-fade-in" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="document.getElementById('autoPlotModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-slate-100 dark:border-slate-800">
            <div class="bg-white dark:bg-slate-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 relative">
                <!-- Close Button -->
                <button type="button" onclick="document.getElementById('autoPlotModal').classList.add('hidden')" class="absolute top-4 right-4 text-slate-400 hover:text-slate-500 transition">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 text-[#D65A20] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-magic text-lg"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-bold text-slate-900 dark:text-white" id="modal-title">
                            Auto-Plot Mengajar Guru
                        </h3>
                        <div class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                            <p>Sistem akan memetakan guru ke kelas secara otomatis berdasarkan spesialisasi, batas maksimal JTM per minggu, dan ketersediaan guru.</p>
                            <div class="p-3 bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 rounded-xl mt-3 text-amber-800 dark:text-amber-500">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                <strong>Peringatan:</strong> Proses ini akan <b>MENGHAPUS</b> plotting lama pada tahun ajaran target yang dipilih!
                            </div>
                        </div>

                        <form id="autoPlotForm" action="{{ route('teachers.auto-plot') }}" method="POST" class="mt-5 space-y-4">
                            @csrf
                            <div>
                                <label for="tahun_ajaran" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Target Tahun Ajaran</label>
                                <div class="relative">
                                    <select name="tahun_ajaran" id="tahun_ajaran" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                                        @foreach($availableYears as $year)
                                            <option value="{{ $year }}" {{ $year === $activeYear ? 'selected' : '' }}>
                                                {{ $year }} {{ $year === $activeYear ? '(Aktif)' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <i class="fas fa-chevron-down text-[10px]"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 dark:bg-slate-800/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('autoPlotForm').submit()" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-[#D65A20] hover:bg-[#be4e1a] text-base font-semibold text-white focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition">
                    Jalankan Auto-Plot
                </button>
                <button type="button" onclick="document.getElementById('autoPlotModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS for Sorting and Pagination -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#plottingTable').DataTable({
            responsive: true,
            pageLength: 20,
            lengthChange: false,
            ordering: true,
            info: true,
            dom: '<"top"i>rt<"bottom"p><"clear">',
            language: {
                search: "",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ plotting",
                infoEmpty: "Menampilkan 0 hingga 0 dari 0 plotting",
                infoFiltered: "(disaring dari total _MAX_ plotting)",
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                },
                emptyTable: "Tidak ada data plotting tersedia",
                zeroRecords: "Tidak ada plotting yang cocok dengan pencarian"
            }
        });

        // Custom Search Input
        $('#customSearchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endpush
@endsection
