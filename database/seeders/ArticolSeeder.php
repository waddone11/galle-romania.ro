<?php

namespace Database\Seeders;

use App\Models\Articol;
use Illuminate\Database\Seeder;

class ArticolSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'slug'         => 'cum-alegi-lemnul-de-foc',
                'titlu'        => ['ro' => 'Cum alegi lemnul de foc potrivit pentru casa ta', 'de' => null, 'en' => null],
                'excerpt'      => ['ro' => 'Stejar, fag, carpen — diferentele care conteaza la pret, putere calorica si durata arderii.', 'de' => null, 'en' => null],
                'continut'     => ['ro' => 'Stejarul are putere calorica medie-mare (~4.2 kWh/kg) si arde lent — perfect pentru cazane. Fagul (~4.0) arde mai repede dar mai uniform. Carpenul (~4.3) e cel mai dens si arde cel mai lent — ideal pentru regim economic. Toate trei necesita usucare la 18-20% umiditate inainte de utilizare.', 'de' => null, 'en' => null],
                'categorie'    => 'ghid',
                'published_at' => now()->subDays(30),
                'is_published' => true,
            ],
            [
                'slug'         => 'fsc-pefc-iso-diferente',
                'titlu'        => ['ro' => 'FSC, PEFC, ISO — ce certificare e mai importanta?', 'de' => null, 'en' => null],
                'excerpt'      => ['ro' => 'Comparatie educationala intre certificarile forestiere — care arata responsabilitatea reala in industrie.', 'de' => null, 'en' => null],
                'continut'     => ['ro' => 'FSC (Forest Stewardship Council) si PEFC (Programme for the Endorsement of Forest Certification) sunt certificari de lant de custodie — verifica originea lemnului. ISO 9001 si ISO 14001 sunt certificari de management organizational, nu de produs. Pentru un cumparator atent: FSC/PEFC > ISO, pentru ca trateaza padurea direct.', 'de' => null, 'en' => null],
                'categorie'    => 'studiu',
                'published_at' => now()->subDays(15),
                'is_published' => true,
            ],
            [
                'slug'         => 'parteneriat-galle-gmbh',
                'titlu'        => ['ro' => 'Parteneriatul Galle Silva — Galle GmbH', 'de' => null, 'en' => null],
                'excerpt'      => ['ro' => 'Cum aducem standardele germane in gestionarea padurii din Romania.', 'de' => null, 'en' => null],
                'continut'     => ['ro' => 'Galle GmbH gestioneaza paduri si livreaza materiale lemnoase in Germania de peste 30 de ani, cu certificari ISO 9001, ISO 14001, RAL si DEKRA. Galle Silva, partenerul roman, aplica acelasi set de proceduri si standarde tehnice pe operatiunile din Prahova, Ilfov si Bucuresti.', 'de' => null, 'en' => null],
                'categorie'    => 'noutati',
                'published_at' => now()->subDays(5),
                'is_published' => true,
            ],
        ];

        foreach ($rows as $row) {
            Articol::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
