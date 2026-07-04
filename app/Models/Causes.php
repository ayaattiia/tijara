<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Causes extends Model
{
    protected $table = 'Causes';
    protected $primaryKey = 'IdCause';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'Description',
        'Email',
        'Type',
        'Active',
        'CreatedAt'
    ];

}
