<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rapport
 * 
 * @property int $id
 * @property int|null $id_prochain_tache
 * @property int|null $id_tache
 * @property int|null $id_user
 * @property string|null $tache_realiser
 * @property string|null $tache_suplementaire
 * @property Carbon|null $debut_heure
 * @property Carbon|null $fin_heure
 * @property string|null $materiels_utiliser
 * @property string|null $lieu
 * @property string|null $observation
 * @property string|null $observationglobal
 * @property Carbon|null $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $general
 * 
 * @property Rapportgeneral|null $rapportgeneral
 * @property Tacheprochain|null $tacheprochain
 * @property Tach|null $tach
 * @property User|null $user
 * @property Collection|Importfile[] $importfiles
 *
 * @package App\Models
 */
class Rapport extends Model
{
	protected $table = 'rapport';

	protected $casts = [
		'id_prochain_tache' => 'int',
		'id_tache' => 'int',
		'id_user' => 'int',
		'debut_heure' => 'datetime',
		'fin_heure' => 'datetime',
		'date' => 'datetime',
		'general' => 'int'
	];

	protected $fillable = [
		'id_prochain_tache',
		'id_tache',
		'id_user',
		'tache_realiser',
		'tache_suplementaire',
		'debut_heure',
		'fin_heure',
		'materiels_utiliser',
		'lieu',
		'observation',
		'observationglobal',
		'date',
		'general'
	];

	public function rapportgeneral()
	{
		return $this->belongsTo(Rapportgeneral::class, 'general');
	}

	public function tacheprochain()
	{
		return $this->belongsTo(Tacheprochain::class, 'id_prochain_tache');
	}

	public function tach()
	{
		return $this->belongsTo(Tach::class, 'id_tache');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function importfiles()
	{
		return $this->hasMany(ImportFile::class, 'id_rapport');
}

	
	public function planif()
    {
        return $this->belongsToMany(PlanifHebdomadaire::class, 'plant_tache', 'id_planif', 'id_tache');
	}
}
