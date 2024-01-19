<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class ChangePassword extends Component
{
    public function render()
    {
        return view('livewire.profile.change-password')->extends('layouts.app')->section('content');
    }
}
