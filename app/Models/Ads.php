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
        'Type',
        'IdFeature',
        'IdFV'
    ];

    protected $hidden = ['IdState', 'IdCountry'];
    public function categ()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'IdCateg', 'IdCateg');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function typecat()
    {
        return $this->belongsTo(\App\Models\TypeCategory::class, 'Idtypecat', 'Idtypecat');
    }

    public function feature()
    {
        return $this->belongsTo(\App\Models\Features::class, 'IdFeature', 'IdFeature');
    }

    public function featureValue()
    {
        return $this->belongsTo(\App\Models\FeaturesValues::class, 'IdFV', 'IdFV');
    }
}
