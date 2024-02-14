<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rapportgeneral
 * 
 * @property int $id
 * @property int|null $id_user
 * @property string|null $materiels_utiliser
 * @property string|null $observation
 * @property string|null $observationglobal
 * @property Carbon|null $date
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property Collection|Rapport[] $rapports
 * @property Collection|Tacheprochain[] $tacheprochains
 *
 * @package App\Models
 */
class Rapportgeneral extends Model
{
	protected $table = 'rapportgeneral';

	protected $casts = [
		'id_user' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'id_user',
		'materiels_utiliser',
		'observation',
		'observationglobal',
		'date',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function rapports()
	{
		return $this->hasMany(Rapport::class, 'general');
	}

	public function tacheprochains()
	{
		return $this->hasMany(Tacheprochain::class, 'rapport');
	}

	public function ImportFile()
	{
		return $this->hasMany(ImportFile::class, 'rapport');
	}
}
