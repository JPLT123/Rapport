<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Planification
 * 
 * @property int $id
 * @property int|null $id_projet
 * @property int|null $id_user
 * @property string|null $slug
 * @property string|null $nom
 * @property string|null $ressources_necessaires
 * @property string|null $resultat_attendus
 * @property string|null $hierachie
 * @property string|null $observation
 * @property Carbon|null $date
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Projet|null $projet
 * @property User|null $user
 *
 * @package App\Models
 */
class Planification extends Model
{
	protected $table = 'planification';

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
		'hierachie',
		'observation',
		'date',
		'status'
	];

	public function plan_projets_relation()
	{
		return $this->belongsToMany(Projet::class, 'plan_projets', 'id_projet', 'id_planif');
	}

	public function plan_projets()
	{
		return $this->hasMany(PlanProjet::class, 'id_planif');
	}

	public function taches()
	{
		return $this->hasMany(Tach::class, 'id_plant');
	}
}
