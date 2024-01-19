<?php

namespace App\Livewire\Taches;

use App\Models\Tach;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CreateTache extends Component
{
    public $taches = [];
    public $projet;

    public function render()
    {
        $this->Auth_user = Auth::user();
        $this->chef = $this->Auth_user->membres_projets;
        return view('livewire.taches.create-tache',[
            "chef" => $this->chef
        ])->extends('layouts.guest')->section('content');
    }

    public function addTaches()
    {
        $this->taches[] = ['tache_prevues' => '', 'projet' => ''];
    }

    public function removeTaches($index)
    {
        unset($this->taches[$index]);
        $this->taches = array_values($this->taches);
    }

    public function addTache()
    {
        $this->validate([
            'taches.*.tache_prevues' => 'required|string|max:255',
            'taches.*.projet' => 'required|exists:projets,id',
        ]);

        $count = 1;
        
        foreach ($this->taches as $item) {

            $slug = Str::slug('taches' . '-' . $count);

            // Assurez-vous que le slug est unique
            while (Tach::where('slug', $slug)->exists()) {
                $count++;
                $slug = Str::slug('taches' . '-' . $count);
            }
        
            Tach::create([
                'tache_prevues' => $item['tache_prevues'],
                'id_projet' => $item['projet'],
                'slug' => $slug,
            ]);

            $count++;
        }

        $this->dispatch("successEvent",message:"Operations effectuer avec success");

        // Réinitialisez les propriétés après la soumission réussie
        $this->reset();
    }
}

