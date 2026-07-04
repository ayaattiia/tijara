<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'Permissions';
    protected $primaryKey = 'IdPermission';
    public $timestamps = false;

    protected $fillable = [
        'IdRole',
        'IdListPermission',
        'PermissionDate',
        'Resource',
        'CanRead',
        'CanCreate',
        'CanUpdate',
        'CanDelete'
    ];

    public function role()
    {
        return $this->belongsTo(\App\Models\Roles::class, 'IdRole', 'IdRole');
    }

    public function listpermission()
    {
        return $this->belongsTo(\App\Models\ListPermissions::class, 'IdListPermission', 'IdListPermission');
    }

}
