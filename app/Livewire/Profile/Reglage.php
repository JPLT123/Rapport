<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class Reglage extends Component
{
    public $user;
    public $edit_images;

    public function render()
    {
        return view('livewire.profile.reglageUser')->extends('layouts.app')->section('content');
    }

    public function update()
    {
        $this->user = Auth::user();

        $filename = basename($this->user->profile_photo_path);

        if ($filename) {
            // Supprimez le fichier du répertoire de stockage
            Storage::disk('public')->delete('images/filiales/' . $filename);
            $this->user->update(['logo' => null]);
        }
        $image = $this->edit_images->store('images/users','public');
        $this->user->update([
            "profile_photo_path" => $image,
        ]);
    }
}
