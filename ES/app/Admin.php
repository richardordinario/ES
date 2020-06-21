<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admins';
    protected $fillable = [
        'utype',
        'fname',
        'lname',
        'mname',
        'contact',
        'image',
        'status'
    ];
}
