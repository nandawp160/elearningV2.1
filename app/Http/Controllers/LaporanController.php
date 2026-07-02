<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function system()
    {
        // Ambil data siswa dan guru yang aktif pada tahun ajaran aktif
        $activeClassNames = \App\Models\Kelas::pluck('name')->toArray();
        $activeClassIds = \App\Models\Kelas::pluck('id')->toArray();
        
        $activeStudentIds = Siswa::active()->whereIn('kelas', $activeClassNames)->pluck('id')->toArray();
        $activeTeacherIds = \DB::table('guru_kelas')->whereIn('kelas_id', $activeClassIds)->pluck('guru_id')->unique()->toArray();

        $assignmentsCount = \App\Models\Tugas::tugas()->whereIn('guru_id', $activeTeacherIds)->count();
        $submissionsCount = \App\Models\Pengumpulan::whereIn('siswa_id', $activeStudentIds)->count();
        $appealsCount = \App\Models\Banding::whereIn('siswa_id', $activeStudentIds)->count();
        $recoveriesCount = \App\Models\PemulihanPengumpulan::whereIn('siswa_id', $activeStudentIds)->count();

        // Submissions breakdown
        $lateSubmissionsCount = \App\Models\Pengumpulan::whereIn('siswa_id', $activeStudentIds)->where('status', 'terlambat')->count();
        $onTimeSubmissionsCount = \App\Models\Pengumpulan::whereIn('siswa_id', $activeStudentIds)->where('status', 'terkumpul')->count();

        // Appeals Breakdown
        $appealsApproved = \App\Models\Banding::whereIn('siswa_id', $activeStudentIds)->where('status', 'approved')->count();
        $appealsRejected = \App\Models\Banding::whereIn('siswa_id', $activeStudentIds)->where('status', 'rejected')->count();
        $appealsPending = \App\Models\Banding::whereIn('siswa_id', $activeStudentIds)->where('status', 'pending')->count();

        // Recent appeals list
        $recentAppeals = \App\Models\Banding::with(['student', 'assignment'])
            ->whereIn('siswa_id', $activeStudentIds)
            ->latest()
            ->limit(10)
            ->get();

        // Locked assignments (deadline passed)
        $lockedAssignmentsCount = \App\Models\Tugas::tugas()
            ->whereIn('guru_id', $activeTeacherIds)
            ->where('deadline', '<', now())
            ->count();
            
        $activeAssignmentsCount = \App\Models\Tugas::tugas()
            ->whereIn('guru_id', $activeTeacherIds)
            ->where('deadline', '>=', now())
            ->where('status', 'aktif')
            ->count();

        return view('laporan.system', compact(
            'assignmentsCount',
            'submissionsCount',
            'appealsCount',
            'recoveriesCount',
            'lateSubmissionsCount',
            'onTimeSubmissionsCount',
            'appealsApproved',
            'appealsRejected',
            'appealsPending',
            'recentAppeals',
            'lockedAssignmentsCount',
            'activeAssignmentsCount'
        ));
    }
}
