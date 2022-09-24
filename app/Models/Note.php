<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_mahasiswa_id', 'test_date', 'listening', 'reading', 'writing', 'speaking', 'overall_score', 'event_1', 'event_2', 'achievement', 'other_information'];

    public function user_mahasiswa()
    {
        return $this->BelongsTo(UserMahasiswa::class, 'user_mahasiswa_id', 'id');
    }
}
