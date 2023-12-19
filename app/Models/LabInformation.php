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
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'room_no',
        'photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function personOfficeHour(){
        return $this->hasMany(LabOffieHourDay::class, 'lab_uuid', 'uuid');
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
