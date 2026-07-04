<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boosts extends Model
{
    protected $table = 'Boosts';
    protected $primaryKey = 'IdBoost';
    public $timestamps = false;

    protected $fillable = [
        'TitleBoost',
        'Price',
        'Discount',
        'MaxDurationPerDay',
        'InSliders',
        'InSideBar',
        'InFooter',
        'InRelatedPost',
        'InFirstLogin',
        'HasLinks',
        'Orders'
    ];

}
