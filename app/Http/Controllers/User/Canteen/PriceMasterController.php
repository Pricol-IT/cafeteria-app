<?php

namespace App\Http\Controllers\User\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceMaster;

class PriceMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = PriceMaster::orderBy('id','desc')->get();

        return view('users.canteen.pricemaster.index',compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.canteen.pricemaster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'menu_type' => 'required',
            'quantity' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $price = PriceMaster::create($input);

        if($price)
        {
            toastr()->success('Price Created Successfully');
            return redirect()->route('price_master.index');
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
        $price = PriceMaster::find($id);

        return view('users.canteen.pricemaster.edit',compact('price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'menu_type' => 'required',
            'quantity' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $price = PriceMaster::where('id',$id)->update($input);

        if($price)
        {
            toastr()->success('Price Updated Successfully');
            return redirect()->route('price_master.index');
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
        $menu = PriceMaster::where('id',$id);
        $menu->delete();
        toastr()->success('Price Removed Successfully');
        return back();
    }
}
