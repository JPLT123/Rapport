<?php

namespace App\Console;

use App\Models\User;
use App\Mail\RappelEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
      
        $schedule->command('reminders:daily')->dailyAt('15:00');

        $schedule->command('reminders:weekly-planning-reminders')
        ->mondays()
        ->at('09:00');

        $schedule->command('tasks:reject-pending')->weekly();
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
