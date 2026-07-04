<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdComments extends Model
{
    protected $table = 'AdComments';
    protected $primaryKey = 'IdComment';
    public $timestamps = false;

    protected $fillable = [
        'IdAd',
        'IdUser',
        'Content',
        'CreatedAt',
        'Active'
    ];

    public function comment()
    {
        return $this->belongsTo(\App\Models\Comments::class, 'IdComment', 'IdComment');
    }

    public function ad()
    {
        return $this->belongsTo(\App\Models\Ads::class, 'IdAd', 'IdAd');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
