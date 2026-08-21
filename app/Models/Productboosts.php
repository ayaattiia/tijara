<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBoosts extends Model
{
    protected $table = 'product_boosts';
    protected $primaryKey = 'IdProductBoost';
    public $timestamps = false;

    protected $fillable = [
        'IdProduct',
        'IdBoost',
        'IdUser',
        'StartDate',
        'EndDate',
        'Active',
    ];

    protected $casts = [
        'StartDate' => 'datetime',
        'EndDate'   => 'datetime',
        'Active'    => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'IdProduct', 'IdProduct');
    }

    public function pack()
    {
        return $this->belongsTo(BoostAdsPacks::class, 'IdBoost', 'IdBoost');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'IdUser', 'IdUser');
    }

    /**
     * A boost is "currently live" only if it's still flagged Active AND
     * hasn't passed its EndDate. We never rely solely on a stored Active
     * flag for natural expiry - EndDate is the real source of truth for
     * "did this expire", Active is only for early manual admin takedown.
     */
    public function scopeCurrentlyActive($query)
    {
        return $query->where('Active', true)->where('EndDate', '>=', now());
    }
}
