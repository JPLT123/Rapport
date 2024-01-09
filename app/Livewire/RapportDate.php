<?php

namespace App\Livewire;

use App\Models\Rapport;
use Livewire\Component;
use App\Models\Depenser;

class RapportDate extends Component
{
    public $dateActuelle;
    public $user;
    public $rapports;

    public function mount($slug)
    {
        $this->user = Rapport::find($slug);
    }

    public function render()
    {
        $this->dateActuelle = $this->user->date->toDateString();

        $this->rapports = Rapport::where('id_user', $this->user->id_user)
                            ->where('date',$this->dateActuelle)->get();

        $taches = $this->rapports->pluck('id_tache')->toArray();

        // Utilisez la méthode 'whereIn' pour chercher les enregistrements avec des valeurs dans un tableau
        $this->depenses = Depenser::whereIn('id_tache', $taches)->get();

        return view('livewire.rapport-date', [
            "user" => $this->user,
            "rapports" => $this->rapports,
            "depenses" => $this->depenses,
        ])->extends('layouts.app')->section('content');
    }
}
