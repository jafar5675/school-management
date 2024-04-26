<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\forgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(){
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }

    public function authLogin(Request $request){

       $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' =>$request->email, 'password' =>$request->password],$remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
       }
       else{
        return redirect()->back()->with('error','please enter valid email and password');
       }
    }

    public function forgotPassword(){
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
       $user = User::getEmailSingle($request->email);
       if(!empty($user))
       {
        $user->remember_token = Str::random(30);
        $user->save();
        Mail::to($user->email)->send(new forgotPasswordMail($user));
        return redirect()->back()->with('success','Please check your email and reset your password');
       }
       else
       {
          return redirect()->back()->with('error','Email not found in the system');
       }
    }

    public function reset($token)
    {
        $user = User::getTokenSingle($token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset',$data);
        }
        else
        {

            abort(404);
        }
    }

    public function PostReset($token, Request $request)
    {

        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect('/')->with('success', 'Password Reset Successfully');
        }
        else
        {
            return redirect()->back()->with('error', 'Password and Confirm password not matched');
        }
    }
    public function logout(){
        Auth::logout();
        return view('auth.login');
    }
}
