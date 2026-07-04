<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'Brands';
    protected $primaryKey = 'IdBrand';
    public $timestamps = false;

    protected $fillable = [
        'Title',
        'Description',
        'Image',
        'Active'
    ];

}
