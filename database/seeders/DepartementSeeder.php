<?php

namespace Database\Seeders;

use App\Models\Filiale;
use App\Models\Departement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exemple de données de test
        $filiale = Filiale::first(); // Obtenez une filiale existante pour l'associer à un département

        Departement::create([
            'id_filiale' => $filiale->id,
            'slug' => 'departement-1',
            'nom' => 'Gestion Administrative',
            'Description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, alias atque odit expedita non facere ut dolores distinctio dolore cum veritatis culpa excepturi aut officia provident incidunt nulla eius laborum.',
            'status' => 'activer',
        ]);
    }
}
