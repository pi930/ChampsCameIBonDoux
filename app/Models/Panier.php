<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $table = 'paniers';

    protected $fillable = [
        'user_id',
        'total',
        'date_disponible',
        'type', // normal | panier_programme
    ];

    public function produits()
    {
        return $this->belongsToMany(
            ProduitVendre::class,
            'panier_produits',
            'panier_id',
            'produit_id'
        )->withPivot('quantite');
    }

    public function commande()
    {
        return $this->hasOne(Commande::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
