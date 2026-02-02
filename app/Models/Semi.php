<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semi extends Model
{
    protected $table = 'semis';

    protected $fillable = [
        'produit_id',
        'date_semis',
        'quantite',
    ];

    public function produit()
    {
        return $this->belongsTo(ProduitCultiver::class, 'produit_id');
    }

    public function vente()
    {
        return $this->hasOne(ProduitVendre::class, 'semi_id');
    }
}



