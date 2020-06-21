<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Faculty;
use App\Position;
use Validator;

class FacultyController extends Controller
{
    //
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Faculty::latest()->get())
            ->addColumn('action', function($data){
                $button = '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $positions = DB::table('positions')->get();
        return view('faculty', ['positions' => $positions]);
    }

    public function store(Request $request)
    {
   
        $rules = array (
            'fname'                 =>  'min:2',
            'lname'                 =>  'min:2',
            'contact'               =>  'min:11',
            'image'                 =>  'required|image|max:2048'
        );
        $messages = [
            
            'fname.min'                 =>  'firstname',
            'lname.min'                 =>  'lname',
            'contact.min'               =>  'contact',
            'image.required'            =>  'img-req',
            'image.max'                 =>  'img'
        ];

        $error = Validator::make($request->all(), $rules, $messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('image');
        $new_name = rand() . '.' . $image -> getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $form_data = array(
            'position'      =>  $request->position,
            'fname'         =>  ucwords(strtolower($request->fname)),
            'lname'         =>  ucwords(strtolower($request->lname)),
            'mname'         =>  ucwords(strtolower($request->mname)),
            'contact'       =>  $request->contact,
            'image'         =>  $new_name
        );

        if($request->lname != "")
        {
            $acc_check = DB::table('facultys')
            ->where('fname', $request->fname)
            ->where('lname', $request->lname)
            ->where('lname', $request->mname)->first();
        }
        else
        {
            $acc_check = DB::table('facultys')
            ->where('fname', $request->fname)
            ->where('lname', $request->lname)->first();
        }

        if($acc_check)
        {
            $error = array('Account already used.');
            return response()->json(['errors' => $error]);
        }
        else
        {
            Faculty::create($form_data);
            return response()->json(['success' => 'Data Added Successfully.']);
        }
    }

    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $rules = array (
                'fname'         =>  'min:2',
                'lname'         =>  'min:2',
                'contact'       =>  'min:11',
                'image'         =>  'required|image|max:2048'
            );
            $messages = [
                'fname.min'                 =>  'firstname',
                'lname.min'                 =>  'lname',
                'contact.min'                 =>  'contact',
                'image.required'            =>  'img',
                'image.max'                 =>  'img'
            ];
            $error = Validator::make($request->all(), $rules, $messages);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            //unlink(storage_path('app/public/images/' . $image_name));
            //File::delete($image_name);
            //Storage::delete('images/'.$request->hidden_name);
            //Storage::disk('public')->delete("/images/{$image_name}");
            //Storage::delete($request->hidden_name);
            $imgWillDelete = public_path().'/images/'.$image_name;
            File::delete($imgWillDelete);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $image_name);
        }
        else 
        {
            $rules = array (
                'fname'         =>  'min:2',
                'lname'         =>  'min:2',
                'contact'         =>  'min:11',
            );
            $messages = [
                'fname.min'                 =>  'firstname',
                'lname.min'                 =>  'lname',
                'contact.min'                 =>  'contact',
            ];
            $error = Validator::make($request->all(), $rules, $messages);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }
        $form_data = array (
            'position'          =>  $request->position,
            'fname'             =>  ucwords(strtolower($request->fname)),
            'lname'             =>  ucwords(strtolower($request->lname)),
            'mname'             =>  ucwords(strtolower($request->mname)),
            'contact'           =>  $request->contact,
            'image'             =>  $image_name
        );

        Faculty::whereId($request->hidden_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Faculty::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }
    public function destroy($id)
    {
        $data = Faculty::findorFail($id);
        $imgWillDelete = public_path().'/images/'.$data->image;
        File::delete($imgWillDelete);
        $data->delete();
    }

    
}
