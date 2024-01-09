<?php

namespace App\Livewire\Taches;

use Livewire\Component;

class ListeTache extends Component
{
    public function render()
    {
        return view('livewire.taches.liste-tache')->extends('layouts.index')->extends('layouts.guest')->section('content');
    }
}
