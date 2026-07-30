<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\ProduitCultiver;

class ProduitCultiverSeeder extends Seeder
{
    public function run()
    {
        // Récupère toutes les images du dossier storage/app/public/produits_cultiver
        $files = Storage::disk('public')->files('produits');

        foreach ($files as $file) {

            // Nom du fichier sans extension
            $filename = pathinfo($file, PATHINFO_FILENAME);

            // Exemple : "tomate_rouge" → "Tomate rouge"
            $nom = ucfirst(str_replace('_', ' ', $filename));

            ProduitCultiver::create([
                'nom'        => $nom,
                'image'      => $file, // 🔥 Chemin correct vers l’image
                'selectionne'=> false,
            ]);
        }
    }
}

