<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\WeeklyPlanningReminder;
use Illuminate\Support\Facades\Mail;

class SendWeeklyPlanningReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:weekly-planning-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly planning reminders.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('status','activer')->get(); // Obtenez tous les utilisateurs (vous pouvez ajuster cette logique selon vos besoins)

        foreach ($users as $user) {
            $message = "Bonjour $user->name,\n\nC'est l'heure de planifier votre semaine. Assurez-vous de passer en revue vos objectifs et tâches pour la semaine à venir. N'oubliez pas de mettre à jour votre planification hebdomadaire. Merci et bonne semaine !";
            Mail::to($user->email)->send(new WeeklyPlanningReminder($message, $user->name));
        }

        $this->info('Weekly planning reminders have been sent.');
    }
}
