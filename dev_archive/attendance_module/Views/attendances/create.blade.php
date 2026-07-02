@extends('layouts.app')

@section('title', 'Catat Absensi')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('attendances.index') }}" class="btn btn-ghost">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data Absensi
        </a>
    </div>

    <div class="card">
        <form action="{{ route('attendances.create') }}" method="GET">
            <div class="flex flex-wrap items-end gap-6">
                <div class="flex-1 min-w-[260px]">
                    <label class="field-label mb-2 block">Pilih Mata Pelajaran & Kelas</label>
                    <select name="subject_id" @change="$el.form.submit()" class="select">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->course->name }} - {{ $subject->classRoom->name }} ({{ $subject->day }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($selectedSubject)
                <div class="flex flex-wrap items-center gap-4">
                    <div class="px-4 py-3 rounded-xl bg-teal-50 dark:bg-teal-500/10 border border-teal-100 dark:border-teal-500/20">
                        <p class="text-[10px] font-semibold uppercase tracking-widest text-teal-600">Mata Pelajaran</p>
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $selectedSubject->course->name }}</p>
                    </div>
                    <div class="px-4 py-3 rounded-xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20">
                        <p class="text-[10px] font-semibold uppercase tracking-widest text-sky-600">Kelas</p>
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ $selectedSubject->classRoom->name }}</p>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>

    @if($selectedSubject)
    <form id="attendance-form" action="{{ route('attendances.store') }}" method="POST" 
        x-data="{ 
            showQrModal: false,
            qrCode: '',
            sessionSubject: '',
            expiresAt: '',
            sessionId: null,
            loading: false,
            timeLeft: 15,
            refreshInterval: null,
            markAll(status) {
                document.querySelectorAll('input[type=radio][value=' + status + ']').forEach(el => el.checked = true);
            },
            async submitToQr() {
                this.loading = true;
                document.getElementById('redirect_to_qr').value = '1';
                const formData = new FormData(document.getElementById('attendance-form'));
                
                try {
                    const response = await fetch('{{ route('attendances.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    
                    const data = await response.json();
                    if (data.success) {
                        this.qrCode = data.qr_code;
                        this.sessionSubject = data.subject;
                        this.expiresAt = data.expires_at;
                        this.sessionId = data.id;
                        this.showQrModal = true;
                        this.startRefreshTimer();
                    } else {
                        alert('Gagal membuat sesi QR');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Terjadi kesalahan saat menghubungi server');
                } finally {
                    this.loading = false;
                }
            },
            startRefreshTimer() {
                if (this.refreshInterval) clearInterval(this.refreshInterval);
                this.timeLeft = 15;
                this.refreshInterval = setInterval(async () => {
                    this.timeLeft--;
                    if (this.timeLeft <= 0) {
                        await this.refreshQr();
                        this.timeLeft = 15;
                    }
                }, 1000);
            },
            async refreshQr() {
                try {
                    const response = await fetch(`/attendance_sessions/${this.sessionId}/refresh`);
                    const data = await response.json();
                    if (data.success) {
                        this.qrCode = data.qr_code;
                    }
                } catch (e) {
                    console.error('Failed to refresh QR', e);
                }
            }
        }"
        @keydown.window.escape="showQrModal = false; window.location.href='{{ route('attendances.index') }}'">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $selectedSubject->id }}">
        <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
        <input type="hidden" name="redirect_to_qr" id="redirect_to_qr" value="0">

        <div class="flex flex-wrap gap-6">
            <div class="flex-1 min-w-[600px]">
                <div class="card p-0 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fas fa-users text-teal-500"></i>
                                Daftar Siswa
                            </h3>
                            <span class="badge badge-info">{{ $students->count() }} Siswa</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-slate-500">
                            <button type="button" @click="markAll('Hadir')" class="btn btn-secondary">
                                Set Hadir Semua
                            </button>
                            <span>Tanggal: {{ date('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table-ui w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">Siswa</th>
                                    <th class="px-6 py-3 text-center">Hadir</th>
                                    <th class="px-6 py-3 text-center">Izin</th>
                                    <th class="px-6 py-3 text-center">Sakit</th>
                                    <th class="px-6 py-3 text-center">Alpa</th>
                                    <th class="px-6 py-3 text-left">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/50 transition">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center font-semibold">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $student->name }}</p>
                                                <p class="text-xs text-slate-500 font-mono">NIS: {{ $student->nis }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach(['Hadir', 'Izin', 'Sakit', 'Alpa'] as $status)
                                    <td class="px-6 py-5 text-center">
                                        <label class="relative inline-flex items-center justify-center cursor-pointer group">
                                            <input type="radio" name="attendances[{{ $student->id }}][status]" value="{{ $status }}" {{ $status == 'Hadir' ? 'checked' : '' }}
                                                   class="peer w-6 h-6 opacity-0 absolute">
                                            <div class="w-6 h-6 border-2 border-slate-200 dark:border-slate-700 rounded-full flex items-center justify-center transition-all peer-checked:border-teal-600 dark:peer-checked:border-teal-400 peer-checked:bg-teal-50 dark:peer-checked:bg-teal-500/10">
                                                <div class="w-2.5 h-2.5 bg-teal-600 dark:bg-teal-400 rounded-full transform scale-0 transition-transform peer-checked:scale-100"></div>
                                            </div>
                                        </label>
                                    </td>
                                    @endforeach
                                    <td class="px-6 py-5 min-w-[200px]">
                                        <input type="text" name="attendances[{{ $student->id }}][notes]" placeholder="Catatan..." class="input" />
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-slate-500">Siswa belum dimapping ke kelas ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-80 space-y-4">
                <div class="card">
                    <h4 class="text-xs font-semibold uppercase tracking-widest text-slate-500 mb-4">Pilih Mode Absensi</h4>
                    
                    <button type="submit" class="btn btn-primary w-full mb-3">
                        <i class="fas fa-save"></i>
                        Simpan Manual
                    </button>

                    <div class="flex items-center gap-3 text-[10px] text-slate-400 uppercase tracking-widest">
                        <span class="h-px flex-1 bg-slate-200 dark:bg-slate-700"></span>
                        atau
                        <span class="h-px flex-1 bg-slate-200 dark:bg-slate-700"></span>
                    </div>

                    <button type="button" @click="submitToQr()" :disabled="loading" class="btn btn-outline w-full mt-3 disabled:opacity-60">
                        <template x-if="!loading">
                            <i class="fas fa-qrcode"></i>
                        </template>
                        <template x-if="loading">
                            <i class="fas fa-spinner fa-spin"></i>
                        </template>
                        <span x-text="loading ? 'Memproses...' : 'Buka Sesi QR'"></span>
                    </button>
                </div>

                <div class="card bg-amber-50/70 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20">
                    <div class="flex gap-3">
                        <i class="fas fa-info-circle text-amber-500 mt-1"></i>
                        <div>
                            <h5 class="text-xs font-semibold uppercase text-amber-600 mb-1">Tips Sesi QR</h5>
                            <p class="text-xs text-amber-700/80">Gunakan QR Mode jika ingin siswa scan sendiri via HP. QR akan kadaluarsa otomatis dalam 15 menit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showQrModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
             style="display: none;">
            <div class="glass-dark w-full max-w-xl p-8 rounded-2xl relative text-white">
                <button @click="showQrModal = false; if(refreshInterval) clearInterval(refreshInterval); window.location.href='{{ route('attendances.index') }}'" 
                        type="button" class="absolute top-4 right-4 text-slate-300 hover:text-white transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>

                <div class="text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-500/10 text-emerald-300 rounded-full border border-emerald-500/20 mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[10px] font-semibold uppercase tracking-widest">Sesi Absensi Aktif</span>
                    </div>

                    <h2 class="text-2xl font-semibold text-white mb-2" x-text="sessionSubject"></h2>
                    <p class="text-slate-300 text-sm mb-6 uppercase tracking-widest" x-text="'{{ $selectedSubject ? $selectedSubject->classRoom->name : '' }}'"></p>

                    <div class="relative inline-block mb-8">
                        <div class="bg-white p-6 rounded-2xl shadow-sm">
                            <div x-html="qrCode"></div>
                        </div>
                        <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 px-4 py-2 bg-teal-600 text-white rounded-xl text-[10px] font-semibold uppercase tracking-widest border border-slate-900 flex items-center gap-2">
                            <i class="fas fa-sync-alt animate-spin" x-show="timeLeft <= 1"></i>
                            <span x-text="'Refresh: ' + timeLeft + 's'"></span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-slate-300 text-xs uppercase tracking-widest">QR Code berganti otomatis untuk keamanan ekstra absensi.</p>
                        <div class="flex items-center justify-center gap-2 text-teal-300 font-semibold text-sm">
                            <i class="fas fa-clock"></i>
                            <span x-text="'Berakhir pada ' + expiresAt + ' WIB'"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="card p-10 text-center">
        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
            <i class="fas fa-info-circle text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Pilih mata pelajaran terlebih dahulu</h3>
        <p class="text-sm text-slate-500">Silakan pilih mata pelajaran pada form di atas untuk mulai mencatat absensi.</p>
    </div>
    @endif
</div>
@endsection
