<?php

namespace App\Http\Controllers;

use App\Mission;
use App\Order;
use App\Post;
use App\Prize;
use App\Restock;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UserHomeController extends Controller
{
    public function index()
    {
        $allPost = Post::latest()->paginate(10);
        return view('user.dashboard',compact(['allPost']));
    }

    public function showMission()
    {
        $task = User::find(Auth::id())->point->daily_count;
        $missions = Mission::latest()->paginate(10);
        return view('user.mission',compact(['task','missions']));
    }


    public function getClick($id)
    {
        $getToken = User::find(Auth::id())->point->token;
        session(['pointToken' => $getToken,'linkId' => $id]);
        $getUrl = Mission::find($id)->links;
        return redirect($getUrl);
    }


    public function clickCheck()
    {
        $userPoint = User::find(Auth::id())->point;
        $getValidToken = $userPoint->token;

        //work with links
//        $preLink = URL::previous();
//        $a = explode('/go', $preLink);
//        $b = implode('', $a);
//        dd('var: '.Mission::find(session('linkId'))->links.' || '.$b);
//        Mission::find(session('linkId'))->links == $b
        if($getValidToken == session('pointToken')){
            session()->forget('pointToken','linkId');
            $reToken = sha1(uniqid(rand()));

            $userPoint->update(['token' => $reToken]);

            $getDailyCount = $userPoint->daily_count;
            if($getDailyCount <= 0){
                return redirect('/missions')->with('getPointError','Daily Point Limit Exceed');
            }else{
                $getTotalPoint = $userPoint->total_points;
                $getTotalPoint = $getTotalPoint+1;

                $getDailyCount = $getDailyCount - 1;

                $userPoint->update(['total_points' => $getTotalPoint , 'daily_count' => $getDailyCount]);

            }

            return redirect('/missions')->with('pointSuccess','Point Received');
        }else{
            return redirect('/missions')->with('pointError','Unauthorized Access');
        }
    }


    public function showPrize()
    {
        $checkIfAlreadyOrdered = Order::where('user_id',Auth::id())->where('status','pending')->get()->count();
        $prizes = Prize::latest()->get();
        $restock = Restock::first();
        return view('user.prize',compact(['prizes','restock','checkIfAlreadyOrdered']));
    }

    public function orderPage($id)
    {
        if(Restock::first()->restock == 'yes'){
            if($id == null){return redirect()->back();}
            $setId = $id;
            return view('user.orderPage',compact('setId'));
        }else{
            return redirect('/prizes')->with('orderError','Order will available when restock');
        }

    }

    public function orderPrize($id)
    {
        $checkIfAlreadyOrdered = Order::where('user_id',Auth::id())->where('status','pending')->get()->count();
        if(Restock::first()->restock == 'yes' && $checkIfAlreadyOrdered <= 0){
            $this->validate(request(),[
                'id' =>'required',
                'name' => 'required',
                'phone' => 'numeric|required',
                'email' => 'required|email',
                'address' => 'required'
            ]);
            if($id == null){return redirect('/prizes');}
            $getPrize = Prize::find($id);
            $getPrizeName = $getPrize->name;
            if($getPrize->quantity <= 0){
                return redirect('/prizes')->with('orderExceed','Out Of Stock');
            }else{
                $getPrizePrice = $getPrize->price;
                $getUserPoint = User::find(Auth::id())->point->total_points;
                if(($getUserPoint-$getPrizePrice) < 0){
                    return redirect('/prizes')->with('orderError','Not Enough Points');
                }else{
                    $userPointUpdate = $getUserPoint - $getPrizePrice;
                    User::find(Auth::id())->point->update(['total_points' => $userPointUpdate]);
                    //order
                    $getPrizeCount = $getPrize->quantity;
                    $getPrizeCount = $getPrizeCount - 1;
                    $getPrize->update(['quantity' => $getPrizeCount]);

                    User::find(Auth::id())->orders()->create([
                        'name' => request('name'),
                        'phone' => request('phone'),
                        'email' => request('email'),
                        'address' => request('address'),
                        'status' => 'pending',
                        'prize_name' => $getPrize->name
                    ]);

                    return redirect('/myorders')->with('orderSuccess','Ordered Successfully');

                }
            }
        }else{
            return redirect('/prizes')->with('orderError','Order will available when restock');

        }

    }



    public function myOrders()
    {
        $myPrize = User::find(Auth::id())->prizes()->paginate(10);
        return view('user.myOrder',compact('myPrize'));
    }

    public function showProfile()
    {
        $getData = User::find(Auth::id())->profile;
        return view('user.profile',compact('getData'));
    }

    public function updateProfile()
    {
        $this->validate(request(),[
            'full_name' => 'required',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'permanent_address' => 'required|min:6'
        ]);

        User::find(Auth::id())->profile->update([
            'full_name' =>request('full_name'),
            'phone' => request('phone'),
            'gender' => request('gender'),
            'permanent_address' => request('permanent_address')
        ]);

        return redirect()->back()->with('updateSuccess','Update Successful');
    }

    public function updatePassword()
    {
        $this->validate(request(),[
            'password' => 'required|min:5|confirmed',
        ]);

        User::find(Auth::id())->update(['password' => bcrypt(request('password'))]);

        return redirect()->back()->with('updateSuccess','Password Update Successful');
    }
}
