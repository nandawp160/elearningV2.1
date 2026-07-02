@extends('layouts.app')

@section('title', 'Data Peserta Didik')

@section('content')
<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Buku Induk Kelas {{ $classRoom->name }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar lengkap data demografi dan kontak darurat peserta didik perwalian Anda.</p>
            </div>
        </div>
    </div>

    <!-- 3 Stat Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
        <!-- Card 1: Total Peserta Didik -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-xl p-4 sm:p-5 flex items-center gap-3 sm:gap-4 transition hover:shadow-md">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-sky-50 dark:bg-sky-950/30 text-sky-600 dark:text-sky-400 flex items-center justify-center text-lg sm:text-xl shadow-inner flex-shrink-0">
                <i class="fas fa-users"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[10px] sm:text-xxs font-extrabold text-slate-400 uppercase tracking-wider block truncate">Total Peserta Didik</span>
                <span class="text-lg sm:text-xl font-black text-slate-800 dark:text-white block mt-0.5 truncate">{{ $students->count() }} <span class="text-xs font-semibold text-slate-450 dark:text-slate-500">Siswa</span></span>
            </div>
        </div>

        <!-- Card 2: Laki-Laki -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-xl p-4 sm:p-5 flex items-center gap-3 sm:gap-4 transition hover:shadow-md">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg sm:text-xl shadow-inner flex-shrink-0">
                <i class="fas fa-mars"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[10px] sm:text-xxs font-extrabold text-slate-400 uppercase tracking-wider block truncate">Laki-Laki</span>
                <span class="text-lg sm:text-xl font-black text-slate-800 dark:text-white block mt-0.5 truncate">{{ $students->where('jenis_kelamin', 'Laki-laki')->count() }} <span class="text-xs font-semibold text-slate-450 dark:text-slate-500">Siswa</span></span>
            </div>
        </div>

        <!-- Card 3: Perempuan -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm rounded-xl p-4 sm:p-5 flex items-center gap-3 sm:gap-4 transition hover:shadow-md">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 flex items-center justify-center text-lg sm:text-xl shadow-inner flex-shrink-0">
                <i class="fas fa-venus"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[10px] sm:text-xxs font-extrabold text-slate-400 uppercase tracking-wider block truncate">Perempuan</span>
                <span class="text-lg sm:text-xl font-black text-slate-800 dark:text-white block mt-0.5 truncate">{{ $students->where('jenis_kelamin', 'Perempuan')->count() }} <span class="text-xs font-semibold text-slate-450 dark:text-slate-500">Siswa</span></span>
            </div>
        </div>
    </div>

    <!-- Search & Export Action Bar -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm">
        <div class="relative w-full sm:max-w-md">
            <input type="text" id="studentSearchInput" placeholder="Cari NIS atau Nama Lengkap..." 
                   class="w-full rounded-xl border border-slate-200 pl-10 pr-4 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-100">
            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                <i class="fas fa-search text-xs"></i>
            </div>
        </div>
        
        <button onclick="exportToCSV()" class="w-full sm:w-auto bg-[#D65A20] hover:bg-[#be4e1a] text-white font-bold px-5 py-2.5 rounded-xl shadow-md shadow-orange-500/10 transition flex items-center justify-center gap-2 text-xs">
            <i class="fas fa-file-export text-xs"></i>
            <span>Ekspor Data</span>
        </button>
    </div>

    <!-- Student Table Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-ui w-full" id="studentTable">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">NIS</th>
                        <th class="px-6 py-4 text-left">Nama Lengkap</th>
                        <th class="px-6 py-4 text-left">L/P</th>
                        <th class="px-6 py-4 text-left">Kontak Wali (Ortu)</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr class="student-table-row hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition text-sm text-slate-700 dark:text-slate-350">
                        <!-- NIS -->
                        <td class="px-6 py-4 font-mono font-bold text-slate-400 dark:text-slate-600">
                            {{ $student->nis }}
                        </td>
                        
                        <!-- Name & Email -->
                        <td class="px-6 py-4">
                            <span class="font-extrabold text-slate-800 dark:text-white block">{{ $student->name }}</span>
                            <span class="text-xs text-slate-400 dark:text-slate-500 block mt-0.5">{{ $student->user->email ?? strtolower(str_replace(' ', '', $student->name)) . '@sekolah.id' }}</span>
                        </td>
                        
                        <!-- Gender (L/P) -->
                        <td class="px-6 py-4">
                            @if(in_array($student->jenis_kelamin, ['L', 'Laki-laki']))
                                <span class="bg-sky-50 text-sky-600 rounded px-2.5 py-1 text-xs font-black font-mono inline-block dark:bg-sky-950/20 dark:text-sky-400">
                                    L
                                </span>
                            @else
                                <span class="bg-rose-50 text-rose-600 rounded px-2.5 py-1 text-xs font-black font-mono inline-block dark:bg-rose-950/20 dark:text-rose-400">
                                    P
                                </span>
                            @endif
                        </td>
                        
                        <!-- Guardian Contact -->
                        <td class="px-6 py-4">
                            <span class="font-mono font-extrabold text-slate-800 dark:text-slate-300 block">
                                {{ $student->parent_phone ?: '-' }}
                            </span>
                            <span class="text-xs text-slate-400 dark:text-slate-500 block mt-0.5">
                                {{ $student->parent_name ?: 'Orang Tua' }}
                            </span>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 text-center">
                            <button onclick="openDetailModal({{ json_encode($student) }})" 
                                    class="border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-xl text-xs font-bold transition">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">Belum ada data siswa di kelas ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <div class="bg-slate-50 dark:bg-slate-950/20 border-t border-slate-100 dark:border-slate-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <span id="entriesInfo">Menampilkan 1 hingga {{ $students->count() }} dari {{ $students->count() }} peserta didik</span>
            <div class="flex gap-1.5" id="paginationControls">
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-450 hover:bg-slate-50 cursor-not-allowed text-[11px]" disabled>&lt;</button>
                <button class="px-3 py-1.5 rounded-lg bg-[#D65A20] text-white font-extrabold text-[11px]">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-450 hover:bg-slate-50 cursor-not-allowed text-[11px]" disabled>&gt;</button>
            </div>
        </div>
    </div>

    <!-- Sync Notice Footer -->
    <div class="p-4 bg-slate-50 border border-slate-100 dark:bg-slate-800/40 dark:border-slate-800 rounded-xl flex gap-3">
        <i class="fas fa-lock text-slate-400 mt-0.5 text-sm flex-shrink-0"></i>
        <p class="text-xxs font-semibold text-slate-500 dark:text-slate-400 leading-relaxed">
            Data tersinkronisasi otomatis dengan server utama (Admin). Wali Kelas berstatus hak akses pemantauan (<span class="text-[#D65A20] font-bold">Read-Only</span>).
        </p>
    </div>
</div>

<!-- Beautiful Details Modal -->
<div id="studentDetailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300" onclick="closeDetailModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white dark:bg-slate-900 rounded-2xl max-w-lg w-full mx-4 p-6 shadow-2xl border border-slate-100 dark:border-slate-800 transform transition-all duration-300 scale-95 opacity-0 overflow-hidden" id="modalContent" style="z-index: 51;">
        <!-- Modal Header -->
        <div class="flex justify-between items-start border-b border-slate-100 dark:border-slate-800 pb-4 mb-4">
            <div>
                <h3 class="text-lg font-black text-slate-800 dark:text-white" id="mName">Detail Profil Siswa</h3>
                <p class="text-xs font-mono font-bold text-teal-600 mt-0.5" id="mNis">NIS. -</p>
            </div>
            <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-650 transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <!-- Modal Details -->
        <div class="space-y-4 text-slate-700 dark:text-slate-350 text-xs">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xxs font-extrabold text-slate-450 uppercase tracking-wider mb-1">Jenis Kelamin</label>
                    <p class="font-bold text-slate-800 dark:text-white" id="mGender">-</p>
                </div>
                <div>
                    <label class="block text-xxs font-extrabold text-slate-450 uppercase tracking-wider mb-1">Status Keanggotaan</label>
                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-950/20 dark:text-emerald-400 dark:border-emerald-900/30 font-extrabold">Aktif</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 border-t border-slate-50 dark:border-slate-800/80 pt-3">
                <div>
                    <label class="block text-xxs font-extrabold text-slate-450 uppercase tracking-wider mb-1">Nama Orang Tua/Wali</label>
                    <p class="font-bold text-slate-800 dark:text-white" id="mParentName">-</p>
                </div>
                <div>
                    <label class="block text-xxs font-extrabold text-slate-450 uppercase tracking-wider mb-1">Nomor Telepon Wali</label>
                    <div class="flex items-center gap-2">
                        <p class="font-mono font-bold text-slate-800 dark:text-white" id="mParentPhone">-</p>
                        <a href="" id="mWaLink" target="_blank" class="w-6 h-6 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 transition shadow-inner">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-50 dark:border-slate-800/80 pt-3">
                <label class="block text-xxs font-extrabold text-slate-450 uppercase tracking-wider mb-1">Alamat Rumah</label>
                <p class="font-semibold text-slate-700 dark:text-slate-300 leading-relaxed" id="mAddress">-</p>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button onclick="closeDetailModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Search Functionality
    const searchInput = document.getElementById('studentSearchInput');
    const tableRows = document.querySelectorAll('.student-table-row');
    const entriesInfo = document.getElementById('entriesInfo');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        tableRows.forEach(row => {
            const nis = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            
            if (nis.includes(query) || name.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        entriesInfo.textContent = `Menampilkan 1 hingga ${visibleCount} dari ${tableRows.length} peserta didik`;
    });

    // Detail Modal Functionality
    function openDetailModal(student) {
        const modal = document.getElementById('studentDetailModal');
        const content = document.getElementById('modalContent');
        
        // Map details
        document.getElementById('mName').textContent = student.name || student.nama;
        document.getElementById('mNis').textContent = 'NIS. ' + (student.nis || '-');
        document.getElementById('mGender').textContent = student.gender || student.jenis_kelamin || '-';
        document.getElementById('mParentName').textContent = student.parent_name || student.nama_ortu || '-';
        
        const parentPhone = student.parent_phone || student.no_hp_ortu || '-';
        document.getElementById('mParentPhone').textContent = parentPhone;
        
        const waLink = document.getElementById('mWaLink');
        if (parentPhone !== '-') {
            const cleanPhone = parentPhone.replace(/[^0-9]/g, '');
            waLink.href = `https://wa.me/${cleanPhone}`;
            waLink.style.display = 'inline-flex';
        } else {
            waLink.style.display = 'none';
        }
        
        document.getElementById('mAddress').textContent = student.address || student.alamat || 'Alamat tidak tersedia.';

        modal.classList.remove('hidden');
        // Trigger repaint to trigger animation
        modal.offsetHeight;
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }

    function closeDetailModal() {
        const modal = document.getElementById('studentDetailModal');
        const content = document.getElementById('modalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // CSV Exporter
    function exportToCSV() {
        const table = document.getElementById('studentTable');
        const rows = table.querySelectorAll('tr');
        let csvContent = "data:text/csv;charset=utf-8,";
        
        // Fetch headers
        const headerCols = rows[0].querySelectorAll('th');
        let headerRow = [];
        for (let i = 0; i < headerCols.length - 1; i++) { // Skip actions column
            headerRow.push(`"${headerCols[i].textContent.trim()}"`);
        }
        csvContent += headerRow.join(",") + "\r\n";
        
        // Fetch data
        for (let i = 1; i < rows.length; i++) {
            const cols = rows[i].querySelectorAll('td');
            if (cols.length === 0) continue;
            
            let dataRow = [];
            
            // NIS
            dataRow.push(`"${cols[0].textContent.trim()}"`);
            
            // Name
            const nameEl = cols[1].querySelector('span:first-child');
            dataRow.push(`"${nameEl ? nameEl.textContent.trim() : cols[1].textContent.trim()}"`);
            
            // L/P
            dataRow.push(`"${cols[2].textContent.trim()}"`);
            
            // Phone
            const phoneEl = cols[3].querySelector('span:first-child');
            dataRow.push(`"${phoneEl ? phoneEl.textContent.trim() : cols[3].textContent.trim()}"`);
            
            csvContent += dataRow.join(",") + "\r\n";
        }
        
        // Trigger download
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "buku_induk_siswa_{{ strtolower(str_replace(' ', '_', $classRoom->name)) }}.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endsection
