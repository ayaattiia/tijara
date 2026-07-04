<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table = 'Ratings';
    protected $primaryKey = 'IdRating';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'Rating',
        'CommentRating',
        'Date',
        'TableName',
        'IdTable',
        'Active'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
