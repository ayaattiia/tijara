<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    protected $table = 'Deals';
    protected $primaryKey = 'IdDeal';
    public $timestamps = false;

    protected $fillable = [
        'titleDeal',
        'descriptionDeal',
        'detailsDeal',
        'priceDeal',
        'discountDeal',
        'quantity',
        'datePublication',
        'dateEnd',
        'imageDeal',
        'idtypecat',
        'idCateg',
        'idUser',
        'idState',
        'idPrize',
        'locationDeal',
        'active',
        'colors',
        'likes',
        'liked',
        'telephone',
        'email',
        'ownerdeals',
        'brand',
        'startDate',
        'TotalCount'
    ];

    public function idtypecat()
    {
        return $this->belongsTo(\App\Models\TypeCategory::class, 'idtypecat', 'Idtypecat');
    }

    public function idcateg()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'idCateg', 'IdCateg');
    }

    public function iduser()
    {
        return $this->belongsTo(\App\Models\Users::class, 'idUser', 'IdUser');
    }

    public function idstate()
    {
        return $this->belongsTo(\App\Models\States::class, 'idState', 'IdState');
    }

    public function idprize()
    {
        return $this->belongsTo(\App\Models\Prizes::class, 'idPrize', 'idPrize');
    }

}
