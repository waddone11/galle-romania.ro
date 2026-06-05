<?php

namespace Database\Seeders;

use App\Models\Pagina;
use Illuminate\Database\Seeder;

class PaginaSeeder extends Seeder
{
    public function run(): void
    {
        // Helper pentru campuri traductibile: RO + DE (adresare „Sie") + EN.
        // Owner-ul poate ajusta orice valoare din taburile admin.
        $t = fn (?string $ro, ?string $de = null, ?string $en = null): array => ['ro' => $ro, 'de' => $de, 'en' => $en];

        // Argumentele pentru sectiunea „Operatorul de date" (RO/DE/EN folosesc aceleasi valori
        // din config/company.php, scrise o singura data; formatul difera per limba).
        $operatorArgs = [
            config('company.denumire'),
            (config('company.tva') ? 'RO' : '').config('company.cui'),
            config('company.reg_com'),
            config('company.adresa'),
            config('company.localitate'),
            config('company.judet'),
            config('company.cod_postal'),
            config('company.administrator'),
            config('company.email'),
            config('company.telefon'),
        ];

        /** @var array<int, array<string, mixed>> $rows */
        $rows = [
            [
                'slug' => 'home',
                'titlu' => ['ro' => 'Acasa', 'de' => 'Startseite', 'en' => 'Home'],
                'meta_title' => $t(
                    'Galle Silva — partener local Galle GmbH Germania',
                    'Galle Silva — lokaler Partner der Galle GmbH Deutschland',
                    'Galle Silva — local partner of Galle GmbH Germany',
                ),
                'meta_description' => $t(
                    'Standarde germane în România: lemn de foc, exploatare forestieră, achiziție masă lemnoasă și transport în Prahova, Ilfov și București.',
                    'Deutsche Standards in Rumänien: Brennholz, Holzernte, Holzankauf und Holztransport in Prahova, Ilfov und Bukarest.',
                    'German standards in Romania: firewood, timber harvesting, timber purchasing and transport in Prahova, Ilfov and Bucharest.',
                ),
                // Fluxul complet al template-ului (design/index.html), randat 1:1 din CMS.
                // Editorul poate sterge / reordona / adauga din /admin Pagina = home.
                'sectiuni' => [
                    [
                        'type' => 'hero',
                        'data' => [
                            'badge' => $t(
                                'Servicii forestiere și lemn de foc',
                                'Forstdienstleistungen und Brennholz',
                                'Forestry services and firewood',
                            ),
                            'badge_link' => $t('Vezi serviciile', 'Leistungen ansehen', 'View services'),
                            'badge_url' => '/servicii',
                            'titlu' => $t(
                                'Pădurea, gestionată cu responsabilitate',
                                'Der Wald, verantwortungsvoll bewirtschaftet',
                                'The forest, managed responsibly',
                            ),
                            'subtitlu' => $t(
                                'Recoltare durabilă, lemn de foc de calitate și servicii forestiere profesionale în Prahova, Ilfov și București.',
                                'Nachhaltige Holzernte, hochwertiges Brennholz und professionelle Forstdienstleistungen in Prahova, Ilfov und Bukarest.',
                                'Sustainable harvesting, quality firewood and professional forestry services in Prahova, Ilfov and Bucharest.',
                            ),
                            'cta_text' => $t('Cere ofertă', 'Angebot anfordern', 'Request a quote'),
                            'cta_url' => '/contact',
                            'chips' => [
                                [
                                    'icon' => 'flacara',
                                    'text' => $t('Lemn de foc', 'Brennholz', 'Firewood'),
                                    'tooltip' => $t(
                                        'Esențe tari (stejar, carpen, fag), livrate acasă.',
                                        'Hartholz (Eiche, Hainbuche, Buche), frei Haus geliefert.',
                                        'Hardwood (oak, hornbeam, beech), delivered to your home.',
                                    ),
                                ],
                                [
                                    'icon' => 'copaci',
                                    'text' => $t('Exploatare forestieră', 'Holzernte', 'Timber harvesting'),
                                    'tooltip' => $t(
                                        'Prestări servicii în păduri private și de stat.',
                                        'Dienstleistungen in Privat- und Staatswäldern.',
                                        'Contract services in private and state forests.',
                                    ),
                                ],
                                [
                                    'icon' => 'handshake',
                                    'text' => $t('Achiziție masă lemnoasă', 'Holzankauf', 'Timber purchasing'),
                                    'tooltip' => $t(
                                        'Pe picior sau fasonată — evaluare corectă.',
                                        'Stehend oder aufgearbeitet — faire Bewertung.',
                                        'Standing or processed — fair valuation.',
                                    ),
                                ],
                                [
                                    'icon' => 'excavator',
                                    'text' => $t('Curățare terenuri', 'Flächenräumung', 'Land clearing'),
                                    'tooltip' => $t(
                                        'Defrișare controlată, fără suprafață minimă.',
                                        'Kontrollierte Rodung, ohne Mindestfläche.',
                                        'Controlled clearing, no minimum area.',
                                    ),
                                ],
                                [
                                    'icon' => 'frunza',
                                    'text' => $t('Certificare FSC & PEFC', 'FSC- & PEFC-Zertifizierung', 'FSC & PEFC certification'),
                                    'tooltip' => $t(
                                        'Surse responsabile, în proces de certificare.',
                                        'Verantwortungsvolle Quellen, Zertifizierung läuft.',
                                        'Responsible sources, certification in progress.',
                                    ),
                                ],
                                [
                                    'icon' => 'camion',
                                    'text' => $t('Livrare locală', 'Lokale Lieferung', 'Local delivery'),
                                    'tooltip' => $t(
                                        'Prahova, Ilfov, București · 1-3 zile.',
                                        'Prahova, Ilfov, Bukarest · 1–3 Tage.',
                                        'Prahova, Ilfov, Bucharest · 1–3 days.',
                                    ),
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'manifest',
                        'data' => [
                            'eyebrow' => $t('GALLE SILVA', 'GALLE SILVA', 'GALLE SILVA'),
                            'titlu_mare' => $t(
                                'Claritate, control și responsabilitate în fiecare lucrare forestieră.',
                                'Klarheit, Kontrolle und Verantwortung bei jeder forstwirtschaftlichen Arbeit.',
                                'Clarity, control and responsibility in every forestry operation.',
                            ),
                            'tagline' => $t(
                                'Limpede, de la pădure până la tine.',
                                'Transparent — vom Wald bis zu Ihnen.',
                                'Clear and transparent — from the forest to you.',
                            ),
                            'intro' => $t(
                                'De la evaluarea masei lemnoase până la exploatare, transport și livrare, lucrăm cu procese transparente și echipamente profesionale.',
                                'Von der Bewertung der Holzmasse bis zur Holzernte, zum Transport und zur Lieferung arbeiten wir mit transparenten Prozessen und professioneller Ausrüstung.',
                                'From timber assessment to harvesting, transport and delivery, we work with transparent processes and professional equipment.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'splitter',
                        'data' => [],
                    ],
                    [
                        'type' => 'text_imagine',
                        'data' => [
                            'titlu' => $t('Cine suntem', 'Wer wir sind', 'Who we are'),
                            'continut' => $t(
                                'Galle Silva aduce în România experiența grupului german Galle GmbH — peste 30 de ani în servicii forestiere, din 1990. Lucrăm cu utilaje moderne (harvester și forwarder), echipă specializată și autospeciale proprii, în păduri private și de stat. De la recoltare la livrare, ducem lucrarea cap-coadă, corect și transparent.',
                                'Galle Silva bringt die Erfahrung der deutschen Galle GmbH nach Rumänien — über 30 Jahre Forstwirtschaft, seit 1990. Wir arbeiten mit modernen Maschinen (Harvester und Forwarder), einem spezialisierten Team und eigenen LKW, in Privat- und Staatswäldern. Von der Ernte bis zur Lieferung führen wir jede Arbeit vollständig aus — korrekt und transparent.',
                                'Galle Silva brings to Romania the experience of the German group Galle GmbH — over 30 years in forestry, since 1990. We work with modern machinery (harvester and forwarder), a specialised team and our own trucks, in private and state forests. From harvesting to delivery, we see every job through — done right and transparently.',
                            ),
                            'cta_text' => $t('Despre noi', 'Über uns', 'About us'),
                            'imagine' => '/images/galle/proiecte/camion-incarcat.webp',
                            'cta_url' => '/despre',
                            'pozitie' => 'dreapta',
                        ],
                    ],
                    [
                        'type' => 'servicii',
                        'data' => [
                            'eyebrow' => $t('Ce facem', 'Was wir tun', 'What we do'),
                            'titlu' => $t(
                                'Servicii forestiere complete',
                                'Komplette Forstdienstleistungen',
                                'Complete forestry services',
                            ),
                            'items' => [
                                [
                                    'icon' => 'copaci',
                                    'titlu' => $t('Exploatare forestieră', 'Holzernte', 'Timber harvesting'),
                                    'text' => $t(
                                        'Recoltăm lemnul cu harvester și forwarder, în păduri private și de stat. Tăiere, fasonare și scos-apropiat — lucrare completă.',
                                        'Wir ernten Holz mit Harvester und Forwarder, in Privat- und Staatswäldern. Fällung, Aufarbeitung und Rückung — alles aus einer Hand.',
                                        'We harvest timber with harvester and forwarder, in private and state forests. Felling, processing and extraction — the complete job.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/harvester-lucru-wide.webp',
                                    'url' => '/servicii/exploatare-forestiera',
                                ],
                                [
                                    'icon' => 'handshake',
                                    'titlu' => $t('Achiziție masă lemnoasă', 'Holzankauf', 'Timber purchasing'),
                                    'text' => $t(
                                        'Cumpărăm masă lemnoasă pe picior sau fasonată. Evaluăm corect și plătim transparent. Ai pădure de valorificat? Vorbește cu noi.',
                                        'Wir kaufen Holz — stehend oder aufgearbeitet. Faire Bewertung, transparente Bezahlung. Sie möchten Ihren Wald verwerten? Sprechen Sie mit uns.',
                                        'We buy standing or processed timber. Fair valuation, transparent payment. Have forest to sell? Talk to us.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/busteni-marcati-wide.webp',
                                    'url' => '/servicii/achizitie-masa-lemnoasa',
                                ],
                                [
                                    'icon' => 'excavator',
                                    'titlu' => $t('Curățare și defrișare terenuri', 'Flächenräumung und Rodung', 'Land clearing'),
                                    'text' => $t(
                                        'Curățăm terenul de copaci, arbuști și cioate — pentru construcții sau agricultură. Fără suprafață minimă.',
                                        'Wir räumen Grundstücke von Bäumen, Sträuchern und Baumstümpfen — für Bau oder Landwirtschaft. Ohne Mindestfläche.',
                                        'We clear land of trees, shrubs and stumps — for construction or agriculture. No minimum area.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/forwarder-drum-wide.webp',
                                    'url' => '/servicii/curatare-terenuri',
                                ],
                                [
                                    'icon' => 'camion',
                                    'titlu' => $t('Transport lemn', 'Holztransport', 'Log transport'),
                                    'text' => $t(
                                        'Transportăm lemnul cu autospeciale proprii, din pădure până la depozit sau la tine.',
                                        'Wir transportieren Holz mit eigenen Spezial-LKW — vom Wald bis zum Lager oder zu Ihnen.',
                                        'We transport timber with our own trucks — from the forest to the depot or to your door.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/camion-incarcat-wide.webp',
                                    'url' => '/servicii/transport-lemn',
                                ],
                                [
                                    'icon' => 'flacara',
                                    'titlu' => $t('Lemn de foc', 'Brennholz', 'Firewood'),
                                    'text' => $t(
                                        'Esențe tari — stejar, carpen, fag — livrate în Prahova, Ilfov și București.',
                                        'Hartholz — Eiche, Hainbuche, Buche — geliefert in Prahova, Ilfov und Bukarest.',
                                        'Hardwood — oak, hornbeam, beech — delivered in Prahova, Ilfov and Bucharest.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/gramada-busteni-wide.webp',
                                    'url' => '/lemn-de-foc',
                                ],
                                [
                                    'icon' => 'frunza',
                                    'titlu' => $t('Lucrări silvice & documentație', 'Waldpflege & Dokumentation', 'Silvicultural works & paperwork'),
                                    'text' => $t(
                                        'Rărituri, curățiri și actele aferente (APV, documente de însoțire). Te ghidăm de la cap la coadă.',
                                        'Durchforstungen, Läuterungen und die zugehörigen Dokumente (APV, Begleitpapiere). Wir begleiten Sie von Anfang bis Ende.',
                                        'Thinning, cleaning and the related documents (APV, transport permits). We guide you from start to finish.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/harvester-galle-wide.webp',
                                    'url' => '/servicii/lucrari-silvice',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'carduri',
                        'data' => [
                            'eyebrow' => $t('De ce Galle', 'Warum Galle', 'Why Galle'),
                            'titlu' => $t(
                                'Standarde germane, aplicate local',
                                'Deutsche Standards, lokal umgesetzt',
                                'German standards, applied locally',
                            ),
                            'items' => [
                                [
                                    'titlu' => $t('Calitate germană', 'Deutsche Qualität', 'German quality'),
                                    'text' => $t(
                                        'Procese și standarde Galle GmbH, aplicate la fiecare comandă și proiect.',
                                        'Prozesse und Standards der Galle GmbH — bei jedem Auftrag und Projekt.',
                                        'Galle GmbH processes and standards, applied to every order and project.',
                                    ),
                                    'icon' => 'heroicon-o-check-badge',
                                ],
                                [
                                    'titlu' => $t('Recoltare durabilă', 'Nachhaltige Holzernte', 'Sustainable harvesting'),
                                    'text' => $t(
                                        'Păduri gestionate responsabil, certificări FSC și PEFC în lucru.',
                                        'Verantwortungsvoll bewirtschaftete Wälder, FSC- und PEFC-Zertifizierung in Arbeit.',
                                        'Responsibly managed forests; FSC and PEFC certifications under way.',
                                    ),
                                    'icon' => 'heroicon-o-globe-europe-africa',
                                ],
                                [
                                    'titlu' => $t('Livrare rapidă', 'Schnelle Lieferung', 'Fast delivery'),
                                    'text' => $t(
                                        'Lemn de foc livrat în 2-5 zile în Prahova, Ilfov și București.',
                                        'Brennholz in 2–5 Tagen geliefert — in Prahova, Ilfov und Bukarest.',
                                        'Firewood delivered within 2–5 days in Prahova, Ilfov and Bucharest.',
                                    ),
                                    'icon' => 'heroicon-o-truck',
                                ],
                                [
                                    'titlu' => $t('Pentru firme și instituții', 'Für Unternehmen und Institutionen', 'For companies and institutions'),
                                    'text' => $t(
                                        'Servicii forestiere, transport și curățare terenuri, cu factură și plată la termen.',
                                        'Forstdienstleistungen, Transport und Flächenräumung — mit Rechnung und Zahlungsziel.',
                                        'Forestry services, transport and land clearing, with invoice and payment terms.',
                                    ),
                                    'icon' => 'heroicon-o-building-office-2',
                                ],
                            ],
                        ],
                    ],
                    [
                        // Banda de incredere: logo-uri certificari din modelul Certificare.
                        'type' => 'certificari',
                        'data' => [
                            'eyebrow' => $t('Standarde și certificări', 'Standards und Zertifizierungen', 'Standards and certifications'),
                            'titlu' => $t(
                                'Calitate certificată, responsabilitate dovedită',
                                'Zertifizierte Qualität, nachgewiesene Verantwortung',
                                'Certified quality, proven responsibility',
                            ),
                            'subtitlu' => $t(
                                'Lucrăm după standardele grupului Galle GmbH și suntem în proces de certificare FSC și PEFC.',
                                'Wir arbeiten nach den Standards der Galle GmbH und befinden uns im Zertifizierungsprozess für FSC und PEFC.',
                                'We work to the standards of the Galle GmbH group and are in the process of FSC and PEFC certification.',
                            ),
                        ],
                    ],
                    [
                        // Recenzii reale (modelul Recenzie, doar is_published=true).
                        // Sectiunea dispare automat cand nu exista recenzii publicate.
                        'type' => 'recenzii',
                        'data' => [
                            'eyebrow' => $t('Recenzii', 'Bewertungen', 'Reviews'),
                            'titlu' => $t('Ce spun clienții', 'Was unsere Kunden sagen', 'What our clients say'),
                        ],
                    ],
                    [
                        'type' => 'galerie',
                        'data' => [
                            'titlu' => $t('De la fața locului', 'Direkt vom Einsatzort', 'From the field'),
                            'imagini' => [
                                '/images/galle/proiecte/depozit-utilaj.webp',
                                '/images/galle/proiecte/harvester-lucru.webp',
                                '/images/galle/proiecte/depozit-amurg.webp',
                                '/images/galle/proiecte/gramada-busteni.webp',
                                '/images/galle/proiecte/camion-incarcat.webp',
                            ],
                            'video' => '/images/galle/proiecte/depozit-video.mp4',
                            'video_poster' => '/images/galle/proiecte/depozit-video-poster.webp',
                        ],
                    ],
                    [
                        // Teaser portofoliu — ultimele 3 proiecte publicate (modelul Proiect).
                        'type' => 'proiecte_recente',
                        'data' => [
                            'eyebrow' => $t('Portofoliu', 'Portfolio', 'Portfolio'),
                            'titlu' => $t('Proiecte recente', 'Aktuelle Projekte', 'Recent projects'),
                        ],
                    ],
                    [
                        'type' => 'durabilitate_stat',
                        'data' => [
                            'titlu' => $t('Durabil & regenerabil', 'Nachhaltig & erneuerbar', 'Sustainable & renewable'),
                            'text' => $t(
                                'Lemnul de foc Galle Silva provine din păduri gestionate responsabil — o resursă regenerabilă. Certificări FSC și PEFC în lucru, în acord cu principalele standarde de sustenabilitate.',
                                'Das Brennholz von Galle Silva stammt aus verantwortungsvoll bewirtschafteten Wäldern — eine erneuerbare Ressource. FSC- und PEFC-Zertifizierung in Arbeit, im Einklang mit den wichtigsten Nachhaltigkeitsstandards.',
                                'Galle Silva firewood comes from responsibly managed forests — a renewable resource. FSC and PEFC certifications are under way, in line with the leading sustainability standards.',
                            ),
                            'stat_number' => '100%',
                            'stat_top' => $t('natural', 'natürlich', 'natural'),
                            'stat_bottom' => $t('& regenerabil', '& erneuerbar', '& renewable'),
                        ],
                    ],
                    [
                        // Teaser FAQ — split 50/50 in stilul durabilitate_stat, verde pe DREAPTA.
                        'type' => 'faq',
                        'data' => [
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                            'subtitlu' => $t(
                                'Răspunsuri rapide despre lemn de foc, livrare și servicii.',
                                'Schnelle Antworten zu Brennholz, Lieferung und Leistungen.',
                                'Quick answers about firewood, delivery and services.',
                            ),
                            'categorie' => 'lemn-de-foc',
                            'limita' => 6,
                            'link_toate' => true,
                            'split' => true,
                        ],
                    ],
                    [
                        // Teaser blog — split 50/50 in oglinda (verde pe STANGA), ultimele 4 articole.
                        'type' => 'blog_recent',
                        'data' => [
                            'eyebrow' => $t('Blog', 'Blog', 'Blog'),
                            'titlu' => $t('Ghiduri & noutăți', 'Ratgeber & Neuigkeiten', 'Guides & news'),
                            'subtitlu' => $t(
                                'Despre lemn de foc, pădure și lucrări făcute corect — pe înțelesul tuturor.',
                                'Über Brennholz, Wald und fachgerechte Arbeiten — für alle verständlich.',
                                'About firewood, forests and work done right — in plain language.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t(
                                'Vrei o ofertă personalizată?',
                                'Möchten Sie ein individuelles Angebot?',
                                'Want a personalised quote?',
                            ),
                            'text' => $t(
                                'Pentru lemn de foc, exploatare forestieră sau transport — spune-ne ce ai nevoie și te contactăm în 24h.',
                                'Ob Brennholz, Holzernte oder Transport — sagen Sie uns, was Sie benötigen, und wir melden uns innerhalb von 24 Stunden.',
                                'Firewood, timber harvesting or transport — tell us what you need and we will get back to you within 24 hours.',
                            ),
                            'buton_text' => $t('Cere ofertă', 'Angebot anfordern', 'Request a quote'),
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
                'meta_title' => $t(
                    'Servicii forestiere Prahova — exploatare, achiziție, transport | Galle Silva',
                    'Forstdienstleistungen Prahova — Holzernte, Holzankauf, Transport | Galle Silva',
                    'Forestry services in Prahova — harvesting, purchasing, transport | Galle Silva',
                ),
                'meta_description' => $t(
                    'Exploatare forestieră cu harvester și forwarder, achiziție masă lemnoasă, curățare terenuri, transport lemn și lucrări silvice în Prahova, Ilfov și București.',
                    'Holzernte mit Harvester und Forwarder, Holzankauf, Flächenräumung, Holztransport und Waldpflege in Prahova, Ilfov und Bukarest.',
                    'Timber harvesting with harvester and forwarder, timber purchasing, land clearing, log transport and silvicultural works in Prahova, Ilfov and Bucharest.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t(
                                'Servicii forestiere complete în Prahova',
                                'Komplette Forstdienstleistungen in Prahova',
                                'Complete forestry services in Prahova',
                            ),
                            'intro' => $t(
                                'Galle Silva oferă servicii forestiere complete — de la recoltarea lemnului cu utilaje moderne, la achiziția masei lemnoase, transport și curățarea terenurilor. Lucrăm în păduri private și de stat, cu standardele grupului german Galle.',
                                'Galle Silva bietet komplette Forstdienstleistungen — von der Holzernte mit modernen Maschinen über den Holzankauf bis zu Transport und Flächenräumung. Wir arbeiten in Privat- und Staatswäldern, nach den Standards der deutschen Galle-Gruppe.',
                                'Galle Silva offers complete forestry services — from timber harvesting with modern machinery to timber purchasing, transport and land clearing. We work in private and state forests, to the standards of the German Galle group.',
                            ),
                            'imagine' => '/images/galle/proiecte/harvester-galle-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'servicii',
                        'data' => [
                            'eyebrow' => $t('Ce facem', 'Was wir tun', 'What we do'),
                            'titlu' => $t(
                                'Alege serviciul de care ai nevoie',
                                'Wählen Sie die passende Leistung',
                                'Choose the service you need',
                            ),
                            'items' => [
                                [
                                    'icon' => 'copaci',
                                    'titlu' => $t('Exploatare forestieră', 'Holzernte', 'Timber harvesting'),
                                    'text' => $t(
                                        'Recoltăm mecanizat, cu harvester și forwarder, în păduri private și de stat — lucrare completă, cu acte.',
                                        'Mechanisierte Ernte mit Harvester und Forwarder, in Privat- und Staatswäldern — komplette Arbeit, mit allen Dokumenten.',
                                        'Mechanised harvesting with harvester and forwarder, in private and state forests — the complete job, fully documented.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/harvester-lucru-wide.webp',
                                    'url' => '/servicii/exploatare-forestiera',
                                ],
                                [
                                    'icon' => 'handshake',
                                    'titlu' => $t('Achiziție masă lemnoasă', 'Holzankauf', 'Timber purchasing'),
                                    'text' => $t(
                                        'Cumpărăm pădure pe picior sau lemn fasonat. Evaluare corectă, plată transparentă.',
                                        'Wir kaufen stehendes oder aufgearbeitetes Holz. Faire Bewertung, transparente Bezahlung.',
                                        'We buy standing timber or processed wood. Fair valuation, transparent payment.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/busteni-marcati-wide.webp',
                                    'url' => '/servicii/achizitie-masa-lemnoasa',
                                ],
                                [
                                    'icon' => 'excavator',
                                    'titlu' => $t('Curățare terenuri', 'Flächenräumung', 'Land clearing'),
                                    'text' => $t(
                                        'Curățăm terenul de vegetație, arbori și cioate — pentru construcții sau agricultură. Fără suprafață minimă.',
                                        'Wir räumen Grundstücke von Vegetation, Bäumen und Baumstümpfen — für Bau oder Landwirtschaft. Ohne Mindestfläche.',
                                        'We clear land of vegetation, trees and stumps — for construction or agriculture. No minimum area.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/forwarder-drum-wide.webp',
                                    'url' => '/servicii/curatare-terenuri',
                                ],
                                [
                                    'icon' => 'camion',
                                    'titlu' => $t('Transport lemn', 'Holztransport', 'Log transport'),
                                    'text' => $t(
                                        'Transportăm lemn de foc, bușteni și lemn fasonat, cu autospeciale proprii cu macara.',
                                        'Wir transportieren Brennholz, Rundholz und aufgearbeitetes Holz — mit eigenen Kran-LKW.',
                                        'We transport firewood, logs and processed timber with our own crane trucks.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/camion-incarcat-wide.webp',
                                    'url' => '/servicii/transport-lemn',
                                ],
                                [
                                    'icon' => 'frunza',
                                    'titlu' => $t('Lucrări silvice', 'Waldpflege', 'Silvicultural works'),
                                    'text' => $t(
                                        'Curățiri, rărituri și tăieri de igienă, conform amenajamentului, împreună cu ocolul silvic.',
                                        'Läuterungen, Durchforstungen und Sanitärhiebe — gemäß Forsteinrichtung, in Abstimmung mit dem Forstamt.',
                                        'Cleaning, thinning and sanitation felling, according to the forest management plan, together with the forest district office.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/harvester-galle-wide.webp',
                                    'url' => '/servicii/lucrari-silvice',
                                ],
                                [
                                    'icon' => 'flacara',
                                    'titlu' => $t('Lemn de foc', 'Brennholz', 'Firewood'),
                                    'text' => $t(
                                        'Stejar și carpen pe stoc, tăiat și crăpat, livrat în Prahova, Ilfov și București.',
                                        'Eiche und Hainbuche auf Lager, gesägt und gespalten, geliefert in Prahova, Ilfov und Bukarest.',
                                        'Oak and hornbeam in stock, cut and split, delivered in Prahova, Ilfov and Bucharest.',
                                    ),
                                    'imagine' => '/images/galle/proiecte/gramada-busteni-wide.webp',
                                    'url' => '/lemn-de-foc',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t(
                                'Nu știi exact ce serviciu îți trebuie?',
                                'Sie wissen nicht genau, welche Leistung Sie benötigen?',
                                'Not sure which service you need?',
                            ),
                            'text' => $t(
                                'Spune-ne ce ai de lucrat — pădure, teren sau lemn de transportat — și îți spunem noi cum te putem ajuta.',
                                'Sagen Sie uns, worum es geht — Wald, Grundstück oder Holz zum Transportieren — und wir sagen Ihnen, wie wir helfen können.',
                                'Tell us what you are working with — forest, land or timber to move — and we will tell you how we can help.',
                            ),
                            'buton_text' => $t('Cere o evaluare', 'Bewertung anfordern', 'Request an assessment'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 5,
            ],
            [
                'slug' => 'exploatare-forestiera',
                'titlu' => $t('Exploatare forestieră', 'Holzernte', 'Timber harvesting'),
                'meta_title' => $t(
                    'Exploatare forestieră Prahova — harvester & forwarder | Galle Silva',
                    'Holzernte Prahova — Harvester & Forwarder | Galle Silva',
                    'Timber harvesting in Prahova — harvester & forwarder | Galle Silva',
                ),
                'meta_description' => $t(
                    'Prestări servicii de exploatare forestieră în păduri private și de stat. Recoltare mecanizată cu harvester și forwarder, lucrări corecte, documente complete (APV, SUMAL).',
                    'Holzernte als Dienstleistung in Privat- und Staatswäldern. Mechanisierte Ernte mit Harvester und Forwarder, fachgerechte Arbeit, vollständige Dokumente (APV, SUMAL).',
                    'Contract timber harvesting in private and state forests. Mechanised harvesting with harvester and forwarder, professional work, complete documentation (APV, SUMAL).',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t(
                                'Exploatare forestieră cu harvester și forwarder în Prahova',
                                'Holzernte mit Harvester und Forwarder in Prahova',
                                'Timber harvesting with harvester and forwarder in Prahova',
                            ),
                            'intro' => $t(
                                'Realizăm exploatare forestieră ca prestări servicii, în păduri private și de stat, cu recoltare mecanizată (harvester și forwarder) și documentație completă.',
                                'Wir führen Holzernte als Dienstleistung durch, in Privat- und Staatswäldern — mechanisiert (Harvester und Forwarder) und mit vollständiger Dokumentation.',
                                'We carry out timber harvesting as a contract service, in private and state forests, with mechanised harvesting (harvester and forwarder) and complete documentation.',
                            ),
                            'imagine' => '/images/galle/proiecte/harvester-galle-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Pentru păduri private și de stat', 'Für Privat- und Staatswälder', 'For private and state forests'),
                            'continut' => $t(
                                "Lucrăm ca prestatori de servicii pentru proprietari de păduri private, ocoale silvice și administratori de fond forestier. Indiferent dacă ai câteva hectare moștenite sau administrezi suprafețe mari, ducem lucrarea cap-coadă: de la evaluare și acte, până la lemnul stivuit în platforma primară.\n\nVrei să-ți valorifici pădurea fără să te ocupi de nimic? Vezi [achiziția de masă lemnoasă](/servicii/achizitie-masa-lemnoasa) — cumpărăm noi, pe picior sau fasonat.",
                                "Wir arbeiten als Dienstleister für private Waldbesitzer, Forstämter und Verwalter von Waldflächen. Ob Sie einige geerbte Hektar besitzen oder große Flächen verwalten — wir führen die Arbeit vollständig aus: von der Bewertung und den Dokumenten bis zum gepolterten Holz an der Forststraße.\n\nSie möchten Ihren Wald verwerten, ohne sich um etwas kümmern zu müssen? Siehe [Holzankauf](/servicii/achizitie-masa-lemnoasa) — wir kaufen selbst, stehend oder aufgearbeitet.",
                                "We work as a service provider for private forest owners, forest districts and forest administrators. Whether you own a few inherited hectares or manage large areas, we see the job through from start to finish: from assessment and paperwork to timber stacked at the roadside landing.\n\nWant to monetise your forest without lifting a finger? See [timber purchasing](/servicii/achizitie-masa-lemnoasa) — we buy it ourselves, standing or processed.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Exploatare mecanizată: harvester + forwarder',
                                'Mechanisierte Ernte: Harvester + Forwarder',
                                'Mechanised harvesting: harvester + forwarder',
                            ),
                            'continut' => $t(
                                'Recoltăm mecanizat: harvesterul doboară, curăță de crengi și secționează arborele în câteva zeci de secunde, iar forwarderul scoate lemnul la drumul auto fără să-l târască prin sol. Rezultatul: lucrare rapidă, cu impact redus asupra solului și a arborilor rămași. Unde terenul o cere, completăm cu echipe de fasonatori cu experiență.',
                                'Wir ernten mechanisiert: Der Harvester fällt, entastet und schneidet den Baum in wenigen Augenblicken ein, der Forwarder bringt das Holz zur Forststraße, ohne es über den Boden zu schleifen. Das Ergebnis: schnelle Arbeit mit geringer Belastung für Boden und verbleibende Bäume. Wo das Gelände es erfordert, ergänzen wir mit erfahrenen motormanuellen Teams.',
                                'We harvest mechanically: the harvester fells, delimbs and cuts the tree to length in seconds, while the forwarder carries the timber to the forest road without dragging it across the soil. The result: fast work with minimal impact on the soil and the remaining trees. Where the terrain requires it, we bring in experienced chainsaw crews.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Etapele lucrării: doborât, secționat, scos-apropiat, platformă primară',
                                'Die Arbeitsschritte: Fällen, Einschneiden, Rückung, Polter',
                                'The stages: felling, bucking, extraction, roadside landing',
                            ),
                            'continut' => $t(
                                'Doborâm arborii marcați, îi secționăm la dimensiunile cerute, îi apropiem la drumul auto și îi stivuim în platforma primară, gata de [transport](/servicii/transport-lemn). La final predăm parchetul curat, conform autorizației de exploatare.',
                                'Wir fällen die markierten Bäume, schneiden sie auf die gewünschten Längen ein, rücken sie zur Forststraße und poltern sie dort — bereit zum [Transport](/servicii/transport-lemn). Zum Abschluss übergeben wir den Hiebsort sauber, gemäß der Erntegenehmigung.',
                                'We fell the marked trees, cut them to the required lengths, extract them to the forest road and stack them at the landing, ready for [transport](/servicii/transport-lemn). At the end, we hand over the site clean, as required by the harvesting permit.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Lucrăm cu acte: APV, autorizații, SUMAL, avize',
                                'Wir arbeiten mit allen Dokumenten: APV, Genehmigungen, SUMAL, Begleitpapiere',
                                'Fully documented: APV, permits, SUMAL, transport documents',
                            ),
                            'continut' => $t(
                                'Toată recoltarea se face legal: pe baza actului de punere în valoare (APV), a autorizației de exploatare și cu avize de însoțire generate prin SUMAL. Dacă ești la prima exploatare și nu știi de unde să începi, te ghidăm pas cu pas, împreună cu ocolul silvic.',
                                'Die gesamte Ernte erfolgt legal: auf Grundlage des APV (das amtliche Dokument zur Holzaufnahme und -bewertung), der Erntegenehmigung und mit über SUMAL erstellten Begleitpapieren. Wenn dies Ihre erste Holzernte ist und Sie nicht wissen, wo Sie anfangen sollen, begleiten wir Sie Schritt für Schritt — gemeinsam mit dem Forstamt.',
                                "All harvesting is done legally: based on the APV (the official harvesting valuation document), the harvesting permit, and transport documents generated through SUMAL, Romania's timber traceability system. If this is your first harvest and you don't know where to start, we guide you step by step, together with the forest district office.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Zone acoperite', 'Einsatzgebiete', 'Areas we cover'),
                            'continut' => $t(
                                'Lucrăm în principal în Prahova — Valea Doftanei, Câmpina, Comarnic, Breaza și împrejurimi — și ne deplasăm și în județele vecine, în funcție de volumul lucrării.',
                                'Wir arbeiten hauptsächlich in Prahova — Valea Doftanei, Câmpina, Comarnic, Breaza und Umgebung — und sind je nach Auftragsvolumen auch in den Nachbarkreisen tätig.',
                                'We work mainly in Prahova — Valea Doftanei, Câmpina, Comarnic, Breaza and the surrounding area — and travel to neighbouring counties depending on the size of the job.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'exploatare-forestiera',
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Cere o evaluare', 'Bewertung anfordern', 'Request an assessment'),
                            'text' => $t(
                                'Trimite-ne locația pădurii și actele pe care le ai — sau doar ce știi despre ea — și venim la fața locului pentru evaluare.',
                                'Senden Sie uns den Standort Ihres Waldes und die vorhandenen Unterlagen — oder einfach, was Sie darüber wissen — und wir kommen zur Bewertung vor Ort.',
                                'Send us the location of your forest and the documents you have — or just what you know about it — and we will come on site for an assessment.',
                            ),
                            'buton_text' => $t('Contactează-ne', 'Kontaktieren Sie uns', 'Contact us'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 6,
            ],
            [
                'slug' => 'achizitie-masa-lemnoasa',
                'titlu' => $t('Achiziție masă lemnoasă', 'Holzankauf', 'Timber purchasing'),
                'meta_title' => $t(
                    'Achiziție masă lemnoasă — cumpărăm pădure | Galle Silva',
                    'Holzankauf — wir kaufen Wald und Holz | Galle Silva',
                    'Timber purchasing — we buy standing timber | Galle Silva',
                ),
                'meta_description' => $t(
                    'Cumpărăm masă lemnoasă pe picior sau fasonată în Prahova și zonele apropiate. Evaluare corectă, plată transparentă. Ai pădure de valorificat? Cere o evaluare.',
                    'Wir kaufen Holz — stehend oder aufgearbeitet — in Prahova und Umgebung. Faire Bewertung, transparente Bezahlung. Sie möchten Ihren Wald verwerten? Fordern Sie eine Bewertung an.',
                    'We buy standing or processed timber in Prahova and nearby areas. Fair valuation, transparent payment. Have forest to sell? Request an assessment.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t(
                                'Cumpărăm masă lemnoasă pe picior sau fasonată în Prahova',
                                'Wir kaufen stehendes und aufgearbeitetes Holz in Prahova',
                                'We buy standing and processed timber in Prahova',
                            ),
                            'intro' => $t(
                                'Cumpărăm masă lemnoasă pe picior (arbori nerecoltați) sau fasonată (deja tăiată), oferind proprietarilor o cale corectă și transparentă de a-și valorifica pădurea.',
                                'Wir kaufen Holz auf dem Stamm (stehende, nicht geerntete Bäume) oder aufgearbeitet (bereits eingeschlagen) — und bieten Waldbesitzern einen fairen, transparenten Weg, ihren Wald zu verwerten.',
                                'We buy standing timber (unharvested trees) or processed wood (already felled), giving owners a fair and transparent way to monetise their forest.',
                            ),
                            'imagine' => '/images/galle/proiecte/depozit-amurg-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ai pădure sau lemn de vânzare?', 'Sie haben Wald oder Holz zu verkaufen?', 'Do you have forest or timber to sell?'),
                            'continut' => $t(
                                'Dacă deții o pădure sau lemn deja recoltat și vrei să-l valorifici, cumpărăm direct, fără intermediari. Evaluăm corect, plătim transparent, iar de partea tehnică — [exploatare](/servicii/exploatare-forestiera), acte, [transport](/servicii/transport-lemn) — ne ocupăm noi.',
                                'Wenn Sie einen Wald oder bereits geerntetes Holz besitzen und es verwerten möchten, kaufen wir direkt — ohne Zwischenhändler. Wir bewerten fair und zahlen transparent; um die technische Seite — [Holzernte](/servicii/exploatare-forestiera), Dokumente, [Transport](/servicii/transport-lemn) — kümmern wir uns.',
                                'If you own a forest or already-harvested timber and want to sell it, we buy directly, with no middlemen. We value it fairly and pay transparently, and we take care of the technical side — [harvesting](/servicii/exploatare-forestiera), paperwork, [transport](/servicii/transport-lemn).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cumpărăm pe picior', 'Wir kaufen stehendes Holz', 'We buy standing timber'),
                            'continut' => $t(
                                'Masa lemnoasă pe picior înseamnă arborii aflați încă în pădure, nerecoltați, evaluați într-o partidă (APV). Tu primești banii, noi venim cu utilajele și echipa și ne ocupăm de recoltare de la primul până la ultimul arbore.',
                                'Stehendes Holz sind die noch nicht geernteten Bäume im Wald, erfasst und bewertet in einem APV (das amtliche Dokument zur Holzaufnahme und -bewertung). Sie erhalten das Geld — wir kommen mit Maschinen und Team und übernehmen die Ernte vom ersten bis zum letzten Baum.',
                                'Standing timber means the trees still in the forest, unharvested, inventoried and valued in an APV (the official harvesting valuation document). You receive the money — we come with the machines and the team and handle the harvest from the first tree to the last.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cumpărăm fasonat', 'Wir kaufen aufgearbeitetes Holz', 'We buy processed timber'),
                            'continut' => $t(
                                'Cumpărăm și lemn fasonat — deja tăiat — din platformă primară sau din depozit: bușteni pentru industrializare sau lemn pentru foc.',
                                'Wir kaufen auch aufgearbeitetes Holz — bereits eingeschlagen — vom Polter an der Forststraße oder aus dem Lager: Stammholz für die Industrie oder Brennholz.',
                                'We also buy processed timber — already felled — from the roadside landing or the depot: logs for industry or wood for firewood.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum evaluăm volumul și valoarea', 'So ermitteln wir Volumen und Wert', 'How we assess volume and value'),
                            'continut' => $t(
                                'Venim la fața locului și ne uităm la specie, volum, calitatea lemnului și accesibilitatea terenului. Pe baza lor primești o ofertă fermă, în scris — fără costuri ascunse și fără surprize la plată.',
                                'Wir kommen vor Ort und prüfen Baumart, Volumen, Holzqualität und die Zugänglichkeit des Geländes. Auf dieser Grundlage erhalten Sie ein verbindliches, schriftliches Angebot — ohne versteckte Kosten und ohne Überraschungen bei der Zahlung.',
                                'We come on site and look at species, volume, timber quality and how accessible the terrain is. Based on these, you receive a firm written offer — no hidden costs, no surprises at payment.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce documente sunt necesare', 'Welche Dokumente benötigt werden', 'What documents are needed'),
                            'continut' => $t(
                                'Actele de proprietate ale terenului, iar pentru recoltare — APV-ul întocmit prin ocolul silvic. Nu le ai pe toate? Te ajutăm cu pașii și documentele.',
                                'Die Eigentumsunterlagen des Grundstücks sowie für die Ernte das über das Forstamt erstellte APV. Sie haben noch nicht alles? Wir helfen Ihnen mit den Schritten und den Dokumenten.',
                                "The ownership documents for the land and, for harvesting, the APV issued through the forest district office. Don't have everything yet? We help you with the steps and the paperwork.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Plată, exploatare și transport', 'Bezahlung, Ernte und Transport', 'Payment, harvesting and transport'),
                            'continut' => $t(
                                'Plătim transparent, prin transfer bancar, pe bază de contract. După achiziție, recoltăm și transportăm cu resursele noastre — tu nu te mai ocupi de nimic. O parte din lemn ajunge [lemn de foc](/lemn-de-foc) livrat familiilor din zonă.',
                                'Wir zahlen transparent, per Banküberweisung, auf Vertragsbasis. Nach dem Kauf ernten und transportieren wir mit eigenen Mitteln — Sie müssen sich um nichts mehr kümmern. Ein Teil des Holzes wird zu [Brennholz](/lemn-de-foc), das an Familien aus der Region geliefert wird.',
                                'We pay transparently, by bank transfer, under contract. After the purchase, we harvest and transport with our own resources — there is nothing left for you to handle. Part of the wood becomes [firewood](/lemn-de-foc) delivered to families in the area.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'achizitie-masa-lemnoasa',
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Ai pădure de valorificat?', 'Sie möchten Ihren Wald verwerten?', 'Have forest to sell?'),
                            'text' => $t(
                                'Ne contactezi, venim la evaluare și îți facem o ofertă fermă, în scris.',
                                'Kontaktieren Sie uns — wir kommen zur Bewertung und unterbreiten Ihnen ein verbindliches, schriftliches Angebot.',
                                'Get in touch — we come out for an assessment and make you a firm written offer.',
                            ),
                            'buton_text' => $t('Cere o evaluare', 'Bewertung anfordern', 'Request an assessment'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 7,
            ],
            [
                'slug' => 'curatare-terenuri',
                'titlu' => $t('Curățare terenuri', 'Flächenräumung', 'Land clearing'),
                'meta_title' => $t(
                    'Curățare și defrișare teren Prahova | Galle Silva',
                    'Flächenräumung und Rodung in Prahova | Galle Silva',
                    'Land clearing and tree removal in Prahova | Galle Silva',
                ),
                'meta_description' => $t(
                    'Curățăm terenuri de vegetație, arbori și cioate — pentru construcții sau agricultură. Scos cioate, frezare, tocare vegetație. Fără suprafață minimă.',
                    'Wir räumen Grundstücke von Vegetation, Bäumen und Baumstümpfen — für Bau oder Landwirtschaft. Stockrodung, Stubbenfräsen, Mulchen. Ohne Mindestfläche.',
                    'We clear land of vegetation, trees and stumps — for construction or agriculture. Stump removal, stump grinding, vegetation mulching. No minimum area.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t(
                                'Curățare și defrișare terenuri în Prahova, București și Ilfov',
                                'Flächenräumung und Rodung in Prahova, Bukarest und Ilfov',
                                'Land clearing in Prahova, Bucharest and Ilfov',
                            ),
                            'intro' => $t(
                                'Curățăm și pregătim terenuri de vegetație, arbuști, arbori și cioate, pentru construcții sau agricultură — fără suprafață minimă.',
                                'Wir räumen Grundstücke von Vegetation, Sträuchern, Bäumen und Baumstümpfen und bereiten sie vor — für Bau oder Landwirtschaft, ohne Mindestfläche.',
                                'We clear and prepare land — vegetation, shrubs, trees and stumps — for construction or agriculture, with no minimum area.',
                            ),
                            'imagine' => '/images/galle/proiecte/forwarder-drum-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce curățăm', 'Was wir räumen', 'What we clear'),
                            'continut' => $t(
                                'Terenuri pentru construcții, terenuri agricole abandonate, livezi îmbătrânite, curți și parcele invadate de vegetație. Lucrăm pentru persoane fizice, firme și primării — fără suprafață minimă.',
                                'Baugrundstücke, brachliegende landwirtschaftliche Flächen, überalterte Obstgärten, von Vegetation überwucherte Höfe und Parzellen. Wir arbeiten für Privatpersonen, Unternehmen und Gemeinden — ohne Mindestfläche.',
                                'Construction plots, abandoned farmland, ageing orchards, yards and parcels overrun by vegetation. We work for private individuals, companies and municipalities — no minimum area.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Servicii: tăiere, scos cioate, frezare rădăcini, tocare vegetație',
                                'Leistungen: Fällung, Stockrodung, Wurzelfräsen, Mulchen',
                                'Services: felling, stump removal, root grinding, vegetation mulching',
                            ),
                            'continut' => $t(
                                'Tăiem vegetația și arborii, scoatem sau frezăm cioatele și rădăcinile, tocăm resturile vegetale și lăsăm terenul curat, gata de folosit. La cerere, preluăm și transportăm tot materialul rezultat.',
                                'Wir fällen Vegetation und Bäume, roden oder fräsen Baumstümpfe und Wurzeln, mulchen das Schnittgut und hinterlassen das Grundstück sauber und einsatzbereit. Auf Wunsch übernehmen und transportieren wir das gesamte anfallende Material.',
                                'We cut vegetation and trees, remove or grind stumps and roots, chip the residues and leave the land clean and ready to use. On request, we collect and haul away all resulting material.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Teren neforestier vs fond forestier',
                                'Nicht-Waldgrundstück vs. Waldfonds',
                                'Non-forest land vs forest land',
                            ),
                            'continut' => $t(
                                'Pentru terenuri neforestiere (agricole sau intravilan), de regulă nu ai nevoie de autorizație silvică pentru tăierea copacilor. Pentru fond forestier, lucrările se fac doar cu aprobările legale. Îți spunem clar, de la început, în ce situație ești.',
                                'Für Nicht-Waldgrundstücke (landwirtschaftliche Flächen oder Bauland) benötigen Sie für das Fällen von Bäumen in der Regel keine forstliche Genehmigung. Im nationalen Waldfonds sind Arbeiten nur mit den gesetzlichen Genehmigungen möglich. Wir sagen Ihnen von Anfang an klar, in welcher Situation Sie sich befinden.',
                                'For non-forest land (agricultural or residential), you generally do not need a forestry permit to cut trees. For land registered as national forest, work can only be done with the legal approvals. We tell you clearly, from the start, which situation applies to you.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Utilaje și echipă', 'Maschinen und Team', 'Machinery and team'),
                            'continut' => $t(
                                'Lucrăm cu excavator, freză de cioate, tocătoare de vegetație și fasonatori cu experiență — aceeași echipă care lucrează și la [exploatările forestiere](/servicii/exploatare-forestiera). Materialul lemnos rezultat îl putem [transporta](/servicii/transport-lemn) noi.',
                                'Wir arbeiten mit Bagger, Stubbenfräse, Mulchern und erfahrenen Forstwirten — demselben Team, das auch unsere [Holzernte](/servicii/exploatare-forestiera) durchführt. Das anfallende Holz können wir selbst [abtransportieren](/servicii/transport-lemn).',
                                'We work with an excavator, stump grinder, mulchers and experienced sawyers — the same team that handles our [timber harvesting](/servicii/exploatare-forestiera). We can [haul away](/servicii/transport-lemn) the resulting timber ourselves.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum calculăm prețul', 'So kalkulieren wir den Preis', 'How we price the job'),
                            'continut' => $t(
                                'Prețul depinde de suprafață, densitatea vegetației și cât de ușor intră utilajele în teren. Trimite-ne câteva poze sau un video din teren și primești rapid o ofertă.',
                                'Der Preis hängt von der Fläche, der Dichte der Vegetation und der Zugänglichkeit für die Maschinen ab. Senden Sie uns einige Fotos oder ein Video vom Grundstück, und Sie erhalten zügig ein Angebot.',
                                'The price depends on the area, the density of the vegetation and how easily the machines can access the land. Send us a few photos or a video of the site and you will get a quote quickly.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'curatare-terenuri',
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Ai un teren de curățat?', 'Sie haben ein Grundstück zu räumen?', 'Have land that needs clearing?'),
                            'text' => $t(
                                'Trimite-ne poze sau un video din teren și primești o ofertă în cel mult 24 de ore.',
                                'Senden Sie uns Fotos oder ein Video vom Grundstück, und Sie erhalten innerhalb von 24 Stunden ein Angebot.',
                                'Send us photos or a video of the site and you will receive a quote within 24 hours.',
                            ),
                            'buton_text' => $t('Cere ofertă', 'Angebot anfordern', 'Request a quote'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 8,
            ],
            [
                'slug' => 'transport-lemn',
                'titlu' => $t('Transport lemn', 'Holztransport', 'Log transport'),
                'meta_title' => $t(
                    'Transport lemn și material lemnos | Galle Silva',
                    'Holztransport — Brennholz, Rundholz, Schnittholz | Galle Silva',
                    'Timber and log transport | Galle Silva',
                ),
                'meta_description' => $t(
                    'Transportăm lemn de foc, bușteni și lemn fasonat cu autospeciale proprii, cu documente de însoțire, în Prahova, Ilfov și București.',
                    'Wir transportieren Brennholz, Rundholz und aufgearbeitetes Holz mit eigenen Spezial-LKW und Begleitpapieren — in Prahova, Ilfov und Bukarest.',
                    'We transport firewood, logs and processed timber with our own trucks and full transport documents, in Prahova, Ilfov and Bucharest.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t(
                                'Transport lemn cu autospeciale în Prahova, București și Ilfov',
                                'Holztransport mit Spezial-LKW in Prahova, Bukarest und Ilfov',
                                'Log transport with specialised trucks in Prahova, Bucharest and Ilfov',
                            ),
                            'intro' => $t(
                                'Transportăm lemn de foc, bușteni și material lemnos fasonat cu autospeciale proprii, din pădure, platformă primară sau depozit, cu documentele de însoțire la zi.',
                                'Wir transportieren Brennholz, Rundholz und aufgearbeitetes Holz mit eigenen Spezial-LKW — aus dem Wald, vom Polter oder aus dem Lager, stets mit aktuellen Begleitpapieren.',
                                'We transport firewood, logs and processed timber with our own trucks — from the forest, the roadside landing or the depot, always with up-to-date transport documents.',
                            ),
                            'imagine' => '/images/galle/proiecte/camion-incarcat-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce transportăm', 'Was wir transportieren', 'What we transport'),
                            'continut' => $t(
                                'Lemn de foc pentru persoane fizice, bușteni și lemn fasonat pentru firme — de la o singură mașină pentru o gospodărie, până la curse regulate. Vezi și [lemnul de foc cu livrare la domiciliu](/lemn-de-foc).',
                                'Brennholz für Privatkunden, Rundholz und aufgearbeitetes Holz für Unternehmen — von einer einzelnen Fuhre für einen Haushalt bis zu regelmäßigen Touren. Siehe auch [Brennholz mit Lieferung frei Haus](/lemn-de-foc).',
                                'Firewood for private customers, logs and processed timber for companies — from a single load for a household to regular runs. See also [firewood with home delivery](/lemn-de-foc).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Autospeciale cu macara', 'LKW mit Ladekran', 'Crane-equipped trucks'),
                            'continut' => $t(
                                'Autospecialele noastre sunt echipate cu macara — încărcăm și descărcăm singuri, fără utilaje suplimentare, inclusiv în locuri mai greu accesibile.',
                                'Unsere LKW sind mit Ladekran ausgestattet — wir be- und entladen selbst, ohne zusätzliche Maschinen, auch an schwer zugänglichen Stellen.',
                                'Our trucks are fitted with cranes — we load and unload ourselves, with no extra machinery, including in harder-to-reach places.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('De unde și unde', 'Von wo nach wo', 'From where to where'),
                            'continut' => $t(
                                'Ridicăm lemnul din pădure (platformă primară), din depozit sau de unde ne spui tu — și îl ducem la depozite, fabrici sau direct la poarta clientului.',
                                'Wir holen das Holz im Wald (am Polter), im Lager oder dort ab, wo Sie es uns sagen — und bringen es zu Lagern, Werken oder direkt vor das Tor des Kunden.',
                                "We pick up the timber from the forest (roadside landing), from the depot or wherever you tell us — and deliver it to depots, mills or straight to the customer's gate.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Documente și trasabilitate (SUMAL)',
                                'Dokumente und Rückverfolgbarkeit (SUMAL)',
                                'Documents and traceability (SUMAL)',
                            ),
                            'continut' => $t(
                                'Fiecare transport pleacă cu aviz de însoțire generat prin SUMAL, conform legislației. Trasabilitate completă, de la pădure până la destinație.',
                                'Jeder Transport ist mit einem über SUMAL (das rumänische System zur Rückverfolgbarkeit von Holz) erstellten Begleitpapier unterwegs, wie gesetzlich vorgeschrieben. Lückenlose Rückverfolgbarkeit — vom Wald bis zum Ziel.',
                                "Every load travels with a transport document generated through SUMAL (Romania's timber traceability system), as required by law. Full traceability, from the forest to the destination.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Zone', 'Einsatzgebiete', 'Areas'),
                            'continut' => $t(
                                'Prahova, Ilfov și București pentru livrările de lemn de foc; pentru curse complete de bușteni ne deplasăm și mai departe.',
                                'Prahova, Ilfov und Bukarest für Brennholzlieferungen; für komplette Rundholztransporte fahren wir auch weiter.',
                                'Prahova, Ilfov and Bucharest for firewood deliveries; for full log hauls we travel further afield.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'transport-lemn',
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Ai lemn de transportat?', 'Sie haben Holz zu transportieren?', 'Have timber to move?'),
                            'text' => $t(
                                'Sună-ne sau scrie-ne — stabilim rapid distanța, volumul și prețul.',
                                'Rufen Sie uns an oder schreiben Sie uns — Entfernung, Volumen und Preis klären wir schnell.',
                                'Call or write to us — we will quickly agree on distance, volume and price.',
                            ),
                            'buton_text' => $t('Contactează-ne', 'Kontaktieren Sie uns', 'Contact us'),
                            'buton_url' => '/contact',
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 9,
            ],
            [
                'slug' => 'lucrari-silvice',
                'titlu' => $t('Lucrări silvice', 'Waldpflege', 'Silvicultural works'),
                'meta_title' => $t(
                    'Lucrări silvice — rărituri și curățiri | Galle Silva',
                    'Waldpflege — Durchforstungen und Läuterungen | Galle Silva',
                    'Silvicultural works — thinning and cleaning | Galle Silva',
                ),
                'meta_description' => $t(
                    'Lucrări de îngrijire a pădurii: curățiri, rărituri, tăieri de igienă, conform amenajamentului silvic, în coordonare cu ocolul silvic.',
                    'Waldpflegearbeiten: Läuterungen, Durchforstungen, Sanitärhiebe — gemäß Forsteinrichtung und in Abstimmung mit dem Forstamt.',
                    'Forest tending works: cleaning, thinning and sanitation felling, according to the forest management plan, in coordination with the forest district office.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t(
                                'Lucrări silvice: curățiri, rărituri și întreținerea arboretelor',
                                'Waldpflege: Läuterungen, Durchforstungen und Bestandespflege',
                                'Silvicultural works: cleaning, thinning and stand tending',
                            ),
                            'intro' => $t(
                                'Executăm lucrări silvice de îngrijire — curățiri, rărituri și tăieri de igienă — conform amenajamentului silvic și în coordonare cu ocolul silvic.',
                                'Wir führen Waldpflegearbeiten aus — Läuterungen, Durchforstungen und Sanitärhiebe — gemäß Forsteinrichtung und in Abstimmung mit dem Forstamt.',
                                'We carry out forest tending works — cleaning, thinning and sanitation felling — according to the forest management plan and in coordination with the forest district office.',
                            ),
                            'imagine' => '/images/galle/proiecte/harvester-lucru-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Pentru păduri private și administrate',
                                'Für private und verwaltete Wälder',
                                'For private and managed forests',
                            ),
                            'continut' => $t(
                                'Lucrăm pentru proprietari de păduri private și pentru ocoale silvice, ca prestatori de servicii. O pădure îngrijită la timp crește mai sănătos și valorează mai mult la [exploatare](/servicii/exploatare-forestiera).',
                                'Wir arbeiten als Dienstleister für private Waldbesitzer und Forstämter. Ein rechtzeitig gepflegter Wald wächst gesünder und ist bei der [Holzernte](/servicii/exploatare-forestiera) mehr wert.',
                                'We work as a contractor for private forest owners and forest districts. A forest tended on time grows healthier and is worth more at [harvest](/servicii/exploatare-forestiera).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Curățiri, rărituri, tăieri de igienă',
                                'Läuterungen, Durchforstungen, Sanitärhiebe',
                                'Cleaning, thinning, sanitation felling',
                            ),
                            'continut' => $t(
                                'Curățirile sunt intervenții în arboretele tinere, prin care se elimină exemplarele rău conformate. Răriturile extrag o parte din arbori, ca să le facă loc celor de viitor. Tăierile de igienă scot arborii uscați, rupți sau atacați de dăunători.',
                                'Läuterungen sind Eingriffe in jungen Beständen, bei denen schlecht geformte Exemplare entfernt werden. Durchforstungen entnehmen einen Teil der Bäume, um den Zukunftsbäumen Platz zu schaffen. Sanitärhiebe entfernen trockene, gebrochene oder von Schädlingen befallene Bäume.',
                                'Cleaning means interventions in young stands to remove poorly formed trees. Thinning takes out a share of the trees to make room for the future crop trees. Sanitation felling removes dry, broken or pest-infested trees.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Conform amenajamentului', 'Gemäß Forsteinrichtung', 'According to the management plan'),
                            'continut' => $t(
                                'Toate lucrările se execută conform amenajamentului silvic și pe bază de marcaj — arborii care se extrag sunt stabiliți împreună cu ocolul silvic, nu la întâmplare.',
                                'Alle Arbeiten erfolgen gemäß der Forsteinrichtung und auf Grundlage der amtlichen Markierung — welche Bäume entnommen werden, wird gemeinsam mit dem Forstamt festgelegt, nicht nach Gutdünken.',
                                'All works follow the forest management plan and the official tree marking — the trees to be removed are decided together with the forest district office, never at random.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Echipă și utilaje', 'Team und Maschinen', 'Team and machinery'),
                            'continut' => $t(
                                'Folosim echipe specializate în lucrări de îngrijire și utilaje potrivite pentru intervenții cu impact redus — aceleași standarde germane pe care le aplicăm la toate lucrările Galle.',
                                'Wir setzen auf Pflegearbeiten spezialisierte Teams und Maschinen für bodenschonende Eingriffe ein — dieselben deutschen Standards, die wir bei allen Galle-Arbeiten anwenden.',
                                'We use teams specialised in tending works and machinery suited to low-impact interventions — the same German standards we apply to all Galle jobs.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Documente', 'Dokumente', 'Documents'),
                            'continut' => $t(
                                'Lucrările în fond forestier se fac cu servicii silvice asigurate prin ocol; materialul rezultat pleacă cu avize generate prin SUMAL. Te ghidăm prin tot procesul.',
                                'Arbeiten im Waldfonds erfolgen mit über das Forstamt gesicherten Forstdienstleistungen; das anfallende Material wird mit über SUMAL erstellten Begleitpapieren abgefahren. Wir begleiten Sie durch den gesamten Prozess.',
                                'Works on forest land are carried out with forestry services provided through the forest district; the resulting material leaves with SUMAL-generated transport documents. We guide you through the whole process.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'faq',
                        'data' => [
                            'categorie' => 'lucrari-silvice',
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                        ],
                    ],
                    [
                        'type' => 'cta',
                        'data' => [
                            'titlu' => $t('Pădurea ta are nevoie de îngrijire?', 'Braucht Ihr Wald Pflege?', 'Does your forest need tending?'),
                            'text' => $t(
                                'Spune-ne unde e și în ce stadiu e arboretul — venim la evaluare și îți propunem lucrările potrivite.',
                                'Sagen Sie uns, wo er liegt und in welchem Zustand der Bestand ist — wir kommen zur Bewertung und schlagen Ihnen die passenden Arbeiten vor.',
                                'Tell us where it is and what stage the stand is at — we will come out for an assessment and propose the right works.',
                            ),
                            'buton_text' => $t('Cere o evaluare', 'Bewertung anfordern', 'Request an assessment'),
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
                'meta_title' => $t(
                    'Lemn de foc Prahova — stejar, carpen, fag, cu livrare | Galle Silva',
                    'Brennholz Prahova — Eiche, Hainbuche, Buche, mit Lieferung | Galle Silva',
                    'Firewood in Prahova — oak, hornbeam, beech, delivered | Galle Silva',
                ),
                'meta_description' => $t(
                    'Lemn de foc de esență tare (stejar, carpen, fag), tăiat și crăpat, de la 350 lei/m³. Livrare în Prahova, Ilfov și București. Fără cantitate minimă.',
                    'Hartholz-Brennholz (Eiche, Hainbuche, Buche), gesägt und gespalten, ab 350 Lei/m³. Lieferung in Prahova, Ilfov und Bukarest. Ohne Mindestmenge.',
                    'Hardwood firewood (oak, hornbeam, beech), cut and split, from 350 Lei/m³. Delivery in Prahova, Ilfov and Bucharest. No minimum order.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Preț: de la 350 lei/m³', 'Preis: ab 350 Lei/m³', 'Price: from 350 Lei/m³'),
                            'continut' => $t(
                                "Prețul de pornire este 350 lei/m³ și variază în funcție de esență, modul de preluare și cantitate. Fără cantitate minimă. Oferim livrare la domiciliu sau ridicare din platforma primară.\n\nLemnul vine din [exploatările noastre forestiere](/servicii/exploatare-forestiera) din Prahova — de la pădure la tine, fără intermediari.",
                                "Der Startpreis liegt bei 350 Lei/m³ und variiert je nach Holzart, Liefer- bzw. Abholweg und Menge. Ohne Mindestmenge. Wir bieten Lieferung frei Haus oder Abholung am Polter an der Forststraße.\n\nDas Holz stammt aus [unserer eigenen Holzernte](/servicii/exploatare-forestiera) in Prahova — vom Wald zu Ihnen, ohne Zwischenhändler.",
                                "The starting price is 350 Lei/m³ and varies by species, pickup or delivery, and quantity. No minimum order. We offer home delivery or pickup from the roadside landing.\n\nThe wood comes from [our own harvesting operations](/servicii/exploatare-forestiera) in Prahova — from the forest to you, with no middlemen.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Esențe: stejar și carpen pe stoc',
                                'Holzarten: Eiche und Hainbuche auf Lager',
                                'Species: oak and hornbeam in stock',
                            ),
                            'continut' => $t(
                                'Pe stoc acum: stejar și carpen. Esențe tari, cu ardere lungă: carpen, fag, stejar, frasin, salcâm, ulm, dud. Esențe moi, pentru aprindere sau ardere rapidă: plop, tei, rășinoase.',
                                'Aktuell auf Lager: Eiche und Hainbuche. Hartholz mit langer Brenndauer: Hainbuche, Buche, Eiche, Esche, Robinie, Ulme, Maulbeere. Weichholz zum Anzünden oder für schnelles Feuer: Pappel, Linde, Nadelholz.',
                                'In stock now: oak and hornbeam. Hardwoods, slow-burning: hornbeam, beech, oak, ash, black locust, elm, mulberry. Softwoods, for kindling or quick fires: poplar, lime, conifers.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum vindem', 'So verkaufen wir', 'How we sell'),
                            'continut' => $t(
                                'Vindem la metru cub (m³) sau la metru ster, tăiat și crăpat la dimensiunea cerută de soba, centrala sau șemineul tău.',
                                'Wir verkaufen pro Festmeter (m³) oder pro Raummeter (Ster), gesägt und gespalten auf das Maß, das Ihr Ofen, Kessel oder Kamin benötigt.',
                                'We sell by solid cubic meter (m³) or by stacked cubic meter (ster), cut and split to the size your stove, boiler or fireplace needs.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Livrare și plată', 'Lieferung und Bezahlung', 'Delivery and payment'),
                            'continut' => $t(
                                'Livrăm în 1–3 zile (maximum 7), în funcție de zonă, cu [autospecialele noastre](/servicii/transport-lemn). Plata la livrare — cash, POS sau transfer bancar. Oferim și livrare la domiciliu, până la poartă.',
                                'Wir liefern in 1–3 Tagen (maximal 7), je nach Gebiet, mit [unseren eigenen LKW](/servicii/transport-lemn). Zahlung bei Lieferung — bar, per Karte (POS) oder Überweisung. Wir liefern auf Wunsch frei Haus, bis vor Ihr Tor.',
                                'We deliver within 1–3 days (7 at most), depending on the area, with [our own trucks](/servicii/transport-lemn). Payment on delivery — cash, card (POS) or bank transfer. We also deliver to your home, right to the gate.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Metru ster vs metru cub',
                                'Raummeter (Ster) vs. Festmeter',
                                'Stacked cubic meter (ster) vs solid cubic meter',
                            ),
                            'continut' => $t(
                                'Metrul cub este lemn plin; metrul ster este lemn stivuit, cu spații între bucăți — aproximativ 0,6–0,65 m³ de lemn plin la un ster. Când compari prețuri, întreabă mereu în ce unitate e dat prețul.',
                                'Der Festmeter (m³) ist massives Holz; der Raummeter (Ster) ist gestapeltes Holz mit Zwischenräumen — etwa 0,6–0,65 m³ massives Holz pro Ster. Wenn Sie Preise vergleichen, fragen Sie immer, auf welche Einheit sich der Preis bezieht.',
                                'A solid cubic meter (m³) is solid wood; a stacked cubic meter (ster) is stacked wood with air gaps — roughly 0.6–0.65 m³ of solid wood per ster. When comparing prices, always ask which unit the price refers to.',
                            ),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 4,
            ],
            [
                'slug' => 'despre',
                'titlu' => ['ro' => 'Despre noi', 'de' => 'Über uns', 'en' => 'About'],
                'meta_title' => $t(
                    'Despre Galle Silva — standarde germane în silvicultură',
                    'Über Galle Silva — deutsche Standards in der Forstwirtschaft',
                    'About Galle Silva — German standards in forestry',
                ),
                'meta_description' => $t(
                    'Galle Silva este reprezentanța în România a grupului german Galle GmbH. Utilaje moderne, echipă specializată, exploatare responsabilă în Prahova.',
                    'Galle Silva ist die rumänische Vertretung der deutschen Galle GmbH. Moderne Maschinen, spezialisiertes Team, verantwortungsvolle Holzernte in Prahova.',
                    'Galle Silva is the Romanian arm of the German group Galle GmbH. Modern machinery, a specialised team and responsible harvesting in Prahova.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Despre Galle Silva', 'Über Galle Silva', 'About Galle Silva'),
                            'intro' => $t(
                                'Galle Silva este reprezentanța în România a grupului german Galle GmbH — aducem în Prahova utilaje moderne, echipă specializată și exploatare forestieră responsabilă.',
                                'Galle Silva ist die rumänische Vertretung der deutschen Galle GmbH — wir bringen moderne Maschinen, ein spezialisiertes Team und verantwortungsvolle Holzernte nach Prahova.',
                                'Galle Silva is the Romanian arm of the German group Galle GmbH — bringing modern machinery, a specialised team and responsible timber harvesting to Prahova.',
                            ),
                            'imagine' => '/images/galle/proiecte/depozit-utilaj-wide.webp',
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Galle Silva SRL — cine suntem', 'Galle Silva SRL — wer wir sind', 'Galle Silva SRL — who we are'),
                            'continut' => $t(
                                'Galle Silva SRL este firma din grup care operează în România, cu sediul în Mănești, județul Prahova. Facem [exploatare forestieră](/servicii/exploatare-forestiera), [achiziție de masă lemnoasă](/servicii/achizitie-masa-lemnoasa), [transport lemn](/servicii/transport-lemn) și vindem [lemn de foc](/lemn-de-foc) în Prahova, Ilfov și București.',
                                'Die Galle Silva SRL ist das in Rumänien tätige Unternehmen der Gruppe, mit Sitz in Mănești, Kreis Prahova. Wir bieten [Holzernte](/servicii/exploatare-forestiera), [Holzankauf](/servicii/achizitie-masa-lemnoasa) und [Holztransport](/servicii/transport-lemn) und verkaufen [Brennholz](/lemn-de-foc) in Prahova, Ilfov und Bukarest.',
                                "Galle Silva SRL is the group's operating company in Romania, headquartered in Mănești, Prahova county. We provide [timber harvesting](/servicii/exploatare-forestiera), [timber purchasing](/servicii/achizitie-masa-lemnoasa) and [log transport](/servicii/transport-lemn), and sell [firewood](/lemn-de-foc) in Prahova, Ilfov and Bucharest.",
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Parte din grupul Galle GmbH',
                                'Teil der Galle GmbH Gruppe',
                                'Part of the Galle GmbH group',
                            ),
                            'continut' => $t(
                                'Galle Silva aduce în România experiența grupului german Galle GmbH. Fondată în 1990, în districtul Elbe-Elster (Brandenburg, Germania), Galle GmbH activează de peste 30 de ani în servicii forestiere, peisagistică, compostare și producție de sol. De-a lungul timpului și-a modernizat parcul de utilaje și a dezvoltat zona de servicii forestiere, ajungând la o echipă de aproximativ 38 de angajați.'
                                ."\n\n"
                                .'Grupul lucrează după standarde înalte de mediu: este certificat cu sigiliile de calitate RAL pentru gestionarea pădurilor și pentru compostare, ca firmă autorizată de management al deșeurilor, folosește uleiuri hidraulice biodegradabile și recoltează lemnul complet mecanizat, valorificând inclusiv resturile (vârfuri și cioate) ca lemn energetic.'
                                ."\n\n"
                                .'În România, Galle Silva preia această experiență și aceste standarde și le aplică local — concentrându-se pe servicii forestiere și lemn de foc în Prahova, Ilfov și București.',
                                'Galle Silva bringt die Erfahrung der deutschen Galle GmbH Gruppe nach Rumänien. 1990 im Landkreis Elbe-Elster (Brandenburg, Deutschland) gegründet, ist die Galle GmbH seit über 30 Jahren in den Bereichen Forstdienstleistungen, Landschaftsbau, Kompostierung und Bodenproduktion tätig. Im Laufe der Zeit hat sie ihren Maschinenpark modernisiert und den Bereich der Forstdienstleistungen ausgebaut und beschäftigt heute ein Team von rund 38 Mitarbeitern.'
                                ."\n\n"
                                .'Die Gruppe arbeitet nach hohen Umweltstandards: Sie ist mit den RAL-Gütezeichen für die Waldbewirtschaftung und für die Kompostierung als zugelassener Entsorgungsfachbetrieb zertifiziert, verwendet biologisch abbaubare Hydrauliköle und erntet das Holz vollmechanisiert, wobei sie auch die Reste (Wipfel und Stöcke) als Energieholz verwertet.'
                                ."\n\n"
                                .'In Rumänien übernimmt Galle Silva diese Erfahrung und diese Standards und wendet sie vor Ort an — mit Schwerpunkt auf Forstdienstleistungen und Brennholz in Prahova, Ilfov und Bukarest.',
                                'Galle Silva brings the experience of the German Galle GmbH group to Romania. Founded in 1990 in the Elbe-Elster district (Brandenburg, Germany), Galle GmbH has been active for over 30 years in forestry services, landscaping, composting and soil production. Over time it has modernised its machinery fleet and developed its forestry services division, growing to a team of around 38 employees.'
                                ."\n\n"
                                .'The group works to high environmental standards: it is certified with the RAL quality marks for forest management and for composting, as an authorised waste management company, uses biodegradable hydraulic oils and harvests timber in fully mechanised operations, also making use of the residues (tops and stumps) as energy wood.'
                                ."\n\n"
                                .'In Romania, Galle Silva takes on this experience and these standards and applies them locally — focusing on forestry services and firewood in Prahova, Ilfov and Bucharest.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t(
                                'Parteneriatul: standarde germane, aplicate în România',
                                'Die Partnerschaft: deutsche Standards, angewandt in Rumänien',
                                'The partnership: German standards, applied in Romania',
                            ),
                            'continut' => $t(
                                'Galle Silva aplică în România procedurile, controalele și principiile grupului Galle: utilaje moderne, lucrări corecte, documente complete și respect pentru pădure. Suntem în proces de certificare FSC și PEFC.',
                                'Galle Silva wendet in Rumänien die Verfahren, Kontrollen und Grundsätze der Galle-Gruppe an: moderne Maschinen, fachgerechte Arbeit, vollständige Dokumente und Respekt für den Wald. Die FSC- und PEFC-Zertifizierung läuft.',
                                'Galle Silva applies in Romania the procedures, controls and principles of the Galle group: modern machinery, work done right, complete documentation and respect for the forest. FSC and PEFC certification is in progress.',
                            ),
                        ],
                    ],
                    [
                        // Echipa vine din modelul Membru (gestionabil din admin, cu poze).
                        // Membrii sunt seed-uiti de MembruSeeder.
                        'type' => 'echipa',
                        'data' => [
                            'eyebrow' => $t('Oamenii Galle Silva', 'Die Menschen hinter Galle Silva', 'The people of Galle Silva'),
                            'titlu' => $t('Echipa', 'Das Team', 'The team'),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 10,
            ],
            [
                'slug' => 'institutii',
                'titlu' => $t(
                    'Pentru institutii si primarii',
                    'Für Institutionen und Gemeinden',
                    'For institutions and municipalities',
                ),
                'meta_title' => $t(
                    'Servicii pentru primarii, institutii si companii — Galle Silva',
                    'Leistungen für Gemeinden, Institutionen und Unternehmen — Galle Silva',
                    'Services for municipalities, institutions and companies — Galle Silva',
                ),
                'meta_description' => $t(
                    'Servicii forestiere, peisagistica si compostare pentru primarii, institutii si companii din Prahova, Ilfov si Bucuresti.',
                    'Forstdienstleistungen, Landschaftsbau und Kompostierung für Gemeinden, Institutionen und Unternehmen in Prahova, Ilfov und Bukarest.',
                    'Forestry services, landscaping and composting for municipalities, institutions and companies in Prahova, Ilfov and Bucharest.',
                ),
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 20,
            ],
            [
                'slug' => 'certificari',
                'titlu' => ['ro' => 'Certificari', 'de' => 'Zertifizierungen', 'en' => 'Certifications'],
                'meta_title' => $t(
                    'Certificari FSC, PEFC, ISO — Galle Silva si Galle GmbH',
                    'Zertifizierungen FSC, PEFC, ISO — Galle Silva und Galle GmbH',
                    'FSC, PEFC, ISO certifications — Galle Silva and Galle GmbH',
                ),
                'meta_description' => $t(
                    'FSC si PEFC in proces de certificare. Galle GmbH detine ISO 9001, ISO 14001, RAL si DEKRA. De ce conteaza fiecare?',
                    'FSC und PEFC im Zertifizierungsprozess. Die Galle GmbH hält ISO 9001, ISO 14001, RAL und DEKRA. Warum jede davon zählt.',
                    'FSC and PEFC certification in progress. Galle GmbH holds ISO 9001, ISO 14001, RAL and DEKRA. Why each one matters.',
                ),
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 30,
            ],
            [
                'slug' => 'date-firma',
                'titlu' => ['ro' => 'Date firma', 'de' => 'Impressum', 'en' => 'Legal notice'],
                'meta_title' => $t(
                    'Date firma / Impressum — Galle Silva SRL',
                    'Impressum — Galle Silva SRL',
                    'Company details / Legal notice — Galle Silva SRL',
                ),
                'meta_description' => $t(
                    'Datele de identificare ale Galle Silva SRL: CUI, Registrul Comertului, sediu social, contact si reprezentant legal.',
                    'Identifikationsdaten der Galle Silva SRL: CUI (Steuernummer), Handelsregister, eingetragener Sitz, Kontakt und gesetzlicher Vertreter.',
                    'Identification details of Galle Silva SRL: CUI (tax ID), Trade Register, registered office, contact and legal representative.',
                ),
                'sectiuni' => null,
                'is_published' => true,
                'ordine' => 90,
            ],
            // Textele legale de mai jos sunt un DRAFT de lucru (nu consultanta juridica) —
            // se revizuiesc de cineva competent inainte de lansarea publica (vezi README).
            // DE/EN sunt seed-uite (traducere de lucru) si pot fi revizuite din /admin.
            [
                'slug' => 'termeni',
                'titlu' => ['ro' => 'Termeni si conditii', 'de' => 'Allgemeine Geschäftsbedingungen', 'en' => 'Terms and Conditions'],
                'sectiuni' => [
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => null,
                            'continut' => $t(
                                'Prin folosirea acestui site si prin transmiterea unei solicitari sau comenzi catre GALLE SILVA SRL, esti de acord cu termenii de mai jos.',
                                'Mit der Nutzung dieser Website und der Übermittlung einer Anfrage oder Bestellung an die GALLE SILVA SRL erklären Sie sich mit den nachstehenden Bedingungen einverstanden.',
                                'By using this website and by submitting a request or order to GALLE SILVA SRL, you agree to the terms set out below.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cine suntem', 'Wer wir sind', 'Who we are'),
                            'continut' => $t(
                                'GALLE SILVA SRL, CUI 52771440, Reg. Com. J2025081738000, sediu in Str. Principala nr. 302, Sat Manesti, jud. Prahova. Date complete pe pagina [Date firma](/date-firma).',
                                'GALLE SILVA SRL, CUI (Steuernummer) 52771440, Handelsregister-Nr. J2025081738000, Sitz in Str. Principala Nr. 302, Sat Manesti, Kreis Prahova. Vollständige Angaben finden Sie auf der Seite [Impressum](/date-firma).',
                                'GALLE SILVA SRL, CUI (tax ID) 52771440, Trade Register No. J2025081738000, registered office at Str. Principala nr. 302, Sat Manesti, Prahova county. Full details on the [Legal notice](/date-firma) page.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Despre site si servicii', 'Über die Website und die Leistungen', 'About the website and services'),
                            'continut' => $t(
                                'Site-ul prezinta serviciile noastre forestiere si oferta de lemn de foc, in Prahova, Ilfov si Bucuresti. Informatiile au caracter de prezentare; nu reprezinta o oferta ferma de pret.',
                                'Die Website stellt unsere Forstdienstleistungen und unser Brennholzangebot in Prahova, Ilfov und Bukarest vor. Die Informationen dienen der Darstellung; sie stellen kein verbindliches Preisangebot dar.',
                                'The website presents our forestry services and firewood offer in Prahova, Ilfov and Bucharest. The information is for presentation purposes only; it does not constitute a binding price offer.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Preturi si comenzi', 'Preise und Bestellungen', 'Prices and orders'),
                            'continut' => $t(
                                'Preturile afisate (de exemplu, de la 350 lei/m³ pentru lemnul de foc) sunt orientative, de pornire, si pot varia in functie de esenta, cantitate, mod de preluare si zona de livrare. Pretul final si disponibilitatea se confirma in oferta, telefonic sau prin email, inainte de livrare. O comanda transmisa prin formular reprezinta o solicitare; contractul se incheie la confirmarea noastra.',
                                'Die angegebenen Preise (zum Beispiel ab 350 Lei/m³ für Brennholz) sind Richt- und Startpreise und können je nach Holzart, Menge, Art der Abnahme und Liefergebiet variieren. Der endgültige Preis und die Verfügbarkeit werden im Angebot, telefonisch oder per E-Mail, vor der Lieferung bestätigt. Eine über das Formular übermittelte Bestellung stellt eine Anfrage dar; der Vertrag kommt mit unserer Bestätigung zustande.',
                                'The prices shown (for example, from 350 lei/m³ for firewood) are indicative starting prices and may vary depending on the wood species, quantity, method of collection and delivery area. The final price and availability are confirmed in the offer, by phone or email, before delivery. An order submitted through the form constitutes a request; the contract is concluded upon our confirmation.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Livrare si plata', 'Lieferung und Zahlung', 'Delivery and payment'),
                            'continut' => $t(
                                'Livram, de regula, in 1–3 zile lucratoare (maxim 7), in functie de zona. Oferim si livrare la domiciliu. Plata se poate face la livrare, numerar, cu cardul (POS) sau prin transfer bancar.',
                                'Wir liefern in der Regel innerhalb von 1–3 Werktagen (maximal 7), je nach Gebiet. Wir bieten auch Lieferung bis zur Haustür an. Die Zahlung kann bei Lieferung in bar, mit Karte (POS) oder per Banküberweisung erfolgen.',
                                'We usually deliver within 1–3 working days (maximum 7), depending on the area. We also offer home delivery. Payment can be made on delivery, in cash, by card (POS) or by bank transfer.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Dreptul de retragere (consumatori)', 'Widerrufsrecht (Verbraucher)', 'Right of withdrawal (consumers)'),
                            'continut' => $t(
                                'Daca esti consumator, beneficiezi de drepturile prevazute de legislatia privind protectia consumatorilor, inclusiv, acolo unde se aplica, dreptul de a te retrage in conditiile legii. Te rugam sa ne contactezi pentru detalii legate de situatia concreta.',
                                'Wenn Sie Verbraucher sind, stehen Ihnen die im Verbraucherschutzrecht vorgesehenen Rechte zu, einschließlich, soweit anwendbar, des Widerrufsrechts nach Maßgabe des Gesetzes. Bitte kontaktieren Sie uns für Einzelheiten zu Ihrem konkreten Fall.',
                                'If you are a consumer, you are entitled to the rights provided by consumer protection legislation, including, where applicable, the right to withdraw under the conditions set by law. Please contact us for details regarding your specific situation.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Raspundere', 'Haftung', 'Liability'),
                            'continut' => $t(
                                'Ne straduim ca informatiile de pe site sa fie corecte si actualizate, dar nu garantam ca sunt complete sau lipsite de erori in orice moment.',
                                'Wir bemühen uns, die Informationen auf der Website korrekt und aktuell zu halten, übernehmen jedoch keine Gewähr dafür, dass sie jederzeit vollständig oder fehlerfrei sind.',
                                'We strive to keep the information on the website correct and up to date, but we do not guarantee that it is complete or free of errors at all times.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Proprietate intelectuala', 'Geistiges Eigentum', 'Intellectual property'),
                            'continut' => $t(
                                'Continutul site-ului (texte, imagini, logo-uri) apartine GALLE SILVA SRL sau partenerilor sai si nu poate fi folosit fara acord.',
                                'Die Inhalte der Website (Texte, Bilder, Logos) gehören der GALLE SILVA SRL oder ihren Partnern und dürfen nicht ohne Zustimmung verwendet werden.',
                                'The content of the website (texts, images, logos) belongs to GALLE SILVA SRL or its partners and may not be used without consent.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Lege aplicabila si litigii', 'Anwendbares Recht und Streitigkeiten', 'Applicable law and disputes'),
                            'continut' => $t(
                                'Acestor termeni li se aplica legea romana. Eventualele neintelegeri se solutioneaza pe cale amiabila; in caz contrar, sunt competente instantele din Romania. Consumatorii pot apela si la platforma SOL a Comisiei Europene sau la ANPC.',
                                'Auf diese Bedingungen findet rumänisches Recht Anwendung. Etwaige Streitigkeiten werden gütlich beigelegt; andernfalls sind die Gerichte in Rumänien zuständig. Verbraucher können sich auch an die OS-Plattform (SOL) der Europäischen Kommission oder an die rumänische Verbraucherschutzbehörde (ANPC) wenden.',
                                'These terms are governed by Romanian law. Any disputes shall be settled amicably; otherwise, the courts in Romania have jurisdiction. Consumers may also turn to the European Commission\'s ODR platform (SOL) or to the Romanian consumer protection authority (ANPC).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Contact', 'Kontakt', 'Contact'),
                            'continut' => $t(
                                'Pentru orice intrebare: info@galle-silva.com, +40 729 961 082.',
                                'Bei Fragen erreichen Sie uns unter: info@galle-silva.com, +40 729 961 082.',
                                'For any questions: info@galle-silva.com, +40 729 961 082.',
                            ),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 100,
            ],
            [
                'slug' => 'confidentialitate',
                'titlu' => ['ro' => 'Politica de confidentialitate', 'de' => 'Datenschutzerklärung', 'en' => 'Privacy Policy'],
                'sectiuni' => [
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => null,
                            'continut' => $t(
                                'Aceasta politica explica modul in care GALLE SILVA SRL prelucreaza datele cu caracter personal ale persoanelor care folosesc acest site, in conformitate cu Regulamentul (UE) 2016/679 (GDPR).',
                                'Diese Erklärung beschreibt, wie die GALLE SILVA SRL die personenbezogenen Daten der Personen verarbeitet, die diese Website nutzen, in Übereinstimmung mit der Verordnung (EU) 2016/679 (DSGVO).',
                                'This policy explains how GALLE SILVA SRL processes the personal data of people who use this website, in accordance with Regulation (EU) 2016/679 (GDPR).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Operatorul de date', 'Der Verantwortliche', 'The data controller'),
                            // Datele legale vin din config/company.php (o singura sursa de adevar).
                            'continut' => $t(
                                sprintf(
                                    '%s, CUI %s, Reg. Com. %s, sediu in %s, %s, jud. %s, cod %s. Persoana de contact pentru protectia datelor: %s (administrator). Ne poti contacta la %s sau la %s. Datele complete ale firmei sunt pe pagina [Date firma](/date-firma).',
                                    ...$operatorArgs,
                                ),
                                sprintf(
                                    '%s, CUI (Steuernummer) %s, Handelsregister-Nr. %s, Sitz in %s, %s, Kreis %s, PLZ %s. Ansprechpartner für den Datenschutz: %s (Geschäftsführer). Sie können uns unter %s oder %s erreichen. Die vollständigen Angaben zum Unternehmen finden Sie auf der Seite [Impressum](/date-firma).',
                                    ...$operatorArgs,
                                ),
                                sprintf(
                                    '%s, CUI (tax ID) %s, Trade Register No. %s, registered office at %s, %s, %s county, postal code %s. Data protection contact: %s (administrator). You can reach us at %s or %s. The full company details are on the [Legal notice](/date-firma) page.',
                                    ...$operatorArgs,
                                ),
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce date colectam', 'Welche Daten wir erheben', 'What data we collect'),
                            'continut' => $t(
                                'Colectam doar datele pe care ni le furnizezi prin formularele de pe site (formularul de contact si formularul de comanda): nume, adresa de email, numar de telefon, localitatea/adresa pentru livrare si detaliile mesajului sau ale comenzii tale. Nu colectam mai multe date decat sunt necesare.',
                                'Wir erheben nur die Daten, die Sie uns über die Formulare auf der Website (Kontaktformular und Bestellformular) bereitstellen: Name, E-Mail-Adresse, Telefonnummer, Ort/Lieferadresse sowie die Angaben zu Ihrer Nachricht oder Bestellung. Wir erheben nicht mehr Daten als erforderlich.',
                                'We only collect the data you provide to us through the forms on the website (the contact form and the order form): name, email address, phone number, locality/delivery address and the details of your message or order. We do not collect more data than necessary.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('In ce scop si pe ce temei legal', 'Zu welchem Zweck und auf welcher Rechtsgrundlage', 'For what purpose and on what legal basis'),
                            'continut' => $t(
                                'Folosim aceste date pentru a raspunde solicitarilor tale, a-ti transmite oferte si a procesa si livra comenzile. Temeiul legal este, dupa caz: executarea unui contract sau demersuri precontractuale la cererea ta (art. 6 alin. 1 lit. b GDPR), consimtamantul tau pentru formularul de contact (art. 6 alin. 1 lit. a) si interesul nostru legitim de a raspunde si a ne desfasura activitatea (art. 6 alin. 1 lit. f). Pentru facturare si evidenta, prelucrarea se face si in baza obligatiilor legale (art. 6 alin. 1 lit. c).',
                                'Wir verwenden diese Daten, um auf Ihre Anfragen zu antworten, Ihnen Angebote zu übermitteln sowie Bestellungen zu bearbeiten und zu liefern. Die Rechtsgrundlage ist je nach Fall: die Erfüllung eines Vertrags oder vorvertragliche Maßnahmen auf Ihre Anfrage hin (Art. 6 Abs. 1 lit. b DSGVO), Ihre Einwilligung für das Kontaktformular (Art. 6 Abs. 1 lit. a) und unser berechtigtes Interesse, zu antworten und unsere Tätigkeit auszuüben (Art. 6 Abs. 1 lit. f). Für Rechnungsstellung und Buchführung erfolgt die Verarbeitung zudem auf Grundlage gesetzlicher Pflichten (Art. 6 Abs. 1 lit. c).',
                                'We use this data to respond to your requests, send you offers and process and deliver orders. The legal basis is, as the case may be: the performance of a contract or pre-contractual steps taken at your request (Art. 6(1)(b) GDPR), your consent for the contact form (Art. 6(1)(a)) and our legitimate interest in responding and carrying out our business (Art. 6(1)(f)). For invoicing and record-keeping, processing is also based on legal obligations (Art. 6(1)(c)).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cat timp pastram datele', 'Wie lange wir die Daten speichern', 'How long we keep the data'),
                            'continut' => $t(
                                'Pastram datele doar atat cat este necesar scopului pentru care au fost colectate si pentru respectarea obligatiilor legale (de exemplu, documentele financiar-contabile, conform legii). Dupa expirarea acestor termene, datele sunt sterse sau anonimizate.',
                                'Wir speichern die Daten nur so lange, wie es für den Zweck, zu dem sie erhoben wurden, und zur Erfüllung gesetzlicher Pflichten erforderlich ist (zum Beispiel Finanz- und Buchhaltungsunterlagen gemäß den gesetzlichen Vorgaben). Nach Ablauf dieser Fristen werden die Daten gelöscht oder anonymisiert.',
                                'We keep the data only for as long as necessary for the purpose for which it was collected and to comply with legal obligations (for example, financial and accounting documents, as required by law). After these periods expire, the data is deleted or anonymised.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cui dezvaluim datele', 'An wen wir die Daten weitergeben', 'To whom we disclose the data'),
                            'continut' => $t(
                                'Nu vindem datele tale. Le putem dezvalui doar furnizorilor care ne ajuta sa operam site-ul si serviciul (furnizorul de gazduire web si de email — ALL-INKL.com, cu servere in Germania/Uniunea Europeana), care prelucreaza datele in numele nostru, pe baza de contract, si autoritatilor publice doar cand legea ne obliga. Datele tale sunt stocate pe servere in Uniunea Europeana; nu efectuam transferuri in afara UE.',
                                'Wir verkaufen Ihre Daten nicht. Wir geben sie nur an Dienstleister weiter, die uns beim Betrieb der Website und des Dienstes unterstützen (der Webhosting- und E-Mail-Anbieter — ALL-INKL.com, mit Servern in Deutschland/der Europäischen Union), die die Daten in unserem Auftrag auf vertraglicher Grundlage verarbeiten, sowie an Behörden nur dann, wenn das Gesetz uns dazu verpflichtet. Ihre Daten werden auf Servern in der Europäischen Union gespeichert; wir führen keine Übermittlungen außerhalb der EU durch.',
                                'We do not sell your data. We may only disclose it to providers who help us operate the website and the service (the web hosting and email provider — ALL-INKL.com, with servers in Germany/the European Union), who process the data on our behalf on a contractual basis, and to public authorities only when required by law. Your data is stored on servers in the European Union; we do not carry out transfers outside the EU.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cookie-uri', 'Cookies', 'Cookies'),
                            'continut' => $t(
                                'Folosim doar cookie-uri necesare functionarii site-ului. Detalii in [Politica de cookies](/cookies).',
                                'Wir verwenden nur Cookies, die für den Betrieb der Website erforderlich sind. Einzelheiten finden Sie in der [Cookie-Richtlinie](/cookies).',
                                'We use only cookies necessary for the operation of the website. Details in the [Cookie Policy](/cookies).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Drepturile tale', 'Ihre Rechte', 'Your rights'),
                            'continut' => $t(
                                'Ai dreptul de acces, rectificare, stergere, restrictionare a prelucrarii, opozitie, portabilitate a datelor si dreptul de a-ti retrage consimtamantul oricand. Le poti exercita scriindu-ne la info@galle-silva.com. Ai, de asemenea, dreptul de a depune o plangere la Autoritatea Nationala de Supraveghere a Prelucrarii Datelor cu Caracter Personal (ANSPDCP).',
                                'Sie haben das Recht auf Auskunft, Berichtigung, Löschung, Einschränkung der Verarbeitung, Widerspruch, Datenübertragbarkeit sowie das Recht, Ihre Einwilligung jederzeit zu widerrufen. Sie können diese Rechte ausüben, indem Sie uns an info@galle-silva.com schreiben. Sie haben außerdem das Recht, eine Beschwerde bei der rumänischen Datenschutzbehörde (ANSPDCP) einzureichen.',
                                'You have the right to access, rectification, erasure, restriction of processing, objection, data portability and the right to withdraw your consent at any time. You can exercise them by writing to us at info@galle-silva.com. You also have the right to lodge a complaint with the Romanian data protection authority (ANSPDCP).',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Securitate', 'Sicherheit', 'Security'),
                            'continut' => $t(
                                'Aplicam masuri tehnice si organizatorice rezonabile pentru a proteja datele tale. Transmisiile pe internet nu pot fi insa garantate complet impotriva oricarui risc.',
                                'Wir treffen angemessene technische und organisatorische Maßnahmen, um Ihre Daten zu schützen. Übertragungen über das Internet können jedoch nicht vollständig gegen jedes Risiko abgesichert werden.',
                                'We apply reasonable technical and organisational measures to protect your data. However, transmissions over the internet cannot be fully guaranteed against any risk.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Minori', 'Minderjährige', 'Minors'),
                            'continut' => $t(
                                'Site-ul nu se adreseaza minorilor si nu colectam cu intentie date de la persoane sub 16 ani.',
                                'Die Website richtet sich nicht an Minderjährige, und wir erheben nicht absichtlich Daten von Personen unter 16 Jahren.',
                                'The website is not aimed at minors, and we do not intentionally collect data from persons under the age of 16.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Modificari', 'Änderungen', 'Changes'),
                            'continut' => $t(
                                'Putem actualiza aceasta politica; versiunea curenta este cea publicata pe aceasta pagina.',
                                'Wir können diese Erklärung aktualisieren; die aktuelle Fassung ist die auf dieser Seite veröffentlichte.',
                                'We may update this policy; the current version is the one published on this page.',
                            ),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 110,
            ],
            [
                'slug' => 'cookies',
                'titlu' => ['ro' => 'Politica cookies', 'de' => 'Cookie-Richtlinie', 'en' => 'Cookie Policy'],
                'sectiuni' => [
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => null,
                            'continut' => $t(
                                'Aceasta pagina explica ce cookie-uri folosim pe site-ul GALLE SILVA SRL si cum iti poti gestiona preferintele.',
                                'Diese Seite erklärt, welche Cookies wir auf der Website der GALLE SILVA SRL verwenden und wie Sie Ihre Einstellungen verwalten können.',
                                'This page explains which cookies we use on the GALLE SILVA SRL website and how you can manage your preferences.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce sunt cookie-urile', 'Was Cookies sind', 'What cookies are'),
                            'continut' => $t(
                                'Cookie-urile sunt fisiere mici stocate pe dispozitivul tau, care ajuta site-ul sa functioneze si sa-ti retina preferintele.',
                                'Cookies sind kleine Dateien, die auf Ihrem Gerät gespeichert werden und dem Betrieb der Website sowie der Speicherung Ihrer Einstellungen dienen.',
                                'Cookies are small files stored on your device that help the website function and remember your preferences.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Ce cookie-uri folosim', 'Welche Cookies wir verwenden', 'Which cookies we use'),
                            'continut' => $t(
                                'Folosim doar cookie-uri necesare (strict necesare) pentru functionarea site-ului — de exemplu pentru sesiune si pentru a retine optiunea ta privind cookie-urile. Acestea nu necesita consimtamant. Nu folosim in prezent cookie-uri de analiza sau de marketing si nu incarcam servicii terte de urmarire. Daca vom introduce in viitor cookie-uri de analiza sau marketing, acestea vor fi activate doar cu consimtamantul tau explicit, prin bannerul de cookie-uri.',
                                'Wir verwenden nur notwendige (unbedingt erforderliche) Cookies für den Betrieb der Website — zum Beispiel für die Sitzung und um Ihre Cookie-Auswahl zu speichern. Diese erfordern keine Einwilligung. Derzeit verwenden wir keine Analyse- oder Marketing-Cookies und laden keine Tracking-Dienste Dritter. Sollten wir künftig Analyse- oder Marketing-Cookies einführen, werden diese nur mit Ihrer ausdrücklichen Einwilligung über das Cookie-Banner aktiviert.',
                                'We use only necessary (strictly necessary) cookies for the operation of the website — for example for the session and to remember your cookie choice. These do not require consent. We currently do not use analytics or marketing cookies and we do not load third-party tracking services. If we introduce analytics or marketing cookies in the future, they will be activated only with your explicit consent, through the cookie banner.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Fonturile si continutul', 'Schriftarten und Inhalte', 'Fonts and content'),
                            'continut' => $t(
                                'Fonturile sunt gazduite local, pe propriul nostru server — nu apelam servicii externe de fonturi, deci nu se transmit date catre terti prin acestea.',
                                'Die Schriftarten werden lokal auf unserem eigenen Server gehostet — wir rufen keine externen Schriftdienste auf, sodass darüber keine Daten an Dritte übermittelt werden.',
                                'The fonts are hosted locally, on our own server — we do not call external font services, so no data is transmitted to third parties through them.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Cum iti gestionezi preferintele', 'Wie Sie Ihre Einstellungen verwalten', 'How to manage your preferences'),
                            'continut' => $t(
                                'Iti poti exprima sau retrage consimtamantul oricand din bannerul de cookie-uri sau din optiunea Setari cookies din subsolul site-ului. Poti, de asemenea, sterge sau bloca cookie-urile din setarile browser-ului; unele functii ale site-ului pot fi afectate.',
                                'Sie können Ihre Einwilligung jederzeit über das Cookie-Banner oder über die Option „Cookie-Einstellungen" im Footer der Website erteilen oder widerrufen. Sie können Cookies außerdem in den Einstellungen Ihres Browsers löschen oder blockieren; einige Funktionen der Website können dadurch beeinträchtigt werden.',
                                'You can give or withdraw your consent at any time from the cookie banner or from the Cookie settings option in the website footer. You can also delete or block cookies in your browser settings; some website functions may be affected.',
                            ),
                        ],
                    ],
                    [
                        'type' => 'sectiune_text',
                        'data' => [
                            'titlu' => $t('Modificari', 'Änderungen', 'Changes'),
                            'continut' => $t(
                                'Putem actualiza aceasta politica; versiunea curenta este cea de pe aceasta pagina.',
                                'Wir können diese Erklärung aktualisieren; die aktuelle Fassung ist die auf dieser Seite.',
                                'We may update this policy; the current version is the one on this page.',
                            ),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 120,
            ],

            /*
             * ---------- Intrebari frecvente (/intrebari-frecvente) ----------
             * Pagina SEO/GEO dedicata: titlu/meta/intro editabile aici; intrebarile
             * vin din modelul Faq (toate cele publicate, grupate pe categorie).
             */
            [
                'slug' => 'intrebari-frecvente',
                'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                'meta_title' => $t(
                    'Întrebări frecvente — lemn de foc, livrare, servicii forestiere | Galle Silva',
                    'Häufige Fragen — Brennholz, Lieferung, Forstdienstleistungen | Galle Silva',
                    'Frequently asked questions — firewood, delivery, forestry services | Galle Silva',
                ),
                'meta_description' => $t(
                    'Răspunsuri la cele mai frecvente întrebări despre lemn de foc, livrare, plată, achiziție de masă lemnoasă, exploatare forestieră și curățare de terenuri, în Prahova, Ilfov și București.',
                    'Antworten auf die häufigsten Fragen zu Brennholz, Lieferung, Zahlung, Holzankauf, Holzernte und Geländeräumung in Prahova, Ilfov und Bukarest.',
                    'Answers to the most frequently asked questions about firewood, delivery, payment, timber purchasing, timber harvesting and land clearing in Prahova, Ilfov and Bucharest.',
                ),
                'sectiuni' => [
                    [
                        'type' => 'header_pagina',
                        'data' => [
                            'titlu' => $t('Întrebări frecvente', 'Häufige Fragen', 'Frequently asked questions'),
                            'intro' => $t(
                                'Tot ce trebuie să știi despre lemnul de foc, livrare, plată și serviciile forestiere Galle Silva — în Prahova, Ilfov și București.',
                                'Alles, was Sie über Brennholz, Lieferung, Zahlung und die Forstdienstleistungen von Galle Silva wissen müssen — in Prahova, Ilfov und Bukarest.',
                                'Everything you need to know about firewood, delivery, payment and Galle Silva\'s forestry services — in Prahova, Ilfov and Bucharest.',
                            ),
                        ],
                    ],
                ],
                'is_published' => true,
                'ordine' => 130,
            ],
        ];

        foreach ($rows as $row) {
            Pagina::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
