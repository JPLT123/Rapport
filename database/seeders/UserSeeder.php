<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Filiale;
use App\Models\Permission;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filiale = Filiale::first(); // Obtenez une filiale existante pour l'associer à un utilisateur
        $departement = Departement::first(); // Obtenez un département existant pour l'associer à un utilisateur

        $user = User::create([
            'slug' => 'lala-diallo-1',
            'name' => 'lala diallo',
            'email' => 'admin@gmail.com',
            'telephone' => '123456789',
            'adresse' => 'Adresse de l\'utilisateur 1',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // Assurez-vous de définir un mot de passe approprié
            'remember_token' => Str::random(10),
            'current_team_id' => null, // Vous pouvez ajuster cela en fonction de votre application
            'profile_photo_path' => null,
            'verification_code' => '123456', // Vous pouvez ajuster cela en fonction de votre application
            'status' => 'attente',
            'id_filiale' => $filiale->id,
            'id_departement' => $departement->id,
        ]);

        Permission::create([
            'id_user' => $user->id,
            'id_role' => 1,
        ]);
    }
}
