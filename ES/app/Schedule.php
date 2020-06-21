<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $fillable = [
        'status',
        'uid',
        'name',
        'sem',
        'sy',
        'ylevel',
        'section',
        'scode',
        'ccode'
    ];
}
