<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Depenser
 * 
 * @property int $id
 * @property string|null $slug
 * @property string|null $Designation
 * @property string|null $CoutReel
 * @property string|null $Coutprevisionnel
 * @property string|null $observation
 * @property string $status
 * @property int|null $id_tache
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Tach|null $tach
 *
 * @package App\Models
 */
class Depenser extends Model
{
	protected $table = 'depenser';

	protected $casts = [
		'id_tache' => 'int'
	];

	protected $fillable = [
		'slug',
		'Designation',
		'CoutReel',
		'Coutprevisionnel',
		'observation',
		'status',
		'id_tache'
	];

	public function tach()
	{
		return $this->belongsTo(Tach::class, 'id_tache');
	}
}
