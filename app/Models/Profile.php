<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'photo',
        'phone_number',
        'age',
        'gender',
        'nationality',
        'language',
        'region_id',
        'certificate',
        'overview',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }
}
