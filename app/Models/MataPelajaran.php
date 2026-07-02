<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'tingkat',
        'status',
        'beban_jp',
        // Compatibility fillables
        'code',
        'name',
        'description',
        'grade_level'
    ];

    // Accessors for backward compatibility
    public function getCodeAttribute() { return $this->kode; }
    public function setCodeAttribute($v) { $this->attributes['kode'] = $v; }

    public function getNameAttribute() { return $this->nama; }
    public function setNameAttribute($v) { $this->attributes['nama'] = $v; }

    public function getDescriptionAttribute() { return $this->deskripsi; }
    public function setDescriptionAttribute($v) { $this->attributes['deskripsi'] = $v; }

    public function getGradeLevelAttribute() { return $this->tingkat; }
    public function setGradeLevelAttribute($v) { $this->attributes['tingkat'] = $v; }

    public function getStatusAttribute($value)
    {
        if ($value === 'aktif') return 'active';
        if ($value === 'nonaktif') return 'inactive';
        return $value;
    }

    public function setStatusAttribute($value)
    {
        if ($value === 'active') $mapped = 'aktif';
        elseif ($value === 'inactive') $mapped = 'nonaktif';
        else $mapped = $value;
        $this->attributes['status'] = $mapped;
    }

    // Relationship: Course has many subjects (jadwal)
    public function subjects()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id', 'id');
    }

    // Scope: Filter by grade level
    public function scopeGradeLevel($query, $level)
    {
        return $query->where('tingkat', $level);
    }

    // Scope: Active courses only
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    // Accessor: Get formatted course code
    public function getFormattedCodeAttribute()
    {
        return strtoupper($this->kode);
    }

    // Accessor: Get full course name with code
    public function getFullNameAttribute()
    {
        return $this->kode . ' - ' . $this->nama;
    }
}
