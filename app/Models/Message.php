<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Define fillable fields
    protected $fillable = ['chat_id', 'sender_id', 'message'];

    // Relationship with Chat
    public function chat() {
        return $this->belongsTo(Chat::class);
    }
    
    // Relationship with Sender
    public function sender() {
        return $this->belongsTo(Account::class, 'sender_id');
    }
}
