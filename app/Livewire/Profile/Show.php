<?php

namespace App\Livewire\Profile;

use App\Models\Tach;
use App\Models\Projet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use PDF;

class Show extends Component
{
    public $projet;
    public $TotalTaches;
    public $totale;
    public $months;
    public $nom;
    public $id_projet;
    public $projectId;
    public $chartData = [];
    public $iteration = 1;
    public $percentage = []; 
    public $projects;
    public $user;
    public $rapports;

public function generatePdf()
{
    $pdf = PDF::loadView('generate-pdf');
    return $pdf->download('example.pdf');
}


    public function mount()
    {
        $this->projectId = null;
        // Récupérez l'utilisateur connecté
        $this->user = Auth::user();
        // Ne récupérez pas les projets deux fois
        $this->projectId = $this->user->membres_projets->pluck('id_projet');
        $this->projet = Projet::find($this->projectId);
        $this->percentage = [];

        foreach ($this->projet as $project) {
            $totalTasks = $project->taches->count(); // Nombre total de tâches pour le projet
            $completedTasks = $project->taches->where('status', 'Terminer')->count(); // Nombre de tâches terminées

            $this->percentage[$project->id] = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
        }
        
    }

    public function render()
    {
        
        $user = Auth::user();
        // Récupérez tous les projets de l'utilisateur avec le total des tâches
        $this->TotalTaches = Projet::whereHas('membres_projets', function ($query) use ($user) {
            $query->where('id_user', $this->user->id);
        })->withCount(['taches as taches_en_cours' => function ($query) {
            $query->where('status', 'Terminer');
        }])->withCount('taches')->get();

        $this->totale = $this->TotalTaches->sum('taches_count');

        return view('profile.show',[
            'projets' => $this->projet,
        ])->extends('layouts.guest')->section('content');
    }
    
}
