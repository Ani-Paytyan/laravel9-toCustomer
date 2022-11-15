<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Event;
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
        $syncCommands = [
            $schedule->command('sync:companies'),
            $schedule->command('sync:workplaces'),
            $schedule->command('sync:contacts'),
            $schedule->command('sync:items'),
            $schedule->command('sync:unique-items'),
            $schedule->command('sync:unique-item-status')
        ];

        foreach ($syncCommands as $command) {
            /** @var Event $command */
            if (config('app.sync_testing')) {
                $command->everyMinute();
            } else {
                $command->everyFifteenMinutes();
            }
        }

        // $schedule->command('inspire')->hourly();

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
