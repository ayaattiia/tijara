<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Errors extends Model
{
    protected $table = 'Errors';
    protected $primaryKey = 'IdError';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'TitleError',
        'Req',
        'ReqError',
        'ExceptionError',
        'OtheError',
        'Page',
        'Action',
        'dateTimeError',
        'Validate'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
