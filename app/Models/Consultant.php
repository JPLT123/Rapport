<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultant
 * 
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_departement
 * @property int|null $id_filiale
 * @property int|null $id_service
 * @property int|null $id_role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departement|null $departement
 * @property Filiale|null $filiale
 * @property Role|null $role
 * @property Service|null $service
 * @property User|null $user
 *
 * @package App\Models
 */
class Consultant extends Model
{
	protected $table = 'consultant';

	protected $casts = [
		'id_user' => 'int',
		'id_departement' => 'int',
		'id_filiale' => 'int',
		'id_service' => 'int',
		'id_role' => 'int'
	];

	protected $fillable = [
		'id_user',
		'id_departement',
		'id_filiale',
		'id_service',
		'id_role'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'id_departement');
	}

	public function filiale()
	{
		return $this->belongsTo(Filiale::class, 'id_filiale');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_service');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
