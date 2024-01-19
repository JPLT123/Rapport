<?php

use App\Livewire\Entreprise;
use App\Livewire\ChatAccueil;
use App\Livewire\Departement;
use App\Livewire\GeneratePdf;
use App\Livewire\RapportDate;
use App\Livewire\Profile\Show;
use App\Livewire\Accueil\Index;
use App\Livewire\ChatComposant;
use App\Livewire\ProfilFiliale;
use App\Livewire\AfficheRapport;
use App\Http\Controllers\PagePDF;
use App\Livewire\Profile\Reglage;
use App\Livewire\Accueil\Dashboad;
use App\Livewire\CompteDesactiver;
use App\Models\PlanifHebdomadaire;
use App\Livewire\HistoriqueRapport;
use App\Livewire\Taches\ListeTache;
use App\Livewire\DepartementFiliale;
use App\Livewire\Projet\ListeProjet;
use App\Livewire\Taches\CreateTache;
use App\Livewire\Projet\ApercuProjet;
use App\Livewire\Projet\CreateProjet;
use Illuminate\Support\Facades\Route;
use App\Livewire\Planification\Apercu;
use App\Livewire\Planification\Create;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Profile\ChangePassword;
use App\Livewire\Planification\PlanifChef;
use App\Livewire\Rapport\RapportJournalier;
use App\Livewire\Planification\DetailPlanif;
use App\Livewire\GestionUtilisateur\AuthUser;
use App\Livewire\GestionUtilisateur\ListeUser;
use App\Livewire\GestionUtilisateur\DetailUser;
use App\Livewire\Planification\HistoriquePlanif;
use App\Livewire\Planification\UpdatePlanification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboad::class)->name('dashboard');
    Route::get('/Accueil', Index::class)->name('Accueil');
    Route::get('/compte-desactiver', CompteDesactiver::class)->name('SupprimerDesactiver');
    Route::get('/profile-user', Show::class)->name('profile-user');
    Route::get('/change-password', ChangePassword::class)->name('change-password');
    Route::get('/chat', ChatAccueil::class)->name('chat');
    Route::get('/chat/{recipientId}', ChatComposant::class)->name('chat-user');
    Route::get('/info-user', AuthUser::class)->name('info-user');
    Route::get('/list-utilisateur', ListeUser::class)->name('list-utilisateur')->middleware(RoleMiddleware::class);
    Route::get('/detail-user/{slug}', DetailUser::class)->name('detail-user')->middleware(RoleMiddleware::class);
    Route::get('/departement', DepartementFiliale::class)->name('departement')->middleware(RoleMiddleware::class);
    Route::get('/filiale', Entreprise::class)->name('filiale')->middleware(RoleMiddleware::class);
    Route::get('/view-filiale/{slug}', ProfilFiliale::class)->name('detail-filiale')->middleware(RoleMiddleware::class);
    Route::get('/planification.overview', Apercu::class)->name('planification.apercu');
    Route::get('/planification.create', Create::class)->name('planification.create');
    Route::get('/planification.projet', PlanifChef::class)->name('planification.projet');
    Route::get('/planification.Update/{slug}', UpdatePlanification::class)->name('planification.Update');
    Route::get('/planification-detail/{slug}', DetailPlanif::class)->name('planification-detail');
    Route::get('/create-projet', CreateProjet::class)->name('create-projet');
    Route::get('/liste-projet', ListeProjet::class)->name('liste-projet');
    Route::get('/Apercu-projet/{slug}', ApercuProjet::class)->name('Apercu-projet');
    Route::get('/liste-tache', ListeTache::class)->name('liste-tache');
    Route::get('/create-tache', CreateTache::class)->name('create-tache');
    Route::get('/histoire-planification', HistoriquePlanif::class)->name('histoire-planification');
    Route::get('/histoire-rapport', HistoriqueRapport::class)->name('histoire-rapport');
    Route::get('/rapport-journalier', RapportJournalier::class)->name('rapport-journalier');
    Route::get('/reglage-profil-user', Reglage::class)->name('reglage');
    Route::get('/pdf-page1/{slug}', [PagePDF::class,'generatePDF'])->name('telecharger-pdf');
    Route::get('/pdf-page/{slug}', AfficheRapport::class)->name('affiche-rapport');
    Route::get('/affiche-rapport-par-date/{slug}', RapportDate::class)->name('affiche-rapport-par-date');
    Route::get('/pdf-page1', [PagePDF::class,'index'])->name('telecharger');
    Route::get('/telecharger/{id_rapport}', [PagePDF::class,'telecharger'])->name('telecharger-fichier');    Route::get('/telecharger/{id_rapport}', [status::class,'telecharger'])->name('telecharger-fichier');
    Route::get('/status/{slug}', [PagePDF::class,'status'])->name('statusupdate');

    


});

