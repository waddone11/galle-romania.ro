<?php

namespace Database\Seeders;

use App\Models\Localitate;
use Illuminate\Database\Seeder;

class LocalitateSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * Landing-uri locale /lemn-de-foc/{slug}.
         * Intro-ul (translatable) apare sub H1 — o fraza despre zona, ca sa
         * evitam continutul subtire. RO + DE (adresare „Sie") + EN.
         */
        $rows = [
            [
                'nume' => 'Ploiești',
                'slug' => 'ploiesti',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'Livrăm lemn de foc tăiat și crăpat în Ploiești și în cartierele limitrofe — suntem la mai puțin de o oră de oraș, așa că majoritatea comenzilor ajung în 1–3 zile.',
                    'de' => 'Wir liefern gesägtes und gespaltenes Brennholz nach Ploiești und in die umliegenden Viertel — wir sind weniger als eine Stunde von der Stadt entfernt, sodass die meisten Bestellungen in 1–3 Tagen ankommen.',
                    'en' => 'We deliver cut and split firewood in Ploiești and the surrounding neighbourhoods — we are less than an hour from the city, so most orders arrive within 1–3 days.',
                ],
                'ordine' => 10,
            ],
            [
                'nume' => 'Câmpina',
                'slug' => 'campina',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'În Câmpina și împrejurimi, unde iernile pe Valea Prahovei se simt serios, livrăm stejar și carpen tăiat și crăpat, gata de pus pe foc.',
                    'de' => 'In Câmpina und Umgebung, wo die Winter im Prahova-Tal streng sind, liefern wir Eiche und Hainbuche — gesägt, gespalten und bereit für den Ofen.',
                    'en' => 'In Câmpina and the surrounding area, where winters in the Prahova Valley get serious, we deliver oak and hornbeam, cut and split, ready for the fire.',
                ],
                'ordine' => 20,
            ],
            [
                'nume' => 'Valea Doftanei',
                'slug' => 'valea-doftanei',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'Valea Doftanei e zona în care lucrăm cel mai des în pădure — de aici livrăm lemn de foc de esență tare direct din platforma primară, la prețuri avantajoase.',
                    'de' => 'Valea Doftanei ist das Gebiet, in dem wir am häufigsten im Wald arbeiten — von hier liefern wir Hartholz-Brennholz direkt vom Polter an der Forststraße, zu günstigen Preisen.',
                    'en' => 'Valea Doftanei is where we work in the forest most often — from here we deliver hardwood firewood straight from the roadside landing, at advantageous prices.',
                ],
                'ordine' => 30,
            ],
            [
                'nume' => 'Breaza',
                'slug' => 'breaza',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'Livrăm lemn de foc în Breaza și pe dealurile din jur — stejar și carpen cu ardere lungă, potrivite pentru casele de vacanță și gospodăriile de aici.',
                    'de' => 'Wir liefern Brennholz nach Breaza und auf die umliegenden Hügel — Eiche und Hainbuche mit langer Brenndauer, ideal für die Ferienhäuser und Haushalte der Gegend.',
                    'en' => 'We deliver firewood in Breaza and the surrounding hills — slow-burning oak and hornbeam, well suited to the holiday homes and households here.',
                ],
                'ordine' => 40,
            ],
            [
                'nume' => 'Comarnic',
                'slug' => 'comarnic',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'În Comarnic, la poalele munților, sezonul de foc e lung — livrăm lemn de esență tare, tăiat și crăpat la dimensiunea sobei tale.',
                    'de' => 'In Comarnic, am Fuß der Berge, ist die Heizsaison lang — wir liefern Hartholz, gesägt und gespalten auf das Maß Ihres Ofens.',
                    'en' => 'In Comarnic, at the foot of the mountains, the heating season is long — we deliver hardwood, cut and split to the size of your stove.',
                ],
                'ordine' => 50,
            ],
            [
                'nume' => 'Băicoi',
                'slug' => 'baicoi',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'Livrăm lemn de foc în Băicoi și în satele aparținătoare — comenzi fără cantitate minimă, cu plata la livrare.',
                    'de' => 'Wir liefern Brennholz nach Băicoi und in die zugehörigen Dörfer — Bestellungen ohne Mindestmenge, Zahlung bei Lieferung.',
                    'en' => 'We deliver firewood in Băicoi and its villages — no minimum order, payment on delivery.',
                ],
                'ordine' => 60,
            ],
            [
                'nume' => 'Blejoi',
                'slug' => 'blejoi',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'Blejoi e la doi pași de depozitul nostru — aici livrăm cel mai rapid, de regulă în 1–2 zile de la confirmare.',
                    'de' => 'Blejoi liegt nur einen Katzensprung von unserem Lager entfernt — hier liefern wir am schnellsten, in der Regel innerhalb von 1–2 Tagen nach Bestätigung.',
                    'en' => "Blejoi is a stone's throw from our depot — this is where we deliver fastest, usually within 1–2 days of confirmation.",
                ],
                'ordine' => 70,
            ],
            [
                'nume' => 'Berceni',
                'slug' => 'berceni',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'În comuna Berceni și satele din jur livrăm lemn de foc tăiat și crăpat, cu autospeciala noastră — inclusiv pe ulițe mai înguste.',
                    'de' => 'In der Gemeinde Berceni und den umliegenden Dörfern liefern wir gesägtes und gespaltenes Brennholz mit unserem eigenen LKW — auch in engere Gassen.',
                    'en' => 'In Berceni commune and the nearby villages we deliver cut and split firewood with our own truck — including down narrower lanes.',
                ],
                'ordine' => 80,
            ],
            [
                'nume' => 'Păulești',
                'slug' => 'paulesti',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'Livrăm lemn de foc în Păulești, Găgeni și împrejurimi — zonă rezidențială în plină creștere, unde ducem frecvent comenzi pentru case noi cu șemineu.',
                    'de' => 'Wir liefern Brennholz nach Păulești, Găgeni und Umgebung — ein wachsendes Wohngebiet, in das wir häufig Bestellungen für neue Häuser mit Kamin bringen.',
                    'en' => 'We deliver firewood in Păulești, Găgeni and the surrounding area — a fast-growing residential zone where we often deliver to new houses with fireplaces.',
                ],
                'ordine' => 90,
            ],
            [
                'nume' => 'Boldești-Scăeni',
                'slug' => 'boldesti-scaeni',
                'judet' => 'Prahova',
                'intro' => [
                    'ro' => 'În Boldești-Scăeni și pe dealurile cu vii din jur livrăm stejar și carpen de esență tare, cu plata la livrare — cash, POS sau transfer.',
                    'de' => 'In Boldești-Scăeni und auf den umliegenden Weinbergen liefern wir Eiche und Hainbuche — Hartholz mit Zahlung bei Lieferung: bar, Karte (POS) oder Überweisung.',
                    'en' => 'In Boldești-Scăeni and the vine-covered hills around it we deliver oak and hornbeam hardwood, with payment on delivery — cash, card (POS) or bank transfer.',
                ],
                'ordine' => 100,
            ],
            [
                'nume' => 'București',
                'slug' => 'bucuresti',
                'judet' => 'București',
                'intro' => [
                    'ro' => 'Livrăm lemn de foc în toate sectoarele Bucureștiului — pentru case, vile și restaurante cu cuptor pe lemne. Programăm livrarea la ora care îți convine.',
                    'de' => 'Wir liefern Brennholz in alle Sektoren Bukarests — für Häuser, Villen und Restaurants mit Holzofen. Die Lieferung planen wir zu der Uhrzeit, die Ihnen passt.',
                    'en' => "We deliver firewood across all of Bucharest's sectors — for houses, villas and restaurants with wood-fired ovens. We schedule the delivery at a time that suits you.",
                ],
                'ordine' => 110,
            ],
            [
                'nume' => 'Ilfov',
                'slug' => 'ilfov',
                'judet' => 'Ilfov',
                'intro' => [
                    'ro' => 'Acoperim tot județul Ilfov — Otopeni, Voluntari, Buftea, Bragadiru, Popești-Leordeni și restul localităților — cu lemn de foc tăiat și crăpat, livrat în 1–3 zile.',
                    'de' => 'Wir decken den gesamten Kreis Ilfov ab — Otopeni, Voluntari, Buftea, Bragadiru, Popești-Leordeni und alle übrigen Orte — mit gesägtem und gespaltenem Brennholz, geliefert in 1–3 Tagen.',
                    'en' => 'We cover the whole of Ilfov county — Otopeni, Voluntari, Buftea, Bragadiru, Popești-Leordeni and the rest — with cut and split firewood, delivered in 1–3 days.',
                ],
                'ordine' => 120,
            ],
        ];

        foreach ($rows as $row) {
            Localitate::updateOrCreate(['slug' => $row['slug']], [...$row, 'is_active' => true]);
        }
    }
}
