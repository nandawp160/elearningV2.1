<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use App\Models\AttendanceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isStudent()) {
            $attendances = Attendance::with(['subject.course'])
                ->where('student_id', $user->student_id)
                ->latest()
                ->get();
            return view('attendances.index_student', compact('attendances'));
        }

        // For Teachers/Admins: Group by Subject and Date
        $query = Attendance::with(['subject.course', 'subject.classRoom'])
            ->selectRaw('date, subject_id, 
                COUNT(*) as total_students,
                SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as count_hadir,
                SUM(CASE WHEN status = "Izin" THEN 1 ELSE 0 END) as count_izin,
                SUM(CASE WHEN status = "Sakit" THEN 1 ELSE 0 END) as count_sakit,
                SUM(CASE WHEN status = "Alpa" THEN 1 ELSE 0 END) as count_alpa')
            ->groupBy('date', 'subject_id')
            ->latest('date');

        if ($user->isTeacher()) {
            $query->whereHas('subject', function($q) use ($user) {
                $q->where('teacher_id', $user->teacher->id);
            });
        }

        $sessions = $query->get();
        return view('attendances.index', compact('sessions'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        if ($user->isStudent()) abort(403);

        $teacherId = $user->teacher->id ?? 0;
        $subjects = JadwalPelajaran::with(['course', 'classRoom'])
            ->where('teacher_id', $teacherId)
            ->get();

        $selectedSubject = null;
        $students = collect();

        if ($request->has('subject_id')) {
            $selectedSubject = JadwalPelajaran::findOrFail($request->subject_id);
            if ($selectedSubject->teacher_id != $teacherId && !$user->isSuperAdmin()) abort(403);

            $students = Siswa::whereHas('enrollments', function($q) use ($selectedSubject) {
                $q->where('class_room_id', $selectedSubject->class_room_id)
                  ->where('status', 'active');
            })->get();
        }

        return view('attendances.create', compact('subjects', 'selectedSubject', 'students'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isStudent()) abort(403);

        $request->validate([
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.status' => 'required|in:Hadir,Izin,Sakit,Alpa',
            'attendances.*.notes' => 'nullable|string',
        ]);

        foreach ($request->attendances as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'subject_id' => $request->subject_id,
                    'student_id' => $studentId,
                    'date' => $request->date,
                ],
                [
                    'status' => $data['status'],
                    'notes' => $data['notes'] ?? null,
                    'marked_by' => $user->teacher->id ?? null,
                ]
            );
        }
        
        if ($request->has('redirect_to_qr') && $request->redirect_to_qr == '1') {
            $session = AttendanceSession::create([
                'subject_id' => $request->subject_id,
                'teacher_id' => $user->teacher->id,
                'qr_token' => Str::uuid(),
                'status' => 'active',
                'expires_at' => Carbon::now()->addMinutes(15),
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'id' => $session->id,
                    'qr_code' => \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate($session->qr_token)->toHtml(),
                    'subject' => $session->subject->course->name,
                    'expires_at' => $session->expires_at->format('H:i')
                ]);
            }

            return redirect()->route('attendance_sessions.show', $session)
                ->with('success', 'Absensi disimpan dan sesi QR aktif.');
        }

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil disimpan.');
    }


    public function destroy(Attendance $attendance)
    {
        if (auth()->user()->isStudent()) abort(403);
        $attendance->delete();
        return back()->with('success', 'Data absensi berhasil dihapus.');
    }

    public function destroySession(Request $request)
    {
        if (auth()->user()->isStudent()) abort(403);
        
        $request->validate([
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'date' => 'required|date',
        ]);

        Attendance::where('subject_id', $request->subject_id)
            ->where('date', $request->date)
            ->delete();

        return redirect()->route('attendances.index')->with('success', 'Sesi absensi berhasil dihapus.');
    }
}
