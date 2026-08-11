<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealLikes extends Model
{
    protected $table = 'Deallikes';
    protected $primaryKey = 'IdLike';
    public $timestamps = false;
    protected $fillable = ['IdDeal', 'IdUser', 'CreatedAt'];

    public function deal()
    {
        return $this->belongsTo(\App\Models\Deals::class, 'IdDeal', 'IdDeal');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }
}
