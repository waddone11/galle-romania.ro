<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Helper pentru campuri traductibile: RO completat, DE/EN raman null.
        $t = fn (string $ro): array => ['ro' => $ro, 'de' => null, 'en' => null];

        $rows = [
            /*
             * ---------- Lemn de foc (randate pe /lemn-de-foc + landing-uri locale) ----------
             */
            [
                'intrebare' => $t('Cât costă un metru cub de lemn de foc?'),
                'raspuns' => $t('De la 350 lei/m³; prețul final depinde de esență, cantitate și modul de livrare.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t('Care e mai bun: fag, stejar sau carpen?'),
                'raspuns' => $t('Toate trei sunt esențe tari, cu ardere lungă; carpenul și stejarul au putere calorică foarte bună.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t('Care e diferența dintre metru ster și metru cub?'),
                'raspuns' => $t('Metrul cub e lemn plin; sterul e lemn stivuit, cu spații (aprox. 0,6–0,65 m³ lemn plin la un ster).'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t('Livrați în București și Ilfov?'),
                'raspuns' => $t('Da, plus Prahova; oferim și livrare la domiciliu.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t('Există cantitate minimă?'),
                'raspuns' => $t('Nu.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 50,
            ],
            [
                'intrebare' => $t('Primesc factură și acte?'),
                'raspuns' => $t('Da.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 60,
            ],
            [
                'intrebare' => $t('Cât lemn de foc îmi trebuie pentru o iarnă?'),
                'raspuns' => $t('Pentru o casă standard de 100 m² cu termoizolație bună, calculăm aproximativ 5–7 metri steri de esență tare. Apartamentele sau casele bine izolate consumă 3–5 steri. Putem ajusta în funcție de zona ta climatică și tipul de sobă/cazan.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 70,
            ],

            /*
             * ---------- Livrare / plata ----------
             */
            [
                'intrebare' => $t('Când livrați?'),
                'raspuns' => $t('De regulă în 1–3 zile de la confirmare, în funcție de zonă — maximum 7 zile în perioadele aglomerate (octombrie–decembrie).'),
                'categorie' => 'livrare',
                'ordine' => 100,
            ],
            [
                'intrebare' => $t('Pot ridica lemnele direct de la pădure?'),
                'raspuns' => $t('Da, oferim și ridicare din platforma primară, la un preț redus față de livrarea la domiciliu. Necesar: mijloc propriu de transport.'),
                'categorie' => 'livrare',
                'ordine' => 110,
            ],
            [
                'intrebare' => $t('Pot plăti la livrare?'),
                'raspuns' => $t('Da. Plata la livrare — cash sau POS — ori prin transfer bancar. Pentru instituții și companii emitem factură cu plată la termen.'),
                'categorie' => 'plata',
                'ordine' => 120,
            ],

            /*
             * ---------- Servicii (generale) ----------
             */
            [
                'intrebare' => $t('Aveți certificate FSC / PEFC?'),
                'raspuns' => $t('Suntem în proces de certificare FSC și PEFC. Galle GmbH, grupul nostru din Germania, are certificările ISO 9001, ISO 14001, RAL și DEKRA. Pe pagina /certificari găsiți detalii actualizate.'),
                'categorie' => 'servicii',
                'ordine' => 130,
            ],

            /*
             * ---------- Exploatare forestiera (/servicii/exploatare-forestiera) ----------
             */
            [
                'intrebare' => $t('Ce acte sunt necesare pentru exploatarea unei păduri private?'),
                'raspuns' => $t('Pe scurt: un APV (act de punere în valoare) și autorizația de exploatare, prin ocolul silvic care administrează pădurea. Te ghidăm prin tot procesul.'),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t('Ce înseamnă exploatare cu harvester?'),
                'raspuns' => $t('Recoltare mecanizată: utilajul doboară, curăță de crengi și secționează arborele, rapid și cu impact redus asupra solului.'),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t('Se poate exploata fără APV?'),
                'raspuns' => $t('Nu. Recoltarea legală se face doar pe baza APV și a autorizației de exploatare.'),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t('Cât durează exploatarea unei partizi?'),
                'raspuns' => $t('Depinde de volum și teren; cu utilaje mecanizate, semnificativ mai repede decât manual. Îți dăm un termen după evaluare.'),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t('Faceți și transportul după exploatare?'),
                'raspuns' => $t('Da, avem autospeciale proprii pentru transport.'),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 50,
            ],

            /*
             * ---------- Achizitie masa lemnoasa (/servicii/achizitie-masa-lemnoasa) ----------
             */
            [
                'intrebare' => $t('Vreau să vând pădure. De unde încep?'),
                'raspuns' => $t('Ne contactezi, venim la evaluare și îți facem o ofertă. Ne ocupăm de partea tehnică.'),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t('Ce înseamnă masă lemnoasă pe picior?'),
                'raspuns' => $t('Lemnul aflat încă în pădure, nerecoltat, evaluat într-o partidă/APV.'),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t('Cumpărați și lemn deja fasonat?'),
                'raspuns' => $t('Da, atât pe picior, cât și fasonat (din platformă sau depozit).'),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t('Cum se stabilește prețul?'),
                'raspuns' => $t('După specie, volum, calitate și accesibilitate, în urma evaluării la fața locului.'),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t('Am nevoie de APV?'),
                'raspuns' => $t('Pentru recoltare, da; te ajutăm cu pașii și documentele.'),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 50,
            ],

            /*
             * ---------- Curatare terenuri (/servicii/curatare-terenuri) ----------
             */
            [
                'intrebare' => $t('Cât costă curățarea unui teren?'),
                'raspuns' => $t('Depinde de suprafață, densitatea vegetației și acces; cere o ofertă cu poze/video din teren.'),
                'categorie' => 'curatare-terenuri',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t('Scoateți și cioatele?'),
                'raspuns' => $t('Da, scoatem și/sau frezăm cioatele.'),
                'categorie' => 'curatare-terenuri',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t('Lucrați în București și Ilfov?'),
                'raspuns' => $t('Da, plus Prahova.'),
                'categorie' => 'curatare-terenuri',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t('Am nevoie de autorizație pentru tăierea copacilor?'),
                'raspuns' => $t('Pentru terenuri neforestiere, de regulă nu; pentru fond forestier, da. Îți spunem clar pentru situația ta.'),
                'categorie' => 'curatare-terenuri',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t('Luați și resturile vegetale?'),
                'raspuns' => $t('Da, putem prelua și toca/transporta resturile.'),
                'categorie' => 'curatare-terenuri',
                'ordine' => 50,
            ],

            /*
             * ---------- Transport lemn (/servicii/transport-lemn) ----------
             */
            [
                'intrebare' => $t('Transportați bușteni sau doar lemn de foc?'),
                'raspuns' => $t('Ambele, plus lemn fasonat.'),
                'categorie' => 'transport-lemn',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t('Aveți camion cu macara?'),
                'raspuns' => $t('Da.'),
                'categorie' => 'transport-lemn',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t('Ce acte însoțesc transportul?'),
                'raspuns' => $t('Documente de însoțire conform legislației și sistemului SUMAL.'),
                'categorie' => 'transport-lemn',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t('Cât costă transportul?'),
                'raspuns' => $t('După distanță și volum; detalii la telefon.'),
                'categorie' => 'transport-lemn',
                'ordine' => 40,
            ],

            /*
             * ---------- Lucrari silvice (/servicii/lucrari-silvice) ----------
             */
            [
                'intrebare' => $t('Ce sunt răriturile?'),
                'raspuns' => $t('Lucrări prin care se extrag o parte din arbori, ca să crească sănătos arboretul rămas.'),
                'categorie' => 'lucrari-silvice',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t('Ce sunt curățirile?'),
                'raspuns' => $t('Intervenții de îngrijire în arboretele tinere.'),
                'categorie' => 'lucrari-silvice',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t('Cine decide ce arbori se taie?'),
                'raspuns' => $t('Se stabilește prin amenajament și marcaj, împreună cu ocolul silvic.'),
                'categorie' => 'lucrari-silvice',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t('Se poate face fără ocol silvic?'),
                'raspuns' => $t('Lucrările în fond forestier se fac cu servicii silvice asigurate; te ghidăm.'),
                'categorie' => 'lucrari-silvice',
                'ordine' => 40,
            ],
        ];

        foreach ($rows as $row) {
            Faq::updateOrCreate(
                ['intrebare->ro' => $row['intrebare']['ro']],
                [...$row, 'is_published' => true]
            );
        }
    }
}
