<?php

namespace App\Helpers;

use App\Models\User;
use App\Mail\EnvoieRapport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    public static function RapportEmailMS()
    {
        $Auth_user = Auth::user();
        $filiale = $Auth_user->filiale;
        $departement =  $Auth_user->departement;

        $hierachie = $filiale->hierachie;
        if ($Auth_user->id !== $hierachie) {
            $email = User::where('id', $hierachie)->value('email'); 
            $responsable = $departement->hierachie;
            $email_responsable = User::where('id', $responsable)->value('email'); 
            $email_admin = User::where('status', 'activer')
                ->whereIn('id', function($query) {
                    $query->select('id_user')->from('permissions')->where('id_role', 1);
                })->value('email');

            $data = [
                'Auth_user' => $Auth_user,
                'ccEmail' => $email,
                'rapport' => $General->id
            ];
            Mail::to($email_responsable)->cc($email)->cc($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
        }
    }

    public static function RapportEmailRS()
    {
        $Auth_user = Auth::user();
        $filiale = $Auth_user->filiale;
        $hierachie = $filiale->hierachie;
            if ($Auth_user->id !== $hierachie) {
                $email = User::where('id', $hierachie)->value('email'); 
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');

                $data = [
                    'Auth_user' => $Auth_user,
                    'ccEmail' => $email_admin,
                    'rapport' => $General->id
                ];
                Mail::to($email)->cc($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
            }
    }

    public static function RapportEmailRF()
    {
        $Auth_user = Auth::user();
        $filiale = $Auth_user->filiale;

        $hierachie = $filiale->hierachie;
            if ($Auth_user->id == $hierachie) {
                $email_admin = User::where('status', 'activer')
                    ->whereIn('id', function($query) {
                        $query->select('id_user')->from('permissions')->where('id_role', 1);
                    })->value('email');

                $data = [
                    'Auth_user' => $Auth_user,
                    'rapport' => $General->id
                ];
                Mail::to($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
            }
    }
    
    public static function RapportEmailRD()
    {
        $Auth_user = Auth::user();
        $departement =  $Auth_user->service;

        $hierachie = $departement->hierachie;
        
        if ($Auth_user->id == $hierachie) {
            $email_admin = User::where('status', 'activer')
                ->whereIn('id', function($query) {
                    $query->select('id_user')->from('permissions')->where('id_role', 1);
                })->value('email');

            $data = [
                'Auth_user' => $Auth_user,
                'rapport' => $General->id
            ];
            Mail::to($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
        }
    }
    
    public static function RapportEmailMD()
    {
        $Auth_user = Auth::user();
        $departement = $Auth_user->service;

        $hierachie = $filiale->hierachie;

        if ($Auth_user->id !== $hierachie) {
            $email = User::where('id', $hierachie)->value('email'); 
            $responsable = $departement->hierachie; 
            $email_admin = User::where('status', 'activer')
                ->whereIn('id', function($query) {
                    $query->select('id_user')->from('permissions')->where('id_role', 1);
                })->value('email');

            $data = [
                'Auth_user' => $Auth_user,
                'ccEmail' => $email_admin,
                'rapport' => $General->id
            ];
            Mail::to($email)->cc($email_admin)->send(new EnvoieRapport($data)); // Ajout de l'email en copie
        }
    }

}
