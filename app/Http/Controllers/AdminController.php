<?php

namespace App\Http\Controllers;

use App\Mission;
use App\Order;
use App\Point;
use App\Post;
use App\Prize;
use App\Restock;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login()
    {
        $this->validate(request(),[
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')->attempt(['username'=>request('username'),'password'=>request('password')])){
            return redirect('cpanel/home');
        }else{
            return redirect()->back()->with('logerr','Credentials Does not Match!');
        }
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showMission()
    {
        $missions = Mission::latest()->paginate(10);
        return view('admin.mission',compact('missions'));
    }

    public function addMission()
    {
        $this->validate(request(),['links'=>'required']);
        Mission::create(['links'=>request('links')]);
        return redirect()->back();
    }

    public function deleteMission($id)
    {
        Mission::find($id)->delete();
        return redirect()->back();
    }

    public function showPointReset()
    {
        return view('admin.point-reset');
    }

    public function pointReset()
    {
        Point::query()->update(['daily_count' => 5]);
        return redirect()->back();
    }

    public function restock()
    {
        $getRestockStatus = Restock::first()->restock;
        if($getRestockStatus == 'yes'){
            Restock::query()->update(['restock' => 'no']);
        }else{
            Restock::query()->update(['restock' => 'yes']);
        }

        return redirect()->back();
    }

    public function showPrize()
    {
        $prizes = Prize::latest()->paginate(10);
        $restock = Restock::first();
        return view('admin.prize',compact(['prizes','restock']));
    }

    public function addPrize(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'picture' => 'required|image',
        ]);

        $imgName = uniqid();

        $prize = new Prize();
        $prize->name = request('name');
        $prize->price = request('price');
        $prize->quantity = request('quantity');
        $prize->picture = $imgName.'.jpg';
        $prize->save();

        $request->picture->move('prize',$imgName.'.jpg');

        return redirect()->back();

    }

    public function deletePrize($id)
    {
        File::delete(public_path('prize/'.Prize::find($id)->picture));
        Prize::find($id)->delete();
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('cpanel/login');
    }

    public function orderShow()
    {
        $getAllOrders = Order::latest()->paginate(20);
        $getPendings = Order::where('status','!=','delivered')->get()->count();
        return view('admin.orders',compact(['getAllOrders','getPendings']));
    }

    public function orderStatus($id)
    {
        $this->validate(request(),[
            'status' => 'required'
        ]);

        if(request('status') == 'pending'){
           Order::find($id)->update(['status' => 'pending']);
           return redirect()->back();
        }else if(request('status') == 'sent'){
            Order::find($id)->update(['status' => 'sent']);
            return redirect()->back();
        }else if(request('status') == 'delivered'){
            Order::find($id)->update(['status' => 'delivered']);
            return redirect()->back();
        }else if(request('status') == 'delete'){
            Order::find($id)->delete();
            return redirect()->back();
        }
    }

    public function showUsers()
    {
        $users = User::latest()->paginate(50);
        return view('admin.user-manager',compact('users'));
    }

    public function showSearchUsers()
    {
        $src = request('search');
        $searchUsers = User::where('username','like','%'.$src.'%')->get();
        return view('admin.user-manager',compact('searchUsers'));
    }

    public function actionUsers($id)
    {
        $this->validate(request(),[
            'status' => 'required'
        ]);

        $getUser = User::find($id);

        if(request('status') == 'yes'){
            $getUser->update(['active' => 'yes']);
            return redirect()->back()->with('actionSuccess','Action Taken');
        }else if(request('status') == 'no'){
            $getUser->update(['active' => 'no']);
            return redirect()->back()->with('actionSuccess','Action Taken');
        }else if(request('status') == 'delete'){
            $getUser->delete();
            return redirect()->back()->with('actionSuccess','Action Taken');
        }
    }

    public function showPost()
    {
        $allPost = Post::latest()->paginate(20);
        return view('admin.post',compact('allPost'));
    }

    public function makePost(Request $request)
    {
        $this->validate(request(),[
            'details' => 'required',
            'picture' => 'image'
        ]);

        $imgName = uniqid();

        $newPost = new Post();
        $newPost->details = request('details');
        if(request('picture') == null){
            $newPost->picture = 'none';
        }else{
            $newPost->picture = $imgName.'.jpg';
            $request->picture->move('posts',$imgName.'.jpg');
        }
        $newPost->save();

        return redirect()->back();
    }

    public function deletePost($id)
    {
        $post = Post::find($id);

        if($post->picture != 'none'){
            File::delete(public_path('posts/'.$post->picture));
        }

        $post->delete();

        return redirect()->back();
    }
}
