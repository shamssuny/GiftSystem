<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $this->validate(request(),[
            'username' => 'required|min:5|unique:users|alpha_dash',
            'email' => 'required|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        $createUser = User::create([
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'active' => 'no'
        ]);
        $code = rand(100000,999999);
        $token = sha1(uniqid(rand()));
        $createUser->profile()->create();
        $createUser->approve()->create(['code'=> $code]);
        $createUser->point()->create(['total_points'=>0,'daily_count'=>5,'token'=>$token]);

        return redirect('/login')->with('regSuccess','Register Success. Check Mail and Login to continue');
    }
}
