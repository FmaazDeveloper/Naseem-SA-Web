<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table ='regions';

    protected $fillable = [
        'admin_id',
        'type',
        'name',
        'main_description',
        'weather_description',
        'card_description',
        'card_photo',
        'is_active',
    ];

    //admin
    public function admin(){
        return $this->belongsTo(User::class);
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
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
