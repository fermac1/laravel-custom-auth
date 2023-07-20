<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    
    public function registrationView()
    {
        return view('auth.registration');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:6|alpha_num'
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>Hash::make($data['password'])
        ]);

        return redirect('dashboard')->withSuccess('You have successfully logged in!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required',
            'password' =>'required'
        ]);

        $user_data = $request->only('email', 'password');
        if(Auth::attempt($user_data)){
            return redirect()->intended('dashboard')->withSuccess('You have successfully logged in');
        }

        return redirect('login')->withSuccess('You have entered invalid credentials.');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect('login')->withSuccess('You do not have access');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
