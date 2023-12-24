<?php
namespace App\Models;

use App\Models\OfficeHour;
use Illuminate\Support\Str;
use App\Models\PersonOfficeHourDay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyInformation extends Model
{
    use HasFactory;

    protected $table = 'faculty_informations';
    protected $primaryKey = 'faculty_informations_id';

    protected $fillable = [
        'faculty_informations_uuid',
        'faculty_informations_first_name',
        'faculty_informations_last_name',
        'faculty_informations_dob',
        'faculty_informations_gender',
        'faculty_informations_contact',
        'faculty_informations_designations',
        'faculty_informations_email',
        'faculty_informations_room',
        'faculty_informations_bio',
        'faculty_informations_faculty_type',
        'faculty_informations_photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];


    public function personOfficeHour()
    {
        return $this->hasMany(FacultyOfficeHourDay::class, 'faculty_office_hour_day_faculty_uuid', 'faculty_informations_uuid');
    }


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->faculty_informations_uuid = (string) Str::orderedUuid();
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
