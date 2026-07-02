@extends('layouts.app')

@section('title', 'Detail Kelas: ' . $classroom->name)

@section('content')
<div class="space-y-6">
    <!-- Toast Notification -->
    @if(session('success'))
    <div class="glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
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
    <div class="glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
        <div class="flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-lg"></i>
            <span class="font-semibold text-sm">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-rose-700/70 hover:text-rose-700 transition">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Page Header & Stats Summary -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2.5">
                    <span class="bg-orange-50 text-[#D65A20] border border-orange-100 text-xs font-semibold px-2.5 py-1 rounded-lg">Kelas {{ $classroom->tingkat }}</span>
                    <span class="bg-sky-50 text-sky-700 border border-sky-100 text-xs font-semibold px-2.5 py-1 rounded-lg">{{ $classroom->jurusan }}</span>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">{{ $classroom->name }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tahun Ajaran {{ $classroom->tahunAjaran }}</p>
            </div>
            
            <div class="flex items-center gap-2.5 self-start md:self-auto">
                @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                <a href="{{ route('classrooms.edit', $classroom) }}" class="btn border border-blue-200 bg-white hover:bg-blue-50 text-blue-600 dark:border-slate-700 dark:text-blue-400 font-semibold px-4 py-2.5 rounded-xl text-xs transition flex items-center gap-2">
                    <i class="fas fa-edit text-xs"></i>
                    <span>Edit Kelas</span>
                </a>
                @endif
                <a href="{{ route('classrooms.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2.5 rounded-xl text-xs transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Total Siswa -->
            <div class="stat-card border-l-4 border-l-[#D65A20] bg-slate-50 dark:bg-slate-900/50 p-4.5 rounded-xl flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xxs font-bold text-slate-400 uppercase tracking-wider">Total Siswa Terdaftar</p>
                    <p class="text-xl font-bold text-slate-800 dark:text-white mt-1">{{ $classroom->siswa_count ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#D65A20] flex items-center justify-center text-md">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>

            <!-- Kapasitas -->
            <div class="stat-card border-l-4 border-l-[#00B074] bg-slate-50 dark:bg-slate-900/50 p-4.5 rounded-xl flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xxs font-bold text-slate-400 uppercase tracking-wider">Kapasitas Maksimal</p>
                    <p class="text-xl font-bold text-slate-800 dark:text-white mt-1">{{ $classroom->kapasitasMaksimal }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#00B074] flex items-center justify-center text-md">
                    <i class="fas fa-users-cog"></i>
                </div>
            </div>

            <!-- Pemakaian -->
            @php $usage = ($classroom->max_students > 0) ? (($classroom->siswa_count ?? 0) / $classroom->max_students) * 100 : 0; @endphp
            <div class="stat-card border-l-4 border-l-sky-500 bg-slate-50 dark:bg-slate-900/50 p-4.5 rounded-xl flex justify-between items-center border border-slate-100 dark:border-slate-800">
                <div>
                    <p class="text-xxs font-bold text-slate-400 uppercase tracking-wider">Persentase Pemakaian</p>
                    <p class="text-xl font-bold text-sky-600 mt-1">{{ round($usage) }}%</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-md">
                    <i class="fas fa-chart-pie"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Student List -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
                <!-- Header -->
                <div class="p-6 border-b border-slate-100 dark:border-slate-800/60 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Siswa</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Siswa yang terdaftar di kelas ini</p>
                    </div>
                    
                    <div class="flex items-center gap-2.5">
                        <span class="bg-slate-100 text-slate-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ count($classroom->daftarSiswa ?? []) }} Siswa</span>
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                        <button onclick="openEnrollModal()" class="bg-[#D65A20] hover:bg-[#be4e1a] text-white px-3.5 py-2 rounded-xl transition font-bold text-xs flex items-center gap-2 shadow-md shadow-orange-500/10">
                            <i class="fas fa-user-plus text-xs"></i>
                            <span>Tambah Siswa</span>
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto max-h-[500px] overflow-y-auto relative">
                    <table class="w-full">
                        <thead class="sticky top-0 z-10 shadow-sm bg-white dark:bg-slate-900">
                            <tr class="bg-slate-50/50 dark:bg-slate-900/30 border-b border-slate-100 dark:border-slate-800">
                                <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xxs uppercase tracking-wider">Nama / NIS</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xxs uppercase tracking-wider">Tanggal Masuk</th>
                                <th class="px-6 py-4 text-center font-semibold text-slate-500 text-xxs uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right font-semibold text-slate-500 text-xxs uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classroom->daftarSiswa as $student)
                            <tr class="hover:bg-slate-50/40 dark:hover:bg-slate-800/30 transition border-b border-slate-100 dark:border-slate-800">
                                <!-- Student Name / NIS -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-orange-50 text-[#D65A20] flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($student->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 dark:text-slate-100 block text-sm">{{ $student->nama }}</span>
                                            <span class="text-xs text-slate-400 block">{{ $student->nis }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Entry Date -->
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($student->created_at)->format('d M Y') }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        {{ strtoupper($student->status) }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('students.show', $student->id) }}" class="px-3 py-1.5 text-xs font-semibold text-slate-600 hover:text-white border border-slate-200 hover:border-slate-800 bg-white hover:bg-slate-800 rounded-lg transition" title="Lihat Detail">
                                            <i class="fas fa-chevron-right text-xxs"></i>
                                        </a>
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
                                        <form action="{{ route('classrooms.unenroll', [$classroom, $student->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengeluarkan siswa ini dari kelas?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 hover:text-white border border-red-200 hover:border-red-600 bg-white hover:bg-red-600 rounded-lg transition" title="Keluarkan dari kelas">
                                                <i class="fas fa-sign-out-alt text-xxs"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i class="fas fa-users text-4xl text-slate-200 mb-2"></i>
                                        <span class="font-semibold text-slate-500">Belum ada siswa terdaftar</span>
                                        <span class="text-xs text-slate-400">Gunakan tombol "Tambah Siswa" untuk menambahkan siswa ke kelas ini.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar info -->
        <div class="space-y-6">
            <!-- Homeroom Profile -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-100 dark:border-slate-800/60 pb-3">Profil Wali Kelas</h4>
                
                @if($classroom->waliKelas)
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#D65A20] flex items-center justify-center font-bold text-lg">
                                {{ strtoupper(substr($classroom->waliKelas->name, 0, 1)) }}
                            </div>
                            <div>
                                <span class="font-bold text-slate-800 dark:text-slate-100 block text-sm">{{ $classroom->waliKelas->name }}</span>
                                <span class="text-xs text-slate-400 block">NIP. {{ $classroom->waliKelas->nip ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="space-y-2 pt-2 border-t border-slate-100 dark:border-slate-800/60 text-xs text-slate-600 dark:text-slate-400">
                            <div class="flex items-center gap-2.5">
                                <i class="fas fa-phone-alt text-slate-400 w-4"></i>
                                <span>{{ $classroom->waliKelas->phone ?? '-' }}</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <i class="fas fa-envelope text-slate-400 w-4"></i>
                                <span class="truncate">{{ $classroom->waliKelas->email ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="py-4 text-center">
                        <i class="fas fa-chalkboard-teacher text-3xl text-slate-200 mb-2"></i>
                        <p class="text-xs text-slate-400 italic">Belum ditentukan wali kelas.</p>
                    </div>
                @endif
            </div>

            <!-- Academic Info & Pengajar Summary (Side by side) -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Academic Info -->
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-4">
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3 border-b border-slate-100 dark:border-slate-800/60 pb-2">Info Akademik</h4>
                    <div class="space-y-2.5 text-[11px]">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-slate-500">Kurikulum</span>
                            <span class="font-bold text-slate-800 dark:text-slate-100">Kelas {{ $classroom->tingkat }}</span>
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-slate-500">Jurusan</span>
                            <span class="font-bold text-slate-800 dark:text-slate-100">{{ $classroom->jurusan }}</span>
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-slate-500">T.A.</span>
                            <span class="font-bold text-slate-800 dark:text-slate-100">{{ $classroom->tahunAjaran }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Daftar Pengajar Summary -->
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-4 flex flex-col justify-center items-center text-center">
                    <div class="w-10 h-10 bg-orange-50 dark:bg-slate-800 text-[#D65A20] rounded-full flex items-center justify-center text-lg mb-2 shadow-inner">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4 class="text-xs font-bold text-slate-800 dark:text-white mb-0.5">Pengajar</h4>
                    <p class="text-[10px] text-slate-400 mb-3">{{ count($pengajar ?? []) }} Guru Diplot</p>
                    
                    <button onclick="openPengajarModal()" class="w-full mt-auto bg-slate-50 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 px-2 py-2 rounded-lg text-[10px] font-bold transition flex items-center justify-center gap-1.5">
                        <i class="fas fa-list-ul"></i> Lihat Detail
                    </button>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- ==========================================
      MODAL POPUP: ENROLL / TAMBAH SISWA
     ========================================== -->
@if(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('admin'))
<div id="enrollStudentModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-start">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Siswa ke Kelas</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5">Pilih siswa yang belum terdaftar di kelas manapun.</p>
            </div>
            <button onclick="closeEnrollModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-md"></i>
            </button>
        </div>
        
        <!-- Form -->
        <form action="{{ route('classrooms.enroll', $classroom) }}" method="POST" class="p-6 space-y-5" @submit="if(!document.getElementById('student_id_input').value) { alert('Silakan pilih siswa terlebih dahulu.'); $event.preventDefault(); }">
            @csrf
            
            <div class="mb-4">
                <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pilih Siswa *</label>
                <div x-data="{
                        search: '',
                        open: false,
                        selectedId: '',
                        selectedName: 'Cari nama siswa...',
                        students: [
                            @foreach($availableStudents as $student)
                                { id: '{{ $student->id }}', name: '{{ addslashes($student->nama) }} [NIS. {{ $student->nis }}]' },
                            @endforeach
                        ],
                        get filteredStudents() {
                            if (this.search === '') {
                                return this.students;
                            }
                            return this.students.filter(student => student.name.toLowerCase().includes(this.search.toLowerCase()));
                        },
                        selectStudent(student) {
                            this.selectedId = student.id;
                            this.selectedName = student.name;
                            this.open = false;
                            this.search = '';
                        }
                    }" 
                    class="relative"
                    @click.away="open = false">
                    
                    <!-- Hidden Input for Form Submission -->
                    <input type="hidden" name="student_id" x-model="selectedId" id="student_id_input">
                    
                    <!-- Custom Select Trigger -->
                    <div @click="open = !open" 
                         class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-700 focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 cursor-pointer flex justify-between items-center transition">
                        <span x-text="selectedName" :class="{ 'text-slate-400': selectedId === '' }"></span>
                        <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute z-50 w-full mt-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden"
                         style="display: none;">
                        
                        <!-- Search Box -->
                        <div class="p-2 border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input x-model="search" type="text" placeholder="Ketik nama atau NIS..." class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 pl-8 pr-3 py-2 text-xs focus:ring-1 focus:ring-[#D65A20] focus:border-[#D65A20] text-slate-700 dark:text-slate-200 outline-none" @keydown.escape="open = false" @click.stop>
                            </div>
                        </div>
                        
                        <!-- Options List -->
                        <ul class="max-h-56 overflow-y-auto py-1">
                            <template x-for="student in filteredStudents" :key="student.id">
                                <li @click="selectStudent(student)" class="px-4 py-2.5 hover:bg-orange-50 dark:hover:bg-slate-800 cursor-pointer text-xs text-slate-700 dark:text-slate-200 flex justify-between items-center transition-colors">
                                    <span x-text="student.name"></span>
                                    <i x-show="selectedId === student.id" class="fas fa-check text-[#D65A20] text-[10px]"></i>
                                </li>
                            </template>
                            <li x-show="filteredStudents.length === 0" class="px-4 py-4 text-center text-xs text-slate-400 flex flex-col items-center gap-2">
                                <i class="fas fa-inbox text-lg text-slate-300"></i>
                                <span>Tidak ada siswa ditemukan</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @error('student_id')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="button" onclick="closeEnrollModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-4 py-2 rounded-xl text-xs transition">Batal</button>
                <button type="submit" class="btn font-bold px-5 py-2 rounded-xl shadow-lg shadow-orange-500/10 text-xs text-white transition bg-[#D65A20] hover:bg-[#be4e1a]">Daftarkan</button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- ==========================================
      MODAL POPUP: DAFTAR PENGAJAR
     ========================================== -->
<div id="modalDaftarPengajar" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl w-full max-w-md overflow-hidden mx-4 animate-scale-up border border-slate-100 dark:border-slate-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-start">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Pengajar</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5">Guru yang mengajar di kelas ini</p>
            </div>
            <button onclick="closePengajarModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition p-1">
                <i class="fas fa-times text-md"></i>
            </button>
        </div>
        
        <!-- Content -->
        <div class="p-6">
            @if(isset($pengajar) && count($pengajar) > 0)
                <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                    @foreach($pengajar as $plot)
                        <div class="flex items-start gap-3 pb-3 border-b border-slate-50 dark:border-slate-800/50 last:border-0 last:pb-0">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-slate-800 text-[#D65A20] flex items-center justify-center font-bold text-sm shrink-0 mt-0.5 border border-orange-100 dark:border-slate-700">
                                {{ strtoupper(substr($plot->guru->nama ?? '?', 0, 1)) }}
                            </div>
                            <div class="overflow-hidden text-ellipsis flex-1">
                                <span class="font-bold text-slate-800 dark:text-slate-100 block text-sm truncate" title="{{ $plot->guru->nama ?? '-' }}">
                                    {{ $plot->guru->nama ?? '-' }}
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block truncate mt-0.5" title="{{ $plot->subject->nama ?? '-' }}">
                                    <i class="fas fa-book mr-1 text-[10px]"></i>{{ $plot->subject->nama ?? '-' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-6 text-center">
                    <i class="fas fa-user-slash text-3xl text-slate-200 mb-3"></i>
                    <p class="text-sm text-slate-400 italic">Belum ada pengajar diplot.</p>
                </div>
            @endif
        </div>
        
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30 flex justify-end">
            <button type="button" onclick="closePengajarModal()" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 font-semibold px-5 py-2 rounded-xl text-xs transition">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openEnrollModal() {
        $('#enrollStudentModal').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closeEnrollModal() {
        $('#enrollStudentModal').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }
    
    function openPengajarModal() {
        $('#modalDaftarPengajar').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closePengajarModal() {
        $('#modalDaftarPengajar').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }
</script>
@endpush
@endsection
