<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\RendezVousDisponible;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index()
    {
        $disponibles = RendezVousDisponible::where('est_disponible', true)
            ->whereDate('date', '>=', today('Europe/Paris'))
            ->orderBy('date')
            ->orderBy('heure')
            ->get();

        return view('rendezvous.index', compact('disponibles'));
    }

    public function choisir(Request $request)
    {
        $request->validate([
            'rendezvous_id' => 'required|exists:rendez_vous_disponibles,id'
        ]);

        // On récupère le créneau choisi
        $dispo = RendezVousDisponible::findOrFail($request->rendezvous_id);

        // On crée le rendez-vous pour l'utilisateur
        $rdv = RendezVous::create([
            'user_id' => auth()->id(),
            'date' => $dispo->date,
            'heure' => $dispo->heure,
            'statut' => 'confirmé',
            'rendez_vous_disponible_id' => $dispo->id, // ESSENTIEL
        ]);

        // On marque le créneau comme non disponible
        $dispo->update(['est_disponible' => false]);

        // On garde l’ID du rendez-vous dans la session pour le récap
        session(['rendezvous_id' => $rdv->id]);

        // On retourne vers le panier comme tu le veux
        return redirect()->route('panier.recap');
    }

    public function mesRendezVous()
    {
        $rendezvous = RendezVous::where('user_id', auth()->id())
            ->orderBy('date')
            ->orderBy('heure')
            ->get();

        return view('rendezvous.mes', compact('rendezvous'));
    }
}


