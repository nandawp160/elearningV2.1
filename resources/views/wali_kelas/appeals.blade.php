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
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto overflow-y-auto" style="max-height: 600px;">
            <table class="w-full border-collapse border border-slate-300 dark:border-slate-700 text-xs" id="studentTable">
                <thead class="sticky top-0 z-10">
                    <tr class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                        <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-center font-bold w-12 shadow-sm">NO</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-left font-bold min-w-64 shadow-sm">NAMA SISWA & NIS</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-center font-bold min-w-32 shadow-sm">TOTAL TERKENA LOCK</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-left font-bold min-w-48 shadow-sm">STATUS TERAKHIR</th>
                        <th class="border border-slate-300 dark:border-slate-700 px-3 py-2 text-center font-bold w-24 shadow-sm">RIWAYAT / BUKTI</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody" class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($studentsData as $idx => $data)
                    <tr class="student-table-row hover:bg-sky-50 dark:hover:bg-slate-800 transition-colors cursor-pointer text-slate-700 dark:text-slate-300"
                        data-name="{{ strtolower($data->student->nama) }}" 
                        data-nis="{{ strtolower($data->student->nis) }}"
                        data-lock-count="{{ $data->total_lock }}">
                        
                        <!-- Row Number -->
                        <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5 text-center text-slate-400 bg-slate-50/50 dark:bg-slate-900/50">
                            {{ $idx + 1 }}
                        </td>

                        <!-- Student Profile -->
                        <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5">
                            <span class="font-bold text-slate-800 dark:text-white">{{ $data->student->nama }}</span>
                            <span class="font-mono text-[10px] font-semibold text-slate-400 dark:text-slate-500 ml-2 block sm:inline">NIS. {{ $data->student->nis }}</span>
                        </td>
                        
                        <!-- Total Terkena Lock -->
                        <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5 text-center">
                            @if($data->total_lock >= 3)
                                <span class="bg-rose-50 text-rose-600 border border-rose-100 rounded px-2 py-0.5 text-[10px] font-black font-mono inline-block dark:bg-rose-950/20 dark:text-rose-450 dark:border-rose-900/30">
                                    {{ $data->total_lock }} KALI
                                </span>
                            @elseif($data->total_lock > 0)
                                <span class="bg-amber-50 text-amber-600 border border-amber-100 rounded px-2 py-0.5 text-[10px] font-black font-mono inline-block dark:bg-amber-950/20 dark:text-amber-450 dark:border-amber-900/30">
                                    {{ $data->total_lock }} KALI
                                </span>
                            @else
                                <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 rounded px-2 py-0.5 text-[10px] font-black font-mono inline-block dark:bg-emerald-950/20 dark:text-emerald-450 dark:border-emerald-900/30">
                                    {{ $data->total_lock }} KALI
                                </span>
                            @endif
                        </td>
                        
                        <!-- Status Terakhir -->
                        <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5">
                            <span class="font-bold text-[11px] block {{ $data->status_color_class }}">
                                {{ $data->status_label }}
                            </span>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 block mt-0.5 truncate max-w-xs">
                                {{ $data->status_subtext }}
                            </span>
                        </td>
                        
                        <!-- Actions / Riwayat / Bukti -->
                        <td class="border border-slate-300 dark:border-slate-700 px-3 py-1.5 text-center bg-slate-50/30 dark:bg-slate-900/30">
                            @if($data->appeals_history->isNotEmpty())
                                <button onclick="openHistoryModal({{ json_encode($data->student) }}, {{ json_encode($data->appeals_history) }})" 
                                        class="text-slate-500 hover:text-[#D65A20] dark:text-slate-400 dark:hover:text-[#D65A20] p-1 transition" title="Lihat Bukti">
                                    <i class="far fa-file-alt"></i>
                                </button>
                            @else
                                <span class="text-slate-300 dark:text-slate-650" title="Tidak ada data">
                                    <i class="fas fa-minus text-[10px]"></i>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="border border-slate-300 dark:border-slate-700 px-3 py-8 text-center text-slate-400 font-medium">Belum ada data siswa di kelas ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <div class="bg-slate-50 dark:bg-slate-950/20 border-t border-slate-100 dark:border-slate-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <span id="entriesInfo">Menampilkan 1 hingga {{ $studentsData->count() }} dari {{ $studentsData->count() }} siswa</span>
            <div class="flex gap-1.5" id="paginationControls">
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-450 hover:bg-slate-50 cursor-not-allowed text-[11px]" disabled>&lt;</button>
                <button class="px-3 py-1.5 rounded-lg bg-[#D65A20] text-white font-extrabold text-[11px]">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-450 hover:bg-slate-50 cursor-not-allowed text-[11px]" disabled>&gt;</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Bukti Banding Timeline -->
