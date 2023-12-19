<?php
namespace App\Models;

use App\Models\OfficeHour;
use Illuminate\Support\Str;
use App\Models\PersonOfficeHourDay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TAInformations extends Model
{
    use HasFactory;

    protected $table = 'ta_informations';
    protected $primaryKey = 'ta_informations_id';

    protected $fillable = [
        'ta_informations_uuid',
        'ta_informations_first_name',
        'ta_informations_last_name',
        'ta_informations_dob',
        'ta_informations_gender',
        'ta_informations_contact',
        'ta_informations_designations',
        'ta_informations_semail',
        'ta_informations_phone_no',
        'ta_informations_photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];


    public function personOfficeHour()
    {
        return $this->hasMany(PersonOfficeHourDay::class, 'person_office_hour_day_person_uuid', 'ta_informations_uuid');
    }


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->ta_informations_uuid = (string) Str::orderedUuid();
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
