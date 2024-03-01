<?php

namespace App\Livewire\Planification;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Facades\Auth;

class HistoriquePlanif extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $planifs;
    public $userRoles;
    public $filiale_id;
    
    public function render()
    {
        $Authuser = Auth::user();
        $this->userRoles = $Authuser->permissions->pluck('id_role')->toArray();
        //  // Récupérez les enregistrements existants depuis la base de données
        //  $this->planifs = PlanifHebdomadaire::all();

         if (in_array(6, $this->userRoles)) {
            $query = User::query()
            ->where('id_Service', $Authuser->id_Service)
             ->whereIn("status", ['activer']);
            
            if ($this->filiale_id) {
                $query->where('id_filiale', $this->filiale_id);
            }

            $user = $query->paginate(10);
        }elseif (in_array(5, $this->userRoles)) {
                $query = User::query()
                ->where('id_filiale', $Authuser->id_filiale)
                ->where('id_departement', $Authuser->id_departement)
                ->whereIn("status", ['activer']);

                $user = $query->paginate(10);
        }elseif (in_array(2, $this->userRoles)) {
            // Récupérez les identifiants de filiales dont l'utilisateur est responsable
            $filialesResponsable = Filiale::where('hierachie',$Authuser->id)->pluck('id');
        
            // Récupérez les utilisateurs de toutes les filiales dont l'utilisateur est responsable
            $query = User::query()
                ->whereIn('id_filiale', $filialesResponsable)
                ->whereIn("status", ['activer']);
        
            if ($this->status) {
                $query->where('status', $this->status);
            }
        
            if ($this->filiale_id) {
                $query->where('id_filiale', $this->filiale_id);
            }
        
            $user = $query->paginate(10);
        }
        else {
            $query = User::query()
            ->whereIn("status", ['activer']);

            if ($this->filiale_id) {
                $query->where('id_filiale', $this->filiale_id);
            }

            $user = $query->paginate(10);
        }
        return view('livewire.planification.historique-planif',[
            "users" => $user
        ])->extends('layouts.guest')->section('content');
    }

//     public function status( $slug)
// {dd('ok');
//     // Utilisez "first" au lieu de "get" pour obtenir un seul modèle
//     $planif = PlanifHebdomadaire::where('slug', $slug)->first();

//     // Assurez-vous que le modèle existe avant de tenter la mise à jour
//     if ($planif) {
//         // Utilisez "update" directement sur le modèle
//         $planif->update(['status' => 'Approved']);
//     }

//     // Vous pouvez également ajouter un message flash pour informer l'utilisateur de la mise à jour réussie
//     session()->flash('message', 'Le statut a été mis à jour avec succès.');

//     // Vous pouvez également rediriger l'utilisateur ou effectuer d'autres actions après la mise à jour
// }

}
