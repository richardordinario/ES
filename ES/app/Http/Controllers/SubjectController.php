<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Subject;
use Validator;

class SubjectController extends Controller
{
    //
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Subject::latest()->get())
            ->addColumn('action', function($data){
                $button = '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('subject');
    }

    public function store(Request $request)
    {
        if (intval(strlen($request->scode)) < 3) 
        {
            $error = array('Invalid subject code.');
            return response()->json(['errors' => $error]);
        }
        if (Subject::where('subject_code', '=', $request->scode)->exists())
        {
            $error = array('Subject code already used.');
            return response()->json(['errors' => $error]);
        }
        if (intval(strlen($request->sdesc)) < 6) 
        {
            $error = array('sdesc');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            'subject_code'         =>  strtoupper($request->scode),
            'subject_desc'         =>  ucwords(strtolower($request->sdesc)),
        );

        Subject::create($form_data);
        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Subject::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        if (intval(strlen($request->sdesc)) < 6) 
        {
            $error = array('sdesc');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            //'course_code'         =>  strtoupper($request->ccode),
            'subject_desc'         =>  ucwords(strtolower($request->sdesc)),
        );

        Subject::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);
    }
    public function destroy($id)
    {
        $data = Subject::findorFail($id);
        $data->delete(); 
    }
}
