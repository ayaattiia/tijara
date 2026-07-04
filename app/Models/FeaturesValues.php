<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturesValues extends Model
{
    protected $table = 'FeaturesValues';
    protected $primaryKey = 'IdFV';
    public $timestamps = false;

    protected $fillable = [
        'ValueFeature',
        'IdFeature',
        'Active'
    ];

    public function feature()
    {
        return $this->belongsTo(\App\Models\Features::class, 'IdFeature', 'IdFeature');
    }

}
