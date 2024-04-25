<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;


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
    public function orders(){
        return $this->hasMany(Order::class);
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
