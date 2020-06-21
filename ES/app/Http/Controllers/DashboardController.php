<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Course;
use App\Schedule;
use App\Question;
use App\Student;
use App\Faculty;
use App\Result;
use App\School_Year;
use Validator;
use Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        Cache::flush();
        \Artisan::call('cache:clear');

        $getStudent = DB::table('students')->get();
        $getCourse = DB::table('courses')->get();
        $getSubject = DB::table('subjects')->get();
        $getFaculty = DB::table('facultys')->get();

        return view('dashboard')
            ->with('studentCount', count($getStudent))
            ->with('courseCount', count($getCourse))
            ->with('subjectCount', count($getSubject))
            ->with('facultyCount', count($getFaculty));
    }
}
