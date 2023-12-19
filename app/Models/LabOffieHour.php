<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabOffieHour extends Model
{
    use HasFactory;

    protected $table = 'lab_offie_hour';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'lab_uuid',
        'day_uuid',
        'start_time',
        'end_time',
        'subject_code',
        'room_no',
        'office_hour',
        'idle',
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
            $model->uuid = (string) Str::orderedUuid();
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
