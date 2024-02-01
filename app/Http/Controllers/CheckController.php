<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\SiMenu;
use App\Models\MenuSelection;
use App\Models\Banner;
use DB;

use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    public function checkuser($id)
    {

        $user = User::where('emp_id',$id)->first();

        if($user)
        {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        else{
            return redirect('/');
        }
        

    }

    public function banner()
    {

        $banners = Banner::orderBy('id','asc')->get();
        $start_date = $banners[0]->day; // Assuming you want to use the first record's day as the start date
        $end_date = $banners[1]->day; // Assuming you want to use the second record's day as the end date

        $masters = MenuSelection::with('menu')
        ->where('day', '>=', $start_date)
        ->where('day', '<=', $end_date)
        ->orderBy('day', 'asc')
        ->get();

        $simenus = SiMenu::where('day', '>=', $start_date)
                ->where('day', '<=', $end_date)
                ->orderBy('day', 'asc')
                ->get();
        
        // $masters = MenuSelection::with('menu')->orderBy('day','desc')->get();
        // $simenus = SiMenu::orderBy('id','desc')->get();
        

        return view('banner',compact('banners','masters','simenus'));
    }

    public function welcome()
    {

        return view('welcome');
    }
}
