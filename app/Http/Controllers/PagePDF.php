<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Rapport;
use App\Models\Depenser;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

}
