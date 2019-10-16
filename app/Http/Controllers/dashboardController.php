<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class dashboardController extends Controller
{
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
        $user_id = auth()->User()->id;
        $user = User::find($user_id);
        $posts = $user->posts;
        return view('dashboard')->with('posts', $posts);
    }
}
