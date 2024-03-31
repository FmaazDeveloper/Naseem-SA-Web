<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landmark extends Model
{
    use HasFactory;

    protected $table = 'landmarks';

    protected $fillable = [
        'landmarkable_id',
        'landmarkable_type',
        'name',
        'description',
        'photo',
        'location',
    ];

    public function landmarkable(){
        return $this->morphTo();
    }
}
