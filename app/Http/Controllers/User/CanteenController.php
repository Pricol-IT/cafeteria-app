<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use App\Models\RfidMaster;
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

    // public function deliverySpm(Request $request)
    // {
    //     $monthly = [];
    //     $today = [];
    //     $forcheck = false;
    //     $user_id = '';
    //     $result = [];   
    //     if ($request->has('emp_id') && $request->emp_id != null) 
    //     {
    //         $user_id = User::select('id','emp_id','name')->where('emp_id',strtoupper($request->emp_id))->get();
    //         if(count($user_id)>0)
    //         {
    //             $forcheck = true;

    //             $today = Token::select('id', 'emp_id', 'spm', 'sim', 'curd')
    //                     ->whereDate('day', date('Y-m-d'))
    //                     ->where('spm','!=','null')
    //                     ->where('emp_id', $user_id[0]->id)
    //                     ->first();

    //                 if (!$today ) {
    //                     toastr()->error('No entry found for today in this ID'.$user_id[0]->emp_id);
    //                     return back();
    //                 }
    //                 $result = [
    //                     'day' => date('Y-m-d'),
    //                     'spm' => $today->spm ? $today->spm : null,
    //                     'curd' => $today->curd ? $today->curd  : null,
    //                 ];
                    
    //         }
    //         else
    //         {
    //             toastr()->error('User ID Not  Found');
    //             return back();
    //         }
            
            
    //     }

    //     return view('users.canteen.deliverysp',compact('user_id','result','forcheck'));  
    // }
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

                $today = Token::select('id', 'emp_id', 'spm', 'curd')
                        ->whereDate('day', date('Y-m-d'))
                        ->where('spm','!=','null')
                        ->where('emp_id', $user_id[0]->id)
                        ->first();

                    // Get monthly entry
                    $monthly = Token::select('id', 'emp_id', 'monthly_spm', 'monthly_curd', 'monthly_days', 'monthly')
                        ->whereMonth('monthly', Carbon::now()->month)
                        ->where('monthly_spm','!=','null')
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
                        'spm' => $today ? $today->spm : ($monthly && in_array(date('d-m-Y'), json_decode($monthly->monthly_days, true)) ? $monthly->monthly_spm : null),
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
            $rfid = RfidMaster::where('user_id',$request->emp_id)->where('day',$request->day)->update(['status'=> 1]);
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
        // $currentDate = Carbon::now()->toDateString();
        // $formattedDates = Carbon::now()->format('d-m-Y');

        // $resultsFirstServer = DB::connection('mysql')->table('tokens')
        //     ->select('tokens.day', 'users.id', 'tokens.emp_id', 'users.emp_id', 'users.rfid', 'users.name')
        //     ->selectRaw('SUM(IFNULL(tokens.spm, 0)) as spm')
        //     ->selectRaw('SUM(IFNULL(tokens.sim, 0) + IFNULL(tokens.monthly_sim, 0)) as sim')
        //     ->selectRaw('SUM(IFNULL(tokens.curd, 0) + IFNULL(tokens.monthly_curd, 0)) as curd')
        //     ->where(function ($query) use ($currentDate, $formattedDates) {
        //         $query->orWhereDate('day', $currentDate)
        //             ->orWhereRaw("monthly_days REGEXP ?", ['\\b' . $formattedDates . '\\b']);
        //     })
        //     ->groupBy('tokens.emp_id', 'users.emp_id', 'users.id', 'users.name', 'users.rfid', 'tokens.day')
        //     ->join('users', 'tokens.emp_id', '=', 'users.id')
        //     ->get();
        //     // return $resultsFirstServer;
        //     foreach ($resultsFirstServer as $week) {

        //         RfidMaster::on('mysql')->create([
        //             'day' =>$currentDate,
        //             'user_id' =>$week->id,
        //             'emp_id' =>$week->emp_id,
        //             'rfid' =>$week->rfid,
        //             'name' =>$week->name,
        //             'spm' =>$week->spm,
        //             'sim' =>$week->sim,
        //             'curd' =>$week->curd,
        //         ]);
        //     }

            // return $resultsFirstServer;
            // $weeklyFirstDB = $this->insertIntoDatabase('mysql', $resultsFirstServer);
            //  DB::connection('second_mysql')->table('rfid_masters')->truncate();
            // $weeklySecondDB = $this->insertIntoDatabase('second_mysql', $resultsFirstServer);
    }


    public function singleday_request()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $currentDate = Carbon::now()->toDateString();
        $formattedDates = Carbon::createFromFormat('Y-m-d', $currentDate)->format('d-m-Y');
      
        $results = DB::table('tokens')
            ->select('tokens.day','users.id','tokens.emp_id','users.emp_id','users.rfid','users.name')
            
            ->selectRaw('SUM(IFNULL(tokens.spm, 0) + IFNULL(tokens.monthly_spm, 0)) as spm')
            ->selectRaw('SUM(IFNULL(tokens.sim, 0) + IFNULL(tokens.monthly_sim, 0)) as sim')
            ->selectRaw('SUM(IFNULL(tokens.curd, 0) + IFNULL(tokens.monthly_curd, 0)) as curd')
             
            ->where(function ($query) use ($currentDate,$formattedDates) {
                $query->orWhereDate('day', $currentDate)
                    ->orwhereRaw("monthly_days REGEXP ?", ['\\b' . $formattedDates . '\\b']);
            })
            ->groupBy('tokens.emp_id','users.emp_id','users.id','users.name','users.rfid','tokens.day')
            ->join('users', 'tokens.emp_id', '=', 'users.id')
            ->get();
        
            // return $results;

             return view('users.canteen.todaycount',compact('results'));
    }

    // protected function insertIntoDatabase($connection, $data)
    // {
    //     try {
    //         // Use the specified database connection
    //         DB::connection($connection)->beginTransaction();
            
            
    //         foreach ($data as $week) {

    //             RfidMaster::on($connection)->create([
    //                 'day' =>$week->day,
    //                 'user_id' =>$week->id,
    //                 'emp_id' =>$week->emp_id,
    //                 'rfid' =>$week->rfid,
    //                 'name' =>$week->name,
    //                 'spm' =>$week->spm,
    //                 'sim' =>$week->sim,
    //                 'curd' =>$week->curd,
    //             ]);
    //         }

    //         DB::connection($connection)->commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         // Handle the exception if something goes wrong
    //         DB::connection($connection)->rollBack();
    //         return false;
    //     }
    // }   


    public function usertoken()
    {
        $user = Token::with('user:id,emp_id')->get();

        return $user;
    }

    // public function syncTokenDetails()
    // {
    //     $currentDate = Carbon::now()->toDateString();
    //     $formattedDates = Carbon::now()->format('d-m-Y');

    //     // Connect to the first server database
    //     $resultsFirstServer = DB::connection('mysql')->table('tokens')
    //         ->select('tokens.day', 'users.id', 'tokens.emp_id', 'users.emp_id', 'users.rfid', 'users.name')
    //         ->selectRaw('SUM(IFNULL(tokens.spm, 0)) as spm')
    //         ->selectRaw('SUM(IFNULL(tokens.sim, 0) + IFNULL(tokens.monthly_sim, 0)) as sim')
    //         ->selectRaw('SUM(IFNULL(tokens.curd, 0) + IFNULL(tokens.monthly_curd, 0)) as curd')
    //         ->where(function ($query) use ($currentDate, $formattedDates) {
    //             $query->orWhereDate('day', $currentDate)
    //                 ->orWhereRaw("monthly_days REGEXP ?", ['\\b' . $formattedDates . '\\b']);
    //         })
    //         ->groupBy('tokens.emp_id', 'users.emp_id', 'users.id', 'users.name', 'users.rfid', 'tokens.day')
    //         ->join('users', 'tokens.emp_id', '=', 'users.id')
    //         ->get();

    //             // return date('Y-m-d:h:i:s');
    //         return $resultsFirstServer;
    //     // Connect to the second server database
        

    //     // Insert into the rfid_masters table in both databases
    //     // DB::connection('first_server')->table('rfid_masters')->insert($resultsFirstServer->toArray());
    //     // DB::connection('second_server')->table('rfid_masters')->insert($resultsSecondServer->toArray());
    // }

    public function reports(Request $request)
    {
        
        $query = DB::table('rfid_masters')
            ->select(
                'day',
                DB::raw('SUM(spm) as rfid_spm'),
                DB::raw('SUM(sim) as rfid_sim'),
                DB::raw('SUM(curd) as rfid_curd')
            )
            ->groupBy('day');

        

        $query1 = Delivery::select(
                'day',
                DB::raw('SUM(spm) as delivery_spm'),
                DB::raw('SUM(sim) as delivery_sim'),
                DB::raw('SUM(curd) as delivery_curd')
            )
            ->groupBy('day');

            $start_date = Carbon::parse(request()->from_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->to_date)->toDateTimeString();
            if ($request->has('from_date') && $request->from_date != null )
            {
                // $query->whereBetween('from_date', [$start_date, $end_date]);
                $query->whereDate('day', '>=', $start_date);
                $query1->whereDate('day', '>=', $start_date);
            }

            if ($request->has('to_date') && $request->to_date != null )
            {
                // $query->whereBetween('to_date', [$start_date, $end_date]);
                $query->whereDate('day', '<=', $end_date);
                $query1->whereDate('day', '<=', $end_date);
            }
            $rfidData = $query->get();
            $deliveryData = $query1->get();
        // Combine the data from both tables
        $combinedData = [];
        foreach ($rfidData as $rfidRow) {
            $day = $rfidRow->day;

            // Find the corresponding delivery row
            $deliveryRow = $deliveryData->where('day', $day)->first();

            $combinedData[] = [
                'day' => $day,
                'rfid_spm' => $rfidRow->rfid_spm,
                'delivery_spm' => $deliveryRow ? $deliveryRow->delivery_spm : 0,
                'rfid_sim' => $rfidRow->rfid_sim,
                'delivery_sim' =>$deliveryRow ? $deliveryRow->delivery_sim : 0,
                'rfid_curd' => $rfidRow->rfid_curd,
                'delivery_curd' => $deliveryRow ? $deliveryRow->delivery_curd : 0,
            ];
        }

        // return $combinedData;

        

        return view('users.canteen.reports',compact('combinedData'));
    }

    // public function detailedCount(Request $request)
    // {
    //     $users = User::select('id','emp_id')->where('status','active')->get();
    //     $query = RfidMaster::orderBy('id','asc');

    //     $start_date = Carbon::parse(request()->from_date)->toDateTimeString();
    //     $end_date = Carbon::parse(request()->to_date)->toDateTimeString();

    //     if ($request->has('from_date') && $request->from_date != null )
    //     {
    //         $query->whereDate('day', '>=', $start_date);
    //     }

    //     if ($request->has('to_date') && $request->to_date != null )
    //     {
    //         $query->whereDate('day', '<=', $end_date);
    //     }

    //     if ($request->has('emp_id') && $request->emp_id != 'All' && $request->emp_id != null)
    //     {
    //         $query->where('emp_id',  $request->emp_id);
    //     }

    //      $records = $query->get();
    //      return view('users.canteen.detailreports',compact('records','users'));
    //      // return $records;
    // }

    public function detailedCount(Request $request)
    {
        $users = User::select('id','emp_id')->where('status','active')->get();
        $query = RfidMaster::orderBy('id','asc');

        $start_date = Carbon::parse(request()->from_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->to_date)->toDateTimeString();
        $currentDate = Carbon::yesterday()->toDateString();

        if ($request->has('from_date') && $request->from_date != null )
        {
            $query->whereDate('day', '>=', $start_date);
        }
        
        if($request->from_date == null  && $request->to_date == null  && $request->emp_id != 'All' && $request->emp_id == null)
        {
            $query->whereDate('day', '>=', $currentDate);
        }

        if ($request->has('to_date') && $request->to_date != null )
        {
            $query->whereDate('day', '<=', $end_date);
        }

        if ($request->has('emp_id') && $request->emp_id != 'All' && $request->emp_id != null)
        {
            $query->where('emp_id',  $request->emp_id);
        }

         $records = $query->get();
         return view('users.canteen.detailreports',compact('records','users'));
         // return $records;
    }

    public function detailedmonthCount(Request $request)
    {
        $users = User::select('id','emp_id')->where('status','active')->get();
        
         
    $query = RfidMaster::selectRaw('rfid_masters.emp_id, rfid_masters.name,
    SUM(IFNULL(rfid_masters.spm, 0) * CASE WHEN price_masters.code = "spm" THEN 1 ELSE 0 END) as spm_count,
    SUM(IFNULL(rfid_masters.spm, 0) * CASE WHEN price_masters.code = "spm" THEN price_masters.price ELSE 0 END) as spm,
    SUM(IFNULL(rfid_masters.sim, 0) * CASE WHEN price_masters.code = "sim" THEN 1 ELSE 0 END) as sim_count,
    SUM(IFNULL(rfid_masters.sim, 0) * CASE WHEN price_masters.code = "sim" THEN price_masters.price ELSE 0 END) as sim,
    SUM(IFNULL(rfid_masters.curd, 0) * CASE WHEN price_masters.code = "curd" THEN 1 ELSE 0 END) as curd_count,
    SUM(IFNULL(rfid_masters.curd, 0) * CASE WHEN price_masters.code = "curd" THEN price_masters.price ELSE 0 END) as curd')
    ->leftJoin('price_masters', function ($join) {
        $join->on('rfid_masters.day', '>=', 'price_masters.start_date')
            ->on('rfid_masters.day', '<=', 'price_masters.end_date');
    });
    $start_date = Carbon::parse(request()->from_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->to_date)->toDateTimeString();
    if ($request->has('from_date') && $request->from_date != null )
        {
            $query->whereDate('rfid_masters.day', '>=', $start_date);
        }

        if ($request->has('to_date') && $request->to_date != null )
        {
            $query->whereDate('rfid_masters.day', '<=', $end_date);
        }

        if ($request->has('emp_id') && $request->emp_id != 'All' && $request->emp_id != null)
        {
            $query->where('rfid_masters.emp_id',  $request->emp_id);
        }


    $records = $query->groupBy('rfid_masters.name', 'rfid_masters.emp_id')->get();


    return view('users.canteen.detailallreports',compact('records','users'));
        // return $records;
    }

    public function livecount()
    {
        $datas = DB::connection('second_mysql')
                ->table('rfid_masters')
                ->selectRaw('
                    day,
                    SUM(IFNULL(spm, 0)) as total_spm,
                    SUM(IFNULL(sim, 0)) as total_sim,
                    SUM(IFNULL(curd, 0)) as total_curd,
                    SUM(IF(status != 1, IFNULL(spm, 0), 0)) as remaining_spm,
                    SUM(IF(status != 1, IFNULL(sim, 0), 0)) as remaining_sim,
                    SUM(IF(status != 1, IFNULL(curd, 0), 0)) as remaining_curd,
                    SUM(IF(status != 0, IFNULL(spm, 0), 0)) as delivered_spm,
                    SUM(IF(status != 0, IFNULL(sim, 0), 0)) as delivered_sim,
                    SUM(IF(status != 0, IFNULL(curd, 0), 0)) as delivered_curd
                ')
                ->groupBy('day')
                ->get();
        
        // return $data;
                return view('users.canteen.livecount',compact('datas'));
    }
}
