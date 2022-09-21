<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'batch_id', 'major_id', 'country_id', 'nim', 'phone', 'gender'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function mahasiswa_semesters()
    {
        return $this->hasMany(MahasiswaSemester::class, 'user_mahasiswa_id', 'id');
    }
    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'mahasiswa_semester', 'user_mahasiswa_id', 'semester_id');
    }
}
