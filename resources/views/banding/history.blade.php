@extends('layouts.app')

@section('title', 'Riwayat Recovery')

@section('content')
<div class="appeals-wrapper" x-data="recoveryHistory()">
    <!-- Header Area -->
    <div class="appeals-header">
        <div class="appeals-header__text">
            <h1 class="appeals-title">Riwayat Recovery</h1>
            <p class="appeals-subtitle">Pantau progres pemulihan submission locking siswa.</p>
        </div>
        <div class="appeals-header__search">
            <div class="appeals-search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari siswa atau mapel..." x-model="searchQuery" @input.debounce.500ms="applyFilters()">
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="appeals-filters-card">
        <div class="appeals-filters-wrap">
            <select class="appeals-select" x-model="filterSubject" @change="applyFilters()">
                <option value="">Semua Mapel</option>
                @foreach($subjects as $s)
                <option value="{{ $s->id }}">{{ $s->course->name }}</option>
                @endforeach
            </select>
            <select class="appeals-select" x-model="filterClass" @change="applyFilters()">
                <option value="">Semua Kelas</option>
                @foreach($classrooms as $c)
                <option value="{{ $c }}">{{ $c }}</option>
                @endforeach
            </select>
            <select class="appeals-select" x-model="filterStatus" @change="applyFilters()">
                <option value="">Semua Status</option>
                <option value="active">Recovery Aktif</option>
                <option value="completed">Completed</option>
                <option value="expired">Expired</option>
            </select>
        </div>
    </div>

    <!-- Table Card -->
    <div class="appeals-card">
        <div class="appeals-table-wrap">
            <table class="appeals-table">
                <thead>
                    <tr>
                        <th class="appeals-th" style="width: 60px">No</th>
                        <th class="appeals-th">Siswa</th>
                        <th class="appeals-th">Mapel</th>
                        <th class="appeals-th">Kelas</th>
                        <th class="appeals-th">Progress</th>
                        <th class="appeals-th">Recovery</th>
                        <th class="appeals-th">Status</th>
                        <th class="appeals-th" style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recoveries as $i => $recovery)
                    <tr class="appeals-tr">
                        <td class="appeals-td appeals-td--num">{{ $recoveries->firstItem() + $i }}</td>
                        <td class="appeals-td">
                            <div class="appeals-student-name">{{ $recovery->student->name }}</div>
                        </td>
                        <td class="appeals-td">
                            <span class="appeals-mapel-text">{{ $recovery->subject->course->name }}</span>
                        </td>
                        <td class="appeals-td">
                            <span class="appeals-class-text">{{ $recovery->classRoom->name }}</span>
                        </td>
                        <td class="appeals-td">
                            @php
                                $totalTunggakan = \App\Models\Tugas::where('subject_id', $recovery->subject_id)
                                    ->where('due_date', '<', $recovery->started_at)
                                    ->count();
                                $submittedTunggakan = \App\Models\Pengumpulan::where('student_id', $recovery->student_id)
                                    ->whereIn('assignment_id', function($q) use ($recovery) {
                                        $q->select('id')->from('tugas')
                                          ->where('subject_id', $recovery->subject_id)
                                          ->where('due_date', '<', $recovery->started_at);
                                    })->count();
                                $progress = $totalTunggakan > 0 ? round(($submittedTunggakan / $totalTunggakan) * 100) : 100;
                            @endphp
                            <div class="recovery-progress">
                                <div class="recovery-progress__text">
                                    <span>{{ $submittedTunggakan }}/{{ $totalTunggakan }} tugas</span>
                                    <span>{{ $progress }}%</span>
                                </div>
                                <div class="recovery-progress__bar">
                                    <div class="recovery-progress__fill" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="appeals-td">
                            @if($recovery->recovery_status == 'active')
                                @if($recovery->expired_at->isPast())
                                    <div class="recovery-time recovery-time--expired">
                                        Expired
                                        <span class="recovery-time__sub">(Expired: {{ $recovery->expired_at->format('d M Y, H:i') }})</span>
                                    </div>
                                @else
                                    <div class="recovery-time recovery-time--active">
                                        Sisa {{ $recovery->expired_at->diffForHumans(null, true) }}
                                        <span class="recovery-time__sub">(Expired: {{ $recovery->expired_at->format('d M Y, H:i') }})</span>
                                    </div>
                                @endif
                            @elseif($recovery->recovery_status == 'completed')
                                <div class="recovery-time recovery-time--done">
                                    Selesai
                                    <span class="recovery-time__sub">(Completed: {{ $recovery->completed_at ? $recovery->completed_at->format('d M Y, H:i') : '-' }})</span>
                                </div>
                            @else
                                <span class="appeals-date-text">Expired</span>
                            @endif
                        </td>
                        <td class="appeals-td">
                            @if($recovery->recovery_status == 'active')
                                @if($recovery->expired_at->isPast())
                                    <span class="appeals-badge appeals-badge--expired">Expired</span>
                                @else
                                    <span class="appeals-badge appeals-badge--active">Recovery Aktif</span>
                                @endif
                            @elseif($recovery->recovery_status == 'completed')
                                <span class="appeals-badge appeals-badge--completed">Completed</span>
                            @else
                                <span class="appeals-badge appeals-badge--expired">Expired</span>
                            @endif
                        </td>
                        <td class="appeals-td appeals-td--center">
                            <button class="appeals-btn-review">Detail</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="appeals-td--empty">Tidak ada riwayat recovery.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="appeals-pagination">
            {{ $recoveries->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<style>
/* Base Theme Styles (Shared with index) */
.appeals-wrapper { font-family: 'Plus Jakarta Sans', sans-serif; color: #334155; }
.appeals-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; gap: 20px; }
.appeals-title { font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 0 4px 0; }
.appeals-subtitle { font-size: 14px; color: #64748b; margin: 0; }

.appeals-search-box { position: relative; width: 300px; }
.appeals-search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; }
.appeals-search-box input { width: 100%; padding: 10px 14px 10px 40px; border-radius: 12px; border: 1px solid #e2e8f0; background: #fff; font-size: 14px; outline: none; transition: all 0.2s; }
.appeals-search-box input:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1); }

.appeals-filters-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; padding: 16px 20px; margin-bottom: 20px; display: flex; align-items: center; }
.appeals-filters-wrap { display: flex; gap: 12px; }
.appeals-select { padding: 8px 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #fff; font-size: 13px; color: #475569; outline: none; cursor: pointer; min-width: 140px; }

.appeals-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; }
.appeals-table { width: 100%; border-collapse: collapse; }
.appeals-th { padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #94a3b8; background: #fff; border-bottom: 1px solid #f1f5f9; }
.appeals-tr:nth-child(even) { background: #fafbfc; }
.appeals-tr:hover { background: #f8fafc; }
.appeals-td { padding: 16px 20px; font-size: 14px; border-bottom: 1px solid #f8fafc; vertical-align: middle; }
.appeals-student-name { font-weight: 600; color: #1e293b; }
.appeals-class-text { font-size: 13px; color: #64748b; font-weight: 600; }
.appeals-date-text { font-size: 13px; color: #94a3b8; }

/* Progress Bar */
.recovery-progress { width: 140px; }
.recovery-progress__text { display: flex; justify-content: space-between; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 6px; }
.recovery-progress__bar { height: 6px; background: #f1f5f9; border-radius: 3px; overflow: hidden; }
.recovery-progress__fill { height: 100%; background: #22c55e; border-radius: 3px; }

/* Recovery Time Text */
.recovery-time { font-size: 13px; font-weight: 700; display: flex; flex-direction: column; gap: 2px; }
.recovery-time--active { color: #1e293b; }
.recovery-time--expired { color: #ef4444; }
.recovery-time--done { color: #22c55e; }
.recovery-time__sub { font-size: 11px; font-weight: 400; color: #94a3b8; }

/* Badges */
.appeals-badge { display: inline-flex; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
.appeals-badge--active { background: #f0f9ff; color: #0369a1; }
.appeals-badge--completed { background: #f0fdf4; color: #16a34a; }
.appeals-badge--expired { background: #fef2f2; color: #ef4444; }

.appeals-btn-review { padding: 6px 16px; border-radius: 8px; border: 1px solid #f97316; background: transparent; color: #f97316; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
</style>

<script>
function recoveryHistory() {
    return {
        searchQuery: new URLSearchParams(window.location.search).get('search') || '',
        filterSubject: new URLSearchParams(window.location.search).get('subject_id') || '',
        filterClass: new URLSearchParams(window.location.search).get('class_id') || '',
        filterStatus: new URLSearchParams(window.location.search).get('status') || '',

        applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.set('search', this.searchQuery);
            url.searchParams.set('subject_id', this.filterSubject);
            url.searchParams.set('class_id', this.filterClass);
            url.searchParams.set('status', this.filterStatus);
            url.searchParams.set('page', 1);
            window.location.href = url.href;
        }
    }
}
</script>
@endsection
