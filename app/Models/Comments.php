<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'Comments';
    protected $primaryKey = 'IdComment';
    public $timestamps = false;

    protected $fillable = [
        'IdUser',
        'Comment',
        'IdReplyComment',
        'Date',
        'IdCourse',
        'IdLesson',
        'IdMeet',
        'Active'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'IdUser', 'IdUser');
    }

}
