<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclamations extends Model
{
    protected $table = 'Reclamations';
    protected $primaryKey = 'IdReclamation';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdCause',
        'Subject',
        'Description',
        'Status',
        'AdminReply',
        'RespondedBy',
        'RespondedAt',
        'CreatedAt',
        'UpdatedAt',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function cause()
    {
        return $this->belongsTo(\App\Models\Causes::class, 'IdCause', 'IdCause');
    }
}
