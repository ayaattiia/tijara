<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    protected $table = 'TypeCategory';
    protected $primaryKey = 'Idtypecat';
    public $timestamps = false;

    protected $fillable = [
        'Title'
    ];

}
