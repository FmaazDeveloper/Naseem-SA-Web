<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'region_id',
        'landmark_id',
        'description',
        'is_active',
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function landmark(){
        return $this->belongsTo(Landmark::class);
    }
}
