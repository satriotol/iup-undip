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
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
