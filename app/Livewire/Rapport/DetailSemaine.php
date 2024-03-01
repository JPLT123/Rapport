<?php

namespace App\Livewire\Rapport;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\RapportSemaine;
use App\Mail\EmailRapportSemaine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DetailSemaine extends Component
{
    public $semaine;
    public $permission;
    public $Auth_user;
    public $objet;
    public $realisation;
    public $difficulter;
    public $recommandation;
    public $budget;
    public $datedebut;
    public $datefin;

    public function mount($slug)
    {
        $this->semaine = RapportSemaine::where('slug', $slug)->first();
    }

    public function render()
    {
        $dateActuelle = Carbon::now();
        
        return view('livewire.rapport.detail-semaine',[
            "semaine"=>$this->semaine,
            "dateActuelle"=>$dateActuelle
        ])->extends('layouts.guest')->section('content');
    }

    public function Envoie()
    {
        $this->Auth_user = Auth::user();

        $data = [
            'Auth_user' => $this->Auth_user,
            'rapport' => $this->semaine->slug
        ];

        $this->permission = DB::table('users')
            ->join('permissions', 'users.id', '=', 'permissions.id_user')
            ->join('role', 'permissions.id_role', '=', 'role.id')
            ->where('users.id', Auth::user()->id)
            ->value('role.nom');
            
        if ($this->Auth_user->id_departement !== null) {
            if ($this->permission == "Responsable service") {
                
                $filiale = $this->Auth_user->filiale;
                $hierachie = $filiale->hierachie;
                if ($this->Auth_user->id !== $hierachie) {
                    $email = User::where('id', $hierachie)->value('email'); 
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');
                    
                    Mail::to($email)->cc($email_admin)->send(new EmailRapportSemaine($data));
                }
            } elseif ($this->permission == "Responsable") {

                $filiale = $this->Auth_user->filiale;
                $hierachie = $filiale->hierachie;
                if ($this->Auth_user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    Mail::to($email_admin)->send(new EmailRapportSemaine($data));
                }
            } else {
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');
        
                Mail::to($email_admin)->send(new EmailRapportSemaine($data));
            }
        } else {
            if ($this->permission == "Responsable departement") {  

                $departement =  $this->Auth_user->service;

                $hierachie = $departement->hierachie;
                
                if ($this->Auth_user->id == $hierachie) {
                    $email_admin = User::where('status', 'activer')
                        ->whereIn('id', function($query) {
                            $query->select('id_user')->from('permissions')->where('id_role', 1);
                        })->value('email');

                    Mail::to($email_admin)->send(new EmailRapportSemaine($data));
                }
            } else {
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');
        
                Mail::to($email_admin)->send(new EmailRapportSemaine($data));
            }
        }

        $this->dispatch("showSuccessMessage", ["message" => "Opérations effectuées avec succès"]);  
        return redirect()->route('Accueil');
    }

    public function Open( $slug)
    {
        $semaine = RapportSemaine::where('slug', $slug)->first();
        
        $this->objet = $semaine->objet;
        $this->realisation = $semaine->realisation;
        $this->difficulter = $semaine->difficulte;
        $this->recommandation = $semaine->recommandation;
        $this->budget = $semaine->budget;
        $this->datedebut = $semaine->debutdate;
        $this->datefin = $semaine->findate;

        $this->dispatch('closeModalAdd', []);
    }

    public function close()
    {
        $this->dispatch('closeModal', []);
    }

    public function Edit()
    {
        $this->semaine->update([
            'objet' => $this->objet,
            'realisation' => $this->realisation,
            'difficulte' => $this->difficulter,
            'recommandation' => $this->recommandation,
            'budget' => $this->budget,
        ]);
    }
}
