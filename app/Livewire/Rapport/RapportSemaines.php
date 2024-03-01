<?php

namespace App\Livewire\Rapport;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ImportFile;
use Livewire\WithFileUploads;
use App\Models\RapportSemaine;
use Illuminate\Support\Facades\Auth;

class RapportSemaines extends Component
{
    use WithFileUploads;
    
    public $objet;
    public $realisation;
    public $difficulter;
    public $budget;
    public $recommandation;
    public $findate;
    public $debutdate;
    public $files;

    public function render()
    {
        return view('livewire.rapport.rapport-semaine')->extends('layouts.guest')->section('content');
    }

    public function Soumettre()
    {
        // Validation des données
        $this->validate([
            'objet' => 'required|max:255',
            'realisation' => 'required',
            'difficulter' => 'required|max:255',
            'budget' => 'required|max:255',
            'recommandation' => 'required|max:255',
            'findate' => 'required|date',
            'debutdate' => 'required|date',
        ]);

        // Récupération de l'utilisateur authentifié
        $user = Auth::user();

        // Générez le slug à partir du nom d'utilisateur
        $username = preg_replace('/\s+/', '', Auth::user()->name);
        // Remplacez cela par le nom d'utilisateur réel
        $slug = generateUserSlug($username);

        // Création du rapport de semaine
        $semaine = RapportSemaine::create([
            'slug' => $slug,
            'objet' => $this->objet,
            'realisation' => $this->realisation,
            'difficulte' => $this->difficulter,
            'budget' => $this->budget,
            'recommandation' => $this->recommandation,
            'findate' => $this->findate,
            'debutdate' => $this->debutdate,
            'id_user' => $user->id,
        ]);

        if ($this->files !== null) {
            // Sauvegarde du fichier dans le dossier "uploads"
            $filename = $this->files->store('uploads');

            // Création de l'entrée dans la table ImportFile
            $dateActuelle = Carbon::now()->toDateString();
            ImportFile::create([
                'id_user' => $user->id,
                'semaine' => $semaine->id,
                'nom_fichier' => 'fichier-joint-' . $dateActuelle,
                'links' => $filename,
            ]);
        }

        $this->reset();
        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  
        return redirect()->route('rapport-semaine-detail', ['slug' => $slug]);
    }
}
