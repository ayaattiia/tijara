<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'Orders';
    protected $primaryKey = 'IdOrder';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdDeal',
        'IdState',
        'DateTimeCommand',
        'Active'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function deal()
    {
        return $this->belongsTo(\App\Models\Deals::class, 'IdDeal', 'IdDeal');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\States::class, 'IdState', 'IdState');
    }
    public function details()
    {
        return $this->hasMany(
            \App\Models\OrderDetails::class,
            'IdOrder',
            'IdOrder'
        );
    }

    public function invoice()
    {
        return $this->hasOne(
            \App\Models\Invoices::class,
            'IdOrder',
            'IdOrder'
        );
    }
}
