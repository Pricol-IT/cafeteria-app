<?php

namespace App\Http\Controllers\User\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuMaster;

class MenuMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masters = MenuMaster::orderBy('id','desc')->get();

        return view('users.canteen.menu_master.index',compact('masters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.canteen.menu_master.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $input = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]); 
        if ($image = $request->image) {
            $url = uploadImage($image, 'menu');
            $input['image'] = $url;
        }
        $menu = MenuMaster::create($input);
        if($menu)
        {
            toastr()->success('Menu Created Successfully');
            return redirect()->route('menu_master.index');
        }
        else{
            toastr()->error('Something Went Wrong');
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
        $master = MenuMaster::find($id);
        return view('users.canteen.menu_master.edit',compact('master'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]); 
        if ($image = $request->image) {
            $url = uploadImage($image, 'menu');
            $input['image'] = $url;
        }
        $menu = MenuMaster::find($id)->update($input);
        if($menu)
        {
            toastr()->success('Menu Updated Successfully');
            return redirect()->route('menu_master.index');
        }
        else{
            toastr()->error('Something Went Wrong');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $menu = MenuMaster::where('id',$id);
        $menu->delete();
        toastr()->success('Menu Removed Successfully');
        return redirect()->route('menu_master.index');
    }
}
