<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\ProduitVendre;

class ProduitsVendreSeeder extends Seeder
{
    public function run()
    {
        // Récupère tous les fichiers du dossier storage/app/public/produits
        $files = Storage::disk('public')->files('produits');

        foreach ($files as $file) {

            // Nom du fichier sans extension
            $filename = pathinfo($file, PATHINFO_FILENAME);

            // Exemple : "tomate_rouge" → "Tomate rouge"
            $nom = ucfirst(str_replace('_', ' ', $filename));

            ProduitVendre::create([
                'semi_id'     => null,
                'nom'         => $nom,
                'prix'        => 5,
                'categorie'   => 'Légume',
                'unite'       => 'pièce',
                'description' => 'Produit cultivé disponible à la vente.',
                
                // 🔥 Chemin correct vers l’image
                'image'       => $file,  // ex: "produits/tomate_rouge.jpg"

                'actif'       => true,
            ]);
        }
    }
}
