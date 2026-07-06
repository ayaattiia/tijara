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
        'idparent',
        'Active'
    ];
    // La categorie parente (idparent = 0 => pas de parent)
    public function parent()
    {
        return $this->belongsTo(Categories::class, 'idparent', 'IdCateg');
    }

    // Les sous-categories
    public function children()
    {
        return $this->hasMany(Categories::class, 'idparent', 'IdCateg');
    }

    public function scopeRoots($query)
    {
        return $query->where('idparent', 0);
    }

    public function idtypecat()
    {
        return $this->belongsTo(\App\Models\TypeCategory::class, 'idtypecat', 'Idtypecat');
    }

}
