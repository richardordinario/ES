<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    //
    protected $table = 'facultys';
    protected $fillable = [
        'position',
        'fname',
        'lname',
        'mname',
        'contact',
        'image'
    ];
}
