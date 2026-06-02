<?php

namespace Database\Seeders;

use App\Models\ZonaLivrare;
use Illuminate\Database\Seeder;

class ZonaLivrareSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'judet'        => 'Prahova',
                'localitati'   => ['Ploiesti', 'Campina', 'Sinaia', 'Busteni', 'Plopeni', 'Boldesti-Scaeni'],
                'cost_livrare' => 120.00,
                'nota'         => ['ro' => 'Livrare standard 2-5 zile lucratoare.', 'de' => null, 'en' => null],
                'is_active'    => true,
                'ordine'       => 10,
            ],
            [
                'judet'        => 'Ilfov',
                'localitati'   => ['Buftea', 'Voluntari', 'Otopeni', 'Pantelimon', 'Magurele', 'Bragadiru', 'Popesti-Leordeni'],
                'cost_livrare' => 150.00,
                'nota'         => ['ro' => 'Livrare standard 2-4 zile lucratoare.', 'de' => null, 'en' => null],
                'is_active'    => true,
                'ordine'       => 20,
            ],
            [
                'judet'        => 'Bucuresti',
                'localitati'   => ['Sector 1', 'Sector 2', 'Sector 3', 'Sector 4', 'Sector 5', 'Sector 6'],
                'cost_livrare' => 180.00,
                'nota'         => ['ro' => 'Livrare standard 2-4 zile lucratoare. Costuri suplimentare pentru zone cu acces dificil.', 'de' => null, 'en' => null],
                'is_active'    => true,
                'ordine'       => 30,
            ],
        ];

        foreach ($rows as $row) {
            ZonaLivrare::updateOrCreate(['judet' => $row['judet']], $row);
        }
    }
}
