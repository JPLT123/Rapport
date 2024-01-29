<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Reglage extends Component
{
    use WithFileUploads;
    
    public $user;
    public $nom;
    public $email;
    public $telephone;
    public $adresse;
    public $edit_images;
    public $images;

    public function mount()
    {
        
        $this->user = Auth::user();
        $this->email = $this->user->email;
        $this->nom = $this->user->name;
        $this->telephone = $this->user->telephone;
        $this->adresse = $this->user->adresse;
        $this->images = $this->user->profile_photo_path;
    }
    public function render()
    {
        return view('livewire.profile.reglage',[
            "user" => $this->user
        ])->extends('layouts.app')->section('content');
    }

    public function update()
    {
        $this->validate([
            "nom" => "required|string|max:255",
            "adresse" => "required|max:255",
            "email" => "required|email|unique:users",
            "telephone" => ['required','regex:/^(00224|\+224)?(?:61|62|65|66)[0-9]{1}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}[-.\s]?[0-9]{2}$/','unique:users'],
        ]);
    

        if ($this->edit_images == null) {
            $updateResult = $this->user->update([
                "name" => $this->nom,
                "email" => $this->email,
                "telephone" => $this->telephone,
                "adresse" => $this->adresse,
            ]);
        } else {
            $filename = basename($this->user->profile_photo_path);

            if ($filename) {
                // Supprimez le fichier du répertoire de stockage
                Storage::disk('public')->delete('images/users/' . $filename);
                $this->user->update(['logo' => null]);
            }
            $image = $this->edit_images->store('images/users','public');
            $updateResult = $this->user->update([
                "name" => $this->nom,
                "email" => $this->email,
                "profile_photo_path" => $image,
            ]);
        }

        if ($updateResult) {
            // Mise à jour réussie, affichez un message de confirmation
            session()->flash('success', 'Tâche supprimer avec succès!');
        } else {
            // La supprimer a échoué, affichez un message d'erreur
            session()->flash('error', 'La suppression de la tâche a échoué.');
        }
        
    }

    public function updatePassword()
    {
        
        Auth::guard('web')->logout();
        return redirect()->route('password.email');

    }
}
