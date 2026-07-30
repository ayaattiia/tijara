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
        'conversation_user',   // nom exact de la table pivot
        'conversation_id',     // clé de CE modèle dans la pivot
        'idUser'                // clé de l'AUTRE modèle (Users) dans la pivot
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