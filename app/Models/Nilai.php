<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'submission_id',
        'subject_id',
        'student_id',
        'type',
        'score',
        'max_score',
        'feedback',
        'graded_by',
        'graded_at'
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'max_score' => 'integer',
        'graded_at' => 'datetime',
        'type' => 'string'
    ];

    // Relationship: Grade belongs to a subject
    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'subject_id');
    }

    // Relationship: Grade belongs to a student
    public function student()
    {
        return $this->belongsTo(Siswa::class, 'student_id');
    }

    // Relationship: Grade belongs to a submission (nullable for manual grades)
    public function submission()
    {
        return $this->belongsTo(Pengumpulan::class, 'submission_id');
    }

    // Relationship: Grade belongs to a teacher (grader)
    public function grader()
    {
        return $this->belongsTo(Guru::class, 'graded_by');
    }

    // Scope: Filter by type
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope: Filter by student
    public function scopeStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    // Scope: Filter by subject
    public function scopeSubject($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }

    // Accessor: Get percentage grade
    public function getPercentageAttribute()
    {
        if ($this->max_score > 0) {
            return round(($this->score / $this->max_score) * 100, 2);
        }
        return 0;
    }

    // Accessor: Get letter grade
    public function getLetterGradeAttribute()
    {
        $percentage = $this->percentage;
        
        if ($percentage >= 90) return 'A';
        if ($percentage >= 80) return 'B';
        if ($percentage >= 70) return 'C';
        if ($percentage >= 60) return 'D';
        return 'E';
    }

    // Accessor: Get formatted score display
    public function getScoreDisplayAttribute()
    {
        return $this->score . ' / ' . $this->max_score . ' (' . $this->percentage . '%)';
    }
}
