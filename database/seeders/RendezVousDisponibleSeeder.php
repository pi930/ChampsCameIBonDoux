<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RendezVousDisponible;
use Carbon\Carbon;

class RendezVousDisponibleSeeder extends Seeder
{
    public function run()
    {
        $heures = [
            '09:00',
            '10:00',
            '11:00',
            '14:00',
            '15:00',
            '16:00'
        ];

        // Création pour les 7 prochains jours
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i)->format('Y-m-d');

            foreach ($heures as $heure) {
                RendezVousDisponible::create([
                    'date' => $date,
                    'heure' => $heure,
                    'telephone' => null,
                    'est_disponible' => true
                ]);
            }
        }
    }
}

