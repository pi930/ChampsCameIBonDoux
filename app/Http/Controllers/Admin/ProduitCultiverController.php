<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProduitCultiver;
use App\Models\Semi;
use Illuminate\Http\Request;

class ProduitCultiverController extends Controller
{
    public function index()
    {
        // Tous les produits du catalogue
        $produits = ProduitCultiver::all();

        return view('admin.produits-cultiver', compact('produits'));
    }

    public function store(Request $request)
    {
        $ids = $request->produits ?? [];

        // Réinitialiser la sélection
        ProduitCultiver::query()->update(['selectionne' => false]);

        // Marquer les produits sélectionnés
        ProduitCultiver::whereIn('id', $ids)->update(['selectionne' => true]);

        // Créer les semis correspondants
        foreach ($ids as $id) {
            $produit = ProduitCultiver::find($id);

            // Vérifier si un semi existe déjà
            if (!Semi::where('produit_cultiver_id', $id)->exists()) {
                Semi::create([
                    'produit_cultiver_id' => $id,
                ]);
            }
        }

        return redirect()->route('admin.semis.index')
            ->with('success', 'Les semis ont été mis à jour.');
    }
}


