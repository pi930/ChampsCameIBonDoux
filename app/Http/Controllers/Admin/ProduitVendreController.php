<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProduitVendre;
use App\Models\Semi;
use Illuminate\Http\Request;

class ProduitVendreController extends Controller
{
    public function index()
    {
        // Tous les semis dont le produit est sélectionné
        $semis = Semi::with('produit')
            ->whereHas('produit', function ($q) {
                $q->where('selectionne', true);
            })
            ->get();

        // Produits actifs (pour cocher les cases dans la vue)
        $actifs = ProduitVendre::where('actif', true)->pluck('semi_id')->toArray();

        return view('admin.produits-vendre', compact('semis', 'actifs'));
    }

    public function store(Request $request)
    {
        $ids = $request->produits ?? [];


        // Désactiver tous les produits
        ProduitVendre::query()->update(['actif' => false]);

        foreach ($ids as $semiId) {

            $semi = Semi::with('produit')->find($semiId);
             
            // Sécurité : si un semi n'a pas de produit, on ignore
            if (!$semi || !$semi->produit) {
                continue;
            }

            ProduitVendre::updateOrCreate(
                ['semi_id' => $semiId],
                [
                    'nom'        => $semi->produit->nom,
                    'prix'       => 2.5, // tu pourras remplacer par $semi->produit->prix si tu ajoutes la colonne
                    'categorie'  => 'Légumes', // idem
                    'unite'      => 'kg', // idem
                    'description'=> '',
                    'image'      => $semi->produit->image ?? '',
                    'actif'      => true,
                ]
            );
        }

        return redirect()
            ->route('admin.produits-vendre')
            ->with('success', 'Produits mis à jour avec succès !');
    }

    public function update(Request $request, ProduitVendre $produit)
    {
        $produit->update($request->all());
    }
}
