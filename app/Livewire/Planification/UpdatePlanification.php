<?php

namespace App\Livewire\Planification;

use App\Models\Tach;
use App\Models\User;
use App\Models\Projet;
use Livewire\Component;
use App\Models\PlantTache;
use Illuminate\Support\Str;
use App\Helpers\EmailHelper;
use App\Mail\ConfirmationEmail;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
    public $permission;
    public $taches = [];
    public $Newtaches = [];
    public $createtaches = [];
    public $updatetaches = [];

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
            
            $this->permission = DB::table('users')
                ->join('permissions', 'users.id', '=', 'permissions.id_user')
                ->join('role', 'permissions.id_role', '=', 'role.id')
                ->where('users.id', Auth::user()->id)
                ->value('role.nom');

        // Utilisez une seule variable pour stocker les résultats des requêtes
        $plantTache = PlantTache::where('id_planif', $this->id_planif)->get();

        $usersQuery = Tach::whereIn('status',['New']);

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
        $this->taches = $planif->plant_taches->where('status', false)->pluck('id_tache');
        $this->updatetaches = $planif->plant_taches->where('status', true);
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

            $idsTache = PlantTache::where('id_planif', $this->id_planif)
                     ->where('status', false)
                     ->pluck('id_tache');
            
            Tach::whereIn('id', $idsTache)->update([
                'status' => 'New'
            ]);

            PlantTache::where('id_planif', $this->id_planif)
            ->where('status',false)
                ->delete();

            foreach ($this->createtaches as $item) {
                // Générez le slug à partir du nom d'utilisateur
                $username = preg_replace('/\s+/', '', Auth::user()->name);
                // Remplacez cela par le nom d'utilisateur réel
                $slug = generateUserSlug($username);

                $tache = Tach::create([
                    'tache_prevues' => $item['tache_prevues'],
                    'id_projet' => $item['id_projet'],
                    'slug' => $slug,
                ]);

                $this->Newtaches[] = $tache->id;
            }

            // Enregistrer les tâches
            if ($this->Newtaches !== null) {
                foreach ($this->Newtaches as $item) {
                   $taches = PlantTache::create([
                        'id_tache' => $item,
                        'id_planif' => $this->id_planif,
                        'status' => true
                    ]);

                    Tach::where('id',$item)->update([
                        "status"=>'Attente'
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

    public function update($tacheId)
    {
        $tache = Tach::find($tacheId);
        $nouvellesTaches = $this->tache_prevues[$tacheId];
        
        if ($tache) {
            $updateResult = $tache->update([
                'tache_prevues' => $nouvellesTaches, // Utilisez $nouvellesTaches ici
                'status' => 'Attente'
            ]);
    
            if ($updateResult) {
                // Mise à jour réussie, affichez un message de confirmation
                session()->flash('success', 'Tâche mise à jour avec succès!');
            } else {
                // La mise à jour a échoué, affichez un message d'erreur
                session()->flash('error', 'La mise à jour de la tâche a échoué.');
            }
        } else {
            // La tâche n'a pas été trouvée, affichez un message d'erreur
            session()->flash('error', 'Tâche non trouvée.');
        }
    }
    

    public function delete($id)
    {
        $tache = Tach::find($id);
        if ($tache) {
            $updateResult = $tache->update([
                'status' => 'Supprimer'
            ]);
    
            PlantTache::where('id_tache',$tache->id)->delete();
            
            if ($updateResult) {
                // Mise à jour réussie, affichez un message de confirmation
                session()->flash('success', 'Tâche supprimer avec succès!');
            } else {
                // La supprimer a échoué, affichez un message d'erreur
                session()->flash('error', 'La suppression de la tâche a échoué.');
            }
        } else {
            // La tâche n'a pas été trouvée, affichez un message d'erreur
            session()->flash('error', 'Tâche non trouvée.');
        }
    }

    public function envoie()
    {
        foreach ($this->planif as $planifItem) {
            $planifItem->update([
                'status' => 'attente'
            ]);
        }
        
        if ($this->user->id_departement !== null) {
            if ($this->permission == "Membre") {
                $hierachie = $this->filiale->hierachie;
                if ($this->user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $responsable = $this->departement->hierachie;
                    $email_responsable = User::where('id', $responsable)->value('email'); 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user(),
                        'ccEmail' => $email
                    ];
                    Mail::to($email_responsable)->cc($email)->cc($email_admin)->send(new ConfirmationEmail($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Responsable service") {
                $hierachie = $this->filiale->hierachie;
                if ($this->user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user(),
                        'ccEmail' => $email_admin
                    ];
                    Mail::to($email)->cc($email_admin)->send(new ConfirmationEmail($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Responsable") {
                $hierachie = $this->filiale->hierachie;
                if ($this->user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user()
                    ];
                    Mail::to($email_admin)->send(new ConfirmationEmail($data)); // Ajout de l'email en copie
                }
            }
        } else {
            if ($this->permission == "Responsable departement") {
                $hierachie = $this->departement->hierachie;
                
                if ($this->user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user()
                    ];
                    Mail::to($email_admin)->send(new ConfirmationEmail($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Membre") {
                $hierachie = $this->filiale->hierachie;

                if ($this->user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $responsable = $this->departement->hierachie; 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user(),
                        'ccEmail' => $email_admin
                    ];
                    Mail::to($email)->cc($email_admin)->send(new ConfirmationEmail($data)); // Ajout de l'email en copie
                }
            } else {
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');
        
                $data = [
                    'Auth_user' => Auth::user(),
                    'ccEmail' => $email_admin,
                ];
                Mail::to($email_admin)->send(new ConfirmationEmail($data)); // Ajout de l'email en copie
            }
        }

        $this->dispatch("successEvent",[]);   
        return redirect()->route('Accueil');
    }
}
