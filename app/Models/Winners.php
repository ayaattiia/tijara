<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winners extends Model
{
    protected $table = 'Winners';
    protected $primaryKey = 'IdWinner';
    public $timestamps = false;

    protected $fillable = [
        'IdPrize',
        'IdUser',
        'DateWin'
    ];

    public function prize()
    {
        return $this->belongsTo(\App\Models\Prizes::class, 'IdPrize', 'idPrize');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
