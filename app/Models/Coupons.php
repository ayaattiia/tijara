<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = 'Coupons';
    protected $primaryKey = 'IdCoupon';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'Description',
        'DateStart',
        'DateEnd',
        'Price',
        'NumberOfCoupon',
        'Used',
        'Active',
        'CreatedAt'
    ];

}
