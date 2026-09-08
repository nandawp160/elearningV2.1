@extends('layouts.app')

@section('title', 'Banding Keterlambatan')

@section('content')
<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Breadcrumb & Header -->
    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-2">
        <span>Monitoring Kelas</span>
        <span class="text-slate-300 dark:text-slate-700">/</span>
        <span class="text-[#D65A20] font-extrabold">Banding Keterlambatan</span>
    </div>

    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Rekapitulasi Penguncian & Banding</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Akumulasi seluruh siswa di kelas {{ $classRoom->name }} berdasarkan frekuensi akses tugas yang terkunci (Lock).</p>
            </div>
        </div>
    </div>

    <!-- Filters & Sorting Action Bar -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm">
        <div class="relative w-full sm:max-w-md">
            <input type="text" id="studentSearchInput" placeholder="Cari nama atau NIS siswa..." 
                   class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-100">
            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                <i class="fas fa-search text-xs"></i>
            </div>
        </div>
        
        <div class="relative w-full sm:w-auto">
            <select id="studentSortSelect" 
                    class="w-full sm:w-56 rounded-xl border border-slate-200 pl-4 pr-10 py-2.5 text-xs text-slate-650 bg-white appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-100 dark:border-slate-800 cursor-pointer">
                <option value="terbanyak">Urutkan: Terbanyak</option>
                <option value="tersedikit">Urutkan: Tersedikit</option>
                <option value="nama_asc">Urutkan: Nama (A-Z)</option>
            </select>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                <i class="fas fa-chevron-down text-[10px]"></i>
            </div>
        </div>
    </div>

    <!-- Appeals Table Card -->
    <div class="bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto overflow-y-auto" style="max-height: 620px;">
            <table class="w-full border-collapse text-xs" id="studentTable">
                <thead class="sticky top-0 z-10">
                    <tr class="bg-slate-100 dark:bg-slate-800 text-slate-950 dark:text-white border-b-2 border-slate-300 dark:border-slate-700">
                        <th class="px-4 py-3.5 text-center font-black w-14 uppercase tracking-wider text-xs">NO</th>
                        <th class="px-5 py-3.5 text-left font-black min-w-72 uppercase tracking-wider text-xs">NAMA SISWA & NIS</th>
                        <th class="px-4 py-3.5 text-center font-black min-w-36 uppercase tracking-wider text-xs">TOTAL TERKENA LOCK</th>
                        <th class="px-5 py-3.5 text-left font-black min-w-64 uppercase tracking-wider text-xs">STATUS TERAKHIR</th>
                        <th class="px-4 py-3.5 text-center font-black w-32 uppercase tracking-wider text-xs">RIWAYAT / BUKTI</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody" class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($studentsData as $idx => $data)
                    <tr class="student-table-row hover:bg-orange-50/40 dark:hover:bg-slate-800/50 transition-colors cursor-pointer text-slate-900 dark:text-slate-100"
                        data-name="{{ strtolower($data->student->nama) }}" 
                        data-nis="{{ strtolower($data->student->nis) }}"
                        data-lock-count="{{ $data->total_lock }}"
                        onclick="if(!event.target.closest('button') && !event.target.closest('a')) openHistoryModal({{ json_encode($data->student) }}, {{ json_encode($data->appeals_history) }})">
                        
                        <!-- Row Number -->
                        <td class="px-4 py-3.5 text-center text-slate-900 dark:text-slate-200 font-extrabold text-xs">
                            {{ $idx + 1 }}
                        </td>

                        <!-- Student Profile -->
                        <td class="px-5 py-3.5">
                            <span class="font-black text-sm text-slate-950 dark:text-white block hover:text-[#D65A20] transition-colors">{{ $data->student->nama }}</span>
                            @if($data->student->nis)
                                <span class="font-mono text-xs font-bold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded mt-1 inline-block border border-slate-200 dark:border-slate-700">NIS. {{ $data->student->nis }}</span>
                            @else
                                <span class="text-[11px] font-semibold text-amber-800 dark:text-amber-300 mt-0.5 block italic">NIS Belum diisi</span>
                            @endif
                        </td>
                        
                        <!-- Total Terkena Lock -->
                        <td class="px-4 py-3.5 text-center">
                            @if($data->total_lock >= 3)
                                <span class="bg-rose-100 text-rose-950 border-2 border-rose-300 rounded-lg px-2.5 py-1 text-xs font-black font-mono inline-block dark:bg-rose-950 dark:text-rose-200 dark:border-rose-700 shadow-2xs">
                                    {{ $data->total_lock }} KALI
                                </span>
                            @elseif($data->total_lock > 0)
                                <span class="bg-amber-100 text-amber-950 border-2 border-amber-300 rounded-lg px-2.5 py-1 text-xs font-black font-mono inline-block dark:bg-amber-950 dark:text-amber-200 dark:border-amber-700 shadow-2xs">
                                    {{ $data->total_lock }} KALI
                                </span>
                            @else
                                <span class="bg-emerald-100 text-emerald-950 border-2 border-emerald-300 rounded-lg px-2.5 py-1 text-xs font-black font-mono inline-block dark:bg-emerald-950 dark:text-emerald-200 dark:border-emerald-700 shadow-2xs">
                                    {{ $data->total_lock }} KALI
                                </span>
                            @endif
                        </td>
                        
                        <!-- Status Terakhir -->
                        <td class="px-5 py-3.5">
                            <span class="font-black text-xs block text-slate-950 dark:text-white">
                                {{ $data->status_label }}
                            </span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300 block mt-0.5 truncate max-w-sm">
                                {{ $data->status_subtext }}
                            </span>
                        </td>
                        
                        <!-- Actions / Riwayat / Bukti -->
                        <td class="px-4 py-3.5 text-center">
                            @if($data->appeals_history->isNotEmpty())
                                <button onclick="openHistoryModal({{ json_encode($data->student) }}, {{ json_encode($data->appeals_history) }})" 
                                        class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#D65A20] hover:bg-[#be4e1a] text-white font-extrabold text-xs shadow-sm transition" 
                                        title="Lihat Bukti & Riwayat">
                                    <i class="far fa-file-alt text-xs"></i>
                                    <span>Riwayat</span>
                                </button>
                            @else
                                <span class="text-xs font-bold text-slate-400 dark:text-slate-600" title="Tidak ada riwayat">
                                    <i class="fas fa-minus"></i>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-slate-700 dark:text-slate-300 font-bold">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i class="fas fa-inbox text-3xl text-slate-400"></i>
                                <span>Belum ada data banding siswa di kelas ini.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <div class="bg-slate-100 dark:bg-slate-950/40 border-t-2 border-slate-200 dark:border-slate-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-bold text-slate-800 dark:text-slate-200">
            <span id="entriesInfo">Menampilkan 1 hingga {{ $studentsData->count() }} dari {{ $studentsData->count() }} siswa</span>
            <div class="flex gap-1.5" id="paginationControls">
                <button class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-400 hover:bg-slate-50 cursor-not-allowed text-xs font-bold" disabled>&lt;</button>
                <button class="px-3.5 py-1.5 rounded-lg bg-[#D65A20] text-white font-black text-xs">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-400 hover:bg-slate-50 cursor-not-allowed text-xs font-bold" disabled>&gt;</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bukti Banding Timeline -->
