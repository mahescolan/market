<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\register;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;



class registerController extends Controller
{
    public function register(){
        return view('user.register');
    }
    public function regstore(Request $request){
     
        $validated = $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' =>'required|same:password',
        ]);
        
        $data =[
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password)
            
        ];
        register ::create($data);
        session()->flash('flase_message','Register successfully');
        return redirect()->back();
    }
    public function login(){

        return view('user.login');
    }
    public function Login_in(Request $request)
    {
       
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)){
           
            
            return redirect('user/dashboard')->withSuccess('You have Successfully loggedin');
        }
        // return 'Oppes! You have entered invalid email or password ';
        return redirect("user/login")->with('flase_message','Oppes! You have entered invalid Email or password');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('user/login');
    }
    public function dashboard(){
        return view('user.dashboard');
    }
   
}





