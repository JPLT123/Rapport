<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Importfile
 * 
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_rapport
 * @property string|null $links
 * @property string|null $nom_fichier
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Rapport|null $rapport
 * @property User|null $user
 *
 * @package App\Models
 */
class ImportFile extends Model
{
	protected $table = 'importfile';

	protected $casts = [
		'id_user' => 'int',
		'id_rapport' => 'int',
		'rapport' => 'int'
	];

	protected $fillable = [
		'id_user',
		'id_rapport',
		'rapport',
		'links',
		'nom_fichier'
	];

	public function rapport()
	{
		return $this->belongsTo(Rapport::class, 'id_rapport');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
	
	public function rapportgeneral()
	{
		return $this->belongsTo(Rapportgeneral::class, 'rapport');
	}

}
