<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Course;
use App\User;
use Validator;

class CourseController extends Controller
{
    //
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Course::latest()->get())
            ->addColumn('action', function($data){
                $button = '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('course');
    }
    public function store(Request $request)
    {
        if (intval(strlen($request->ccode)) < 3) 
        {
            $error = array('Invalid id course code.');
            return response()->json(['errors' => $error]);
        }
        if (Course::where('course_code', '=', $request->ccode)->exists())
        {
            $error = array('Course code already used.');
            return response()->json(['errors' => $error]);
        }
        if (intval(strlen($request->cdesc)) < 6) 
        {
            $error = array('cdesc');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            'course_code'         =>  strtoupper($request->ccode),
            'course_desc'         =>  ucwords(strtolower($request->cdesc)),
        );

        Course::create($form_data);
        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Course::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        if (intval(strlen($request->cdesc)) < 6) 
        {
            $error = array('cdesc');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            //'course_code'         =>  strtoupper($request->ccode),
            'course_desc'         =>  ucwords(strtolower($request->cdesc)),
        );

        Course::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);
    }
    public function destroy($id)
    {
        $data = Course::findorFail($id);
        $data->delete(); 
    }

}
