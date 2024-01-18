<?php

namespace App\Http\Controllers\User\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id','desc')->get();

        return view('users.canteen.bannermenu.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.canteen.bannermenu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $input = $request->validate([
            'day_type' => 'required',
            'day' => 'required',
        ]);

        $Banner = Banner::create($input);

        if($Banner)
        {
            toastr()->success('Banner Menu Created Successfully');
            return redirect()->route('banner_menu.index');
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
        $banner = Banner::find($id);

        return view('users.canteen.bannermenu.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $input = $request->validate([
            'day_type' => 'required',
            'day' => 'required',
        ]);
        if ($image = $request->spm_bg) {
            $url = uploadImage($image, 'menu');
            $input['spm_bg'] = $url;
        }
        if ($image1 = $request->sim_bg) {
            $url1 = uploadImage($image1, 'menu');
            $input['sim_bg'] = $url1;
        }

        $Banner = Banner::where('id',$id)->update($input);

        if($Banner)
        {
            toastr()->success('Banner Menu Updated Successfully');
            return redirect()->route('banner_menu.index');
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
        //
        $menu = Banner::where('id',$id);
        $menu->delete();
        toastr()->success('Banner Menu Removed Successfully');
        return back();
    }
}
