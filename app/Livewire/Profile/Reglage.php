<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class Reglage extends Component
{
    public function render()
    {
        return view('livewire.profile.Reglage')->extends('layouts.app')->section('content');
    }
}
