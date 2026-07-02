<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'name',
        'grade_level',
        'major',
        'homeroom_teacher_id',
        'academic_year',
        'max_students',
        // Indonesian aliases
        'jurusan',
        'tingkat',
        'kapasitasMaksimal',
        'tahunAjaran',
    ];

    protected static function booted()
    {
        static::addGlobalScope('tahun_ajaran_aktif', function ($builder) {
            $builder->where('kelas.academic_year', Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026'));
        });
    }

    // Accessors for backward compatibility
    public function getNameAttribute($value)
    {
        return $value ?? ('Tingkat ' . $this->grade_level);
    }

    public function getGradeLevelAttribute($value)
    {
        return $value ?? 'X';
    }

    public function getMajorAttribute($value)
    {
        return $value ?? 'IPA';
    }

    public function getStudentCountAttribute()
    {
        return $this->siswa_count ?? $this->students()->count();
    }

    public function getMaxStudentsAttribute($value)
    {
        return $value ?? 40;
    }

    public function getAcademicYearAttribute($value)
    {
        return $value ?? '2025/2026';
    }

    // Relationship: Class has a Homeroom Teacher
    public function homeroomTeacher()
    {
        return $this->belongsTo(Guru::class, 'homeroom_teacher_id');
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'homeroom_teacher_id');
    }

    // Relationship: Class has many teachers
    public function guruPengampu()
    {
        return $this->belongsToMany(
            Guru::class,
            'guru_kelas',
            'kelas_id',
            'guru_id'
        );
    }


    // Relationship: Class has many students
    public function students()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'name');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'name');
    }

    public function daftarSiswa()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'name');
    }

    // Relationship: Class has many subjects (for scheduling)
    public function subjects()
    {
        return $this->hasMany(JadwalPelajaran::class, 'tingkat', 'grade_level');
    }

    public function mataPelajaran()
    {
        return $this->hasMany(JadwalPelajaran::class, 'tingkat', 'grade_level');
    }

    // Accessors & Mutators for Indonesian nomenclature
    public function getWaliKelasAttribute() { return $this->homeroomTeacher; }
    
    public function getDaftarSiswaAttribute() { return $this->students; }
    
    public function getMataPelajaranAttribute() { return $this->subjects; }
    
    public function getJurusanAttribute() { return $this->major; }
    public function setJurusanAttribute($value) { $this->attributes['major'] = $value; }
    
    public function getTingkatAttribute() { return $this->grade_level; }
    public function setTingkatAttribute($value) { $this->attributes['grade_level'] = $value; }
    
    public function getKapasitasMaksimalAttribute() { return $this->max_students; }
    public function setKapasitasMaksimalAttribute($value) { $this->attributes['max_students'] = $value; }
    
    public function getTahunAjaranAttribute() { return $this->academic_year; }
    public function setTahunAjaranAttribute($value) { $this->attributes['academic_year'] = $value; }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withoutGlobalScope('tahun_ajaran_aktif')
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->first();
    }
}
