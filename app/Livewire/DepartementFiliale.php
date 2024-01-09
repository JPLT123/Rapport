<?php

namespace App\Livewire;

use App\Models\Filiale;
use Livewire\Component;
use App\Models\Departement;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DepartementFiliale extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    #[Url]
    public $search;
    public $status;
    public $nom;
    public $description;
    public $filiale;
    public $id_Departement;

    public function render()
    {
        $query = Departement::query()
                    ->where('nom', 'like', '%' . $this->search . '%')
                    ->whereIn("status", ['activer', 'desactiver']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $filiale = Filiale::where("status", 'activer')->get();
        $Departement = $query->with('filiale')->paginate(10);

        return view('livewire.departement', [
            "Departements" => $Departement,
            "filiales" => $filiale
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
            return; // Gérez le cas où Departement n'est pas trouvé.
        }
        if ($Departement->status === 'activer') {
            $Departement->update(['status' => 'desactiver']);

            $Users = $Departement->users;
            foreach ($Users as $user) {
                $user->update(['status' => 'desactiver']);
            }
            
        } else {
            $Departement->update(['status' => 'activer']);
    
            $Users = $Departement->users;
            foreach ($Users as $user) {
                $user->update(['status' => 'activer']);
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

        Departement::create([
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

        if ($Departement) { 

            $Departement->update([
                "nom" => $this->nom,
                "Description" => $this->description,
                "id_filiale" => $this->filiale,
            ]);

            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Departement non trouvée."]);
        }
    }
}
