<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Users;

class Conversation extends Model
{
    protected $fillable = ['name'];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            Users::class,
            'conversation_user',
            'conversation_id',
            'idUser',
            'id',
            'IdUser'
        );
    }
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }
}
