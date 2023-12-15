<?php

namespace App\Http\Controllers\User\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuSelection;
use App\Models\MenuMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class MenuSelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masters = MenuSelection::with('menu')->orderBy('day','asc')->get();

        return view('users.canteen.menu_selection.index',compact('masters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masters = MenuMaster::orderBy('id','asc')->get();

        return view('users.canteen.menu_selection.create',compact('masters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        for ($i = 0; $i < count($request->day); $i++) 
        {
            $inputs = [
                'day' => $request->day[$i],
                'menu_master_id' => $request->menu_master_id[$i],
            ];
            
                $record = MenuSelection::Create($inputs);
        }
            if($record)
            {
                toastr()->success('Menu Selection Added Successfully');
                return redirect()->route('menu_selection.index');

            }
            else
            {
                
                toastr()->error('Something Went Wrong Please Try Again');
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
        $selection = MenuSelection::find($id);
        $masters = $masters = MenuMaster::orderBy('id','asc')->get();

        return view('users.canteen.menu_selection.edit',compact('masters','selection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'day' => 'required',
            'menu_master_id' => 'required',
        ]);

        $menu = MenuSelection::find($id)->update($input);

        if($menu)
        {
            toastr()->success('Menu Selection Updated Successfully');
            return redirect()->route('menu_selection.index');
        }
        else
        {
            toastr()->error('Something Went Wrong Please Try Again');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = MenuSelection::where('id',$id);
        $menu->delete();
        toastr()->success('Menu Removed Successfully');
        return redirect()->route('menu_selection.index');
    }
        
}
