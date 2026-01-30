<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Commande;
use App\Models\Panier;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function commandes()
{
    $commandes = Commande::with(['user', 'panier.produits', 'rendezVous'])
        ->orderBy('created_at', 'desc')
        ->get();

    $paniers_programmes = Panier::where('type', 'panier_programme')
        ->with('user')
        ->orderBy('date_disponible')
        ->get();

    return view('admin.commandes', compact('commandes', 'paniers_programmes'));
}
}

