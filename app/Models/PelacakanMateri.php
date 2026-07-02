<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelacakanMateri extends Model
{
    protected $table = 'pelacakan_materi';

    protected $fillable = [
        'siswa_id',
        'materi_id',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime'
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi ke Materi
    public function material()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
