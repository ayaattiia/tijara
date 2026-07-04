<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'Messages';
    protected $primaryKey = 'IdMessage';
    public $timestamps = false;

    protected $fillable = [
        'IdUserSender',
        'IdUserReceiver',
        'DateMessage',
        'IdMessageReplay',
        'Message',
        'Active'
    ];

    public function usersender()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUserSender', 'IdUser');
    }

}
