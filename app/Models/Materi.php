<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materials';

    protected $fillable = [
        'subject_id',
        'title',
        'description',
        'type',
        'file_path',
        'url',
        'uploaded_by'
    ];

    protected $casts = [
        'type' => 'string'
    ];

    // Relationship: Material belongs to a subject
    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'subject_id');
    }

    // Relationship: Material belongs to a teacher (uploader)
    public function uploader()
    {
        return $this->belongsTo(Guru::class, 'uploaded_by');
    }

    // Scope: Filter by type
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope: Filter by subject
    public function scopeSubject($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }

    // Accessor: Get file URL
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return route('download.material', $this->id);
        }
        return $this->url;
    }

    // Accessor: Check if it's an external link
    public function getIsExternalAttribute()
    {
        return $this->type === 'link' || !empty($this->url);
    }

    // Accessor: Get icon class based on type
    public function getTypeIconAttribute()
    {
        return match($this->type) {
            'pdf' => 'fas fa-file-pdf text-red-500',
            'video' => 'fas fa-video text-blue-500',
            'link' => 'fas fa-link text-indigo-500',
            'document' => 'fas fa-file-alt text-gray-500',
            default => 'fas fa-file text-gray-400'
        };
    }
}
