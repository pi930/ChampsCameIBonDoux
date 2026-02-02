<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitVendre extends Model
{
    protected $table = 'produits_vendre';

    protected $fillable = [
        'semi_id',
        'nom',
        'prix',
        'categorie',
        'unite',
        'description',
        'actif',
    ];



    
}



