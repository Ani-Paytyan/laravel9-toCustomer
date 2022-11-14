<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('sync:companies')->everyFifteenMinutes();
        $schedule->command('sync:workplaces')->everyFifteenMinutes();
        $schedule->command('sync:contacts')->everyFifteenMinutes();
        $schedule->command('sync:items')->everyFifteenMinutes();
        $schedule->command('sync:unique-items')->everyFifteenMinutes();
        $schedule->command('sync:unique-item-status')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
