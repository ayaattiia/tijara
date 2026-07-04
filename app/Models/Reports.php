<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $table = 'Reports';
    protected $primaryKey = 'IdReport';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'IdCauseReport',
        'Subject',
        'Description',
        'Date',
        'State',
        'TypeTable',
        'IdTable',
        'IdProduct'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

    public function causereport()
    {
        return $this->belongsTo(\App\Models\CausesReports::class, 'IdCauseReport', 'IdCauseReport');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class, 'IdProduct', 'IdProduct');
    }

}
