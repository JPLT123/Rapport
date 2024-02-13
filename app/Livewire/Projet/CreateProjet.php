<?php

namespace App\Livewire\Projet;

use App\Models\User;
use App\Models\Projet;

use App\Models\Filiale;
use App\Models\Service;
use Livewire\Component;
use App\Models\Departement;
use Illuminate\Support\Str;
use App\Models\MembresProjet;

class CreateProjet extends Component
{
    public $search;
    public $nom;
    public $description;
    public $filiale;
    public $datedebut;
    public $selectedFiliale;
    public $datefin;
    public $departement;
    public $service;
    public $Manager;
    public $membre = [];
    public $showFormOption1 = false;
    public $showFormOption2 = false;

    public function render()
    {
        $usersQuery = User::whereIn('status',[ 'activer','attente']);

        if ($this->departement) {
            $usersQuery->where('id_departement', $this->departement);
        }

        if ($this->filiale) {
            $usersQuery->where('id_filiale', $this->filiale);
        }

        if ($this->service) {
            $usersQuery->where('id_Service', $this->service);
        }

        $users = $usersQuery->get();

        $filiales = Filiale::where("status", 'activer')->get();

        $services = Service::where("status", 'activer')->get();
        
        $departementsQuery = Departement::where("status", 'activer');

        if ($this->filiale) {
            $departementsQuery->where('id_filiale', $this->filiale);
        }

        $departements = $departementsQuery->get();

        return view('livewire.projet.create-projet', [
            'filiales' => $filiales,
            'departements' => $departements,
            'users' => $users,
            'services' => $services,
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

    public function store()
    {
        $rules = [];

        if ($this->showFormOption1) {
            $rules = [
                "nom" => "required|string|max:255|unique:projets",
                "description" => "required|string|max:255",
                "service" => 'required|exists:filiales,id',
                "datedebut" => "required",
                "datefin" => "required",
                "membre.*" => 'exists:users,id',
            ];
        } elseif ($this->showFormOption2) {
            $rules = [
                "nom" => "required|string|max:255|unique:projets",
                "description" => "required|string|max:255",
                "filiale" => 'required|exists:filiales,id',
                "datedebut" => "required",
                "datefin" => "required",
                "membre.*" => 'exists:users,id',
            ];
        }
        $this->validate($rules);

        $slug = Str::slug('projet ' . '-' . $this->nom);

        $projet = Projet::create([
            "nom" => $this->nom,
            "description" => $this->description,
            "id_filiale" => $this->filiale,
            "service" => $this->service,
            "code" => $slug,
            "debutdate" => $this->datedebut,
            "findate" => $this->datefin
        ]);

        $projet->membres_projets_relation()->attach($this->membre);
        MembresProjet::where('id_user', $this->Manager)->update(["is_chef"=> true]);

        
        // Réinitialisez les propriétés après la soumission réussie
        $this->reset();
        $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");

    }

}
