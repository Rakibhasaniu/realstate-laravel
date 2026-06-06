<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(){
        return view('admin.login');
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       $check = $request->all();
       $data = [
        'email' => $check['email'],
        'password' => $check['password'],
       ];
        if(Auth::guard('admin')->attempt($data)){
        return redirect()->route('admin_dashboard');
       }else{
        return back()->with('error', 'Invalid email or password'); 
       };
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function forget_password_form(){
        return view('admin.forget_password');
    }

    public function forget_password(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
        $admin = Admin::Where('email',$request->email)->first();
        if(!$admin){
            return redirect()->back()->with('error','Email Not Found');
        }
        $token = hash('sha256', time());
        $admin->token= $token;
        $admin->update();

        $link= route('admin_reset_password',[$token,$request->email]);
        $subject='Reset Password';
        $message= 'Click on the following link to reset password: <br>';
        $message .='<a href="'.$link.'">'.$link.'</a>';
        Mail::to($request->email)->send(new Websitemail($subject,$message));
        return redirect()->back()->with('success','Reset password link sent to your email');

    }
    public function reset_password(){
        
    }
}
