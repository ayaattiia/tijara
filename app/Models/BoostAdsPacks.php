<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoostAdsPacks extends Model
{
    protected $table = 'BoostAdsPacks';
    protected $primaryKey = 'IdBoost';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'Price',
        'Discount',
        'MaxDuration',
        'Sliders',
        'SideBar',
        'Footer',
        'RelatedPost',
        'FirstLogin',
        'OrdersCount',
        'Links',
        'Active',
        'CreatedAt'
    ];

    public function boost()
    {
        return $this->belongsTo(\App\Models\Boosts::class, 'IdBoost', 'IdBoost');
    }

}
