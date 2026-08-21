<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdBoosts extends Model
{
    protected $table = 'ad_boosts';
    protected $primaryKey = 'IdAdBoost';
    public $timestamps = false;

    protected $fillable = [
        'IdAd',
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

    public function ad()
    {
        return $this->belongsTo(Ads::class, 'IdAd', 'IdAd');
    }

    public function pack()
    {
        return $this->belongsTo(BoostAdsPacks::class, 'IdBoost', 'IdBoost');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'IdUser', 'IdUser');
    }

    public function scopeCurrentlyActive($query)
    {
        return $query->where('Active', true)->where('EndDate', '>=', now());
    }
}
