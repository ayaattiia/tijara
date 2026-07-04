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
        'ColorProduct',
        'PriceProduct',
        'TvaProduct',
        'IdPricesDelevery',
        'ImageProduct',
        'VideoProduct',
        'IdPrize',
        'IdCateorie',
        'IdUser',
        'IdCountrie',
        'Active'
    ];


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

    public function countrie()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountrie', 'IdCountry');
    }
}
