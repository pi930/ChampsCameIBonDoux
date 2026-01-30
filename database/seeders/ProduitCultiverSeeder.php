<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\ProduitCultiver;

class ProduitCultiverSeeder extends Seeder
{
    public function run()
    {
        ProduitCultiver::truncate();

        $fichiers = Storage::disk('public')->files('produits');

        foreach ($fichiers as $fichier) {
            $nomFichier = basename($fichier);

            $nomProduit = ucwords(
                str_replace(['-', '_'], ' ', pathinfo($nomFichier, PATHINFO_FILENAME))
            );

            ProduitCultiver::create([
                'nom' => $nomProduit,
                'image' => $nomFichier,
            ]);
        }
    }
}
