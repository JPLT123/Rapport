<?php

namespace App\Livewire\Taches;

use App\Models\Tach;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Planification;
use App\Mail\DemandeTacheEmail;
use Illuminate\Support\Facades\DB;
use App\Models\TacheSupplementaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FormTache extends Component
{
    public $description;
    public $justifier;
    public $hierachie;
    public $duree;
    public $date;
    public $filiale;
    public $impact;
    public $chef;
    public $departement;
    public $projet;
    public $service;
    public $Auth_user;
    public $permission;
    public $taches = [];

    public function render()
    {
        $this->Auth_user = Auth::user();
        $this->filiale = $this->Auth_user->filiale;
        $this->chef = $this->Auth_user->membres_projets;
        $this->departement =  $this->Auth_user->departement;
        $this->service =  $this->Auth_user->service;
        $this->permission = DB::table('users')
        ->join('permissions', 'users.id', '=', 'permissions.id_user')
        ->join('role', 'permissions.id_role', '=', 'role.id')
        ->where('users.id', Auth::user()->id)
        ->value('role.nom');
        return view('livewire.taches.form-tache')->extends('layouts.guest')->section('content');
    }

    public function addTache()
    {
        $this->taches[] = ['tache_prevues' => '','duree' => '', 'projet' => $this->projet];
    }

    public function removeTache($index)
    {
        unset($this->taches[$index]);
        $this->taches = array_values($this->taches);
    }

    public function submitForm()
    {
        $this->validate([
            'description' => 'required|string|max:255',
            'justifier' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'impact' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'taches.*.tache_prevues' => 'required|string|max:255',
            'projet' => 'required|exists:projets,id',
        ]);

        $taches_suplementaires = TacheSupplementaire::create([
            'description' => $this->description,
            'justification' => $this->justifier,
            'duree' => $this->duree,
            'impact' => $this->impact,
            'date' => $this->date,
            'id_user' => $this->Auth_user->id,
        ]);

        foreach ($this->taches as $index => $item) {

             // Générez le slug à partir du nom d'utilisateur
             $username = preg_replace('/\s+/', '', Auth::user()->name);
             // Remplacez cela par le nom d'utilisateur réel
            $slug = generateUserSlug($username);
            
            $tache = Tach::create([
                'tache_prevues' => $item['tache_prevues'],
                'id_projet' => $item['projet'],
                'taches_suplementaires' => $taches_suplementaires->id ,
                'status' => 'suplement',
                'slug' => $slug,
            ]);
        }

        
        if ($this->Auth_user->id_departement !== null) {
            if ($this->permission == "Membre") {
                $hierachie = $this->filiale->hierachie;
                if ($this->Auth_user->id !== $hierachie) {
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
                    Mail::to($email_responsable)->cc($email)->cc($email_admin)->send(new DemandeTacheEmail($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Responsable service") {
                $hierachie = $this->filiale->hierachie;
                if ($this->Auth_user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user(),
                        'ccEmail' => $email_admin
                    ];
                    Mail::to($email)->cc($email_admin)->send(new DemandeTacheEmail($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Responsable") {
                $hierachie = $this->filiale->hierachie;
                if ($this->Auth_user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user()
                    ];
                    Mail::to($email_admin)->send(new DemandeTacheEmail($data)); // Ajout de l'email en copie
                }
            }
        } else {
            if ($this->permission == "Responsable departement") {
                $hierachie = $this->departement->hierachie;
                
                if ($this->Auth_user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => Auth::user()
                    ];
                    Mail::to($email_admin)->send(new DemandeTacheEmail($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Membre") {
                $hierachie = $this->filiale->hierachie;

                if ($this->Auth_user->id !== $hierachie) {
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
                    Mail::to($email)->cc($email_admin)->send(new DemandeTacheEmail($data)); // Ajout de l'email en copie
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
                Mail::to($email_admin)->send(new DemandeTacheEmail($data)); // Ajout de l'email en copie
            }
        }
 
        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");

        // Réinitialisez les propriétés après la soumission réussie
        $this->reset();
    }
}
