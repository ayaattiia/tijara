<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountriesFull extends Model
{
    protected $table = 'CountriesFull';
    protected $primaryKey = 'IdCountry';
    public $timestamps = false;

    protected $fillable = [
        'NameEN',
        'NameFR',
        'NameAR',
        'NameDE',
        'NameES',
        'NameCH',
        'NameRU',
        'CodeCountry2',
        'CodeCountry3',
        'Flag',
        'MAP',
        'PhoneCode',
        'Continent',
        'Active'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountry', 'IdCountry');
    }

}
