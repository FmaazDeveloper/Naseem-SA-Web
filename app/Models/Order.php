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
        'status',
        'number_of_people',
        'start_date',
        'end_date',
        'closed_at',
    ];

    public function tourist(){
        return $this->belongsTo(User::class,'tourist_id');
    }
    public function guide(){
        return $this->belongsTo(User::class,'guide_id');
    }
    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }
    // public function status_type(){
    //     return $this->belongsTo(StatusType::class,'status_id');
    // }
}
