<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'tourist_id',
        'guide_id',
        'admin_id',
        'region_id',
        'number_of_people',
        'number_of_days',
        'status',
        'closed_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
}
