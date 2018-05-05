<?php

namespace App\Http\Controllers;

use App\Approve;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckpointController extends Controller
{
    public function index()
    {
        if(User::find(Auth::id())->approve == null){
            return redirect('/dashboard');
        }
        return view('user.checkpoint');
    }

    public function check()
    {
       $this->validate(request(),[
           'code' => 'required',
       ]);

       if(User::find(Auth::id())->approve->code == request('code')){
           User::find(Auth::id())->approve->delete();
           User::find(Auth::id())->update(['active' => 'yes']);
           return redirect('/dashboard');
       }else{
           return redirect()->back()->with('codeError','Wrong Code');
       }
    }

    public function resend()
    {
        $user = User::find(Auth::id());
        $code = $user->approve->code;
        $mail = $user->email;
        mail($mail,'Approval','Your code is: '.$code);
        return redirect()->back()->with('codeError','Code Has Been Sent!');
    }
}
