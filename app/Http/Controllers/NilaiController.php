<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Nilai::with(['student', 'subject.course']);

        if ($user->isStudent()) {
            $query->where('student_id', $user->student_id);
        } elseif ($user->isTeacher()) {
            $query->whereHas('subject', function($q) use ($user) {
                $q->where('teacher_id', $user->teacher->id);
            });
        }

        $grades = $query->latest()->get();
        return view('nilai.index', compact('grades'));
    }


    public function show(Nilai $grade)
    {
        $user = auth()->user();
        if ($user->isStudent() && $grade->student_id !== $user->student_id) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->isTeacher()) {
            $assignment = $grade->submission?->assignment;
            if ($assignment && $assignment->guru_id !== $user->teacher_id) {
                abort(403, 'Anda tidak memiliki akses ke nilai ini.');
            }
        }
        $grade->load(['student', 'subject.course', 'submission.assignment', 'grader']);
        return view('nilai.show', compact('grade'));
    }

}
