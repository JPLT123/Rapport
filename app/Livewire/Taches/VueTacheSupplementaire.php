<?php

namespace App\Livewire\Taches;

use App\Models\Projet;
use Livewire\Component;
use App\Models\TacheSupplementaire;

class VueTacheSupplementaire extends Component
{
    public $search;
    public $projet;
    public function render()
    {
        $taches_suplementaires = TacheSupplementaire::query()
            ->where('status', 'attente')
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
    
        if ($this->projet) {
            $taches_suplementaires->whereHas('tache', function ($query) {
                $query->where('id_projet', $this->projet);
            });
        }
    
        $taches_suplementaires = $taches_suplementaires->paginate(10);
    
        $projet = Projet::where('status','activer')->get();
        return view('livewire.taches.vue-tache-supplementaire', [
            "tache_supls" => $taches_suplementaires,
            "projets" => $projet
        ])->extends('layouts.guest')->section('content');
    }
    
}
