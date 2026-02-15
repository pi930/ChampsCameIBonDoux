<?php
namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\RendezVousDisponible;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezvous = RendezVousDisponible::where('est_disponible', true)->get();

        return view('rendezvous.index', compact('rendezvous'));
    }

  public function choisir(Request $request)
{
    $request->validate([
        'rendezvous_id' => 'required|exists:rendez_vous_disponibles,id'
    ]);

    session(['rendezvous_id' => $request->rendezvous_id]);

    return redirect()->route('panier.recap');
}


}

