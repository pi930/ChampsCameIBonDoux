<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\ProduitVendre;

class ProduitsVendreSeeder extends Seeder
{
    public function run()
    {
        $files = Storage::disk('public')->files('produits');

        foreach ($files as $file) {

            // Nom du fichier sans extension
            $filename = pathinfo($file, PATHINFO_FILENAME);

            // Exemple : "tomate_rouge" → "Tomate rouge"
            $nom = ucfirst(str_replace('_', ' ', $filename));

            ProduitVendre::create([
                'semi_id' => null,               // pas lié à un semi
                'nom' => $nom,
                'prix' => 5,                     // prix par défaut (à ajuster)
                'categorie' => 'Légume',         // catégorie par défaut
                'unite' => 'pièce',              // unité par défaut
                'description' => 'Produit cultivé disponible à la vente.',
                'image' => $file,                // chemin vers l’image
                'actif' => true,                 // visible dans l’admin
            ]);
        }
    }
}

