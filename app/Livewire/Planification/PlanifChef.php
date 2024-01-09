<?php

namespace App\Livewire\Planification;

use App\Models\Tach;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Planification;
use Illuminate\Support\Facades\Auth;

class PlanifChef extends Component
{
    public $ressources;
    public $resultat;
    public $hierachie;
    public $observation;
    public $date;
    public $filiale;
    public $chef;
    public $departement;
    public $projet;
    public $Auth_user;
    public $taches = [];

    public function render()
    {
        $this->Auth_user = Auth::user();
        $this->filiale = $this->Auth_user->filiale;
        $this->chef = $this->Auth_user->membres_projets;
        $this->departement =  $this->Auth_user->departement;
        return view('livewire.planification.planif-chef')->extends('layouts.guest')->section('content');
    }

    public function addTache()
    {
        $this->taches[] = ['tache_prevues' => '', 'projet' => $this->projet];
    }

    public function removeTache($index)
    {
        unset($this->taches[$index]);
        $this->taches = array_values($this->taches);
    }

    public function submitForm()
    {
        $this->validate([
            'ressources' => 'required|string|max:255',
            'resultat' => 'required|string|max:255',
            'observation' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'taches.*.tache_prevues' => 'required|string|max:255|unique:taches,tache_prevues',
            'projet' => 'required|exists:projets,id',
        ]);

        $slug = Str::slug($this->date);
            $uniqueSlug = $slug;

            $count = 1;

            while (Planification::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $slug . '-' . $count;
                $count++;
            }

            foreach ($this->taches as $item) {
                $tache = Tach::create([
                    'tache_prevues' => $item['tache_prevues'],
                    'id_projet' => $item['projet'],
                    'slug' => $item['tache_prevues'],
                ]);
            }

            Planification::create([
                'id_user' => $this->Auth_user->id,
                'id_projet' => $this->projet,
                'ressources_necessaires' => $this->ressources,
                'resultat_attendus' => $this->resultat,
                'observation' => $this->observation,
                'hierachie' => $this->filiale->hierachie,
                'date' => $this->date,
                'slug' => $uniqueSlug,
            ]);


        $this->dispatch("showSuccessMessage",message:"Operations effectuer avec success");

        // Réinitialisez les propriétés après la soumission réussie
        $this->reset();
    }
}
