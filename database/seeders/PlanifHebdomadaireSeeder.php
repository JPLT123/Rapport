<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Assurez-vous d'avoir cette importation
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PlanifHebdomadaire;
use Carbon\Carbon;

class PlanifHebdomadaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    // Définissez la date de début
    $dateDebut = Carbon::now(); // Vous pouvez remplacer cela par une date spécifique

   // Limitez le nombre d'enregistrements à 100
$limiteEnregistrements = 100;

for ($i = 0; $i < $limiteEnregistrements; $i++) {
    $datePlanification = $dateDebut->copy()->addDays($i);

    // Créez la planification quotidienne
    PlanifHebdomadaire::create([
        'id_projet' => rand(1, 3), // Remplacez cela par la logique appropriée pour sélectionner un projet
        'id_user' => rand(1, 2), // Remplacez cela par la logique appropriée pour sélectionner un utilisateur
        'slug' => Str::slug('Nom du planif_' . $i) . '_' . $i,
        'nom' => 'Nom du planif_' . $i,
        'ressources_necessaires' => 'Ressources nécessaires ' . $i,
        'resultat_attendus' => 'Résultats attendus ' . $i,
        'observation' => 'Observation ' . $i,
        'date' => $datePlanification,
        'status' => 'attente', // Remplacez cela par la logique appropriée pour définir le statut
    ]);
}

    }
}
