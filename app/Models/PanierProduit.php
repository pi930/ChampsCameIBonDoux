<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanierProduit extends Model
{
    protected $table = 'panier_produits';

    protected $fillable = [
        'panier_id',
        'produit_id',
    ];
}

