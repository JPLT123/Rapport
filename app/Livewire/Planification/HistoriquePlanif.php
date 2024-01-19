<?php

namespace App\Livewire\Planification;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\PlanifHebdomadaire;

class HistoriquePlanif extends Component
{
    public $planifs;
    public $planifications;
    
    public function render()
    {
        // $planifs = PlanifHebdomadaire::all();

        // $planificationsParSemaine = [];
        // // // Regroupez les enregistrements par semaine
        // // $planificationsParSemaine = $this->planifs->groupBy(function($date) {
        // //     return Carbon::parse($date->date)->format('W');
        // // });

        // // Regrouper les planifications par semaine
        // $this->planifs = $planifs->groupBy(function ($planif) {
        //     return Carbon::parse($planif->date)->startOfWeek()->format('Y-m-d');
        // });
         // Récupérez les enregistrements existants depuis la base de données
         $this->planifs = PlanifHebdomadaire::all();

         // Initialisez une variable pour stocker la semaine précédente
         $semainePrecedente = null;
 
         $this->planifications = [];
 
         foreach ($this->planifs as $planif) {
             $datePlanification = Carbon::parse($planif->date);
 
             // Vérifiez si la date actuelle appartient à la même semaine que la semaine précédente
             if (!$semainePrecedente || $datePlanification->weekOfYear != $semainePrecedente) {
                 // Ajoutez les informations à un tableau
                 $this->planifications[] = [
                     'id_user' => $planif->user->name,
                     'slug_user' => $planif->user->slug,
                     'departemnet' => $planif->user->departement->nom,
                     'filiale' => $planif->user->filiale->logo,
                     'filiale_nom' => $planif->user->filiale->nom,
                     'slug' => $planif->slug,
                     'date_debut_semaine' => $datePlanification->startOfWeek()->isoFormat('DD MMM YYYY'),
                     'date_fin_semaine' => $datePlanification->endOfWeek()->isoFormat('DD MMM YYYY'),
                 ];
 
                 // Mettez à jour la semaine précédente
                 $semainePrecedente = $datePlanification->weekOfYear;
             }
         }
        // dd($this->planifications);
        return view('livewire.planification.historique-planif')->extends('layouts.guest')->section('content');
    }

    public function status( $slug)
{dd('ok');
    // Utilisez "first" au lieu de "get" pour obtenir un seul modèle
    $planif = PlanifHebdomadaire::where('slug', $slug)->first();

    // Assurez-vous que le modèle existe avant de tenter la mise à jour
    if ($planif) {
        // Utilisez "update" directement sur le modèle
        $planif->update(['status' => 'Approved']);
    }

    // Vous pouvez également ajouter un message flash pour informer l'utilisateur de la mise à jour réussie
    session()->flash('message', 'Le statut a été mis à jour avec succès.');

    // Vous pouvez également rediriger l'utilisateur ou effectuer d'autres actions après la mise à jour
}

}
