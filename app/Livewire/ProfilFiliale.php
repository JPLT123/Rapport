<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Projet;
use App\Models\Filiale;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MembresProjet;

class ProfilFiliale extends Component
{
    use WithPagination; 
    
    public $filiale;
    public $filialeId;
    public $months;
    public $projects;
    public $page;
    public $percentage = []; // Renommé $poucentage en $percentage
    
    public function mount($slug)
    {
        $this->filiale = Filiale::where('slug', $slug)->firstOrFail();
        $this->filialeId =  $this->filiale->id;
    
        // Ne récupérez pas les projets deux fois
        $this->projects = Projet::where('id_filiale', $this->filialeId)->get();
        $this->percentage = [];

        foreach ($this->projects as $project) {
            $totalTasks = $project->taches->count(); // Nombre total de tâches pour le projet
            $completedTasks = $project->taches->where('status', 'Terminer')->count(); // Nombre de tâches terminées

                $this->percentage[$project->id] = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
            }
            // $this->loadMonths();
        }

    public function loadMonths()
    {
        $projects = Projet::where('id_filiale', $this->filialeId)->get();

        $this->months = $projects->pluck('debutdate')->map(function ($date) {
            return Carbon::parse($date)->format('F'); // Format complet du mois
        })->unique();

        $this->data = $projects->groupBy(function ($project) {
            return \Carbon\Carbon::parse($project->date_debut)->format('F');
        })->map->count()->values()->toArray();
    }

    public function render()
    {   
        $this->page = 3;
        $projects = $this->filiale->projets()->paginate($this->page);

        return view('livewire.profil-filiale', [
            "filiales" => $this->filiale,
            "projets" => $projects,
        ])->extends('layouts.guest')->section('content');
    }
}
