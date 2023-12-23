<?php

namespace App\Models;

use App\Models\Day;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeSchedule extends Model
{
    use HasFactory;

    protected $table = 'time_schedule';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'day_uuid',
        'start_time',
        'end_time',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function officeHours()
    {
        return $this->hasMany(OfficeHour::class, 'time_uuid', 'uuid');
    }

    public function day(){
        return $this->belongsTo(Day::class, 'day_uuid', 'day_uuid');
    }




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
