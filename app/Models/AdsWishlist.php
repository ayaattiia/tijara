<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsWishlist extends Model
{
    protected $table = 'AdsWishlist';
    protected $primaryKey = 'IdWishlistAd';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdAd',
        'Liked'
    ];

    public function wishlistad()
    {
        return $this->belongsTo(\App\Models\WishlistAds::class, 'IdWishlistAd', 'IdWish');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function ad()
    {
        return $this->belongsTo(\App\Models\Ads::class, 'IdAd', 'IdAd');
    }

}
