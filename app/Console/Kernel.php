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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Logique pour récupérer les utilisateurs à rappeler et envoyer l'e-mail
            $usersToRemind = User::where('status','activer')->get();
    
            foreach ($usersToRemind as $user) {
                Mail::to($user->email)->send(new RappelEmail('N\'oubliez pas votre rapport de la journee !'));
            }
        })->dailyAt('16:30');
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
