<?php

namespace App\Livewire\GestionUtilisateur;

use App\Models\Role;
use App\Models\User;
use App\Models\Filiale;
use App\Models\Service;
use Livewire\Component;
use App\Models\Consultant;
use App\Models\Permission;
use App\Models\Departement;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Auth;
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
    public $service;
    public $userRoles;
    public $showFormOption1 = false;
    public $showFormOption2 = false;
    public $showFormOption3 = false;


    public function render()
    {
        $Authuser = Auth::user();
        $this->userRoles = $Authuser->permissions->pluck('id_role')->toArray();

        // Vérifiez si l'utilisateur a le rôle de Responsable
        if (in_array(6, $this->userRoles)) {
            $query = User::query()
            ->where('id_Service', $Authuser->id_Service)
            ->where('name', 'like', '%' . $this->search . '%')
            ->whereIn("status", ['activer', 'desactiver', 'attente']);
            
            if ($this->status) {
                $query->where('status', $this->status);
            }

            if ($this->filiale_id) {
                $query->where('id_filiale', $this->filiale_id);
            }

            $user = $query->paginate(10);
        }elseif (in_array(5, $this->userRoles)) {
                $query = User::query()
                ->where('id_filiale', $Authuser->id_filiale)
                ->where('id_departement', $Authuser->id_departement)
                ->where('name', 'like', '%' . $this->search . '%')
                ->whereIn("status", ['activer', 'desactiver', 'attente']);
                
                if ($this->status) {
                    $query->where('status', $this->status);
                }

                if ($this->filiale_id) {
                    $query->where('id_filiale', $this->filiale_id);
                }

                $user = $query->paginate(10);
        }elseif (in_array(2, $this->userRoles)) {
            // Récupérez les identifiants de filiales dont l'utilisateur est responsable
            $filialesResponsable = Filiale::where('hierachie',$Authuser->id)->pluck('id');
        
            // Récupérez les utilisateurs de toutes les filiales dont l'utilisateur est responsable
            $query = User::query()
                ->whereIn('id_filiale', $filialesResponsable)
                ->where('name', 'like', '%' . $this->search . '%')
                ->whereIn("status", ['activer', 'desactiver', 'attente']);
        
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
            ->where('name', 'like', '%' . $this->search . '%')
            ->whereIn("status", ['activer', 'desactiver', 'attente']);

            if ($this->status) {
                $query->where('status', $this->status);
            }

            if ($this->filiale_id) {
                $query->where('id_filiale', $this->filiale_id);
            }

            $user = $query->paginate(10);
        }

        $roles = Role::whereNotIn('nom', ['Employer', 'Chef projet','Admin'])->get();

        $filiale = Filiale::where("status", 'activer')->get();
        
        $services = Service::where("status", 'activer')->get();

        $departementsQuery = Departement::where("status", 'activer');

        if ($this->filiale) {
            $departementsQuery->where('id_filiale', $this->filiale);
        }

        $departements = $departementsQuery->get();

        // $role = Role::all();

        return view('livewire.gestion-utilisateur.liste-user', [
            "users" => $user,
            "filiales" => $filiale,
            "departements" => $departements,
            "roles" => $roles,
            "services" => $services
        ])->extends('layouts.guest')->section('content');
    }

    
    public function showFormForOption1()
    {
        $this->showFormOption1 = true;
        $this->showFormOption2 = false;
    }

    public function showFormForOption2()
    {
        $this->showFormOption1 = false;
        $this->showFormOption2 = true;
    }
    
    public function showFormForOption3()
    {
        $this->showFormOption3 = !$this->showFormOption3;
    }

    public function ModalAdd(){
        $this->showFormOption1 = false;
        $this->showFormOption2 = false;
        $this->showFormOption3 = false;
        $this->reset();
    
        $this->dispatch('closeModalAdd', []);
    }
    
    public function ModalEdite(){
        
        $this->showFormOption1 = false;
        $this->showFormOption2 = false;
        $this->showFormOption3 = false;
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
               $rules = [];

        if ($this->showFormOption1) {
            $rules = [
                "name" => "required|string|max:255",
                "adresse" => "required|max:255",
                "email" => "required|email|unique:users",
                "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/','unique:users'],
                "service" => 'required|exists:services,id',
            ];
        } elseif ($this->showFormOption2) {
            $rules = [
                "name" => "required|string|max:255",
                "adresse" => "required|max:255",
                "email" => "required|email|unique:users",
                "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/','unique:users'],
                "filiale" => 'required|exists:filiales,id',
                "departement" => 'required|exists:departement,id',
            ];
        }elseif ($this->showFormOption3) {
            if ($this->showFormOption1) {
                $rules = [
                    "name" => "required|string|max:255",
                    "adresse" => "required|max:255",
                    "email" => "required|email|unique:users",
                    "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/','unique:users'],
                    "service" => 'required|exists:services,id',
                    "role" => 'required|exists:role,id',
                ];
            } elseif ($this->showFormOption2) {
                $rules = [
                    "name" => "required|string|max:255",
                    "adresse" => "required|max:255",
                    "email" => "required|email|unique:users",
                    "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/','unique:users'],
                    "filiale" => 'required|exists:filiales,id',
                    "departement" => 'required|exists:departement,id',
                    "role" => 'required|exists:role,id',
                ];
            }
        }

        if (empty($rules)) {
            // Générer une erreur car les règles de validation ne sont pas définies
            $this->addError('rules', 'Choisissez une option pour la fonction.');
            return;
        }

        $this->validate($rules);
    
        $slug = Str::slug($this->name . '-' .$this->telephone);
    
        $user = User::create([
            "name" => $this->name,
            "email" => $this->email,
            "telephone" => $this->telephone,
            "adresse" => $this->adresse,
            "id_filiale" => $this->filiale,
            "id_Service" => $this->service,
            "id_departement" => $this->departement,
            'verification_code' => mt_rand(100000, 999999),
            "slug" => $slug, 
            "password" => Hash::make($this->password),
        ]);

        if ($this->showFormOption3) {
            $role = Permission::create([
                'id_user' => $user->id,
                'id_role' => 7
            ]);

            Consultant::create([
                'id_user' => $user->id,
                'id_role' => $this->role,
                'id_filiale' => $this->filiale,
                "id_service" => $this->service,
                "id_departement" => $this->departement,
            ]);
        } else {
            Permission::create([
                'id_user' => $user->id,
                'id_role' => 4
            ]);
        }
        
        
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
        $this->filiale = $user->id_filiale; 
        $this->departement = $user->id_departement;
        $this->service = $user->id_Service;
        $this->id_user = $user->slug; // Assurez-vous d'avoir la propriété id_user définie dans votre composant
        $this->dispatch('show_user_modal');
    }
}

    public function update()
    {
        $rules = [];

        if ($this->showFormOption1) {
            $rules = [
                "name" => "required|string|max:255",
                "adresse" => "required|max:255",
                "email" => "required|email",
                "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/'],
                "service" => 'required|exists:services,id',
            ];
        } elseif ($this->showFormOption2) {
            $rules = [
                "name" => "required|string|max:255",
                "adresse" => "required|max:255",
                "email" => "required|email",
                "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/'],
                "filiale" => 'required|exists:filiales,id',
                "departement" => 'required|exists:departement,id',
            ];
        }else{
            $rules = [
                "name" => "required|string|max:255",
                "adresse" => "required|max:255",
                "email" => "required|email",
                "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/'],
            ];
        }

        $this->validate($rules);

        $user = User::where('slug', $this->id_user)->first();

        if ($user) { 
            $dataToUpdate = [
                "name" => $this->name,
                "email" => $this->email,
                "telephone" => $this->telephone,
                "adresse" => $this->adresse,
            ];

            if ($this->showFormOption1) {
                $dataToUpdate["id_Service"] = $this->service;
                $dataToUpdate["id_filiale"] = null;
                $dataToUpdate["id_departement"] = null;
            } elseif ($this->showFormOption2) {
                $dataToUpdate["id_filiale"] = $this->filiale;
                $dataToUpdate["id_departement"] = $this->departement;
                $dataToUpdate["id_Service"] = null;

                // Vérifier si le champ "filiale" est rempli et que le service n'est pas null, alors mettez le service à null
                if (!empty($this->filiale) && !is_null($user->service)) {
                    $dataToUpdate["id_Service"] = null;
                }
            }

            $user->update($dataToUpdate);
                
            $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);
            $this->ModalEdite();
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Utilisateur non trouvé."]);
        }
    }

}