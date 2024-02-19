<?php

namespace App\Livewire\Rapport;

use Carbon\Carbon;
use App\Models\Tach;
use App\Models\User;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Depenser;
use App\Models\ImportFile;
use App\Mail\EnvoieRapport;
use App\Helpers\EmailHelper;
use App\Models\Tacheprochain;
use Livewire\WithFileUploads;
use App\Models\Rapportgeneral;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RapportJournalier extends Component
{
    use WithFileUploads;

    public $files = [];
    public $taches = [];
    public $debutHeure;
    public $finHeure;
    public $lieu;
    public $materielsUtilises;
    public $designationDepenses;
    public $coutsReels;
    public $coutsPrevionnels;
    public $observation;
    public $observationDepenses;
    public $tachesSuplementaire;
    public $hierachie;
    public $filiale;
    public $duree;
    public $designationprochain;
    public $valeur;
    public $risques;
    public $departement;
    public $observationglobal;
    public $Auth_user;
    public $showFormOption1 = false;
    public $tacheId;
    public $projet;
    public $planifications;
    public $dateActuelle;
    public $Actuelleprojet;
    public $showFormOption2 = false;
    public $addtaches = [];
    public $Depenses = [];
    public $tachesProchain = [];
    public $tachesDemain = [];
    public $permission ;
    public $service ;
    public $rapport ;

    public function render()
    {
            $this->Auth_user = Auth::user();
            $this->filiale = $this->Auth_user->filiale;
            $this->departement =  $this->Auth_user->departement;
            $this->service =  $this->Auth_user->service;
            $this->permission = DB::table('users')
                ->join('permissions', 'users.id', '=', 'permissions.id_user')
                ->join('role', 'permissions.id_role', '=', 'role.id')
                ->where('users.id', Auth::user()->id)
                ->value('role.nom');

            $this->planifications =  $this->Auth_user->planif_hebdomadaires()
                ->where('status', 'Approved')
                ->whereDate('date', Carbon::today())
                ->get();

            $planification = $this->Auth_user->planif_hebdomadaires()
            ->where('status', 'Approved')
            ->where(function ($query) {
                $query->whereDate('date', '<', Carbon::today())
                    ->orWhereDate('date', '=', Carbon::tomorrow());
            })
            ->get();            
            
        return view('livewire.rapport.rapport-journalier', [
            "planifs" => $this->planifications,
            "planification" => $planification
        ])->extends('layouts.guest')->section('content');
    }

        
    public function Ajoutaches()
    {
        $this->addtaches[] = [
            'tachesSuplementaire' => '',
            'debutHeure' => '',
            'finHeure' => '',
            'lieu' => '',
        ];
    }

    public function tachesplus()
    {
        $this->tachesDemain[] = [
            'taches' => '',
            'duree' => '',
            'designation' => '',
            'valeur' => '',
        ];
    }

    public function removetachesplus($index)
    {
        unset($this->tachesDemain[$index]);
        $this->tachesDemain = array_values($this->tachesDemain);
    }

    
    public function removetaches($index)
    {
        unset($this->addtaches[$index]);
        $this->addtaches = array_values($this->addtaches);
    }

    public function showFormForOption2()
    {
        $this->showFormOption2 = !$this->showFormOption2;
    }
    
    public function showFormForOption1()
    {
        // Inverse l'état de l'affichage du formulaire
        $this->showFormOption1 = !$this->showFormOption1;
        
        // Si le formulaire est désactivé, supprime toutes les dépenses
        if (!$this->showFormOption1) {
            $this->remove();
        }
    }
    
    // Méthode pour supprimer toutes les dépenses
    public function remove()
    {
        $this->Depenses = [];
    }
    

    public function addDepenses()
    {
        $this->Depenses[] = [
            'designationDepenses' => '',
            'coutsReels' => '',
            'coutsPrevionnels' => '',
            'observationDepenses' => '',
            'tacheId' => '',
        ];
    }

    public function removeDepenses($index)
    {
        unset($this->Depenses[$index]);
        $this->Depenses = array_values($this->Depenses);

    }

    public function save()
    {
        $this->validate([
            'materielsUtilises' => 'required|string|max:255',
            'observation' => 'required|string|max:255',
            'observationglobal' => 'required|string|max:255',
            'taches.*.debutHeure' => 'required|date_format:H:i',
            'taches.*.finHeure' => 'required|date_format:H:i',
            'taches.*.lieu' => 'required|string|max:255',
            'tachesProchain.*.duree' => 'required|string|max:255',
            'risques' => 'required|string|max:255',
        ]);
// dd('ok');
        // Obtenez la date actuelle
        $this->dateActuelle = Carbon::now()->toDateString();
        $user = $this->Auth_user->id;

        $General = Rapportgeneral::create([
            'date' => $this->dateActuelle,
            'materiels_utiliser' => $this->materielsUtilises,
            'observation' => $this->observation,
            'observationglobal' => $this->observationglobal,
            'id_user' => $user,
        ]);

        foreach ($this->taches as $id => $tache) {
            if (isset($tache['isChecked']) ) {
                $this->rapport = Rapport::create([
                    'id_tache' => $id,
                    'debut_heure' => $tache['debutHeure'],
                    'fin_heure' => $tache['finHeure'],
                    'lieu' => $tache['lieu'],
                    'general' => $General->id,
                ]);
        
                Tach::where('id', $id)->update([
                    'status' => 'Terminer'
                ]);  
            }
        }
        
        // $projet = $rapport->tach->id;
        // dd($projet);
        if ($this->rapport !== null) {
            $this->Actuelleprojet = $this->rapport->tach->id_projet;
        }
        if ($this->permission == 'Employer') {
            
            foreach ($this->addtaches as $item) {
                // Générez le slug à partir du nom d'utilisateur
                $username = preg_replace('/\s+/', '', Auth::user()->name);
                // Remplacez cela par le nom d'utilisateur réel
                $slug = generateUserSlug($username);
            
                $tache = Tach::create([
                    'tache_prevues' => $item['tachesSuplementaire'],
                    'status' => 'Terminer',
                    'id_projet' => $item['projet'],
                    'slug' =>  $slug
                ]);  
                
        
                Rapport::create([
                    'tache_suplementaire' => $tache->id,
                    'debut_heure' => $item['debutHeure'],
                    'fin_heure' => $item['finHeure'],
                    'lieu' => $item['lieu'],
                    'general' => $General->id,
                ]);

                
                foreach ($this->Depenses as $item) {
                    // $this->validate([
                    //     'designationDepenses' => 'required|string|max:255',
                    //     'coutsReels' => 'required|string|max:255',
                    //     'observationglobal' => 'required|string|max:255',
                    //     'coutsPrevionnels' => 'required|date_format:H:i',
                    //     'observationDepenses' => 'required|date_format:H:i',
                    //     'tacheId' => 'required|string|max:255',
                    // ]);

                    
                    // Générez le slug à partir du nom d'utilisateur
                    $username = preg_replace('/\s+/', '', Auth::user()->name);
                    // Remplacez cela par le nom d'utilisateur réel
                    $slug = generateUserSlug($username);

                    Depenser::create([
                        'slug' => $slug,
                        'Designation' => $item['designationDepenses'],
                        'CoutReel' => $item['coutsReels'],
                        'Coutprevisionnel' => $item['coutsPrevionnels'],
                        'observation' => $item['observationDepenses'],
                        'id_tache' =>  $tache->id
                    ]);
                } 
            }
            foreach ($this->files as $file) {
                $filename = $file->store('uploads'); // Sauvegarde le fichier dans le dossier "uploads" (ajustez selon vos besoins)

                ImportFile::create([
                    'id_user' => $user,
                    'rapport' => $General->id,
                    'nom_fichier' => 'fichier-joint-'.$this->dateActuelle,
                    'links' => $filename,
                ]);
            }       
             
            foreach ($this->tachesDemain as $id => $tache) {
                Tacheprochain::create([
                    'taches' =>$tache['taches'],
                    'duree' => $tache['duree'],
                    'designation' => $tache['designation'],
                    'valeur' => $tache['valeur'],
                    'rapport' => $General->id,
                    'risques' => $this->risques
                ]);
                
            }
        } else {
            
            foreach ($this->addtaches as $item) {
                // Générez le slug à partir du nom d'utilisateur
                $username = preg_replace('/\s+/', '', Auth::user()->name);
                // Remplacez cela par le nom d'utilisateur réel
                $slug = generateUserSlug($username);
            
                $tache = Tach::create([
                    'tache_prevues' => $item['tachesSuplementaire'],
                    'status' => 'Terminer',
                    'id_projet' => $this->projet,
                    'slug' =>  $slug
                ]); 
                
        
                Rapport::create([
                    'tache_suplementaire' => $tache->id,
                    'debut_heure' => $item['debutHeure'],
                    'fin_heure' => $item['finHeure'],
                    'lieu' => $item['lieu'],
                    'general' => $General->id,
                ]);

            }
            foreach ($this->files as $file) {
                $filename = $file->store('uploads'); // Sauvegarde le fichier dans le dossier "uploads" (ajustez selon vos besoins)

                ImportFile::create([
                    'id_user' => $user,
                    'rapport' => $General->id,
                    'nom_fichier' => 'fichier-joint-'.$this->dateActuelle,
                    'links' => $filename,
                ]);
            }       
            
            foreach ($this->Depenses as $item) {
                // $this->validate([
                //     'designationDepenses' => 'required|string|max:255',
                //     'coutsReels' => 'required|string|max:255',
                //     'observationglobal' => 'required|string|max:255',
                //     'coutsPrevionnels' => 'required|date_format:H:i',
                //     'observationDepenses' => 'required|date_format:H:i',
                //     'tacheId' => 'required|string|max:255',
                // ]);

                
                // Générez le slug à partir du nom d'utilisateur
                $username = preg_replace('/\s+/', '', Auth::user()->name);
                // Remplacez cela par le nom d'utilisateur réel
                $slug = generateUserSlug($username);

                Depenser::create([
                    'slug' => $slug,
                    'Designation' => $item['designationDepenses'],
                    'CoutReel' => $item['coutsReels'],
                    'Coutprevisionnel' => $item['coutsPrevionnels'],
                    'observation' => $item['observationDepenses'],
                    'id_tache' => $item['tacheId']
                ]);
            }  
            
            
            foreach ($this->tachesProchain as $id => $tache) {
                if ($tache['isChecked']) {
                    if ($this->showFormOption2 != null) {
                        Tacheprochain::create([
                            'taches' => $id, // Utilisez $id pour obtenir l'ID de la tâche
                            'duree' => $tache['duree'],
                            'designation' => $this->designationprochain,
                            'valeur' => $this->valeur,
                            'rapport' => $General->id,
                            'risques' => $this->risques
                        ]); 
                    } else {
                        Tacheprochain::create([
                            'taches' => $id, // Utilisez $id pour obtenir l'ID de la tâche
                            'duree' => $tache['duree'],
                            'designation' => "Il n'y a pas de désignation spécifiée",
                            'valeur' => "Il n'y a pas de valeur spécifiée",
                            'rapport' => $General->id,
                            'risques' => $this->risques
                        ]); 
                    }
                }
                
            }
        }
      
        if ($this->Auth_user->id_departement !== null) {
            if ($this->permission == "Membre") {
                $Auth_user = Auth::user();
                $filiale = $Auth_user->filiale;
                $departement =  $Auth_user->departement;

                $hierachie = $filiale->hierachie;
                if ($Auth_user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $responsable = $departement->hierachie;
                    $email_responsable = User::where('id', $responsable)->value('email'); 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => $Auth_user,
                        'ccEmail' => $email,
                        'rapport' => $General->id
                    ];
                    Mail::to($email_responsable)->cc($email)->cc($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Responsable service") {
                
                $Auth_user = Auth::user();
                $filiale = $Auth_user->filiale;
                $hierachie = $filiale->hierachie;
                if ($Auth_user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => $Auth_user,
                        'ccEmail' => $email_admin,
                        'rapport' => $General->id
                    ];
                    Mail::to($email)->cc($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Responsable") {
                $Auth_user = Auth::user();
                $filiale = $Auth_user->filiale;

                $hierachie = $filiale->hierachie;
                if ($Auth_user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => $Auth_user,
                        'rapport' => $General->id
                    ];
                    Mail::to($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
                }
            }else {
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');
        
                $data = [
                    'Auth_user' => Auth::user(),
                    'rapport' => $General->id,
                    'ccEmail' => $email_admin,
                ];
                Mail::to($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
            }
        } else {
            if ($this->permission == "Responsable departement") {  
                $Auth_user = Auth::user();
                $departement =  $Auth_user->service;

                $hierachie = $departement->hierachie;
                
                if ($Auth_user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => $Auth_user,
                        'rapport' => $General->id
                    ];
                    Mail::to($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
                }
            } elseif ($this->permission == "Membre") {   
                $Auth_user = Auth::user();
                $departement = $Auth_user->service;

                $hierachie = $filiale->hierachie;

                if ($Auth_user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $responsable = $departement->hierachie; 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    $data = [
                        'Auth_user' => $Auth_user,
                        'ccEmail' => $email_admin,
                        'rapport' => $General->id
                    ];
                    Mail::to($email)->cc($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
                }
            } else {
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');
        
                $data = [
                    'Auth_user' => Auth::user(),
                    'ccEmail' => $email_admin,
                    'rapport' => $General->id
                ];
                Mail::to($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
            }
        }
        
        
        $this->files = [];
        $this->taches = [];
        $this->tachesProchain = [];
        $this->addtaches = [];
        $this->reset();

        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  
    }


    // public function submitForm()
    // {
    //     $this->validate([

    //         'tachesDemain' => 'required|string|max:255',
    //         'duree' => 'required|date_format:H:i',
    //         'designationprochain' => 'required|string|max:255',
    //         'valeur' => 'required|string|max:255',
    //         'risques' => 'required|string|max:255',
    //         'tachesRealisees' => 'required',
    //         'debutHeure' => 'required|date_format:H:i',
    //         'finHeure' => 'required|date_format:H:i',
    //         'lieu' => 'required|string|max:255',
    //         'materielsUtilises' => 'required|string|max:255',
    //         'observation' => 'required|string|max:255',
    //         'observationglobal' => 'required|string|max:255',
    //         'tacheId' => 'required',
            
    //     ]);

    //     // Obtenez la date actuelle
    //     $this->dateActuelle = Carbon::now()->toDateString();

    //     $Tachedemain = Tacheprochain::create([
    //         'taches' => $this->tachesDemain,
    //         'duree' => $this->duree,
    //         'designation' => $this->designationprochain,
    //         'valeur' => $this->valeur,
    //         'risques' => $this->risques,
    //     ]);

    //     $Tachedemain1 = [];

    //     foreach ($this->tachesProchain as $item) {
    //         // Ajoutez chaque Tacheprochain à votre tableau $Tachedemain1
    //         $Tachedemain1[] = Tacheprochain::create([
    //             'taches' => $item['tachesDemain'],
    //             'duree' => $item['duree'],
    //             'designation' => $item['designationprochain'],
    //             'valeur' => $item['valeur'],
    //             'risques' => $item['risques'],
    //         ]);
    //     }
    //     $TachedemainId = $Tachedemain->id;

    //     $user = $this->Auth_user->id;

    //     $rapport = Rapport::create([
    //         'tache_realiser' => $this->tachesRealisees,
    //         'tache_suplementaire' => $this->tachesSuplementaire,
    //         'debut_heure' => $this->debutHeure,
    //         'fin_heure' => $this->finHeure,
    //         'lieu' => $this->lieu,
    //         'date' => $this->dateActuelle,
    //         'materiels_utiliser' => $this->materielsUtilises,
    //         'observation' => $this->observation,
    //         'observationglobal' => $this->observationglobal,
    //         'id_tache' => $this->tacheId,
    //         'id_prochain_tache' => $TachedemainId,
    //         'id_user' => $user,
    //     ]);

    //     Tach::where('id', $this->tacheId)->update([
    //         'status' => 'Terminer'
    //     ]);

    //     foreach ($this->addtaches as $item) {
    //         $rapport1 = Rapport::create([
    //             'tache_realiser' => $item['tachesRealisees'],
    //             'tache_suplementaire' => $item['tachesSuplementaire'],
    //             'debut_heure' => $item['debutHeure'],
    //             'fin_heure' => $item['finHeure'],
    //             'lieu' => $item['lieu'],
    //             'date' => $this->dateActuelle,
    //             'materiels_utiliser' => $item['materielsUtilises'],
    //             'observation' => $item['observation'],
    //             'observationglobal' => $item['observationglobal'],
    //             'id_tache' =>  $item['tacheId'],
    //             'id_prochain_tache' => null, // Valeur par défaut
    //             'id_user' => $user,
    //         ]);

    //         // Utilisez la valeur correcte de 'id_prochain_tache' pour mettre à jour Rapport
    //         if (count($Tachedemain1) > 0) {
    //             $rapport1->update(['id_prochain_tache' => $Tachedemain1[0]->id]);
    //         }else{
    //             $rapport1->update(['id_prochain_tache' => $TachedemainId]);
    //         }

    //         Tach::where('id', $item['tacheId'])->update([
    //             'status' => 'Terminer'
    //         ]);            
    //     }

    //     $rapportId = $rapport->id;

    //     foreach ($this->files as $file) {
    //         $filename = $file->store('uploads'); // Sauvegarde le fichier dans le dossier "uploads" (ajustez selon vos besoins)

    //         ImportFile::create([
    //             'id_user' => $user,
    //             'id_rapport' => $rapportId,
    //             'nom_fichier' => 'fichier-joint-'.$this->dateActuelle,
    //             'links' => $filename,
    //         ]);
    //     }       
        
    //     foreach ($this->Depenses as $item) {
    //         Depenser::create([
    //             'Designation' => $item['designationDepenses'],
    //             'CoutReel' => $item['coutsReels'],
    //             'Coutprevisionnel' => $item['coutsPrevionnels'],
    //             'observation' => $item['observationDepenses'],
    //             'id_tache' => $this->tacheId,
    //         ]);
    //     }

    //     $this->hierachie = $this->filiale->hierachie;
    //     if ($this->Auth_user->id !== $this->hierachie) {
    //         $user = User::find($this->hierachie);
    //         $data = [
    //             'Auth_user' => $this->Auth_user,
    //         ];
    //         $email = $user->email;
    //         Mail::to($email)->send(new EnvoieRapport($data)); 
    //     } 
            
    //     $this->files = [];
    //     $this->reset();

    //     $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");  
    // }
}
