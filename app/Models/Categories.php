<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'Categories';
    protected $primaryKey = 'IdCateg';
    public $timestamps = false;

    protected $fillable = [
        'TitleEn',
        'TitleFr',
        'TitleAr',
        'Description',
        'Image',
        'idtypecat',
        'Active'
    ];

    public function idtypecat()
    {
        return $this->belongsTo(\App\Models\TypeCategory::class, 'idtypecat', 'Idtypecat');
    }

}
