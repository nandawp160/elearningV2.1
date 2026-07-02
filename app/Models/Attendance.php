<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'subject_id',
        'student_id',
        'date',
        'status',
        'notes',
        'marked_by'
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'string'
    ];

    // Relationship: Attendance belongs to a subject
    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'subject_id');
    }

    // Relationship: Attendance belongs to a student
    public function student()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relationship: Attendance belongs to a teacher (marker)
    public function marker()
    {
        return $this->belongsTo(Guru::class, 'marked_by');
    }

    // Scope: Filter by status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope: Present students
    public function scopePresent($query)
    {
        return $query->where('status', 'Hadir');
    }

    // Scope: Absent students
    public function scopeAbsent($query)
    {
        return $query->whereIn('status', ['Izin', 'Sakit', 'Alpa']);
    }

    // Scope: Filter by date range
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    // Accessor: Get status badge class for UI
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'Hadir' => 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400',
            'Izin' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400',
            'Sakit' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400',
            'Alpa' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-500/20 dark:text-gray-400'
        };
    }

    // Accessor: Check if present
    public function getIsPresentAttribute()
    {
        return $this->status === 'Hadir';
    }
}
