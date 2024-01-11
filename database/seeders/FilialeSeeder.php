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
            'nom' => 'Elceto Holding',
            'logo' => null,
            'email' => 'filiale1@example.com',
            'telephone' => '666067007',
            'adresse' => 'Gbessia',
            'hierachie' => 1,
            'date_creation' => '2023-01-01',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, alias atque odit expedita non facere ut dolores distinctio dolore cum veritatis culpa excepturi aut officia provident incidunt nulla eius laborum.',
            'status' => 'activer',
        ]);
    }
}
