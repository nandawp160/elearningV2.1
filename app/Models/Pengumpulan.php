<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_tugas',
        'tanggal_pengumpulan',
        'status',
        'original_name',
        'file_path',
        'file_size',
        'mime_type'
    ];

    protected $casts = [
        'tanggal_pengumpulan' => 'datetime',
        'status' => 'string'
    ];

    protected $appends = [
        'assignment_id',
        'student_id',
        'submission_date',
        'file_path',
        'attachment',
        'attachment_url',
        'original_name',
        'file_size',
        'preview_url'
    ];

    // Accessors and Mutators for backward compatibility
    public function getAssignmentIdAttribute() { return $this->tugas_id; }
    public function setAssignmentIdAttribute($v) { $this->tugas_id = $v; }

    public function getStudentIdAttribute() { return $this->siswa_id; }
    public function setStudentIdAttribute($v) { $this->siswa_id = $v; }

    public function getSubmissionDateAttribute() { return $this->tanggal_pengumpulan; }
    public function setSubmissionDateAttribute($v) { $this->tanggal_pengumpulan = $v; }

    public function getFilePathAttribute($value) { return $value ?: $this->file_tugas; }
    public function setFilePathAttribute($v) { $this->attributes['file_path'] = $v; }

    public function getOriginalNameAttribute($value)
    {
        return $value ?: basename($this->file_tugas);
    }

    public function getFileSizeAttribute($value)
    {
        if ($value !== null) {
            return (int) $value;
        }
        try {
            if ($this->file_tugas && \Storage::disk('public')->exists($this->file_tugas)) {
                return (int) \Storage::disk('public')->size($this->file_tugas);
            }
        } catch (\Exception $e) {}
        return 0;
    }

    public function getAttachmentAttribute() { return $this->file_tugas; }
    public function setAttachmentAttribute($v) { $this->file_tugas = $v; }

    public function getStatusAttribute($value)
    {
        if ($value === 'terkumpul') return 'submitted';
        if ($value === 'terlambat') return 'late';
        if ($value === 'belum') return 'pending';
        return $value;
    }

    public function setStatusAttribute($value)
    {
        if ($value === 'submitted') $mapped = 'terkumpul';
        elseif ($value === 'late') $mapped = 'terlambat';
        elseif ($value === 'pending') $mapped = 'belum';
        else $mapped = $value;
        $this->attributes['status'] = $mapped;
    }

    // Relationship: Submission belongs to an assignment
    public function assignment()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    // Relationship: Submission belongs to a student
    public function student()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relationship: Submission has one grade
    public function grade()
    {
        return $this->hasOne(Nilai::class, 'submission_id');
    }

    // Scope: Submitted status
    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    // Scope: Graded submissions
    public function scopeGraded($query)
    {
        return $query->where('status', 'graded');
    }

    // Scope: Late submissions
    public function scopeLate($query)
    {
        return $query->where('status', 'late');
    }

    // Accessor: Check if submission is late
    public function getIsLateAttribute()
    {
        return $this->submission_date->isAfter($this->assignment->due_date);
    }

    // Accessor: Get attachment URL
    public function getAttachmentUrlAttribute()
    {
        if ($this->attachment) {
            return route('download.submission', $this->id);
        }
        return null;
    }

    // Accessor: Get preview URL (inline)
    public function getPreviewUrlAttribute()
    {
        if ($this->attachment) {
            return route('preview.submission', $this->id);
        }
        return null;
    }

    // Accessor: Check if graded
    public function getIsGradedAttribute()
    {
        return $this->status === 'graded' && $this->grade()->exists();
    }

    // Accessor: Formatted file size
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }
}
