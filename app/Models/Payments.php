<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    protected $casts = [
        'IdPayment' => 'integer',
        'IdUser' => 'integer',
        'IdOrder' => 'integer',
        'Amount' => 'decimal:3',
        'CreatedAt' => 'datetime:Y-m-d H:i:s',
        'PaidAt' => 'datetime:Y-m-d H:i:s',
    ];
    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Orders::class, 'IdOrder', 'IdOrder');
    }

    /**
     * Premium subscription paid by this payment.
     */
    public function premiumSubscription(): HasOne
    {
        return $this->hasOne(
            PremiumSubscriptions::class,
            'IdPayment',
            'IdPayment'
        );
    }
}
