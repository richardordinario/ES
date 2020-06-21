<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\Course;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {

        $uid = Auth::user()->uid;
        
        $udatas = DB::table('students')->where('student_id', $uid)->get();
        $sub = DB::table('students')->where('student_id', $uid)->value('course');
        $course = DB::table('courses')->where('course_code', $sub)->value('course_desc');
      
        return view('profile',['udatas' => $udatas])->with('course',$course);
    }

}
