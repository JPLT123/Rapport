<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Depenser;

class AfficheRapport extends Component
{
    public $dateActuelle;
    public $user;
    public $rapports;

    public function mount($slug)
    {
        $this->user = User::where('slug', $slug)->first();
    }

    public function render()
    {
        $this->dateActuelle = Carbon::now()->toDateString();

        $this->rapports = Rapport::where('id_user', $this->user->id)
                            ->where('date',$this->dateActuelle)->get();

        $taches = $this->rapports->pluck('id_tache')->toArray();

        // Utilisez la méthode 'whereIn' pour chercher les enregistrements avec des valeurs dans un tableau
        $this->depenses = Depenser::whereIn('id_tache', $taches)->get();

        return view('livewire.affiche-rapport', [
            "user" => $this->user,
            "rapports" => $this->rapports,
            "depenses" => $this->depenses,
        ])->extends('layouts.app')->section('content');
    }

    public function getContent()
    {
        return view('livewire.contenu-pdf', [
            'user' => $this->user,
            'rapports' => $this->rapports,
            'depenses' => $this->depenses,
        ])->render();
    }
}
