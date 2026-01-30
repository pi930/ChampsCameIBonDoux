<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'user_id',
        'panier_id',
        'telephone',
        'total',
        'formule',
        'rendez_vous_disponible_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function panier()
    {
        return $this->belongsTo(Panier::class);
    }

    public function rendezVous()
    {
        return $this->belongsTo(RendezVousDisponible::class, 'rendez_vous_disponible_id');
    }
    
}



