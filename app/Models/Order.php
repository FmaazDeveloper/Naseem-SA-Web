<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'tourist_id',
        'guide_id',
        'status',
        'date_end',
        'time_end',
    ];

    public function tourist(){
        return $this->belongsTo(Tourist::class);
    }
    public function guide(){
        return $this->belongsTo(Guide::class);
    }
}
