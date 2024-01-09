<?php

namespace App\Http\Controllers\User\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiMenu;


class SIMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $simenus = SiMenu::orderBy('id','desc')->get();

        return view('users.canteen.simenu.index',compact('simenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.canteen.simenu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'day' => 'required',
            'sambar' => 'required',
            'rasam' => 'required',
            'poriyal' => 'required',
        ]);

        $simenu = SiMenu::create($input);

        if($simenu)
        {
            toastr()->success('Si Menu Created Successfully');
            return redirect()->route('si_menu.index');
        }
        else
        {
            toastr()->error('Something Went Wrong Please Try Again!');
            return back();
        }
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
        //
        $simenu = SiMenu::find($id);

        return view('users.canteen.simenu.edit',compact('simenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'day' => 'required',
            'sambar' => 'required',
            'rasam' => 'required',
            'poriyal' => 'required',
        ]);

        $simenu = SiMenu::where('id',$id)->update($input);

        if($simenu)
        {
            toastr()->success('Si Menu Updated Successfully');
            return redirect()->route('si_menu.index');
        }
        else
        {
            toastr()->error('Something Went Wrong Please Try Again!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = SiMenu::where('id',$id);
        $menu->delete();
        toastr()->success('Si Menu Removed Successfully');
        return back();
    }
}
