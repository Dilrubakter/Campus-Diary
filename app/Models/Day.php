<?php

namespace App\Models;

use App\Models\OfficeHour;
use Illuminate\Support\Str;
use App\Models\TimeSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model
{
    use HasFactory;

    protected $table = 'date';
    protected $primaryKey = 'day_id';

    protected $fillable = [
        'day_uuid',
        'day_day',
        'day_short_name',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function officeHour()
    {
        return $this->hasMany(OfficeHour::class, 'office_hours_day_uuid', 'day_uuid');
    }


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->day_uuid = (string) Str::orderedUuid();
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
