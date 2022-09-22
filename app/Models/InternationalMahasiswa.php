<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['user_mahasiswa_id', 'international_status_id', 'international_category_id', 'international_university_id', 'international_program_id', 'international_funding_id', 'duration', 'year', 'start_at', 'end_at'];

    public function user_mahasiswa()
    {
        return $this->belongsTo(UserMahasiswa::class, 'user_mahasiswa_id', 'id');
    }
    public function international_status()
    {
        return $this->belongsTo(InternationalStatus::class, 'international_status_id', 'id');
    }
    public function international_category()
    {
        return $this->belongsTo(InternationalCategory::class, 'international_category_id', 'id');
    }
    public function international_university()
    {
        return $this->belongsTo(InternationalUniversity::class, 'international_university_id', 'id');
    }
    public function international_program()
    {
        return $this->belongsTo(InternationalProgram::class, 'international_program_id', 'id');
    }
    public function international_funding()
    {
        return $this->belongsTo(InternationalFunding::class, 'international_funding_id', 'id');
    }
}
