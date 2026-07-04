<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transports extends Model
{
    protected $table = 'Transports';
    protected $primaryKey = 'IdTransport';
    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Logo',
        'Phone',
        'Email',
        'DeliveryFee',
        'FreeFrom',
        'Zones',
        'Active',
        'CreatedAt'
    ];

}
