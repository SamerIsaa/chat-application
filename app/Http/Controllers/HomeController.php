<?php

namespace App\Http\Controllers;

use App\Events\UserLogin;
use App\Events\UserOnline;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $pusher ;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function chat()
    {
//        auth()->user()->update([
//            'isOnline' => true
//        ]);
//        broadcast(new UserOnline(auth()->user()))->toOthers();

        $onlineUsers = User::where('id' , '!=' , auth()->id())->with('unreadedMessages')->orderBy('isOnline' , 'desc')->get();
        return view('chat' , compact('onlineUsers'));
    }

}
