<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'Countries';
    protected $primaryKey = 'IdCountry';
    public $timestamps = false;

    protected $fillable = [
        'country_code',
        'country_enName',
        'country_arName',
        'country_enNationality',
        'country_arNationality',
        'Active',
        'Title',
        'Flag',
        'Code',
        'PhoneCode',
        'CreatedAt'
    ];

}
