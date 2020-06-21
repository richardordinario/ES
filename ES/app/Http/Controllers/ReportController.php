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

class ReportController extends Controller
{
    
    public function index(Request $request)
    {
       
        if(request()->ajax())
        {
            
            if(!empty($request->sem) && !empty($request->sy))
            {
                return datatables()->of(DB::table('schedules')
                ->where('sem', $request->sem)
                ->where('sy', $request->sy)
                ->get())
                ->addColumn('action', function($data){
                    $button = '<span type="button" name="rate" id="'.$data->id.'" class="preview" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Preview</span>';
                    
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            else
            {
                return datatables()->of(DB::table('schedules')
                // ->where('name', "admin")
                ->get())
                ->addColumn('action', function($data){
                    $button = '<span type="button" name="" id="'.$data->id.'" class="preview" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Preview</span>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }

        //$questions = Question::where('qnum', '!=', null)->orderBy('qnum', 'asc')->get();
        $facultys = DB::table('facultys')->get(); 
        $sys = School_year::latest()->get();
        return view('report',['facultys' => $facultys, 'sys' => $sys]);
    }

    public function preview(Request $request)
    {
        if(request()->ajax())
        {
            //return datatables()->of(Result::where('schedid', '=', $request->pid)->get())->make(true);
            if(!empty($request->pid))
            {
                
                if(DB::table('results')->where('schedid', $request->pid)->exists())
                {

                    $totalRater = DB::table('results')->where('schedid', $request->pid)->get();
                    $fn = DB::table('schedules')->where('id', $request->pid)->first();

                    $rate5inQ1 = DB::table('results')->where('schedid', $request->pid)->where('q1', 5)->get();
                    $rate4inQ1 = DB::table('results')->where('schedid', $request->pid)->where('q1', 4)->get();
                    $rate3inQ1 = DB::table('results')->where('schedid', $request->pid)->where('q1', 3)->get();
                    $rate2inQ1 = DB::table('results')->where('schedid', $request->pid)->where('q1', 2)->get();
                    $rate1inQ1 = DB::table('results')->where('schedid', $request->pid)->where('q1', 1)->get();

                    $rate5inQ2 = DB::table('results')->where('schedid', $request->pid)->where('q2', 5)->get();
                    $rate4inQ2 = DB::table('results')->where('schedid', $request->pid)->where('q2', 4)->get();
                    $rate3inQ2 = DB::table('results')->where('schedid', $request->pid)->where('q2', 3)->get();
                    $rate2inQ2 = DB::table('results')->where('schedid', $request->pid)->where('q2', 2)->get();
                    $rate1inQ2 = DB::table('results')->where('schedid', $request->pid)->where('q2', 1)->get();
                    
                    $rate5inQ3 = DB::table('results')->where('schedid', $request->pid)->where('q3', 5)->get();
                    $rate4inQ3 = DB::table('results')->where('schedid', $request->pid)->where('q3', 4)->get();
                    $rate3inQ3 = DB::table('results')->where('schedid', $request->pid)->where('q3', 3)->get();
                    $rate2inQ3 = DB::table('results')->where('schedid', $request->pid)->where('q3', 2)->get();
                    $rate1inQ3 = DB::table('results')->where('schedid', $request->pid)->where('q3', 1)->get();

                    $rate5inQ4 = DB::table('results')->where('schedid', $request->pid)->where('q4', 5)->get();
                    $rate4inQ4 = DB::table('results')->where('schedid', $request->pid)->where('q4', 4)->get();
                    $rate3inQ4 = DB::table('results')->where('schedid', $request->pid)->where('q4', 3)->get();
                    $rate2inQ4 = DB::table('results')->where('schedid', $request->pid)->where('q4', 2)->get();
                    $rate1inQ4 = DB::table('results')->where('schedid', $request->pid)->where('q4', 1)->get();

                    $rate5inQ5 = DB::table('results')->where('schedid', $request->pid)->where('q5', 5)->get();
                    $rate4inQ5 = DB::table('results')->where('schedid', $request->pid)->where('q5', 4)->get();
                    $rate3inQ5 = DB::table('results')->where('schedid', $request->pid)->where('q5', 3)->get();
                    $rate2inQ5 = DB::table('results')->where('schedid', $request->pid)->where('q5', 2)->get();
                    $rate1inQ5 = DB::table('results')->where('schedid', $request->pid)->where('q5', 1)->get();

                    $rate5inQ6 = DB::table('results')->where('schedid', $request->pid)->where('q6', 5)->get();
                    $rate4inQ6 = DB::table('results')->where('schedid', $request->pid)->where('q6', 4)->get();
                    $rate3inQ6 = DB::table('results')->where('schedid', $request->pid)->where('q6', 3)->get();
                    $rate2inQ6 = DB::table('results')->where('schedid', $request->pid)->where('q6', 2)->get();
                    $rate1inQ6 = DB::table('results')->where('schedid', $request->pid)->where('q6', 1)->get();

                    $rate5inQ7 = DB::table('results')->where('schedid', $request->pid)->where('q7', 5)->get();
                    $rate4inQ7 = DB::table('results')->where('schedid', $request->pid)->where('q7', 4)->get();
                    $rate3inQ7 = DB::table('results')->where('schedid', $request->pid)->where('q7', 3)->get();
                    $rate2inQ7 = DB::table('results')->where('schedid', $request->pid)->where('q7', 2)->get();
                    $rate1inQ7 = DB::table('results')->where('schedid', $request->pid)->where('q7', 1)->get();

                    $rate5inQ8 = DB::table('results')->where('schedid', $request->pid)->where('q8', 5)->get();
                    $rate4inQ8 = DB::table('results')->where('schedid', $request->pid)->where('q8', 4)->get();
                    $rate3inQ8 = DB::table('results')->where('schedid', $request->pid)->where('q8', 3)->get();
                    $rate2inQ8 = DB::table('results')->where('schedid', $request->pid)->where('q8', 2)->get();
                    $rate1inQ8 = DB::table('results')->where('schedid', $request->pid)->where('q8', 1)->get();

                    $rate5inQ9 = DB::table('results')->where('schedid', $request->pid)->where('q9', 5)->get();
                    $rate4inQ9 = DB::table('results')->where('schedid', $request->pid)->where('q9', 4)->get();
                    $rate3inQ9 = DB::table('results')->where('schedid', $request->pid)->where('q9', 3)->get();
                    $rate2inQ9 = DB::table('results')->where('schedid', $request->pid)->where('q9', 2)->get();
                    $rate1inQ9 = DB::table('results')->where('schedid', $request->pid)->where('q9', 1)->get();
                    
                    $rate5inQ10 = DB::table('results')->where('schedid', $request->pid)->where('q10', 5)->get();
                    $rate4inQ10 = DB::table('results')->where('schedid', $request->pid)->where('q10', 4)->get();
                    $rate3inQ10 = DB::table('results')->where('schedid', $request->pid)->where('q10', 3)->get();
                    $rate2inQ10 = DB::table('results')->where('schedid', $request->pid)->where('q10', 2)->get();
                    $rate1inQ10 = DB::table('results')->where('schedid', $request->pid)->where('q10', 1)->get();

                    $meanRate5Q1 =  count($rate5inQ1) * 5;
                    $meanRate4Q1 =  count($rate4inQ1) * 4;
                    $meanRate3Q1 =  count($rate3inQ1) * 3;
                    $meanRate2Q1 =  count($rate2inQ1) * 2;   
                    $meanRate1Q1 =  count($rate1inQ1) * 1; 

                    $totalMeanQ1 = $meanRate5Q1+$meanRate4Q1+$meanRate3Q1+$meanRate2Q1+$meanRate1Q1;
                    $totalMeanQ1 = $totalMeanQ1 / count($totalRater); 

                    $meanRate5Q2 =  count($rate5inQ2) * 5;
                    $meanRate4Q2 =  count($rate4inQ2) * 4;
                    $meanRate3Q2 =  count($rate3inQ2) * 3;
                    $meanRate2Q2 =  count($rate2inQ2) * 2;   
                    $meanRate1Q2 =  count($rate1inQ2) * 1; 

                    $totalMeanQ2 = $meanRate5Q2+$meanRate4Q2+$meanRate3Q2+$meanRate2Q2+$meanRate1Q2;
                    $totalMeanQ2 = $totalMeanQ2 / count($totalRater);

                    $meanRate5Q3 =  count($rate5inQ3) * 5;
                    $meanRate4Q3 =  count($rate4inQ3) * 4;
                    $meanRate3Q3 =  count($rate3inQ3) * 3;
                    $meanRate2Q3 =  count($rate2inQ3) * 2;   
                    $meanRate1Q3 =  count($rate1inQ3) * 1; 

                    $totalMeanQ3 = $meanRate5Q3+$meanRate4Q3+$meanRate3Q3+$meanRate2Q3+$meanRate1Q3;
                    $totalMeanQ3 = $totalMeanQ3 / count($totalRater);

                    $meanRate5Q4 =  count($rate5inQ4) * 5;
                    $meanRate4Q4 =  count($rate4inQ4) * 4;
                    $meanRate3Q4 =  count($rate3inQ4) * 3;
                    $meanRate2Q4 =  count($rate2inQ4) * 2;   
                    $meanRate1Q4 =  count($rate1inQ4) * 1; 

                    $totalMeanQ4 = $meanRate5Q4+$meanRate4Q4+$meanRate3Q4+$meanRate2Q4+$meanRate1Q4;
                    $totalMeanQ4 = $totalMeanQ4 / count($totalRater);

                    $meanRate5Q5 =  count($rate5inQ5) * 5;
                    $meanRate4Q5 =  count($rate4inQ5) * 4;
                    $meanRate3Q5 =  count($rate3inQ5) * 3;
                    $meanRate2Q5 =  count($rate2inQ5) * 2;   
                    $meanRate1Q5 =  count($rate1inQ5) * 1; 

                    $totalMeanQ5 = $meanRate5Q5+$meanRate4Q5+$meanRate3Q5+$meanRate2Q5+$meanRate1Q5;
                    $totalMeanQ5 = $totalMeanQ5 / count($totalRater);

                    $meanRate5Q6 =  count($rate5inQ6) * 5;
                    $meanRate4Q6 =  count($rate4inQ6) * 4;
                    $meanRate3Q6 =  count($rate3inQ6) * 3;
                    $meanRate2Q6 =  count($rate2inQ6) * 2;   
                    $meanRate1Q6 =  count($rate1inQ6) * 1; 

                    $totalMeanQ6 = $meanRate5Q6+$meanRate4Q6+$meanRate3Q6+$meanRate2Q6+$meanRate1Q6;
                    $totalMeanQ6 = $totalMeanQ6 / count($totalRater);

                    $meanRate5Q7 =  count($rate5inQ7) * 5;
                    $meanRate4Q7 =  count($rate4inQ7) * 4;
                    $meanRate3Q7 =  count($rate3inQ7) * 3;
                    $meanRate2Q7 =  count($rate2inQ7) * 2;   
                    $meanRate1Q7 =  count($rate1inQ7) * 1; 

                    $totalMeanQ7 = $meanRate5Q7+$meanRate4Q7+$meanRate3Q7+$meanRate2Q7+$meanRate1Q7;
                    $totalMeanQ7 = $totalMeanQ7 / count($totalRater);

                    $meanRate5Q8 =  count($rate5inQ8) * 5;
                    $meanRate4Q8 =  count($rate4inQ8) * 4;
                    $meanRate3Q8 =  count($rate3inQ8) * 3;
                    $meanRate2Q8 =  count($rate2inQ8) * 2;   
                    $meanRate1Q8 =  count($rate1inQ8) * 1; 

                    $totalMeanQ8 = $meanRate5Q8+$meanRate4Q8+$meanRate3Q8+$meanRate2Q8+$meanRate1Q8;
                    $totalMeanQ8 = $totalMeanQ8 / count($totalRater);

                    $meanRate5Q9 =  count($rate5inQ9) * 5;
                    $meanRate4Q9 =  count($rate4inQ9) * 4;
                    $meanRate3Q9 =  count($rate3inQ9) * 3;
                    $meanRate2Q9 =  count($rate2inQ9) * 2;   
                    $meanRate1Q9 =  count($rate1inQ9) * 1; 

                    $totalMeanQ9 = $meanRate5Q9+$meanRate4Q9+$meanRate3Q9+$meanRate2Q9+$meanRate1Q9;
                    $totalMeanQ9 = $totalMeanQ9 / count($totalRater);

                    $meanRate5Q10 =  count($rate5inQ10) * 5;
                    $meanRate4Q10 =  count($rate4inQ10) * 4;
                    $meanRate3Q10 =  count($rate3inQ10) * 3;
                    $meanRate2Q10 =  count($rate2inQ10) * 2;   
                    $meanRate1Q10 =  count($rate1inQ10) * 1; 

                    $totalMeanQ10 = $meanRate5Q10+$meanRate4Q10+$meanRate3Q10+$meanRate2Q10+$meanRate1Q10;
                    $totalMeanQ10 = $totalMeanQ10 / count($totalRater);

                    $overAllMean = $totalMeanQ1+$totalMeanQ2+$totalMeanQ3+$totalMeanQ4+$totalMeanQ5+$totalMeanQ6+$totalMeanQ7+$totalMeanQ8+$totalMeanQ9+$totalMeanQ10;
                    $overAllMean = $overAllMean / 10;

                    $output = '
                    <table  class="table table-bordered" style="text-align:center;">
                    <tr>
                        <!-- <th class="table-header" width="1%">Status</th> -->
                        <th style="background-color: #2c3e50;color:#fff" width="10%;"></th>
                        <th style="background-color: #574b90;color:#fff">1</th>
                        <th style="background-color: #b33939;color:#fff">2</th>
                        <th style="background-color: #cd6133;color:#fff">3</th>
                        <th style="background-color: #16a085;color:#fff">4</th>
                        <th style="background-color: #27ae60;color:#fff">5</th> 
                        <th width="10%">Total</th>  
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">1</th>
                        <td class="td1">'.count($rate1inQ1).'</td>
                        <td class="td2">'.count($rate2inQ1).'</td>
                        <td class="td3">'.count($rate3inQ1).'</td>
                        <td class="td4">'.count($rate4inQ1).'</td>
                        <td class="td5">'.count($rate5inQ1).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ1.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">2</th>
                        <td class="td1">'.count($rate1inQ2).'</td>
                        <td class="td2">'.count($rate2inQ2).'</td>
                        <td class="td3">'.count($rate3inQ2).'</td>
                        <td class="td4">'.count($rate4inQ2).'</td>
                        <td class="td5">'.count($rate5inQ2).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ2.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">3</th>
                        <td class="td1">'.count($rate1inQ3).'</td>
                        <td class="td2">'.count($rate2inQ3).'</td>
                        <td class="td3">'.count($rate3inQ3).'</td>
                        <td class="td4">'.count($rate4inQ3).'</td>
                        <td class="td5">'.count($rate5inQ3).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ3.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">4</th>
                        <td class="td1">'.count($rate1inQ4).'</td>
                        <td class="td2">'.count($rate2inQ4).'</td>
                        <td class="td3">'.count($rate3inQ4).'</td>
                        <td class="td4">'.count($rate4inQ4).'</td>
                        <td class="td5">'.count($rate5inQ4).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ4.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">5</th>
                        <td class="td1">'.count($rate1inQ5).'</td>
                        <td class="td2">'.count($rate2inQ5).'</td>
                        <td class="td3">'.count($rate3inQ5).'</td>
                        <td class="td4">'.count($rate4inQ5).'</td>
                        <td class="td5">'.count($rate5inQ5).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ5.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">6</th>
                        <td class="td1">'.count($rate1inQ6).'</td>
                        <td class="td2">'.count($rate2inQ6).'</td>
                        <td class="td3">'.count($rate3inQ6).'</td>
                        <td class="td4">'.count($rate4inQ6).'</td>
                        <td class="td5">'.count($rate5inQ6).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ6.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">7</th>
                        <td class="td1">'.count($rate1inQ7).'</td>
                        <td class="td2">'.count($rate2inQ7).'</td>
                        <td class="td3">'.count($rate3inQ7).'</td>
                        <td class="td4">'.count($rate4inQ7).'</td>
                        <td class="td5">'.count($rate5inQ7).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ7.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">8</th>
                        <td class="td1">'.count($rate1inQ8).'</td>
                        <td class="td2">'.count($rate2inQ8).'</td>
                        <td class="td3">'.count($rate3inQ8).'</td>
                        <td class="td4">'.count($rate4inQ8).'</td>
                        <td class="td5">'.count($rate5inQ8).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ8.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">9</th>
                        <td class="td1">'.count($rate1inQ9).'</td>
                        <td class="td2">'.count($rate2inQ9).'</td>
                        <td class="td3">'.count($rate3inQ9).'</td>
                        <td class="td4">'.count($rate4inQ9).'</td>
                        <td class="td5">'.count($rate5inQ9).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ9.'</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="sth">10</th>
                        <td class="td1">'.count($rate1inQ10).'</td>
                        <td class="td2">'.count($rate3inQ10).'</td>
                        <td class="td3">'.count($rate3inQ10).'</td>
                        <td class="td4">'.count($rate4inQ10).'</td>
                        <td class="td5">'.count($rate5inQ10).'</td>
                        <td class="td5" style="font-size: 14px;font-weight: 500;color:#999;">'.$totalMeanQ10.'</td>
                    </tr>
                    <tr>
                        <th colspan="6" style="font-size: 12px;font-weight: 600;color:#999;">Over all total mean</th>
                        <td style="font-size: 12px;font-weight: 500;color:#999;">'.$overAllMean.'</td>
                    </tr>
                    </table>
                    <div style="margin-top: -10px">
                        <p style="font-size: 13px;color:#777;font-weight:500;">
                        <span style="font-size: 12px;color:#888;font-weight:600;">Faculty name:</span> '.$fn->name.'
                        <span style="font-size: 13px;color:#777;font-weight:500;float:right"> '.$fn->sy . "/" . $fn->sem.'</span>
                        <span style="font-size: 12px;color:#888;font-weight:600;float:right">School Year/Semester:</span>
                        </p>
                        <p style="font-size: 12px;color:#777;font-weight:500;margin-top:-10px;">
                        <span style="font-size: 12px;color:#888;font-weight:600;">Course/Subject:</span> '.$fn->ccode . "/" . $fn->scode.'
                        <span style="font-size: 13px;color:#777;font-weight:500;float:right"> '.$fn->ylevel . "/" . $fn->section.'</span>
                        <span style="font-size: 12px;color:#888;font-weight:600;float:right">Year/Section:</span>
                        </p>
                        <p style="font-size: 13px;color:#777;font-weight:500;margin-top:-10px;">
                        <span style="font-size: 12px;color:#888;font-weight:600;">Total Rater:</span> '.count($totalRater).'
                        </p>
                    </div>
                    ';
                    $data = array(
                        'table_data'  => $output,
                    );
                    echo json_encode($data);
                }
                else
                {
                    $data = array(
                        'error'  => 'No record found',
                    );
                    echo json_encode($data);
                }
            }          
        }
    }
}
