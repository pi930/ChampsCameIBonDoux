<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RendezVousDisponible;
use Illuminate\Http\Request;

class AdminRendezVousController extends Controller
{
 public function index()
{
    $creneaux = RendezVousDisponible::all();

    // Jours affichés dans le tableau
    $jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];

    // Heures uniques
    $heures = $creneaux->pluck('heure')->unique()->sort()->values();

    // Préparation du tableau [Jour][Heure] = slot
    $slots = [];

    foreach ($creneaux as $c) {

        // Convertit la date en jour EXACT correspondant à ton tableau
        $jourCarbon = \Carbon\Carbon::parse($c->date)->locale('fr')->dayName;
        $jourFormat = ucfirst($jourCarbon); // "lundi" → "Lundi"

        $slots[$jourFormat][$c->heure] = $c;
    }

    return view('admin.rendezvous.index', compact('jours', 'heures', 'slots'));
}



    public function store(Request $request)
{
    if ($request->action === 'create') {

        $request->validate([
            'jour' => 'required',
            'heure' => 'required'
        ]);

        // Convertir "Lundi" → une vraie date
        $date = $this->convertirJourEnDate($request->jour);

        RendezVousDisponible::create([
            'date' => $date,
            'heure' => $request->heure,
            'est_disponible' => true,
            'telephone' => null,
        ]);

        return redirect()->route('admin.rendezvous.index')
                         ->with('success', 'Créneau débloqué');
    }

    // Mise à jour des créneaux existants
    $ids = $request->creneaux ?? [];

    RendezVousDisponible::query()->update(['est_disponible' => false]);
    RendezVousDisponible::whereIn('id', $ids)->update(['est_disponible' => true]);

    return redirect()->route('admin.rendezvous.index');
}
    private function convertirJourEnDate($jour)
{
    $aujourdhui = now();
    $jourSemaine = match($jour) {
        'Lundi' => 1,
        'Mardi' => 2,
        'Mercredi' => 3,
        'Jeudi' => 4,
        'Vendredi' => 5,
        'Samedi' => 6,
        'Dimanche' => 0,
    };

    $dateCible = $aujourdhui->copy()->next($jourSemaine);

    return $dateCible->toDateString();

}

}