<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Approval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(User::find(Auth::id())->approve != null){
            return redirect('/checkpoint');
        }

        if(User::find(Auth::id())->approve == null && User::find(Auth::id())->active == 'no'){
            Auth::logout();
            return redirect('/login')->with('loginError','Account Is Disabled');
        }
        return $next($request);
    }
}
