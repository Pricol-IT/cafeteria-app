<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AutoRecovery;
use App\Models\User;

class AutoRecoveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = AutoRecovery::orderBy('id','desc')->get();
        return view('admin.autorecovery.index',compact('records'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('id','desc')->where('status','active')->get();
        return view('admin.autorecovery.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->user_id[2];
        // $input = $request->validate([
        //     'user_id' => 'required',
        //     'monthly_spm' => 'nullable',
        //     'monthly_sim' => 'nullable',
        //     'monthly_curd' => 'nullable'
        // ]);
        
        for($i=0; $i<count($request->user_id); $i++)
        {
            $record = AutoRecovery::where('user_id',$request->user_id[$i])->first();
            if(!$record)
            {

             $records = AutoRecovery::create([
                    'user_id' => $request->user_id[$i],
                    'monthly_spm' => $request->monthly_spm,
                    'monthly_sim' => $request->monthly_sim,
                    'monthly_curd' => $request->monthly_curd,
                ]);
            }
            
        }
                toastr()->success('Users AutoBooking Enabled Successfully');
                return redirect()->route('auto_booking.index');
        // return $input;
        // $record = AutoRecovery::where('emp_id',$user_id)->get();
        // if($record)
        // {
        //     toastr()->error('User Already Exists');
        //     return back();
        // }
        // else{
        //     $records = AutoRecovery::create([
        //         'user_id' => $user_id,
        //         'monthly_spm' => $request->monthly_spm,
        //         'monthly_sim' => $request->monthly_sim,
        //         'monthly_curd' => $request->monthly_curd,
        //     ]);
        //     if($records)
        //     {
        //         toastr()->success('Users AutoRecovery Enabled Successfully');
        //         return redirect()->route('auto_booking.index');
        //     }
        //     else
        //     {
        //         toastr()->error('Something wrong please try again!');
        //         return back();
        //     }
            
        // }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = AutoRecovery::find($id);
        return view('admin.autorecovery.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'user_id' => 'required',
            'monthly_spm' => 'nullable',
            'monthly_sim' => 'nullable',
            'monthly_curd' => 'nullable'
        ]);

        $record = AutoRecovery::find($id)->update([
            'user_id' => $request->user_id,
            'monthly_spm' => $request->monthly_spm ? $request->monthly_spm : null,
            'monthly_sim' => $request->monthly_sim ? $request->monthly_sim : null,
            'monthly_curd' => $request->monthly_curd ? $request->monthly_curd : null
        ]);
        if($record)
        {
            toastr()->success('Users AutoBooking Updated Successfully');
            return redirect()->route('auto_booking.index');
        }
        else{
            toastr()->error('Something wrong please try again!');
                return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = AutoRecovery::find($id);
        $user->delete();

        toastr()->success('AutoBooking Removed Successfully');
        return back();
    }

    public function checkauto(Request $request)
    {
        $menu = AutoRecovery::where('user_id',$request->user_id)->exists();
        return $menu;
    }

    public function statusChange(Request $request)
    {
        $book = AutoRecovery::findOrFail($request->id);
        $book->status = $request->status;
        $book->save();

        if ($request->status == 1) {
            return responseSuccess(__('AutoBooking Activated Successfully'));

        } else {
            return responseSuccess(__('AutoBooking Deactivated Successfully'));
        }
    }
}
