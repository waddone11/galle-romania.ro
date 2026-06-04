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
         * evitam continutul subtire. DE/EN raman null (le completeaza owner-ul).
         */
        $rows = [
            [
                'nume' => 'Ploiești',
                'slug' => 'ploiesti',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'Livrăm lemn de foc tăiat și crăpat în Ploiești și în cartierele limitrofe — suntem la mai puțin de o oră de oraș, așa că majoritatea comenzilor ajung în 1–3 zile.', 'de' => null, 'en' => null],
                'ordine' => 10,
            ],
            [
                'nume' => 'Câmpina',
                'slug' => 'campina',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'În Câmpina și împrejurimi, unde iernile pe Valea Prahovei se simt serios, livrăm stejar și carpen tăiat și crăpat, gata de pus pe foc.', 'de' => null, 'en' => null],
                'ordine' => 20,
            ],
            [
                'nume' => 'Valea Doftanei',
                'slug' => 'valea-doftanei',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'Valea Doftanei e zona în care lucrăm cel mai des în pădure — de aici livrăm lemn de foc de esență tare direct din platforma primară, la prețuri avantajoase.', 'de' => null, 'en' => null],
                'ordine' => 30,
            ],
            [
                'nume' => 'Breaza',
                'slug' => 'breaza',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'Livrăm lemn de foc în Breaza și pe dealurile din jur — stejar și carpen cu ardere lungă, potrivite pentru casele de vacanță și gospodăriile de aici.', 'de' => null, 'en' => null],
                'ordine' => 40,
            ],
            [
                'nume' => 'Comarnic',
                'slug' => 'comarnic',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'În Comarnic, la poalele munților, sezonul de foc e lung — livrăm lemn de esență tare, tăiat și crăpat la dimensiunea sobei tale.', 'de' => null, 'en' => null],
                'ordine' => 50,
            ],
            [
                'nume' => 'Băicoi',
                'slug' => 'baicoi',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'Livrăm lemn de foc în Băicoi și în satele aparținătoare — comenzi fără cantitate minimă, cu plata la livrare.', 'de' => null, 'en' => null],
                'ordine' => 60,
            ],
            [
                'nume' => 'Blejoi',
                'slug' => 'blejoi',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'Blejoi e la doi pași de depozitul nostru — aici livrăm cel mai rapid, de regulă în 1–2 zile de la confirmare.', 'de' => null, 'en' => null],
                'ordine' => 70,
            ],
            [
                'nume' => 'Berceni',
                'slug' => 'berceni',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'În comuna Berceni și satele din jur livrăm lemn de foc tăiat și crăpat, cu autospeciala noastră — inclusiv pe ulițe mai înguste.', 'de' => null, 'en' => null],
                'ordine' => 80,
            ],
            [
                'nume' => 'Păulești',
                'slug' => 'paulesti',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'Livrăm lemn de foc în Păulești, Găgeni și împrejurimi — zonă rezidențială în plină creștere, unde ducem frecvent comenzi pentru case noi cu șemineu.', 'de' => null, 'en' => null],
                'ordine' => 90,
            ],
            [
                'nume' => 'Boldești-Scăeni',
                'slug' => 'boldesti-scaeni',
                'judet' => 'Prahova',
                'intro' => ['ro' => 'În Boldești-Scăeni și pe dealurile cu vii din jur livrăm stejar și carpen de esență tare, cu plata la livrare — cash, POS sau transfer.', 'de' => null, 'en' => null],
                'ordine' => 100,
            ],
            [
                'nume' => 'București',
                'slug' => 'bucuresti',
                'judet' => 'București',
                'intro' => ['ro' => 'Livrăm lemn de foc în toate sectoarele Bucureștiului — pentru case, vile și restaurante cu cuptor pe lemne. Programăm livrarea la ora care îți convine.', 'de' => null, 'en' => null],
                'ordine' => 110,
            ],
            [
                'nume' => 'Ilfov',
                'slug' => 'ilfov',
                'judet' => 'Ilfov',
                'intro' => ['ro' => 'Acoperim tot județul Ilfov — Otopeni, Voluntari, Buftea, Bragadiru, Popești-Leordeni și restul localităților — cu lemn de foc tăiat și crăpat, livrat în 1–3 zile.', 'de' => null, 'en' => null],
                'ordine' => 120,
            ],
        ];

        foreach ($rows as $row) {
            Localitate::updateOrCreate(['slug' => $row['slug']], [...$row, 'is_active' => true]);
        }
    }
}
