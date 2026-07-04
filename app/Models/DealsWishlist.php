<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealsWishlist extends Model
{
    protected $table = 'DealsWishlist';
    protected $primaryKey = 'IdWishlistDeal';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdDeal',
        'Liked'
    ];

    public function wishlistdeal()
    {
        return $this->belongsTo(\App\Models\WishlistDeals::class, 'IdWishlistDeal', 'IdWish');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function deal()
    {
        return $this->belongsTo(\App\Models\Deals::class, 'IdDeal', 'IdDeal');
    }

}
