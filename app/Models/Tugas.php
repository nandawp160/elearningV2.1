<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tugas extends Model
{


    protected $table = 'tugas';

    protected $fillable = [
        'mata_pelajaran_id',
        'kelas_id',
        'judul',
        'deskripsi',
        'deadline',
        'lampiran',
        'guru_id',
        'status',
        'prasyarat_materi_id',
        
        // Form field aliases and newly added columns
        'subject_id',
        'title',
        'description',
        'due_date',
        'attachment',
        'created_by',
        'uploaded_by',
        'max_score',
        'type'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'status' => 'string'
    ];

    protected $appends = [
        'title',
        'description',
        'due_date',
        'attachment',
        'created_by',
        'uploaded_by',
        'is_overdue',
        'time_remaining',
        'preview_url',
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
    public function getTitleAttribute() { return $this->judul; }
    public function setTitleAttribute($v) { $this->attributes['judul'] = $v; }

    public function getDescriptionAttribute() { return $this->deskripsi; }
    public function setDescriptionAttribute($v) { $this->attributes['deskripsi'] = $v; }

    public function getTypeAttribute()
    {
        $attachment = $this->lampiran;
        if (!$attachment) {
            return 'document';
        }
        
        if (filter_var($attachment, FILTER_VALIDATE_URL) || str_starts_with($attachment, 'http://') || str_starts_with($attachment, 'https://')) {
            return 'link';
        }

        $extension = strtolower(pathinfo($attachment, PATHINFO_EXTENSION));
        
        if ($extension === 'pdf') {
            return 'pdf';
        } elseif (in_array($extension, ['doc', 'docx'])) {
            return 'docx';
        } elseif (in_array($extension, ['ppt', 'pptx'])) {
            return 'pptx';
        } elseif (in_array($extension, ['mp4', 'mkv', 'avi', 'mov'])) {
            return 'video';
        }

        return 'document';
    }

    public function getUploaderAttribute() { return $this->creator; }

    public function getFilePathAttribute() { return $this->lampiran; }
    public function setFilePathAttribute($v) { $this->attributes['lampiran'] = $v; }

    public function getFileUrlAttribute()
    {
        if ($this->url) {
            return null;
        }
        return $this->lampiran ? route('download.assignment', $this->id) : null;
    }

    public function getDueDateAttribute() { return $this->deadline; }
    public function setDueDateAttribute($v)
    {
        $this->attributes['deadline'] = $v ? (is_string($v) ? Carbon::parse($v) : $v) : null;
    }

    public function getAttachmentAttribute() { return $this->lampiran; }
    public function setAttachmentAttribute($v) { $this->attributes['lampiran'] = $v; }

    public function getCreatedByAttribute() { return $this->guru_id; }
    public function setCreatedByAttribute($v) { $this->attributes['guru_id'] = $v; }

    public function getSubjectIdAttribute() { return $this->mata_pelajaran_id; }
    public function setSubjectIdAttribute($v) { $this->attributes['mata_pelajaran_id'] = $v; }

    public function getUploadedByAttribute() { return $this->guru_id; }
    public function setUploadedByAttribute($v) { $this->attributes['guru_id'] = $v; }

    public function getUrlAttribute()
    {
        $attachment = $this->lampiran;
        if ($attachment && (filter_var($attachment, FILTER_VALIDATE_URL) || str_starts_with($attachment, 'http://') || str_starts_with($attachment, 'https://'))) {
            return $attachment;
        }
        return null;
    }

    // Relationship: Assignment belongs to a subject
    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'mata_pelajaran_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relationship: Assignment belongs to a teacher (creator)
    public function creator()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relationship: Assignment has many submissions
    public function submissions()
    {
        return $this->hasMany(Pengumpulan::class, 'tugas_id');
    }

    // Relasi ke Materi Prasyarat
    public function prerequisite()
    {
        return $this->belongsTo(Materi::class, 'prasyarat_materi_id');
    }

    // Relasi ke data penyelesaian materi oleh siswa
    public function completions()
    {
        return $this->hasMany(PelacakanMateri::class, 'tugas_id');
    }

    // Scope: Active assignments only
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope: Backward compatibility for tugas() calls
    public function scopeTugas($query)
    {
        return $query;
    }

    // Scope: Assignments that are not yet past due date
    public function scopeUpcoming($query)
    {
        return $query->where('due_date', '>=', Carbon::now());
    }

    // Scope: Overdue assignments
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', Carbon::now());
    }



    // Accessor: Check if assignment is overdue
    public function getIsOverdueAttribute()
    {
        return $this->due_date->isPast();
    }

    // Accessor: Get time remaining until due date
    public function getTimeRemainingAttribute()
    {
        if ($this->is_overdue) {
            return 'Terlambat';
        }
        return $this->due_date->diffForHumans();
    }

    // Accessor: Get submission count
    public function getSubmissionCountAttribute()
    {
        return $this->submissions()->count();
    }

    // Accessor: Get graded submission count
    public function getGradedCountAttribute()
    {
        return $this->submissions()->where('status', 'graded')->count();
    }

    // Accessor: Get attachment URL
    public function getAttachmentUrlAttribute()
    {
        if ($this->attachment) {
            if (filter_var($this->attachment, FILTER_VALIDATE_URL) || str_starts_with($this->attachment, 'http://') || str_starts_with($this->attachment, 'https://')) {
                return $this->attachment;
            }
            return route('download.assignment', $this->id);
        }
        return null;
    }

    // Accessor: Get preview URL (inline)
    public function getPreviewUrlAttribute()
    {
        if ($this->attachment) {
            if (filter_var($this->attachment, FILTER_VALIDATE_URL) || str_starts_with($this->attachment, 'http://') || str_starts_with($this->attachment, 'https://')) {
                return $this->attachment;
            }
            return route('preview.assignment', $this->id);
        }
        return null;
    }
}
