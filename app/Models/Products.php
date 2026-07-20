<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'Products';
    protected $primaryKey = 'IdProduct';
    public $timestamps = false;

    protected $fillable = [
        'CodeBarProduct',
        'CodeProduct',
        'ReferenceProduct',
        'TitleProduct',
        'DescriptionProduct',
        'QuantityProduct',
        'PriceProduct',
        'TvaProduct',
        'IdPricesDelevery',
        'ImageProduct',
        'VideoProduct',
        'IdPrize',
        'IdCateg',
        'IdUser',
        'IdCountrie',
        'Active',
    ];

    protected $hidden = ['IdCountrie'];

    // Explicit mutators/accessors (not $casts) — always run regardless of
    // cast-detection issues, guaranteed to store/read ImageProduct and
    // VideoProduct as JSON arrays of paths.
    public function setImageProductAttribute($value)
    {
        $this->attributes['ImageProduct'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getImageProductAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE && is_array($decoded)
            ? $decoded
            : ($value ? [$value] : []);
    }

    public function setVideoProductAttribute($value)
    {
        $this->attributes['VideoProduct'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getVideoProductAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE && is_array($decoded)
            ? $decoded
            : ($value ? [$value] : []);
    }

    public function prize()
    {
        return $this->belongsTo(\App\Models\Prizes::class, 'IdPrize', 'idPrize');
    }

    public function cateorie()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'IdCateorie', 'IdCateg');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    /**
     * FeaturesValues attached to this product, through the
     * ProductsFeatureValues link table. No dedicated pivot model needed.
     * Eager-load 'values.feature' to get feature + value together.
     */
    public function values()
    {
        return $this->belongsToMany(
            \App\Models\FeaturesValues::class,
            'ProductsFeatureValues',
            'IdProduct',
            'IdFV'
        )->withPivot('IdProductFeatureValue');
    }
}
