<?php

namespace App\Livewire\Planification;

use Livewire\Component;
use App\Models\PlantTache;
use App\Models\Planification;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Facades\Auth;

class Apercu extends Component
{
    public $id_planif;
    public $ressources;
    public $resultat;
    public $Observation;
    public $filiale;
    public $departement;
    public $tache;
    public $tache_prevues;
    public $projet;
    public $service;
    
    public function render()
    {
        $Auth_user = Auth::user();
        $this->filiale = $Auth_user->filiale;
        $this->departement =  $Auth_user->departement;
        $this->service =  $Auth_user->service;
        
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
    
        $planifications = $Auth_user->planif_hebdomadaires()
        ->whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        $PlantTache = PlantTache::where('id_planif', $this->id_planif)->get();
    
        $formatStartDate = now()->startOfWeek()->format("l d/m/Y");
        $formatEndDate = now()->endOfWeek()->format("l d/m/Y");

        $formatDateRange = strtoupper($formatStartDate . " AU " . $formatEndDate);

        return view('livewire.planification.apercu', [
            "planifications" => $planifications,
            "formatDateRange" => $formatDateRange,
            "PlantTache" => $PlantTache
        ])->extends('layouts.guest')->section('content');
    }
    
    public function detail($id)
    {
        $planif = PlanifHebdomadaire::find($id);

        $this->id_planif = $planif->id;
        $this->ressources = $planif->ressources_necessaires;
        $this->resultat = $planif->resultat_attendus;
        $this->Observation = $planif->observation;
    }
}
