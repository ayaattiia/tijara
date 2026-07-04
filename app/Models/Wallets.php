<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $table = 'Wallets';
    protected $primaryKey = 'IdWallet';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'ICN',
        'NbrJeton',
        'MoneyBudget',
        'MoneyBlocked',
        'MoneyTransfered',
        'Active'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
