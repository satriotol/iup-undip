<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaSemester extends Model
{
    use HasFactory;

    protected $fillable = ['user_mahasiswa_id', 'semester_id', 'status_semester_id'];
    public function user_mahasiswa()
    {
        return $this->belongsTo(UserMahasiswa::class, 'user_mahasiswa_id', 'id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
