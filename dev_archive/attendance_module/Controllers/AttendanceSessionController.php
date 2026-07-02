<?php

namespace App\Http\Controllers;


use App\Models\AttendanceSession;
use App\Models\JadwalPelajaran;
use App\Models\Attendance;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AttendanceSessionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user->isTeacher() && !$user->isSuperAdmin()) abort(403);

        $sessions = AttendanceSession::with('subject.course')
            ->where('teacher_id', $user->teacher->id ?? 0)
            ->latest()
            ->paginate(10);

        return view('attendance_sessions.index', compact('sessions'));
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user->isTeacher() && !$user->isSuperAdmin()) abort(403);

        $subjects = JadwalPelajaran::with(['course', 'classRoom'])
            ->where('teacher_id', $user->teacher->id ?? 0)
            ->get();

        return view('attendance_sessions.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->isTeacher() && !$user->isSuperAdmin()) abort(403);

        $request->validate([
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'duration_minutes' => 'nullable|integer|min:1|max:120',
        ]);

        $session = AttendanceSession::create([
            'subject_id' => $request->subject_id,
            'teacher_id' => $user->teacher->id,
            'qr_token' => Str::uuid(),
            'status' => 'active',
            'expires_at' => Carbon::now()->addMinutes((int)($request->duration_minutes ?? 15)),
        ]);

        if ($request->expectsJson() || $request->has('from_attendance')) {
             return response()->json([
                'success' => true,
                'message' => 'Sesi QR aktif.',
                'session' => $session,
                'qr_code' => QrCode::size(300)->generate($session->qr_token)->toHtml()
             ]);
        }

        return redirect()->route('attendance_sessions.show', $session)
            ->with('success', 'Sesi absensi berhasil dibuat.');
    }

    public function show(AttendanceSession $attendanceSession)
    {
        $user = auth()->user();
        if ($attendanceSession->teacher_id != ($user->teacher->id ?? 0) && !$user->isSuperAdmin()) {
            abort(403);
        }

        return view('attendance_sessions.show', compact('attendanceSession'));
    }

    /* API Method for Mobile */
    public function scan(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string',
            'student_id' => 'required|exists:siswa,id',
        ]);

        $session = AttendanceSession::where('qr_token', $request->qr_token)->first();

        if (!$session) {
            return response()->json(['message' => 'QR Code tidak valid.'], 404);
        }

        if ($session->isExpired()) {
            return response()->json(['message' => 'Sesi absensi sudah berakhir.'], 403);
        }

        // Check if already attended
        $exists = Attendance::where('subject_id', $session->subject_id)
            ->where('student_id', $request->student_id)
            ->whereDate('date', Carbon::today())
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Anda sudah mengisi absensi hari ini.'], 422);
        }

        Attendance::create([
            'subject_id' => $session->subject_id,
            'student_id' => $request->student_id,
            'date' => Carbon::today(),
            'status' => 'Hadir',
            'notes' => 'Absensi via QR Mobile',
            'marked_by' => $session->teacher_id,
        ]);

        return response()->json(['message' => 'Absensi berhasil dicatat.']);
    }

    public function refresh(AttendanceSession $attendanceSession)
    {
        $user = auth()->user();
        if ($attendanceSession->teacher_id != ($user->teacher->id ?? 0) && !$user->isSuperAdmin()) {
            abort(403);
        }

        if ($attendanceSession->isExpired()) {
            return response()->json(['success' => false, 'message' => 'Sesi sudah berakhir'], 403);
        }

        $attendanceSession->update([
            'qr_token' => Str::uuid()
        ]);

        return response()->json([
            'success' => true,
            'qr_code' => QrCode::size(300)->generate($attendanceSession->qr_token)->toHtml(),
            'expires_at' => $attendanceSession->expires_at->format('H:i')
        ]);
    }
}
