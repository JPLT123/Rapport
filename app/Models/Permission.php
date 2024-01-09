<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * 
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_role
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role|null $role
 * @property User|null $user
 *
 * @package App\Models
 */
class Permission extends Model
{
	protected $table = 'permissions';

	protected $casts = [
		'id_user' => 'int',
		'id_role' => 'int'
	];

	protected $fillable = [
		'id_user',
		'id_role',
		'status'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'id_role');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
