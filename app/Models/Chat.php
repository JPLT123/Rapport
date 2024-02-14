<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chat
 * 
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property bool $is_seen
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Chat extends Model
{
	protected $table = 'chats';

	protected $casts = [
		'user_id' => 'int',
		'is_seen' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'content',
		'is_seen'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
