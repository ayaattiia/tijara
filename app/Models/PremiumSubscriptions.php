<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PremiumSubscriptions extends Model
{
    protected $table = 'PremiumSubscriptions';

    protected $primaryKey = 'IdPremiumSubscription';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdPremiumPlan',
        'IdPayment',
        'Price',
        'Currency',
        'StartDate',
        'EndDate',
        'Status',
        'PaymentStatus',
        'CancelledAt',
        'CreatedAt',
        'UpdatedAt',
    ];

    protected $casts = [
        'IdPremiumSubscription' => 'integer',
        'IdUser' => 'integer',
        'IdPremiumPlan' => 'integer',
        'IdPayment' => 'integer',

        'Price' => 'decimal:3',
        'StartDate' => 'datetime:Y-m-d H:i:s',
        'EndDate' => 'datetime:Y-m-d H:i:s',
        'CancelledAt' => 'datetime:Y-m-d H:i:s',
        'CreatedAt' => 'datetime:Y-m-d H:i:s',
        'UpdatedAt' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The user who owns this subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            Users::class,
            'IdUser',
            'IdUser'
        );
    }

    /**
     * The Premium plan used by this subscription.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(
            PremiumPlans::class,
            'IdPremiumPlan',
            'IdPremiumPlan'
        );
    }

    /**
     * The payment associated with this subscription.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(
            Payments::class,
            'IdPayment',
            'IdPayment'
        );
    }
}
