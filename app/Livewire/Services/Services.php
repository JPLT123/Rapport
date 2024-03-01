<?php

namespace App\Livewire\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use Livewire\Component;
use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Services extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    #[Url]
    public $search;
    public $status;
    public $nom;
    public $description;
    public $id_Service;
    public $date;
    public $hierachie;
    public $membres=[];
    
    public function render()
    {
        $query = Service::query()
                    ->where('nom', 'like', '%' . $this->search . '%')
                    ->whereIn("status", ['activer', 'desactiver']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $service = $query->paginate(10);

        return view('livewire.services.service', [
            "services" => $service,
        ])->extends('layouts.guest')->section('content');

    }

    public function ModalAdd(){
        $this->reset('nom','description');
    
        $this->dispatch('closeModalAdd', []);
    }
    
    public function ModalEdite(){
        $this->reset('nom','description');
        $this->dispatch('closeModal', []);
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
        // Recherche de Service en fonction du slug
        $Service = Service::where('slug', $slug)->first();
    
        if (!$Service) {
            // Service n'a pas été trouvé, gérer l'erreur ici
            $this->dispatch("showWarningMessage", ["message" => "Service non trouvé."]);
            return;
        }
        // Suppression de Service
        $Service->update([
            "status" => "supprimer"
        ]);

        //supprimer les users du Service
        $Users = $Service->users;
        foreach ($Users as $user) {
            $roles = $user->roles->pluck('nom')->toArray(); 
            if (!in_array('Admin', $roles)) {
                $user->update(['status' => 'supprimer']);
            }
        }
        // Affiche un message de succès
        $this->dispatch("showSuccessMessage", ["message" => "Service supprimé avec succès."]);
    }
    
    public function confirmation($slug, $fonctions = null, $message = null)
    {
        $this->dispatch("confirmation",
            fonction: $fonctions ? $fonctions : 'toggleStatus',
            id: $slug,
            text: $message ? $message : 'De vouloir modifier ?',
        );
    }
    
    #[on('toggleStatus')]
    public function toggleStatus($slug)
    {
        $Service = Service::where('slug', $slug)->first();
    
        if (!$Service) {
            return; // Gérez le cas où le département n'est pas trouvé.
        }
        
        $nouveauStatut = ($Service->status === 'activer') ? 'desactiver' : 'activer';
        
        $Service->update(['status' => $nouveauStatut]);
        
        $utilisateurs = $Service->users;
        
        foreach ($utilisateurs as $utilisateur) {
            $utilisateur->update(['status' => $nouveauStatut]);
        }

        $Projets = $Service->projets;
        foreach ($Projets as $Projet) {
            $Projet->update(['status' => ($nouveauStatut === 'activer') ? 'activer' : 'Suspendu']);
        }

        $users = $Service->users;
        foreach ($users as $user) {
            $roles = $user->roles->pluck('nom')->toArray(); 
            if (!in_array('Admin', $roles)) {
                if ($user->status !== 'attente' && $user->status !== 'supprimer') {
                    $user->update(['status' => $nouveauStatut]);
                } 
            }
        } 
        
    }
    
    public function store(){
        $this->validate([
            "nom" => "required|string|max:255|unique:services",
            "description" => "required|string|max:255",
        ]);

        $slug = Str::slug('Service '.$this->nom);

        $Service = Service::create([
            "nom" => $this->nom,
            "Description" => $this->description,
            "slug" => $slug
        ]);

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");
        $this->ModalAdd();

    }

    public function edite($slug)
    {
        $Service = Service::where('slug', $slug)->first();

        if ($Service) {
            $this->id_Service = $Service->slug;
            $this->nom = $Service->nom;
            $this->description = $Service->Description;

            $this->dispatch("showModalEdite");
        }
    }

    public function update()
    {
        $this->validate([
            "nom" => "required|string|max:255",
            "description" => "required|string|max:255",
        ]);

        $Service = Service::where('slug', $this->id_Service)->first();

        if ($Service) { 

            $Service->update([
                "nom" => $this->nom,
                "Description" => $this->description,
            ]);

            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Service non trouvée."]);
        }
    }

    public function Viewservice($slug)
    {
        $service = Service::where('slug', $slug)->first();    
        if ($service) {
            $this->nom = $service->nom;
            $this->description = $service->Description;
            $this->date = $service->date_creation;
            $this->hierachie = $service->hierachie;
            $this->membres = $service->users->where('status', 'activer');
            $this->dispatch('show_user_modal', []);
        }

    }

    public function roles($userId)
    {
        $user = User::find($userId);
    
        if (!$user) {
            // Gérer le cas où l'utilisateur n'est pas trouvé
            return;
        }
    
        // Obtenir l'ID du rôle actuel de l'utilisateur
        $currentRoleId = $user->permissions->pluck('id_role')->first();
    
        if ($currentRoleId == 6) {
            // Mise à jour du rôle de l'utilisateur
            $user->permissions()->update(['id_role' => 4]);
            
            // Mise à jour uniquement des lignes liées à l'utilisateur
            $user->service->update(['hierachie' => null]);
    
        } elseif ($currentRoleId == 4) {
            // Rechercher l'utilisateur actuellement responsable
            $currentResponsible = $user->service->hierachie;
    
            if ($currentResponsible) {
                // Réduire le rôle de l'ancien responsable à membre
                Permission::where('id_user',$currentResponsible)->update(['id_role' => 4]);
                $user->service->update(['hierachie' => null]);
            }
    
            // Mettre à jour le rôle de l'utilisateur actuel à responsable
            $user->permissions()->update(['id_role' => 6]);
            $user->service->update(['hierachie' => $user->id]);
        }
    
        // Utilisez la méthode "dispatchNow" pour exécuter le job immédiatement
        $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
        $this->ModalEdite();
    }
    

    public function permission($lug)
    {
        $user = User::find($lug);

        if (!$user) {
            // Gérer le cas où l'utilisateur n'est pas trouvé
            return;
        }

        // Obtenir l'ID du rôle actuel de l'utilisateur
        $currentRoleId = $user->permissions->pluck('id_role')->first();
    
        if ($currentRoleId === 3) {
            $user->permissions()->update(['id_role' => 4]);
            
        } elseif ($currentRoleId === 4) {
            // Mettre à jour le rôle de l'utilisateur
            $user->permissions()->update(['id_role' => 3]);

        }

        $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
        $this->ModalEdite();
    }
}
