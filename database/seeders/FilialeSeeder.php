<?php

namespace Database\Seeders;

use App\Models\Filiale;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FilialeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exemple de données de test
        Filiale::create([
            'slug' => 'filiale-1',
            'nom' => 'Nom de la filiale 1',
            'logo' => 'chemin/vers/logo1.png',
            'email' => 'filiale1@example.com',
            'telephone' => '123456789',
            'adresse' => 'Adresse de la filiale 1',
            'hierachie' => 'Hierarchie de la filiale 1',
            'date_creation' => '2023-01-01',
            'description' => 'Description de la filiale 1',
            'status' => 'activer',
        ]);
    }
}
