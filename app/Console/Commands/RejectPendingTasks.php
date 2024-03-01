<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\TacheSupplementaire;

class RejectPendingTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:reject-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reject pending tasks if they are waiting for more than a week.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateLimite = Carbon::now()->subWeek(); // Date limite : une semaine avant maintenant
    
        TacheSupplementaire::where('status', 'attente')
            ->where('date', '<=', $dateLimite)
            ->update(['status' => 'rejeter']);
    
        $this->info('Opérations effectuées avec succès.');
    }
    
}
