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
                // Fluxul complet al template-ului (design/index.html), randat 1:1 din CMS.
                // Editorul poate sterge / reordona / adauga din /admin Pagina = home.
                // RO completat; DE/EN raman null (se completeaza din taburile admin).
                'sectiuni' => [
                    [
                        'type' => 'hero',
                        'data' => [
                            'badge' => ['ro' => 'Servicii forestiere si lemn de foc', 'de' => null, 'en' => null],
                            'badge_link' => ['ro' => 'Vezi serviciile', 'de' => null, 'en' => null],
                            'badge_url' => '/servicii',
                            'titlu' => ['ro' => 'Padurea, gestionata cu responsabilitate', 'de' => null, 'en' => null],
                            'subtitlu' => ['ro' => 'Recoltare durabila, lemn de foc de calitate si servicii forestiere profesionale in Prahova, Ilfov si Bucuresti.', 'de' => null, 'en' => null],
                            'cta_text' => ['ro' => 'Cere oferta', 'de' => null, 'en' => null],
                            'cta_url' => '/contact',
                            'chips' => [
                                [
                                    'icon' => 'flacara',
                                    'text' => ['ro' => 'Lemn de foc', 'de' => null, 'en' => null],
                                    'tooltip' => ['ro' => 'Esente tari (stejar, carpen, fag), livrate acasa.', 'de' => null, 'en' => null],
                                ],
                                [
                                    'icon' => 'copaci',
                                    'text' => ['ro' => 'Exploatare forestiera', 'de' => null, 'en' => null],
                                    'tooltip' => ['ro' => 'Prestari servicii in paduri private si de stat.', 'de' => null, 'en' => null],
                                ],
                                [
                                    'icon' => 'handshake',
                                    'text' => ['ro' => 'Achizitie masa lemnoasa', 'de' => null, 'en' => null],
                                    'tooltip' => ['ro' => 'Pe picior sau fasonata — evaluare corecta.', 'de' => null, 'en' => null],
                                ],
                                [
                                    'icon' => 'excavator',
                                    'text' => ['ro' => 'Curatare terenuri', 'de' => null, 'en' => null],
                                    'tooltip' => ['ro' => 'Defrisare controlata, fara suprafata minima.', 'de' => null, 'en' => null],
                                ],
                                [
                                    'icon' => 'frunza',
                                    'text' => ['ro' => 'Certificare FSC & PEFC', 'de' => null, 'en' => null],
                                    'tooltip' => ['ro' => 'Surse responsabile, in proces de certificare.', 'de' => null, 'en' => null],
                                ],
                                [
                                    'icon' => 'camion',
                                    'text' => ['ro' => 'Livrare locala', 'de' => null, 'en' => null],
                                    'tooltip' => ['ro' => 'Prahova, Ilfov, Bucuresti · 1-3 zile.', 'de' => null, 'en' => null],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'splitter',
                        'data' => [],
                    ],
                    [
                        'type' => 'carduri',
                        'data' => [
                            'eyebrow' => ['ro' => 'De ce Galle', 'de' => null, 'en' => null],
                            'titlu' => ['ro' => 'Standarde germane, aplicate local', 'de' => null, 'en' => null],
                            'items' => [
                                [
                                    'titlu' => ['ro' => 'Calitate germana', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Procese si standarde Galle GmbH, aplicate la fiecare comanda si proiect.', 'de' => null, 'en' => null],
                                    'icon' => 'heroicon-o-check-badge',
                                ],
                                [
                                    'titlu' => ['ro' => 'Recoltare durabila', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Paduri gestionate responsabil, certificari FSC si PEFC in lucru.', 'de' => null, 'en' => null],
                                    'icon' => 'heroicon-o-globe-europe-africa',
                                ],
                                [
                                    'titlu' => ['ro' => 'Livrare rapida', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Lemn de foc livrat in 2-5 zile in Prahova, Ilfov si Bucuresti.', 'de' => null, 'en' => null],
                                    'icon' => 'heroicon-o-truck',
                                ],
                                [
                                    'titlu' => ['ro' => 'Pentru firme si institutii', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Servicii forestiere, peisagistica si compostare, cu factura si plata la termen.', 'de' => null, 'en' => null],
                                    'icon' => 'heroicon-o-building-office-2',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'solutie_verde',
                        'data' => [
                            'titlu' => ['ro' => 'Solutia noastra verde', 'de' => null, 'en' => null],
                            'text' => ['ro' => 'Tinem cont mereu de mediu, sustenabilitate si responsabilitate cand recoltam si livram. Padure gestionata durabil, certificari FSC si PEFC in lucru, lemn de foc de calitate.', 'de' => null, 'en' => null],
                            'eyebrow' => ['ro' => 'Avem o viziune', 'de' => null, 'en' => null],
                            'cta_text' => ['ro' => 'Despre noi', 'de' => null, 'en' => null],
                            'cta_url' => '/despre',
                        ],
                    ],
                    [
                        'type' => 'durabilitate_stat',
                        'data' => [
                            'titlu' => ['ro' => 'Durabil & regenerabil', 'de' => null, 'en' => null],
                            'text' => ['ro' => 'Lemnul de foc Galle Silva provine din paduri gestionate responsabil — o resursa regenerabila. Certificari FSC si PEFC in lucru, in acord cu principalele standarde de sustenabilitate.', 'de' => null, 'en' => null],
                            'stat_number' => '100%',
                            'stat_top' => ['ro' => 'natural', 'de' => null, 'en' => null],
                            'stat_bottom' => ['ro' => '& regenerabil', 'de' => null, 'en' => null],
                        ],
                    ],
                    [
                        'type' => 'reciclare',
                        'data' => [
                            'titlu' => ['ro' => 'Resursa regenerabila', 'de' => null, 'en' => null],
                            'text' => ['ro' => 'Padurea gestionata responsabil se regenereaza: ce recoltam, se replanteaza. Un ciclu sustenabil, certificat FSC si PEFC, care pastreaza resursa vie pentru generatiile urmatoare.', 'de' => null, 'en' => null],
                            'eyebrow' => ['ro' => 'Solutii complete pentru lemn si padure', 'de' => null, 'en' => null],
                            'cta_text' => ['ro' => 'Serviciile noastre', 'de' => null, 'en' => null],
                            'cta_url' => '/servicii',
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => ['ro' => 'Vrei o oferta personalizata?', 'de' => null, 'en' => null],
                            'text' => ['ro' => 'Pentru lemn de foc, servicii forestiere sau peisagistica — spune-ne ce ai nevoie si te contactam in 24h.', 'de' => null, 'en' => null],
                            'buton_text' => ['ro' => 'Cere oferta', 'de' => null, 'en' => null],
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
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
