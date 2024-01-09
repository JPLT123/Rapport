<?php

namespace App\Livewire\Planification;

use App\Models\Tach;
use App\Models\User;
use App\Models\Projet;
use Livewire\Component;
use App\Models\PlantTache;
use App\Mail\Rejeterplanif;
use Illuminate\Support\Str;
use App\Models\PlanifHebdomadaire;
use App\Mail\ConfirmationChefEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DetailPlanif extends Component
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
        $this->planif = $this->user->planif_hebdomadaires()->where('status', 'attente')
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

            $this->filiale = $this->user->filiale;
            $this->departement =  $this->user->departement;    

        // Utilisez une seule variable pour stocker les résultats des requêtes
        $plantTache = PlantTache::where('id_planif', $this->id_planif)->get();

        $usersQuery = Tach::whereIn('status', ['Attente']);

        if ($this->projet) {
            $usersQuery->where('id_projet', $this->projet);
        }

        $this->Alltaches = $usersQuery->get();

        $idprojet = Projet::where('status', 'activer')->get();
            
        return view('livewire.planification.detail-planif',[
            "user" => $this->user,
            "planifs" => $this->planif,
            "PlantTache" => $plantTache,  // Utilisez la variable correcte
            "Alltaches" => $this->Alltaches,  // Utilisez la variable correcte
            "idprojet" => $idprojet
        ])->extends('layouts.guest')->section('content');
    }

    public function update()
    {
        $this->dispatch("show_modal");
    }
    public function closeupdate(){

        $this->dispatch('closeupdate', []);
        $this->dispatch('Update_close', []);
    }

    public function confirmerJour($id)
    {
        $planif = PlanifHebdomadaire::find($id);

        $this->id_planif = $planif->id;
        $this->id_projet = $planif->id_projet;
        $this->ressources = $planif->ressources_necessaires;
        $this->resultat = $planif->resultat_attendus;
        $this->Observation = $planif->observation;
    }

    public function AccepterPlanif()
    {
        if ($this->user) {
            foreach ($this->planif as $planifItem) {
                $planifItem->update([
                    'status' => 'Approved',
                    'nom' => 'accepter'
                ]);
            }

            $data = [
                'user' => $this->user,
                'Auth_user'=> Auth::user()
            ];

            Mail::to($this->user->email)->send(new ConfirmationChefEmail($data));  
            
            $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");
        } else {
            
            $this->dispatch("showErrorMessage",[]);
        }
    }

    public function RejeterPlanif()
    {
        $this->validate([
            
            'object' => 'required|string|max:255',
        ]);

         if (empty($this->object)) {
            // Si la variable est vide, affichez une erreur (vous pouvez ajuster ceci en fonction de vos besoins)
            session()->flash('error', 'Le champ Hiérarchie ne peut pas être vide.');
            
        } else {
            foreach ($this->planif as $planifItem) {
                $planifItem->update([
                    'status' => 'rejeter',
                    'nom' => $this->object
                ]);
            }

            $this->closeupdate();

            $data = [
                'user' => $this->user,
                'Auth_user'=> Auth::user(),
                'object'=> $this->object
            ];

            Mail::to($this->user->email)->send(new Rejeterplanif($data));  
            
            $this->dispatch("successEvent",[]);
        }
    }

}
