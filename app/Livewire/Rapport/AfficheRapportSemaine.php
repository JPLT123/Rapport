<?php

namespace App\Livewire\Rapport;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\RapportSemaine;

class AfficheRapportSemaine extends Component
{
    public $semaine;
    public $permission;
    public $Auth_user;

    public function mount($slug)
    {
        $this->semaine = RapportSemaine::where('slug', $slug)->first();
    }

    public function render()
    {
        $dateActuelle = Carbon::now();
        
        return view('livewire.rapport.affiche-rapport-semaine',[
            "semaine"=>$this->semaine,
            "dateActuelle"=>$dateActuelle
        ])->extends('layouts.app')->section('content');
    }
}
