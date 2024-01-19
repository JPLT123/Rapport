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
 * @property int|null $id_tache
 * @property int|null $id_user
 * @property int|null $id_prochain_tache
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
 * 
 * @property Tach|null $tach
 * @property User|null $user
 * @property Tacheprochain|null $tacheprochain
 * @property Collection|Importfile[] $importfiles
 *
 * @package App\Models
 */
class Rapport extends Model
{
	protected $table = 'rapport';

	protected $casts = [
		'id_tache' => 'int',
		'id_user' => 'int',
		'id_prochain_tache' => 'int',
		'debut_heure' => 'datetime',
		'fin_heure' => 'datetime',
		'date' => 'datetime'
	];

	protected $fillable = [
		'id_tache',
		'id_user',
		'id_prochain_tache',
		'tache_realiser',
		'tache_suplementaire',
		'debut_heure',
		'fin_heure',
		'materiels_utiliser',
		'lieu',
		'observation',
		'observationglobal',
		'date'
	];

	public function tach()
	{
		return $this->belongsTo(Tach::class, 'id_tache');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function tacheprochain()
	{
		return $this->belongsTo(Tacheprochain::class, 'id_prochain_tache');
	}

	public function importfiles()
	{
		return $this->hasMany(ImportFile::class, 'id_rapport');
	}
}
