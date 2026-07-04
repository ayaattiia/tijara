<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'Roles';
    protected $primaryKey = 'IdRole';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'IdRole',
        'RoleUser',
        'Active'
    ];

}
