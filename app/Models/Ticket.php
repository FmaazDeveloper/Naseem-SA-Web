<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'admin_id',
        'contact_reason_id',
        'status',
        'title',
        'message',
        'ticket_file',
        'answer',
        'answer_file',
        'closed_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function admin(){
        return $this->belongsTo(User::class,'admin_id');
    }
    public function contact_reason(){
        return $this->belongsTo(ContactReasons::class);
    }
}
