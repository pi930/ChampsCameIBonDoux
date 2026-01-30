<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProduitCultiver;
use App\Models\Semi;

class SemisSeeder extends Seeder
{
    public function run()
    {
        $produits = ProduitCultiver::all();

        foreach ($produits as $p) {
            Semi::create([
                'produit_id' => $p->id,
                'date_semis' => now(),
                'quantite' => 0,
                'image' => null
            ]);
        }
    }
}


