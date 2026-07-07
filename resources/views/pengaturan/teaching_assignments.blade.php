@extends('layouts.app')

@section('title', 'Pengampuan Guru (Plotting Hak Akses)')

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
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Pengampuan Guru</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola pengampuan (hak akses) Guru, Kelas, dan Mata Pelajaran secara manual maupun otomatis.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button type="button" onclick="document.getElementById('autoPlotModal').classList.remove('hidden')" class="btn-orange-outline font-bold px-4 py-2.5 rounded-xl shadow-sm text-sm flex items-center gap-2">
                <i class="fas fa-magic"></i> Auto-Plot Otomatis
            </button>
        </div>
    </div>

    <!-- Plotting Form Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4"><i class="fas fa-user-plus text-[#D65A20] mr-2"></i>Tambah Pengampuan Manual</h2>
        <form action="{{ route('teaching-assignments.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Select Guru -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Guru <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="guru_id" id="guru_select" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($teachers as $guru)
                            <option value="{{ $guru->id }}" data-spesialisasi="{{ $guru->spesialisasi }}">{{ $guru->nama }} {{ $guru->spesialisasi ? '(' . $guru->spesialisasi . ')' : '' }}</option>
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
                        <select name="mata_pelajaran_id" id="mapel_select" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-sm text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($subjects as $mapel)
                            <option value="{{ $mapel->id }}" data-nama="{{ $mapel->nama }}">{{ $mapel->nama }}</option>
                        @endforeach
                    </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Select Kelas (Checkboxes) -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-2">Pilih Kelas Diampu (Bisa lebih dari satu) <span class="text-rose-500">*</span></label>
                
                @php
                    $groupedClasses = $classes->groupBy('grade_level');
                @endphp
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                    @foreach($groupedClasses as $grade => $gradeClasses)
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-3 border-b border-slate-200 dark:border-slate-700 pb-2">
                                <i class="fas fa-layer-group text-slate-400 mr-1.5"></i> Kelas {{ $grade }}
                            </h3>
                            <div class="grid grid-cols-2 gap-y-3 gap-x-2">
                                @foreach($gradeClasses as $kelas)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="checkbox" name="kelas_id[]" value="{{ $kelas->id }}" class="w-4 h-4 rounded border-slate-300 text-[#D65A20] focus:ring-[#D65A20] dark:border-slate-600 dark:bg-slate-700 dark:checked:bg-[#D65A20]">
                                        <span class="text-sm text-slate-600 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white transition font-medium">{{ $kelas->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-orange-solid font-bold px-6 py-2.5 rounded-xl shadow-sm flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> Simpan Pengampuan
                </button>
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        
        <!-- Table Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white"><i class="fas fa-list-ul text-[#D65A20] mr-2"></i>Daftar Pengampuan Guru (TA: {{ $activeYear }})</h2>
            
            <div class="relative w-full sm:w-72">
                <input type="text" id="customSearchInput" placeholder="Cari pengampuan..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2 text-sm text-slate-700 placeholder-slate-400 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" />
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="fas fa-search text-xs"></i>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto flex-1 min-h-0 overflow-y-auto pb-4">
            <table id="plottingTable" class="w-full border-collapse border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-900 text-sm whitespace-nowrap text-left">
                <thead class="sticky top-0 z-20">
                    <tr class="shadow-sm">
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 w-16">No</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Nama Guru</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Mata Pelajaran</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-left font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700">Kelas Diampu</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 w-24">Total JP</th>
                        <th class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100 text-xs uppercase tracking-wider !bg-slate-200 dark:!bg-slate-700 w-32">Status Beban</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $groupedPlottings = $plottings->groupBy('guru_id');
                        $iterator = 1;
                    @endphp
                    @foreach($groupedPlottings as $guruId => $guruPlots)
                        @php
                            $firstPlot = $guruPlots->first();
                            $guru = $firstPlot->guru;
                            $totalJp = $teacherJp[$guru->id] ?? 0;
                            
                            $statusText = 'Normal';
                            $statusClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400';
                            $statusIcon = 'fa-check-circle text-emerald-500';
                            
                            if ($totalJp < 24) {
                                $statusText = 'Kurang';
                                $statusClass = 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400';
                                $statusIcon = 'fa-exclamation-triangle text-amber-500';
                            } elseif ($totalJp > 40) {
                                $statusText = 'Lebih';
                                $statusClass = 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400';
                                $statusIcon = 'fa-exclamation-circle text-rose-500';
                            }
                        @endphp
                          <tr class="even:bg-slate-50 dark:even:bg-slate-800/30 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition group">
                              <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center text-slate-700 dark:text-slate-300">{{ $iterator++ }}</td>
                              <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 font-bold text-slate-800 dark:text-slate-100">{{ $guru->nama ?? '-' }}</td>
                              <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-slate-700 dark:text-slate-300 font-bold whitespace-normal min-w-[200px]">
                                  {{ $guruPlots->pluck('subject.nama')->unique()->implode(', ') }}
                              </td>
                              <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 whitespace-normal min-w-[250px]">
                                  @foreach($guruPlots as $plot)
                                      <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 rounded text-xs font-bold mr-1 mb-1 shadow-sm">
                                          {{ $plot->kelas->name ?? '-' }}
                                          <form action="{{ route('teaching-assignments.destroy', $plot->id) }}" method="POST" onsubmit="return confirm('Hapus hak akses mengajar kelas {{ $plot->kelas->name }} untuk guru ini?');" class="inline">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="text-rose-400 hover:text-rose-600 font-bold ml-1 text-xs focus:outline-none">&times;</button>
                                          </form>
                                      </span>
                                  @endforeach
                              </td>
                              <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center font-bold text-slate-800 dark:text-slate-100">{{ $totalJp }} JP</td>
                              <td class="border border-slate-400 dark:border-slate-500 px-3 py-1.5 text-center">
                                  <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-bold {{ $statusClass }}">
                                      <i class="fas {{ $statusIcon }}"></i>
                                      {{ $statusText }}
                                  </span>
                              </td>
                          </tr>
                    @endforeach
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
                emptyTable: '<div class="flex flex-col items-center justify-center py-8"><i class="fas fa-inbox text-4xl mb-3 text-slate-300 dark:text-slate-600"></i><p>Belum ada data pengampuan guru.</p></div>',
                zeroRecords: "Tidak ada plotting yang cocok dengan pencarian"
            }
        });

        // Custom Search Input
        $('#customSearchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Smart Mapel Filter Logic
        var originalMapelOptions = [];
        $('#mapel_select option').each(function() {
            if ($(this).val() !== '') {
                originalMapelOptions.push({
                    value: $(this).val(),
                    text: $(this).text(),
                    nama: $(this).data('nama')
                });
            }
        });

        $('#guru_select').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var spesialisasi = selectedOption.data('spesialisasi') || '';
            
            var mapelSelect = $('#mapel_select');
            mapelSelect.empty();
            mapelSelect.append('<option value="">-- Pilih Mapel --</option>');

            if (spesialisasi) {
                var relatedMapel = [];
                var otherMapel = [];

                originalMapelOptions.forEach(function(opt) {
                    // Check if mapel name contains the specialization string (case-insensitive)
                    if (opt.nama.toLowerCase().includes(spesialisasi.toLowerCase())) {
                        relatedMapel.push(opt);
                    } else {
                        otherMapel.push(opt);
                    }
                });

                if (relatedMapel.length > 0) {
                    var relatedGroup = $('<optgroup label="Sesuai Spesialisasi (' + spesialisasi + ')"></optgroup>');
                    relatedMapel.forEach(function(opt) {
                        relatedGroup.append($('<option></option>').val(opt.value).text(opt.text).attr('data-nama', opt.nama));
                    });
                    mapelSelect.append(relatedGroup);

                    // Auto-select the first related mapel
                    mapelSelect.val(relatedMapel[0].value);
                }

                if (otherMapel.length > 0) {
                    var otherGroup = $('<optgroup label="Mata Pelajaran Lainnya"></optgroup>');
                    otherMapel.forEach(function(opt) {
                        otherGroup.append($('<option></option>').val(opt.value).text(opt.text).attr('data-nama', opt.nama));
                    });
                    mapelSelect.append(otherGroup);
                }
            } else {
                // If no specialization, just append all normally
                originalMapelOptions.forEach(function(opt) {
                    mapelSelect.append($('<option></option>').val(opt.value).text(opt.text).attr('data-nama', opt.nama));
                });
            }
        });
    });
</script>
@endpush
@endsection
