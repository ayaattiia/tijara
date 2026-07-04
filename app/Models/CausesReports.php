<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CausesReports extends Model
{
    protected $table = 'CausesReports';
    protected $primaryKey = 'IdCauseReport';
    public $timestamps = false;

    protected $fillable = [
        'TitleCauseEn',
        'TitleCauseAr',
        'TitleCauseFr',
        'GroupName',
        'Active'
    ];

}
