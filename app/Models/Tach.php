<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tach
 * 
 * @property int $id
 * @property string|null $slug
 * @property string|null $tache_prevues
 * @property string|null $status
 * @property int|null $id_projet
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Projet|null $projet
 * @property Collection|Depenser[] $depensers
 * @property Collection|PlantTache[] $plant_taches
 * @property Collection|Rapport[] $rapports
 *
 * @package App\Models
 */
class Tach extends Model
{
	protected $table = 'taches';

	protected $casts = [
		'id_projet' => 'int'
	];

	protected $fillable = [
		'slug',
		'tache_prevues',
		'status',
		'id_projet'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}

	public function depensers()
	{
		return $this->hasMany(Depenser::class, 'id_tache');
	}

	public function plant_taches()
	{
		return $this->hasMany(PlantTache::class, 'id_tache');
	}

	public function planif()
    {
        return $this->belongsToMany(PlanifHebdomadaire::class, 'plant_tache', 'id_planif', 'id_tache');
	}

	public function rapports()
	{
		return $this->hasMany(Rapport::class, 'id_tache');
	}
}
