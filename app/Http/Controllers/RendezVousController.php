<?php

namespace App\Http\Controllers;

use App\Models\RendezVousDisponible;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RendezVousController extends Controller
{
    public function index()
    {
        // Générer les 14 prochains jours
        $dates = collect(range(0, 14))
            ->map(fn($i) => now()->addDays($i)->toDateString());

        // Heures fixes
        $heures = ['09:00', '10:00', '11:00', '14:00', '15:00'];

        // Charger les créneaux existants
        $slots = [];
        foreach ($dates as $date) {
            foreach ($heures as $heure) {
                $slots[$date][$heure] = RendezVousDisponible::where('date', $date)
                    ->where('heure', $heure)
                    ->first();
            }
        }

        return view('admin.rendezvous.index', compact('dates', 'heures', 'slots'));
    }

    public function store(Request $request)
    {
        // Création d’un créneau
        if ($request->action === 'create') {
            RendezVousDisponible::firstOrCreate([
                'date' => $request->date,
                'heure' => $request->heure,
            ], [
                'est_disponible' => true
            ]);

            return back()->with('success', 'Créneau ajouté');
        }

        // Mise à jour des disponibilités
        $ids = $request->creneaux ?? [];

        // Tout mettre à indisponible
        RendezVousDisponible::query()->update(['est_disponible' => false]);

        // Réactiver ceux cochés
        RendezVousDisponible::whereIn('id', $ids)->update(['est_disponible' => true]);

        return back()->with('success', 'Disponibilités mises à jour');
    }
}



