<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RapportSemaine
 * 
 * @property int $id
 * @property string|null $objet
 * @property string|null $realisation
 * @property string|null $difficulte
 * @property string|null $budget
 * @property string|null $recommandation
 * @property Carbon|null $findate
 * @property Carbon|null $debutdate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RapportSemaine extends Model
{
	protected $table = 'rapport_semaine';

	protected $casts = [
		'findate' => 'datetime',
		'debutdate' => 'datetime'
	];

	protected $fillable = [
		'id_user',
		'slug',
		'objet',
		'realisation',
		'difficulte',
		'budget',
		'recommandation',
		'findate',
		'debutdate'
	];
	
	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
	
	public function importfiles()
	{
		return $this->hasMany(Importfile::class, 'rapport_semaine');
	}
}
