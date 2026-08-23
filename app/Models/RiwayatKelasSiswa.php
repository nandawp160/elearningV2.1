<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKelasSiswa extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kelas_siswa';

    protected $fillable = [
        'siswa_id',
        'kelas_name',
        'academic_year',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
