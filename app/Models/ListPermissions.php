<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListPermissions extends Model
{
    protected $table = 'ListPermissions';
    protected $primaryKey = 'IdListPermission';
    public $timestamps = false;

    protected $fillable = [
        'TitleEn',
        'TitleFr',
        'TitleAr',
        'Description',
        'GroupName'
    ];

}
