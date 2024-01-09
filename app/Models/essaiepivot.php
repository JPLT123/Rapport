<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Essaiepivot
 * 
 * @property int $id
 * @property int|null $id_tache
 * @property string|null $id_planif
 * @property int|null $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Essaiepivot extends Model
{
	protected $table = 'essaiepivot';

	protected $casts = [
		'id_tache' => 'int',
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_tache',
		'id_planif',
		'id_user'
	];
}
