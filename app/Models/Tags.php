<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'Tags';
    protected $primaryKey = 'IdTag';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'Tag',
        'IdLangue',
        'Active'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
