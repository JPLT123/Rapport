<?php

namespace Database\Seeders;

use App\Models\Tach;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TacheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Tach::create([
                'slug' => "tache_projet1_$i",
                'tache_prevues' => "Tâche prévue $i pour projet 1",
                'status' => 'attente',
                'id_projet' => 1
            ]);
        }

        // Exemple pour l'ID de projet 2
        for ($i = 1; $i <= 20; $i++) {
            Tach::create([
                'slug' => "tache_projet2_$i",
                'tache_prevues' => "Tâche prévue $i pour projet 2",
                'status' => 'attente',
                'id_projet' => 2
            ]);
        }

        // Exemple pour l'ID de projet 3
        for ($i = 1; $i <= 20; $i++) {
            Tach::create([
                'slug' => "tache_projet3_$i",
                'tache_prevues' => "Tâche prévue $i pour projet 3",
                'status' => 'attente',
                'id_projet' => 3
            ]);
        }

        // Exemple pour l'ID de projet 4
        for ($i = 1; $i <= 20; $i++) {
            Tach::create([
                'slug' => "tache_projet4_$i",
                'tache_prevues' => "Tâche prévue $i pour projet 4",
                'status' => 'attente',
                'id_projet' => 4
            ]);
        }

        // Exemple pour l'ID de projet 5
        for ($i = 1; $i <= 20; $i++) {
            Tach::create([
                'slug' => "tache_projet5_$i",
                'tache_prevues' => "Tâche prévue $i pour projet 5",
                'status' => 'attente',
                'id_projet' => 5
            ]);
            }
    }
}
