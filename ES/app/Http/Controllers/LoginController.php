<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Artisan;
use Auth;
use App\Admin;
use App\Student;
use App\User;
use Validator;

class LoginController extends Controller
{
    //
    function checklogin(Request $request)
    {
        $user_data = array(
            'username'  =>  $request->get('user'),
            'password'  =>  $request->get('password')
        );

        if(Auth::attempt($user_data))
        {
            
            Cache::flush();
            \Artisan::call('cache:clear');
            \Artisan::call('update:sy');
            
            $uid = Auth::user()->uid;
            $utype = Auth::user()->utype;

           

            if($utype == "Student")
            {
                return redirect('profile');
            }
            else
            {
                $status_admin = Admin::findorFail($uid);
                if($status_admin->status == "Active")
                {
                    return redirect('dashboard');
                }
                else
                {
                    Auth::logout();
                    return back()->with('error', 'Account deactivated.');
                }
            }
        }
        else
        { return back()->with('error', 'Wrong login details'); }
    }

    function logout()
    {
        Auth::logout();
        Cache::flush();
        \Artisan::call('cache:clear');
        return redirect('login');
    }
}
