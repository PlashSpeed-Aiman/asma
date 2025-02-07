<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){

            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->intended('/');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
