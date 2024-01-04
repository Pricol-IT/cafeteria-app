<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\RfidMaster;

class SyncRFIDData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:rfid-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync RFID data from second server to first server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $secondServerData = DB::connection('second_mysql')->table('rfid_masters')->where('status', 1)->get();

        // Insert data into the first server
        foreach ($secondServerData as $data) {
            DB::table('deliveries')->insert([
                'emp_id'      => $data->user_id,
                'day'         => $data->day,
                'spm'         => $data->spm,
                'sim'         => $data->sim,
                'curd'        => $data->curd,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::connection('mysql')
                ->table('rfid_masters')
                ->where('day', $data->day)
                ->where('emp_id', $data->emp_id)
                ->update(['status' => 1]);
        }

        $this->info('RFID data synced successfully!');
    }
}
