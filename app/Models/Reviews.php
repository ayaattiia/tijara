<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'Reviews';
    protected $primaryKey = 'IdReview';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'TargetType',
        'TargetId',
        'Rating',
        'Comment',
        'Active',
        'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
