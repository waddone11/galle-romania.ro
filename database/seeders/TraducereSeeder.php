<?php

namespace Database\Seeders;

use App\Models\Traducere;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class TraducereSeeder extends Seeder
{
    /**
     * 1) Populeaza cheile UI scanand Blade-urile (idempotent, nu suprascrie DE/EN).
     * 2) Seteaza valorile RO cu diacritice pentru cheile ASCII din cod —
     *    cheia ramane fara diacritice (stabila in cod), textul afisat e corect.
     */
    public function run(): void
    {
        Artisan::call('traduceri:extract');

        foreach (self::DIACRITICE as $cheie => $ro) {
            $traducere = Traducere::where('cheie', $cheie)->first();

            if ($traducere) {
                $traducere->setTranslation('valoare', 'ro', $ro);
                $traducere->save();
            }
        }
    }

    /** Valori RO cu diacritice pentru cheile ASCII folosite in Blade-uri. */
    private const DIACRITICE = [
        // nav
        'Acasa' => 'Acasă',
        'Cere oferta' => 'Cere ofertă',
        'Certificari' => 'Certificări',
        // footer
        'Servicii forestiere si lemn de foc, cu grija pentru padure si mediu. Partener local Galle GmbH Germania.' => 'Servicii forestiere și lemn de foc, cu grijă pentru pădure și mediu. Partener local Galle GmbH Germania.',
        'Confidentialitate' => 'Confidențialitate',
        'Date firma' => 'Date firmă',
        'Setari cookies' => 'Setări cookies',
        // cookies
        'Consimtamant cookie-uri' => 'Consimțământ cookie-uri',
        'Folosim cookie-uri necesare pentru functionarea site-ului. Cu acordul tau, putem folosi si cookie-uri de analiza sau marketing. Vezi' => 'Folosim cookie-uri necesare pentru funcționarea site-ului. Cu acordul tău, putem folosi și cookie-uri de analiză sau marketing. Vezi',
        'si' => 'și',
        'politica de confidentialitate' => 'politica de confidențialitate',
        'Sesiune si securitate (CSRF). Nu pot fi dezactivate.' => 'Sesiune și securitate (CSRF). Nu pot fi dezactivate.',
        'Analiza' => 'Analiză',
        'Statistici anonime de utilizare, doar cu acordul tau.' => 'Statistici anonime de utilizare, doar cu acordul tău.',
        'Continut si masurare publicitara, doar cu acordul tau.' => 'Conținut și măsurare publicitară, doar cu acordul tău.',
        'Setari' => 'Setări',
        'Salveaza setarile' => 'Salvează setările',
        // forms / splitter (fara jargon: „flow-uri" -> „direcții"; serviciile reale)
        'Doua flow-uri, o singura calitate germana' => 'Două direcții, o singură calitate germană',
        'Sunt firma / institutie' => 'Sunt firmă / instituție',
        'Stejar disponibil acum. Fag si carpen — in curand. Pret in metri steri sau tone. Livrare in 2-5 zile.' => 'Stejar disponibil acum. Fag și carpen — în curând. Preț în metri steri sau tone. Livrare în 2-5 zile.',
        'Forestier, peisagistica, compostare — pentru primarii, institutii si companii. Plata la termen, factura.' => 'Exploatare forestieră, transport și curățare terenuri — pentru primării, instituții și companii. Plată la termen, factură.',
        'Sunt de acord cu prelucrarea datelor conform' => 'Sunt de acord cu prelucrarea datelor conform',
        'Politicii de confidentialitate' => 'Politicii de confidențialitate',
        // date-firma (Impressum)
        'Date firma / Impressum' => 'Date firmă / Impressum',
        'Identificarea societatii' => 'Identificarea societății',
        'Cod unic de inregistrare (CUI)' => 'Cod unic de înregistrare (CUI)',
        'Nr. Registrul Comertului' => 'Nr. Registrul Comerțului',
        'Data infiintarii' => 'Data înființării',
        'Responsabil pentru continut' => 'Responsabil pentru conținut',
        'prin reprezentantul sau legal' => 'prin reprezentantul său legal',
        'Pentru intrebari legate de protectia datelor, consultati' => 'Pentru întrebări legate de protecția datelor, consultați',
    ];
}
