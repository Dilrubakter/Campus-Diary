<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyOfficeHourDay extends Model
{
    use HasFactory;

    protected $table = 'faculty_office_hour_day';
    protected $primaryKey = 'faculty_office_hour_day_id';

    protected $fillable = [
        'faculty_office_hour_day_uuid',
        'faculty_office_hour_day_faculty_uuid',
        'faculty_office_hour_day_day_uuid',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function day(){
        return $this->hasMany(Day::class, 'day_uuid', 'faculty_office_hour_day_day_uuid');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->faculty_office_hour_day_uuid = (string) Str::orderedUuid();
            $model->created_by = auth()->user()->id;
        });

        self::updating(function ($model) {
            $model->updated_by = auth()->user()->id;
        });

        self::deleting(function ($model) {
            $model->deleted_by = auth()->user()->id;
        });
    }
}
