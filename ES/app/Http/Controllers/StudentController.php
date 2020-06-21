<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\Course;
use App\User;
use Validator;


class StudentController extends Controller
{
    //
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Student::latest()->get())
            ->addColumn('action', function($data){
                $button = '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $courses = DB::table('courses')->get();
        return view('students.index', ['courses' => $courses]);
    }

    function studentData()
    {
        $studData = DB::table('students')->get();
        return $studData;

    }

    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_studentData_to_html());
        return $pdf->stream();
    }

    function convert_studentData_to_html()
    {
        $data = $this->studentData();
        $output = '
            <div class="container">
            <h3 align="center">Student data in the system</h3>
                <table class="table table-bordered"  width="100%" style="border-collapse: collapse; border: 0px;font-size: 14px;">
                    <tr>
                        <th style="border: 1px solid; padding:5px;" width="5%">Student #</th>
                        <th style="border: 1px solid; padding:5px;" width="20%">Name</th>
                        <th style="border: 1px solid; padding:5px;" width="5%">Course</th>
                        <th style="border: 1px solid; padding:5px;" width="10%">Major</th>
                    </tr>
              
        ';
        foreach($data as $ndata)
        {
            $output .= '
                <tr>
                    <td style="border: 1px solid; padding:5px;font-size: 12px;">'.$ndata->student_id.'</td>
                    <td style="border: 1px solid; padding:5px;font-size: 12px;">'.$ndata->fname.' '.$ndata->mname.' '.$ndata->lname.'</td>
                    <td style="border: 1px solid; padding:5px;font-size: 12px;">'.$ndata->course.'</td>
                    <td style="border: 1px solid; padding:5px;font-size: 12px;">'.$ndata->major.'</td>
                </tr>

            ';    
        }
        
        $output .= '

                </table>
            </div>
        ';
        return $output;
    }

    public function store(Request $request)
    {
        if (intval(strlen($request->studid)) < 4) 
        {
            $error = array('Invalid id number.');
            return response()->json(['errors' => $error]);
        }
        if (Student::where('student_id', '=', $request->studid)->exists())
        {
            $error = array('Student number already used.');
            return response()->json(['errors' => $error]);
        }
        
        $rules = array (
            'fname'              =>  'min:2',
            'lname'              =>  'min:2',
            'course'             =>  'required',
            'major'              =>  'min:6',
            'image'              =>  'required|image|max:2048'
        );
        $messages = [
            //'student_id.min'            =>  'sid',
            'fname.min'                 =>  'firstname',
            'lname.min'                 =>  'lname',
            'course.required'           =>  'course',
            'major.min'                 =>  'major',
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
            'student_id'    =>  $request->studid,
            'fname'         =>  ucwords(strtolower($request->fname)),
            'lname'         =>  ucwords(strtolower($request->lname)),
            'mname'         =>  ucwords(strtolower($request->mname)),
            'course'        =>  $request->course,
            'major'         =>  ucwords(strtolower($request->major)),
            'image'         =>  $new_name
        );

        Student::create($form_data);

        $name = "";
        if($request->mname == "") { $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->lname)); }
        else { $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->major)) . " " . ucwords(strtolower($request->lname)); }
        $form_user = array (
            'uid'     =>    $request->studid,
            'utype'     =>  'Student',
            'name'      =>  $name,
            'username'  =>  $request->studid,
            'password'  =>  Hash::make($request->studid)
        );

        User::create($form_user);
        return response()->json(['success' => 'Data Added Successfully.']);
    
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Student::findorFail($id);
            return response()->json(['data' => $data]);
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
                'course'        =>  'required',
                'major'         =>  'min:6',
                'image'         =>  'required|image|max:2048'
            );
            $messages = [
                'fname.min'                 =>  'firstname',
                'lname.min'                 =>  'lname',
                'course.required'           =>  'course',
                'major.min'                 =>  'major',
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
                'course'        =>  'required',
                'major'         =>  'min:6',
                //'image'         =>  'required|image|max:2048'
            );
            $messages = [
                'fname.min'                 =>  'firstname',
                'lname.min'                 =>  'lname',
                'course.required'           =>  'course',
                'major.min'                 =>  'major',
                //'image.required'                 =>  'img',
                //'image.max'                 =>  'img'
            ];
            $error = Validator::make($request->all(), $rules, $messages);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }
        $form_data = array (
            // 'student_id'    =>  $request->studid,
            'fname'         =>  ucwords(strtolower($request->fname)),
            'lname'         =>  ucwords(strtolower($request->lname)),
            'mname'         =>  ucwords(strtolower($request->mname)),
            'course'        =>  $request->course,
            'major'         =>  ucwords(strtolower($request->major)),
            'image'         =>  $image_name
        );

        $get_id = DB::table('users')->where('uid',$request->studid)->first();

        Student::whereId($request->hidden_id)->update($form_data);

        $name = "";
        if($request->mname == "") { $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->lname)); }
        else { $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->mname)) . " " . ucwords(strtolower($request->lname)); }

        $form_user = array ( 'name' =>  $name );
        
        User::whereId($get_id->id)->update($form_user);
        return response()->json(['success' => 'Data Updated Successfully.']);
    }

    public function destroy($id)
    {
        $data = Student::findorFail($id);
        $user_id = DB::table('users')->where('uid', $data->student_id)->first();
        $user_data = User::findorFail($user_id->id);
        $imgWillDelete = public_path().'/images/'.$data->image;
        File::delete($imgWillDelete);
        $data->delete();
        $user_data->delete();
    }
}
