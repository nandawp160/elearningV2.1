<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'mutasi_siswa';

    protected $fillable = [
        'siswa_id',
        'jenis_mutasi',
        'tanggal_mutasi',
        'keterangan_sekolah',
        'alasan',
        'surat_mutasi'
    ];

    protected $casts = [
        'tanggal_mutasi' => 'date',
    ];

    /**
     * Relasi ke tabel siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
