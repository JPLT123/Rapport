<?php

namespace App\Livewire\Projet;

use Carbon\Carbon;
use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Depenser;
use App\Models\ImportFile;
use App\Models\MembresProjet;
use Illuminate\Support\Facades\DB;

class ApercuProjet extends Component
{
    public $projet;
    public $projetId;

    public function mount($slug)
    {
        $this->projet = Projet::where('code', $slug)->first();
    }

    public function tasksCountByUserAndDay()
    {
        $this->projetId = $this->projet->id;
        return DB::table('membres_projet')
            ->join('users', 'membres_projet.id_user', '=', 'users.id')
            ->join('taches', 'membres_projet.id_projet', '=', 'taches.id_projet')
            ->where('taches.status', 'Terminer')
            ->where('membres_projet.id_projet', $this->projetId)
            ->selectRaw('users.name as user_name, DATE_FORMAT(taches.created_at, "%Y-%m-%d") as task_date, count(taches.id) as task_count')
            ->groupBy('users.name', 'task_date')
            ->get();
    }

    public function render()
    {
        
        $projectId = $this->projet->id;
        // Récupérer le projet spécifique avec ses tâches
        $project = Projet::with('taches')->findOrFail($projectId);
        // Préparer les données pour le graphique
        $daysCompleted = []; // Nombre de jours effectués pour chaque jour
        $workersCount = []; // Nombre de personnes travaillant sur le projet pour chaque jour

        // Supposons que vous avez un champ "date" dans votre table de tâches pour enregistrer la date de chaque tâche
        $dates = []; // Liste des dates distinctes où au moins une tâche a été réalisée
        foreach ($project->taches as $task) {
            $taskDate = $task->created_at->toDateString(); // Supposons que la date de réalisation de la tâche est stockée dans le champ 'created_at'
            if (!in_array($taskDate, $dates)) {
                $dates[] = $taskDate;
                
                // Calculer le nombre de tâches réalisées pour chaque jour
                $tasksCompletedOnDate = $project->taches->where('created_at', 'like', $taskDate . '%')->count();
                $daysCompleted[$taskDate] = $tasksCompletedOnDate;
                
                // Calculer le nombre d'utilisateurs travaillant sur le projet pour chaque jour
                $usersWorkingOnDate = collect(); // Utilisez collect() pour créer une nouvelle collection
                foreach ($project->taches as $task) {
                    if ($task->created_at->toDateString() == $taskDate) {
                        $usersWorkingOnDate = $usersWorkingOnDate->merge($task->users); // Supposons que vous avez une relation "users" dans votre modèle Task pour récupérer les utilisateurs associés à la tâche
                    }
                }
                $uniqueUsersCount = $usersWorkingOnDate->unique('id')->count(); // Compter le nombre d'utilisateurs uniques travaillant sur des tâches ce jour-là
                $workersCount[$taskDate] = $uniqueUsersCount;
            }
        }

        $sommeCout = Depenser::join('taches', 'depenser.id_tache', '=', 'taches.id')
            ->where('taches.id_projet', $this->projetId)
            ->sum('depenser.Coutprevisionnel');
            
            $fichiersJoints = ImportFile::join('rapport', 'importfile.id_rapport', '=', 'rapport.id')
                ->join('taches', 'rapport.id_tache', '=', 'taches.id')
                ->where('taches.id_projet', $this->projetId)
                ->get(['importfile.*']); // récupère toutes les colonnes de la table importfile

                    return view('livewire.projet.apercu-projet',[
            "projets"=>$this->projet,
            "sommeCout" =>$sommeCout,
            "fichiersJoints" => $fichiersJoints,
            "daysCompleted" =>$daysCompleted,
            "workersCount" => $workersCount
        ])->extends('layouts.guest')->section('content');
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
