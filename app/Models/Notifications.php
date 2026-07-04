<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'Notifications';
    protected $primaryKey = 'IdNotification';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'Description',
        'Date',
        'Type',
        'IsRead',
        'IdUser'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
