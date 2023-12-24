<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\LabOffieHourDay;

class LabInformation extends Model
{
    use HasFactory;

    protected $table = 'lab_information';
    protected $primaryKey = 'lab_information_id';

    protected $fillable = [
        'lab_information_uuid',
        'lab_information_name',
        'lab_information_room_no',
        'lab_information_photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function personOfficeHour(){
        return $this->hasMany(LabOffieHourDay::class, 'lab_office_hour_day_lab_uuid', 'lab_information_uuid');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->lab_information_uuid = (string) Str::orderedUuid();
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
