<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landmark extends Model
{
    use HasFactory;

    protected $table = 'landmarks';

    protected $fillable = [
        'region_id',
        'name',
        'description',
        'photo',
        'location',
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function activities(){
        return $this->hasMany(Activity::class,'region_id');
    }
}
