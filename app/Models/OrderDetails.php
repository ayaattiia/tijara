<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'OrderDetails';
    protected $primaryKey = 'IdOrderDeatils';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdProduct',
        'IdState',
        'IdCountry',
        'IdOrder',
        'ZipCode',
        'Address',
        'Email',
        'Telephone',
        'FirstName',
        'LastName',
        'Quantity',
        'TotalAmount',
        'DateTimeCommand',
        'Active'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class, 'IdProduct', 'IdProduct');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\States::class, 'IdState', 'IdState');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountry', 'IdCountry');
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Orders::class, 'IdOrder', 'IdOrder');
    }

}
