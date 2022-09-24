<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id','name'];

    public function user_mahasiswas()
    {
        return $this->hasMany(UserMahasiswa::class, 'major_id', 'id');
    }
    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id', 'id');
    }
}
