<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'Invoices';
    protected $primaryKey = 'IdInvoice';
    public $timestamps = false;

    protected $fillable = [
        'Number',
        'IdOrder',
        'IdUser',
        'IdVendor',
        'Subtotal',
        'Tax',
        'DeliveryFee',
        'Total',
        'Status',
        'IssuedAt',
        'PaidAt'
    ];

    public function order()
    {
        return $this->belongsTo(\App\Models\Orders::class, 'IdOrder', 'IdOrder');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function vendor()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdVendor', 'IdUser');
    }

}
