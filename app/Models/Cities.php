<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'Cities';
    protected $primaryKey = 'IdCity';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'IdCountry',
        'TitleEn',
        'TitleAr',
        'Image',
        'Active',
        'CreatedAt'
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountry', 'IdCountry');
    }

}
