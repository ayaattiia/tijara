<?php

namespace App\Models;

use App\Support\MediaUrl;


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

    // protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return MediaUrl::build($this->Image, 'brands');
    }
}
