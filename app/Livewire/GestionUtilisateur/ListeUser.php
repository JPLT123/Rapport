<?php

namespace App\Livewire\GestionUtilisateur;

use App\Models\Role;
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
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ListeUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    #[Url]
    public $search;
    #[Url]
    public $status;
    public $name;
    public $email;
    public $telephone;
    public $adresse;
    public $images;
    public $password = 12345678;
    public $date;
    public $filiale;
    public $departement;
    #[Url]
    public $filiale_id;
    public $role;
    public $id_user;

    public function render()
    {
        $query = User::query()
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->whereIn("status", ['activer', 'desactiver','attente']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->filiale_id) {
            $query->where('id_filiale', $this->filiale_id);
        }

        $user = $query->with('filiale')->paginate(10);

        $filiale = Filiale::where("status", 'activer')->get();

        $departementsQuery = Departement::where("status", 'activer');

        if ($this->filiale) {
            $departementsQuery->where('id_filiale', $this->filiale);
        }

        $departements = $departementsQuery->get();

        $role = Role::all();

        return view('livewire.gestion-utilisateur.liste-user', [
            "users" => $user,
            "filiales" => $filiale,
            "departements" => $departements,
            "roles" => $role
        ])->extends('layouts.guest')->section('content');
    }

    public function ModalAdd(){
        $this->reset('name','email','telephone','adresse','filiale');
    
        $this->dispatch('closeModalAdd', []);
    }
    
    public function ModalEdite(){
        
        $this->reset('name','email','telephone','adresse','filiale');
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
        $user = User::where('slug', $slug)->first();
    
        if (!$user) {
            // L'utilisateur n'a pas été trouvé, gérer l'erreur ici
            $this->dispatch("showWarningMessage", ["message" => "Utilisateur non trouvé."]);
            return;
        }
        // Suppression de l'utilisateur
        $user->update([
            "status" => "supprimer"
        ]);
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
        $user = User::where('slug', $slug)->first();
    
        if (!$user) {
            return; // Gérez le cas où l'utilisateur n'est pas trouvé.
        }
        if ($user->status === 'activer') {
            $user->update(['status' => 'desactiver']);
            
        } else {
        if ($user->verification_code) {
            $user->update(['status' => 'activer',
            'verification_code' => null]);
        } else {
            $user->update(['status' => 'activer']);
        }
    
        }
    }
    
    public function AddUser()
    {
        $this->validate([
            "name" => "required|string|max:255",
            "adresse" => "required|max:255",
            "email" => "required|email|unique:users",
            "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/','unique:users'],
            "filiale" => 'required|exists:filiales,id',
            "departement" => 'required|exists:departement,id',
            "role" => 'required|exists:role,id',
        ]);
    
        $slug = Str::slug($this->name . '-' .$this->telephone);
    
        $user = User::create([
            "name" => $this->name,
            "email" => $this->email,
            "telephone" => $this->telephone,
            "adresse" => $this->adresse,
            "id_filiale" => $this->filiale,
            "id_departement" => $this->departement,
            'verification_code' => mt_rand(100000, 999999),
            "slug" => $slug, 
            "password" => Hash::make($this->password),
        ]);

        Permission::create([
            'id_user' => $user->id,
            'id_role' => $this->role
        ]);
    
        Mail::to($user->email)->send(new VerificationCodeMail($user->verification_code));
    
        $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
        $this->ModalAdd();
    }
    
    public function edite($slug)
{
    $user = User::where('slug', $slug)->first();    
    if ($user) {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->telephone = $user->telephone;
        $this->adresse = $user->adresse;
        $this->filiale = $user->id_filiale; // Ajout de cette ligne pour initialiser la filiale
        $this->departement = $user->id_departement;
        $this->id_user = $user->slug; // Assurez-vous d'avoir la propriété id_user définie dans votre composant
        $this->dispatch('show_user_modal');
    }
}

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'adresse' => 'required',
            'email' => 'required|email',
            'filiale' => 'required',
            'departement' => 'required',
        ]);

        $user = User::where('slug', $this->id_user)->first();

        if ($user) { 
            $user->update([
                "name" => $this->name,
                "email" => $this->email,
                "telephone" => $this->telephone,
                "adresse" => $this->adresse,
                "id_filiale" => $this->filiale,
                "id_departement" => $this->departement,
            ]);

            if ($this->role) {
                Permission::where('id_user',$user->id)
                        ->update([
                            'id_role' => $this->role
                        ]);
            }

            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Utilisateur non trouvé."]);
        }
    }

}