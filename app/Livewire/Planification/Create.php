<?php

namespace App\Livewire\Planification;

use Carbon\Carbon;
use App\Models\Tach;
use App\Models\User;
use App\Models\Filiale;
use Livewire\Component;
use App\Models\PlantTache;
use App\Models\Essaiepivot;
use Illuminate\Support\Str;
use App\Models\Essaieplanif;
use App\Models\MembresProjet;
use App\Mail\ConfirmationEmail;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Create extends Component
{
    public $ressources;
    public $resultat;
    public $hierachie;
    public $observation;
    public $id_planif;
    public $id_projet;
    public $date;
    public $filiale;
    public $departement;
    public $chef;
    public $projet;
    public $Alltaches;
    public $Auth_user;
    public $tachesPrevues;
    public $taches = [];
    public $newtache = [];
    public $createtaches = []; 

    
    public function render()
    {
        
        // // Récupérer tous les IDs de la table essaiepivot
        // $essaiepivotIDs = PlantTache::pluck('id_tache');

        $usersQuery = Tach::whereIn('status', ['New'])
            // ->whereNotIn('id', $essaiepivotIDs)
            ;

        if ($this->projet) {
            $usersQuery->where('id_projet', $this->projet);
        }

        $this->Alltaches = $usersQuery->get();

        $this->Auth_user = Auth::user();

        $this->chef = User::where('status', 'activer')
                  ->where('id', '!=', $this->Auth_user->id)
                  ->get();

        $this->filiale = $this->Auth_user->filiale;

        $this->departement =  $this->Auth_user->departement;

        $formatStartDate = now()->startOfWeek()->addWeek()->format("l d/m/Y");
        $formatEndDate = now()->endOfWeek()->addWeek()->format("l d/m/Y");

        $formatDateRange = strtoupper($formatStartDate . " AU " . $formatEndDate);

        // $hierachie = Essaieplanif::where('id_user',$this->Auth_user->id)->get();

        // Vérifiez si l'utilisateur connecté a une planification pour la semaine suivante à une date spécifique
        $planificationTerminee = PlanifHebdomadaire::where('id_user', $this->Auth_user->id)
            ->whereBetween('date', [$formatStartDate, $formatEndDate])
            ->exists();

        // Récupérer toutes les tâches dont les IDs correspondent à ceux de la table essaiepivot
        // $this->tachesPrevues = Tach::whereIn('id', $essaiepivotIDs)
        // ->where('id_projet', $this->id_projet)->get();
        
        return view('livewire.planification.create',[
            "Alltaches" =>  $this->Alltaches,
            "Auth_user" => $this->Auth_user,
            // "chef" => $this->chef,
            "formatDateRange" => $formatDateRange,
            // "step2" => $hierachie,
            "planificationTerminee" => $planificationTerminee,
        ])->extends('layouts.guest')->section('content');
    }

    public function add()
    {
        $this->dispatch("show_Projet_modal");
    }
    // public function closeModale(){

    //     // Récupérer les données de la table source
    //     $sourceData = Essaieplanif::where('id_user',$this->Auth_user->id)->get();

    //     // Boucle sur les données et les transférer dans la table de destination
    //     foreach ($sourceData as $Data) {
    //         $Data->delete();
    //     }

    //     // Récupérer les données de la table source
    //     $sourcepivot = Essaiepivot::where('id_user',$this->Auth_user->id)->get();

    //     $essaiepivotIDs = Essaiepivot::pluck('id_planif');

    //     // Récupérer toutes les tâches dont les IDs correspondent à ceux de la table essaiepivot
    //     $planif = PlanifHebdomadaire::whereIn('slug', $essaiepivotIDs)->get();

    //     // Boucle sur les données et les transférer dans la table de destination
    //     foreach ($sourcepivot as $item) {
    //             $item->delete();
    //     }
    //     $this->taches = [];
    //     $this->createtaches = []; 
    //     $this->reset();
    //     $this->dispatch('closeModal', []);
    // } 

    // public function update()
    // {
    //     $this->dispatch("show_modal");
    // }
    // public function closeupdate(){

    //     $this->dispatch('closeupdate', []);
    // }

    public function addTache()
    {
        $this->createtaches[] = ['tache_prevues' => '', 'id_projet' => $this->projet];
    }

    public function removeTache($index)
    {
        unset($this->createtaches[$index]);
        $this->createtaches = array_values($this->createtaches);
    }

    public function submitForm()
    {
        // Validation des champs
        $this->validate([
            'ressources' => 'required|string|max:255',
            'resultat' => 'required|string|max:255',
            'observation' => 'required|string|max:255',
            'projet' => 'required|exists:projets,id',
            'date' => ['required', 'date_format:Y-m-d', function ($attribute, $value, $fail) {
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();

                $selectedDate = Carbon::createFromFormat('Y-m-d', $value);

                if ($selectedDate->lt($startOfWeek) || $selectedDate->gt($endOfWeek)) {
                    $fail("La date doit être dans la semaine actuelle.");
                }
            }],
            'taches.*' => 'exists:taches,id',
        ]);

        $existingessaie = PlanifHebdomadaire::where('id_user', Auth::user()->id)
        ->where('date', $this->date)
        ->first();

        if (!$existingessaie) {
            // Générez le slug à partir du nom d'utilisateur
            $username = preg_replace('/\s+/', '', Auth::user()->name);
            // Remplacez cela par le nom d'utilisateur réel
            $slug = generateUserSlug($username);

            $planification = PlanifHebdomadaire::create([
                'id_user' => Auth::user()->id,
                'id_projet' => $this->projet,
                'ressources_necessaires' => $this->ressources,
                'resultat_attendus' => $this->resultat,
                'observation' => $this->observation,
                'date' => $this->date,
                'slug' => $slug,
                ]);

            foreach ($this->createtaches as $item) {
                $baseSlug = $item['tache_prevues'];
                $slug = $baseSlug;

                
                $tache = Tach::create([
                    'tache_prevues' => $item['tache_prevues'],
                    'id_projet' => $item['id_projet'],
                    'slug' => $slug,
                ]);

                $this->newtache[] =$tache->id;

                $this->taches[] = $tache->id;

            }

            foreach ($this->taches as $item) {
            
                PlantTache::create([
                    'id_tache' => $item,
                    'id_planif' => $planification->id,
                    'id_user' => Auth::user()->id,
                ]);
            }
            
            if ($this->newtache !== null) {
                PlantTache::whereIn('id_tache', $this->newtache)->update([
                    'status' => true
                ]);
            }
            Tach::whereIn('id', $this->taches)->update([
                'status' => 'Attente'
            ]);

        $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");
            
        } else {
            // Sinon, affichez un message d'erreur
            session()->flash('error', 'Vous avez déjà planifié une tâche pour cette date.');
        }

        // Réinitialisez les propriétés après la soumission réussie
        $this->taches = [];
        $this->createtaches = []; 
        $this->reset();
    }

    // public function confirmerJour($id)
    // {
    //     $planif = PlanifHebdomadaire::find($id);

    //     $this->id_planif = $planif->id;
    //     $this->id_projet = $planif->id_projet;
    //     $this->ressources = $planif->ressources_necessaires;
    //     $this->resultat = $planif->resultat_attendus;
    //     $this->observation = $planif->observation;
    // }

    // public function transferData()
    // {
    //     // Récupérer les données de la table source
    //     $sourceData = Essaieplanif::where('id_user',$this->Auth_user->id)->get();

    //     // Boucle sur les données et les transférer dans la table de destination
    //     foreach ($sourceData as $Data) {

    //         $planification = PlanifHebdomadaire::create([
    //             'id_user' => $Data['id_user'],
    //             'id_projet' => $Data['id_projet'],
    //             'ressources_necessaires' => $Data['ressources_necessaires'],
    //             'resultat_attendus' => $Data['resultat_attendus'],
    //             'observation' => $Data['observation'],
    //             'date' => $Data['date'],
    //                             'slug' => $Data['slug'],
    //         ]);

    //         $Data->delete();
    //     }

    //     // Récupérer les données de la table source
    //     $sourcepivot = Essaiepivot::where('id_user',$this->Auth_user->id)->get();

    //     $essaiepivotIDs = Essaiepivot::pluck('id_planif');

    //     // Récupérer toutes les tâches dont les IDs correspondent à ceux de la table essaiepivot
    //     $planif = PlanifHebdomadaire::whereIn('slug', $essaiepivotIDs)->get();

    //     // Boucle sur les données et les transférer dans la table de destination
    //     foreach ($sourcepivot as $item) {
    //         // Recherche de la correspondance dans la collection $planif
    //         $planifItem = $planif->where('slug', $item['id_planif'])->first();

    //         // Vérification si la correspondance a été trouvée
    //         if ($planifItem) {
    //             PlantTache::create([
    //                 'id_tache' => $item['id_tache'],
    //                 'id_planif' => $planifItem->id,
    //             ]);

    //             $item->delete();
    //         }
    //     }


    //     $statusTache = PlantTache::pluck('id_tache');
    //         foreach ($statusTache as $item) {
    //             Tach::where('id', $item)->update([
    //                 'status' => 'Attente'
    //             ]);
    //         }

            
    //         $this->hierachie = $this->filiale->hierachie;
    //         if ($this->Auth_user->id !== $this->hierachie) {
    //             $user = User::find($this->hierachie);
    //             $data = [
    //                 'Auth_user' => $this->Auth_user,
    //             ];
    //             $email = $user->email;
    //             Mail::to($email)->send(new ConfirmationEmail($data)); 
    //         }
            
    //     // Message de succès
    //     $this->dispatch("successEvent",[]);        
    //     $this->closeModale();

    // }

}

