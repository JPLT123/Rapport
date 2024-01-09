<?php

namespace App\Livewire\GestionUtilisateur;

use App\Models\Filiale;
use Livewire\Component;
use App\Models\Permission;
use App\Models\Departement;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AuthUser extends Component
{
    use WithFileUploads;
    
    public $filiale;
    public $telephone;
    public $adresse;
    public $images;
    public $departement;

    public function render()
    {
        $filiale = Filiale::where("status", 'activer')->get();

        $departementsQuery = Departement::where("status", 'activer');

        if ($this->filiale) {
            $departementsQuery->where('id_filiale', $this->filiale);
        }

        $departements = $departementsQuery->get();

        return view('livewire.gestion-utilisateur.auth-user', [
            "filiales" => $filiale,
            "departements" => $departements
        ])->extends('layouts.app')->section('content');
    }

    public function update()
    {
        $this->validate([
            'adresse' => 'required',
            "telephone" => ['required','unique:users'],
            'filiale' => 'required',
            'departement' => 'required',
        ]);

        $user = Auth::user();
        
        if ($this->images) {
            $image = $this->images->store('images/users','public');
        }

        if ($user) { 
            $user->update([
                "telephone" => $this->telephone,
                "adresse" => $this->adresse,
                "id_filiale" => $this->filiale,
                "id_departement" => $this->departement,
                "profile_photo_path" => $image ?? null
            ]);

            
            return redirect()->route('Accueil');
        } else {
            $this->dispatch("showWarningMessage", ["message" => "Utilisateur non trouvé."]);
        }
    }
}
