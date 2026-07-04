<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = 'States';
    protected $primaryKey = 'IdState';
    public $timestamps = false;

    protected $fillable = [
        'NameEN',
        'NameFR',
        'NameAR',
        'NameDE',
        'NameES',
        'NameCH',
        'NameRU',
        'CodeState',
        'CityPostalCode',
        'Flag',
        'MAP',
        'PhoneCode',
        'CountriesName',
        'IdCountry',
        'Active'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountry', 'IdCountry');
    }

}
