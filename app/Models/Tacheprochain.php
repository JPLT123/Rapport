<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tacheprochain
 * 
 * @property int $id
 * @property string|null $taches
 * @property Carbon|null $duree
 * @property string|null $designation
 * @property string|null $valeur
 * @property string|null $risques
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $rapport
 * 
 * @property Rapportgeneral|null $rapportgeneral
 * @property Collection|Rapport[] $rapports
 *
 * @package App\Models
 */
class Tacheprochain extends Model
{
	protected $table = 'tacheprochain';

	protected $casts = [
		'duree' => 'datetime',
		'rapport' => 'int'
	];

	protected $fillable = [
		'taches',
		'duree',
		'designation',
		'valeur',
		'risques',
		'rapport'
	];

	public function rapportgeneral()
	{
		return $this->belongsTo(Rapportgeneral::class, 'rapport');
	}

	public function rapports()
	{
		return $this->hasMany(Rapport::class, 'id_prochain_tache');
	}
}
