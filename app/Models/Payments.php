<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'Payments';
    protected $primaryKey = 'IdPayment';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdOrder',
        'Amount',
        'Method',
        'Status',
        'Reference',
        'TransactionId',
        'CreatedAt',
        'PaidAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Orders::class, 'IdOrder', 'IdOrder');
    }

}
