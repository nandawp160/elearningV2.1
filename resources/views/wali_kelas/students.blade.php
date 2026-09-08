@extends('layouts.app')

@section('title', 'Data Peserta Didik')

@section('content')
<div class="space-y-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-950 dark:text-white tracking-tight">Buku Induk Kelas {{ $classRoom->name }}</h1>
                <p class="text-slate-700 dark:text-slate-300 text-sm font-medium mt-1">Daftar lengkap data demografi dan kontak darurat peserta didik perwalian Anda.</p>
            </div>
        </div>
    </div>

    <!-- 3 Stat Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
        <!-- Card 1: Total Peserta Didik -->
        <div class="bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 flex items-center gap-4 transition hover:shadow-md">
            <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-950/60 text-blue-900 dark:text-blue-300 flex items-center justify-center text-xl shadow-xs shrink-0">
                <i class="fas fa-users"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider block truncate">Total Peserta Didik</span>
                <span class="text-2xl font-black text-slate-950 dark:text-white block mt-0.5 truncate">{{ $students->count() }} <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Siswa</span></span>
            </div>
        </div>

        <!-- Card 2: Laki-Laki -->
        <div class="bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 flex items-center gap-4 transition hover:shadow-md">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-900 dark:text-emerald-300 flex items-center justify-center text-xl shadow-xs shrink-0">
                <i class="fas fa-mars"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider block truncate">Laki-Laki</span>
                <span class="text-2xl font-black text-slate-950 dark:text-white block mt-0.5 truncate">{{ $students->where('jenis_kelamin', 'Laki-laki')->count() }} <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Siswa</span></span>
            </div>
        </div>

        <!-- Card 3: Perempuan -->
        <div class="bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 flex items-center gap-4 transition hover:shadow-md">
            <div class="w-12 h-12 rounded-xl bg-rose-100 dark:bg-rose-950/60 text-rose-900 dark:text-rose-300 flex items-center justify-center text-xl shadow-xs shrink-0">
                <i class="fas fa-venus"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider block truncate">Perempuan</span>
                <span class="text-2xl font-black text-slate-950 dark:text-white block mt-0.5 truncate">{{ $students->where('jenis_kelamin', 'Perempuan')->count() }} <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Siswa</span></span>
            </div>
        </div>
    </div>

    <!-- Search & Export Action Bar -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row justify-between items-center gap-4 shadow-sm">
        <div class="relative w-full sm:max-w-md">
            <input type="text" id="studentSearchInput" placeholder="Cari NIS atau Nama Lengkap..." 
                   class="w-full rounded-xl border-2 border-slate-300 pl-10 pr-4 py-2.5 text-xs font-semibold text-slate-900 placeholder:text-slate-500 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-950 dark:border-slate-700 dark:text-slate-100">
            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-700 dark:text-slate-300">
                <i class="fas fa-search text-xs"></i>
            </div>
        </div>
        
        <button onclick="exportToCSV()" class="w-full sm:w-auto bg-[#D65A20] hover:bg-[#be4e1a] text-white font-extrabold px-5 py-2.5 rounded-xl shadow-md shadow-orange-500/15 transition flex items-center justify-center gap-2 text-xs">
            <i class="fas fa-file-export text-xs"></i>
            <span>Ekspor Data (CSV)</span>
        </button>
    </div>

    <!-- Student Table Card -->
    <div class="bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto overflow-y-auto" style="max-height: 620px;">
            <table class="w-full border-collapse text-xs" id="studentTable">
                <thead class="sticky top-0 z-10">
                    <tr class="bg-slate-100 dark:bg-slate-800 text-slate-950 dark:text-white border-b-2 border-slate-300 dark:border-slate-700">
                        <th class="px-4 py-3.5 text-center font-black w-14 uppercase tracking-wider text-xs">NO</th>
                        <th class="px-4 py-3.5 text-left font-black w-32 uppercase tracking-wider text-xs">NIS</th>
                        <th class="px-5 py-3.5 text-left font-black min-w-72 uppercase tracking-wider text-xs">NAMA LENGKAP & EMAIL</th>
                        <th class="px-4 py-3.5 text-center font-black w-20 uppercase tracking-wider text-xs">L/P</th>
                        <th class="px-5 py-3.5 text-left font-black min-w-56 uppercase tracking-wider text-xs">KONTAK WALI (ORTU)</th>
                        <th class="px-4 py-3.5 text-center font-black w-28 uppercase tracking-wider text-xs">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($students as $idx => $student)
                    @php
                        $email = $student->user->email ?? (strtolower(str_replace(' ', '', $student->name)) . '@siswa.smansago.com');
                    @endphp
                    <tr class="student-table-row hover:bg-orange-50/40 dark:hover:bg-slate-800/50 transition-colors cursor-pointer text-slate-900 dark:text-slate-100"
                        onclick="if(!event.target.closest('button') && !event.target.closest('a')) openDetailModal({{ json_encode($student) }})">
                        <!-- Row Number -->
                        <td class="px-4 py-3.5 text-center text-slate-900 dark:text-slate-200 font-extrabold text-xs">
                            {{ $idx + 1 }}
                        </td>

                        <!-- NIS -->
                        <td class="px-4 py-3.5">
                            @if($student->nis)
                                <span class="font-mono font-black text-xs text-slate-950 dark:text-slate-100 bg-slate-200 dark:bg-slate-800 px-2.5 py-1 rounded-md border border-slate-300 dark:border-slate-600">
                                    {{ $student->nis }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-950 border border-amber-300 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800">
                                    Belum diisi
                                </span>
                            @endif
                        </td>
                        
                        <!-- Name & Email -->
                        <td class="px-5 py-3.5">
                            <div class="flex flex-col">
                                <span class="font-black text-sm text-slate-950 dark:text-white leading-snug hover:text-[#D65A20] transition-colors">
                                    {{ $student->name }}
                                </span>
                                <div class="flex items-center gap-1.5 text-xs text-slate-800 dark:text-slate-200 font-medium mt-1">
                                    <i class="fas fa-envelope text-slate-700 dark:text-slate-300 text-xs shrink-0"></i>
                                    <span class="font-mono font-bold text-slate-800 dark:text-slate-200 select-all">{{ $email }}</span>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Gender (L/P) -->
                        <td class="px-4 py-3.5 text-center">
                            @if(in_array($student->jenis_kelamin, ['L', 'Laki-laki']))
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-black bg-blue-100 text-blue-950 border-2 border-blue-300 dark:bg-blue-950 dark:text-blue-200 dark:border-blue-700 shadow-2xs" title="Laki-laki">
                                    L
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-black bg-rose-100 text-rose-950 border-2 border-rose-300 dark:bg-rose-950 dark:text-rose-200 dark:border-rose-700 shadow-2xs" title="Perempuan">
                                    P
                                </span>
                            @endif
                        </td>
                        
                        <!-- Guardian Contact -->
                        <td class="px-5 py-3.5">
                            @if($student->parent_phone)
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-phone-alt text-xs text-emerald-700 dark:text-emerald-400 shrink-0"></i>
                                        <span class="font-mono font-black text-xs text-slate-950 dark:text-white select-all">{{ $student->parent_phone }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs text-slate-800 dark:text-slate-200 font-semibold">
                                        <i class="fas fa-user text-xs text-slate-700 dark:text-slate-300 shrink-0"></i>
                                        <span>{{ $student->parent_name ?: 'Orang Tua / Wali' }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col gap-0.5">
                                    <div class="flex items-center gap-1.5 text-xs text-slate-700 dark:text-slate-300 font-bold">
                                        <i class="fas fa-phone-slash text-xs text-slate-600 dark:text-slate-400 shrink-0"></i>
                                        <span>Belum ada nomor HP</span>
                                    </div>
                                    <div class="text-xs text-slate-700 dark:text-slate-300 font-medium">
                                        <span>{{ $student->parent_name ? '(' . $student->parent_name . ')' : '(Orang Tua / Wali)' }}</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-4 py-3.5 text-center">
                            <button onclick="openDetailModal({{ json_encode($student) }})" 
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#D65A20] hover:bg-[#be4e1a] text-white font-extrabold text-xs shadow-sm transition" 
                                    title="Lihat Detail Siswa">
                                <i class="fas fa-id-card text-xs"></i>
                                <span>Detail</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-slate-700 dark:text-slate-300 font-bold">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i class="fas fa-user-slash text-3xl text-slate-400"></i>
                                <span>Belum ada data siswa di kelas ini.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <div class="bg-slate-100 dark:bg-slate-950/40 border-t-2 border-slate-200 dark:border-slate-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-bold text-slate-800 dark:text-slate-200">
            <span id="entriesInfo">Menampilkan 1 hingga {{ $students->count() }} dari {{ $students->count() }} peserta didik</span>
            <div class="flex gap-1.5" id="paginationControls">
                <button class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-400 hover:bg-slate-50 cursor-not-allowed text-xs font-bold" disabled>&lt;</button>
                <button class="px-3.5 py-1.5 rounded-lg bg-[#D65A20] text-white font-black text-xs">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-400 hover:bg-slate-50 cursor-not-allowed text-xs font-bold" disabled>&gt;</button>
            </div>
        </div>
    </div>

    <!-- Sync Notice Footer -->
    <div class="p-4 bg-slate-100 border border-slate-200 dark:bg-slate-800/60 dark:border-slate-700 rounded-xl flex gap-3">
        <i class="fas fa-lock text-slate-700 dark:text-slate-300 mt-0.5 text-base shrink-0"></i>
        <p class="text-xs font-bold text-slate-800 dark:text-slate-200 leading-relaxed">
            Data tersinkronisasi otomatis dengan server utama (Admin). Wali Kelas berstatus hak akses pemantauan (<span class="text-[#D65A20] font-black">Read-Only</span>).
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
        <div class="space-y-4 text-slate-900 dark:text-slate-100 text-xs">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Jenis Kelamin</label>
                    <p class="font-black text-sm text-slate-950 dark:text-white" id="mGender">-</p>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Status Keanggotaan</label>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-100 text-emerald-950 border border-emerald-300 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800 font-black text-xs">Aktif</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 border-t border-slate-200 dark:border-slate-800 pt-3">
                <div>
                    <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Nama Orang Tua/Wali</label>
                    <p class="font-black text-sm text-slate-950 dark:text-white" id="mParentName">-</p>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Nomor Telepon Wali</label>
                    <div class="flex items-center gap-2">
                        <p class="font-mono font-black text-sm text-slate-950 dark:text-white" id="mParentPhone">-</p>
                        <a href="" id="mWaLink" target="_blank" class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center hover:bg-emerald-200 transition border border-emerald-300" title="Hubungi via WhatsApp">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-200 dark:border-slate-800 pt-3">
                <label class="block text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Alamat Rumah</label>
                <p class="font-bold text-sm text-slate-900 dark:text-slate-200 leading-relaxed" id="mAddress">-</p>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button onclick="closeDetailModal()" class="px-5 py-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-xs font-black text-slate-950 dark:text-white transition">
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
            const nis = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
            const nameAndEmail = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
            
            if (nis.includes(query) || nameAndEmail.includes(query)) {
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
        
        // Headers
        csvContent += '"NO","NIS","NAMA LENGKAP","EMAIL","JENIS KELAMIN","NO HP WALI","NAMA WALI"\r\n';
        
        // Fetch data
        for (let i = 1; i < rows.length; i++) {
            const cols = rows[i].querySelectorAll('td');
            if (cols.length < 6) continue;
            
            const no = cols[0].textContent.trim();
            const nis = cols[1].textContent.trim();
            const name = cols[2].querySelector('span:first-child')?.textContent.trim() || '';
            const email = cols[2].querySelector('span.select-all')?.textContent.trim() || '';
            const gender = cols[3].textContent.trim();
            const parentPhone = cols[4].querySelector('span.select-all')?.textContent.trim() || '-';
            const parentName = cols[4].querySelector('.text-slate-500 span, .text-slate-400 span')?.textContent.trim() || '-';
            
            csvContent += `"${no}","${nis}","${name}","${email}","${gender}","${parentPhone}","${parentName}"\r\n`;
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
