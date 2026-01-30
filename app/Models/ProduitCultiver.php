<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitCultiver extends Model
{
    protected $table = 'produits_cultiver';

    protected $fillable = [
        'nom',
        'image',
        'selectionne',
    ];
}



