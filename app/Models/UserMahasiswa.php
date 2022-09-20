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
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'user_id');
    }
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
