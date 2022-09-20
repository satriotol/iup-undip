<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function user_mahasiswa()
    {
        return $this->hasMany(UserMahasiswa::class, 'country_id', 'id');
    }
}
