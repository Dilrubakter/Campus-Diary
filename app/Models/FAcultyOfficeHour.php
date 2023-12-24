<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAcultyOfficeHour extends Model
{
    use HasFactory;

    protected $table = 'faculty_offie_hour';
    protected $primaryKey = 'faculty_offie_hour_id';

    protected $fillable = [
        'faculty_offie_hour_uuid',
        'faculty_offie_hour_lab_uuid',
        'faculty_offie_hour_day_uuid',
        'faculty_offie_hour_start_time',
        'faculty_offie_hour_end_time',
        'faculty_offie_hour_subject_code',
        'faculty_offie_hour_room_no',
        'faculty_offie_hour_office_hour',
        'faculty_offie_hour_idle',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->faculty_offie_hour_uuid = (string) Str::orderedUuid();
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
