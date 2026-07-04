<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    protected $table = 'ChatMessages';
    protected $primaryKey = 'IdChatMessage';
    public $timestamps = false;

    protected $fillable = [
        'IdChatMessage',
        'IdChat',
        'Message',
        'CreateDate',
        'IdUserSender',
        'Report',
        'AdminReview',
        'Active'
    ];

    public function chat()
    {
        return $this->belongsTo(\App\Models\Chats::class, 'IdChat', 'IdChat');
    }

    public function usersender()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUserSender', 'IdUser');
    }

}
