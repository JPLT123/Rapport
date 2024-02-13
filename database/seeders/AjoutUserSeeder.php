<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Filiale;
use App\Models\Permission;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AjoutUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    // Obtenez une filiale existante pour l'associer à un utilisateur
    $filiale = Filiale::first();

    // Obtenez un département existant pour l'associer à un utilisateur
    $departement = Departement::first();

    for ($i = 1; $i <= 12; $i++) {
        $user = User::create([
            'slug' => 'lala-diallo2-' . $i,
            'name' => 'lala diallo ' . $i,
            'email' => 'admin' . $i . '@gmail.com',
            'telephone' => '123456789' . $i,
            'adresse' => 'Adresse de l\'utilisateur ' . $i,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // Assurez-vous de définir un mot de passe approprié
            'remember_token' => Str::random(10),
            'current_team_id' => null, // Vous pouvez ajuster cela en fonction de votre application
            'profile_photo_path' => null,
            'verification_code' => null, // Vous pouvez ajuster cela en fonction de votre application
            'status' => 'activer',
            'id_filiale' => $filiale->id,
            'id_departement' => $departement->id,
        ]);

        Permission::create([
            'id_user' => $user->id,
            'id_role' => 4,
        ]);
    }

    }
}
