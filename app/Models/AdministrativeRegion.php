<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeRegion extends Model
{
    use HasFactory;

    protected $table = 'administrative_regions';

    protected $fillable = [
        'admin_id',
        'name',
        'photo',
        'is_active',
    ];

    //region
    public function regions(){
        return $this->hasMany(Region::class);
    }
    public function region(){
        return $this->hasOne(Region::class);
    }
    //landmark
    public function landmarks(){
        return $this->hasMany(Landmark::class);
    }
    public function landmark(){
        return $this->hasOne(Landmark::class);
    }
     //activity
    public function activities(){
        return $this->hasMany(Activity::class);
    }
    public function activity(){
        return $this->hasOne(Activity::class);
    }
    //order
    public function order(){
        return $this->hasOne(Order::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
