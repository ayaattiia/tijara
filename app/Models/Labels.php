<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labels extends Model
{
    protected $table = 'Labels';
    protected $primaryKey = 'IdLabel';
    public $timestamps = false;

    protected $fillable = [
        'TitleEn',
        'TitleFr',
        'TitleAr',
        'Color',
        'Active'
    ];

}
