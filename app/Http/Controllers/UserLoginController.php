<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $this->validate(request(),[
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['username' => request('username'),'password'=>request('password')])){
            return redirect('/dashboard');
        }else{
            return redirect('/login')->with('loginError','Username/Password not matched!');
        }
    }


    public function showForget()
    {
        return view('forgetPass');
    }

    public function resetPass()
    {
        $this->validate(request(),[
            'email' => 'required'
        ]);

        $getMail = User::where('email',request('email'))->get();
        $count = $getMail->count();

        if($count == 1){
            $userMail = $getMail->first()->email;
            $userId = $getMail->first()->id;
            $randPass = rand(10000000,99999999);
            //mail function

            User::find($userId)->update(['password' => bcrypt($randPass)]);
            return redirect()->back()->with('resetError','Reset Mail Has Sent!');
        }else{
            return redirect()->back()->with('resetError','No Mail Found');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
