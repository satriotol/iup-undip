<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = ['year', 'semester'];

    public function user_mahasiswas()
    {
        return $this->belongsToMany(UserMahasiswa::class, 'mahasiswa_semester', 'semester_id', 'user_mahasiswa_id');
    }
    public function mahasiswa_semester()
    {
        return $this->hasMany(MahasiswaSemester::class, 'semester_id', 'id');
    }
}
