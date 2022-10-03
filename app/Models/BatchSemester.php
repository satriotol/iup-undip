<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchSemester extends Model
{
    use HasFactory;

    protected $fillable = ['batch_id', 'year', 'semester'];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('year', 'asc')->orderBy('semester', 'asc');
        });
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }
    public function batch_semester_user_mahasiswas()
    {
        return $this->hasMany(BatchSemesterUserMahasiswa::class, 'batch_semester_id', 'id');
    }
}
