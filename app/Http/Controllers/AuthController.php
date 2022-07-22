<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showlogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $email =  $request->email;
        $checkuser = User::where('email',$email)->first();
        if(!$checkuser){
            return redirect()->back()->with('error','Wrong email');
        }
        if(!Hash::check($request->password,$checkuser->password)){
            return redirect()->back()->with('error','Wrong Password');
        }
        auth()->login($checkuser);
        
        return redirect('/')->with('success','Welcome'.auth()->user()->name);
        
    }
    public function showregister(){
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=>'required',
            'password'=> 'required',
            'address'=> 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'address'=> $request->address,
        ]);

        auth()->login($user);
    
        return redirect('/')->with('success','Welcome'.auth()->user()->name);
    }

    public function logout(){
        auth()->logout();
        return redirect('/login');
    }
    public function updatePassword(Request $request)
    {
        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $db_password = User::where('id', auth()->id())->first()->password;

        if (Hash::check($old_password, $db_password)) {
            User::where('id', auth()->id())->update([
                'password' => Hash::make($new_password)
            ]);
            auth()->logout();
            return redirect('/login')->with('success', 'Your Password Updated.Please Login');
        } else {
            return redirect()->back()->with('error', 'Wrong Password');
        }
    }
}
