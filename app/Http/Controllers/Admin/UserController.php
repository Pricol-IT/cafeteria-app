<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();

        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'company_name' => 'required',
            'name' => 'required',
            'emp_id' => 'required|unique:users,emp_id',
            'rfid' => 'required',
            'email' => 'required',
            'location' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);

        // return $input;

        $user = User::on('mysql')->create([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'emp_id' => $request->emp_id,
            'rfid' => $request->rfid,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'role' => 'user',
            'status' => 'active',
        ]);
        // $user1 = User::on('second_mysql')->create([
        //     'company_name' => $request->company_name,
        //     'name' => $request->name,
        //     'emp_id' => $request->emp_id,
        //     'rfid' => $request->rfid,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'location' => $request->location,
        //     'role' => 'user',
        //     'status' => 'active',
        // ]);
        if($user)
        {
            toastr()->success('User Created Successfully');
            return redirect()->route('user.index');
        }
        else
        {
            toastr()->error('Something wrong please try again!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return view('admin.user.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'company_name' => 'required',
            'name' => 'required',
            'emp_id' => 'required',
            'rfid' => 'required',
            'email' => 'required',
            'location' => 'required',
        ]);

        $user = User::on('mysql')->where('id',$id)->update([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'emp_id' => $request->emp_id,
            'rfid' => $request->rfid,
            'email' => $request->email,
            'location' => $request->location,
        ]);
        // $user1 = User::on('second_mysql')->where('id',$id)->update([
        //     'company_name' => $request->company_name,
        //     'name' => $request->name,
        //     'emp_id' => $request->emp_id,
        //     'rfid' => $request->rfid,
        //     'email' => $request->email,
        //     'location' => $request->location,
        // ]);
        if($user)
        {
            toastr()->success('User Created Successfully');
            return redirect()->route('user.index');
        }
        else
        {
            toastr()->error('Something wrong please try again!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        toastr()->success('User Removed Successfully');
        return back();

    }
}
