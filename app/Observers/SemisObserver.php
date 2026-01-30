<?php

namespace App\Observers;

use App\Models\Semi;
use App\Models\ProduitVendre;

class SemisObserver
{
    public function created(Semi $semi)
    {
        ProduitVendre::create([
            'semi_id' => $semi->id,
            'nom' => $semi->produit->nom,
            'prix' => 0,
            'categorie' => null,
            'unite' => null,
            'description' => null,
            'image' => $semi->produit->image,
            'actif' => false,
        ]);
    }

    public function updated(Semi $semi)
    {
        ProduitVendre::where('semi_id', $semi->id)->update([
            'nom' => $semi->produit->nom,
            'image' => $semi->produit->image,
        ]);
    }

    public function deleted(Semi $semi)
    {
        ProduitVendre::where('semi_id', $semi->id)->update([
            'actif' => false,
        ]);
    }
}

