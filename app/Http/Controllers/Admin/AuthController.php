<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    
    public function login(){
        // User::create([
        //     'name' => 'admin',
        //     'email'=> 'admin@a.com',
        //     'password'=>Hash::make('password'),
        //     'address'=> 'address',
        //     'role'=>'admin',
        // ]);
        // return auth()->user();
        return view('admin.auth.login');
    }
    public function Postlogin(Request $request){
        auth()->logout();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Need Email',
            'password.required' => 'Need Password',
        ]);
        $cre = $request->only('email','password');
        if(auth()->attempt($cre)){
            
            $user =  auth()->user();
            if($user->role === 'user'){
                return redirect()->back()->with('error','You are not admin yet');
            }
            return redirect('/admin')->with('success','Welcome admin');
        }     
    }

    public function home(){
        return view('admin.auth.home');
    }
}
