<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubInformationPanelMember extends Model
{
    use HasFactory;

    protected $table = 'club_information_panel_members';
    protected $primaryKey = 'club_information_panel_members_id';

    protected $fillable = [
        'club_information_panel_members_uuid',
        'club_information_panel_members_club_information_uuid',
        'club_information_panel_members_name',
        'club_information_panel_members_designation',
        'club_information_panel_members_photo',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->club_information_panel_members_uuid = (string) Str::orderedUuid();
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
