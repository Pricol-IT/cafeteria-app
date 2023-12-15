<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use App\Models\Delivery;

class CanteenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.canteen.dashboard');
    }

    public function deliveryView(Request $request)
    {
        $monthly = [];
        $today = [];
        $forcheck = false;
        $user_id = '';
        $result = [];   
        if ($request->has('emp_id') && $request->emp_id != null) 
        {
            $user_id = User::select('id','emp_id','name')->where('emp_id',strtoupper($request->emp_id))->get();
            if(count($user_id)>0)
            {
                $forcheck = true;
                // $today = Token::select('id','emp_id','spm','sim','curd')->whereDate('day',date('Y-m-d'))->where('emp_id',$user_id[0]->id)->get();
                // $monthly = Token::select('id','emp_id','monthly_sim','monthly_curd')->whereMonth('monthly', Carbon::now()->month)->where('emp_id',$user_id[0]->id)->get();

                $today = Token::select('id', 'emp_id', 'spm', 'sim', 'curd')
                        ->whereDate('day', date('Y-m-d'))
                        ->where('emp_id', $user_id[0]->id)
                        ->first();

                    // Get monthly entry
                    $monthly = Token::select('id', 'emp_id', 'monthly_sim', 'monthly_curd', 'monthly_days', 'monthly')
                        ->whereMonth('monthly', Carbon::now()->month)
                        ->where('emp_id', $user_id[0]->id)
                        ->first();

                    if (!$today && !(in_array(date('d-m-Y'), json_decode($monthly->monthly_days, true)))) {
                        toastr()->error('No entry found for today or the current month.');
                        return back();
                    }

                    // Prepare the result array
                    $result = [
                        'day' => date('Y-m-d'),
                        'spm' => $today ? $today->spm : null,
                        'sim' => $today ? $today->sim : ($monthly && in_array(date('d-m-Y'), json_decode($monthly->monthly_days, true)) ? $monthly->monthly_sim : null),
                        'curd' => $today ? $today->curd : ($monthly && in_array(date('d-m-Y'), json_decode($monthly->monthly_days, true)) ? $monthly->monthly_curd : null),
                    ];
                    // return $result;
            }
            else
            {
                toastr()->error('User ID Not  Found');
                return back();
            }
            
            
        }

        return view('users.canteen.delivery',compact('user_id','result','forcheck'));  
    }

    public function deliveryStore(Request $request)
    {
        
        $input = $request->validate([

            'emp_id' => 'required',
            'day' => 'required',
            'spm' => 'nullable',
            'sim' => 'nullable',
            'curd' => 'nullable',

        ]);

        $delivery = Delivery::where('emp_id',$request->emp_id)->where('day',$request->day)->get();

        if(count($delivery) > 0)
        {
            toastr()->error('Already Delivered');
            return redirect()->route('canteen.deliveryview');
        }
        else
        {
            $deliveryentry = Delivery::create($input);
            if($deliveryentry)
            {
                toastr()->success('Token Delivered Successfully');
                return redirect()->route('canteen.deliveryview');
            }
            else
            {
                toastr()->error('Something Went Wrong Please Try Again');
                return back();
            }
        }


        return $request;    
    }
}