<div id="appealsHistoryModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300" onclick="closeHistoryModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 rounded-2xl max-w-xl w-full mx-4 p-6 shadow-2xl border-2 border-slate-200 dark:border-slate-800 transform transition-all duration-300 scale-95 opacity-0 overflow-hidden flex flex-col max-h-[88vh]" id="modalContent" style="z-index: 51;">
        <!-- Modal Header -->
        <div class="flex justify-between items-start border-b-2 border-slate-200 dark:border-slate-800 pb-4 mb-4">
            <div>
                <h3 class="text-xl font-black text-slate-950 dark:text-white" id="mName">Riwayat Banding Siswa</h3>
                <p class="text-xs font-mono font-bold text-[#D65A20] mt-0.5" id="mNis">NIS. -</p>
            </div>
            <button onclick="closeHistoryModal()" class="text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors p-1">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Modal Scrollable Body -->
        <div class="overflow-y-auto pr-1 flex-1 space-y-4" id="appealsTimeline">
            <!-- Dynamic elements loaded via JS -->
        </div>
        
        <!-- Modal Footer -->
        <div class="mt-6 pt-4 border-t-2 border-slate-200 dark:border-slate-800 flex justify-end">
            <button onclick="closeHistoryModal()" class="px-6 py-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-xs font-black text-slate-950 dark:text-white transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Search and Sort client-side
    const searchInput = document.getElementById('studentSearchInput');
    const sortSelect = document.getElementById('studentSortSelect');
    const tableBody = document.getElementById('studentTableBody');
    const tableRows = Array.from(document.querySelectorAll('.student-table-row'));

    function filterAndSort() {
        const query = searchInput.value.toLowerCase().trim();
        const sortBy = sortSelect.value;

        // 1. Filter
        let visibleCount = 0;
        tableRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const nis = row.getAttribute('data-nis');
            
            if (name.includes(query) || nis.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // 2. Sort
        const sortedRows = tableRows.slice().sort((a, b) => {
            if (sortBy === 'terbanyak') {
                return parseInt(b.getAttribute('data-lock-count')) - parseInt(a.getAttribute('data-lock-count'));
            } else if (sortBy === 'tersedikit') {
                return parseInt(a.getAttribute('data-lock-count')) - parseInt(b.getAttribute('data-lock-count'));
            } else if (sortBy === 'nama_asc') {
                return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
            }
            return 0;
        });

        // Re-append sorted rows to body
        sortedRows.forEach(row => tableBody.appendChild(row));
        
        document.getElementById('entriesInfo').textContent = `Menampilkan 1 hingga ${visibleCount} dari ${tableRows.length} siswa`;
    }

    searchInput.addEventListener('input', filterAndSort);
    sortSelect.addEventListener('change', filterAndSort);

    // Initial Trigger to sort by 'terbanyak'
    filterAndSort();

    // Modal Timeline function
    function openHistoryModal(student, history) {
        const modal = document.getElementById('appealsHistoryModal');
        const content = document.getElementById('modalContent');
        
        document.getElementById('mName').textContent = student.nama;
        document.getElementById('mNis').textContent = 'NIS. ' + (student.nis || '-');
        
        // Render history timeline
        const timeline = document.getElementById('appealsTimeline');
        timeline.innerHTML = '';
        
        history.forEach((appeal, index) => {
            const courseName = appeal.subject && appeal.subject.course ? appeal.subject.course.nama : 'Mata Pelajaran';
            const teacherName = appeal.approver && appeal.approver.guru ? appeal.approver.guru.nama : 'Guru Mata Pelajaran';
            
            // Format dates & check 24 hours
            const createdDate = new Date(appeal.created_at);
            const now = new Date();
            const hoursDiff = (now - createdDate) / (1000 * 60 * 60);
            const isOver24Hours = Boolean(appeal.is_escalated) || (appeal.tingkat_eskalasi === 'wali_kelas') || (hoursDiff >= 24);
            const dateFormatted = createdDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ' ' + createdDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
            
            // Status markup
            let statusBadge = '';
            if (appeal.status === 'approved') {
                statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-black bg-emerald-100 text-emerald-950 border border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300">✓ Disetujui</span>';
            } else if (appeal.status === 'rejected') {
                statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-black bg-rose-100 text-rose-950 border border-rose-300 dark:bg-rose-950/40 dark:text-rose-300">✕ Ditolak</span>';
            } else {
                if (isOver24Hours) {
                    statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-black bg-purple-100 text-purple-950 border border-purple-300 dark:bg-purple-950/40 dark:text-purple-300">⏳ Eskalasi 1x24 Jam (Hak Wali Kelas)</span>';
                } else {
                    statusBadge = '<span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-black bg-amber-100 text-amber-950 border border-amber-300 dark:bg-amber-950/40 dark:text-amber-300">⏳ Menunggu Respon Guru</span>';
                }
            }

            // File Proof section
            let proofSection = '';
            if (appeal.bukti_pendukung) {
                proofSection = `
                    <div class="mt-3 flex items-center justify-between p-3 bg-slate-100 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                        <div class="flex items-center gap-2 min-w-0">
                            <i class="fas fa-file-pdf text-red-600 text-base shrink-0"></i>
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">Dokumen / Bukti Pendukung</span>
                        </div>
                        <a href="/preview/appeal/${appeal.id}" target="_blank" class="px-3 py-1 rounded-lg bg-[#D65A20] text-white text-xs font-black hover:bg-[#be4e1a] transition shrink-0">
                            <i class="fas fa-eye mr-1"></i> Lihat Berkas
                        </a>
                    </div>
                `;
            }

            // Teacher response section
            let responseSection = '';
            if (appeal.tanggapan_guru) {
                responseSection = `
                    <div class="mt-3 bg-slate-100 dark:bg-slate-800 p-3 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-black text-slate-800 dark:text-slate-200 uppercase tracking-wider block">Catatan Guru (${teacherName})</span>
                        <p class="text-xs font-semibold text-slate-900 dark:text-slate-100 mt-1 leading-relaxed">"${appeal.tanggapan_guru}"</p>
                    </div>
                `;
            }

            // Wali Kelas Direct Action Form if pending and escalated / over 24 hours
            let actionSection = '';
            if (appeal.status === 'pending' || appeal.status === 'ditinjau') {
                if (isOver24Hours) {
                    actionSection = `
                        <div class="mt-4 pt-3 border-t-2 border-slate-200 dark:border-slate-800">
                            <div class="p-3 bg-purple-50 dark:bg-purple-950/30 border border-purple-200 dark:border-purple-800 rounded-xl mb-3">
                                <div class="flex items-center gap-2 text-purple-950 dark:text-purple-200 text-xs font-black">
                                    <i class="fas fa-shield-alt text-purple-600"></i>
                                    <span>Pengambilalihan Hak Wali Kelas Aktif (> 1x24 Jam)</span>
                                </div>
                                <p class="text-xs font-bold text-purple-900 dark:text-purple-300 mt-0.5">Guru mapel belum merespon dalam 1x24 jam. Sebagai Wali Kelas, Anda memiliki wewenang penuh untuk menentukan durasi masa pemulihan tugas.</p>
                            </div>

                            <form action="/teacher/submission-appeals/${appeal.id}/approve" method="POST" onsubmit="return confirm('Setujui banding dan buka masa pemulihan tugas untuk siswa ini?')">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="duration" id="final_duration_${appeal.id}" value="48">
                                
                                <div class="mb-3 p-3 bg-slate-50 dark:bg-slate-800/60 rounded-xl border border-slate-200 dark:border-slate-700">
                                    <label class="block text-xs font-black text-slate-800 dark:text-slate-200 mb-2">
                                        <i class="far fa-clock text-[#D65A20] mr-1"></i> Tentukan Durasi Pemulihan Tugas:
                                    </label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-1.5 mb-2">
                                        <button type="button" onclick="selectDurationBtn(${appeal.id}, 24, this)" class="dur-btn-${appeal.id} flex items-center justify-center p-2 rounded-lg border border-slate-300 dark:border-slate-600 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                                            24 Jam (1 Hari)
                                        </button>
                                        <button type="button" onclick="selectDurationBtn(${appeal.id}, 48, this)" class="dur-btn-${appeal.id} flex items-center justify-center p-2 rounded-lg border-2 border-emerald-500 bg-emerald-50 dark:bg-emerald-950/40 text-xs font-black text-emerald-950 dark:text-emerald-200 hover:bg-emerald-100 transition shadow-sm">
                                            48 Jam (Standar)
                                        </button>
                                        <button type="button" onclick="selectDurationBtn(${appeal.id}, 72, this)" class="dur-btn-${appeal.id} flex items-center justify-center p-2 rounded-lg border border-slate-300 dark:border-slate-600 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                                            72 Jam (3 Hari)
                                        </button>
                                        <button type="button" onclick="selectDurationBtn(${appeal.id}, 'custom', this)" class="dur-btn-${appeal.id} flex items-center justify-center p-2 rounded-lg border border-slate-300 dark:border-slate-600 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                                            Kustom Jam
                                        </button>
                                    </div>
                                    <div id="custom_dur_box_${appeal.id}" class="hidden mt-2 p-2 bg-white dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700 flex items-center gap-2">
                                        <input type="number" id="custom_dur_val_${appeal.id}" min="1" max="720" placeholder="Masukkan jumlah jam (misal: 36)" oninput="handleCustomDurationInput(${appeal.id})" class="w-full px-2.5 py-1 text-xs font-bold rounded border border-slate-300 dark:border-slate-600 bg-transparent text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500">
                                        <span class="text-xs font-bold text-slate-600 dark:text-slate-400 shrink-0">Jam</span>
                                    </div>
                                </div>

                                <div class="flex gap-2 justify-end">
                                    <button type="button" onclick="if(confirm('Apakah Anda yakin ingin menolak permohonan banding ini?')) document.getElementById('reject_form_${appeal.id}').submit();" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-black transition shadow-sm">
                                        ✕ Tolak Banding
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-black transition shadow-sm">
                                        ✓ Setujui Banding (Buka Pemulihan)
                                    </button>
                                </div>
                            </form>

                            <form id="reject_form_${appeal.id}" action="/teacher/submission-appeals/${appeal.id}/reject" method="POST" class="hidden">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    `;
                } else {
                    const remainingHours = Math.max(1, Math.round(24 - hoursDiff));
                    actionSection = `
                        <div class="mt-3 p-3 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-800 rounded-xl text-xs text-amber-950 dark:text-amber-200 font-bold flex items-center gap-2">
                            <i class="fas fa-hourglass-half text-amber-600"></i>
                            <span>Periode Guru Pengampu. Hak ambil alih Wali Kelas akan aktif dalam ${remainingHours} jam lagi jika guru tidak merespon.</span>
                        </div>
                    `;
                }
            }

            const item = document.createElement('div');
            item.className = 'border-2 border-slate-200 dark:border-slate-800 p-4 rounded-xl space-y-2 relative bg-white dark:bg-slate-900 shadow-sm';
            item.innerHTML = `
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <h4 class="font-black text-slate-950 dark:text-white text-sm">${courseName}</h4>
                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300 block mt-0.5">${dateFormatted}</span>
                    </div>
                    ${statusBadge}
                </div>
                <div class="bg-slate-100 dark:bg-slate-800 p-3 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-medium text-slate-900 dark:text-slate-100">
                    <span class="text-slate-700 dark:text-slate-300 font-bold block mb-0.5">Alasan Keterlambatan:</span>
                    "${appeal.alasan || 'Tidak ada alasan'}"
                </div>
                ${proofSection}
                ${responseSection}
                ${actionSection}
            `;
            timeline.appendChild(item);
        });

        modal.classList.remove('hidden');
        modal.offsetHeight; // force reflow
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }

    function selectDurationBtn(appealId, val, btn) {
        const buttons = document.querySelectorAll(`.dur-btn-${appealId}`);
        buttons.forEach(b => {
            b.className = `dur-btn-${appealId} flex items-center justify-center p-2 rounded-lg border border-slate-300 dark:border-slate-600 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition`;
        });

        btn.className = `dur-btn-${appealId} flex items-center justify-center p-2 rounded-lg border-2 border-emerald-500 bg-emerald-50 dark:bg-emerald-950/40 text-xs font-black text-emerald-950 dark:text-emerald-200 hover:bg-emerald-100 transition shadow-sm`;

        const customBox = document.getElementById(`custom_dur_box_${appealId}`);
        const finalInput = document.getElementById(`final_duration_${appealId}`);

        if (val === 'custom') {
            customBox.classList.remove('hidden');
            const customVal = document.getElementById(`custom_dur_val_${appealId}`).value;
            finalInput.value = customVal ? parseInt(customVal) : 48;
        } else {
            customBox.classList.add('hidden');
            finalInput.value = parseInt(val);
        }
    }

    function handleCustomDurationInput(appealId) {
        const customVal = document.getElementById(`custom_dur_val_${appealId}`).value;
        const finalInput = document.getElementById(`final_duration_${appealId}`);
        finalInput.value = customVal ? parseInt(customVal) : 48;
    }

    function closeHistoryModal() {
        const modal = document.getElementById('appealsHistoryModal');
        const content = document.getElementById('modalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }
</script>
@endsection
