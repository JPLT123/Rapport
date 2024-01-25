<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('projets')->insert([
                'id_filiale' => 1, // Remplacez 10 par le nombre maximum d'ID de filiales dans votre table 'filiales'
                'nom' => 'Projet ' . $i,
                'code' => 'PRJ00' . $i,
                'description' => 'Description du projet Lorem ipsum dolor sit amet consectetur
                 adipisicing elit.
                 deleniti perferendis natus molestiae! Cumque nihil impedit distinctio!' . $i,
                'debutdate' => now(),
                'findate' => now()->addDays(30), // Date de fin dans 30 jours
                'status' => $i % 2 == 0 ? 'Terminer' : 'attente', // Alterne entre 'Terminer' et 'attente'
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            
        }
    }
}
