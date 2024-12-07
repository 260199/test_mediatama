<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('Login.login');
    }

    public function proses(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ],[
            'name.required'=> 'name Tidak Booleh Kosong!',
        ]);

        $credentials = $request->only('name','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            if($user){
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('Login.login');
        }
        return back()->withErrors([
            'name' => 'name Atau Password Anda Salah!!'
            ])->onlyInput('name');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    return redirect('/');
    }
}
