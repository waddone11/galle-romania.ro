<?php

namespace Database\Seeders;

use App\Models\Pagina;
use Illuminate\Database\Seeder;

class PaginaSeeder extends Seeder
{
    public function run(): void
    {
        // Helper pentru campuri traductibile: RO completat, DE/EN raman null
        // (le completeaza owner-ul din taburile admin).
        $t = fn (?string $ro): array => ['ro' => $ro, 'de' => null, 'en' => null];

        /** @var array<int, array<string, mixed>> $rows */
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
                        'type' => 'manifest',
                        'data' => [
                            'eyebrow' => ['ro' => 'GALLE SILVA', 'de' => null, 'en' => null],
                            'titlu_mare' => ['ro' => 'Scoatem padurea din ceata.', 'de' => null, 'en' => null],
                            'tagline' => ['ro' => 'Limpede, de la padure pana la tine.', 'de' => null, 'en' => null],
                            'intro' => ['ro' => 'Suntem partenerul tau forestier din Prahova: recoltam responsabil, transportam si livram lemn de calitate — cu experienta si standardele grupului german Galle. Fara batai de cap, fara surprize.', 'de' => null, 'en' => null],
                        ],
                    ],
                    [
                        'type' => 'splitter',
                        'data' => [],
                    ],
                    [
                        'type' => 'text_imagine',
                        'data' => [
                            'titlu' => ['ro' => 'Cine suntem', 'de' => null, 'en' => null],
                            'continut' => ['ro' => 'Galle Silva aduce in Romania experienta grupului german Galle GmbH — aproape 25 de ani in silvicultura. Lucram cu utilaje moderne (harvester si forwarder), echipa specializata si autospeciale proprii, in paduri private si de stat. De la recoltare la livrare, ducem lucrarea cap-coada, corect si transparent.', 'de' => null, 'en' => null],
                            'cta_text' => ['ro' => 'Despre noi', 'de' => null, 'en' => null],
                            'imagine' => '/images/galle/proiecte/harvester-padure.webp',
                            'cta_url' => '/despre',
                            'pozitie' => 'dreapta',
                        ],
                    ],
                    [
                        'type' => 'servicii',
                        'data' => [
                            'eyebrow' => ['ro' => 'Ce facem', 'de' => null, 'en' => null],
                            'titlu' => ['ro' => 'Servicii forestiere complete', 'de' => null, 'en' => null],
                            'items' => [
                                [
                                    'icon' => 'copaci',
                                    'titlu' => ['ro' => 'Exploatare forestiera', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Recoltam lemnul cu harvester si forwarder, in paduri private si de stat. Taiere, fasonare si scos-apropiat — lucrare completa.', 'de' => null, 'en' => null],
                                    'imagine' => '/images/galle/proiecte/harvester-exploatare.webp',
                                    'url' => '/servicii/exploatare-forestiera',
                                ],
                                [
                                    'icon' => 'handshake',
                                    'titlu' => ['ro' => 'Achizitie masa lemnoasa', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Cumparam masa lemnoasa pe picior sau fasonata. Evaluam corect si platim transparent. Ai padure de valorificat? Vorbeste cu noi.', 'de' => null, 'en' => null],
                                    'imagine' => '/images/galle/proiecte/depozit-busteni.webp',
                                    'url' => '/servicii/achizitie-masa-lemnoasa',
                                ],
                                [
                                    'icon' => 'excavator',
                                    'titlu' => ['ro' => 'Curatare si defrisare terenuri', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Curatam terenul de copaci, arbusti si cioate — pentru constructii sau agricultura. Fara suprafata minima.', 'de' => null, 'en' => null],
                                    'imagine' => null,
                                    'url' => '/servicii/curatare-terenuri',
                                ],
                                [
                                    'icon' => 'camion',
                                    'titlu' => ['ro' => 'Transport lemn', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Transportam lemnul cu autospeciale proprii, din padure pana la depozit sau la tine.', 'de' => null, 'en' => null],
                                    'imagine' => '/images/galle/proiecte/camion-transport-lemn.webp',
                                    'url' => '/servicii/transport-lemn',
                                ],
                                [
                                    'icon' => 'flacara',
                                    'titlu' => ['ro' => 'Lemn de foc', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Esente tari — stejar, carpen, fag — livrate in Prahova, Ilfov si Bucuresti.', 'de' => null, 'en' => null],
                                    'imagine' => null,
                                    'url' => '/lemn-de-foc',
                                ],
                                [
                                    'icon' => 'frunza',
                                    'titlu' => ['ro' => 'Lucrari silvice & documentatie', 'de' => null, 'en' => null],
                                    'text' => ['ro' => 'Rarituri, curatiri si actele aferente (APV, documente de insotire). Te ghidam de la cap la coada.', 'de' => null, 'en' => null],
                                    'imagine' => null,
                                    'url' => '/servicii/lucrari-silvice',
                                ],
                            ],
                        ],
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
                                    'text' => ['ro' => 'Servicii forestiere, transport si curatare terenuri, cu factura si plata la termen.', 'de' => null, 'en' => null],
                                    'icon' => 'heroicon-o-building-office-2',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'galerie',
                        'data' => [
                            'titlu' => ['ro' => 'De la fata locului', 'de' => null, 'en' => null],
                            'imagini' => [
                                '/images/galle/proiecte/forwarder-panta.webp',
                                '/images/galle/proiecte/depozit-busteni.webp',
                                '/images/galle/proiecte/forwarder-camp.webp',
                                '/images/galle/proiecte/harvester-padure.webp',
                                '/images/galle/proiecte/camion-transport-lemn.webp',
                            ],
                            'video' => '/images/galle/proiecte/depozit-video.mp4',
                            'video_poster' => '/images/galle/proiecte/depozit-video-poster.webp',
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

            /*
             * ---------- Servicii (overview + 5 pagini de serviciu) ----------
             * Randate prin SiteController::servicii() / serviciuPage() din
             * view-ul generic site/pagina.blade.php. FAQ-urile vin din Faq cu
             * categorie = slug-ul paginii (vezi FaqSeeder).
             */
            [
                'slug' => 'servicii',
                'titlu' => ['ro' => 'Servicii', 'de' => 'Leistungen', 'en' => 'Services'],
                'meta_title' => $t('Servicii forestiere Prahova — exploatare, achiziție, transport | Galle Silva'),
                'meta_description' => $t('Exploatare forestieră cu harvester și forwarder, achiziție masă lemnoasă, curățare terenuri, transport lemn și lucrări silvice în Prahova, Ilfov și București.'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Servicii forestiere complete în Prahova'),
                            'intro' => $t('Galle Silva oferă servicii forestiere complete — de la recoltarea lemnului cu utilaje moderne, la achiziția masei lemnoase, transport și curățarea terenurilor. Lucrăm în păduri private și de stat, cu standardele grupului german Galle.'),
                        ],
                    ],
                    [
                        'type' => 'servicii',
                        'data' => [
                            'eyebrow' => $t('Ce facem'),
                            'titlu' => $t('Alege serviciul de care ai nevoie'),
                            'items' => [
                                [
                                    'icon' => 'copaci',
                                    'titlu' => $t('Exploatare forestieră'),
                                    'text' => $t('Recoltăm mecanizat, cu harvester și forwarder, în păduri private și de stat — lucrare completă, cu acte.'),
                                    'imagine' => '/images/galle/proiecte/harvester-exploatare.webp',
                                    'url' => '/servicii/exploatare-forestiera',
                                ],
                                [
                                    'icon' => 'handshake',
                                    'titlu' => $t('Achiziție masă lemnoasă'),
                                    'text' => $t('Cumpărăm pădure pe picior sau lemn fasonat. Evaluare corectă, plată transparentă.'),
                                    'imagine' => '/images/galle/proiecte/depozit-busteni.webp',
                                    'url' => '/servicii/achizitie-masa-lemnoasa',
                                ],
                                [
                                    'icon' => 'excavator',
                                    'titlu' => $t('Curățare terenuri'),
                                    'text' => $t('Curățăm terenul de vegetație, arbori și cioate — pentru construcții sau agricultură. Fără suprafață minimă.'),
                                    'imagine' => null,
                                    'url' => '/servicii/curatare-terenuri',
                                ],
                                [
                                    'icon' => 'camion',
                                    'titlu' => $t('Transport lemn'),
                                    'text' => $t('Transportăm lemn de foc, bușteni și lemn fasonat, cu autospeciale proprii cu macara.'),
                                    'imagine' => '/images/galle/proiecte/camion-transport-lemn.webp',
                                    'url' => '/servicii/transport-lemn',
                                ],
                                [
                                    'icon' => 'frunza',
                                    'titlu' => $t('Lucrări silvice'),
                                    'text' => $t('Curățiri, rărituri și tăieri de igienă, conform amenajamentului, împreună cu ocolul silvic.'),
                                    'imagine' => null,
                                    'url' => '/servicii/lucrari-silvice',
                                ],
                                [
                                    'icon' => 'flacara',
                                    'titlu' => $t('Lemn de foc'),
                                    'text' => $t('Stejar și carpen pe stoc, tăiat și crăpat, livrat în Prahova, Ilfov și București.'),
                                    'imagine' => null,
                                    'url' => '/lemn-de-foc',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Nu știi exact ce serviciu îți trebuie?'),
                            'text' => $t('Spune-ne ce ai de lucrat — pădure, teren sau lemn de transportat — și îți spunem noi cum te putem ajuta.'),
                            'buton_text' => $t('Cere o evaluare'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 5,
            ],
            [
                'slug' => 'exploatare-forestiera',
                'titlu' => $t('Exploatare forestieră'),
                'meta_title' => $t('Exploatare forestieră Prahova — harvester & forwarder | Galle Silva'),
                'meta_description' => $t('Prestări servicii de exploatare forestieră în păduri private și de stat. Recoltare mecanizată cu harvester și forwarder, lucrări corecte, documente complete (APV, SUMAL).'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Exploatare forestieră cu harvester și forwarder în Prahova'),
                            'intro' => $t('Realizăm exploatare forestieră ca prestări servicii, în păduri private și de stat, cu recoltare mecanizată (harvester și forwarder) și documentație completă.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Pentru păduri private și de stat'),
                            'continut' => $t("Lucrăm ca prestatori de servicii pentru proprietari de păduri private, ocoale silvice și administratori de fond forestier. Indiferent dacă ai câteva hectare moștenite sau administrezi suprafețe mari, ducem lucrarea cap-coadă: de la evaluare și acte, până la lemnul stivuit în platforma primară.\n\nVrei să-ți valorifici pădurea fără să te ocupi de nimic? Vezi [achiziția de masă lemnoasă](/servicii/achizitie-masa-lemnoasa) — cumpărăm noi, pe picior sau fasonat."),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Exploatare mecanizată: harvester + forwarder'),
                            'continut' => $t('Recoltăm mecanizat: harvesterul doboară, curăță de crengi și secționează arborele în câteva zeci de secunde, iar forwarderul scoate lemnul la drumul auto fără să-l târască prin sol. Rezultatul: lucrare rapidă, cu impact redus asupra solului și a arborilor rămași. Unde terenul o cere, completăm cu echipe de fasonatori cu experiență.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Etapele lucrării: doborât, secționat, scos-apropiat, platformă primară'),
                            'continut' => $t('Doborâm arborii marcați, îi secționăm la dimensiunile cerute, îi apropiem la drumul auto și îi stivuim în platforma primară, gata de [transport](/servicii/transport-lemn). La final predăm parchetul curat, conform autorizației de exploatare.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Lucrăm cu acte: APV, autorizații, SUMAL, avize'),
                            'continut' => $t('Toată recoltarea se face legal: pe baza actului de punere în valoare (APV), a autorizației de exploatare și cu avize de însoțire generate prin SUMAL. Dacă ești la prima exploatare și nu știi de unde să începi, te ghidăm pas cu pas, împreună cu ocolul silvic.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Zone acoperite'),
                            'continut' => $t('Lucrăm în principal în Prahova — Valea Doftanei, Câmpina, Comarnic, Breaza și împrejurimi — și ne deplasăm și în județele vecine, în funcție de volumul lucrării.'),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'exploatare-forestiera',
                            'titlu' => $t('Întrebări frecvente'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Cere o evaluare'),
                            'text' => $t('Trimite-ne locația pădurii și actele pe care le ai — sau doar ce știi despre ea — și venim la fața locului pentru evaluare.'),
                            'buton_text' => $t('Contactează-ne'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 6,
            ],
            [
                'slug' => 'achizitie-masa-lemnoasa',
                'titlu' => $t('Achiziție masă lemnoasă'),
                'meta_title' => $t('Achiziție masă lemnoasă — cumpărăm pădure | Galle Silva'),
                'meta_description' => $t('Cumpărăm masă lemnoasă pe picior sau fasonată în Prahova și zonele apropiate. Evaluare corectă, plată transparentă. Ai pădure de valorificat? Cere o evaluare.'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Cumpărăm masă lemnoasă pe picior sau fasonată în Prahova'),
                            'intro' => $t('Cumpărăm masă lemnoasă pe picior (arbori nerecoltați) sau fasonată (deja tăiată), oferind proprietarilor o cale corectă și transparentă de a-și valorifica pădurea.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ai pădure sau lemn de vânzare?'),
                            'continut' => $t('Dacă deții o pădure sau lemn deja recoltat și vrei să-l valorifici, cumpărăm direct, fără intermediari. Evaluăm corect, plătim transparent, iar de partea tehnică — [exploatare](/servicii/exploatare-forestiera), acte, [transport](/servicii/transport-lemn) — ne ocupăm noi.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cumpărăm pe picior'),
                            'continut' => $t('Masa lemnoasă pe picior înseamnă arborii aflați încă în pădure, nerecoltați, evaluați într-o partidă (APV). Tu primești banii, noi venim cu utilajele și echipa și ne ocupăm de recoltare de la primul până la ultimul arbore.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cumpărăm fasonat'),
                            'continut' => $t('Cumpărăm și lemn fasonat — deja tăiat — din platformă primară sau din depozit: bușteni pentru industrializare sau lemn pentru foc.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum evaluăm volumul și valoarea'),
                            'continut' => $t('Venim la fața locului și ne uităm la specie, volum, calitatea lemnului și accesibilitatea terenului. Pe baza lor primești o ofertă fermă, în scris — fără costuri ascunse și fără surprize la plată.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce documente sunt necesare'),
                            'continut' => $t('Actele de proprietate ale terenului, iar pentru recoltare — APV-ul întocmit prin ocolul silvic. Nu le ai pe toate? Te ajutăm cu pașii și documentele.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Plată, exploatare și transport'),
                            'continut' => $t('Plătim transparent, prin transfer bancar, pe bază de contract. După achiziție, recoltăm și transportăm cu resursele noastre — tu nu te mai ocupi de nimic. O parte din lemn ajunge [lemn de foc](/lemn-de-foc) livrat familiilor din zonă.'),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'achizitie-masa-lemnoasa',
                            'titlu' => $t('Întrebări frecvente'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Ai pădure de valorificat?'),
                            'text' => $t('Ne contactezi, venim la evaluare și îți facem o ofertă fermă, în scris.'),
                            'buton_text' => $t('Cere o evaluare'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 7,
            ],
            [
                'slug' => 'curatare-terenuri',
                'titlu' => $t('Curățare terenuri'),
                'meta_title' => $t('Curățare și defrișare teren Prahova | Galle Silva'),
                'meta_description' => $t('Curățăm terenuri de vegetație, arbori și cioate — pentru construcții sau agricultură. Scos cioate, frezare, tocare vegetație. Fără suprafață minimă.'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Curățare și defrișare terenuri în Prahova, București și Ilfov'),
                            'intro' => $t('Curățăm și pregătim terenuri de vegetație, arbuști, arbori și cioate, pentru construcții sau agricultură — fără suprafață minimă.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce curățăm'),
                            'continut' => $t('Terenuri pentru construcții, terenuri agricole abandonate, livezi îmbătrânite, curți și parcele invadate de vegetație. Lucrăm pentru persoane fizice, firme și primării — fără suprafață minimă.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Servicii: tăiere, scos cioate, frezare rădăcini, tocare vegetație'),
                            'continut' => $t('Tăiem vegetația și arborii, scoatem sau frezăm cioatele și rădăcinile, tocăm resturile vegetale și lăsăm terenul curat, gata de folosit. La cerere, preluăm și transportăm tot materialul rezultat.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Teren neforestier vs fond forestier'),
                            'continut' => $t('Pentru terenuri neforestiere (agricole sau intravilan), de regulă nu ai nevoie de autorizație silvică pentru tăierea copacilor. Pentru fond forestier, lucrările se fac doar cu aprobările legale. Îți spunem clar, de la început, în ce situație ești.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Utilaje și echipă'),
                            'continut' => $t('Lucrăm cu excavator, freză de cioate, tocătoare de vegetație și fasonatori cu experiență — aceeași echipă care lucrează și la [exploatările forestiere](/servicii/exploatare-forestiera). Materialul lemnos rezultat îl putem [transporta](/servicii/transport-lemn) noi.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum calculăm prețul'),
                            'continut' => $t('Prețul depinde de suprafață, densitatea vegetației și cât de ușor intră utilajele în teren. Trimite-ne câteva poze sau un video din teren și primești rapid o ofertă.'),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'curatare-terenuri',
                            'titlu' => $t('Întrebări frecvente'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Ai un teren de curățat?'),
                            'text' => $t('Trimite-ne poze sau un video din teren și primești o ofertă în cel mult 24 de ore.'),
                            'buton_text' => $t('Cere ofertă'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 8,
            ],
            [
                'slug' => 'transport-lemn',
                'titlu' => $t('Transport lemn'),
                'meta_title' => $t('Transport lemn și material lemnos | Galle Silva'),
                'meta_description' => $t('Transportăm lemn de foc, bușteni și lemn fasonat cu autospeciale proprii, cu documente de însoțire, în Prahova, Ilfov și București.'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Transport lemn cu autospeciale în Prahova, București și Ilfov'),
                            'intro' => $t('Transportăm lemn de foc, bușteni și material lemnos fasonat cu autospeciale proprii, din pădure, platformă primară sau depozit, cu documentele de însoțire la zi.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce transportăm'),
                            'continut' => $t('Lemn de foc pentru persoane fizice, bușteni și lemn fasonat pentru firme — de la o singură mașină pentru o gospodărie, până la curse regulate. Vezi și [lemnul de foc cu livrare la domiciliu](/lemn-de-foc).'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Autospeciale cu macara'),
                            'continut' => $t('Autospecialele noastre sunt echipate cu macara — încărcăm și descărcăm singuri, fără utilaje suplimentare, inclusiv în locuri mai greu accesibile.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('De unde și unde'),
                            'continut' => $t('Ridicăm lemnul din pădure (platformă primară), din depozit sau de unde ne spui tu — și îl ducem la depozite, fabrici sau direct la poarta clientului.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Documente și trasabilitate (SUMAL)'),
                            'continut' => $t('Fiecare transport pleacă cu aviz de însoțire generat prin SUMAL, conform legislației. Trasabilitate completă, de la pădure până la destinație.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Zone'),
                            'continut' => $t('Prahova, Ilfov și București pentru livrările de lemn de foc; pentru curse complete de bușteni ne deplasăm și mai departe.'),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'transport-lemn',
                            'titlu' => $t('Întrebări frecvente'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Ai lemn de transportat?'),
                            'text' => $t('Sună-ne sau scrie-ne — stabilim rapid distanța, volumul și prețul.'),
                            'buton_text' => $t('Contactează-ne'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 9,
            ],
            [
                'slug' => 'lucrari-silvice',
                'titlu' => $t('Lucrări silvice'),
                'meta_title' => $t('Lucrări silvice — rărituri și curățiri | Galle Silva'),
                'meta_description' => $t('Lucrări de îngrijire a pădurii: curățiri, rărituri, tăieri de igienă, conform amenajamentului silvic, în coordonare cu ocolul silvic.'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Lucrări silvice: curățiri, rărituri și întreținerea arboretelor'),
                            'intro' => $t('Executăm lucrări silvice de îngrijire — curățiri, rărituri și tăieri de igienă — conform amenajamentului silvic și în coordonare cu ocolul silvic.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Pentru păduri private și administrate'),
                            'continut' => $t('Lucrăm pentru proprietari de păduri private și pentru ocoale silvice, ca prestatori de servicii. O pădure îngrijită la timp crește mai sănătos și valorează mai mult la [exploatare](/servicii/exploatare-forestiera).'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Curățiri, rărituri, tăieri de igienă'),
                            'continut' => $t('Curățirile sunt intervenții în arboretele tinere, prin care se elimină exemplarele rău conformate. Răriturile extrag o parte din arbori, ca să le facă loc celor de viitor. Tăierile de igienă scot arborii uscați, rupți sau atacați de dăunători.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Conform amenajamentului'),
                            'continut' => $t('Toate lucrările se execută conform amenajamentului silvic și pe bază de marcaj — arborii care se extrag sunt stabiliți împreună cu ocolul silvic, nu la întâmplare.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Echipă și utilaje'),
                            'continut' => $t('Folosim echipe specializate în lucrări de îngrijire și utilaje potrivite pentru intervenții cu impact redus — aceleași standarde germane pe care le aplicăm la toate lucrările Galle.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Documente'),
                            'continut' => $t('Lucrările în fond forestier se fac cu servicii silvice asigurate prin ocol; materialul rezultat pleacă cu avize generate prin SUMAL. Te ghidăm prin tot procesul.'),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'lucrari-silvice',
                            'titlu' => $t('Întrebări frecvente'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Pădurea ta are nevoie de îngrijire?'),
                            'text' => $t('Spune-ne unde e și în ce stadiu e arboretul — venim la evaluare și îți propunem lucrările potrivite.'),
                            'buton_text' => $t('Cere o evaluare'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 9,
            ],

            /*
             * ---------- Lemn de foc ----------
             * Pagina blade dedicata (calculator + formular + zone) preia de aici
             * meta + sectiunile de continut. NU adauga header_pagina — H1-ul e
             * randat de blade (localizabil pe landing-urile /lemn-de-foc/{loc}).
             */
            [
                'slug' => 'lemn-de-foc',
                'titlu' => ['ro' => 'Lemn de foc', 'de' => 'Brennholz', 'en' => 'Firewood'],
                'meta_title' => $t('Lemn de foc Prahova — stejar, carpen, fag, cu livrare | Galle Silva'),
                'meta_description' => $t('Lemn de foc de esență tare (stejar, carpen, fag), tăiat și crăpat, de la 350 lei/m³. Livrare în Prahova, Ilfov și București. Fără cantitate minimă.'),
                'sectiuni' => [
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Preț: de la 350 lei/m³'),
                            'continut' => $t("Prețul de pornire este 350 lei/m³ și variază în funcție de esență, modul de preluare și cantitate. Fără cantitate minimă. Oferim livrare la domiciliu sau ridicare din platforma primară.\n\nLemnul vine din [exploatările noastre forestiere](/servicii/exploatare-forestiera) din Prahova — de la pădure la tine, fără intermediari."),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Esențe: stejar și carpen pe stoc'),
                            'continut' => $t('Pe stoc acum: stejar și carpen. Esențe tari, cu ardere lungă: carpen, fag, stejar, frasin, salcâm, ulm, dud. Esențe moi, pentru aprindere sau ardere rapidă: plop, tei, rășinoase.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum vindem'),
                            'continut' => $t('Vindem la metru cub (m³) sau la metru ster, tăiat și crăpat la dimensiunea cerută de soba, centrala sau șemineul tău.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Livrare și plată'),
                            'continut' => $t('Livrăm în 1–3 zile (maximum 7), în funcție de zonă, cu [autospecialele noastre](/servicii/transport-lemn). Plata la livrare — cash, POS sau transfer bancar. Oferim și livrare la domiciliu, până la poartă.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Metru ster vs metru cub'),
                            'continut' => $t('Metrul cub este lemn plin; metrul ster este lemn stivuit, cu spații între bucăți — aproximativ 0,6–0,65 m³ de lemn plin la un ster. Când compari prețuri, întreabă mereu în ce unitate e dat prețul.'),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 4,
            ],
            [
                'slug' => 'despre',
                'titlu' => ['ro' => 'Despre noi', 'de' => 'Uber uns', 'en' => 'About'],
                'meta_title' => $t('Despre Galle Silva — standarde germane în silvicultură'),
                'meta_description' => $t('Galle Silva este reprezentanța în România a grupului german Galle GmbH. Utilaje moderne, echipă specializată, exploatare responsabilă în Prahova.'),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Despre Galle Silva'),
                            'intro' => $t('Galle Silva este reprezentanța în România a grupului german Galle GmbH — aducem în Prahova utilaje moderne, echipă specializată și exploatare forestieră responsabilă.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Galle Silva SRL — cine suntem'),
                            'continut' => $t('Galle Silva SRL este firma din grup care operează în România, cu sediul în Mănești, județul Prahova. Facem [exploatare forestieră](/servicii/exploatare-forestiera), [achiziție de masă lemnoasă](/servicii/achizitie-masa-lemnoasa), [transport lemn](/servicii/transport-lemn) și vindem [lemn de foc](/lemn-de-foc) în Prahova, Ilfov și București.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Galle GmbH — grupul-mamă din Germania'),
                            'continut' => $t('Galle GmbH lucrează în silvicultură de aproape 25 de ani: gestionează păduri, recoltează și comercializează material lemnos în Germania. Deține certificările ISO 9001, ISO 14001, RAL și DEKRA — standardele care definesc calitatea germană în domeniu.'),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Parteneriatul: standarde germane, aplicate în România'),
                            'continut' => $t('Galle Silva aplică în România procedurile, controalele și principiile grupului Galle: utilaje moderne, lucrări corecte, documente complete și respect pentru pădure. Suntem în proces de certificare FSC și PEFC.'),
                        ],
                    ],
                    [
                        'type' => 'carduri',
                        'data' => [
                            'eyebrow' => $t('Oamenii Galle Silva'),
                            'titlu' => $t('Echipa'),
                            'items' => [
                                [
                                    'titlu' => $t('Răzvan Solzaru'),
                                    'text' => $t('Manager general'),
                                    'icon' => 'heroicon-o-user',
                                ],
                                [
                                    'titlu' => $t('Ion Narcis Marin'),
                                    'text' => $t('Manager operațiuni'),
                                    'icon' => 'heroicon-o-user',
                                ],
                                [
                                    'titlu' => $t('Dragici Dumitru'),
                                    'text' => $t('Operator harvester'),
                                    'icon' => 'heroicon-o-user',
                                ],
                                [
                                    'titlu' => $t('Roată Alexandru'),
                                    'text' => $t('Muncitor în silvicultură'),
                                    'icon' => 'heroicon-o-user',
                                ],
                            ],
                        ],
                    ],
                ],
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
                'slug' => 'date-firma',
                'titlu' => ['ro' => 'Date firma', 'de' => 'Impressum', 'en' => 'Legal notice'],
                'meta_title' => ['ro' => 'Date firma / Impressum — Galle Silva SRL', 'de' => null, 'en' => null],
                'meta_description' => ['ro' => 'Datele de identificare ale Galle Silva SRL: CUI, Registrul Comertului, sediu social, contact si reprezentant legal.', 'de' => null, 'en' => null],
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 90,
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
