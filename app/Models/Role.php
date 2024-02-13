<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $nom
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Permission[] $permissions
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'role';

	protected $fillable = [
		'nom',
		'description'
	];

	public function permissions()
	{
		return $this->hasMany(Permission::class, 'id_role');
	}

	public function user()
	{
		return $this->belongsToMany(User::class, 'permissions', 'id_role', 'id_user');
	}
}
