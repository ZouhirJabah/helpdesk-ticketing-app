<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'message', 'is_read'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
