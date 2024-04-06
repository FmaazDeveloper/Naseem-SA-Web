<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';

    protected $fillable = [
        'profileable_id',
        'profileable_type',
        'nationality',
        'phone_number',
        'age',
        'gender',
        'language',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
