<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsFeatureValues extends Model
{
    protected $table = 'AdsFeatureValues';

    protected $primaryKey = 'IdAdFeatureValue';

    public $timestamps = false;

    protected $fillable = [
        'IdAd',
        'IdFV',
    ];

    public function ad()
    {
        return $this->belongsTo(Ads::class, 'IdAd', 'IdAd');
    }

    public function featureValue()
    {
        return $this->belongsTo(FeaturesValues::class, 'IdFV', 'IdFV');
    }
}
