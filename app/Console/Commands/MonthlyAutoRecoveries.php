<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Token;
use App\Models\AutoRecovery;

class MonthlyAutoRecoveries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:auto-recoveries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process monthly auto-recoveries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        

        $this->processAutoRecoveries();
        
    }

    private function processAutoRecoveries()
    {
        // Get all records from the autorecoveries table
        

        $currentDate = Carbon::now();

// Get the next month's date
        $nextMonthDate = $currentDate->addMonth()->startOfMonth();
        $monv =$nextMonthDate;

        $startDate = $nextMonthDate->copy();
        $endDate = $nextMonthDate->copy()->endOfMonth();

        $monthlyDays = [];



        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            if (!$date->isWeekend()) {
                $monthlyDays[] = $date->format('d-m-Y');
            }
        }

        $v = json_encode($monthlyDays);
        $autoRecoveries = AutoRecovery::where('status',1)->get();
        foreach ($autoRecoveries as $autoRecovery) {
            // Insert records into the token table
            $this->insertTokenRecord($autoRecovery,$v,$monv);
        }

        $this->info('Monthly auto-recoveries processed successfully.');
    }

    private function insertTokenRecord(AutoRecovery $autoRecovery,$v,$monv)
    {
        // Perform the logic to insert records into the token table


        

        Token::create([
            'emp_id' => $autoRecovery->user_id,
            'monthly_sim' => $autoRecovery->monthly_sim,
            'monthly_spm' => $autoRecovery->monthly_spm,
            'monthly_curd' => $autoRecovery->monthly_curd,
            'monthly' => $monv,
            'monthly_days' => $v,
            'autovalue' => 1,
        ]);
    }
}
