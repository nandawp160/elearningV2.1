<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banding extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_banding';

    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'alasan',
        'status',
        'disetujui_oleh',
        'tanggal_persetujuan',
        'tugas_id',
        'kategori_alasan',
        'bukti_pendukung',
        'tanggapan_guru',
        'tingkat_eskalasi',
        'waktu_eskalasi',
        'is_provisional_unlocked',
        'provisional_unlocked_at',
        'provisional_expires_at',
    ];

    protected $casts = [
        'tanggal_persetujuan' => 'datetime',
        'waktu_eskalasi' => 'datetime',
        'is_provisional_unlocked' => 'boolean',
        'provisional_unlocked_at' => 'datetime',
        'provisional_expires_at' => 'datetime',
    ];

    protected $appends = [
        'student_id',
        'subject_id',
        'reason',
        'approved_by',
        'approved_at',
    ];

    // Accessors and Mutators for backward compatibility
    public function getStudentIdAttribute() { return $this->siswa_id; }
    public function setStudentIdAttribute($v) { $this->siswa_id = $v; }

    public function getSubjectIdAttribute() { return $this->mata_pelajaran_id; }
    public function setSubjectIdAttribute($v) { $this->mata_pelajaran_id = $v; }

    public function getReasonAttribute() { return $this->alasan; }
    public function setReasonAttribute($v) { $this->alasan = $v; }

    public function getApprovedByAttribute() { return $this->disetujui_oleh; }
    public function setApprovedByAttribute($v) { $this->disetujui_oleh = $v; }

    public function getApprovedAtAttribute() { return $this->tanggal_persetujuan; }
    public function setApprovedAtAttribute($v) { $this->tanggal_persetujuan = $v; }

    public function getStatusAttribute($value)
    {
        if ($value === 'ditinjau') return 'pending';
        if ($value === 'diterima') return 'approved';
        if ($value === 'ditolak') return 'rejected';
        return $value;
    }

    public function setStatusAttribute($value)
    {
        if ($value === 'pending') $mapped = 'ditinjau';
        elseif ($value === 'approved') $mapped = 'diterima';
        elseif ($value === 'rejected') $mapped = 'ditolak';
        else $mapped = $value;
        $this->attributes['status'] = $mapped;
    }

    // Relationships
    public function student()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'mata_pelajaran_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function assignment()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    // Mock ClassRoom relation for backward compatibility (returns student's kelas representation)
    public function classRoom()
    {
        return $this->belongsTo(Kelas::class, 'tugas_id'); // Returns null safely since classRoom is omitted in new DB
    }

    // Escalation Helpers
    public function isEscalatedToWaliKelas(): bool
    {
        return in_array($this->tingkat_eskalasi, ['wali_kelas', 'admin']);
    }

    public function isEscalatedToAdmin(): bool
    {
        return $this->tingkat_eskalasi === 'admin';
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['ditinjau', 'pending']);
    }

    public function scopeEscalatedForWaliKelas($query)
    {
        return $query->whereIn('status', ['ditinjau', 'pending'])
            ->whereIn('tingkat_eskalasi', ['wali_kelas', 'admin']);
    }

    public function scopeEscalatedForAdmin($query)
    {
        return $query->whereIn('status', ['ditinjau', 'pending'])
            ->where('tingkat_eskalasi', 'admin');
    }
}
