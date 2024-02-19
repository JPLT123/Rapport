<?php

namespace App\Livewire\Planification;

use Artisan;
use Carbon\Carbon;
use App\Models\Tach;
use App\Models\User;
use App\Models\Filiale;
use Livewire\Component;
use App\Models\ImportFile;
use App\Models\PlantTache;
use App\Models\Essaiepivot;
use Illuminate\Support\Str;
use App\Models\Essaieplanif;
use App\Models\MembresProjet;
use App\Models\Planification;
use Livewire\WithFileUploads;
use App\Mail\ConfirmationEmail;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Create extends Component
{
    use WithFileUploads;
    
    public $ressources;
    public $resultat;
    public $hierachie;
    public $observation;
    public $id_planif;
    public $id_projet;
    public $date;
    public $filiale;
    public $departement;
    public $chef;
    public $projet;
    public $Alltaches;
    public $Auth_user;
    public $userRoles;
    public $file;
    public $email;
    public $tachesPrevues;
    public $taches = [];
    public $newtache = [];
    public $createtaches = []; 

    
    public function render()
    {
        
        // // Récupérer tous les IDs de la table essaiepivot
        // $essaiepivotIDs = PlantTache::pluck('id_tache');

        $usersQuery = Tach::whereIn('status', ['New'])
            // ->whereNotIn('id', $essaiepivotIDs)
            ;

        if ($this->projet) {
            $usersQuery->where('id_projet', $this->projet);
        }

        $this->Alltaches = $usersQuery->get();

        $this->Auth_user = Auth::user();

        $this->userRoles = $this->Auth_user->permissions->pluck('id_role')->toArray();
        $this->chef = User::where('status', 'activer')
                  ->where('id', '!=', $this->Auth_user->id)
                  ->get();

        $this->filiale = $this->Auth_user->filiale;

        $this->departement =  $this->Auth_user->departement;

        $formatStartDate = now()->startOfWeek()->addWeek()->format("l d/m/Y");
        $formatEndDate = now()->endOfWeek()->addWeek()->format("l d/m/Y");

        $formatDateRange = strtoupper($formatStartDate . " AU " . $formatEndDate);

        $planificationTerminee = PlanifHebdomadaire::where('id_user', $this->Auth_user->id)
            ->whereBetween('date', [$formatStartDate, $formatEndDate])
            ->exists();

        return view('livewire.planification.create',[
            "Alltaches" =>  $this->Alltaches,
            "Auth_user" => $this->Auth_user,
            "formatDateRange" => $formatDateRange,
            "planificationTerminee" => $planificationTerminee,
        ])->extends('layouts.guest')->section('content');
    }

    public function add()
    {
        $this->dispatch("show_Projet_modal");
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

    public function submitForm()
    {
        // Validation des champs
        $this->validate([
            'ressources' => 'required|string|max:255',
            'resultat' => 'required|string|max:255',
            'observation' => 'required|string|max:255',
            'projet' => 'required|exists:projets,id',
            'date' => ['required', 'date_format:Y-m-d', function ($attribute, $value, $fail) {
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();

                $selectedDate = Carbon::createFromFormat('Y-m-d', $value);

                if ($selectedDate->lt($startOfWeek) || $selectedDate->gt($endOfWeek)) {
                    $fail("La date doit être dans la semaine actuelle.");
                }
            }],
            'taches.*' => 'exists:taches,id',
        ]);

        $existingessaie = PlanifHebdomadaire::where('id_user', Auth::user()->id)
        ->where('date', $this->date)
        ->first();

        if (!$existingessaie) {
            if ($this->file !== null) {
                // Générez le slug à partir du nom d'utilisateur
                $username = preg_replace('/\s+/', '', Auth::user()->name);
                // Remplacez cela par le nom d'utilisateur réel
                $slug = generateUserSlug($username);

                // Dans votre méthode pour gérer le téléchargement de fichiers
                $filePath = $this->file->store('uploads');

                $date = Carbon::now()->toDateString();

                $file = ImportFile::create([
                    'id_user' => Auth::user()->id,
                    'nom_fichier' => 'fichier-joint-' . $date, // Utilisation de la date actuelle dans le nom du fichier
                    'links' => $filePath,
                ]);


                $planification = PlanifHebdomadaire::create([
                    'id_user' => Auth::user()->id,
                    'id_projet' => $this->projet,
                    'ressources_necessaires' => $this->ressources,
                    'resultat_attendus' => $this->resultat,
                    'observation' => $this->observation,
                    'date' => $this->date,
                    'importfile' => $file->id,
                    'slug' => $slug,
                ]);

                $permission = DB::table('users')
                ->join('permissions', 'users.id', '=', 'permissions.id_user')
                ->join('role', 'permissions.id_role', '=', 'role.id')
                ->where('users.id', Auth::user()->id)
                ->value('role.nom');

                
                $user = Auth::user();
                $dateActuelle = Carbon::now()->toDateString();
                
                if ($permission == "Employer") {
                    $Efiles = $file->id;

                    $Efile = ImportFile::find($Efiles); // Récupère le fichier avec l'ID spécifié
                    $filePath = storage_path('app/' . $Efile->links); // Obtient le chemin du fichier à partir de la propriété "links" de l'objet $Efile
                    
                    $this->email = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                        // Send email with attachment
                        Mail::raw("Email d'envoie de planification du consultant ".$user->name, function ($message) use ($filePath) {
                            $message->to($this->email)
                                    ->subject('Email de planification')
                                    ->attach($filePath);
                        });
    
                }
            } else {
                    
                // Générez le slug à partir du nom d'utilisateur
                $username = preg_replace('/\s+/', '', Auth::user()->name);
                // Remplacez cela par le nom d'utilisateur réel
                $slug = generateUserSlug($username);

                $planification = PlanifHebdomadaire::create([
                    'id_user' => Auth::user()->id,
                    'id_projet' => $this->projet,
                    'ressources_necessaires' => $this->ressources,
                    'resultat_attendus' => $this->resultat,
                    'observation' => $this->observation,
                    'date' => $this->date,
                    'slug' => $slug,
                    ]);

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

                    $this->newtache[] =$tache->id;

                    $this->taches[] = $tache->id;

                }

                foreach ($this->taches as $item) {
                
                    PlantTache::create([
                        'id_tache' => $item,
                        'id_planif' => $planification->id,
                        'id_user' => Auth::user()->id,
                    ]);
                }
                
                if ($this->newtache !== null) {
                    PlantTache::whereIn('id_tache', $this->newtache)->update([
                        'status' => true
                    ]);
                }
                Tach::whereIn('id', $this->taches)->update([
                    'status' => 'Attente'
                ]);
            }

        $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");
            
        } else {
            // Sinon, affichez un message d'erreur
            session()->flash('error', 'Vous avez déjà planifié une tâche pour cette date.');
        }

        // Réinitialisez les propriétés après la soumission réussie
        $this->taches = [];
        $this->createtaches = []; 
        $this->reset();
    }

}

