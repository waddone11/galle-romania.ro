<?php

namespace Database\Seeders;

use App\Models\Membru;
use Illuminate\Database\Seeder;

class MembruSeeder extends Seeder
{
    /**
     * Echipa Galle Silva — rolurile traduse (RO/DE/EN) sunt preluate din fostul
     * bloc `carduri` de pe /despre. Pozele se incarca din /admin (vezi
     * docs/poze-necesare.md); pana atunci blocul `echipa` afiseaza initialele.
     */
    public function run(): void
    {
        $rows = [
            [
                'nume' => 'Răzvan Solzaru',
                'rol' => ['ro' => 'Manager general', 'de' => 'Geschäftsführer', 'en' => 'General Manager'],
                'ordine' => 10,
            ],
            [
                'nume' => 'Ion Narcis Marin',
                'rol' => ['ro' => 'Manager operațiuni', 'de' => 'Betriebsleiter', 'en' => 'Operations Manager'],
                'ordine' => 20,
            ],
            [
                'nume' => 'Dragici Dumitru',
                'rol' => ['ro' => 'Operator harvester', 'de' => 'Harvester-Fahrer', 'en' => 'Harvester operator'],
                'ordine' => 30,
            ],
            [
                'nume' => 'Roată Alexandru',
                'rol' => ['ro' => 'Muncitor în silvicultură', 'de' => 'Forstwirt', 'en' => 'Forestry worker'],
                'ordine' => 40,
            ],
        ];

        foreach ($rows as $row) {
            Membru::updateOrCreate(['nume' => $row['nume']], $row + ['is_active' => true]);
        }
    }
}