<div id="appealsHistoryModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300" onclick="closeHistoryModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 rounded-2xl max-w-xl w-full mx-4 p-6 shadow-2xl border border-slate-100 dark:border-slate-800 transform transition-all duration-300 scale-95 opacity-0 overflow-hidden flex flex-col max-h-[85vh]" id="modalContent" style="z-index: 51;">
        <!-- Modal Header -->
        <div class="flex justify-between items-start border-b border-slate-100 dark:border-slate-800 pb-4 mb-4">
            <div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white" id="mName">Riwayat Banding Siswa</h3>
                <p class="text-xs font-mono font-bold text-orange-600 mt-0.5" id="mNis">NIS. -</p>
            </div>
            <button onclick="closeHistoryModal()" class="text-slate-400 hover:text-slate-650 transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <!-- Modal Scrollable Body -->
        <div class="overflow-y-auto pr-1 flex-1 space-y-4" id="appealsTimeline">
            <!-- Dynamic elements loaded via JS -->
        </div>
        
        <!-- Modal Footer -->
        <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button onclick="closeHistoryModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
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
        document.getElementById('mNis').textContent = 'NIS. ' + student.nis;
        
        // Render history timeline
        const timeline = document.getElementById('appealsTimeline');
        timeline.innerHTML = '';
        
        history.forEach((appeal, index) => {
            const courseName = appeal.subject && appeal.subject.course ? appeal.subject.course.nama : 'Umum';
            const teacherName = appeal.approver && appeal.approver.guru ? appeal.approver.guru.nama : 'Guru Mata Pelajaran';
            
            // Format dates
            const createdDate = new Date(appeal.created_at);
            const dateFormatted = createdDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) + ' ' + createdDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
            
            // Status markup
            let statusBadge = '';
            if (appeal.status === 'approved') {
                statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xxs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-950/20 dark:text-emerald-400">Disetujui</span>';
            } else if (appeal.status === 'rejected') {
                statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xxs font-extrabold bg-rose-50 text-rose-700 border border-rose-100 dark:bg-rose-950/20 dark:text-rose-450">Ditolak</span>';
            } else {
                statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xxs font-extrabold bg-amber-50 text-amber-700 border border-amber-100 dark:bg-amber-950/20 dark:text-amber-455">Menunggu</span>';
            }

            // File Proof section
            let proofSection = '';
            if (appeal.bukti_pendukung) {
                proofSection = `
                    <div class="mt-2.5 flex items-center justify-between p-2.5 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-2 min-w-0">
                            <i class="far fa-file-pdf text-[#D65A20] text-sm flex-shrink-0"></i>
                            <span class="text-xxs font-bold text-slate-500 dark:text-slate-400 truncate">Surat Keterangan Pendukung</span>
                        </div>
                        <a href="/storage/${appeal.bukti_pendukung}" target="_blank" class="text-xxs font-bold text-[#D65A20] hover:text-[#b04513] transition flex-shrink-0">Lihat Surat</a>
                    </div>
                `;
            }

            // Teacher response section
            let responseSection = '';
            if (appeal.tanggapan_guru) {
                responseSection = `
                    <div class="mt-2.5 bg-slate-50 dark:bg-slate-950/40 p-3 rounded-xl border border-slate-100 dark:border-slate-850">
                        <span class="text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-wider block">Catatan Guru (${teacherName})</span>
                        <p class="text-xxs font-medium text-slate-600 dark:text-slate-350 mt-1 leading-relaxed">"${appeal.tanggapan_guru}"</p>
                    </div>
                `;
            }

            const item = document.createElement('div');
            item.className = 'border border-slate-100 dark:border-slate-800 p-4 rounded-xl space-y-2 relative bg-white dark:bg-slate-900 shadow-sm';
            item.innerHTML = `
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <h4 class="font-extrabold text-slate-800 dark:text-white text-xs">${courseName}</h4>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 block mt-0.5">${dateFormatted}</span>
                    </div>
                    ${statusBadge}
                </div>
                <div class="bg-slate-50/50 dark:bg-slate-800/20 p-3 rounded-xl border border-slate-100/50 dark:border-slate-800/40 text-xxs leading-relaxed italic text-slate-500 dark:text-slate-400">
                    "${appeal.alasan || 'Tidak ada alasan'}"
                </div>
                ${proofSection}
                ${responseSection}
            `;
            timeline.appendChild(item);
        });

        modal.classList.remove('hidden');
        modal.offsetHeight; // force reflow
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
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
