<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nom' => 'Admin',
            'description' => 'Administrateur du site',
        ]);

        Role::create([
            'nom' => 'Responsable Hierachie',
            'description' => 'responsable hierachie',
        ]);

        Role::create([
            'nom' => 'Chef projet',
            'description' => 'Chef de projet',
        ]);

        Role::create([
            'nom' => 'Membre',
            'description' => 'Membre du site',
        ]);
    }
}