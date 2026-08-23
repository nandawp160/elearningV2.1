<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Tugas extends Model
{
    use SoftDeletes;

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
        'type',
        'tipe_pengumpulan',
        'mode_audiovisual',
        'submission_type'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'status' => 'string',
        'tipe_pengumpulan' => 'string',
        'mode_audiovisual' => 'string',
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
        'tipe_pengumpulan',
        'mode_audiovisual',
    ];

    public function hasSubmissions(): bool
    {
        return $this->submissions()->exists();
    }

    public function isVisual(): bool
    {
        return ($this->tipe_pengumpulan ?? 'dokumen') === 'visual';
    }

    public function isDocument(): bool
    {
        return ($this->tipe_pengumpulan ?? 'dokumen') === 'dokumen';
    }

    public function isAudiovisual(): bool
    {
        return ($this->tipe_pengumpulan ?? 'dokumen') === 'audiovisual';
    }

    public function isArchive(): bool
    {
        return ($this->tipe_pengumpulan ?? 'dokumen') === 'kompresi';
    }

    public function isExternalUrl(): bool
    {
        return ($this->tipe_pengumpulan ?? 'dokumen') === 'tautan';
    }

    public function allowsAudio(): bool
    {
        return $this->isAudiovisual() && in_array($this->mode_audiovisual, ['audio_file', 'either', null]);
    }

    public function allowsVideo(): bool
    {
        return $this->isAudiovisual() && in_array($this->mode_audiovisual, ['video_url', 'either', null]);
    }

    public function getAttachmentExtensionAttribute(): ?string
    {
        if (!$this->lampiran || $this->is_attachment_url) return null;
        return strtolower(pathinfo($this->lampiran, PATHINFO_EXTENSION));
    }

    public function getIsAttachmentImageAttribute(): bool
    {
        $ext = $this->attachment_extension;
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']);
    }

    public function getIsAttachmentPdfAttribute(): bool
    {
        return $this->attachment_extension === 'pdf';
    }

    public function getIsAttachmentAudioAttribute(): bool
    {
        $ext = $this->attachment_extension;
        return in_array($ext, ['mp3', 'm4a', 'wav', 'ogg', 'aac', 'flac']);
    }

    public function getIsAttachmentVideoAttribute(): bool
    {
        if (!$this->lampiran || $this->is_attachment_url) return false;
        $ext = $this->attachment_extension;
        return in_array($ext, ['mp4', 'm4v', 'mov', 'webm']);
    }

    public function getIsAttachmentUrlAttribute(): bool
    {
        $attachment = $this->lampiran;
        return !empty($attachment) && (filter_var($attachment, FILTER_VALIDATE_URL) || str_starts_with($attachment, 'http://') || str_starts_with($attachment, 'https://'));
    }

    public function getAttachmentEmbedUrlAttribute(): ?string
    {
        if (!$this->is_attachment_url) return null;
        $parsed = app(\App\Services\SubmissionUrlService::class)->parseEmbedData($this->lampiran);
        return $parsed['embed_url'] ?? null;
    }

    public function getConfig(): array
    {
        $type = $this->tipe_pengumpulan ?? 'dokumen';
        return config("assignment_submission.types.{$type}", config('assignment_submission.types.dokumen'));
    }

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

    /**
     * Shared helper to count overdue assignments for a specific student and subject.
     */
    public static function countOverdueForStudentAndSubject($studentId, $subjectId, $tingkat = null, $kelasId = null)
    {
        return static::tugas()
            ->where('mata_pelajaran_id', $subjectId)
            ->where('status', 'aktif')
            ->whereNotNull('deadline')
            ->where('deadline', '<', Carbon::now())
            ->where(function ($q) use ($tingkat) {
                if ($tingkat) {
                    $q->whereHas('subject', function ($sub) use ($tingkat) {
                        $sub->where('tingkat', $tingkat)->orWhereNull('tingkat');
                    });
                }
            })
            ->where(function ($q) use ($kelasId) {
                if ($kelasId) {
                    $q->where('kelas_id', $kelasId)->orWhereNull('kelas_id');
                } else {
                    $q->whereNull('kelas_id');
                }
            })
            ->whereDoesntHave('submissions', function ($q) use ($studentId) {
                $q->where('siswa_id', $studentId);
            })
            ->count();
    }




    // Accessor: Check if assignment is overdue
    public function getIsOverdueAttribute()
    {
        if (!$this->due_date) return false;
        return $this->due_date->isPast();
    }

    public function getTimeRemainingAttribute()
    {
        if (!$this->due_date) {
            return 'Tidak ada batas waktu';
        }
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
