@extends("layouts.app")

@section("title", "Master Kelas")

@section("content")
<!-- Custom Styles for Table, Buttons, and Pagination -->
<style>
    .dataTables_wrapper .dataTables_paginate { display: inline-flex !important; gap: 0.25rem; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border: 1px solid #e2e8f0 !important; background: #ffffff !important; color: #475569 !important; border-radius: 0.5rem !important; padding: 0.4rem 0.75rem !important; font-size: 0.825rem !important; font-weight: 500 !important; transition: all 0.15s ease !important; cursor: pointer !important; margin: 0 !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) { background: #f8fafc !important; border-color: #cbd5e1 !important; color: #1e293b !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover { background: #D65A20 !important; border-color: #D65A20 !important; color: #ffffff !important; font-weight: 600 !important; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active { background: #f8fafc !important; border-color: #e2e8f0 !important; color: #94a3b8 !important; cursor: not-allowed !important; opacity: 0.6 !important; }
    .dataTables_wrapper .dataTables_info { color: #64748b !important; font-size: 0.825rem !important; font-weight: 500 !important; }
    .dt-buttons { display: none !important; }
    
    /* Strict Spreadsheet Styling */
    table.dataTable.spreadsheet-table,
    table.dataTable.spreadsheet-table th,
    table.dataTable.spreadsheet-table td {
        border: 1px solid #94a3b8 !important; /* slate-400 */
        border-collapse: collapse !important;
    }
    html.dark table.dataTable.spreadsheet-table,
    html.dark table.dataTable.spreadsheet-table th,
    html.dark table.dataTable.spreadsheet-table td {
        border: 1px solid #475569 !important; /* slate-600 */
    }
    table.dataTable.spreadsheet-table thead th {
        border-bottom-width: 2px !important;
    }
    
    /* CSS Kustom untuk Tampilan Cetak (Ekspor) */
    @media print {
        #sidebar, #sidebar-backdrop, nav.sticky, footer, .no-print, form, button, .dataTables_wrapper .dataTables_paginate, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_info {
            display: none !important;
        }
        .relative.md\:ml-72 { margin-left: 0 !important; }
        main { padding-top: 0 !important; padding-bottom: 0 !important; max-width: 100% !important; }
        body { background: #ffffff !important; color: #000000 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        @page { size: A4 portrait; margin: 1.5cm; }
        
        .print-report-header { display: block !important; text-align: center; border-bottom: 3px double #475569; padding-bottom: 12px; margin-bottom: 25px; }
        .print-report-header h2 { font-size: 20px; font-weight: 800; text-transform: uppercase; color: #000000; margin: 0; }
        .print-report-header p { font-size: 11px; color: #334155; margin-top: 4px; }
        .bg-white { border: 1px solid #cbd5e1 !important; box-shadow: none !important; border-radius: 12px !important; }
        
        table { width: 100% !important; border-collapse: collapse !important; }
        th { background-color: #cbd5e1 !important; color: #0f172a !important; }
        th, td { border: 1px solid #cbd5e1 !important; padding: 8px 6px !important; font-size: 11px !important; }
        td:last-child, th:last-child { display: none !important; } /* Hide Aksi column on print */
    }
    .print-report-header { display: none; }
</style>

@if(session("success"))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in no-print">
    <div class="flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
        <span class="text-sm font-semibold">{{ session("success") }}</span>
    </div>
    <button onclick="this.parentElement.style.display='none'" class="text-emerald-600 hover:text-emerald-800 transition"><i class="fas fa-times"></i></button>
</div>
@endif
@if(session("error"))
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
    <div class="flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-rose-500 text-lg"></i>
        <span class="text-sm font-semibold">{{ session("error") }}</span>
    </div>
    <button onclick="this.parentElement.style.display='none'" class="text-rose-600 hover:text-rose-800 transition"><i class="fas fa-times"></i></button>
</div>
@endif

<div class="space-y-6">
    <!-- Header Laporan Khusus Cetak -->
    <div class="print-report-header">
        <h2>Laporan Data Master Kelas</h2>
        <p class="font-bold text-sm">{{ \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo') }}</p>
        <p class="text-xs text-slate-500 mt-1">Cetak oleh: {{ auth()->user()->name }} pada {{ date('d/m/Y H:i') }} WIB</p>
    </div>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 no-print">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight flex items-center gap-3">
                <i class="fas fa-sitemap text-[#D65A20]"></i> Master Kelas
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola data dasar kelas yang akan dijadikan acuan untuk Rombel setiap tahun ajaran.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2 no-print">
            <a href="{{ route('master-classes.export') }}" class="btn bg-white text-slate-700 dark:bg-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 font-bold px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2 text-xs">
                <i class="fas fa-file-excel text-emerald-600"></i>
                <span>Ekspor Excel</span>
            </a>
            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole("admin"))
            <button type="button" onclick="openAddModal()" class="btn bg-[#D65A20] text-white hover:bg-[#be4e1a] font-extrabold px-4 py-2.5 rounded-xl shadow-md transition flex items-center gap-2 text-xs">
                <i class="fas fa-plus"></i>
                <span>Tambah Master Kelas</span>
            </button>
            @endif
        </div>
    </div>

    <!-- Summary Card -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="card bg-white dark:bg-slate-900 border-l-4 border-l-[#D65A20] p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Kelas</p>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ $master_classes->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-50 dark:bg-orange-500/10 flex items-center justify-center">
                <i class="fas fa-sitemap text-orange-500 text-lg"></i>
            </div>
        </div>

        <div class="card bg-white dark:bg-slate-900 border-l-4 border-l-blue-500 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Kelas X</p>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ $master_classes->where('grade_level', 'X')->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center">
                <span class="text-blue-500 font-bold text-lg">X</span>
            </div>
        </div>

        <div class="card bg-white dark:bg-slate-900 border-l-4 border-l-emerald-500 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Kelas XI</p>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ $master_classes->where('grade_level', 'XI')->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center">
                <span class="text-emerald-500 font-bold text-lg">XI</span>
            </div>
        </div>

        <div class="card bg-white dark:bg-slate-900 border-l-4 border-l-purple-500 p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Kelas XII</p>
                <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ $master_classes->where('grade_level', 'XII')->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center">
                <span class="text-purple-500 font-bold text-lg">XII</span>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white dark:bg-slate-900 border border-slate-400 dark:border-slate-600 shadow-sm overflow-hidden relative z-10">
        <div class="p-4 border-b border-slate-400 dark:border-slate-600 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-slate-800/50">
            <h2 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <i class="fas fa-table text-slate-400"></i>
                Data Master Kelas
            </h2>
        </div>

        <div class="overflow-x-auto relative p-4">
            <table id="masterClassesTable" class="spreadsheet-table w-full text-left min-w-[800px]">
                <thead>
                    <tr>
                        <th class="px-3 py-2 text-[11px] font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider bg-slate-200 dark:bg-slate-700 w-12 text-center">No</th>
                        <th class="px-3 py-2 text-[11px] font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider bg-slate-200 dark:bg-slate-700">Nama Kelas</th>
                        <th class="px-3 py-2 text-[11px] font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider bg-slate-200 dark:bg-slate-700">Tingkat</th>
                        <th class="px-3 py-2 text-[11px] font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider bg-slate-200 dark:bg-slate-700">Fase / Jurusan</th>
                        <th class="px-3 py-2 text-[11px] font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider bg-slate-200 dark:bg-slate-700 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($master_classes as $index => $masterClass)
                    <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/20 transition-colors group">
                        <td class="px-3 py-2 text-xs text-slate-600 dark:text-slate-400 text-center font-medium">{{ $index + 1 }}</td>
                        <td class="px-3 py-2 text-xs">
                            <span class="text-slate-800 dark:text-slate-200 font-bold">{{ $masterClass->name }}</span>
                        </td>
                        <td class="px-3 py-2 text-xs text-slate-700 dark:text-slate-300 text-center font-medium">
                            {{ $masterClass->grade_level }}
                        </td>
                        <td class="px-3 py-2 text-xs text-slate-700 dark:text-slate-300 font-medium">
                            {{ $masterClass->major ?? "-" }}
                        </td>
                        <td class="px-3 py-1.5 text-center bg-slate-50 dark:bg-slate-800/50">
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole("admin"))
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="openEditModal({{ $masterClass->id }}, '{{ $masterClass->name }}', '{{ $masterClass->grade_level }}', '{{ $masterClass->major }}')" class="text-blue-600 hover:text-blue-800 transition tooltip" data-tippy-content="Edit Kelas">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('master-classes.destroy', $masterClass) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus master kelas ini? Tindakan ini tidak bisa dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 transition tooltip" data-tippy-content="Hapus Kelas">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Master Kelas -->
<div id="masterClassModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-2xl shadow-2xl scale-95 opacity-0 transition-all duration-300 transform" id="panelMasterClass">
        <!-- Header -->
        <div class="flex items-center justify-between p-5 border-b border-slate-100 dark:border-slate-800">
            <div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white" id="modalTitle">Tambah Master Kelas</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Masukkan informasi dasar untuk kelas tersebut.</p>
            </div>
            <button onclick="closeModal()" class="text-slate-400 hover:text-rose-500 transition-colors p-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-500/10">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-6">
            <form id="masterClassForm" action="{{ route('master-classes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="space-y-4">
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Kelas *</label>
                        <input type="text" id="inputNama" name="name" required placeholder="Contoh: X IPA 1" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tingkat *</label>
                            <select id="inputTingkat" name="grade_level" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                                <option value="">Pilih Tingkat</option>
                                <option value="X">Kelas X</option>
                                <option value="XI">Kelas XI</option>
                                <option value="XII">Kelas XII</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Fase / Jurusan *</label>
                            <select id="inputJurusan" name="major" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                                <option value="">Pilih Fase</option>
                                <option value="Fase E">Fase E (Umum - Kelas X)</option>
                                <option value="Fase F">Fase F (Pilihan - Kelas XI & XII)</option>
                                <option value="IPA">IPA (Arsip)</option>
                                <option value="IPS">IPS (Arsip)</option>
                                <option value="Bahasa">Bahasa (Arsip)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold px-5 py-2.5 rounded-xl text-xs transition">Batal</button>
                    <button type="submit" class="btn bg-[#D65A20] text-white hover:bg-[#be4e1a] font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-orange-500/10 text-xs transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script>
    $(document).ready(function() {
        $('#masterClassesTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            pageLength: 25,
            dom: '<"flex flex-col sm:flex-row items-center justify-between gap-4 mb-4"<"flex items-center gap-3"l><"relative w-full sm:w-auto"f>>rt<"flex flex-col sm:flex-row items-center justify-between gap-4 mt-4"ip>',
            initComplete: function() {
                $('.dataTables_filter input').attr('placeholder', 'Cari master kelas...').addClass('w-full sm:w-64 rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2 text-xs text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100');
            }
        });
    });

    const modal = document.getElementById("masterClassModal");
    const panel = document.getElementById("panelMasterClass");
    const form = document.getElementById("masterClassForm");
    
    function openAddModal() {
        document.getElementById("modalTitle").innerText = "Tambah Master Kelas";
        form.action = "{{ route('master-classes.store') }}";
        document.getElementById("formMethod").value = "POST";
        form.reset();
        
        modal.classList.remove("hidden");
        setTimeout(() => { panel.classList.remove("scale-95", "opacity-0"); }, 10);
    }
    
    function openEditModal(id, name, grade, major) {
        document.getElementById("modalTitle").innerText = "Edit Master Kelas";
        form.action = `/master-classes/${id}`;
        document.getElementById("formMethod").value = "PUT";
        
        document.getElementById("inputNama").value = name;
        document.getElementById("inputTingkat").value = grade;
        document.getElementById("inputJurusan").value = major;
        
        modal.classList.remove("hidden");
        setTimeout(() => { panel.classList.remove("scale-95", "opacity-0"); }, 10);
    }

    function closeModal() {
        panel.classList.add("scale-95", "opacity-0");
        setTimeout(() => { modal.classList.add("hidden"); }, 300);
    }
</script>
@endpush

