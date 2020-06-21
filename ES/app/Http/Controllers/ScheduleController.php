<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Course;
use App\Schedule;
use App\Faculty;
use App\School_Year;
use Validator;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Schedule::latest()->get())
            ->addColumn('action', function($data){
                if($data->status == "Active"){
                    $button = '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                }
                else{
                    $button = '<span type="button" name="" id="'.$data->id.'" class="edit" style="cursor: no-drop;text-decoration: underline;color:#999;font-size:14px;">Edit</span>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<span type="button" name="" id="'.$data->id.'" class="delete" style="cursor: no-drop;text-decoration: underline;color:#999;font-size:14px;">Delete</span>';
                }
                
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $courses = DB::table('courses')->get();
        $subjects = DB::table('subjects')->get();
        $facultys = DB::table('facultys')->get();
        $sy = DB::table('school_years')->latest()->value('sy');
        return view('schedule',['courses' => $courses, 'facultys' => $facultys, 'subjects' => $subjects])
            ->with('sy', $sy);
    }

    public function store(Request $request)
    {
        $check = DB::table('schedules')
            ->where('status', "Active")
            ->where('uid', $request->uid)
            ->where('sem', $request->sem)
            ->where('sy', $request->sy)
            ->where('ylevel', $request->ylevel)
            ->where('section', $request->section)
            ->where('scode', $request->scode)
            ->where('ccode', $request->ccode)->first();
        if($check)
        {
            $error = array('Schedule already exist.');
            return response()->json(['errors' => $error]);
        }
        //$findFaculty = DB::table('facultys')->where('id', $request->uid)->first(); 
        $findFaculty = Faculty::findorFail($request->uid);
        $name = "";
        if($findFaculty->mname != "")
        {
            $name = $findFaculty->fname . " " . $findFaculty->mname . " " . $findFaculty->lname;
        }
        else 
        {
            $name = $findFaculty->fname . " " . $findFaculty->lname;
        }

        $form_data = array(
            'status'            =>  "Active",
            'uid'               =>  $request->uid,
            'name'              =>  $name,
            'sem'               =>  $request->sem,
            'sy'                =>  $request->sy,
            'ylevel'            =>  $request->ylevel,
            'section'           =>  strtoupper($request->section),
            'scode'             =>  $request->scode,
            'ccode'             =>  $request->ccode,
        );

        Schedule::create($form_data);
        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Schedule::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
      
        $check = DB::table('schedules')
            ->where('status', "Active")
            ->where('uid', $request->uid)
            ->where('sem', $request->sem)
            ->where('sy', $request->sy)
            ->where('ylevel', $request->ylevel)
            ->where('section', $request->section)
            ->where('scode', $request->scode)
            ->where('ccode', $request->ccode)->first();
        if($check)
        {
            if($check->id == $request->hidden_id){
                //nothing happen..
            }else {
                $error = array('Schedule already exist.');
                return response()->json(['errors' => $error]);
            }
            
        }
        //$findFaculty = DB::table('facultys')->where('id', $request->uid)->first(); 
        $findFaculty = Faculty::findorFail($request->uid);
        $name = "";
        if($findFaculty->mname != "")
        {
            $name = $findFaculty->fname . " " . $findFaculty->mname . " " . $findFaculty->lname;
        }
        else 
        {
            $name = $findFaculty->fname . " " . $findFaculty->lname;
        }

        $form_data = array(
            'status'            =>  "Active",
            'uid'               =>  $request->uid,
            'name'              =>  $name,
            'sem'               =>  $request->sem,
            'sy'                =>  $request->sy,
            'ylevel'            =>  $request->ylevel,
            'section'           =>  strtoupper($request->section),
            'scode'             =>  $request->scode,
            'ccode'             =>  $request->ccode,
        );

        Schedule::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);
    }


    public function destroy($id)
    {
        $data = Schedule::findorFail($id);
        $data->delete(); 
    }


}
