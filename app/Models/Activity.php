<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'administrative_region_id',
        'region_id',
        'landmark_id',
        'description',
        'photo',
        'is_active',
    ];

    public function administrative_region(){
        return $this->belongsTo(AdministrativeRegion::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function landmark(){
        return $this->belongsTo(Landmark::class);
    }
}
