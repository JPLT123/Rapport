<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\RappelEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReportReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily report reminders.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('status','activer')->get(); // Obtenez tous les utilisateurs (vous pouvez ajuster cette logique selon vos besoins)

        foreach ($users as $user) {
            $message = "Rappel du rapport journalier : Bonjour ".$user->name.", C'est l'heure de soumettre votre rapport quotidien. N'oubliez pas de partager vos réalisations et progrès du jour. Merci pour votre contribution !";
            Mail::to($user->email)->send(new RappelEmail($message, $user->name));
        }        

        $this->info('Daily report reminders have been sent.');
    }
}
