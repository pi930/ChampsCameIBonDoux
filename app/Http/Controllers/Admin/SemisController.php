<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProduitCultiver;
use App\Models\Semi;
use Illuminate\Http\Request;

class SemisController extends Controller
{
    public function index()
    {
        // On affiche tous les semis liés à des produits sélectionnés
        $semis = Semi::with('produit')
            ->whereHas('produit', function ($q) {
                $q->where('selectionne', true);
            })
            ->get();

        return view('admin.semis', compact('semis'));
    }

    public function store(Request $request)
    {
        $ids = $request->produits ?? [];

        // 1. Réinitialiser la sélection dans produits_cultiver
        ProduitCultiver::query()->update(['selectionne' => false]);

        // 2. Marquer les produits sélectionnés
        ProduitCultiver::whereIn('id', $ids)->update(['selectionne' => true]);

        // 3. Créer les semis correspondants
        foreach ($ids as $id) {
            if (!Semi::where('produit_id', $id)->exists()) {
                Semi::create([
                    'produit_id' => $id,
                    'date_semis' => now(),
                    'quantite' => 0,
                    'image' => ProduitCultiver::find($id)->image,
                ]);
            }
        }

        return redirect()->route('admin.semis.index')
            ->with('success', 'Les semis ont été mis à jour.');
    }
}

