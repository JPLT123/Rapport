<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanifHebdomadaire
 * 
 * @property int $id
 * @property int|null $id_projet
 * @property int|null $id_user
 * @property string|null $slug
 * @property string|null $nom
 * @property string|null $ressources_necessaires
 * @property string|null $resultat_attendus
 * @property string|null $observation
 * @property Carbon|null $date
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Projet|null $projet
 * @property User|null $user
 * @property Collection|PlantTache[] $plant_taches
 *
 * @package App\Models
 */
class PlanifHebdomadaire extends Model
{
	protected $table = 'planif_hebdomadaire';

	protected $casts = [
		'id_projet' => 'int',
		'id_user' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'id_projet',
		'id_user',
		'slug',
		'nom',
		'ressources_necessaires',
		'resultat_attendus',
		'observation',
		'date',
		'status',
		'importfile'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function importfile()
	{
		return $this->belongsTo(ImportFile::class, 'importfile');
	}

	public function plant_taches()
	{
		return $this->hasMany(PlantTache::class, 'id_planif');
	}

	public function plant_taches_relation()
	{
		return $this->belongsToMany(Tach::class, 'plant_tache','id_planif','id_tache');
	}
}
