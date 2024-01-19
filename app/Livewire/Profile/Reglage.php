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

        if ($this->edit_images == null) {
            $this->user->update([
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
            $this->user->update([
                "name" => $this->nom,
                "email" => $this->email,
                "profile_photo_path" => $image,
            ]);
        }
        
    }

    public function updatePassword()
    {
        $user = Auth::user();

        Auth::logout();
        if ($user) {
            $user->logout();
        }

        return redirect()->route('change-password');
    }
}
