<!-- ==========================================
      MODAL POPUP: PLOTTING SISWA OTOMATIS
     ========================================== -->
<div id="modalPlottingSiswa" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-orange-500">
            <h3 class="text-lg font-bold text-white"><i class="fas fa-random mr-2"></i>Plotting Siswa Otomatis</h3>
            <button onclick="closePlottingSiswaModal()" class="text-white hover:text-orange-100 transition"><i class="fas fa-times text-lg"></i></button>
        </div>
        <!-- Form -->
        <form action="{{ route('students.auto-plot') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div class="space-y-2">
                <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Tahun Ajaran Target</label>
                <div class="relative">
                    <select name="tahun_ajaran" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                        @php
                            $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
                            $academicYearsList = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                                ->select('academic_year')
                                ->distinct()
                                ->orderBy('academic_year', 'desc')
                                ->pluck('academic_year')
                                ->toArray();
                            
                            $customYears = json_decode(\App\Models\Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
                            if (is_array($customYears)) {
                                $academicYearsList = array_unique(array_merge($academicYearsList, $customYears));
                            }
                            rsort($academicYearsList);
                            if (empty($academicYearsList)) {
                                $academicYearsList = [$activeYear];
                            }
                        @endphp
                        @foreach($academicYearsList as $year)
                            <option value="{{ $year }}" {{ $year == $activeYear ? 'selected' : '' }}>T.A. {{ $year }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-orange-50/50 dark:bg-slate-800/50 border border-orange-100 dark:border-slate-800 space-y-2 text-xxs text-slate-500 dark:text-slate-400 leading-relaxed">
                <p class="font-bold text-orange-600 dark:text-orange-400 uppercase tracking-wider"><i class="fas fa-info-circle mr-1"></i> Cara Kerja Plotting:</p>
                <ul class="list-disc pl-4 space-y-1">
                    <li>Sistem <b>HANYA</b> memproses siswa baru (yang memiliki label kelas <b>"X"</b> atau <b>"10"</b> tanpa akhiran).</li>
                    <li>Siswa-siswa tersebut akan didistribusikan secara merata ke dalam Rombel tingkat X yang sudah Anda buat untuk Tahun Ajaran target.</li>
                    <li>Sistem tidak akan membuat Rombel baru secara otomatis. Pastikan Anda telah membuat Rombel tingkat X yang cukup sebelum menjalankan fitur ini.</li>
                    <li>Untuk kelas XI dan XII, silakan gunakan fitur Penjurusan dan Auto-Match Kenaikan Kelas.</li>
                </ul>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closePlottingSiswaModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl">Batal</button>
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-lg shadow-orange-500/10">Mulai Plotting</button>
            </div>
        </form>
    </div>
</div>


<!-- ==========================================
      MODAL POPUP: KELULUSAN & KENAIKAN KELAS
     ========================================== -->
<div id="modalKelulusanKenaikan" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-6xl xl:max-w-7xl overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800 flex flex-col max-h-[92vh]">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-[#D65A20] flex-shrink-0">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <i class="fas fa-graduation-cap"></i>
                <span>Kelulusan & Kenaikan Kelas Massal</span>
            </h3>
            <button onclick="closeKelulusanKenaikanModal()" class="text-white hover:text-orange-100 transition p-1"><i class="fas fa-times text-lg"></i></button>
        </div>
        
        <!-- Tab Navigation -->
        <div class="flex border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 flex-shrink-0">
            <button type="button" onclick="switchTab('kelulusan')" id="tab-kelulusan" class="flex-1 py-3 text-xs sm:text-sm font-bold text-orange-500 border-b-2 border-orange-500 transition">
                🎓 Kelulusan Kelas XII
            </button>
            <button type="button" onclick="switchTab('kenaikan')" id="tab-kenaikan" class="flex-1 py-3 text-xs sm:text-sm font-bold text-slate-500 hover:text-slate-750 dark:hover:text-slate-350 border-b-2 border-transparent transition">
                📈 Kenaikan Kelas (XI ke XII)
            </button>
            <button type="button" onclick="switchTab('penjurusan')" id="tab-penjurusan" class="flex-1 py-3 text-xs sm:text-sm font-bold text-slate-500 hover:text-slate-750 dark:hover:text-slate-350 border-b-2 border-transparent transition">
                🎯 Penjurusan (X ke XI)
            </button>
        </div>

        <!-- Form & Content -->
        <div class="p-6 overflow-y-auto flex-grow">
            <!-- TAB: KELULUSAN -->
            <form id="formKelulusan" action="{{ route('students.bulk-graduate') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="field-label mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Kelas XII Yang Lulus</label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="toggleAllClasses(true)" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Centang Semua</button>
                            <button type="button" onclick="toggleAllClasses(false)" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Hapus Semua</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="kelasTwelveContainer">
                        @foreach($daftarKelasAsal->filter(fn($c) => stripos($c, 'xii') === 0 || stripos($c, '12') === 0) as $kelas)
                            <label class="flex items-center gap-2 p-2.5 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer">
                                <input type="checkbox" name="kelas[]" value="{{ $kelas }}" onchange="loadStudentsForGraduation()" class="kelas-checkbox rounded border-slate-300 text-orange-500 focus:ring-orange-500" />
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $kelas }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Student List Area for Graduation -->
                <div id="gradStudentsSection" class="space-y-2 hidden">
                    <div class="flex items-center justify-between">
                        <label class="field-label block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Daftar Siswa (Centang yang Lulus)</label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="toggleAllCheckboxes('gradStudentsList', true, 'updateGradCount')" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Centang Semua</button>
                            <button type="button" onclick="toggleAllCheckboxes('gradStudentsList', false, 'updateGradCount')" class="text-[10px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded transition border border-slate-200 dark:border-slate-700">Hapus Semua</button>
                            <span class="text-[10px] text-slate-400 font-bold ml-1" id="gradSelectedCount">0 siswa terpilih</span>
                        </div>
                    </div>
                    
                    <!-- Search Input inside Modal -->
                    <div class="relative">
                        <input type="text" id="searchGradStudents" placeholder="Cari nama siswa..." class="w-full rounded-xl border border-slate-200 bg-white pl-9 pr-4 py-2 text-xs text-slate-700 placeholder-slate-400 focus:border-orange-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fas fa-search text-xs"></i>
                        </div>
                    </div>

                    <!-- Scrollable list of checkboxes -->
                    <div class="border border-slate-200 dark:border-slate-800 rounded-xl max-h-48 overflow-y-auto p-3 space-y-2" id="gradStudentsList">
                        <!-- Populated via Javascript -->
                    </div>
                </div>

                <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="closeKelulusanKenaikanModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs">Batal</button>
                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs">Proses Kelulusan</button>
                </div>
            </form>

            <!-- TAB: KENAIKAN -->
            <form id="formKenaikan" action="{{ route('students.bulk-promote') }}" method="POST" class="space-y-4 hidden">
                @csrf
                <div class="mb-2 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-100 dark:border-slate-800">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed max-w-md">
                        Pilih kelas tujuan untuk masing-masing kelas asal. Kosongkan kelas tujuan jika kelas tersebut tidak ingin dinaikkan massal saat ini.
                    </p>
                    <button type="button" onclick="autoMatchClasses()" class="btn bg-orange-50 hover:bg-orange-100 text-orange-600 border border-orange-200 dark:bg-orange-950/20 dark:border-orange-500/30 dark:text-orange-400 text-xxs font-bold px-3 py-2 rounded-xl flex items-center gap-1.5 transition flex-shrink-0 shadow-sm">
                        <i class="fas fa-magic text-xxs"></i>
                        <span>Cocokkan Otomatis</span>
                    </button>
                </div>
                
                <div class="max-h-[50vh] overflow-y-auto border border-slate-200 dark:border-slate-800 rounded-xl">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 sticky top-0 z-10">
                            <tr>
                                <th class="py-2 px-4 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider border-b border-slate-200 dark:border-slate-800">Kelas Asal (X / XI)</th>
                                <th class="py-2 px-4 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider border-b border-slate-200 dark:border-slate-800">Kelas Tujuan (XI / XII)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                            @foreach($daftarKelasAsal->filter(function($c) {
                                $parts = explode(' ', trim($c));
                                $grade = strtoupper($parts[0]);
                                return $grade === 'XI' || $grade === '11';
                            }) as $index => $kelas)
                            <tr class="odd:bg-white even:bg-slate-50/50 dark:odd:bg-slate-900 dark:even:bg-slate-800/10 hover:bg-slate-100/50 dark:hover:bg-slate-800/35 transition-colors">
                                <td class="py-2.5 px-4 w-1/2">
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $kelas }}</span>
                                    <input type="hidden" name="mapping[{{ $index }}][asal]" value="{{ $kelas }}">
                                </td>
                                <td class="py-2.5 px-4 w-1/2">
                                    @php
                                        $originCount = \App\Models\Siswa::where('kelas', $kelas)->count();
                                    @endphp
                                    <select name="mapping[{{ $index }}][tujuan]" class="input py-1.5 px-3 text-xs w-full auto-mapping-select" data-asal="{{ $kelas }}" data-students-count="{{ $originCount }}">
                                        <option value="">-- Jangan Naikkan Dulu --</option>
                                        @php
                                            $parts = explode(' ', trim($kelas));
                                            $jurusan = count($parts) > 1 ? $parts[1] : '';
                                            $tingkatAsal = strtoupper($parts[0]);
                                            $tingkatTujuan = [];
                                            
                                            // Tentukan tingkat tujuan berdasarkan tingkat asal
                                            if ($tingkatAsal === 'X' || $tingkatAsal === '10') $tingkatTujuan = ['XI', '11'];
                                            elseif ($tingkatAsal === 'XI' || $tingkatAsal === '11') $tingkatTujuan = ['XII', '12'];
                                            
                                            $classroomsRaw = \App\Models\Kelas::orderBy('name', 'asc')->get();
                                            $filteredClasses = $classroomsRaw->filter(function($c) use ($jurusan, $tingkatTujuan) {
                                                $name = strtoupper($c->name);
                                                if (!empty($tingkatTujuan)) {
                                                    $matchTingkat = false;
                                                    foreach ($tingkatTujuan as $t) {
                                                        if (strpos($name, $t . ' ') === 0 || $name === $t) {
                                                            $matchTingkat = true; break;
                                                        }
                                                    }
                                                    if (!$matchTingkat) return false;
                                                }
                                                return true;
                                            });
                                        @endphp
                                        @foreach($filteredClasses as $k)
                                            @php
                                                $currentStudents = \App\Models\Siswa::where('kelas', $k->name)->count();
                                                $capacity = $k->max_students ?? 36; // Default capacity 36
                                            @endphp
                                            <option value="{{ $k->name }}" data-capacity="{{ $capacity }}" data-current="{{ $currentStudents }}">{{ $k->name }} (Isi: {{ $currentStudents }}/{{ $capacity }})</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" onclick="closeKelulusanKenaikanModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs">Batal</button>
                    <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs">Proses Kenaikan Massal</button>
                </div>
            </form>

            <!-- TAB: PENJURUSAN X ke XI -->
            <div id="formPenjurusan" class="space-y-4 hidden flex-col h-full">
                <!-- 1. Header: Selector Kelas X Asal & Live Counter -->
                <div class="p-3.5 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-200/60 dark:border-slate-800 flex flex-wrap items-center justify-between gap-3 flex-shrink-0">
                    <div class="flex items-center gap-3 flex-1 min-w-[240px]">
                        <label class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase whitespace-nowrap flex items-center gap-1.5">
                            <i class="fas fa-chalkboard text-orange-500"></i> Kelas X Asal:
                        </label>
                        <select id="kelasXSelector" class="rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-bold text-slate-800 focus:border-orange-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 flex-1 max-w-xs shadow-sm" onchange="loadStudentsForPenjurusan(this.value)">
                            <option value="">-- Pilih Kelas X Asal --</option>
                            @foreach($daftarKelasAsal->filter(function($c) {
                                $parts = explode(' ', trim($c));
                                $grade = strtoupper($parts[0]);
                                return $grade === 'X' || $grade === '10';
                            }) as $kelas)
                                <option value="{{ $kelas }}">{{ $kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="penjurusanStatsSummary" class="hidden flex items-center gap-2 flex-wrap">
                        <span class="px-2.5 py-1 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold" id="statTotalStudents">0 Siswa</span>
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 text-xs font-bold" id="statAssignedCount">0 Terplot</span>
                        <span class="px-2.5 py-1 rounded-lg bg-amber-100 dark:bg-amber-500/20 text-amber-700 dark:text-amber-300 text-xs font-bold" id="statUnassignedCount">0 Belum Terplot</span>
                    </div>
                </div>

                <!-- 2. Live Kuota Monitor -->
                <div id="penjurusanQuotaMonitor" class="hidden space-y-2 flex-shrink-0 bg-white dark:bg-slate-900 p-3 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        <span class="flex items-center gap-1.5 text-slate-700 dark:text-slate-200">
                            <i class="fas fa-chart-pie text-orange-500"></i> Monitor Kuota Kelas XI Tujuan (Real-Time)
                        </span>
                        <span class="text-[10px] text-slate-400 font-normal">Kapasitas Maksimal: 36 siswa / kelas</span>
                    </div>
                    <div id="penjurusanQuotaBadges" class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2.5">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- 3. Bulk Assignment Toolbar & Search -->
                <div id="penjurusanToolbar" class="hidden space-y-2.5 bg-orange-50/70 dark:bg-orange-950/20 p-3 rounded-xl border border-orange-200/70 dark:border-orange-800/40 flex-shrink-0">
                    <!-- Row 1: Bulk Assign Action -->
                    <div class="flex flex-wrap items-center justify-between gap-2.5">
                        <div class="flex items-center gap-2 flex-wrap flex-1">
                            <label class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-700 dark:text-slate-200 cursor-pointer bg-white dark:bg-slate-900 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm hover:bg-slate-50">
                                <input type="checkbox" id="checkAllPenjurusan" onchange="toggleAllPenjurusanCheckboxes(this.checked)" class="rounded border-slate-300 text-orange-500 focus:ring-orange-500">
                                <span>Pilih Semua</span>
                            </label>
                            <span class="text-xs font-bold text-orange-600 dark:text-orange-400 bg-orange-100 dark:bg-orange-900/40 px-2.5 py-1 rounded-md" id="penjurusanBulkCount">0 dipilih</span>
                            
                            <div class="flex items-center gap-1.5 flex-1 min-w-[200px] max-w-sm">
                                <select id="penjurusanBulkTarget" class="rounded-lg border border-slate-200 bg-white dark:bg-slate-900 dark:border-slate-700 text-slate-800 dark:text-slate-100 py-1.5 px-3 text-xs font-semibold flex-1 shadow-sm">
                                    <option value="">Pilih Kelas XI Tujuan...</option>
                                </select>
                                <button type="button" onclick="applyBulkPenjurusanTarget()" class="btn bg-[#D65A20] hover:bg-[#be4e1a] text-white text-xs font-bold px-3.5 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5 transition whitespace-nowrap">
                                    <i class="fas fa-bolt"></i> Terapkan ke Pilihan
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" onclick="autoDistributeRemainingPenjurusan()" class="btn bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5 transition whitespace-nowrap" title="Bagi rata sisa siswa yang belum ditentukan kelasnya">
                                <i class="fas fa-random"></i> Bagi Rata Sisa Siswa
                            </button>
                            <button type="button" onclick="resetPenjurusanSelection(event)" class="btn border border-slate-300 dark:border-slate-700 bg-white hover:bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-300 text-xs font-semibold px-2.5 py-1.5 rounded-lg shadow-sm" title="Reset Semua Pilihan">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>

                    <!-- Row 2: Search & Filter Tabs -->
                    <div class="flex flex-wrap items-center justify-between gap-2 pt-2 border-t border-orange-200/50 dark:border-orange-800/30">
                        <div class="relative flex-1 min-w-[200px] max-w-xs">
                            <input type="text" id="searchPenjurusanSiswa" placeholder="Cari nama siswa atau NIS..." oninput="filterPenjurusanStudents()" onkeydown="if(event.key==='Enter'){event.preventDefault(); return false;}" class="w-full rounded-lg border border-slate-200 bg-white pl-8 pr-3 py-1.5 text-xs text-slate-700 placeholder-slate-400 focus:border-orange-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 shadow-sm" />
                            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <i class="fas fa-search text-[10px]"></i>
                            </div>
                        </div>

                        <div class="flex items-center gap-1 bg-white dark:bg-slate-900 p-1 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm text-xs">
                            <button type="button" onclick="setPenjurusanFilterMode('all')" id="btnFilterAll" class="px-2.5 py-1 rounded font-bold bg-orange-500 text-white text-[11px] transition">Semua (<span id="countFilterAll">0</span>)</button>
                            <button type="button" onclick="setPenjurusanFilterMode('unassigned')" id="btnFilterUnassigned" class="px-2.5 py-1 rounded font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 text-[11px] transition">Belum Diplot (<span id="countFilterUnassigned">0</span>)</button>
                            <button type="button" onclick="setPenjurusanFilterMode('assigned')" id="btnFilterAssigned" class="px-2.5 py-1 rounded font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 text-[11px] transition">Sudah Diplot (<span id="countFilterAssigned">0</span>)</button>
                        </div>
                    </div>
                </div>
                
                <!-- 4. Students Table -->
                <div id="penjurusanStudentsSection" class="hidden flex-1 flex flex-col min-h-0">
                    <div class="overflow-y-auto border border-slate-200 dark:border-slate-800 rounded-xl flex-1 max-h-[46vh] bg-white dark:bg-slate-900 shadow-inner">
                        <table class="w-full text-left border-collapse" id="penjurusanTable">
                            <thead class="bg-slate-100 dark:bg-slate-800 sticky top-0 z-10 text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="py-3 px-3 w-10 text-center">
                                        <input type="checkbox" onchange="toggleAllPenjurusanCheckboxes(this.checked)" class="rounded border-slate-300 text-orange-500 focus:ring-orange-500 cursor-pointer">
                                    </th>
                                    <th class="py-3 px-4 w-72">Siswa</th>
                                    <th class="py-3 px-4">Pilih Kelas XI Tujuan (1-Click Badges)</th>
                                </tr>
                            </thead>
                            <tbody id="penjurusanStudentsList" class="divide-y divide-slate-100 dark:divide-slate-800 text-xs">
                                <!-- Populated via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 5. Footer & Action Buttons -->
                <div class="flex justify-between items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800 flex-shrink-0 mt-auto">
                    <div class="text-xs text-slate-500 dark:text-slate-400">
                        <span id="penjurusanFooterSummary">Pilih kelas asal untuk memulai.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="closeKelulusanKenaikanModal()" class="btn border border-slate-200 hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold px-4 py-2 rounded-xl text-xs transition">Batal</button>
                        <button type="button" onclick="submitPenjurusanViaAjax()" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-5 py-2 rounded-xl shadow-md text-xs transition flex items-center gap-2" id="btnProsesPenjurusan" disabled>
                            <i class="fas fa-save"></i>
                            <span>Simpan Penjurusan</span>
                        </button>
                    </div>
                </div>
                
                @php
                    $masterXI = \App\Models\MasterKelas::where('grade_level', 'XI')
                        ->orWhere('name', 'LIKE', 'XI %')
                        ->orderBy('name', 'asc')
                        ->get(['id', 'name']);

                    if ($masterXI->isNotEmpty()) {
                        $kelasXICollection = $masterXI->map(function($m) {
                            $m->max_students = 36;
                            return $m;
                        });
                    } else {
                        $kelasXICollection = \App\Models\Kelas::withoutGlobalScopes()
                            ->where(function($q) {
                                $q->where('name', 'LIKE', 'XI %')
                                  ->orWhere('name', 'LIKE', '11 %');
                            })
                            ->orderBy('name', 'asc')
                            ->get(['id', 'name', 'max_students']);
                    }

                    $uniqueKelasXI = $kelasXICollection->unique('name')->values();
                    $kelasXIData = [];
                    foreach ($uniqueKelasXI as $k) {
                        $currentCount = \App\Models\Siswa::where('kelas', $k->name)->active()->count();
                        $kelasXIData[] = [
                            'name' => $k->name,
                            'max_students' => $k->max_students ?? 36,
                            'current_count' => $currentCount,
                        ];
                    }
                @endphp
                <div id="kelasXIDataStore" class="hidden" data-classes='@json($kelasXIData)'></div>
            </div>
        </div>
    </div>
</div>