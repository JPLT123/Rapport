<?php

namespace App\Livewire\Accueil;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('dashboard')->extends('layouts.guest')->section('content');
    }
}
