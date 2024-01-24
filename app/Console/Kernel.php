<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        Commands\SyncTokenDetails::class,
        Commands\SyncRFIDData::class,
        Commands\MonthlyAutoRecoveries::class,
    ];


    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('sync:token-details')->dailyAt('10:05');
        $schedule->command('sync:rfid-data')->dailyAt('15:30');
        $schedule->command('monthly:auto-recoveries')->monthlyOn(25, '00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
