<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdLikes extends Model
{
    protected $table = 'AdLikes';
    protected $primaryKey = 'IdLike';
    public $timestamps = false;

    protected $fillable = [
        'IdAd',
        'IdUser',
        'CreatedAt'
    ];

    public function like()
    {
        return $this->belongsTo(\App\Models\Likes::class, 'IdLike', 'IdLike');
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
