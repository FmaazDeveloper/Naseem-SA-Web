<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'landmark_id',
        'description',
    ];

    public function landmark(){
        return $this->belongsTo(Landmark::class);
    }
    public function activityable(){
        return $this->morphTo();
    }
}
