<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landmark extends Model
{
    use HasFactory;

    protected $table = 'landmarks';

    protected $fillable = [
        'administrative_region_id',
        'region_id',
        'name',
        'description',
        'photo',
        'location',
        'is_active',
    ];
    
    public function administrative_region(){
        return $this->belongsTo(AdministrativeRegion::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function activity(){
        return $this->hasOne(Activity::class,'landmark_id');
    }
    public function activities(){
        return $this->hasMany(Activity::class,'landmark_id');
    }
}
