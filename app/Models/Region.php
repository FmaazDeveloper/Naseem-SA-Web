<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table ='regions';

    protected $fillable = [
        'type',
        'name',
        'main_description',
        'weather_description',
        'card_description',
        'card_photo',
    ];

    public function admin(){
        return $this->belongsTo(User::class);
    }
    public function landmarks(){
        return $this->hasMany(Landmark::class);
    }
    public function activities(){
        return $this->hasMany(Activity::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
