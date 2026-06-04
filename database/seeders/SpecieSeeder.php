<?php

namespace Database\Seeders;

use App\Enums\SpecieStatus;
use App\Enums\SpecieUnitate;
use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpecieSeeder extends Seeder
{
    public function run(): void
    {
        $species = [
            [
                'slug' => 'stejar',
                'nume' => ['ro' => 'Stejar', 'de' => 'Eiche',     'en' => 'Oak'],
                'descriere' => [
                    'ro' => 'Lemn de stejar uscat la nivelul de umiditate cerut pentru ardere eficienta. Putere calorica mare, fum putin, jar persistent. Recomandare clasica pentru sezonul rece in Romania.',
                    'de' => 'Eichenholz, getrocknet auf die für effizientes Brennen erforderliche Restfeuchte. Hoher Heizwert, wenig Rauch, langanhaltende Glut. Der Klassiker für die kalte Jahreszeit in Rumänien.',
                    'en' => 'Oak firewood dried to the moisture level required for efficient burning. High heating value, little smoke, long-lasting embers. The classic choice for the cold season in Romania.',
                ],
                'status' => SpecieStatus::Disponibil,
                'pret_pornire' => 450.00,
                'unitate' => SpecieUnitate::Ster,
                'pret_per_unitate' => 480.00,
                'putere_calorica' => 4.20,
                'is_active' => true,
                'ordine' => 10,
            ],
            [
                'slug' => 'fag',
                'nume' => ['ro' => 'Fag', 'de' => 'Buche', 'en' => 'Beech'],
                'descriere' => [
                    'ro' => 'Lemn de fag — alternativa premium la stejar pentru ardere indelungata. Va fi disponibil in urmatoarea recolta.',
                    'de' => 'Buchenholz — die Premium-Alternative zur Eiche für langanhaltendes Feuer. Mit der nächsten Ernte wieder verfügbar.',
                    'en' => 'Beech firewood — the premium alternative to oak for a long-lasting fire. Available with the next harvest.',
                ],
                'status' => SpecieStatus::InCurand,
                'pret_pornire' => 420.00,
                'unitate' => SpecieUnitate::Ster,
                'pret_per_unitate' => 450.00,
                'putere_calorica' => 4.00,
                'is_active' => true,
                'ordine' => 20,
            ],
            [
                'slug' => 'carpen',
                'nume' => ['ro' => 'Carpen', 'de' => 'Hainbuche', 'en' => 'Hornbeam'],
                'descriere' => [
                    'ro' => 'Lemn de carpen, dens, cu ardere lentă și putere calorică foarte bună — pe stoc, tăiat și crăpat la dimensiunea dorită.',
                    'de' => 'Hainbuchenholz: dicht, mit langsamem Abbrand und sehr gutem Heizwert — auf Lager, gesägt und gespalten auf Wunschmaß.',
                    'en' => 'Hornbeam firewood: dense, slow-burning, with a very good heating value — in stock, cut and split to the size you need.',
                ],
                'status' => SpecieStatus::Disponibil,
                'pret_pornire' => 350.00,
                'unitate' => SpecieUnitate::Ster,
                'pret_per_unitate' => 380.00,
                'putere_calorica' => 4.30,
                'is_active' => true,
                'ordine' => 30,
            ],
        ];

        foreach ($species as $row) {
            Specie::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
