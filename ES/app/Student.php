<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = [
        'student_id',
        'fname',
        'lname',
        'mname',
        'course',
        'major',
        'image'
    ];
}
