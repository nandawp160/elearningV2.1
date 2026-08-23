<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKelas extends Model
{
    protected $table = 'master_kelas';
    protected $fillable = ['name', 'grade_level', 'major', 'entry_academic_year'];
}
