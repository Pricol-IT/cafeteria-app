<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use DB;
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

    public function deliverySpm(Request $request)
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

                $today = Token::select('id', 'emp_id', 'spm', 'sim', 'curd')
                        ->whereDate('day', date('Y-m-d'))
                        ->where('spm','!=','null')
                        ->where('emp_id', $user_id[0]->id)
                        ->first();

                    if (!$today ) {
                        toastr()->error('No entry found for today in this ID'.$user_id[0]->emp_id);
                        return back();
                    }
                    $result = [
                        'day' => date('Y-m-d'),
                        'spm' => $today->spm ? $today->spm : null,
                        'curd' => $today->curd ? $today->curd  : null,
                    ];
                    
            }
            else
            {
                toastr()->error('User ID Not  Found');
                return back();
            }
            
            
        }

        return view('users.canteen.deliverysp',compact('user_id','result','forcheck'));  
    }
    public function deliverySim(Request $request)
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

                $today = Token::select('id', 'emp_id', 'sim', 'curd')
                        ->whereDate('day', date('Y-m-d'))
                        ->where('sim','!=','null')
                        ->where('emp_id', $user_id[0]->id)
                        ->first();

                    // Get monthly entry
                    $monthly = Token::select('id', 'emp_id', 'monthly_sim', 'monthly_curd', 'monthly_days', 'monthly')
                        ->whereMonth('monthly', Carbon::now()->month)
                        ->where('monthly_sim','!=','null')
                        ->where('emp_id', $user_id[0]->id)
                        ->first();

                        
                    if (!$today && !$monthly) {
                        
                        toastr()->error('No entry found for today in this ID'.$user_id[0]->emp_id);
                        return back();
                        
                    }
                    else
                    {
                        if(!$today && !(in_array(date('d-m-Y'), json_decode($monthly->monthly_days, true))))
                        {
                            toastr()->error('No entry found for today in this ID'.$user_id[0]->emp_id);
                        return back();
                        }
                    }

                    // Prepare the result array
                    $result = [
                        'day' => date('Y-m-d'),
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

        return view('users.canteen.deliverysi',compact('user_id','result','forcheck'));  
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
            return redirect()->route($request->page);
        }
        else
        {
            $deliveryentry = Delivery::create($input);
            if($deliveryentry)
            {
                toastr()->success('Token Delivered Successfully');
                return redirect()->route($request->page);
            }
            else
            {
                toastr()->error('Something Went Wrong Please Try Again');
                return back();
            }
        }


        return $request;    
    }


    public function total_month_request()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $results = DB::table('tokens')
            ->select('emp_id',
                // DB::raw('DATE_FORMAT(day, "%Y-%m") as record_month'),
                DB::raw('SUM(spm) as total_spm'),
                DB::raw('SUM(sim) as total_sim'),
                DB::raw('SUM(curd) as total_curd'),
                DB::raw('SUM(monthly_sim * JSON_LENGTH(monthly_days)) as total_monthly_sim'),
                DB::raw('SUM(monthly_curd * JSON_LENGTH(monthly_days)) as total_monthly_curd'),
                DB::raw('SUM(sim) + SUM(monthly_sim * JSON_LENGTH(monthly_days)) as total_month_sim'),
                DB::raw('SUM(curd) + SUM(monthly_curd * JSON_LENGTH(monthly_days)) as total_month_curd'),
            )
            ->where(function ($query) use ($currentMonth) {
        $query->where('day', 'like', $currentMonth . '%')
            ->orWhere('monthly', 'like', $currentMonth . '%');
    })
            ->groupBy('emp_id')
            ->get();
            return $results;
            
    }


    public function singleday_request()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        // $currentMonth = Carbon::now()->format('Y-m');
        $currentDate = Carbon::now()->toDateString();
        $formattedDates = Carbon::createFromFormat('Y-m-d', $currentDate)->format('d-m-Y');
// return $formattedDates;
        $results = DB::table('tokens')
            ->select('tokens.emp_id','users.emp_id')
            ->selectRaw('SUM(IFNULL(tokens.spm, 0)) as total_spm')
            ->selectRaw('SUM(IFNULL(tokens.sim, 0) + IFNULL(tokens.monthly_sim, 0)) as total_sim')
            ->selectRaw('SUM(IFNULL(tokens.curd, 0) + IFNULL(tokens.monthly_curd, 0)) as total_curd')
             
            ->where(function ($query) use ($currentDate,$formattedDates) {
                $query->orWhereDate('day', $currentDate)
                    ->orWhereRaw("monthly_days REGEXP ?",['[[:<:]]' . $formattedDates . '[[:>:]]']);
            })
            ->groupBy('tokens.emp_id','users.emp_id')
            ->join('users', 'tokens.emp_id', '=', 'users.id')
            ->get();
        
            // return $results;

             return view('users.canteen.todaycount',compact('results'));
    }


    public function usertoken()
    {
        $user = Token::with('user:id,emp_id')->get();

        return $user;
    }
}
