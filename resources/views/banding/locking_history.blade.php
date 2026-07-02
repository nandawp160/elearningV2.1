@extends('layouts.app')

@section('title', 'Histori Penguncian')

@section('content')
<div class="appeals-wrapper">
    <!-- Header Area -->
    <div class="appeals-header">
        <div class="appeals-header__text">
            <h1 class="appeals-title">Histori Penguncian</h1>
            <p class="appeals-subtitle">Audit kedisiplinan dan histori siswa yang terkena submission locking.</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="appeals-card">
        <div class="appeals-filters-card" style="margin-bottom: 0; border-radius: 0; border-top: none; border-left: none; border-right: none;">
            <div class="appeals-filters-card__title">Audit Sistem Locking</div>
        </div>
        <div class="appeals-table-wrap">
            <table class="appeals-table">
                <thead>
                    <tr>
                        <th class="appeals-th" style="width: 60px">No</th>
                        <th class="appeals-th">Detail Tugas</th>
                        <th class="appeals-th">Mapel</th>
                        <th class="appeals-th">Kelas</th>
                        <th class="appeals-th">Deadline</th>
                        <th class="appeals-th">Status Sistem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lockedAssignments as $i => $assignment)
                    <tr class="appeals-tr">
                        <td class="appeals-td appeals-td--num">{{ $lockedAssignments->firstItem() + $i }}</td>
                        <td class="appeals-td">
                            <div class="appeals-student-name">{{ $assignment->title }}</div>
                            <div style="font-size: 11px; color: #94a3b8">Kode: {{ $assignment->code }}</div>
                        </td>
                        <td class="appeals-td">
                            <span class="appeals-mapel-text">{{ $assignment->subject->course->name }}</span>
                        </td>
                        <td class="appeals-td">
                            <span class="appeals-class-text">{{ $assignment->subject->classRoom->name }}</span>
                        </td>
                        <td class="appeals-td">
                            <div class="appeals-date-text" style="color: #ef4444; font-weight: 600">
                                {{ $assignment->due_date->format('d M Y, H:i') }}
                            </div>
                            <div style="font-size: 11px; color: #94a3b8">
                                {{ $assignment->due_date->diffForHumans() }}
                            </div>
                        </td>
                        <td class="appeals-td">
                            <span class="appeals-badge appeals-badge--rejected" style="background: #fef2f2; color: #ef4444">
                                <i class="fas fa-lock" style="font-size: 10px; margin-right: 4px"></i> Locked
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="appeals-td--empty">Tidak ada data penguncian aktif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="appeals-pagination">
            {{ $lockedAssignments->links() }}
        </div>
    </div>
</div>

<style>
/* Base Theme Styles (Reused from index/history) */
.appeals-wrapper { font-family: 'Plus Jakarta Sans', sans-serif; color: #334155; }
.appeals-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
.appeals-title { font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 0 4px 0; }
.appeals-subtitle { font-size: 14px; color: #64748b; margin: 0; }

.appeals-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; }
.appeals-filters-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; padding: 16px 20px; display: flex; align-items: center; }
.appeals-filters-card__title { font-weight: 700; color: #1e293b; font-size: 15px; }

.appeals-table { width: 100%; border-collapse: collapse; }
.appeals-th { padding: 16px 20px; text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase; color: #94a3b8; background: #fff; border-bottom: 1px solid #f1f5f9; }
.appeals-tr:nth-child(even) { background: #fafbfc; }
.appeals-tr:hover { background: #f8fafc; }
.appeals-td { padding: 16px 20px; font-size: 14px; border-bottom: 1px solid #f8fafc; vertical-align: middle; }
.appeals-student-name { font-weight: 600; color: #1e293b; }
.appeals-class-text { font-size: 13px; color: #64748b; font-weight: 600; }

.appeals-badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
.appeals-pagination { padding: 16px 20px; border-top: 1px solid #f1f5f9; }
</style>
@endsection
