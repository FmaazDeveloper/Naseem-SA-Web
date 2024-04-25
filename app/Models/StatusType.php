<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusType extends Model
{
    use HasFactory;

    protected $table ='status_types';

    protected $fillable = [
        'admin_id',
        'name',
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function ticket(){
        return $this->hasOne(Ticket::class);
    }
}
