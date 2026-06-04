<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SpecieSeeder::class,
            ServiciuSeeder::class,
            CertificareSeeder::class,
            ZonaLivrareSeeder::class,
            LocalitateSeeder::class,
            FaqSeeder::class,
            PaginaSeeder::class,
            ProiectSeeder::class,
            ArticolSeeder::class,
            TraducereSeeder::class,
        ]);
    }
}
