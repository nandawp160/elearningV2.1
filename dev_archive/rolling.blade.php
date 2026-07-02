@extends('layouts.app')

@section('title', 'Rolling Kelas')

@section('content')
<!-- Toast Notification -->
@if(session('success'))
<div class="mb-6 glass p-4 border border-emerald-100 bg-emerald-50/70 text-emerald-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
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
<div class="mb-6 glass p-4 border border-rose-100 bg-rose-50/70 text-rose-700 flex items-center justify-between rounded-xl shadow-sm animate-fade-in">
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
    <!-- Page Header Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white tracking-tight">Rolling Kelas</h1>
                <p class="text-slate-500 text-sm mt-1">Lakukan pemindahan atau kenaikan kelas siswa secara bulk/massal.</p>
            </div>
            <a href="{{ route('classrooms.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700 font-semibold px-4 py-2.5 rounded-xl text-xs transition duration-150 flex items-center gap-2 self-start md:self-auto">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Kembali ke Data Kelas</span>
            </a>
        </div>
    </div>

    <!-- Dual Column Layout for Form Configurations -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Selector Box (Left Column: 1/3) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-5">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-4"><i class="fas fa-filter text-[#D65A20] mr-1.5"></i>Filter Sumber & Tujuan</h3>
                
                <!-- Filter Form (GET) -->
                <form id="filterForm" action="{{ route('rolling-kelas.index') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas Asal (Sumber)</label>
                        <div class="relative">
                            <select name="source_class" onchange="document.getElementById('filterForm').submit()" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold">
                                <option value="">-- Pilih Kelas Asal --</option>
                                @foreach($classrooms as $c)
                                    <option value="{{ $c->name }}" {{ $sourceClassname === $c->name ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->siswa_count }} Siswa)
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Processing Form (POST) -->
                <form action="{{ route('rolling-kelas.store') }}" method="POST" class="space-y-4 mt-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                    @csrf
                    
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas Baru (Tujuan)</label>
                        <div class="relative">
                            <select name="target_class" required class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-[#D65A20] focus:ring-2 focus:ring-[#D65A20]/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold">
                                <option value="">-- Pilih Kelas Tujuan --</option>
                                @foreach($classrooms as $c)
                                    @if($sourceClassname !== $c->name)
                                        <option value="{{ $c->name }}">{{ $c->name }} (T.A. {{ $c->tahunAjaran }})</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <i class="fas fa-chevron-down text-[10px]"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Inputs from checklist -->
                    <div id="hiddenCheckboxesContainer"></div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-[#D65A20] hover:bg-[#be4e1a] text-white font-bold py-2.5 rounded-xl shadow-lg shadow-orange-500/10 transition flex items-center justify-center gap-2 text-xs">
                            <i class="fas fa-exchange-alt"></i>
                            <span>Lakukan Rolling Kelas</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Student Checklist Table (Right Column: 2/3) -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800 mb-4">
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><i class="fas fa-users text-[#D65A20] mr-1.5"></i>Daftar Siswa Kelas Asal</h3>
                    @if($students->isNotEmpty())
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-[#D65A20]">
                        <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)" class="w-4 h-4 rounded text-[#D65A20] border-slate-300 focus:ring-[#D65A20]/20 dark:border-slate-700 dark:bg-slate-900" />
                        <span>Pilih Semua Siswa</span>
                    </label>
                    @endif
                </div>

                @if(!$sourceClassname)
                <div class="py-16 text-center text-slate-400">
                    <i class="fas fa-arrow-left text-4xl mb-4 text-slate-200 animate-pulse"></i>
                    <p class="font-semibold text-sm">Silakan pilih Kelas Asal terlebih dahulu di panel sebelah kiri.</p>
                </div>
                @elseif($students->isEmpty())
                <div class="py-16 text-center text-slate-400">
                    <i class="fas fa-users-slash text-4xl mb-4 text-slate-200"></i>
                    <p class="font-semibold text-sm">Tidak ada siswa aktif terdaftar di kelas "{{ $sourceClassname }}".</p>
                </div>
                @else
                <div class="overflow-y-auto max-h-[500px] pr-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($students as $student)
                        <label class="flex items-center justify-between p-3.5 border border-slate-100 dark:border-slate-800/60 rounded-xl hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition cursor-pointer select-none">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" 
                                       name="student_ids[]" 
                                       value="{{ $student->id }}" 
                                       class="student-item-checkbox w-4 h-4 rounded text-[#D65A20] border-slate-300 focus:ring-[#D65A20]/20 dark:border-slate-700 dark:bg-slate-900"
                                       onchange="syncCheckboxes()" />
                                <div>
                                    <span class="font-bold text-slate-800 dark:text-slate-100 text-sm block">{{ $student->nama }}</span>
                                    <span class="text-xxs font-mono text-slate-400 font-medium block">NIS: {{ $student->nis }} &bull; {{ $student->jenis_kelamin }}</span>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleSelectAll(master) {
        $('.student-item-checkbox').prop('checked', master.checked);
        syncCheckboxes();
    }

    function syncCheckboxes() {
        // Clear old inputs
        const container = document.getElementById('hiddenCheckboxesContainer');
        container.innerHTML = '';
        
        // Append checked inputs into form
        $('.student-item-checkbox:checked').each(function() {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'student_ids[]';
            input.value = this.value;
            container.appendChild(input);
        });

        // Update Select All Checkbox state
        const allChecked = $('.student-item-checkbox').length === $('.student-item-checkbox:checked').length;
        $('#selectAllCheckbox').prop('checked', allChecked);
    }
</script>
@endpush
@endsection
