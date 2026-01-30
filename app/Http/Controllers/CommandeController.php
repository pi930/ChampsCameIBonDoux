<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\RendezVousDisponible;
use App\Models\ProduitVendre;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CommandeController extends Controller
{
    public function paiement()
    {
        $user = auth()->user();

        $ids = session('panier', []);
        $produits = ProduitVendre::whereIn('id', $ids)->get();

        $rendezvousId = session('rendezvous_id');
        $rendezvous = RendezVousDisponible::findOrFail($rendezvousId);

        $adresse = 'Impasse du Mercantour, Nice Lingostière';

        return view('paiements.index', compact('produits', 'rendezvous', 'adresse'));
    }

    public function stripe(Request $request)
    {
        $request->validate([
            'formule' => 'required|in:simple,4_paniers',
        ]);
        
        Stripe::setApiKey(config('services.stripe.secret'));


        $user = auth()->user();
        $ids = session('panier', []);
        $rendezvousId = session('rendezvous_id');

        if (empty($ids) || !$rendezvousId) {
            return redirect()->route('panier.construire')->with('error', 'Panier ou rendez-vous manquant.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        if ($request->formule === 'simple') {
    $priceId = env('STRIPE_PRICE_SIMPLE');
    $mode = 'payment';
} elseif ($request->formule === '4_paniers') {
    $priceId = env('STRIPE_PRICE_4_PANIERS');
    $mode = 'payment'; // ce n'est PAS un abonnement
}

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'mode' => $mode,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'customer_email' => $user->email,
            'success_url' => env('STRIPE_SUCCESS_URL') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('STRIPE_CANCEL_URL'),
        ]);

        session([
            'formule' => $request->formule,
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }
    public function index()
{
    $user = auth()->user();

    // Charger les commandes + panier + produits du panier
    $commandes = Commande::where('user_id', $user->id)
        ->with([
            'panier.produits',      // produits du panier
            'rendezVous'            // rendez-vous associé
        ])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('commandes.index', compact('user', 'commandes'));
}


    public function success(Request $request)
    {
        $user = auth()->user();

        $ids = session('panier', []);
        $rendezvousId = session('rendezvous_id');
        $formule = session('formule');

        if (empty($ids) || !$rendezvousId || !$formule) {
            return redirect('/')->with('error', 'Données de commande manquantes.');
        }

        if ($formule === 'simple') {
    $panierTotal = 30;
} elseif ($formule === '4_paniers') {
    $panierTotal = 105;
} else {
    $panierTotal = 30; // fallback
}


        $panier = Panier::create([
            'user_id' => $user->id,
            'total' => $panierTotal,
        ]);

        $panier->produits()->sync($ids);

        Commande::create([
            'user_id' => $user->id,
            'panier_id' => $panier->id,
            'telephone' => $user->telephone,
            'total' => $panierTotal,
            'formule' => $formule,
            'rendez_vous_disponible_id' => $rendezvousId,
        ]);
        if ($formule === '4_paniers') {

            $rendezvous = RendezVousDisponible::find($rendezvousId);

    // Date du rendez-vous initial
    $dateDepart = \Carbon\Carbon::parse($rendezvous->date);

    for ($i = 1; $i <= 4; $i++) {

        $datePanier = $dateDepart->copy()->addWeeks($i);

        Panier::create([
            'user_id' => $user->id,
            'total' => 0, // panier gratuit
            'date_disponible' => $datePanier->format('Y-m-d'),
            'type' => 'panier_programme',
        ]);
    }
}


        session()->forget(['panier', 'rendezvous_id', 'formule', 'stripe_session_id']);

        return view('paiements.success');
    }

    public function cancel()
    {
        return redirect()->route('paiement')->with('error', 'Paiement annulé.');
    }
}
