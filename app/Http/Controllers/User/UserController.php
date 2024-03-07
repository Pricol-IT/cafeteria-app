<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use App\Models\CancelBooking;
use App\Models\RfidMaster;
use App\Models\Delivery;
use App\Models\SiMenu;
use Carbon\Carbon;
use DateTime;
use App\Models\MenuSelection;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\OldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WeeklyMenuCreatedNotification;
use App\Notifications\MonthlyMenuCreatedNotification;
use App\Notifications\MenuDeleteNotification;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.user.dashboard');
    }

    public function monthly()
    {
        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonthNoOverflow()->month;
        // return $nextMonth;
        $monthlys = Token::select('id','emp_id','monthly_spm','monthly_sim','monthly_curd','monthly','monthly_days','autovalue')->where('emp_id',(auth()->user()->id))
        ->where(function ($query) use ($currentMonth, $nextMonth) {
            $query->whereMonth('monthly', $currentMonth)
            ->orWhereMonth('monthly', $nextMonth);
        })
        ->orderBy('monthly','asc')
        ->get();

        // return $monthlys;
                                
        return view('users.user.monthly.index',compact('monthlys'));
    }

    public function menu()
    {
        $currentDate = Carbon::today();
        $tomorrowDate = Carbon::tomorrow();
        $si_menus = SiMenu::where('day','>=',$currentDate)->where('day','<=',$tomorrowDate)->get();
        $masters = MenuSelection::where('day','>=',$currentDate)->where('day','<=',$tomorrowDate)->get();

        return view('users.user.menu',compact('si_menus','masters'));
    }

    public function monthlycreate()
    {
        return view('users.user.monthly.create');
    }

    public function monthlyStore(Request $request)
    {
        $input = $request->validate(['monthly' => 'required']);


        $monthly = $request->monthly.'-01';

        $currentMonth = Carbon::now()->format('Y-m');
        if ($request->monthly === $currentMonth) {
            toastr()->error('Cannot add Booking for the current month');
            return back();
        }
        else
        {
            $startDate = Carbon::parse($request->monthly)->startOfMonth();
            $endDate = Carbon::parse($request->monthly)->endOfMonth();

            $monthlyDays = [];

            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                if (!$date->isWeekend()) {
                    $monthlyDays[] = $date->format('d-m-Y');
                }
            }

             // return $monthlyDays;
            if((!$request->monthly_sim) && (!$request->monthly_curd))
            {
                toastr()->error('Select Atleast One Menu');
                return back();
            }
            else
            {
                $emp_id = auth()->user()->id;
                $month = Token::where('emp_id',$emp_id)->where('monthly','=', $monthly)->exists();
                if(!$month)
                {
                    
                    $v = json_encode($monthlyDays);
                    $monthdelete = Token::where('emp_id',$emp_id)->whereDate('day','>=', $monthly)->get();
                    if($monthdelete)
                    {
                        foreach ($monthdelete as $token) {
                            $token->delete();
                        }
                    }
                    
                       Token::Create([
                        'emp_id' => $emp_id,
                        'monthly_sim' => $request->monthly_sim,
                        'monthly_curd' => $request->monthly_curd,
                        'monthly' => $monthly,
                        'monthly_days' =>$v,
                    ]);
                    auth()->user()->notify(new MonthlyMenuCreatedNotification());
                    toastr()->success('Monthly Request Added Successfully');
                    return redirect()->route('user.monthly');
                }
                else
                {
                    toastr()->error('Record Already Exists');
                    return back();
                }
                
            }
            
        }
        
        
    }

    public function weekly()
    {
        

        $currentDateTime = Carbon::now('Asia/Kolkata');
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');
        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonthNoOverflow()->month;
        $nextDay = $currentDateTime->addDay()->format('Y-m-d');    
        // return $nextMonth;
        // $masters = MenuSelection::with('menu')
        // ->where(function ($query) use ($currentDate, $currentTime) {
        //     // Check if current date exists in the menu selections
        //     $query->where('day', '>', $currentDate);
        //     // If the current date exists and the time has not crossed 10:00:00, include it
        //     $query->orWhere(function ($query) use ($currentDate, $currentTime) {
        //         $query->where('day', '=', $currentDate)
        //             ->where(DB::raw('CONCAT(day, " ", "10:00:00")'), '>', $currentDate . ' ' . $currentTime);
        //     });
        // })
        // ->orderBy('day', 'asc')
        // ->limit(5)
        // ->get();

        $masters = MenuSelection::with('menu')
    ->where(function ($query) use ($currentDate, $nextDay, $currentTime) {
        // Exclude the current date and time after 19:00:00
        $query->where(function ($query) use ($currentDate, $nextDay, $currentTime) {
            $query->where('day', '>', $nextDay)
                ->orWhere(function ($query) use ($currentDate, $nextDay, $currentTime) {
                    $query->where('day', '=', $nextDay)
                        ->where(DB::raw('CONCAT(day, " ", "19:00:00")'), '>', $nextDay . ' ' . $currentTime);
                });
        });
    })
    ->orderBy('day', 'asc')
    ->limit(6) // Include the current date and the next 5 upcoming dates
    ->get();
    


        $check_day = Token::select('id','emp_id','day','spm','sim','curd')->where('emp_id',(auth()->user()->id))->where('day', '>=', $currentDate)->get();
        $check = Token::select('id', 'emp_id', 'monthly_sim', 'monthly_curd', 'monthly', 'monthly_days')
            ->where('emp_id', auth()->user()->id)
            ->where(function ($query) use ($currentMonth, $nextMonth) {
            $query->whereMonth('monthly', $currentMonth)
            ->orWhereMonth('monthly', $nextMonth);
            })
            ->get(); // Assuming there is only one monthly entry per user per month

        $existArray = [];
        $notExistArray = [];

        if ($check) {
            foreach($check as $che)
            {


            $monthlyDays = json_decode($che->monthly_days, true);

            foreach ($masters as $master) {
                $dayToCheck = date('d-m-Y',strtotime($master->day));

                if (in_array($dayToCheck, $monthlyDays)) {
                    $existArray[] = $dayToCheck;
                } else {
                    $notExistArray[] = $dayToCheck;
                }
            }
            }
        }

        // return $notExistArray;
        
        return view('users.user.weekly.create',compact('masters','check','check_day','existArray','notExistArray'));
    }

    public function weeklyStore(Request $request)
    {
        
        $emp_id = auth()->user()->id;
        $singleArray = [];
        foreach ($request['day'] as $index => $day) {
            $singleArray[$index] = [
                "emp_id" => $emp_id,
                "day" => $day,
                "spm" => ($request['sp'] != '' && in_array($day, $request['sp'])) ? 1 : null,
                "sim" => ($request['si'] != '' && in_array($day, $request['si'])) ? 1 : null,
                "curd" => ($request['curd'] != '' && in_array($day, $request['curd'])) ? 1 : null                
            ];
        }
        $singleArray = array_filter($singleArray, function ($item) {
            return $item['sim'] !== null || $item['spm'] !== null || $item['curd'] !== null;
        });
        $weeklyFirstDB = $this->insertIntoDatabase('mysql', $singleArray);

        if ($weeklyFirstDB) {
            auth()->user()->notify(new WeeklyMenuCreatedNotification());
            toastr()->success('Weekly Menu Created Successfully');
            return redirect()->route('user.weekly');
        } else {
            toastr()->error('Something Went Wrong. Please Try Again');
            return back();
        }

    }

    public function checkdate(Request $request)
    {
        $menu = MenuSelection::where('day',$request->day)->exists();
        return $menu;
    }

    public function transactionHistory()
    {
        $currentDate = Carbon::now();

// Get the first day of the previous month
// $previousMonthStart = $currentDate->copy()->subMonth()->startOfMonth();
        $previousMonthStart = $currentDate->copy()->subMonthNoOverflow()->setDay(1);

// Get the last day of the next month
$nextMonthEnd = $currentDate->copy()->addMonth()->endOfMonth();

// return $nextMonthEnd;
    

        $monthlyEntries = Token::select('id','emp_id','monthly','monthly_curd','monthly_sim','monthly_spm','monthly_days')->where('emp_id',(auth()->user()->id))->where('monthly','>=', $previousMonthStart)->where('monthly','<=', $nextMonthEnd)->get();

        $weeklyEntries = Token::select('id','emp_id','day','spm','sim','curd')->where('emp_id',(auth()->user()->id))->whereMonth('day', '>=',$previousMonthStart)->get();

        $deliverys =Delivery::where('emp_id',(auth()->user()->id))->whereMonth('day','>=',$previousMonthStart)->get();
// return $weeklyEntries;
        $combinedRecords = [];
        $singles = [];

        foreach ($monthlyEntries as $monthlyEntry) {
            foreach (json_decode($monthlyEntry->monthly_days) as $weekday) {
                $combinedRecords[date('Y-m-d',strtotime($weekday))]['day'] = date('Y-m-d',strtotime($weekday));
                $combinedRecords[date('Y-m-d',strtotime($weekday))]['spm'] = $monthlyEntry->monthly_spm ?? 0;
                $combinedRecords[date('Y-m-d',strtotime($weekday))]['sim'] = $monthlyEntry->monthly_sim ?? 0;
                $combinedRecords[date('Y-m-d',strtotime($weekday))]['curd'] = $monthlyEntry->monthly_curd ?? 0;
            }
        }

        foreach ($weeklyEntries as $weeklyEntry) {
            $combinedRecords[$weeklyEntry->day]['day'] = $weeklyEntry->day;
            $combinedRecords[$weeklyEntry->day]['spm'] = ($combinedRecords[$weeklyEntry->day]['spm'] ?? 0) + ($weeklyEntry->spm ?? 0);
            $combinedRecords[$weeklyEntry->day]['sim'] = ($combinedRecords[$weeklyEntry->day]['sim'] ?? 0) + ($weeklyEntry->sim ?? 0);
            $combinedRecords[$weeklyEntry->day]['curd'] = ($combinedRecords[$weeklyEntry->day]['curd'] ?? 0) + ($weeklyEntry->curd ?? 0);
        }

        $i=0;
        foreach($combinedRecords as $key => $array)
        {
            $singles[$i] = $array;
            $i++;
        }
        // return $singles;
        return view('users.user.transaction',compact('singles','deliverys'));

        // return $singles;
        // Now $combinedRecords contains the desired array format
            // $result = array_values(array_map(function ($empRecords) {
            //     return array_values($empRecords);
            // }, $combinedRecords));

            // $monthlyEntries = Token::select('id', 'emp_id', 'monthly', 'monthly_curd', 'monthly_sim', 'monthly_days')
            //         ->where('emp_id', auth()->user()->id)
            //         ->whereMonth('monthly', Carbon::now()->month)
            //         ->get();

            //     $weeklyEntries = Token::select('id', 'emp_id', 'day', 'spm', 'sim', 'curd')
            //         ->where('emp_id', auth()->user()->id)
            //         ->whereMonth('day', Carbon::now()->month)
            //         ->get();

            //     $deliverys = Delivery::where('emp_id', auth()->user()->id)
            //         ->whereMonth('day', Carbon::now()->month)
            //         ->get();

            //     $combinedRecords = [];

            //     foreach ($monthlyEntries as $monthlyEntry) {
            //         foreach (json_decode($monthlyEntry->monthly_days) as $weekday) {
            //             $combinedRecords[$weekday] = [
            //                 'day'  => $weekday,
            //                 'spm'  => 0,
            //                 'sim'  => $monthlyEntry->monthly_sim ?? 0,
            //                 'curd' => $monthlyEntry->monthly_curd ?? 0,
            //             ];
            //         }
            //     }

            //     foreach ($weeklyEntries as $weeklyEntry) {
            //         if (!isset($combinedRecords[$weeklyEntry->day])) {
            //             $combinedRecords[$weeklyEntry->day] = [
            //                 'day'  => $weeklyEntry->day,
            //                 'spm'  => 0,
            //                 'sim'  => 0,
            //                 'curd' => 0,
            //             ];
            //         }

            //         $combinedRecords[$weeklyEntry->day]['spm'] += $weeklyEntry->spm ?? 0;
            //         $combinedRecords[$weeklyEntry->day]['sim'] += $weeklyEntry->sim ?? 0;
            //         $combinedRecords[$weeklyEntry->day]['curd'] += $weeklyEntry->curd ?? 0;
            //     }

            //     $singles = array_values($combinedRecords);

                // return view('users.user.transaction', compact('singles', 'deliverys'));

        // return $singles;
    }


    public function removeMonthlyDay($id,Request $request)
    {
        $token = Token::findOrFail($id);
        $user = auth()->user();
        $monthlyDays = json_decode($token->monthly_days);
        $removedDate = $request->date;
        $rday = date('Y-m-d',strtotime($removedDate));
        
        $menuType = 'Monthly Menu'; // Assuming you are sending the date as a parameter

        // Remove the date from the array
        $updatedMonthlyDays = array_values(array_filter($monthlyDays, function ($date) use ($removedDate) {
            return $date !== $removedDate;
        }));

        $cancel = $user->cancelbooking()->create([
                'canceldate' => $rday,
                'menu_type' => $menuType
            ]);
        // return $updatedMonthlyDays;
        // Update the token record with the new monthly_days array
        $token->update(['monthly_days' => json_encode($updatedMonthlyDays)]);
        auth()->user()->notify(new MenuDeleteNotification($menuType,$removedDate));

        toastr()->success($removedDate.' Menu Removed Successfully');
            return back();
    }


    public function weeklyIndex()
    {
        $date = date('Y-m-d');
        $weeklys = Token::select('id','emp_id','day','sim','curd','spm')->where('emp_id',(auth()->user()->id))->where('day','>=',$date)->where('day','!=',null)->get();

        return view('users.user.weekly.index',compact('weeklys'));
    }

    public function weeklyRemove($id)
    {
        $weekly  = Token::find($id);

        if($weekly)
        {
            $user = auth()->user();
            $menuType = 'Weekly Menu';
            $canceldate = date('Y-m-d',strtotime($weekly->day));
            $cancel = $user->cancelbooking()->create([
                'canceldate' => $weekly->day,
                'menu_type' => $menuType
            ]);
             
            if($cancel)
            {

                $weekly->delete();
                auth()->user()->notify(new MenuDeleteNotification($menuType,$canceldate));
                toastr()->success('Weekly Menu Removed Successfully');
            }
            
            return back();
        }
        else{
            toastr()->danger('Something Went Wrong Please Try Again!');
            return back();
        }
    }

    protected function insertIntoDatabase($connection, $data)
    {
        try {
            // Use the specified database connection
            DB::connection($connection)->beginTransaction();

            foreach ($data as $week) {
                Token::on($connection)->create($week);
            }

            DB::connection($connection)->commit();
            return true;
        } catch (\Exception $e) {
            // Handle the exception if something goes wrong
            DB::connection($connection)->rollBack();
            return false;
        }
    }

    public function userReport(Request $request)
    {
        // $query = RfidMaster::select('day','spm','sim','curd','status')->where('user_id',auth()->user()->id)->orderBy('day','desc')->get();
        // return $query;
        $query = RfidMaster::selectRaw('rfid_masters.day,rfid_masters.status,
        SUM(IFNULL(rfid_masters.spm, 0) * CASE WHEN price_masters.code = "spm" THEN 1 ELSE 0 END) as spm_count,
        SUM(IFNULL(rfid_masters.spm, 0) * CASE WHEN price_masters.code = "spm" THEN price_masters.price ELSE 0 END) as spm,
        SUM(IFNULL(rfid_masters.sim, 0) * CASE WHEN price_masters.code = "sim" THEN 1 ELSE 0 END) as sim_count,
        SUM(IFNULL(rfid_masters.sim, 0) * CASE WHEN price_masters.code = "sim" THEN price_masters.price ELSE 0 END) as sim,
        SUM(IFNULL(rfid_masters.curd, 0) * CASE WHEN price_masters.code = "curd" THEN 1 ELSE 0 END) as curd_count,
        SUM(IFNULL(rfid_masters.curd, 0) * CASE WHEN price_masters.code = "curd" THEN price_masters.price ELSE 0 END) as curd')
        ->leftJoin('price_masters', function ($join) {
            $join->on('rfid_masters.day', '>=', 'price_masters.start_date')
                ->on('rfid_masters.day', '<=', 'price_masters.end_date');
        })->where('rfid_masters.user_id',auth()->user()->id);
        
        $start_date = Carbon::parse(request()->from_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->to_date)->toDateTimeString();
        

        if ($request->has('from_date') && $request->from_date != null )
        {
            // $query->whereBetween('from_date', [$start_date, $end_date]);
            $query->whereDate('rfid_masters.day', '>=', $start_date);
        }

        if ($request->has('to_date') && $request->to_date != null )
        {
            // $query->whereBetween('to_date', [$start_date, $end_date]);
            $query->whereDate('rfid_masters.day', '<=', $end_date);
        }
        if ($request->has('status') && $request->status != null )
        {
            // $query->whereBetween('to_date', [$start_date, $end_date]);
            $query->where('rfid_masters.status', $request->status);
        }
        $reports = $query->groupBy('rfid_masters.day','rfid_masters.status')->get();
        
        // return $reports;
        return view('users.user.reports',compact('reports'));
    }

    public function userProfile()
    {
        $user = auth()->user();
        return view('users.user.profile',compact('user'));
        // return $user;
    }

    public function passwordreset(Request $request)
    {

      $pass =  Validator::make($request->all(), [
        'old_password' => ['required', new OldPassword],
        'password' => ['required', 'different:old_password', 'confirmed'],
        ]);

      if ($pass->fails()) {
        return redirect()->back()->withErrors($pass)->withInput();
            }

        $user = Auth::user();
        $updated = $user->update([
        'password' => Hash::make($request->input('password')),
        ]);

        if($updated)
        {
            toastr()->success('Password Reset Successfully');
            return redirect()->route('user.transaction');
        }
        else{
            toastr()->error('Something Went Wrong');
            return back();
        }
    }

    public function password()
    {
        return view('users.password');
    }

    public function markAsRead()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(true);
    }
}
