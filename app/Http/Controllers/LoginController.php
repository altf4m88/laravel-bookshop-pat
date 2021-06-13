<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{   
    public function login(){
        if(Auth::check()){
            return redirect('home');
        }
        return view('login');
    }

    //username : super , password: stalin123
    public function auth(Request $request){
        if (Auth::attempt($request->only('username', 'password'))){
            return redirect('home');
        }
        return redirect('login');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('login');
    }
}
