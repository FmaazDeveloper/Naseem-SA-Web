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
        'admin_id',
        'location',
        'number_of_people',
        'number_of_days',
        'status',
        'closed_at',
    ];

    public function tourist(){
        return $this->belongsTo(Tourist::class);
    }
    public function guide(){
        return $this->belongsTo(Guide::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function regionable(){
        return $this->morphTo();
    }
}
