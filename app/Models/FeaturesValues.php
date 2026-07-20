<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturesValues extends Model
{
    protected $table = 'FeaturesValues';
    protected $primaryKey = 'IdFV';
    public $timestamps = false;

    protected $fillable = [
        'ValueFeature',
        'IdFeature',
        'Active'
    ];

    // Don't expose the internal AdsFeatureValues pivot row in JSON output
    protected $hidden = ['pivot'];

    public function feature()
    {
        return $this->belongsTo(\App\Models\Features::class, 'IdFeature', 'IdFeature');
    }

    /**
     * Ads this value is attached to, through the AdsFeatureValues link table.
     */
    public function ads()
    {
        return $this->belongsToMany(
            \App\Models\Ads::class,
            'AdsFeatureValues',
            'IdFV',
            'IdAd'
        );
    }

    /**
     * Products this value is attached to, through the ProductsFeatureValues link table.
     */
    public function products()
    {
        return $this->belongsToMany(
            \App\Models\Products::class,
            'ProductsFeatureValues',
            'IdFV',
            'IdProduct'
        );
    }
}
