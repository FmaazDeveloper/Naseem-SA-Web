<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    use HasFactory;

    protected $table = 'islands';

    protected $fillable = [
        'name',
        'main_description',
        'weather_description',
        'card_description',
        'card_photo',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function order(){
        return $this->morphOne(Order::class,'regionable');
    }
    public function activity(){
        return $this->morphOne(Activity::class,'activityable');
    }
    public function landmark(){
        return $this->morphOne(Landmark::class,'landmarkable');
    }
}
