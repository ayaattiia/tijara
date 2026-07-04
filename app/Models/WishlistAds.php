<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistAds extends Model
{
    protected $table = 'WishlistAds';
    protected $primaryKey = 'IdWish';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdAd',
        'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function ad()
    {
        return $this->belongsTo(\App\Models\Ads::class, 'IdAd', 'IdAd');
    }

}
