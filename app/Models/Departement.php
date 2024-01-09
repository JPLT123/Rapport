<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departement
 * 
 * @property int $id
 * @property int|null $id_filiale
 * @property string|null $slug
 * @property string|null $nom
 * @property string|null $Description
 * @property string|null $Coutprevisionnel
 * @property string|null $observation
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Filiale|null $filiale
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Departement extends Model
{
	protected $table = 'departement';

	protected $casts = [
		'id_filiale' => 'int'
	];

	protected $fillable = [
		'id_filiale',
		'slug',
		'nom',
		'Description',
		'Coutprevisionnel',
		'observation',
		'status'
	];

	// Dans le modèle Departement
	public function utilisateurs()
	{
		return $this->hasMany(User::class, 'id_departement');
	}


	public function filiale()
	{
		return $this->belongsTo(Filiale::class, 'id_filiale');
	}

}
