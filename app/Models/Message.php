<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Users;

class Message extends Model
{
    protected $fillable = ['conversation_id', 'user_id', 'body', 'attachment_path', 'attachment_type'];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'IdUser');
    }
    // app/Models/Message.php
    protected $appends = [
        'attachment_url',
    ];

    public function getAttachmentUrlAttribute()
    {
        if (!$this->attachment_path) {
            return null;
        }

        return asset($this->attachment_path);
    }
}
