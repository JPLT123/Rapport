<?php

namespace Database\Seeders;

use App\Models\Tach;
use App\Models\PlantTache;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TacheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 150; $i++) {
            Tach::create([
                'slug' => "tache_projet1_$i",
                'tache_prevues' => "Tâche prévue $i pour projet",
                'id_projet' => rand(1,5)
            ]);
        }

        // for ($i = 1; $i <= 150; $i++) {
        //     PlantTache::create([
        //         'id_tache' => rand(1,150),
        //         'id_planif' => rand(1,100)
        //     ]);
        // }
    }
}
