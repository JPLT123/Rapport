<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $id
 * @property string|null $slug
 * @property string|null $nom
 * @property string|null $Description
 * @property Carbon|null $date_creation
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $hierachie
 * 
 * @property Collection|Consultant[] $consultants
 * @property Collection|Filiale[] $filiales
 * @property Collection|Projet[] $projets
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'services';

	protected $casts = [
		'date_creation' => 'datetime'
	];

	protected $fillable = [
		'slug',
		'nom',
		'Description',
		'date_creation',
		'status',
		'hierachie'
	];

	public function consultants()
	{
		return $this->hasMany(Consultant::class, 'id_service');
	}

	public function filiales()
	{
		return $this->hasMany(Filiale::class, 'id_Service');
	}

	public function projets()
	{
		return $this->hasMany(Projet::class, 'service');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'id_Service');
	}
}
