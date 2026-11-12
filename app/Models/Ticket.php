<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'reference',
        'subject',
        'description',
        'priority',
        'status',
        'user_id',
        'assigned_to'
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    public function histories()
    {
        return $this->hasMany(TicketHistory::class)->latest();
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->oldest();
    }
}
