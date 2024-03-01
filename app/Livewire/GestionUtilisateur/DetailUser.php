<?php

namespace App\Livewire\GestionUtilisateur;

use App\Models\User;
use Livewire\Component;
use App\Models\ImportFile;
use App\Models\PlantTache;
use Livewire\WithPagination;
use App\Models\Rapportgeneral;
use Illuminate\Support\Carbon;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Facades\DB;

class DetailUser extends Component
{
    use WithPagination;
    
    public $user;
    public $userId;
    public $id_planif;
    public $ressources;
    public $resultat;
    public $Observation;
    public $tache;
    public $tache_prevues;
    public $projet;

    public $mois = [];
    public $jours_travailles = [];

    public function mount($slug)
    {
        $this->user = User::where('slug', $slug)->first();
    }

    private function getMonthName($monthNumber)
    {
        return date("M", mktime(0, 0, 0, $monthNumber, 1));
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


        $this->userId = $this->user->id;
        $statistiques = Rapportgeneral::where('id_user', $this->userId)
        ->select(
            DB::raw('MONTH(date) as mois'),
            DB::raw('COUNT(*) as nb_rapports')
        )->groupBy(DB::raw('MONTH(date)'))
        ->get();

        // Préparer les données pour le passage à la vue
        foreach ($statistiques as $statistique) {
            $this->mois[] = $this->getMonthName($statistique->mois);
            $this->jours_travailles[] = $statistique->nb_rapports;
        }

        $projects = $this->user->ongoingProjects;
        // Récupérer tous les mois disponibles dans les données
        $months = [];
        foreach ($projects as $project) {
            $tasksCompletedByMonth = $project->taches()
                ->where('status', 'Terminer')
                ->selectRaw('MONTH(created_at) as month')
                ->distinct()
                ->pluck('month');

            $months = array_merge($months, $tasksCompletedByMonth->toArray());
        }

        // Supprimer les doublons et trier les mois
        $months = array_unique($months);
        sort($months);

        // Convertir les numéros de mois en noms de mois
        $months = array_map(function($monthNumber) {
            return date('M', mktime(0, 0, 0, $monthNumber, 1));
        }, $months);

                $data = [];

        foreach ($projects as $project) {
            $tasksCompletedByMonth = $project->taches()
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->get();

            $projectData = [];

            foreach ($months as $index => $month) {
                $completedTasksCount = $tasksCompletedByMonth->firstWhere('month', $index + 1);
                $projectData[] = $completedTasksCount ? $completedTasksCount->count : 0;
            }

            $data[] = [
                'name' => $project->nom,
                'data' => $projectData,
            ];

        }
        
        return view('livewire.gestion-utilisateur.detail-user',[
            "user" => $this->user,
            "projets" => $projets,
            "planifications" => $planifications,
            "formatDateRange" => $formatDateRange,
            "PlantTache" => $PlantTache,
            "jours_travailles" => $this->jours_travailles,
            "mois" => $this->mois,
            'data' => $data,
            'months' => $months,
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

            // Déterminez le type MIME du fichier à partir de son extension
            $typeMIME = mime_content_type($cheminFichier);

            // Retourne une réponse de téléchargement avec le type MIME correct
            return response()->download($cheminFichier, $importFile->nom_fichier ?? 'Document'.'.zip', [
                'Content-Type' => $typeMIME,
                'Content-Disposition' => 'attachment'
            ]);
        } else {
            // Le fichier n'existe pas dans la base de données, renvoie une réponse d'erreur JSON
            return response()->json(['error' => 'Erreur lors du téléchargement du fichier'], 404);
        }
    }

}
