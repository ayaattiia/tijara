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
        'DatePublication',
        'ImageAd',
        'VideoAd',
        'IdCateg',
        'IdUser',
        'IdState',
        'IdCountry',
        'LocationAd',
        'DateEnd',
        'Brand',
        'Ownerads',
        'Telephone',
        'Email',
        'StartDate',
        'Active',
        'Type',
    ];

    protected $hidden = ['IdState', 'IdCountry'];

    // Explicit mutators/accessors instead of $casts — these always run
    // no matter what, so ImageAd/VideoAd are guaranteed to be stored as
    // JSON strings and returned as PHP arrays.
    public function setImageAdAttribute($value)
    {
        $this->attributes['ImageAd'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getImageAdAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE && is_array($decoded)
            ? $decoded
            : ($value ? [$value] : []); // legacy plain-string fallback
    }

    public function setVideoAdAttribute($value)
    {
        $this->attributes['VideoAd'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getVideoAdAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE && is_array($decoded)
            ? $decoded
            : ($value ? [$value] : []); // legacy plain-string fallback
    }

    public function categ()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'IdCateg', 'IdCateg');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    /**
     * FeaturesValues attached to this ad, through the AdsFeatureValues
     * link table. No dedicated pivot model — just a table name.
     * Eager-load 'values.feature' to get feature + value together.
     */
    public function values()
    {
        return $this->belongsToMany(
            \App\Models\FeaturesValues::class,
            'AdsFeatureValues',
            'IdAd',
            'IdFV'
        )->withPivot('IdAdFeatureValue');
    }
}
