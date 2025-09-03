<?php

namespace Database\Seeders;

use App\Models\Encomienda;
use App\Models\User;
use Illuminate\Database\Seeder;

class EncomiendasSeeder extends Seeder
{
    public function run()
    {
        // Crear 3 remitente con 5 encomiendas cada uno
        User::factory()
            ->count(3)
            ->create(['rol' => 'remitente'])
            ->each(function ($user) {
                Encomienda::factory()
                    ->count(5)
                    ->create(['remitente_id' => $user->id]);
            });
    }
}