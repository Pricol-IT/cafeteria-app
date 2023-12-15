<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use App\Models\Delivery;
use Carbon\Carbon;
use DateTime;
use App\Models\MenuSelection;
use DB;

use Illuminate\Support\Facades\Schema;

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
        
        $monthlys = Token::select('id','emp_id','monthly_sim','monthly_curd','monthly','monthly_days')->where('emp_id',(auth()->user()->id))->whereMonth('monthly', Carbon::now()->month)->get();
        return view('users.user.monthly.index',compact('monthlys'));
    }

    public function monthlycreate()
    {
        return view('users.user.monthly.create');
    }

    public function monthlyStore(Request $request)
    {
        $input = $request->validate(['monthly' => 'required']);
        // $monthly = date('m',strtotime($request->monthly));
        $monthly = $request->monthly.'-01';
        
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
            $month = Token::where('monthly','=', $monthly)->exists();
            if(!$month)
            {
                
                $v = json_encode($monthlyDays);
                

                   Token::Create([
                    'emp_id' => $emp_id,
                    'monthly_sim' => $request->monthly_sim,
                    'monthly_curd' => $request->monthly_curd,
                    'monthly' => $monthly,
                    'monthly_days' =>$v,
                ]);
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

    public function weekly()
    {
        // $masters = MenuSelection::with('menu')->take(5)->orderBy('day','asc')->get();

        $currentDateTime = Carbon::now('Asia/Kolkata');
        $currentDate = $currentDateTime->format('Y-m-d');
        $currentTime = $currentDateTime->format('H:i:s');

        $masters = MenuSelection::with('menu')
        ->where(function ($query) use ($currentDate, $currentTime) {
            // Check if current date exists in the menu selections
            $query->where('day', '>', $currentDate);
            // If the current date exists and the time has not crossed 10:00:00, include it
            $query->orWhere(function ($query) use ($currentDate, $currentTime) {
                $query->where('day', '=', $currentDate)
                    ->where(DB::raw('CONCAT(day, " ", "10:00:00")'), '>', $currentDate . ' ' . $currentTime);
            });
        })
        ->orderBy('day', 'asc')
        ->limit(5)
        ->get();
        // return $masters;
        // $masters = MenuSelection::with('menu')
        //     ->where('day', '>=', $currentDateTime->format('Y-m-d'))
        //     ->orderBy('day', 'asc')
        //     ->take(5)
        //     ->get();
        $check_day = Token::select('id','emp_id','day','spm','sim','curd')->where('emp_id',(auth()->user()->id))->where('day', '>=', $currentDate)->whereMonth('day', Carbon::now()->month)->get();
        $check = Token::select('id', 'emp_id', 'monthly_sim', 'monthly_curd', 'monthly', 'monthly_days')
            ->where('emp_id', auth()->user()->id)
            ->whereMonth('monthly', Carbon::now()->month)
            ->first(); // Assuming there is only one monthly entry per user per month

        $existArray = [];
        $notExistArray = [];

        if ($check) {
            $monthlyDays = json_decode($check->monthly_days, true);

            foreach ($masters as $master) {
                $dayToCheck = date('d-m-Y',strtotime($master->day));

                if (in_array($dayToCheck, $monthlyDays)) {
                    $existArray[] = $dayToCheck;
                } else {
                    $notExistArray[] = $dayToCheck;
                }
            }
        }

        // if($check_day)
        // {
        //     foreach($check_day as $che)
        //     {
        //         $day[] = date('d-m-Y',strtotime($che->day));
        //     }
        //     foreach ($masters as $master) {
        //         $dayToCheck = date('d-m-Y',strtotime($master->day));

        //         if (in_array($dayToCheck, $day)) {
        //             $existArray[] = $dayToCheck;
        //         } else {
        //             $notExistArray[] = $dayToCheck;
        //         }
        //     }
        // }
        // $check = Token::select('id','emp_id','monthly_sim','monthly_curd','monthly','monthly_days')->where('emp_id',(auth()->user()->id))->whereMonth('monthly', Carbon::now()->month)->get();
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
                // $request['sp'] != '' ? ("spm" => in_array($day, $request['sp']) ? 1 : null ) : "spm" =>null,
                // $request['si'] != '' ? ("sim" => in_array($day, $request['si']) ? 1 : null ) : "sim" => null,
                // $request['curd'] != '' ? ("curd" => in_array($day, $request['curd']) ? 1 : null ) : "curd" => null
                
            ];
        }
        $singleArray = array_filter($singleArray, function ($item) {
            return $item['sim'] !== null || $item['spm'] !== null || $item['curd'] !== null;
        });
        
        // $weekly = Token::create($singleArray);
         foreach($singleArray as $week)
         {
             $weekly = Token::create($week);
         }
        
        if($weekly)
        {
            toastr()->success('Weekly Menu Created Successfully');
            return redirect()->route('user.weekly');
        }
        else
        {
            toastr()->error('Something Went Wrong Please Try Again');
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

        $monthlyEntries = Token::select('id','emp_id','monthly','monthly_curd','monthly_sim','monthly_days')->where('emp_id',(auth()->user()->id))->whereMonth('monthly', Carbon::now()->month)->get();

        $weeklyEntries = Token::select('id','emp_id','day','spm','sim','curd')->where('emp_id',(auth()->user()->id))->whereMonth('day', Carbon::now()->month)->get();

        $deliverys =Delivery::where('emp_id',(auth()->user()->id))->whereMonth('day', Carbon::now()->month)->get();

        $combinedRecords = [];

        foreach ($monthlyEntries as $monthlyEntry) {
            foreach (json_decode($monthlyEntry->monthly_days) as $weekday) {
                $combinedRecords[date('Y-m-d',strtotime($weekday))]['day'] = date('Y-m-d',strtotime($weekday));
                $combinedRecords[date('Y-m-d',strtotime($weekday))]['spm'] = 0;
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

    // Now $combinedRecords contains the desired array format
        // $result = array_values(array_map(function ($empRecords) {
        //     return array_values($empRecords);
        // }, $combinedRecords));
        $i=0;
        foreach($combinedRecords as $key => $array)
        {
            $singles[$i] = $array;
            $i++;
        }

        return view('users.user.transaction',compact('singles','deliverys'));
    // return $singles;
    }


    public function removeMonthlyDay($id,Request $request)
    {
        $token = Token::findOrFail($id);

        $monthlyDays = json_decode($token->monthly_days);
        $removedDate = $request->date; // Assuming you are sending the date as a parameter

        // Remove the date from the array
        $updatedMonthlyDays = array_values(array_filter($monthlyDays, function ($date) use ($removedDate) {
            return $date !== $removedDate;
        }));
        // return $updatedMonthlyDays;
        // Update the token record with the new monthly_days array
        $token->update(['monthly_days' => json_encode($updatedMonthlyDays)]);

        toastr()->success($removedDate.' Menu Removed Successfully');
            return back();
    }


}
