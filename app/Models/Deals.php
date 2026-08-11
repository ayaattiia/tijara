<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    protected $table = 'Deals';
    protected $primaryKey = 'IdDeal';
    public $timestamps = false;

    protected $fillable = [
        'titleDeal',
        'descriptionDeal',
        'detailsDeal',
        'priceDeal',
        'discountDeal',
        'quantity',
        'datePublication',
        'dateEnd',
        'imageDeal',
        'idtypecat',
        'idCateg',
        'idUser',
        'idState',
        'idPrize',
        'locationDeal',
        'active',
        'colors',
        'likes',
        'liked',
        'telephone',
        'email',
        'ownerdeals',
        'brand',
        'startDate',
        'TotalCount',
        'ViewCount',
        'LastViewedAt'
    ];

    public function idtypecat()
    {
        return $this->belongsTo(\App\Models\TypeCategory::class, 'idtypecat', 'Idtypecat');
    }

    public function idcateg()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'idCateg', 'IdCateg');
    }

    public function iduser()
    {
        return $this->belongsTo(\App\Models\Users::class, 'idUser', 'IdUser');
    }

    public function idstate()
    {
        return $this->belongsTo(\App\Models\States::class, 'idState', 'IdState');
    }

    public function idprize()
    {
        return $this->belongsTo(\App\Models\Prizes::class, 'idPrize', 'idPrize');
    }

    public function likedBy()
    {
        return $this->hasMany(\App\Models\DealLikes::class, 'IdDeal', 'IdDeal');
    }

    public function getQuantityProgressAttribute()
    {
        $total = (int) $this->TotalCount;
        $remaining = (int) $this->quantity;

        if ($total <= 0) {
            return 0;
        }

        $sold = $total - $remaining;
        return round(($sold / $total) * 100, 1);
    }

    public function getTimeRemainingAttribute()
    {
        if (empty($this->dateEnd)) {
            return null;
        }
        return max(0, now()->diffInSeconds(\Carbon\Carbon::parse($this->dateEnd), false));
    }

    public function getTimeProgressAttribute()
    {
        if (empty($this->startDate) || empty($this->dateEnd)) {
            return 0;
        }

        $start = \Carbon\Carbon::parse($this->startDate);
        $end = \Carbon\Carbon::parse($this->dateEnd);
        $total = $start->diffInSeconds($end);
        $elapsed = $start->diffInSeconds(now());

        return $total > 0 ? min(100, round(($elapsed / $total) * 100, 1)) : 100;
    }

    public function getIsExpiredAttribute()
    {
        $remaining = (int) $this->quantity;
        return $remaining <= 0 || (!empty($this->dateEnd) && now()->greaterThan($this->dateEnd));
    }

    protected $appends = ['QuantityProgress', 'TimeRemaining', 'TimeProgress', 'IsExpired'];
}
