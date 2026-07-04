<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    protected $table = 'Deliveries';
    protected $primaryKey = 'IdDelivery';
    public $timestamps = false;

    protected $fillable = [
        'IdOrder',
        'IdTransport',
        'TrackingNumber',
        'Status',
        'AddressLine',
        'City',
        'PostalCode',
        'Phone',
        'DeliveryFee',
        'EstimatedAt',
        'DeliveredAt',
        'Note',
        'CreatedAt',
        'UpdatedAt'
    ];

    public function order()
    {
        return $this->belongsTo(\App\Models\Orders::class, 'IdOrder', 'IdOrder');
    }

    public function transport()
    {
        return $this->belongsTo(\App\Models\Transports::class, 'IdTransport', 'IdTransport');
    }

}
