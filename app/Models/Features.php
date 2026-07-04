<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $table = 'Features';
    protected $primaryKey = 'IdFeature';
    public $timestamps = false;

    protected $fillable = [
        'TitleFeature',
        'DescriptionFeature',
        'UnitFeature',
        'ImgFeature',
        'Active'
    ];

}
