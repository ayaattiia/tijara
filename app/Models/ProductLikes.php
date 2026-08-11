<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLikes extends Model
{
    protected $table = 'ProductLikes';
    protected $primaryKey = 'IdLike';
    public $timestamps = false;

    protected $fillable = ['IdProduct', 'IdUser', 'CreatedAt'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class, 'IdProduct', 'IdProduct');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }
}
