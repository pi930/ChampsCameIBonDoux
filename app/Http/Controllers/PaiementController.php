<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index(Request $request)
    {
        $formule = $request->formule;

        if (!in_array($formule, ['1_mois', '12_mois'])) {
            abort(404);
        }

        return view('paiements.index', compact('formule'));
    }

    public function process(Request $request)
{
    $request->validate([
        'formule' => 'required|in:1_mois,12_mois'
    ]);

    // Ici tu mettras Stripe / PayPal / etc.

    return redirect()->route('home')
        ->with('success', 'Commande réalisée avec succès !');
}

}

