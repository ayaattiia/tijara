<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureCategories extends Model
{
    protected $table = 'FeatureCategories';
    protected $primaryKey = 'IdFC';
    public $timestamps = false;

    protected $fillable = [
        'IdCategory',
        'IdFeature'
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'IdCategory', 'IdCateg');
    }

    public function feature()
    {
        return $this->belongsTo(\App\Models\Features::class, 'IdFeature', 'IdFeature');
    }

}
