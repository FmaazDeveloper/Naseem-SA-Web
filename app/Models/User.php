<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;


     public function getAuthPasswordName()
    {
        return 'password';
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function guide_orders(){
        return $this->hasMany(Order::class,'guide_id');
    }
    public function tourist_orders(){
        return $this->hasMany(Order::class,'tourist_id');
    }
    public function order(){
        return $this->hasOne(Order::class);
    }
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function ticket(){
        return $this->hasOne(Ticket::class);
    }
}
