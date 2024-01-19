<?php

namespace App\Livewire\Accueil;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class Dashboad extends Component
{
    public $code;
    public $email;
    public function mount()
    {
        $user = Auth::user(); // Récupère l'utilisateur authentifié

        // Assurez-vous que l'utilisateur est authentifié et que le champ 'verification_code' est à null
        if ($user && $user->status == 'activer') {
            if ($user->verification_code == null) {
                return redirect()->route('Accueil');
            }
        }else {
            if ($user->status == 'desactiver') {
                
                    return redirect()->route('SupprimerDesactiver');
                    
            }elseif($user->status == 'supprimer'){
                Auth::logout(); 
            }
        }

        if ($user) {
            $this->email = $user->email;
        }
    }

    public function render()
    {
        $user = Auth::user();

        if ($user && $user->status == 'attente') {
            return view('auth.verify-email')->extends('layouts.app')->section('content');
        }
    }

    public function verifyCode()
    {
        $this->validate([
            'code' => 'required|numeric',
        ]);
        
        $user = User::where('verification_code', $this->code)
                    ->first();
        
        if ($user) {
            // Mise à jour de l'utilisateur
            $name = $user->name;
            $newCode = mt_rand(100000, 999999);

            $user->update([
                'email_verified_at' => now(),
                'verification_code' => null,
                'status' => 'activer',
                'slug' => Str::slug($name . '-' . $newCode),
            ]);

            return redirect()->route('info-user');
        }

        throw ValidationException::withMessages(['code' => ['Code de vérification invalide.']]);
    }

    public function resendVerificationCode()
    {
        $user = auth()->user();
        $verificationCode = mt_rand(100000, 999999);

            // Stockez le code dans la base de données
        $user->update(['verification_code' => $verificationCode]);

            // Envoyez le code par e-mail
        Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            session()->flash('success', 'Nouveau code de vérification envoyé par e-mail.');
        
    }

}
