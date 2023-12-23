<?php

namespace App\Models;

use App\Models\Day;
use Illuminate\Support\Str;
use App\Models\TimeSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfficeHour extends Model
{
    use HasFactory;

    protected $table = 'office_hours';
    protected $primaryKey = 'office_hours_id';

    protected $fillable = [
        'office_hours_uuid',
        'office_hours_persons_uuid',
        'office_hours_day_uuid',
        'office_hours_start_time',
        'office_hours_end_time',
        'office_hours_subject_code',
        'office_hours_room_no',
        'office_hours_office_hour',
        'office_hours_idle',
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
            $model->office_hours_uuid = (string) Str::orderedUuid();
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
