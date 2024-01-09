<?php

namespace App\Livewire;

use Livewire\Component;

class CompteDesactiver extends Component
{
    public function render()
    {
        return view('livewire.accueil.index')->extends('layouts.app')->section('content');
    }
}
