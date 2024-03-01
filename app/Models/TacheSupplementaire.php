<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TacheSupplementaire extends Model
{
    protected $table = 'taches_supplementaires';

    protected $fillable = [
        'id_user',
        'description',
        'justification',
        'duree',
        'impact',
        'date',
        'status',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    // Relation avec le modèle Tache
    public function tache()
    {
        return $this->hasMany(Tach::class, 'taches_suplementaires');
    }
     
}
