<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlantTache
 * 
 * @property int $id
 * @property int|null $id_tache
 * @property int|null $id_planif
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool|null $status
 * 
 * @property PlanifHebdomadaire|null $planif_hebdomadaire
 * @property Tach|null $tach
 *
 * @package App\Models
 */
class PlantTache extends Model
{
	protected $table = 'plant_tache';

	protected $casts = [
		'id_tache' => 'int',
		'id_planif' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'id_tache',
		'id_planif',
		'status'
	];

	public function planif_hebdomadaire()
	{
		return $this->belongsTo(PlanifHebdomadaire::class, 'id_planif');
	}

	public function tach()
	{
		return $this->belongsTo(Tach::class, 'id_tache');
	}
}
