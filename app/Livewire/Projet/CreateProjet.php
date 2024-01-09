<?php

namespace App\Livewire\Projet;

use Livewire\Component;
use App\Models\MembresProjet;

use Illuminate\Support\Str;
use App\Models\Projet;
use App\Models\Filiale;
use App\Models\Departement;
use App\Models\User;

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
    public $Manager;
    public $membre = [];

    public function render()
    {
        $usersQuery = User::whereIn('status',[ 'activer','attente']);

        if ($this->departement) {
            $usersQuery->where('id_departement', $this->departement);
        }

        if ($this->filiale) {
            $usersQuery->where('id_filiale', $this->filiale);
        }

        $users = $usersQuery->get();

        $filiales = Filiale::where("status", 'activer')->get();
        
        $departementsQuery = Departement::where("status", 'activer');

        if ($this->filiale) {
            $departementsQuery->where('id_filiale', $this->filiale);
        }

        $departements = $departementsQuery->get();

        return view('livewire.projet.create-projet', [
            'filiales' => $filiales,
            'departements' => $departements,
            'users' => $users,
        ])->extends('layouts.guest')->section('content');
    }


    public function store()
    {
        $this->validate([
            "nom" => "required|string|max:255|unique:projets",
            "description" => "required|string|max:255",
            "filiale" => 'required|exists:filiales,id',
            "datedebut" => "required",
            "datefin" => "required",
            "membre.*" => 'exists:users,id', // Validez que les membres sélectionnés existent
        ]);

        $slug = Str::slug('projet ' . '-' . $this->nom);

        $projet = Projet::create([
            "nom" => $this->nom,
            "description" => $this->description,
            "id_filiale" => $this->filiale,
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
