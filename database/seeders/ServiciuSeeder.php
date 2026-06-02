<?php

namespace Database\Seeders;

use App\Enums\ServiciuAudienta;
use App\Enums\ServiciuCategorie;
use App\Models\Serviciu;
use Illuminate\Database\Seeder;

class ServiciuSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'slug'      => 'servicii-forestiere',
                'titlu'     => ['ro' => 'Servicii forestiere', 'de' => 'Forstdienstleistungen', 'en' => 'Forestry services'],
                'descriere' => [
                    'ro' => 'Gestionam padurea proprietarilor privati, primarilor si companiilor — planificare, recoltare, regenerare.',
                    'de' => null, 'en' => null,
                ],
                'continut'  => [
                    'ro' => 'Echipa Galle Silva ofera consultanta tehnica, evaluare arbori, planificare recoltari, transport si regenerare. Lucram pe baza standardelor Galle GmbH si urmarim regenerarea naturala unde e posibil.',
                    'de' => null, 'en' => null,
                ],
                'categorie' => ServiciuCategorie::Forestier,
                'audienta'  => ServiciuAudienta::Ambele,
                'is_active' => true,
                'ordine'    => 10,
            ],
            [
                'slug'      => 'peisagistica',
                'titlu'     => ['ro' => 'Peisagistica', 'de' => 'Landschaftsbau', 'en' => 'Landscaping'],
                'descriere' => [
                    'ro' => 'Amenajari de spatii verzi pentru primarii, institutii si companii. Proiectare + executie + mentenanta.',
                    'de' => null, 'en' => null,
                ],
                'continut'  => [
                    'ro' => 'De la concept la mentenanta — Galle Silva amenajeaza parcuri, gradini institutionale si zone verzi industriale.',
                    'de' => null, 'en' => null,
                ],
                'categorie' => ServiciuCategorie::Peisagistica,
                'audienta'  => ServiciuAudienta::Institutie,
                'is_active' => true,
                'ordine'    => 20,
            ],
            [
                'slug'      => 'compostare',
                'titlu'     => ['ro' => 'Compostare', 'de' => 'Kompostierung', 'en' => 'Composting'],
                'descriere' => [
                    'ro' => 'Compostare deseuri organice forestiere si agricole, conform standardelor germane Galle GmbH.',
                    'de' => null, 'en' => null,
                ],
                'continut'  => [
                    'ro' => 'Procesul nostru de compostare transforma deseuri lemnoase si verzi in fertilizant organic, reducand presiunea pe gropile de gunoi si sustinand circuitul natural.',
                    'de' => null, 'en' => null,
                ],
                'categorie' => ServiciuCategorie::Compostare,
                'audienta'  => ServiciuAudienta::Ambele,
                'is_active' => true,
                'ordine'    => 30,
            ],
        ];

        foreach ($rows as $row) {
            Serviciu::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
