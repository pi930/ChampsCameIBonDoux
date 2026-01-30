<?php

namespace App\Http\Controllers;

use App\Models\ProduitVendre;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    // Affiche la page où l'utilisateur choisit les produits
    public function construire()
    {
        // On récupère les produits actifs (choisis par l'admin)
        $produits = ProduitVendre::where('actif', 1)->get();

        return view('panier.construire', compact('produits'));
    }

    // Enregistre le panier dans la session
    public function store(Request $request)
{
    $request->validate([
        'produits' => 'required|array|min:1'
    ]);

    session(['panier' => $request->produits]);

    return redirect()->route('rendezvous.index');
}


    // Affiche le récapitulatif
    public function recap()
{
    // Récupération des produits du panier
    $ids = session('panier', []);
    $produits = \App\Models\ProduitVendre::whereIn('id', $ids)->get();

    // Récupération du rendez-vous choisi
    $rendezvousId = session('rendezvous_id');
    $rendezvous = null;

    if ($rendezvousId) {
        $rendezvous = \App\Models\RendezVousDisponible::find($rendezvousId);
    }

    return view('panier.recap', compact('produits', 'rendezvous'));
}

}

