<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\NextRound::class,
        Commands\AssignBrokers::class,
        Commands\AssignAdmin::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $day = date('D');

        if ($day != 'Fri') {        
            $schedule->command('next_round:cron')->everyMinute();
                        // ->timezone('Asia/Riyadh')
                        // ->between('9:00', '18:00');
                        
            $schedule->command('assign_brokers:cron')->everyMinute();
                        // ->timezone('Asia/Riyadh')
                        // ->between('9:00', '18:00');

            // $schedule->command('assign_admin:cron')->everyMinute();
                        // ->timezone('Asia/Riyadh')
                        // ->between('9:00', '18:00');
        }

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
