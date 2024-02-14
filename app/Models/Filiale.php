<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filiale
 * 
 * @property int $id
 * @property string|null $slug
 * @property string|null $nom
 * @property string|null $logo
 * @property string $email
 * @property string|null $telephone
 * @property string|null $adresse
 * @property string|null $hierachie
 * @property Carbon|null $date_creation
 * @property string|null $description
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $id_Service
 * 
 * @property Service|null $service
 * @property Collection|Departement[] $departements
 * @property Collection|Projet[] $projets
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Filiale extends Model
{
	protected $table = 'filiales';

	protected $casts = [
		'date_creation' => 'datetime',
		'id_Service' => 'int'
	];

	protected $fillable = [
		'slug',
		'nom',
		'logo',
		'email',
		'telephone',
		'adresse',
		'hierachie',
		'date_creation',
		'description',
		'status',
		'id_Service'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'id_Service');
	}

	public function departements()
	{
		return $this->hasMany(Departement::class, 'id_filiale');
	}

	public function projets()
	{
		return $this->hasMany(Projet::class, 'id_filiale');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'id_filiale');
	}

	
	public function TerminerProjects()
	{
		return $this->hasMany(Projet::class, 'id_filiale')
					->where('projets.status', 'Terminer');
	}

	public function pendingProjects()
	{
		return $this->hasMany(Projet::class, 'id_filiale')
					->where('projets.status', 'attente');
	}
}
