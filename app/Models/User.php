<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string|null $slug
 * @property string $name
 * @property string $email
 * @property string|null $telephone
 * @property string|null $adresse
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $verification_code
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $id_filiale
 * @property int|null $id_departement
 * 
 * @property Departement|null $departement
 * @property Filiale|null $filiale
 * @property Collection|Chat[] $chats
 * @property Collection|Essaieplanif[] $essaieplanifs
 * @property Collection|Importfile[] $importfiles
 * @property Collection|MembresProjet[] $membres_projets
 * @property Collection|Permission[] $permissions
 * @property Collection|PlanifHebdomadaire[] $planif_hebdomadaires
 * @property Collection|Planification[] $planifications
 * @property Collection|Rapport[] $rapports
 *
 * @package App\Models
 */
class User extends Authenticatable
{
use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'current_team_id' => 'int',
		'id_filiale' => 'int',
		'id_departement' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'slug',
		'name',
		'email',
		'telephone',
		'adresse',
		'email_verified_at',
		'password',
		'remember_token',
		'current_team_id',
		'profile_photo_path',
		'verification_code',
		'status',
		'id_filiale',
		'id_departement'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'id_departement');
	}

	public function filiale()
	{
		return $this->belongsTo(Filiale::class, 'id_filiale');
	}

	public function chat()
	{
		return $this->hasMany(Chat::class);
	}

	public function essaieplanifs()
	{
		return $this->hasMany(Essaieplanif::class, 'id_user');
	}

	public function importfiles()
	{
		return $this->hasMany(Importfile::class, 'id_user');
	}

	public function membres_projets()
	{
		return $this->hasMany(MembresProjet::class, 'id_user');
	}

	public function permissions()
	{
		return $this->hasMany(Permission::class, 'id_user');
	}

	public function planif_hebdomadaires()
	{
		return $this->hasMany(PlanifHebdomadaire::class, 'id_user');
	}

	public function planifications()
	{
		return $this->hasMany(Planification::class, 'id_user');
	}

	public function rapports()
	{
		return $this->hasMany(Rapport::class, 'id_user');
	}

    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'membres_projet', 'id_user', 'id_projet')
                    ->withPivot('is_chef');
    }

	public function membres_projets_relation()
    {
        return $this->belongsToMany(Projet::class, 'membres_projet', 'id_projet', 'id_user');
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'permissions', 'id_role', 'id_user');
	}

	public function ongoingProjects()
	{
		return $this->belongsToMany(Projet::class, 'membres_projet', 'id_user', 'id_projet')
					->where('projets.status', 'activer');
	}

	public function PendingProjects()
	{
		return $this->belongsToMany(Projet::class, 'membres_projet', 'id_user', 'id_projet')
					->where('projets.status', 'attente');
	}

}
