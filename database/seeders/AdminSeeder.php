<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'schanecame@yahoo.fr'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Chanecame2644'),
                'is_admin' => true,
            ]
        );
    }
}

