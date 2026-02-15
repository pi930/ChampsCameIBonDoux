<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RendezVousDisponible;

class GenererCreneaux extends Command
{
    protected $signature = 'rendezvous:generer';
    protected $description = 'Génère les créneaux pour les 30 prochains jours';

    public function handle()
    {
        $heures = ['09:00', '10:00', '11:00', '14:00', '15:00'];

        for ($i = 0; $i < 30; $i++) {
            $date = now()->addDays($i)->toDateString();

            foreach ($heures as $heure) {
                RendezVousDisponible::firstOrCreate([
                    'date' => $date,
                    'heure' => $heure,
                ], [
                    'est_disponible' => true
                ]);
            }
        }

        $this->info('Créneaux générés avec succès.');
    }
}
