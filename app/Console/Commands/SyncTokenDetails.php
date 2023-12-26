<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\RfidMaster;

class SyncTokenDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:token-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync token details between two servers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->syncTokenDetails();
        // $this->updateDeliveriesTable();
    }

    private function syncTokenDetails()
    {
        $currentDate = Carbon::now()->toDateString();
        $formattedDates = Carbon::now()->format('d-m-Y');

        // Connect to the first server database
        $resultsFirstServer = DB::connection('mysql')->table('tokens')
            ->select('tokens.day', 'users.id', 'tokens.emp_id', 'users.emp_id', 'users.rfid', 'users.name')
            ->selectRaw('SUM(IFNULL(tokens.spm, 0)) as spm')
            ->selectRaw('SUM(IFNULL(tokens.sim, 0) + IFNULL(tokens.monthly_sim, 0)) as sim')
            ->selectRaw('SUM(IFNULL(tokens.curd, 0) + IFNULL(tokens.monthly_curd, 0)) as curd')
            ->where(function ($query) use ($currentDate, $formattedDates) {
                $query->orWhereDate('day', $currentDate)
                    ->orWhereRaw("monthly_days REGEXP ?", ['\\b' . $formattedDates . '\\b']);
            })
            ->groupBy('tokens.emp_id', 'users.emp_id', 'users.id', 'users.name', 'users.rfid', 'tokens.day')
            ->join('users', 'tokens.emp_id', '=', 'users.id')
            ->get();

        
            $weeklyFirstDB = $this->insertIntoDatabase('mysql', $resultsFirstServer);
            $weeklySecondDB = $this->insertIntoDatabase('second_mysql', $resultsFirstServer);
        
    }

    // private function updateDeliveriesTable()
    // {
    //     // Assuming deliveries table structure is similar to the tokens table
    //     $currentDate = Carbon::now()->toDateString();

    //     // Get data from the rfid_masters table in the first server database
    //     $rfidMastersData = DB::connection('second_mysql')->table('rfid_masters')
    //         // Add your select and where clauses as needed
    //         ->get();

    //     // Insert into the deliveries table in the first server database
    //     DB::table('deliveries')->insert($rfidMastersData->toArray());
    // }

    protected function insertIntoDatabase($connection, $data)
    {
        try {
            // Use the specified database connection
            DB::connection($connection)->beginTransaction();
            DB::connection('second_mysql')->table('rfid_masters')->truncate();
            foreach ($data as $week) {

                RfidMaster::on($connection)->create([
                    'day' =>$week->day,
                    'user_id' =>$week->id,
                    'emp_id' =>$week->emp_id,
                    'rfid' =>$week->rfid,
                    'name' =>$week->name,
                    'spm' =>$week->spm,
                    'sim' =>$week->sim,
                    'curd' =>$week->curd,
                ]);
            }

            DB::connection($connection)->commit();
            return true;
        } catch (\Exception $e) {
            // Handle the exception if something goes wrong
            DB::connection($connection)->rollBack();
            return false;
        }
    }
}
