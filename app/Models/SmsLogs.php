<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLogs extends Model
{
    protected $table = 'SmsLogs';
    protected $primaryKey = 'IdSms';
    public $timestamps = false;

    protected $fillable = [
        'Recipient',
        'Message',
        'Status',
        'Provider',
        'SentAt',
        'Error'
    ];

}
