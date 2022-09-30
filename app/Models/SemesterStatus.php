<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];
    public function mahasiswa_semesters()
    {
        return $this->hasMany(MahasiswaSemester::class, 'status_semester_id', 'id');
    }
    public function batch_semester_user_mahasiswas()
    {
        return $this->hasMany(BatchSemesterUserMahasiswa::class, 'semester_status_id', 'id');
    }
}
