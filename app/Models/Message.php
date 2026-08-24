<?php

namespace App\Models;

use App\Models\ChatMessageAttachments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'user_id', 'room', 'content'];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'IdUser');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function attachments()
    {
        return $this->hasMany(
            ChatMessageAttachments::class,
            'IdChatMessage',
            'id'
        );
    }
}
