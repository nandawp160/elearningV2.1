<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemulihanPengumpulan extends Model
{
    use HasFactory;

    protected $table = 'pemulihan_akses';

    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'status_pemulihan',
        'durasi_jam',
        'tugas_id',
        'mulai_pemulihan',
        'batas_pemulihan',
        'selesai_pemulihan',
    ];

    protected $casts = [
        'mulai_pemulihan' => 'datetime',
        'batas_pemulihan' => 'datetime',
        'selesai_pemulihan' => 'datetime',
    ];

    // Accessors and Mutators for backward compatibility
    public function getStudentIdAttribute() { return $this->siswa_id; }
    public function setStudentIdAttribute($v) { $this->siswa_id = $v; }

    public function getSubjectIdAttribute() { return $this->mata_pelajaran_id; }
    public function setSubjectIdAttribute($v) { $this->mata_pelajaran_id = $v; }

    public function getDurationHoursAttribute() { return $this->durasi_jam; }
    public function setDurationHoursAttribute($v) { $this->durasi_jam = $v; }

    public function getCurrentAssignmentIdAttribute() { return $this->tugas_id; }
    public function setCurrentAssignmentIdAttribute($v) { $this->tugas_id = $v; }

    public function getStartedAtAttribute() { return $this->mulai_pemulihan; }
    public function setStartedAtAttribute($v) { $this->mulai_pemulihan = $v; }

    public function getExpiredAtAttribute() { return $this->batas_pemulihan; }
    public function setExpiredAtAttribute($v) { $this->batas_pemulihan = $v; }

    public function getCompletedAtAttribute() { return $this->selesai_pemulihan; }
    public function setCompletedAtAttribute($v) { $this->selesai_pemulihan = $v; }

    public function getRecoveryStatusAttribute()
    {
        $val = $this->attributes['status_pemulihan'] ?? '';
        if ($val === 'aktif') return 'active';
        if ($val === 'selesai') return 'completed';
        return $val; // 'expired' stays the same
    }

    public function setRecoveryStatusAttribute($value)
    {
        if ($value === 'active') $mapped = 'aktif';
        elseif ($value === 'completed') $mapped = 'selesai';
        else $mapped = $value; // 'expired' stays the same
        $this->attributes['status_pemulihan'] = $mapped;
    }

    public function classRoom()
    {
        return $this->belongsTo(Kelas::class, 'tugas_id'); // Mock relation
    }

    public function student()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'mata_pelajaran_id');
    }

    public function currentAssignment()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function assignment()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }
}
