<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'Ads';
    protected $primaryKey = 'IdAd';
    public $timestamps = false;

    protected $fillable = [
        'TitleAd',
        'DescriptionAd',
        'DetailsAd',
        'PriceAd',
        'IdPricesDelevery',
        'DatePublication',
        'ImageAd',
        'VideoAd',
        'IdCateg',
        'IdUser',
        'IdState',
        'IdCountry',
        'LocationAd',
        'DateEnd',
        'Color',
        'Brand',
        'Ownerads',
        'Telephone',
        'Email',
        'StartDate',
        'Idtypecat',
        'Active',
        'Type'
    ];

    public function categ()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'IdCateg', 'IdCateg');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\States::class, 'IdState', 'IdState');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountry', 'IdCountry');
    }

    public function typecat()
    {
        return $this->belongsTo(\App\Models\TypeCategory::class, 'Idtypecat', 'Idtypecat');
    }

}
