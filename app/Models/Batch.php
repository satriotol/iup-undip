<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['year'];

    public function user_mahasiswas()
    {
        return $this->hasMany(UserMahasiswa::class, 'batch_id', 'id');
    }
    public function batch_semesters()
    {
        return $this->hasMany(BatchSemester::class, 'batch_id', 'id');
    }
}
