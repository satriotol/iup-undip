<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['user_mahasiswa_id', 'international_status_id', 'international_category_id', 'international_university_id', 'international_program_id', 'international_funding_id', 'duration', 'year', 'start_at', 'end_at'];
    protected $appends = ['international_status_name', 'international_category_name', 'international_university_name','international_university_country', 'international_program_name', 'international_funding_name'];

    public function user_mahasiswa()
    {
        return $this->belongsTo(UserMahasiswa::class, 'user_mahasiswa_id', 'id') ?? '';
    }
    public function international_status()
    {
        return $this->belongsTo(InternationalStatus::class, 'international_status_id', 'id') ?? '';
    }
    public function international_category()
    {
        return $this->belongsTo(InternationalCategory::class, 'international_category_id', 'id') ?? '';
    }
    public function international_university()
    {
        return $this->belongsTo(InternationalUniversity::class, 'international_university_id', 'id') ?? '';
    }
    public function international_program()
    {
        return $this->belongsTo(InternationalProgram::class, 'international_program_id', 'id') ?? '';
    }
    public function international_funding()
    {
        return $this->belongsTo(InternationalFunding::class, 'international_funding_id', 'id') ?? '';
    }
    public function getInternationalStatusNameAttribute()
    {
        return $this->international_status?->name;
    }
    public function getInternationalCategoryNameAttribute()
    {
        return $this->international_category->name;
    }
    public function getInternationalUniversityNameAttribute()
    {
        return $this->international_university->name;
    }
    public function getInternationalUniversityCountryAttribute()
    {
        return $this->international_university->country->name;
    }
    public function getInternationalProgramNameAttribute()
    {
        return $this->international_program->name;
    }
    public function getInternationalFundingNameAttribute()
    {
        return $this->international_funding->name;
    }
}
