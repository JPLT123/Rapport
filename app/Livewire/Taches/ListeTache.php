<?php

namespace App\Livewire\Taches;

use App\Models\Tach;
use App\Models\Projet;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ListeTache extends Component
{
    #[Url]
    public $projet;
    public $totalTasksByMonth;
    public $completedTasksByMonth;
    public $totalTasksByDay;
    public $tache_prevues;
    public $tache = [];

    public function render()
    {
        $recuper = Tach::where('status','!=','Supprimer');

        if ($this->projet) {
            $recuper->where('id_projet', $this->projet);
        }

        $taches = $recuper->get();

        $projets = Projet::where("status",'!=','supprimer')->get();

        $this->totalTasksByMonth = Tach::selectRaw("MONTH(created_at) as month, COUNT(*) as total_tasks")
            ->groupByRaw("MONTH(created_at)")
            ->get();

             // Pour récupérer le nombre total de tâches par jour
        $this->totalTasksByDay = DB::table('taches')
        ->selectRaw("DATE(created_at) as day, COUNT(*) as total_tasks")
        ->groupByRaw("DATE(created_at)")
        ->get();

        $completedTasksByDay = DB::table('taches')
            ->where('status', 'Terminer')
            ->selectRaw("DATE(created_at) as day, COUNT(*) as completed_tasks")
            ->groupByRaw("DATE(created_at)")
            ->get();

        // Pour récupérer le nombre de tâches terminées par mois
        $this->completedTasksByMonth = Tach::where('status', 'Terminer')
            ->selectRaw("MONTH(created_at) as month, COUNT(*) as completed_tasks")
            ->groupByRaw("MONTH(created_at)")
            ->get();


        return view('livewire.taches.liste-tache',[
            "taches" => $taches,
            "projets" => $projets,
            "completedTasksByDay" => $completedTasksByDay,
        ])->extends('layouts.index')->extends('layouts.guest')->section('content');
    }

    public function update()
    {
        $this->dispatch("show_modal");
    }
    public function closeupdate(){
        $this->dispatch('closeupdate', []);
    }

    public function confirmationDelete($fonctions = null, $message = null)
    {
        $this->dispatch("confirmation",
            fonction: $fonctions ? $fonctions : 'deleteCompletedTasks',
            text: $message ? $message : 'Voulez-vous vraiment supprimer ?',
        );
    }

    #[on('deleteCompletedTasks')]
    public function deleteCompletedTasks()
    {

        // Supprimez les tâches correspondantes de la base de données
        $updateResult = Tach::whereIn('id', $this->tache)->update([
            'status' => 'Supprimer'
        ]);        

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  
    }

    public function CompletedTasks()
    {
        $taches = Tach::whereIn('id', $this->tache)->get();

        // Assurez-vous que la collection n'est pas vide avant d'essayer d'accéder à une propriété
        if (!$taches->isEmpty()) {
            // Si vous souhaitez obtenir un tableau de toutes les valeurs 'tache_prevues'
            $this->tache_prevues = $taches->first()->tache_prevues;

            // Si vous souhaitez obtenir la première valeur 'tache_prevues' de la collection
            // $this->tache_prevues = $taches->first()->tache_prevues;
        } else {
            // Gérer le cas où la collection est vide, si nécessaire
            $this->tache_prevues = [];
        }
        

        $this->update();
    }

    public function UpdateCompletedTasks()
    {

        // Supprimez les tâches correspondantes de la base de données
        $updateResult = Tach::whereIn('id', $this->tache)->update([
            'tache_prevues' => $this->tache_prevues
        ]);        

        $this->closeupdate();
        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  
    }
}
