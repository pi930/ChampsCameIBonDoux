<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\RendezVousDisponible;
use App\Models\ProduitVendre;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CommandeController extends Controller
{   
   public function index()
{
    $user = auth()->user();

    $commande = Commande::where('user_id', $user->id)
        ->with(['user', 'panier.produits', 'rendezVous'])
        ->latest()
        ->first();

    return view('commandes.index', compact('commande'));
}

 

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

        $priceId = $request->formule === 'simple'
            ? env('STRIPE_PRICE_SIMPLE')
            : env('STRIPE_PRICE_4_PANIERS');

        $successUrl = env('STRIPE_SUCCESS_URL')
            . '?session_id={CHECKOUT_SESSION_ID}'
            . '&formule=' . $request->formule
            . '&panier=' . implode(',', $ids)
            . '&rendezvous=' . $rendezvousId;

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'customer_email' => $user->email,
            'success_url' => $successUrl,
            'cancel_url' => env('STRIPE_CANCEL_URL'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $sessionId = $request->get('session_id');
    $session = StripeSession::retrieve($sessionId);

    if ($session->payment_status !== 'paid') {
        return redirect('/')->with('error', 'Paiement non confirmé.');
    }

    $email = $session->customer_email;
    $user = User::where('email', $email)->firstOrFail();

    $formule = $request->get('formule');
    $ids = explode(',', $request->get('panier'));
    $rendezvousId = $request->get('rendezvous');

    $panierTotal = $formule === '4_paniers' ? 105 : 30;

    // Création du panier
    $panier = Panier::create([
        'user_id' => $user->id,
        'total' => $panierTotal,
    ]);

    $panier->produits()->sync($ids);

    // Création de la commande + récupération dans une variable
    $commande = Commande::create([
        'user_id' => $user->id,
        'panier_id' => $panier->id,
        'telephone' => $user->telephone,
        'total' => $panierTotal,
        'formule' => $formule,
        'rendez_vous_disponible_id' => $rendezvousId,
    ]);

    // Gestion des paniers programmés
    if ($formule === '4_paniers') {
        $rendezvous = RendezVousDisponible::find($rendezvousId);
        $dateDepart = \Carbon\Carbon::parse($rendezvous->date);

        for ($i = 1; $i <= 4; $i++) {
            Panier::create([
                'user_id' => $user->id,
                'total' => 0,
                'date_disponible' => $dateDepart->copy()->addWeeks($i)->format('Y-m-d'),
                'type' => 'panier_programme',
            ]);
        }
    }

    // ENFIN on envoie la commande à la vue
    return view('paiements.success', compact('commande'));
}


    public function cancel()
    {
        return redirect()->route('paiement')->with('error', 'Paiement annulé.');
    }
}
