<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\ProduitCultiver;
use App\Models\Semi;

class SemisSeeder extends Seeder
{
    public function run()
    {
        // Récupère toutes les images disponibles dans storage/app/public/produits
        $images = Storage::disk('public')->files('produits');

        $produits = ProduitCultiver::all();

        foreach ($produits as $p) {

            // 1️⃣ Image du produit cultivé (si elle existe)
            $image = $p->image;

            // 2️⃣ Sinon, on prend une image du dossier produits
            if (!$image && count($images) > 0) {
                // On prend une image au hasard
                $image = $images[array_rand($images)];
            }

            // 3️⃣ Sinon, image par défaut
            if (!$image) {
                $image = 'default.png'; // mets un fichier default.png dans storage/app/public
            }

            Semi::create([
                'produit_id' => $p->id,
                'date_semis' => now(),
                'quantite'   => 0,
                'image'      => $image,  // 🔥 image réelle
            ]);
        }
    }
}


