<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessors for backward compatibility
    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama'] = $value;
    }

    public function getStudentIdAttribute()
    {
        return $this->student?->id;
    }

    public function getTeacherIdAttribute()
    {
        return $this->teacher?->id;
    }

    public function setRoleAttribute($value)
    {
        if ($value === 'student') {
            $value = 'siswa';
        } elseif ($value === 'teacher') {
            $value = 'guru';
        } elseif ($value === 'super_admin') {
            $value = 'admin';
        }
        $this->attributes['role'] = $value;
    }

    // Relationships
    public function teacher()
    {
        return $this->hasOne(Guru::class, 'pengguna_id');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'pengguna_id');
    }


    public function student()
    {
        return $this->hasOne(Siswa::class, 'pengguna_id');
    }

    // Role Helper Methods
    public function isSuperAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'guru' || $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'siswa' || $this->role === 'student';
    }

    public function hasRole(string $role): bool
    {
        $mappedRole = $role;
        if ($role === 'student') $mappedRole = 'siswa';
        if ($role === 'teacher') $mappedRole = 'guru';
        if ($role === 'super_admin') $mappedRole = 'admin';
        return $this->role === $mappedRole || $this->role === $role;
    }

    public function isHomeroomTeacher(): bool
    {
        if (!$this->isTeacher()) {
            return false;
        }
        $teacher = $this->teacher;
        if (!$teacher) {
            return false;
        }
        return Kelas::where('homeroom_teacher_id', $teacher->id)->exists();
    }

    public function isWaliKelas(): bool
    {
        return $this->isHomeroomTeacher();
    }
}
