<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prizes extends Model
{
    protected $table = 'Prizes';
    protected $primaryKey = 'idPrize';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'title',
        'description',
        'idUser',
        'active',
        'datePublication'
    ];

    public function iduser()
    {
        return $this->belongsTo(\App\Models\Users::class, 'idUser', 'IdUser');
    }

    public function deal()
    {
        return $this->belongsTo(\App\Models\Deals::class, 'IdDeal', 'IdDeal');
    }
}
