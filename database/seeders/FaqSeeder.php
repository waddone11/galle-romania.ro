<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'intrebare' => ['ro' => 'Cat lemn de foc imi trebuie pentru o iarna?', 'de' => null, 'en' => null],
                'raspuns' => ['ro' => 'Pentru o casa standard de 100 m² cu termoizolatie buna, calculam aproximativ 5-7 metri steri de stejar uscat. Apartamentele de bloc sau casele bine izolate consuma 3-5 steri. Putem ajusta in functie de zona ta climatica si tipul de soba/cazan.', 'de' => null, 'en' => null],
                'categorie' => 'lemn_de_foc',
                'ordine' => 10,
                'is_published' => true,
            ],
            [
                'intrebare' => ['ro' => 'Cum se masoara un metru ster?', 'de' => null, 'en' => null],
                'raspuns' => ['ro' => 'Un metru ster este un volum aparent de 1m³ de lemne taiate si stivuite, cu spatii intre bucati. Lemnul propriu-zis ocupa aprox. 0.6-0.7 m³ — restul sunt golurile dintre bucati. Cantitatea de lemn efectiv depinde de uniformitatea taierii si stivuirea.', 'de' => null, 'en' => null],
                'categorie' => 'lemn_de_foc',
                'ordine' => 20,
                'is_published' => true,
            ],
            [
                'intrebare' => ['ro' => 'Cand livrati?', 'de' => null, 'en' => null],
                'raspuns' => ['ro' => 'In zonele Prahova, Ilfov si Bucuresti livram in 2-5 zile lucratoare de la confirmarea comenzii. In sezonul rece (octombrie - decembrie) timpii pot creste cu 1-2 zile din cauza volumelor mari de comenzi.', 'de' => null, 'en' => null],
                'categorie' => 'livrare',
                'ordine' => 30,
                'is_published' => true,
            ],
            [
                'intrebare' => ['ro' => 'Pot plati la livrare?', 'de' => null, 'en' => null],
                'raspuns' => ['ro' => 'Da. Acceptam plata la livrare (cash) sau in avans (ordin de plata, factura fiscala). Pentru institutii si companii emitem factura cu plata la termen.', 'de' => null, 'en' => null],
                'categorie' => 'plata',
                'ordine' => 40,
                'is_published' => true,
            ],
            [
                'intrebare' => ['ro' => 'Pot ridica lemnele direct de la padure?', 'de' => null, 'en' => null],
                'raspuns' => ['ro' => 'Da, oferim si serviciu de ridicare la padure / platforma primara, la un pret redus fata de livrarea la domiciliu. Necesar: mijloc propriu de transport si echipament minim.', 'de' => null, 'en' => null],
                'categorie' => 'livrare',
                'ordine' => 50,
                'is_published' => true,
            ],
            [
                'intrebare' => ['ro' => 'Aveti certificate FSC / PEFC?', 'de' => null, 'en' => null],
                'raspuns' => ['ro' => 'Suntem in proces de certificare FSC si PEFC. Galle GmbH, partenerul nostru german, are certificate ISO 9001, ISO 14001, RAL si DEKRA. Pe pagina /certificari gasiti detalii actualizate.', 'de' => null, 'en' => null],
                'categorie' => 'servicii',
                'ordine' => 60,
                'is_published' => true,
            ],
        ];

        foreach ($rows as $row) {
            Faq::updateOrCreate(
                ['intrebare->ro' => $row['intrebare']['ro']],
                $row
            );
        }
    }
}
