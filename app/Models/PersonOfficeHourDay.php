<?php

namespace App\Models;

use App\Models\Day;
use Illuminate\Support\Str;
use App\Models\TimeSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonOfficeHourDay extends Model
{

    use HasFactory;

    protected $table = 'person_office_hour_day';
    protected $primaryKey = 'person_office_hour_day_id';

    protected $fillable = [
        'person_office_hour_day_uuid',
        'person_office_hour_day_person_uuid',
        'person_office_hour_day_day_uuid',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function day()
    {
        return $this->hasMany(Day::class, 'day_uuid', 'person_office_hour_day_day_uuid');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->person_office_hour_day_uuid = (string) Str::orderedUuid();
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
