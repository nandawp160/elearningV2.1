<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruKelas extends Model
{
    protected $table = 'guru_kelas';

    protected $fillable = [
        'guru_id',
        'kelas_id',
        'mata_pelajaran_id',
        'ssl_threshold',
    ];

    protected $casts = [
        'ssl_threshold' => 'integer',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function subject()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'mata_pelajaran_id');
    }
}
