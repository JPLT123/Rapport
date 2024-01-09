<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlanProjet
 * 
 * @property int $id
 * @property int|null $id_projet
 * @property int|null $id_planif
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Planification|null $planification
 * @property Projet|null $projet
 *
 * @package App\Models
 */
class PlanProjet extends Model
{
	protected $table = 'plan_projet';

	protected $casts = [
		'id_projet' => 'int',
		'id_planif' => 'int'
	];

	protected $fillable = [
		'id_projet',
		'id_planif'
	];

	public function planification()
	{
		return $this->belongsTo(Planification::class, 'id_planif');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}
}
