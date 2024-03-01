<?php

namespace App\Livewire\Projet;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Projet;
use App\Models\Filiale;
use Livewire\Component;
use App\Mail\UrgenceProjet;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Models\MembresProjet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ListeProjet extends Component
{
    #[Url]
    public $search;
    #[Url]
    public $status;
    public $nom;
    public $description;
    public $membre  = [];
    public $newmembre = [];
    public $filiale;
    #[Url]
    public $filiale_id;
    public $id_Projet;
    public $users;
    public $manager;
    public $userRoles;
    public $dateActuelle;
    public $usersnewMembres = [];
    public $membreprojet = [];

    public function render()
    {
        
        $Authuser = Auth::user();
        $this->userRoles = $Authuser->permissions->pluck('id_role')->toArray();

        if (in_array(6, $this->userRoles)) {
            $query = Projet::query()
            ->where('service', $Authuser->id_Service)
            ->where('nom', 'like', '%' . $this->search . '%');
        }elseif (in_array(2, $this->userRoles)) {
            $query = Projet::query()
            ->where('id_filiale', $Authuser->id_filiale)
            ->where('nom', 'like', '%' . $this->search . '%');
        }elseif (in_array(5, $this->userRoles)) {
            $query = Projet::query()
            ->where('id_filiale', $Authuser->id_filiale)
            ->where('nom', 'like', '%' . $this->search . '%');
        }else {
            $query = Projet::query()
            ->where('nom', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->filiale_id) {
            $query->where('id_filiale', $this->filiale_id);
        }
        
        $projets = $query->with('filiale')->paginate(9);
        $filiale = Filiale::where("status", 'activer')->get();
        $this->users = User::where('id_filiale', $this->filiale)->get();
        $this->dateActuelle = Carbon::now()->toDateString();

        foreach ($projets as $projet) {
            $completedTasksCount = $projet->compterTachesTerminees()->count();
            $totalTasksCount = $projet->taches()->count();
            $completionPercentage = ($totalTasksCount > 0) ? ($completedTasksCount / $totalTasksCount) * 100 : 0;
    
            if ($totalTasksCount > 0) {
                if ($projet->urgence == true && $projet->status !== 'Suspendu'  && $completionPercentage !== 100) {
                $projet->update([
                    'status' => 'urgence'
                ]);
            } elseif ($completionPercentage == 100) {
                    $projet->update([
                        'status' => 'Terminer'
                    ]);
                } elseif ($projet->status !== 'Suspendu' && $projet->findate >= $this->dateActuelle && $completionPercentage !== 100) {
                    $projet->update([
                        'status' => 'activer'
                    ]);
                } elseif ($projet->status !== 'Suspendu' && $projet->findate <= $this->dateActuelle && $completionPercentage !== 100) {
                    $projet->update([
                        'status' => 'Retard'
                    ]);
                } elseif ($projet->status !== 'Suspendu' && $projet->findate > $this->dateActuelle && $completionPercentage == 100) {
                    $projet->update([
                        'status' => 'Avance'
                    ]);
                }elseif ($projet->status == 'Suspendu') {
                    $projet->update([
                        'status' => 'Suspendu'
                    ]);
                }
            } else {
               if ($projet->status !== 'Suspendu') {
                $projet->update([
                    'status' => 'attente'
                ]);
               }
            }
        }
        return view('livewire.projet.liste-projet', [
            "projets" => $projets,
            "filiales" => $filiale,
            "users" => $this->users,
            "dateActuelle" =>$this->dateActuelle
        ])->extends('layouts.guest')->section('content');
    }
    
    public function ModalEdite(){
        $this->dispatch('closeModal', []);
        $this->reset( 'status');
    }
    
    public function confirmationDelete($slug, $fonctions = null, $message = null)
    {
        $this->dispatch("confirmation",
            fonction: $fonctions ? $fonctions : 'delete',
            id: $slug,
            text: $message ? $message : 'Voulez-vous vraiment supprimer ?',
        );
    }
    
    #[on('delete')]
    public function delete($slug)
    {
        // Recherche de l'utilisateur en fonction du slug
        $Projet = Projet::where('code', $slug)->first();
    
        if (!$Projet) {
            // L'utilisateur n'a pas été trouvé, gérer l'erreur ici
            $this->dispatch("showWarningMessage", ["message" => "Utilisateur non trouvé."]);
            return;
        }
        // Suppression de l'utilisateur
        $Projet->update([
            "status" => "supprimer"
        ]);
        // Affiche un message de succès
            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
    }
    
    public function confirmation($slug, $fonctions = null, $message = null)
    {
        $this->dispatch("confirmation",
            fonction: $fonctions ? $fonctions : 'toggleStatus',
            id: $slug,
            text: $message ? $message : 'De vouloir suspendre le projet ?',
        );
    }
    
    #[on('toggleStatus')]
    public function toggleStatus($slug)
    {
        $Projet = Projet::where('code', $slug)->first();
    
        if (!$Projet) {
            return; // Gérez le cas où l'utilisateur n'est pas trouvé.
        }
        if ($Projet->status !== 'Suspendu') {
            $Projet->update(['status' => 'Suspendu']);
            
        } else {
            $Projet->update(['status' => 'activer']);
    
        }
    }
    
    public function edite($slug)
    {
        $projet = Projet::where('code', $slug)->first();
    
        if ($projet) {
            $this->nom = $projet->nom;
            $this->description = $projet->description;
            $this->id_Projet = $projet->code;
            $this->filiale = $projet->id_filiale;
            $this->membre = $projet->membres_projets->where('status','activer');
            $members = $projet->membres_projets->where('status','activer')->pluck('id_user');
            $this->newmembre = User::where('id_filiale',  $this->filiale)->whereNotIn('id', $members)->get();

            $this->dispatch("show_Projet_modal");
        }
    }    

    public function update()
    {
        
        $this->validate([
            "nom" => "required|string|max:255",
            "description" => "required|string|max:255",
            "usersnewMembres.*" => 'exists:users,id', 
        ]);
       
        $projet = Projet::where('code', $this->id_Projet)->first();
       
        if ($projet) { 
            // Mettez à jour les propriétés du projet
            $projet->update([
                "nom" => $this->nom,
                "description" => $this->description,
            ]);

            
        // Obtenez les IDs des membres d'équipe actuellement associés au projet avec le statut 'activer'
        $enseignesActuels = $projet->membres_projets->where('status', 'activer')->pluck('id_user')->toArray();

        // Mettez à jour le statut des membres actuels qui ne sont plus membres du projet à "desactiver" pour ce projet spécifique
        MembresProjet::where('id_projet', $projet->id)
            ->whereNotIn('id_user', $this->usersnewMembres) // Exclut les nouveaux membres
            ->update(['status' => 'desactiver']);

        // Mettez à jour is_chef à false pour les membres actuels qui ne font plus partie de l'équipe
        MembresProjet::where('id_projet', $projet->id)
            ->whereNotIn('id_user', $this->usersnewMembres) // Exclut les nouveaux membres
            ->update(["is_chef" => false]);

        // Ajoutez les nouveaux membres au projet avec le statut 'activer' par défaut
        foreach ($this->usersnewMembres as $enseigneId) {
            // Vérifiez si le membre est déjà actif dans l'enseigne groupe
            $membreActifDansEnseigneGroupe = in_array($enseigneId, $enseignesActuels);

            // Mettez à jour le statut et is_chef en fonction du membre
            MembresProjet::updateOrCreate(
                ['id_projet' => $projet->id, 'id_user' => $enseigneId],
                ['status' => 'activer', 'is_chef' => ($membreActifDansEnseigneGroupe) ? false : true]
            );

            // Mettez à jour is_chef à false pour les nouveaux membres ajoutés
            MembresProjet::where('id_user', $enseigneId)->update(["is_chef" => false]);
        }

        // Mettez à jour is_chef à true pour le manager
        MembresProjet::where('id_projet', $projet->id)
            ->where('id_user', $this->manager)
            ->update(["is_chef" => true]);


            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Projet non trouvé."]);
        }
    }

    public function Urgence($slug)
    {
        $projet = Projet::where('code', $slug)->first();
    
        if ($projet) {
            $this->id_Projet = $projet->code;
            $this->membre = $projet->membres_projets->where('status','activer');
            $members = $projet->membres_projets->where('status','activer')->pluck('id_user');
            $this->newmembre = User::whereNotIn('id', $members)->get();

            $this->dispatch("show_Projet_urgence_modal");
        }
    }

    
    public function UrgenceUpdate()
    {
        
        $this->validate([
            "usersnewMembres.*" => 'exists:users,id', 
        ]);
       
        $projet = Projet::where('code', $this->id_Projet)->first();

        if ($projet) { 

            $projet->update([
                "status" => 'urgence',
                "urgence" => true,
            ]);
        // Obtenez les IDs des membres d'équipe actuellement associés au projet avec le statut 'activer'
        $enseignesActuels = $projet->membres_projets->where('status', 'activer')->pluck('id_user')->toArray();

        // Mettez à jour le statut des membres actuels qui ne sont plus membres du projet à "desactiver" pour ce projet spécifique
        MembresProjet::where('id_projet', $projet->id)
            ->whereNotIn('id_user', $this->usersnewMembres) // Exclut les nouveaux membres
            ->update(['status' => 'desactiver']);

        // Mettez à jour is_chef à false pour les membres actuels qui ne font plus partie de l'équipe
        MembresProjet::where('id_projet', $projet->id)
            ->whereNotIn('id_user', $this->usersnewMembres) // Exclut les nouveaux membres
            ->update(["is_chef" => false]);

        // Ajoutez les nouveaux membres au projet avec le statut 'activer' par défaut
        foreach ($this->usersnewMembres as $enseigneId) {
            // Vérifiez si le membre est déjà actif dans l'enseigne groupe
            $membreActifDansEnseigneGroupe = in_array($enseigneId, $enseignesActuels);

            // Mettez à jour le statut et is_chef en fonction du membre
            MembresProjet::updateOrCreate(
                ['id_projet' => $projet->id, 'id_user' => $enseigneId],
                ['status' => 'activer', 'is_chef' => ($membreActifDansEnseigneGroupe) ? false : true]
            );

            // Mettez à jour is_chef à false pour les nouveaux membres ajoutés
            MembresProjet::where('id_user', $enseigneId)->update(["is_chef" => false]);

        }

        // Mettez à jour is_chef à true pour le manager
        MembresProjet::where('id_projet', $projet->id)
            ->where('id_user', $this->manager)
            ->update(["is_chef" => true]);

        $EmailUsers = User::whereIn('id',$this->usersnewMembres)->get();
        $responsable = User::find($this->manager);
        foreach ($EmailUsers as $EmailUser) {
            $data = [
                'name' => $EmailUser->name,
                'projet' => $projet->nom,
                'responsable' => $responsable->name
            ];
            Mail::to($EmailUser->email)->send(new UrgenceProjet($data));
        }
            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Projet non trouvé."]);
        }
    }
}
