<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $table = 'Chats';
    protected $primaryKey = 'IdChat';
    public $timestamps = false;

    protected $fillable = [
        'IdUserSender',
        'IdUserReciver',
        'CreatedAt',
        'AdminReview',
        'Active'
    ];

    public function usersender()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUserSender', 'IdUser');
    }

}
