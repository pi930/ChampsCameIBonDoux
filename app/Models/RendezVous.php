<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';

    protected $fillable = [
        'user_id',
        'date',
        'heure',
        'statut',
        'rendez_vous_disponible_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disponible()
    {
        return $this->belongsTo(RendezVousDisponible::class, 'rendez_vous_disponible_id');
    }
}

