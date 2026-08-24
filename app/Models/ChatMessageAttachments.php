<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessageAttachments extends Model
{
    protected $table = 'ChatMessageAttachments';

    protected $primaryKey = 'IdAttachment';

    public $timestamps = false;

    protected $fillable = [
        'IdChatMessage',
        'OriginalName',
        'FileName',
        'FilePath',
        'MimeType',
        'FileSize',
        'CreatedAt',
        'Active',
    ];


    /**
     * Relation vers le message.
     */
    public function message()
    {
        return $this->belongsTo(
            Message::class,
            'IdChatMessage',
            'id'
        );
    }
}
