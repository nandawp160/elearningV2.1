<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'tingkat',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
        'tingkat' => 'string'
    ];

    public function getStatusAttribute($value)
    {
        if ($value === 'aktif') return 'active';
        if ($value === 'nonaktif') return 'inactive';
        return $value;
    }

    public function setStatusAttribute($value)
    {
        if ($value === 'active') $mapped = 'aktif';
        elseif ($value === 'inactive') $mapped = 'nonaktif';
        else $mapped = $value;
        $this->attributes['status'] = $mapped;
    }

    // Accessors for backward compatibility
    public function getNameAttribute() { return $this->nama; }
    public function setNameAttribute($v) { $this->attributes['nama'] = $v; }

    public function getCodeAttribute() { return $this->kode; }
    public function setCodeAttribute($v) { $this->attributes['kode'] = $v; }

    // Relationship: Subject belongs to a Course
    public function course()
    {
        return $this->belongsTo(MataPelajaran::class, 'id');
    }

    // Relationship: Subject belongs to a ClassRoom
    public function classRoom()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function getTeacherAttribute()
    {
        $assignment = $this->assignments()->first();
        if ($assignment && $assignment->creator) {
            return $assignment->creator;
        }
        
        // 1. Direct match by specialization
        $directTeacher = \App\Models\Guru::active()->where('specialization_id', $this->id)->first();
        if ($directTeacher) {
            return $directTeacher;
        }

        // 2. Cross-level matching
        $teachers = \App\Models\Guru::active()->get();
        foreach ($teachers as $teacher) {
            if (in_array($this->id, $teacher->getSubjectIdsTaught())) {
                return $teacher;
            }
        }

        return null;
    }

    // Relationship: Subject has many assignments
    public function assignments()
    {
        return $this->hasMany(Tugas::class, 'mata_pelajaran_id');
    }

    // Scope: Filter by academic year
    public function scopeAcademicYear($query, $year)
    {
        return $query;
    }

    // Scope: Filter by semester
    public function scopeSemester($query, $semester)
    {
        return $query;
    }

    // Accessor: Get schedule display (e.g., "Senin, 07:00 - 08:30")
    public function getScheduleDisplayAttribute()
    {
        $day = $this->day ?? 'Senin';
        $start = isset($this->start_time) ? Carbon::parse($this->start_time)->format('H:i') : '07:00';
        $end = isset($this->end_time) ? Carbon::parse($this->end_time)->format('H:i') : '08:30';
        return $day . ', ' . $start . ' - ' . $end;
    }

    // Accessor: Get full subject name
    public function getFullNameAttribute()
    {
        return $this->nama;
    }
}
