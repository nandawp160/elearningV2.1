<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'kelas',
        'nama_ortu',
        'no_hp_ortu',
        'alamat',
        'status',
        'pengguna_id',
        'tahun_lulus',
        // Compatibility fillables
        'name',
        'gender',
        'date_of_birth',
        'phone',
        'address'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'status' => 'string',
        'jenis_kelamin' => 'string'
    ];

    protected $appends = [
        'name',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'parent_phone',
        'parent_name',
    ];

    public function getStatusAttribute($value)
    {
        if ($value === 'aktif') return 'active';
        if ($value === 'nonaktif') return 'inactive';
        if ($value === 'mutasi') return 'mutasi';
        return $value;
    }

    public function setStatusAttribute($value)
    {
        if ($value === 'active') $mapped = 'aktif';
        elseif ($value === 'inactive') $mapped = 'nonaktif';
        elseif ($value === 'mutasi') $mapped = 'mutasi';
        else $mapped = $value;
        $this->attributes['status'] = $mapped;
    }

    // Accessors for backward compatibility
    public function getNameAttribute() { return $this->nama; }
    public function setNameAttribute($v) { $this->attributes['nama'] = $v; }

    public function getGenderAttribute() { return $this->jenis_kelamin; }
    public function setGenderAttribute($v) { $this->attributes['jenis_kelamin'] = $v; }

    public function getDateOfBirthAttribute() { return $this->tanggal_lahir; }
    public function setDateOfBirthAttribute($v) { $this->attributes['tanggal_lahir'] = $v; }

    public function getAddressAttribute() { return $this->alamat; }
    public function setAddressAttribute($v) { $this->attributes['alamat'] = $v; }

    public function getPhoneAttribute() { return $this->no_hp_ortu; }
    public function setPhoneAttribute($v) { $this->attributes['no_hp_ortu'] = $v; }

    public function getParentPhoneAttribute() { return $this->no_hp_ortu; }
    public function setParentPhoneAttribute($v) { $this->attributes['no_hp_ortu'] = $v; }

    public function getParentNameAttribute() { return $this->nama_ortu; }
    public function setParentNameAttribute($v) { $this->attributes['nama_ortu'] = $v; }

    public function getParentEmailAttribute() { return null; }
    public function setParentEmailAttribute($v) {}

    // Relationship: Student has one User account
    public function user()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    // Relationship: Student belongs to Classroom
    public function classRoomRelation()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'name');
    }

    public function relasiKelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'name');
    }

    // Relationship: Student has many submissions
    public function submissions()
    {
        return $this->hasMany(Pengumpulan::class, 'siswa_id');
    }

    // Relationship: Student has many appeals
    public function appeals()
    {
        return $this->hasMany(Banding::class, 'siswa_id');
    }

    // Relationship: Student has many recoveries
    public function recoveries()
    {
        return $this->hasMany(PemulihanPengumpulan::class, 'siswa_id');
    }



    // Relationship: Student has many grades (added as a bugfix)
    public function grades()
    {
        return $this->hasMany(Nilai::class, 'student_id');
    }

    // Relasi ke Pelacakan Materi Selesai
    public function completedMaterials()
    {
        return $this->hasMany(PelacakanMateri::class, 'siswa_id');
    }

    // Relasi ke tabel Mutasi Siswa
    public function riwayatMutasi()
    {
        return $this->hasMany(MutasiSiswa::class, 'siswa_id');
    }

    // Scope: Active students only
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope: Filter by grade level
    public function scopeGradeLevel($query, $level)
    {
        return $query->where(function($q) use ($level) {
            $q->where('kelas', 'LIKE', $level . ' %')
              ->orWhere('kelas', 'LIKE', $level . '%');
        });
    }

    // Accessor for formatted phone number
    public function getFormattedPhoneAttribute()
    {
        $phone = $this->parent_phone;
        if (strlen($phone) >= 10) {
            return substr($phone, 0, 4) . '-' . substr($phone, 4, 4) . '-' . substr($phone, 8);
        }
        return $phone;
    }

    // Accessor: Get photo URL or default avatar
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return asset('images/default-avatar.png');
    }

    // Accessor: Get age from date of birth
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            return $this->date_of_birth->age;
        }
        return null;
    }

    // Accessor: Get current active classroom
    public function getCurrentClassRoomAttribute()
    {
        return $this->classRoomRelation;
    }

    // Accessor: Get average grade
    public function getAverageGradeAttribute()
    {
        return 0;
    }

    // Accessor: Get attendance percentage
    public function getAttendancePercentageAttribute()
    {
        return 100;
    }
}
