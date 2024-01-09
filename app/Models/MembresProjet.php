<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MembresProjet
 * 
 * @property int $id
 * @property int|null $id_projet
 * @property int|null $id_user
 * @property bool|null $is_chef
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Projet|null $projet
 * @property User|null $user
 *
 * @package App\Models
 */
class MembresProjet extends Model
{
	protected $table = 'membres_projet';

	protected $casts = [
		'id_projet' => 'int',
		'id_user' => 'int',
		'is_chef' => 'bool'
	];

	protected $fillable = [
		'id_projet',
		'id_user',
		'is_chef',
		'status'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
