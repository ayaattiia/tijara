<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistDeals extends Model
{
    protected $table = 'WishlistDeals';
    protected $primaryKey = 'IdWish';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdDeal',
        'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function deal()
    {
        return $this->belongsTo(\App\Models\Deals::class, 'IdDeal', 'IdDeal');
    }

}
