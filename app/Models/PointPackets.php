<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointPackets extends Model
{
    protected $table = 'PointPackets';
    protected $primaryKey = 'IdPacket';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'Description',
        'PointsCount',
        'Price',
        'Discount',
        'Active',
        'CreatedAt'
    ];

}
