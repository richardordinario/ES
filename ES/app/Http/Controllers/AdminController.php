<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;
use App\Position;
use App\Question;
use Validator; 


class AdminController extends Controller
{
    //
    public function admin() 
    {
        if(request()->ajax())
        {
            return datatables()->of(Admin::latest()->get())
            ->addColumn('action', function($data){
                if($data->status == "Active") {
                    $button = '<span type="button" name="status" id="'.$data->id.'" class="deactivate" style="cursor: pointer;text-decoration: underline;color:#006266;font-size:14px;font-weight: 500">Deactivate</span>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                }else {
                    $button = '<span type="button" disabled name="status" id="'.$data->id.'" class="activate" style="cursor: pointer;text-decoration: underline;color:#f5f5f5;font-size:14px;">Activate</span>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<span type="button" name="edit" id="'.$data->id.'" class="none" style="cursor: no-drop;text-decoration: underline;color:#ccc;font-size:14px;" disabled>Edit</span>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete" style="cursor: pointer;text-decoration: underline;color:#fff;font-size:14px;" disabled>Delete</span>';
                }
                
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('setting');
    }

    public function position() 
    {

        if(request()->ajax())
        {
            return datatables()->of(Position::latest()->get())
            ->addColumn('action', function($data){
                //$button = '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                //$button .= '&nbsp;&nbsp;';
                $button = '<span type="button" name="delete" id="'.$data->id.'" class="delete_position" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('setting/position');
    }

    public function question() 
    {

        if(request()->ajax())
        {
            return datatables()->of(Question::latest()->get())
            ->addColumn('action', function($data){
                $button = '<span type="button" name="edit" id="'.$data->id.'" class="set" style="cursor: pointer;text-decoration: underline;color:#777;font-size:14px;">Set</span>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<span type="button" name="edit" id="'.$data->id.'" class="edit_question" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                $button .= '&nbsp;&nbsp;';
                //$button .= '<span type="button" name="edit" id="'.$data->id.'" class="edit" style="cursor: pointer;text-decoration: underline;color:#2980b9;font-size:14px;">Edit</span>';
                //$button .= '&nbsp;&nbsp;';
                $button .= '<span type="button" name="delete" id="'.$data->id.'" class="delete_question" style="cursor: pointer;text-decoration: underline;color:#c0392b;font-size:14px;">Delete</span>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('setting/question');
    }
    public function active()
    {
        if(request()->ajax())
        {
            return datatables()->of(Question::where('qnum', '!=', null)->orderBy('qnum', 'asc')->get())->make(true);
            //$data = Question::where('qnum', '!=', null)->orderBy('qnum', 'asc')->get();
            //return response()->json(['data' => $data]);
        }
        return view('setting/question/active');
    }
    //------------Store Position
    public function storeposition(Request $request)
    {
        if (intval(strlen($request->position)) < 6) 
        {
            $error = array('Invalid position.');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            'position'         =>   ucwords(strtolower($request->position))
        );

        Position::create($form_data);
        return response()->json(['success' => 'Data Added Successfully.']);
    }

    //--------------Store Question
    public function storequestion(Request $request)
    {
        if (intval(strlen($request->qdesc)) < 6) 
        {
            $error = array('Invalid question.');
            return response()->json(['errors' => $error]);
        }
        $qcheck = DB::table('questions')->where('qdesc', $request->qdesc)->first();
        if($qcheck)
        {
            $error = array('Question already exist.');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            'qdesc'         =>   ucwords(strtolower($request->qdesc))
        );

        Question::create($form_data);
        return response()->json(['success' => 'Data Added Successfully.']);
    }

    //---- Store Admin
    public function store(Request $request)
    {
        
        $rules = array(
            //'utype'     =>  'required',
            'fname'     =>  'min:2',
            'lname'     =>  'min:2',
            'contact'   =>  'max:12',
            'user'  =>  'min:4',
            'pass'  =>  'min:6',
            'image'     =>  'image|max:2048'
        );

        $messages = [
            //'utype.required'    =>  'utype',
            'fname.min'         =>  'fn',
            'lname.min'         =>  'ln',
            'contact.max'       =>  'contact',
            'user.min'          =>  'user',
            'pass.min'          =>  'pass',
            'image.max'         =>  'img'
        ];

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $name = "";
        $utype = $request->utype;
        if ($request->mname == ""){ $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->lname)); }
        else { $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->mname)) . " " . ucwords(strtolower($request->lname)); }

        $image = $request->file('image');
        $new_name = rand() . '.' . $image -> getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $status = "Active";
        $form_data = array (
            'utype'         =>  $request->utype,
            'fname'         =>  ucwords(strtolower($request->fname)),
            'lname'         =>  ucwords(strtolower($request->lname)),
            'mname'         =>  ucwords(strtolower($request->mname)),
            'contact'       =>  $request->contact,
            'image'         =>  $new_name,
            'status'        =>  $status
        );

        if(Admin::where('fname',$request->fname)->where('lname',$request->lname)->exists())
        {
            if (User::where('name', $name)->exists())
            {
                $user_id = DB::table('admins')
                    ->where('fname', $request->fname)
                    ->where('lname', $request->lname)->first();

                if (User::where('uid', $user_id->id)->exists())
                {
                    $error = array('Account already exists.');
                    return response()->json(['errors' => $error]);
                }
            }
            
        }
        
        Admin::create($form_data);

        $user_id = DB::table('admins')
                    ->where('fname', $request->fname)
                    ->where('lname', $request->lname)->first();
        
        $form_user = array (
            'uid'           =>  $user_id->id,
            'utype'         =>  $request->utype,
            'name'          =>  $name,
            'username'      =>  $request->user,
            'password'      =>  Hash::make($request->pass)      
        );

        User::create($form_user);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Admin::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function editquestion($id)
    {
        if(request()->ajax())
        {
            $data = Question::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function set($id)
    {
        if(request()->ajax())
        {
            $data = Question::findorFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function setnumber(Request $request)
    {
        // $checknum = DB::table('questions')->where('qdesc', $request->hidden_qdesc)->where('qnum', $request->num)->first();
        // if($checknum){
        //     $error = array('Number already used in question.');
        //     return response()->json(['errors' => $error]);
        // }
        if(intval($request->num) > 10 or intval($request->num) == 0)
        {
            $error = array('Invalid number.');
            return response()->json(['errors' => $error]);
        }
        $checknum = DB::table('questions')->where('qnum', $request->num)->first();
        $setToNull = array('qnum' => null);
        if($checknum){
            Question::whereId($checknum->id)->update($setToNull);
        }
        $form_data = array(
            'qnum'  =>  intval($request->num)
        );
        Question::whereId($request->hidden_num)->update($form_data);
        return response()->json(['success' => 'Number Set Successfully.']);
    }

    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $rules = array(
                //'utype'     =>  'required',
                'fname'     =>  'min:2',
                'lname'     =>  'min:2',
                'contact'   =>  'max:12',
                'image'     =>  'image|max:2048'
            );
    
            $messages = [
                //'utype.required'    =>  'utype',
                'fname.min'         =>  'fn',
                'lname.min'         =>  'ln',
                'contact.max'       =>  'contact',
                'image.max'         =>  'img'
            ];
    
            $error = Validator::make($request->all(), $rules, $messages);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $imgWillDelete = public_path().'/images/'.$image_name;
            File::delete($imgWillDelete);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else 
        {
            $rules = array(
                //'utype'     =>  'required',
                'fname'     =>  'min:2',
                'lname'     =>  'min:2',
                'contact'   =>  'max:12',
                'image'     =>  'image|max:2048'
            );
    
            $messages = [
                //'utype.required'    =>  'utype',
                'fname.min'         =>  'fn',
                'lname.min'         =>  'ln',
                'contact.max'       =>  'contact',
                'image.max'         =>  'img'
            ];
            $error = Validator::make($request->all(), $rules, $messages);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
        'utype'         =>  $request->utype,
        'fname'         =>  ucwords(strtolower($request->fname)),
        'lname'         =>  ucwords(strtolower($request->lname)),
        'mname'         =>  ucwords(strtolower($request->mname)),
        'contact'       =>  $request->contact,
        'image'         =>  $image_name
        );

        $get_id = DB::table('users')->where('uid',$request->hidden_id)->first();

        $name = "";
        if($request->mname == "") { $name = ucwords(strtolower($request->fname)). " " . ucwords(strtolower($request->lname)); }
        else { $name = ucwords(strtolower($request->fname)) . " " . ucwords(strtolower($request->mname)) . " " . ucwords(strtolower($request->lname)); }
        
        $form_user = array ( 'utype'    => $request->utype, 'name' =>  $name );
        
        Admin::whereId($request->hidden_id)->update($form_data);
        User::whereId($get_id->id)->update($form_user);
        return response()->json(['success' => 'Data Updated Successfully.']);
        
    }

    public function updatequestion(Request $request)
    {
        if (intval(strlen($request->qdesc)) < 6) 
        {
            $error = array('Invalid question.');
            return response()->json(['errors' => $error]);
        }

        $form_data = array(
            'qdesc'         =>   ucwords(strtolower($request->qdesc))
        );

        Question::whereId($request->question_id)->update($form_data);
        return response()->json(['success' => 'Data Updated Successfully.']);
    }

    public function destroy($id)
    {
        $data = Admin::findorFail($id);
        $user_id = DB::table('users')->where('uid', $id)->first();
        $user_data = User::findorFail($user_id->id);
        $imgWillDelete = public_path().'/images/'.$data->image;
        File::delete($imgWillDelete);
        $data->delete(); 
        $user_data->delete();
    }

    public function destroyposition($id)
    {
        $data = Position::findorFail($id);
        $data->delete(); 
    }
    public function destroyquestion($id)
    {
        $data = Question::findorFail($id);
        $data->delete(); 
    }
    
    public function deactivate($id)
    {
        DB::table('admins')->where('id', $id)->update(['status' => "Deactive"]);
    }
    public function activate($id)
    {
        DB::table('admins')->where('id', $id)->update(['status' => "Active"]);
    }
}
