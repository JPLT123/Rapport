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
        $tasksCountByUserAndDay = $this->tasksCountByUserAndDay();

        $Serie = [];

        foreach ($tasksCountByUserAndDay as $taskData) {
            $Serie[] = [
                'name' => $taskData->user_name,
                'data' => [
                    'x' => $taskData->task_date,
                    'y' => $taskData->task_count,
                ],
            ];
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
            "Serie" => $Serie,
            "sommeCout" =>$sommeCout,
            "fichiersJoints" => $fichiersJoints
        ])->extends('layouts.guest')->section('content');
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
