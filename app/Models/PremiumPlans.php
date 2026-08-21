<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PremiumPlans extends Model
{
    protected $table = 'PremiumPlans';

    protected $primaryKey = 'IdPremiumPlan';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Slug',
        'DurationMonths',
        'Price',
        'Currency',
        'Active',
        'CreatedAt',
        'UpdatedAt',
    ];

    protected $casts = [
        'IdPremiumPlan' => 'integer',
        'DurationMonths' => 'integer',
        'Price' => 'decimal:3',
        'Active' => 'boolean',
        'CreatedAt' => 'datetime:Y-m-d H:i:s',
        'UpdatedAt' => 'datetime:Y-m-d H:i:s',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(
            PremiumSubscriptions::class,
            'IdPremiumPlan',
            'IdPremiumPlan'
        );
    }
}
