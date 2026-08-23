<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guru';

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'no_hp',
        'spesialisasi',
        'specialization_id',
        'alamat',
        'status',
        'pengguna_id',
        'tugas_tambahan_jtm',
        'allowed_grades',
        'entry_academic_year'
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'allowed_grades' => 'array'
    ];

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

    // Accessors for backward compatibility
    public function getNameAttribute() { return $this->nama; }
    public function setNameAttribute($v) { $this->attributes['nama'] = $v; }

    public function getPhoneAttribute() { return $this->no_hp; }
    public function setPhoneAttribute($v) { $this->attributes['no_hp'] = $v; }

    public function getSpesialisasiAttribute($value)
    {
        if ($this->mataPelajaranDiajarkan()->exists()) {
            return $this->mataPelajaranDiajarkan->pluck('nama')->implode(', ');
        }
        return $this->mataPelajaran->nama
            ?? $this->attributes['spesialisasi']
            ?? null;
    }

    // Many-to-many: mata pelajaran yang DIAJARKAN guru
    public function mataPelajaranDiajarkan()
    {
        return $this->belongsToMany(
            MataPelajaran::class,
            'guru_mata_pelajaran',
            'guru_id',
            'mata_pelajaran_id'
        )->withTimestamps();
    }

    public function getSpecializationAttribute() { return $this->spesialisasi; }
    public function setSpecializationAttribute($v) { $this->attributes['spesialisasi'] = $v; }

    public function getAddressAttribute() { return $this->alamat; }
    public function setAddressAttribute($v) { $this->attributes['alamat'] = $v; }

    // Relationship: Teacher has one specialization mata pelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'specialization_id');
    }

    // Relationship: Teacher has many subjects (mengajar)
    public function subjects()
    {
        return $this->belongsToMany(JadwalPelajaran::class, 'tugas', 'guru_id', 'mata_pelajaran_id')->distinct();
    }

    // Relationship: Teacher creates many assignments
    public function assignments()
    {
        return $this->hasMany(Tugas::class, 'guru_id');
    }

    // Relationship: Teacher has one User account
    public function user()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    // Relationship: Teacher is homeroom teacher of many classes
    public function kelasPerwalian()
    {
        return $this->hasMany(Kelas::class, 'homeroom_teacher_id');
    }

    // Relationship: Teacher teaches many classes (Kelas Diampu)
    public function kelasDiampu()
    {
        return $this->belongsToMany(
            Kelas::class,
            'guru_kelas',
            'guru_id',
            'kelas_id'
        )->withPivot('mata_pelajaran_id');
    }

    public function teachingAssignments()
    {
        return $this->hasMany(GuruKelas::class, 'guru_id');
    }

    // Accessor: Calculate total JTM
    public function getTotalJtmAttribute()
    {
        $kelasJtm = 0;
        foreach ($this->teachingAssignments as $assignment) {
            // Abaikan jika kelas tidak aktif / berbeda tahun ajaran (bernilai null karena Global Scope)
            if (!$assignment->kelas) {
                continue;
            }

            $mapel = $assignment->subject;
            if ($mapel) {
                $kelasJtm += $mapel->beban_jp ?? 4;
            } else if ($this->mataPelajaran) {
                $kelasJtm += $this->mataPelajaran->beban_jp ?? 4;
            } else {
                $kelasJtm += 4; // default fallback
            }
        }

        // Tugas tambahan manual (misal Wali Kelas, dsb disatukan di kolom ini)
        $tugasTambahan = $this->tugas_tambahan_jtm ?? 0;

        return $kelasJtm + $tugasTambahan;
    }

    // Scope: Active teachers only
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    // Accessor: Get formatted phone number
    public function getFormattedPhoneAttribute()
    {
        $phone = $this->phone;
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

    /**
     * Normalize subject name to handle grades/levels suffixes and synonym groups
     */
    public static function normalizeSubjectName($name)
    {
        $name = strtolower($name);
        
        // Remove specific words and suffixes (case-insensitive, handled by strtolower)
        $wordsToRemove = ['x', 'xi', 'xii', '1', '2', 'lanjutan', 'peminatan', 'wajib', 'dasar', 'grade', 'tingkat'];
        
        foreach ($wordsToRemove as $word) {
            $name = preg_replace('/\b' . preg_quote($word, '/') . '\b/', '', $name);
        }
        
        $name = preg_replace('/\s+/', ' ', $name);
        $name = trim($name);

        // Synonyms mapping (alias group)
        $synonymGroups = [
            'tik' => ['tik', 'informatika', 'teknologi informasi', 'komputer'],
            'pjok' => ['pjok', 'penjaskes', 'olahraga', 'pendidikan jasmani'],
            'pkn' => ['pkn', 'ppkn', 'pendidikan pancasila'],
            'sbdp' => ['sbdp', 'seni budaya', 'seni rupa', 'seni musik'],
        ];

        foreach ($synonymGroups as $canonical => $aliases) {
            if (in_array($name, $aliases)) {
                return $canonical;
            }
        }

        return $name;
    }

    /**
     * Resolve the appropriate subject for a given class level based on teacher's specialization
     */
    public function getSubjectForClass($kelas)
    {
        // 1. Direct relational mapping lookup (Opsi 2)
        $assignment = $this->teachingAssignments()->where('kelas_id', $kelas->id)->first();
        if ($assignment && $assignment->subject) {
            return $assignment->subject;
        }

        // 2. Dynamic text-matching resolver (Opsi 1 fallback)
        if (!$this->specialization_id) {
            return null;
        }

        $specialization = \App\Models\JadwalPelajaran::with(['course'])->find($this->specialization_id);
        if (!$specialization) {
            return null;
        }

        // If the grade level of the target class matches the specialization's grade level,
        // we return the specialization directly.
        if (strcasecmp($kelas->grade_level, $specialization->tingkat) === 0) {
            return $specialization;
        }

        // Cross-level resolution: search for active subjects in the target grade level
        $normalizedSpecName = self::normalizeSubjectName($specialization->nama);

        $targetSubjects = \App\Models\JadwalPelajaran::where('tingkat', $kelas->grade_level)
            ->where('status', 'aktif')
            ->get();

        foreach ($targetSubjects as $subject) {
            if (self::normalizeSubjectName($subject->nama) === $normalizedSpecName) {
                return $subject;
            }
        }

        // Fallback: return null to prevent showing wrong grade level subjects (e.g. Bahasa Indonesia X in XI/XII)
        return null;
    }

    /**
     * Get unique subject IDs taught by this teacher across all their assigned classes
     */
    public function getSubjectIdsTaught()
    {
        $ids = $this->teachingAssignments()->pluck('mata_pelajaran_id')->filter()->unique()->toArray();
        if (empty($ids)) {
            if ($this->specialization_id) {
                $ids[] = $this->specialization_id;
            }
            foreach ($this->kelasDiampu as $kelas) {
                $subject = $this->getSubjectForClass($kelas);
                if ($subject) {
                    $ids[] = $subject->id;
                }
            }
        }

        return array_unique($ids);
    }
}

