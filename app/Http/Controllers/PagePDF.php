<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Rapport;
use App\Models\Depenser;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PlanifHebdomadaire;

class PagePDF extends Controller
{
    public function index()
    {
        return view('affiche-rapport');
    }
    
    public function generatePDF($slug)
    {
        // Assurez-vous que le slug existe et correspond à un utilisateur
        $user = User::where('slug', $slug)->firstOrFail();

        $dateActuelle = Carbon::now()->toDateString();

        $rapports = Rapport::where('id_user', $user->id)
                            ->whereDate('date', $dateActuelle)
                            ->get();

        $taches = $rapports->pluck('id_tache')->toArray();

        $depenses = Depenser::whereIn('id_tache', $taches)->get();

        return view('affiche-rapport', [
            'user' => $user,
            'rapports' => $rapports,
            'dateActuelle' => $dateActuelle,
            'depenses' => $depenses,
        ]);

        try {
            $pdf->download('test' . rand(1, 100) . '.pdf');
        } catch (\Exception $e) {
            // Enregistrez l'erreur dans les logs
            \Log::error('Erreur lors du téléchargement du PDF : ' . $e->getMessage());
            // Affichez un message d'erreur ou redirigez l'utilisateur
        }
    }

    public function status()
    {dd('ok');
        // Utilisez "first" au lieu de "get" pour obtenir un seul modèle
        $planif = PlanifHebdomadaire::where('slug', $slug)->first();
    
        // Assurez-vous que le modèle existe avant de tenter la mise à jour
        if ($planif) {
            // Utilisez "update" directement sur le modèle
            $planif->update(['status' => 'Approved']);
        }
    
        // Vous pouvez également ajouter un message flash pour informer l'utilisateur de la mise à jour réussie
        session()->flash('message', 'Le statut a été mis à jour avec succès.');
    
        // Vous pouvez également rediriger l'utilisateur ou effectuer d'autres actions après la mise à jour
    }
}
