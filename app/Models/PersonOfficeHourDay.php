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
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'person_uuid',
        'day_uuid',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function day(){
        return $this->hasMany(Day::class, 'uuid', 'day_uuid');
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
