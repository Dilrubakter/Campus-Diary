<?php
namespace App\Models;

use App\Models\OfficeHour;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TAInformations extends Model
{
    use HasFactory;

    protected $table = 'ta_informations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'dob',
        'gender',
        'contact',
        'designations',
        'email',
        'phone_no',
        'photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];


    public function officeHours()
    {
        return $this->belongsTo(OfficeHour::class, 'uuid', 'persons_uuid');
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
