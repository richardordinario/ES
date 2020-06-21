<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Course;
use App\Schedule;
use App\Question;
use App\Faculty;
use App\Result;
use App\School_Year;
use Validator;
use Auth;

class EvaluateController extends Controller
{
    //
    public function index(Request $request)
    {
       
        if(request()->ajax())
        {
            $uid = Auth::user()->uid;
        
            $udatas = DB::table('students')->where('student_id', $uid)->get();
            $sub = DB::table('students')->where('student_id', $uid)->value('course');
            if(!empty($request->sem) && !empty($request->ylevel) && !empty($request->section))
            {
                return datatables()->of(DB::table('schedules')
                ->where('status', "Active")
                ->where('sem', $request->sem)
                ->where('ylevel', $request->ylevel)
                ->where('section', $request->section)
                ->where('ccode', $sub)
                ->get())
                ->addColumn('action', function($data){
                    $button = '<span type="button" name="rate" id="'.$data->id.'" class="rate" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Rate</span>';
                    
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            else
            {
                return datatables()->of(DB::table('schedules')
                ->where('status', "Deactive")
                ->get())
                ->addColumn('action', function($data){
           
                    $button = '<span type="button" name="" id="'.$data->id.'" class="rates" style="cursor: no-drop;text-decoration: underline;color:#999;font-size:14px;">Rate</span>';
            
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }

        $questions = Question::where('qnum', '!=', null)->orderBy('qnum', 'asc')->get();
        return view('evaluate',['questions' => $questions]);
    }

    public function rate($id)
    {
        if(request()->ajax())
        {
            $uid = Auth::user()->uid;
            if(Result::where('schedid', '=', $id)->where('studid', '=', $uid)->exists())
            {
                $error = array('fail');
                return response()->json(['errors' => $error]);
            }
            else
            {
                $data = Schedule::findorFail($id);
                return response()->json(['data' => $data]);
            }
            //return datatables()->of(Question::where('qnum', '!=', null)->orderBy('qnum', 'asc')->get())->make(true);
        }
    }

    public function score(Request $request)
    {
        $uid = Auth::user()->uid;

        $score = $request->score;

        $form_data = array(
            'schedid'   =>  $request->sid,
            'studid'    =>  $uid,
            'q1'        =>  $score[0],
            'q2'        =>  $score[1],
            'q3'        =>  $score[2],
            'q4'        =>  $score[3],
            'q5'        =>  $score[4],
            'q6'        =>  $score[5],
            'q7'        =>  $score[6],
            'q8'        =>  $score[7],
            'q9'        =>  $score[8], 
            'q10'        =>  $score[9],
            'comment'   =>  ucwords(strtolower($request->comment))
        );

        Result::create($form_data);

        return response()->json(['success' => 'Successfully Evaluated.']);
    }
    
}
