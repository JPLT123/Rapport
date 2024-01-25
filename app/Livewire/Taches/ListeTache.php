<?php

namespace App\Livewire\Taches;

use App\Models\Tach;
use App\Models\Projet;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\DB;

class ListeTache extends Component
{
    #[Url]
    public $projet;
    public $totalTasksByMonth;
    public $completedTasksByMonth;
    public $totalTasksByDay;
    public $tache = [];

    public function render()
    {
        $taches = Tach::where('status','!=','Supprimer')->get();

        if ($this->projet) {
            $taches->where('id_projet', $this->projet);
        }

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

    public function deleteCompletedTasks()
    {
        $allTaskIds = collect($this->tache)->pluck('id')->toArray();


        // Supprimez les tâches correspondantes de la base de données
        $updateResult = Tach::whereIn('id', $allTaskIds)->update([
            'status' => 'Supprimer'
        ]);        

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  

        // // Rafraîchissez la liste des tâches
        // $this->tache = Tach::all()->toArray();

        // Vous pouvez également ajouter un message de succès ou de confirmation ici
    }

}
