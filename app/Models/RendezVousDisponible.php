<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVousDisponible extends Model
{
    protected $table = 'rendez_vous_disponibles';

    protected $fillable = [
        'date',
        'heure',
        'telephone',
        'est_disponible',
    ];
    public function rendezVous()
{
    return $this->hasOne(RendezVous::class, 'rendez_vous_disponible_id');
}

}

