<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTokens extends Model
{
    protected $table = 'EmailTokens';
    protected $primaryKey = 'IdToken';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'Token',
        'Type',
        'ExpiresAt',
        'Used',
        'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
