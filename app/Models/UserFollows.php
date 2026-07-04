<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollows extends Model
{
    protected $table = 'UserFollows';
    protected $primaryKey = 'IdFollow';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdVendor',
        'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function vendor()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdVendor', 'IdUser');
    }

}
