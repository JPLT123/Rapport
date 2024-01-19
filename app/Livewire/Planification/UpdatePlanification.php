<?php

namespace App\Livewire\Planification;

use App\Models\Tach;
use App\Models\User;
use App\Models\Projet;
use Livewire\Component;
use App\Models\PlantTache;
use Illuminate\Support\Str;
use App\Mail\ConfirmationEmail;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UpdatePlanification extends Component
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
    public $user;
    public $planif;
    public $object;
    public $Alltaches;
    public $taches = [];
    public $Newtaches = [];
    public $createtaches = [];

    public function mount($slug)
    {
        $this->user = User::where('slug', $slug)->first();
    }

    public function render()
    {
        $user = Auth::user();

        $this->planif = $user->planif_hebdomadaires()->where('status', 'rejeter')
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

            $this->filiale = $user->filiale;
            $this->departement =  $user->departement;    

        // Utilisez une seule variable pour stocker les résultats des requêtes
        $plantTache = PlantTache::where('id_planif', $this->id_planif)->get();

        $usersQuery = Tach::whereIn('status', ['Attente']);

        if ($this->projet) {
            $usersQuery->where('id_projet', $this->projet);
        }

        $this->Alltaches = $usersQuery->get();

        $idprojet = Projet::where('status', 'activer')->get();

        return view('livewire.planification.listplanification', [
            "user" => $user,
            "planifs" => $this->planif,
            "PlantTache" => $plantTache,  // Utilisez la variable correcte
            "Alltaches" => $this->Alltaches,  // Utilisez la variable correcte
            "idprojet" => $idprojet
        ])->extends('layouts.guest')->section('content');
    }

    public function addTache()
    {
        $this->createtaches[] = ['tache_prevues' => '', 'id_projet' => $this->projet];
    }

    public function removeTache($index)
    {
        unset($this->createtaches[$index]);
        $this->createtaches = array_values($this->createtaches);
    }

    public function UpdateJour($id)
    {
        $planif = PlanifHebdomadaire::find($id);

        $this->id_planif = $planif->id;
        $this->projet = $planif->id_projet;
        $this->ressources = $planif->ressources_necessaires;
        $this->resultat = $planif->resultat_attendus;
        $this->Observation = $planif->observation;
        $this->taches = $planif->plant_taches->pluck('id_tache');

    }

    public function Updateplanif()
    {
        // Validation des champs
        $this->validate([
            'projet' => 'required|exists:projets,id',
            'createtaches.*.tache_prevues' => 'required',  // Validation correcte pour les taches créées
            'createtaches.*.id_projet' => 'required|exists:projets,id',
        ]);

        $planif = PlanifHebdomadaire::find($this->id_planif);

        if ($planif) { // Utilisez $planif au lieu de $projet

            $planif->update([
                'id_projet' => $this->projet,
                'ressources_necessaires' => $this->ressources,
                'resultat_attendus' => $this->resultat,
                'observation' => $this->Observation,
            ]);

            PlantTache::where('id_planif', $this->id_planif)
                ->delete();

            $slug = Str::slug($this->id_planif);
            $uniqueSlug = $slug;
            $count = 1;

            while (Tach::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $slug . '-' . $count;
                $count++;
            }

            foreach ($this->createtaches as $item) {
                $tache = Tach::create([
                    'tache_prevues' => $item['tache_prevues'],
                    'id_projet' => $item['id_projet'],
                    'slug' => $uniqueSlug,
                ]);

                $this->Newtaches[] = $tache->id;
            }

            // Enregistrer les tâches
            if ($this->Newtaches) {
                foreach ($this->Newtaches as $item) {
                   $taches = PlantTache::create([
                        'id_tache' => $item,
                        'id_planif' => $this->id_planif
                    ]);

                    Tach::where('id',$item)->update([
                        "status"=>'En Cour'
                    ]);
                }
            }

            $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");
        } else {
            // Sinon, affichez un message d'erreur
            session()->flash('error', 'La planification spécifiée n\'a pas été trouvée.');
        }

        // Réinitialisez les propriétés après la soumission réussie
        $this->reset();
    }

    public function envoie()
    {
        foreach ($this->planif as $planifItem) {
            $planifItem->update([
                'status' => 'attente'
            ]);
        }

        $chef = $this->filiale->hierachie;

        // Utilisez find() pour obtenir un seul utilisateur par son ID
        $user = User::find($chef);

        // Vérifiez si l'utilisateur est trouvé avant de continuer
        if ($user) {
            $data = [
                'Auth_user' => Auth::user(),
            ];

            Mail::to($user->email)->send(new ConfirmationEmail($data));
        } else {
            // Gérer le cas où l'utilisateur n'est pas trouvé
            // Par exemple, enregistrer un message d'erreur dans les logs
            session()->flash('Utilisateur introuvable avec l\'ID ' . $chef);
        }

        $this->dispatch("successEvent",[]);   
    }
}
