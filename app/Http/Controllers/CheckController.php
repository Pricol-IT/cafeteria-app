<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
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
}
