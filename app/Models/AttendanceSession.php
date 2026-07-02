<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    protected $fillable = [
        'subject_id',
        'teacher_id',
        'qr_token',
        'status',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Guru::class);
    }

    public function isExpired()
    {
        return $this->expires_at->isPast() || $this->status !== 'active';
    }
}
