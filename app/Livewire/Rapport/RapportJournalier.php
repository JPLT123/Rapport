<?php

namespace App\Livewire\Rapport;

use Carbon\Carbon;
use App\Models\Tach;
use App\Models\User;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Depenser;
use App\Models\ImportFile;
use App\Mail\EnvoieRapport;
use App\Models\Tacheprochain;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RapportJournalier extends Component
{
    use WithFileUploads;

    public $files = [];
    public $tachesRealisees;
    public $debutHeure;
    public $finHeure;
    public $lieu;
    public $materielsUtilises;
    public $designationDepenses;
    public $coutsReels;
    public $coutsPrevionnels;
    public $observation;
    public $observationDepenses;
    public $tachesDemain;
    public $tachesSuplementaire;
    public $filiale;
    public $duree;
    public $designationprochain;
    public $valeur;
    public $risques;
    public $departement;
    public $observationglobal;
    public $Auth_user;
    public $tacheId;
    public $planifications;
    public $dateActuelle;
    public $afficherFormulaire;
    public $addtaches = [];
    public $Depenses = [];
    public $tachesProchain = [];

    public function render()
    {
            $this->Auth_user = Auth::user();
            $this->filiale = $this->Auth_user->filiale;
            $this->departement =  $this->Auth_user->departement;

            $this->planifications =  $this->Auth_user->planif_hebdomadaires()
                ->where('status', 'Approved')
                ->whereDate('date', Carbon::today())
                ->get();

        return view('livewire.rapport.rapport-journalier', [
            "planif" => $this->planifications
        ])->extends('layouts.guest')->section('content');
    }

    public function Ajoutaches()
    {
        $this->addtaches[] = [
            'tachesRealisees' => '',
            'tachesSuplementaire' => '',
            'debutHeure' => '',
            'finHeure' => '',
            'lieu' => '',
            'materielsUtilises' => '',
            'observation' => '',
            'observationglobal' => '',
            'tacheId' => '',
        ];
    }

    public function removetaches($index)
    {
        unset($this->addtaches[$index]);
        $this->addtaches = array_values($this->addtaches);
    }

    public function addDepenses()
    {
        $this->Depenses[] = [
            'designationDepenses' => '',
            'coutsReels' => '',
            'coutsPrevionnels' => '',
            'observationDepenses' => '',
        ];

        $this->afficherFormulaire = true;
    }

    public function removeDepenses($index)
    {
        unset($this->Depenses[$index]);
        $this->Depenses = array_values($this->Depenses);

        $this->afficherFormulaire = false;
    }

    public function addtachesProchain()
    {
        $this->tachesProchain[] = [
            'tachesDemain' => '',
            'duree' => '',
            'designationprochain' => '',
            'valeur' => '',
            'risques' => '',
        ];
    }

    public function removetachesProchain($index)
    {
        unset($this->tachesProchain[$index]);
        $this->tachesProchain = array_values($this->tachesProchain);
    }

    public function submitForm()
    {
        $this->validate([

            'tachesDemain' => 'required|string|max:255',
            'duree' => 'required|date_format:H:i',
            'designationprochain' => 'required|string|max:255',
            'valeur' => 'required|string|max:255',
            'risques' => 'required|string|max:255',
            'tachesRealisees' => 'required',
            'debutHeure' => 'required',
            'finHeure' => 'required',
            'lieu' => 'required',
            'materielsUtilises' => 'required',
            'observation' => 'required',
            'observationglobal' => 'required',
            'tacheId' => 'required',
            
        ]);

        // Obtenez la date actuelle
        $this->dateActuelle = Carbon::now()->toDateString();

        $Tachedemain = Tacheprochain::create([
            'taches' => $this->tachesDemain,
            'duree' => $this->duree,
            'designation' => $this->designationprochain,
            'valeur' => $this->valeur,
            'risques' => $this->risques,
        ]);

        $Tachedemain1 = [];
        foreach ($this->tachesProchain as $item) {
            $Tachedemain1 = Tacheprochain::create([
                'taches' => $item['tachesDemain'],
                'duree' => $item['duree'],
                'designation' => $item['designationprochain'],
                'valeur' => $item['valeur'],
                'risques' => $item['risques'],
            ]);
        }
        $TachedemainId = $Tachedemain->id;

        $user = $this->Auth_user->id;

        $rapport = Rapport::create([
            'tache_realiser' => $this->tachesRealisees,
            'tache_suplementaire' => $this->tachesSuplementaire,
            'debut_heure' => $this->debutHeure,
            'fin_heure' => $this->finHeure,
            'lieu' => $this->lieu,
            'date' => $this->dateActuelle,
            'materiels_utiliser' => $this->materielsUtilises,
            'observation' => $this->observation,
            'observationglobal' => $this->observationglobal,
            'id_tache' => $this->tacheId,
            'id_prochain_tache' => $TachedemainId,
            'id_user' => $user,
        ]);

        foreach ($this->addtaches as $item) {
            $rapport = Rapport::create([
                'tache_realiser' => $item['tachesRealisees'],
                'tache_suplementaire' => $item['tachesSuplementaire'],
                'debut_heure' => $item['debutHeure'],
                'fin_heure' => $item['finHeure'],
                'lieu' => $item['lieu'],
                'date' => $this->dateActuelle,
                'materiels_utiliser' => $item['materielsUtilises'],
                'observation' => $item['observation'],
                'observationglobal' => $item['observationglobal'],
                'id_tache' => $this->tacheId,
                'id_prochain_tache' =>$TachedemainId,
                'id_user' => $user,
            ]);
        }

        $rapportId = $rapport->id;

        foreach ($this->files as $file) {
            $filename = $file->store('uploads'); // Sauvegarde le fichier dans le dossier "uploads" (ajustez selon vos besoins)

            ImportFile::create([
                'id_user' => $user,
                'id_rapport' => $rapportId,
                'links' => $filename,
            ]);
        }
        
       Tach::where('id',$this->tacheId)->update([
            'status' => 'Terminer'
        ]);
        
        foreach ($this->Depenses as $item) {
            Depenser::create([
                'Designation' => $item['designationDepenses'],
                'CoutReel' => $item['coutsReels'],
                'Coutprevisionnel' => $item['coutsPrevionnels'],
                'observation' => $item['observationDepenses'],
                'id_tache' => $this->tacheId,
            ]);
        }

        $this->hierachie = $this->filiale->hierachie;
        if ($this->Auth_user->id !== $this->hierachie) {
            $user = User::find($this->hierachie);
            $data = [
                'Auth_user' => $this->Auth_user,
            ];
            $email = $user->email;
            Mail::to($email)->send(new EnvoieRapport($data)); 
        } 
            
        $this->files = [];
        $this->reset();

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  
    }
}
