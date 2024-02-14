<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Filiale;
use Livewire\Component;
use App\Models\Permission;
use App\Models\Departement;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class DepartementFiliale extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    #[Url]
    public $search;
    public $status;
    public $nom;
    public $userRoles;
    public $description;
    public $filiale;
    public $id_Departement;
    public $chef;
    public $hierachie;
    public $membres;

    public function render()
    {
        $Authuser = Auth::user();
        $this->userRoles = $Authuser->roles->pluck('nom')->toArray(); 

        if (in_array('Responsable', $this->userRoles)) {

            $filialesResponsable = Filiale::where('hierachie',$Authuser->id)->pluck('id');
        
            $query = Departement::query()
                ->whereIn("id_filiale", $filialesResponsable)
                ->where('nom', 'like', '%' . $this->search . '%')
                ->whereIn("status", ['activer', 'desactiver']);
        }else{
            $query = Departement::query()
                ->where('nom', 'like', '%' . $this->search . '%')
                ->whereIn("status", ['activer', 'desactiver']);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $filiale = Filiale::where("status", 'activer')->get();

        $Departement = $query->with('filiale')->paginate(10);
        
        $user = User::where('status', 'activer');
        if ($this->filiale) {
            $user->where('id_filiale', $this->filiale);
        }

        $this->chef = $user->get();

        return view('livewire.departement', [
            "Departements" => $Departement,
            "filiales" => $filiale,
            "chef" =>$this->chef
        ])->extends('layouts.guest')->section('content');

    }

    public function ModalAdd(){
        $this->reset('nom','description','filiale');
    
        $this->dispatch('closeModalAdd', []);
    }
    
    public function ModalEdite(){
        $this->reset('nom','description','filiale');
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
        // Recherche de Departement en fonction du slug
        $Departement = Departement::where('slug', $slug)->first();
    
        if (!$Departement) {
            // Departement n'a pas été trouvé, gérer l'erreur ici
            $this->dispatch("showWarningMessage", ["message" => "Departement non trouvé."]);
            return;
        }
        // Suppression de Departement
        $Departement->update([
            "status" => "supprimer"
        ]);

        //supprimer les users du departement
        $Users = $Departement->users;
            foreach ($Users as $user) {
                $user->update(['status' => 'supprimer']);
            }

        // Affiche un message de succès
        $this->dispatch("showSuccessMessage", ["message" => "Departement supprimé avec succès."]);
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
        $Departement = Departement::where('slug', $slug)->first();
    
        if (!$Departement) {
            return; // Gérez le cas où le département n'est pas trouvé.
        }
        
        $nouveauStatut = ($Departement->status === 'activer') ? 'desactiver' : 'activer';
        
        $Departement->update(['status' => $nouveauStatut]);
        
        $utilisateurs = $Departement->utilisateurs;
        
        foreach ($utilisateurs as $utilisateur) {
            foreach ($utilisateur->roles as $role) {
                if ($role->nom !== 'Admin') {
                    $utilisateur->update(['status' => $nouveauStatut]);
                }
            }
        }
        
    }
    
    public function store(){
        $this->validate([
            "nom" => "required|string|max:255|unique:departement",
            "description" => "required|string|max:255",
            "filiale" => 'required|exists:filiales,id',
        ]);

        $slug = Str::slug('Departement '.$this->nom);

        $departement = Departement::create([
            "nom" => $this->nom,
            "Description" => $this->description,
            "id_filiale" => $this->filiale,
            "slug" => $slug
        ]);

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");
        $this->ModalAdd();

    }

    public function edite($slug)
    {
        $Departement = Departement::where('slug', $slug)->first();

        if ($Departement) {
            $this->id_Departement = $Departement->slug;
            $this->nom = $Departement->nom;
            $this->description = $Departement->Description;
            $this->responsable = $Departement->hierachie;
            $this->filiale = $Departement->id_filiale;

            $this->dispatch("showModalEdite");
        }
    }

    public function update()
    {
        $this->validate([
            "nom" => "required|string|max:255",
            "description" => "required|string|max:255",
            "filiale" => 'required|exists:filiales,id',
        ]);

        $Departement = Departement::where('slug', $this->id_Departement)->first();

        Permission::where("id_user", $Departement->hierachie)->update([
            "id_role" => 4,
        ]);

        if ($Departement) { 

            $Departement->update([
                "nom" => $this->nom,
                "Description" => $this->description,
                "id_filiale" => $this->filiale,
                "hierachie" => $this->responsable,
            ]);

            Permission::where("id_user", $this->responsable)->update([
                "id_role" => 5,
            ]);

            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Departement non trouvée."]);
        }
    }

    public function ViewDepartement($slug)
    {
        $Departement = Departement::where('slug', $slug)->first();    
        if ($Departement) {
            $this->nom = $Departement->nom;
            $this->description = $Departement->Description;
            $this->date = $Departement->date_creation;
            $this->hierachie = $Departement->hierachie;
            $this->membres = $Departement->utilisateurs()
                ->where('status', 'activer')
                ->whereHas('permissions', function ($query) {
                    $query->where('id_role', 4) // id_role 4 pour membre
                        ->orWhere('id_role', 5); // id_role 5 pour responsable de service
                })
                ->get();

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
    
        if ($currentRoleId == 5) {
            // Mise à jour du rôle de l'utilisateur
            $user->permissions()->update(['id_role' => 4]);
            
            // Mise à jour uniquement des lignes liées à l'utilisateur
            $user->departement->update(['hierachie' => null]);
    
        } elseif ($currentRoleId == 4) {
            // Rechercher l'utilisateur actuellement responsable
            $currentResponsible = $user->departement->hierachie;
    
            if ($currentResponsible) {
                // Réduire le rôle de l'ancien responsable à membre
                Permission::where('id_user',$currentResponsible)->update(['id_role' => 4]);
                $user->departement->update(['hierachie' => null]);
            }
    
            // Mettre à jour le rôle de l'utilisateur actuel à responsable
            $user->permissions()->update(['id_role' => 5]);
            $user->departement->update(['hierachie' => $user->id]);
        }
    
        // Utilisez la méthode "dispatchNow" pour exécuter le job immédiatement
        $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
        $this->ModalEdite();
    }
}
