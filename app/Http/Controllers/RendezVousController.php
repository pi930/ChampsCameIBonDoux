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
    ->where('date', '>=', now()->toDateString())
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

    session(['rendezvous_id' => $request->rendezvous_id]);

    return redirect()->route('panier.recap');
}


}

