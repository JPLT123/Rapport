<?php

namespace App\Livewire\GestionUtilisateur;

use App\Models\User;
use Livewire\Component;
use App\Models\ImportFile;
use App\Models\PlantTache;
use Livewire\WithPagination;
use App\Models\PlanifHebdomadaire;

class DetailUser extends Component
{
    use WithPagination;
    
    public $user;
    public $id_planif;
    public $ressources;
    public $resultat;
    public $Observation;
    public $tache;
    public $tache_prevues;
    public $projet;

    public function mount($slug)
    {
        $this->user = User::where('slug', $slug)->first();
        
    }

    public function render()
    {
        
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
    
        $planifications = $this->user->planif_hebdomadaires()
        ->whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        $PlantTache = PlantTache::where('id_planif', $this->id_planif)->get();
    
        $formatStartDate = now()->startOfWeek()->format("l d/m/Y");
        $formatEndDate = now()->endOfWeek()->format("l d/m/Y");

        $formatDateRange = strtoupper($formatStartDate . " AU " . $formatEndDate);

        $projets = $this->user->membres_projets()->paginate(3);

        return view('livewire.gestion-utilisateur.detail-user',[
            "user" => $this->user,
            "projets" => $projets,
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

    public function telecharger($id)
    {
        // Récupérez le lien du fichier depuis la base de données
        $importFile = ImportFile::find($id);

        if ($importFile) {
            // Obtenez le chemin complet du fichier depuis le modèle
            $cheminFichier = storage_path('app/' . $importFile->links);

            // Retourne une réponse de téléchargement
            return response()->download($cheminFichier, $importFile->nom_fichier ?? 'Document'.'.pdf');
        } else {
            // Le fichier n'existe pas dans la base de données, renvoie une réponse d'erreur JSON
            return response()->json(['error' => 'Erreur lors du téléchargement du fichier'], 404);
        }
    }
}
