<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWishlist extends Model
{
    protected $table = 'ProductWishlist';
    protected $primaryKey = 'IdWishlistProduct';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdProduct',
        'Liked'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class, 'IdProduct', 'IdProduct');
    }

}
