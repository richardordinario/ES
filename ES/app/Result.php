<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'schedid',
        'studid',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'q10',
        'comment',
    ];
}
