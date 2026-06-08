<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(){
        return view('user.register');
    }

    public function register_submit(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $token = hash('sha256', time());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'token' => $token,
            'status' => 1,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function login(){
        return view('user.login');
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::guard('web')->attempt($credentials)){
            return redirect()->route('user_dashboard');
        }else{
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function dashboard(){
        return view('user.dashboard');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function forget_password_form(){
        return view('user.forget_password');
    }

    public function forget_password(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $link = route('reset_password', [$token, $request->email]);
        $subject = 'Reset Password';
        $message = 'Click on the following link to reset password: <br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');
    }

    public function reset_password(){

    }

    public function profile(){
        return view('user.profile');
    }
    public function profile_submit(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::guard('web')->user()->id,
            'phone' => 'required',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = Auth::guard('web')->user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
        ];

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time().'_'.$photo->getClientOriginalName();
            $photo->move(public_path('uploads'), $filename);
            $data['photo'] = $filename;
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully');
    }
}
