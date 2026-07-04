<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    protected $table = 'AdminSettings';
    protected $primaryKey = 'Key';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'Key',
        'Value',
        'UpdatedAt'
    ];

}
