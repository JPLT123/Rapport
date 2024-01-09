<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class ProjectData extends Component
{
    public function render()
    {
        return view('livewire.profile.project-data');
    }

    public function getProjectData($id)
    {
        // Récupérez les données du projet en fonction de l'ID
        $project = Project::find($id);

        // Retournez les données au format JSON
        return response()->json([
            'name' => $project->nom,
            'data' => $project->getDataForChart(), // Mettez en œuvre cette méthode dans votre modèle Project
        ]);
    }
}
