<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use App\Models\RfidMaster;
use DB;
use Carbon\Carbon;
use App\Models\Delivery;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::orderBy('id','desc')->get();

        return view('admin.user.index',compact('users'));
    }

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
        return view('admin.reports',compact('combinedData'));
    }

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
         return view('admin.detailreports',compact('records','users'));
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


        return view('admin.detailallreports',compact('records','users'));
        // return $records;
    }
}
