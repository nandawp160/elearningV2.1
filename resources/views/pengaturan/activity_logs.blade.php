@extends('layouts.app')

@section('title', 'Log Aktivitas Sistem')

@section('content')
<div class="space-y-6">
    <!-- Page Header Card -->
    <div class="card p-6 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Log Aktivitas Sistem</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Audit log aktivitas seluruh aksi penting pengguna (Guru, Siswa, Admin) pada sistem e-learning.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('settings.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition flex items-center gap-1.5">
                    <i class="fas fa-arrow-left"></i> Kembali ke Pengaturan
                </a>
            </div>
        </div>
    </div>

    <!-- Filters and Search Toolbar -->
    <div class="card p-5 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        <form action="{{ route('activity-logs.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Left filters -->
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aksi, deskripsi, user..." class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100" />
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>

                <!-- Action Type Filter -->
                <div class="relative w-full sm:w-48">
                    <select name="action_type" class="w-full rounded-xl border border-slate-200 bg-white pl-4 pr-10 py-2.5 text-xs text-slate-700 appearance-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 font-semibold">
                        <option value="">Semua Kategori Aksi</option>
                        @foreach($actionTypes as $type)
                            <option value="{{ $type }}" {{ request('action_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <!-- Submit Filter Button -->
                <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition flex items-center gap-1.5">
                    <i class="fas fa-filter text-xs"></i> Saring Log
                </button>

                <!-- Reset Filter Button -->
                @if(request('search') || request('action_type'))
                <a href="{{ route('activity-logs.index') }}" class="btn border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 dark:hover:bg-slate-700 text-xs font-bold px-3 py-2.5 rounded-xl flex items-center gap-1.5 transition">
                    <i class="fas fa-arrows-rotate"></i> Reset
                </a>
                @endif
            </div>

            <!-- Right metadata -->
            <div class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                Total data audit log: <span class="font-bold text-slate-700 dark:text-slate-300">{{ $logs->total() }}</span> entri
            </div>
        </form>
    </div>

    <!-- Main Table View -->
    <div class="card p-0 overflow-hidden bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/30 border-b border-slate-100 dark:border-slate-800">
                        <th class="px-6 py-4 text-left font-semibold text-slate-700 dark:text-slate-300 text-xs w-16">No</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700 dark:text-slate-300 text-xs w-48">Waktu (WIB)</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700 dark:text-slate-300 text-xs w-56">Pengguna</th>
                        <th class="px-6 py-4 text-center font-semibold text-slate-700 dark:text-slate-300 text-xs w-40">Kategori Aksi</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700 dark:text-slate-300 text-xs">Detail Deskripsi Aktivitas</th>
                        <th class="px-6 py-4 text-left font-semibold text-slate-700 dark:text-slate-300 text-xs w-36">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($logs as $index => $log)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition">
                        <!-- No -->
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-500 font-medium">
                            {{ $logs->firstItem() + $index }}
                        </td>

                        <!-- Time -->
                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300 font-mono text-xs">
                            {{ $log->created_at->timezone('Asia/Jakarta')->format('d M Y H:i:s') }}
                        </td>

                        <!-- User -->
                        <td class="px-6 py-4">
                            @if($log->user)
                            <div>
                                <p class="font-bold text-slate-800 dark:text-slate-100 text-xs">{{ $log->user->nama }}</p>
                                <span class="badge bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 text-[10px] font-semibold px-2 py-0.5 rounded-full capitalize">
                                    {{ $log->user->role }}
                                </span>
                            </div>
                            @else
                            <p class="text-slate-400 dark:text-slate-600 font-semibold text-xs">Guest / System</p>
                            @endif
                        </td>

                        <!-- Action Category -->
                        <td class="px-6 py-4 text-center">
                            @php
                                $badgeClass = 'bg-slate-50 text-slate-700 border-slate-200';
                                $icon = 'fa-info-circle';
                                switch($log->action) {
                                    case 'AUTH':
                                        $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-950/20 dark:text-emerald-400';
                                        $icon = 'fa-shield-halved';
                                        break;
                                    case 'STUDENT':
                                    case 'TEACHER':
                                    case 'CLASS':
                                        $badgeClass = 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-950/20 dark:text-blue-400';
                                        $icon = 'fa-user-group';
                                        break;
                                    case 'GRADE':
                                    case 'SUBMISSION':
                                        $badgeClass = 'bg-orange-50 text-orange-700 border-orange-100 dark:bg-orange-950/20 dark:text-orange-400';
                                        $icon = 'fa-award';
                                        break;
                                    case 'TASKS':
                                    case 'MATERIALS':
                                        $badgeClass = 'bg-indigo-50 text-indigo-700 border-indigo-100 dark:bg-indigo-950/20 dark:text-indigo-400';
                                        $icon = 'fa-book-open';
                                        break;
                                    case 'SETTINGS':
                                        $badgeClass = 'bg-purple-50 text-purple-700 border-purple-100 dark:bg-purple-950/20 dark:text-purple-400';
                                        $icon = 'fa-gears';
                                        break;
                                    case 'APPEAL':
                                    case 'RECOVERY':
                                        $badgeClass = 'bg-yellow-50 text-yellow-800 border-yellow-100 dark:bg-yellow-950/20 dark:text-yellow-400';
                                        $icon = 'fa-envelope-open-text';
                                        break;
                                    case 'DELETION':
                                    case 'CRITICAL':
                                        $badgeClass = 'bg-rose-50 text-rose-700 border-rose-100 dark:bg-rose-950/20 dark:text-rose-400';
                                        $icon = 'fa-circle-exclamation';
                                        break;
                                }
                            @endphp
                            <span class="badge border {{ $badgeClass }} text-[11px] font-bold px-2.5 py-1 rounded-lg inline-flex items-center gap-1.5 uppercase">
                                <i class="fas {{ $icon }}"></i> {{ $log->action }}
                            </span>
                        </td>

                        <!-- Description -->
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-350 text-xs font-semibold leading-relaxed">
                            {{ $log->description }}
                        </td>

                        <!-- IP Address -->
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400 font-mono text-xs">
                            {{ $log->ip_address ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 dark:text-slate-600 font-medium">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fas fa-folder-open text-3xl text-slate-300 dark:text-slate-700"></i>
                                <span>Tidak ada log aktivitas ditemukan</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom Styled Pagination -->
        @if($logs->hasPages())
        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-900/10 border-t border-slate-100 dark:border-slate-800">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
