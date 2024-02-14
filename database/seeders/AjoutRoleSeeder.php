<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AjoutRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nom' => 'Responsable service',
            'description' => 'responsable du service',
        ]);

        Role::create([
            'nom' => 'Responsable departement',
            'description' => 'responsable du departement',
        ]);

        Role::create([
            'nom' => 'Employer',
            'description' => 'responsable du departement',
        ]);
    }
}
