<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Tach;
use App\Models\User;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Depenser;
use App\Models\Rapportgeneral;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AfficheRapport extends Component
{
    public $dateActuelle;
    public $user;
    public $rapports;
    public $permission;

    public function mount($slug)
    {
        $this->rapports = Rapportgeneral::find($slug);
    }

    public function render()
    {
        $this->dateActuelle = Carbon::now()->toDateString();

        $this->user = $this->rapports->user;
        $tache1 = $this->rapports->rapports->pluck('id_tache')->toArray();
        $tache2 = $this->rapports->rapports->pluck('tache_suplementaire')->toArray();
        $tache3 = $this->rapports->tacheprochains->pluck('taches')->toArray();
        
        $taches = Tach::whereIn('id', $tache1)
            ->get();
            
        $tachesuple = Tach::whereIn('id', $tache2)
                    ->get();

        $tacheprochain = Tach::whereIn('id', $tache3)
                    ->get();

        
        $this->permission = DB::table('users')
        ->join('permissions', 'users.id', '=', 'permissions.id_user')
        ->join('role', 'permissions.id_role', '=', 'role.id')
        ->where('users.id', Auth::user()->id)
        ->value('role.nom');

        if ($this->permission == 'Employer') {
                
            // Utilisez la méthode 'whereIn' pour chercher les enregistrements avec des valeurs dans un tableau
            $this->depenses = Depenser::whereIn('id_tache', $tache2)->get();
        } else {
                
            // Utilisez la méthode 'whereIn' pour chercher les enregistrements avec des valeurs dans un tableau
            $this->depenses = Depenser::whereIn('id_tache', $tache1)->get();
        }
        
        
        return view('livewire.affiche-rapport', [
            "user" => $this->user,
            "rapports" => $this->rapports,
            "depenses" => $this->depenses,
            "taches" => $taches,
            "tacheprochains" => $tacheprochain,
            "tachesuples" => $tachesuple,
        ])->extends('layouts.app')->section('content');
    }

    // public function getContent()
    // {
    //     return view('livewire.contenu-pdf', [
    //         'user' => $this->user,
    //         'rapports' => $this->rapports,
    //         'depenses' => $this->depenses,
    //     ])->render();
    // }
}
