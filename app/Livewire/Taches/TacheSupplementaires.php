<?php

namespace App\Livewire\Taches;

use Carbon\Carbon;
use App\Models\Tach;
use App\Models\User;
use Livewire\Component;
use App\Models\PlantTache;
use App\Mail\RejetTacheEmail;
use App\Models\PlanifHebdomadaire;
use Illuminate\Support\Facades\DB;
use App\Mail\ConfirmationChefEmail;
use App\Models\TacheSupplementaire;
use App\Mail\ConfirmationTacheEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TacheSupplementaires extends Component
{
    
    public $user;
    public $tachesupls;
    public $permission;

    public function mount($slug)
    {
        $this->tachesupls = TacheSupplementaire::find($slug);
    }

    public function render()
    {
        $this->user = User::find($this->tachesupls->id_user);
        $this->permission = DB::table('users')
                ->join('permissions', 'users.id', '=', 'permissions.id_user')
                ->join('role', 'permissions.id_role', '=', 'role.id')
                ->where('users.id', Auth::user()->id)
                ->value('role.nom');

        return view('livewire.taches.tache-supplementaires')->extends('layouts.guest')->section('content');
    }

    public function Reponse()
    {
        if ($this->tachesupls) {
            $this->tachesupls->update([
                'status' => 'approuver',
            ]);

            $dateActuelle = Carbon::now()->toDateString(); // Obtient la date actuelle au format 'YYYY-MM-DD'

            $data = [
                'user' => $this->user,
                'Auth_user'=> Auth::user()
            ];

            Mail::to($this->user->email)->send(new ConfirmationTacheEmail($data));    

            $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");
            return redirect()->route('Accueil');
        } else {
            
            $this->dispatch("showErrorMessage",[]);
        }

    }
    
    public function Rejeter()
    {
        if ($this->tachesupls) {
            $this->tachesupls->update([
                'status' => 'rejeter',
            ]);
            
            $data = [
                'user' => $this->user,
                'Auth_user'=> Auth::user()
            ];

            Mail::to($this->user->email)->send(new RejetTacheEmail($data));    
            
            $this->dispatch("showInfoMessage",message:"Operations effectuer avec success");
            return redirect()->route('Accueil');
        } else {
            
            $this->dispatch("showErrorMessage",[]);
        }
    }
}
