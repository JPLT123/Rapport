<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Projet
 * 
 * @property int $id
 * @property int|null $id_filiale
 * @property string|null $nom
 * @property string|null $code
 * @property string|null $description
 * @property Carbon|null $debutdate
 * @property Carbon|null $findate
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Filiale|null $filiale
 * @property Collection|Essaieplanif[] $essaieplanifs
 * @property Collection|MembresProjet[] $membres_projets
 * @property Collection|PlanifHebdomadaire[] $planif_hebdomadaires
 * @property Collection|Planification[] $planifications
 * @property Collection|Tach[] $taches
 *
 * @package App\Models
 */
class Projet extends Model
{
	protected $table = 'projets';

	protected $casts = [
		'id_filiale' => 'int',
		'debutdate' => 'datetime',
		'findate' => 'datetime'
	];

	protected $fillable = [
		'id_filiale',
		'nom',
		'code',
		'description',
		'debutdate',
		'findate',
		'status'
	];

	public function filiale()
	{
		return $this->belongsTo(Filiale::class, 'id_filiale');
	}

	public function essaieplanifs()
	{
		return $this->hasMany(Essaieplanif::class, 'id_projet');
	}

	public function membres_projets()
	{
		return $this->hasMany(MembresProjet::class, 'id_projet');
	}

	public function planif_hebdomadaires()
	{
		return $this->hasMany(PlanifHebdomadaire::class, 'id_projet');
	}

	public function planifications()
	{
		return $this->hasMany(Planification::class, 'id_projet');
	}

	public function taches()
	{
		return $this->hasMany(Tach::class, 'id_projet');
}

	public function membres_projets_relation()
    {
        return $this->belongsToMany(User::class, 'membres_projet', 'id_projet', 'id_user');
	}


	public function getDataForChart()
    {
		$nombreTachesAchevees = $this->taches->where('status', 'Terminer')->count();

        return [
            'name' => $this->nom,
            'data' => $nombreTachesAchevees,
        ];
	}
	
	public function tachesTerminees()
    {
        return $this->taches()->where('status', 'Terminer');
    }

	public function compterTachesTerminees()
    {
        return $this->tachesTerminees();
    }

}
