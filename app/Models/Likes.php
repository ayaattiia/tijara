<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'Likes';
    protected $primaryKey = 'IdLike';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'TargetType',
        'TargetId',
        'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
