<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
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
        return view('home');
    }

    public function dashboard()
    {
        if (auth('user')->check() && authUser()->role == 'user') {
            return redirect()->route('user.transaction');
        } elseif (auth('user')->check() && authUser()->role == 'canteen') {
            
            return redirect()->route('menu_master.index');
        } elseif(auth('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect('login');
    }


    
}
