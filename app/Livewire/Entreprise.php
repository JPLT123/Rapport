<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Filiale;
use Livewire\Component;
use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Entreprise extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    #[Url]
    public $search;
    public $status;
    public $nom;
    public $description;
    public $images;
    public $date;
    public $email;
    public $telephone;
    public $adresse;
    public $id_Filiale;
    public $path_image;
    public $edit_images;
    public $Departements;
    public $responsable;

    public function render()
    {
        $query = Filiale::query()
                    ->where('nom', 'like', '%' . $this->search . '%')
                    ->whereIn("status", ['activer', 'desactiver']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $Filiale = $query->paginate(8);

        $Auth_user = Auth::user();
        
        $this->chef = User::where('status', 'activer')
          ->where('id', '!=', $Auth_user->id)
          ->get();

        return view('livewire.filiale', [
            "Filiales" => $Filiale,
            "chef" =>$this->chef
        ])->extends('layouts.guest')->section('content');
    }

    public function ModalAdd(){
        $this->reset('nom','description','date','email','telephone','adresse','images','responsable');
    
        $this->dispatch('closeModalAdd', []);
    }
    
    public function ModalEdite(){
        $this->reset('nom','description','date','email','telephone','adresse','responsable');
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
        // Recherche de l'utilisateur en fonction du slug
        $Filiale = Filiale::where('slug', $slug)->first();
    
        if (!$Filiale) {
            // L'utilisateur n'a pas été trouvé, gérer l'erreur ici
            $this->dispatch("showWarningMessage", ["message" => "Utilisateur non trouvé."]);
            return;
        }
        // Suppression de l'utilisateur
        $Filiale->update([
            "status" => "supprimer"
        ]);

        //supprimer les departement du filiale
        $Departements = $Filiale->departements;
            foreach ($Departements as $Departement) {
                $Departement->update(['status' => 'supprimer']);
            }

        //supprimer les Projets du filiale
        $Projets = $Filiale->projets;
        foreach ($Projets as $Projet) {
            $Projet->update(['status' => 'supprimer']);
        }

        //supprimer les users du filiale
        $Users = $Filiale->users;
            foreach ($Users as $user) {
                $user->update(['status' => 'supprimer']);
            }

        // Affiche un message de succès
        $this->dispatch("showSuccessMessage", ["message" => "Utilisateur supprimé avec succès."]);
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
        $Filiale = Filiale::where('slug', $slug)->first();
    
        if (!$Filiale) {
            return; // Gérez le cas où l'utilisateur n'est pas trouvé.
        }
        if ($Filiale->status === 'activer') {
            $Filiale->update(['status' => 'desactiver']);
            
            $Departements = $Filiale->departements;
            foreach ($Departements as $Departement) {
                $Departement->update(['status' => 'desactiver']);
            }

            $Projets = $Filiale->projets;
            foreach ($Projets as $Projet) {
                $Projet->update(['status' => 'Suspendu']);
            }

            $users = $Filiale->users;
            foreach ($users as $user) {
                $user->update(['status' => 'desactiver']);
            }

        } else {
            $Filiale->update(['status' => 'activer']);

            $Departements = $Filiale->departements;
            foreach ($Departements as $Departement) {
                $Departement->update(['status' => 'activer']);
            }

            $Projets = $Filiale->projets;
            foreach ($Projets as $Projet) {
                $Projet->update(['status' => 'activer']);
            }

            $users = $Filiale->users;
            foreach ($users as $user) {
                $user->update(['status' => 'activer']);
            }
        }
    }
    
    public function store(){
        $this->validate([
            "nom" => "required|string|max:255|unique:filiales",
            "description" => "required|string|max:255",
            "adresse" => "required|max:255",
            "responsable" => "required|max:255",
            "email" => "required|email|unique:filiales",
            "telephone" => "required|numeric|unique:filiales",
            "date" => "required",
            "images" => "image|max:2000|mimes:png,jpg,jpeg",
        ]);

        $image = $this->images->store('images/filiales','public');

        $slug = Str::slug('filiale '.$this->nom);

        Filiale::create([
            "nom" => $this->nom,
            "description" => $this->description,
            "email" => $this->email,
            "telephone" => $this->telephone,
            "adresse" => $this->adresse,
            "date_creation" => $this->date,
            "hierachie" => $this->responsable,
            "logo" => $image,
            "slug" => $slug
        ]);

        Permission::create([
            "id_user" => $this->responsable,
            "id_role" => 2,
        ]);

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");
        $this->ModalAdd();

    }

    public function edite($slug)
    {
        $Filiale = Filiale::where('slug', $slug)->first();

        if ($Filiale) {
            $this->id_Filiale = $Filiale->slug;
            $this->nom = $Filiale->nom;
            $this->description = $Filiale->description;
            $this->date = $Filiale->date_creation;
            $this->email = $Filiale->email;
            $this->telephone = $Filiale->telephone;
            $this->adresse = $Filiale->adresse;
            $this->responsable = $Filiale->hierachie;
            $this->edit_images = $Filiale->logo;

            $this->dispatch("showModalEdite");
        }
    }

    public function update()
    {
        $this->validate([
            "nom" => "required|string|max:255",
            "description" => "required|string|max:255",
        ]);

        $Filiale = Filiale::where('slug', $this->id_Filiale)->first();

        if ($Filiale) { 
            if ($this->path_image == null) {
    
                $Filiale->update([
                    "nom" => $this->nom,
                    "description" => $this->description,
                    "email" => $this->email,
                    "telephone" => $this->telephone,
                    "adresse" => $this->adresse,
                    "date_creation" => $this->date,
                    "hierachie" => $this->responsable,
                ]);
            } else {
                $filename = basename($this->edit_images);

                if ($filename) {
                    // Supprimez le fichier du répertoire de stockage
                    Storage::disk('public')->delete('images/filiales/' . $filename);
                    $Filiale->update(['logo' => null]);
                }
                $image = $this->path_image->store('images/filiales','public');
                $Filiale->update([
                    "nom" => $this->nom,
                    "description" => $this->description,
                    "email" => $this->email,
                    "telephone" => $this->telephone,
                    "adresse" => $this->adresse,
                    "date_creation" => $this->date,
                    "hierachie" => $this->responsable,
                    "logo" => $image,
                ]);
                
            }

            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Catégorie non trouvée."]);
        }
    }

}
