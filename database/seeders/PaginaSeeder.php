<?php

namespace Database\Seeders;

use App\Models\Pagina;
use Illuminate\Database\Seeder;

class PaginaSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'slug' => 'home',
                'titlu' => ['ro' => 'Acasa', 'de' => 'Startseite', 'en' => 'Home'],
                'meta_title' => ['ro' => 'Galle Silva — partener local Galle GmbH Germania', 'de' => null, 'en' => null],
                'meta_description' => ['ro' => 'Standarde germane in Romania: lemn de foc, servicii forestiere, peisagistica si compostare in Prahova, Ilfov si Bucuresti.', 'de' => null, 'en' => null],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 0,
            ],
            [
                'slug' => 'despre',
                'titlu' => ['ro' => 'Despre noi', 'de' => 'Uber uns', 'en' => 'About'],
                'meta_title' => ['ro' => 'Despre Galle Silva si parteneriatul cu Galle GmbH Germania', 'de' => null, 'en' => null],
                'meta_description' => ['ro' => 'Galle Silva este partenerul local in Romania al Galle GmbH Germania — aducem standarde germane in gestiunea padurii si comertul cu lemn.', 'de' => null, 'en' => null],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 10,
            ],
            [
                'slug' => 'institutii',
                'titlu' => ['ro' => 'Pentru institutii si primarii', 'de' => null, 'en' => null],
                'meta_title' => ['ro' => 'Servicii pentru primarii, institutii si companii — Galle Silva', 'de' => null, 'en' => null],
                'meta_description' => ['ro' => 'Servicii forestiere, peisagistica si compostare pentru primarii, institutii si companii din Prahova, Ilfov si Bucuresti.', 'de' => null, 'en' => null],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 20,
            ],
            [
                'slug' => 'certificari',
                'titlu' => ['ro' => 'Certificari', 'de' => 'Zertifizierungen', 'en' => 'Certifications'],
                'meta_title' => ['ro' => 'Certificari FSC, PEFC, ISO — Galle Silva si Galle GmbH', 'de' => null, 'en' => null],
                'meta_description' => ['ro' => 'FSC si PEFC in proces de certificare. Galle GmbH detine ISO 9001, ISO 14001, RAL si DEKRA. De ce conteaza fiecare?', 'de' => null, 'en' => null],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 30,
            ],
            [
                'slug' => 'termeni',
                'titlu' => ['ro' => 'Termeni si conditii', 'de' => 'AGB', 'en' => 'Terms'],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 100,
            ],
            [
                'slug' => 'confidentialitate',
                'titlu' => ['ro' => 'Politica de confidentialitate', 'de' => 'Datenschutz', 'en' => 'Privacy'],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 110,
            ],
            [
                'slug' => 'cookies',
                'titlu' => ['ro' => 'Politica cookies', 'de' => 'Cookies', 'en' => 'Cookies'],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 120,
            ],
        ];

        foreach ($rows as $row) {
            Pagina::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
