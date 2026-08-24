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
        'IdUser',
    ];

    protected $casts = [
        'Date' => 'datetime',
        'IsRead' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(
            Users::class,
            'IdUser',
            'IdUser'
        );
    }
}
