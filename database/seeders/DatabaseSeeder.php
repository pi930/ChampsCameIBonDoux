<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Event;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Event::fakeFor(function () {
            $this->call([
                ProduitCultiverSeeder::class,
                SemisSeeder::class,
                RendezVousDisponibleSeeder::class,
                AdminSeeder::class,
            ]);
        });
    }
}
