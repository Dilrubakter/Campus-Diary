<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\MarketPlaceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaketPlace extends Model
{
    use HasFactory;


    protected $table = 'marketplace';
    protected $primaryKey = 'marketplace_id';

    protected $fillable = [
        'marketplace_uuid',
        'marketplace_product_category',
        'marketplace_person_uuid',
        'marketplace_product_name',
        'marketplace_product_description',
        'marketplace_product_price',
        'marketplace_product_photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function category()
    {
        return $this->belongsTo(MarketPlaceCategory::class, 'marketplace_product_category', 'marketplace_category_uuid');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->marketplace_uuid = (string) Str::orderedUuid();
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
