<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Helper pentru campuri traductibile: RO + DE (adresare „Sie") + EN.
        $t = fn (string $ro, ?string $de = null, ?string $en = null): array => ['ro' => $ro, 'de' => $de, 'en' => $en];

        $rows = [
            /*
             * ---------- Lemn de foc (randate pe /lemn-de-foc + landing-uri locale) ----------
             */
            [
                'intrebare' => $t(
                    'Cât costă un metru cub de lemn de foc?',
                    'Was kostet ein Kubikmeter Brennholz?',
                    'How much does a cubic meter of firewood cost?',
                ),
                'raspuns' => $t(
                    'De la 350 lei/m³; prețul final depinde de esență, cantitate și modul de livrare.',
                    'Ab 350 Lei/m³; der Endpreis hängt von Holzart, Menge und Lieferweg ab.',
                    'From 350 Lei/m³; the final price depends on species, quantity and delivery method.',
                ),
                'categorie' => 'lemn_de_foc',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t(
                    'Care e mai bun: fag, stejar sau carpen?',
                    'Was ist besser: Buche, Eiche oder Hainbuche?',
                    'Which is better: beech, oak or hornbeam?',
                ),
                'raspuns' => $t(
                    'Toate trei sunt esențe tari, cu ardere lungă; carpenul și stejarul au putere calorică foarte bună.',
                    'Alle drei sind Harthölzer mit langer Brenndauer; Hainbuche und Eiche haben einen sehr guten Heizwert.',
                    'All three are slow-burning hardwoods; hornbeam and oak have a very good heating value.',
                ),
                'categorie' => 'lemn_de_foc',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t(
                    'Care e diferența dintre metru ster și metru cub?',
                    'Was ist der Unterschied zwischen Raummeter (Ster) und Festmeter?',
                    'What is the difference between a stacked cubic meter (ster) and a solid cubic meter?',
                ),
                'raspuns' => $t(
                    'Metrul cub e lemn plin; sterul e lemn stivuit, cu spații (aprox. 0,6–0,65 m³ lemn plin la un ster).',
                    'Der Festmeter ist massives Holz; der Ster ist gestapeltes Holz mit Zwischenräumen (ca. 0,6–0,65 m³ massives Holz pro Ster).',
                    'A solid cubic meter is solid wood; a ster is stacked wood with air gaps (roughly 0.6–0.65 m³ of solid wood per ster).',
                ),
                'categorie' => 'lemn_de_foc',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t(
                    'Livrați în București și Ilfov?',
                    'Liefern Sie nach Bukarest und Ilfov?',
                    'Do you deliver to Bucharest and Ilfov?',
                ),
                'raspuns' => $t(
                    'Da, plus Prahova; oferim și livrare la domiciliu.',
                    'Ja, außerdem nach Prahova; wir liefern auch frei Haus.',
                    'Yes, plus Prahova; we also offer home delivery.',
                ),
                'categorie' => 'lemn_de_foc',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t(
                    'Există cantitate minimă?',
                    'Gibt es eine Mindestmenge?',
                    'Is there a minimum order?',
                ),
                'raspuns' => $t('Nu.', 'Nein.', 'No.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 50,
            ],
            [
                'intrebare' => $t(
                    'Primesc factură și acte?',
                    'Erhalte ich eine Rechnung und die Dokumente?',
                    'Do I get an invoice and documents?',
                ),
                'raspuns' => $t('Da.', 'Ja.', 'Yes.'),
                'categorie' => 'lemn_de_foc',
                'ordine' => 60,
            ],
            [
                'intrebare' => $t(
                    'Cât lemn de foc îmi trebuie pentru o iarnă?',
                    'Wie viel Brennholz brauche ich für einen Winter?',
                    'How much firewood do I need for a winter?',
                ),
                'raspuns' => $t(
                    'Pentru o casă standard de 100 m² cu termoizolație bună, calculăm aproximativ 5–7 metri steri de esență tare. Apartamentele sau casele bine izolate consumă 3–5 steri. Putem ajusta în funcție de zona ta climatică și tipul de sobă/cazan.',
                    'Für ein Standardhaus von 100 m² mit guter Wärmedämmung rechnen wir mit etwa 5–7 Raummetern (Ster) Hartholz. Wohnungen oder gut gedämmte Häuser benötigen 3–5 Ster. Wir passen die Menge an Ihre Klimazone und Ihren Ofen- bzw. Kesseltyp an.',
                    'For a standard 100 m² house with good insulation, we estimate roughly 5–7 stacked cubic meters (sters) of hardwood. Flats or well-insulated houses use 3–5 sters. We can adjust for your climate zone and type of stove/boiler.',
                ),
                'categorie' => 'lemn_de_foc',
                'ordine' => 70,
            ],

            /*
             * ---------- Livrare / plata ----------
             */
            [
                'intrebare' => $t(
                    'Când livrați?',
                    'Wann liefern Sie?',
                    'When do you deliver?',
                ),
                'raspuns' => $t(
                    'De regulă în 1–3 zile de la confirmare, în funcție de zonă — maximum 7 zile în perioadele aglomerate (octombrie–decembrie).',
                    'In der Regel innerhalb von 1–3 Tagen nach Bestätigung, je nach Gebiet — maximal 7 Tage in der Hochsaison (Oktober–Dezember).',
                    'Usually within 1–3 days of confirmation, depending on the area — 7 days at most during the busy season (October–December).',
                ),
                'categorie' => 'livrare',
                'ordine' => 100,
            ],
            [
                'intrebare' => $t(
                    'Pot ridica lemnele direct de la pădure?',
                    'Kann ich das Holz direkt im Wald abholen?',
                    'Can I pick up the wood directly from the forest?',
                ),
                'raspuns' => $t(
                    'Da, oferim și ridicare din platforma primară, la un preț redus față de livrarea la domiciliu. Necesar: mijloc propriu de transport.',
                    'Ja, wir bieten auch die Abholung am Polter an der Forststraße an — günstiger als die Lieferung frei Haus. Voraussetzung: eigenes Transportmittel.',
                    'Yes, we also offer pickup from the roadside landing, at a lower price than home delivery. You will need your own transport.',
                ),
                'categorie' => 'livrare',
                'ordine' => 110,
            ],
            [
                'intrebare' => $t(
                    'Pot plăti la livrare?',
                    'Kann ich bei Lieferung bezahlen?',
                    'Can I pay on delivery?',
                ),
                'raspuns' => $t(
                    'Da. Plata la livrare — cash sau POS — ori prin transfer bancar. Pentru instituții și companii emitem factură cu plată la termen.',
                    'Ja. Zahlung bei Lieferung — bar oder per Karte (POS) — oder per Überweisung. Für Institutionen und Unternehmen stellen wir Rechnungen mit Zahlungsziel aus.',
                    'Yes. Payment on delivery — cash or card (POS) — or by bank transfer. For institutions and companies we issue invoices with payment terms.',
                ),
                'categorie' => 'plata',
                'ordine' => 120,
            ],

            /*
             * ---------- Servicii (generale) ----------
             */
            [
                'intrebare' => $t(
                    'Aveți certificate FSC / PEFC?',
                    'Haben Sie FSC- / PEFC-Zertifikate?',
                    'Do you have FSC / PEFC certificates?',
                ),
                'raspuns' => $t(
                    'Suntem în proces de certificare FSC și PEFC. Galle GmbH, grupul nostru din Germania, are certificările ISO 9001, ISO 14001, RAL și DEKRA. Pe pagina /certificari găsiți detalii actualizate.',
                    'Die FSC- und PEFC-Zertifizierung läuft derzeit. Die Galle GmbH, unsere Muttergesellschaft in Deutschland, hält die Zertifizierungen ISO 9001, ISO 14001, RAL und DEKRA. Aktuelle Details finden Sie auf der Seite /certificari.',
                    'FSC and PEFC certification is in progress. Galle GmbH, our group in Germany, holds ISO 9001, ISO 14001, RAL and DEKRA certifications. You will find up-to-date details on the /certificari page.',
                ),
                'categorie' => 'servicii',
                'ordine' => 130,
            ],

            /*
             * ---------- Exploatare forestiera (/servicii/exploatare-forestiera) ----------
             */
            [
                'intrebare' => $t(
                    'Ce acte sunt necesare pentru exploatarea unei păduri private?',
                    'Welche Dokumente sind für die Holzernte in einem Privatwald erforderlich?',
                    'What documents are needed to harvest a private forest?',
                ),
                'raspuns' => $t(
                    'Pe scurt: un APV (act de punere în valoare) și autorizația de exploatare, prin ocolul silvic care administrează pădurea. Te ghidăm prin tot procesul.',
                    'Kurz gesagt: ein APV (das amtliche Dokument zur Holzaufnahme und -bewertung) und die Erntegenehmigung, ausgestellt über das zuständige Forstamt. Wir begleiten Sie durch den gesamten Prozess.',
                    'In short: an APV (the official harvesting valuation document) and the harvesting permit, issued through the forest district office managing the forest. We guide you through the whole process.',
                ),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t(
                    'Ce înseamnă exploatare cu harvester?',
                    'Was bedeutet Holzernte mit dem Harvester?',
                    'What does harvester-based logging mean?',
                ),
                'raspuns' => $t(
                    'Recoltare mecanizată: utilajul doboară, curăță de crengi și secționează arborele, rapid și cu impact redus asupra solului.',
                    'Mechanisierte Ernte: Die Maschine fällt, entastet und schneidet den Baum ein — schnell und bodenschonend.',
                    'Mechanised harvesting: the machine fells, delimbs and cuts the tree to length, quickly and with minimal soil impact.',
                ),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t(
                    'Se poate exploata fără APV?',
                    'Ist eine Ernte ohne APV möglich?',
                    'Can harvesting be done without an APV?',
                ),
                'raspuns' => $t(
                    'Nu. Recoltarea legală se face doar pe baza APV și a autorizației de exploatare.',
                    'Nein. Eine legale Ernte erfolgt ausschließlich auf Grundlage des APV und der Erntegenehmigung.',
                    'No. Legal harvesting is only possible based on the APV and the harvesting permit.',
                ),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t(
                    'Cât durează exploatarea unei partizi?',
                    'Wie lange dauert die Ernte eines Loses?',
                    'How long does harvesting a lot take?',
                ),
                'raspuns' => $t(
                    'Depinde de volum și teren; cu utilaje mecanizate, semnificativ mai repede decât manual. Îți dăm un termen după evaluare.',
                    'Das hängt von Volumen und Gelände ab; mit Maschinen deutlich schneller als motormanuell. Nach der Bewertung nennen wir Ihnen einen Termin.',
                    'It depends on volume and terrain; with mechanised equipment, significantly faster than by hand. We give you a timeline after the assessment.',
                ),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t(
                    'Faceți și transportul după exploatare?',
                    'Übernehmen Sie auch den Transport nach der Ernte?',
                    'Do you also handle transport after harvesting?',
                ),
                'raspuns' => $t(
                    'Da, avem autospeciale proprii pentru transport.',
                    'Ja, wir verfügen über eigene Transport-LKW.',
                    'Yes, we have our own trucks for transport.',
                ),
                'categorie' => 'exploatare-forestiera',
                'ordine' => 50,
            ],

            /*
             * ---------- Achizitie masa lemnoasa (/servicii/achizitie-masa-lemnoasa) ----------
             */
            [
                'intrebare' => $t(
                    'Vreau să vând pădure. De unde încep?',
                    'Ich möchte Wald verkaufen. Wo fange ich an?',
                    'I want to sell my forest. Where do I start?',
                ),
                'raspuns' => $t(
                    'Ne contactezi, venim la evaluare și îți facem o ofertă. Ne ocupăm de partea tehnică.',
                    'Kontaktieren Sie uns — wir kommen zur Bewertung und machen Ihnen ein Angebot. Um die technische Seite kümmern wir uns.',
                    'Contact us — we come out for an assessment and make you an offer. We handle the technical side.',
                ),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t(
                    'Ce înseamnă masă lemnoasă pe picior?',
                    'Was bedeutet stehendes Holz?',
                    'What does standing timber mean?',
                ),
                'raspuns' => $t(
                    'Lemnul aflat încă în pădure, nerecoltat, evaluat într-o partidă/APV.',
                    'Holz, das noch im Wald steht, nicht geerntet, erfasst und bewertet in einem Los/APV.',
                    'Timber still in the forest, unharvested, inventoried and valued in a lot/APV.',
                ),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t(
                    'Cumpărați și lemn deja fasonat?',
                    'Kaufen Sie auch bereits aufgearbeitetes Holz?',
                    'Do you also buy already-processed timber?',
                ),
                'raspuns' => $t(
                    'Da, atât pe picior, cât și fasonat (din platformă sau depozit).',
                    'Ja, sowohl stehendes als auch aufgearbeitetes Holz (vom Polter oder aus dem Lager).',
                    'Yes, both standing and processed timber (from the roadside landing or the depot).',
                ),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t(
                    'Cum se stabilește prețul?',
                    'Wie wird der Preis festgelegt?',
                    'How is the price set?',
                ),
                'raspuns' => $t(
                    'După specie, volum, calitate și accesibilitate, în urma evaluării la fața locului.',
                    'Nach Baumart, Volumen, Qualität und Zugänglichkeit — auf Grundlage der Bewertung vor Ort.',
                    'Based on species, volume, quality and accessibility, following the on-site assessment.',
                ),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t(
                    'Am nevoie de APV?',
                    'Benötige ich ein APV?',
                    'Do I need an APV?',
                ),
                'raspuns' => $t(
                    'Pentru recoltare, da; te ajutăm cu pașii și documentele.',
                    'Für die Ernte ja; wir helfen Ihnen mit den Schritten und den Dokumenten.',
                    'For harvesting, yes; we help you with the steps and the paperwork.',
                ),
                'categorie' => 'achizitie-masa-lemnoasa',
                'ordine' => 50,
            ],

            /*
             * ---------- Curatare terenuri (/servicii/curatare-terenuri) ----------
             */
            [
                'intrebare' => $t(
                    'Cât costă curățarea unui teren?',
                    'Was kostet die Räumung eines Grundstücks?',
                    'How much does clearing a plot cost?',
                ),
                'raspuns' => $t(
                    'Depinde de suprafață, densitatea vegetației și acces; cere o ofertă cu poze/video din teren.',
                    'Das hängt von Fläche, Vegetationsdichte und Zugänglichkeit ab; fordern Sie ein Angebot mit Fotos/Video vom Grundstück an.',
                    'It depends on the area, vegetation density and access; request a quote with photos/video of the site.',
                ),
                'categorie' => 'curatare-terenuri',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t(
                    'Scoateți și cioatele?',
                    'Entfernen Sie auch die Baumstümpfe?',
                    'Do you also remove the stumps?',
                ),
                'raspuns' => $t(
                    'Da, scoatem și/sau frezăm cioatele.',
                    'Ja, wir roden und/oder fräsen die Baumstümpfe.',
                    'Yes, we remove and/or grind the stumps.',
                ),
                'categorie' => 'curatare-terenuri',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t(
                    'Lucrați în București și Ilfov?',
                    'Arbeiten Sie in Bukarest und Ilfov?',
                    'Do you work in Bucharest and Ilfov?',
                ),
                'raspuns' => $t(
                    'Da, plus Prahova.',
                    'Ja, außerdem in Prahova.',
                    'Yes, plus Prahova.',
                ),
                'categorie' => 'curatare-terenuri',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t(
                    'Am nevoie de autorizație pentru tăierea copacilor?',
                    'Benötige ich eine Genehmigung zum Fällen der Bäume?',
                    'Do I need a permit to cut the trees?',
                ),
                'raspuns' => $t(
                    'Pentru terenuri neforestiere, de regulă nu; pentru fond forestier, da. Îți spunem clar pentru situația ta.',
                    'Für Nicht-Waldgrundstücke in der Regel nicht; für den Waldfonds ja. Wir sagen Ihnen klar, was für Ihre Situation gilt.',
                    'For non-forest land, usually not; for registered forest land, yes. We tell you clearly what applies to your situation.',
                ),
                'categorie' => 'curatare-terenuri',
                'ordine' => 40,
            ],
            [
                'intrebare' => $t(
                    'Luați și resturile vegetale?',
                    'Nehmen Sie auch die Grünabfälle mit?',
                    'Do you take the green waste as well?',
                ),
                'raspuns' => $t(
                    'Da, putem prelua și toca/transporta resturile.',
                    'Ja, wir können die Reste übernehmen, häckseln und abtransportieren.',
                    'Yes, we can collect, chip and haul away the residues.',
                ),
                'categorie' => 'curatare-terenuri',
                'ordine' => 50,
            ],

            /*
             * ---------- Transport lemn (/servicii/transport-lemn) ----------
             */
            [
                'intrebare' => $t(
                    'Transportați bușteni sau doar lemn de foc?',
                    'Transportieren Sie Rundholz oder nur Brennholz?',
                    'Do you transport logs or only firewood?',
                ),
                'raspuns' => $t(
                    'Ambele, plus lemn fasonat.',
                    'Beides, dazu aufgearbeitetes Holz.',
                    'Both, plus processed timber.',
                ),
                'categorie' => 'transport-lemn',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t(
                    'Aveți camion cu macara?',
                    'Haben Sie einen LKW mit Ladekran?',
                    'Do you have a crane truck?',
                ),
                'raspuns' => $t('Da.', 'Ja.', 'Yes.'),
                'categorie' => 'transport-lemn',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t(
                    'Ce acte însoțesc transportul?',
                    'Welche Dokumente begleiten den Transport?',
                    'What documents accompany the transport?',
                ),
                'raspuns' => $t(
                    'Documente de însoțire conform legislației și sistemului SUMAL.',
                    'Begleitpapiere gemäß Gesetz und SUMAL (das rumänische Holz-Rückverfolgbarkeitssystem).',
                    "Transport documents as required by law and by SUMAL (Romania's timber traceability system).",
                ),
                'categorie' => 'transport-lemn',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t(
                    'Cât costă transportul?',
                    'Was kostet der Transport?',
                    'How much does transport cost?',
                ),
                'raspuns' => $t(
                    'După distanță și volum; detalii la telefon.',
                    'Je nach Entfernung und Volumen; Details am Telefon.',
                    'Based on distance and volume; details over the phone.',
                ),
                'categorie' => 'transport-lemn',
                'ordine' => 40,
            ],

            /*
             * ---------- Lucrari silvice (/servicii/lucrari-silvice) ----------
             */
            [
                'intrebare' => $t(
                    'Ce sunt răriturile?',
                    'Was sind Durchforstungen?',
                    'What is thinning?',
                ),
                'raspuns' => $t(
                    'Lucrări prin care se extrag o parte din arbori, ca să crească sănătos arboretul rămas.',
                    'Eingriffe, bei denen ein Teil der Bäume entnommen wird, damit der verbleibende Bestand gesund wachsen kann.',
                    'Works that remove a share of the trees so the remaining stand can grow healthily.',
                ),
                'categorie' => 'lucrari-silvice',
                'ordine' => 10,
            ],
            [
                'intrebare' => $t(
                    'Ce sunt curățirile?',
                    'Was sind Läuterungen?',
                    'What is cleaning?',
                ),
                'raspuns' => $t(
                    'Intervenții de îngrijire în arboretele tinere.',
                    'Pflegeeingriffe in jungen Beständen.',
                    'Tending interventions in young stands.',
                ),
                'categorie' => 'lucrari-silvice',
                'ordine' => 20,
            ],
            [
                'intrebare' => $t(
                    'Cine decide ce arbori se taie?',
                    'Wer entscheidet, welche Bäume gefällt werden?',
                    'Who decides which trees are cut?',
                ),
                'raspuns' => $t(
                    'Se stabilește prin amenajament și marcaj, împreună cu ocolul silvic.',
                    'Das wird durch die Forsteinrichtung und die amtliche Markierung festgelegt, gemeinsam mit dem Forstamt.',
                    'It is set by the forest management plan and the official marking, together with the forest district office.',
                ),
                'categorie' => 'lucrari-silvice',
                'ordine' => 30,
            ],
            [
                'intrebare' => $t(
                    'Se poate face fără ocol silvic?',
                    'Geht es auch ohne Forstamt?',
                    'Can it be done without the forest district office?',
                ),
                'raspuns' => $t(
                    'Lucrările în fond forestier se fac cu servicii silvice asigurate; te ghidăm.',
                    'Arbeiten im Waldfonds erfolgen nur mit gesicherten Forstdienstleistungen; wir begleiten Sie.',
                    'Works on forest land require contracted forestry services; we guide you.',
                ),
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
