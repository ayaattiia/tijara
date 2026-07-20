<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsFeatureValues extends Model
{
    protected $table = 'ProductsFeatureValues';
    protected $primaryKey = 'IdProductFeatureValue';
    public $timestamps = false;

    protected $fillable = [
        'IdProduct',
        'IdFV',
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class, 'IdProduct', 'IdProduct');
    }

    public function featureValue()
    {
        return $this->belongsTo(\App\Models\FeaturesValues::class, 'IdFV', 'IdFV');
    }
}
