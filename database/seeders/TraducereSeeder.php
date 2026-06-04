<?php

namespace Database\Seeders;

use App\Models\Traducere;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class TraducereSeeder extends Seeder
{
    /**
     * 1) Populeaza cheile UI scanand Blade-urile (idempotent, nu suprascrie DE/EN).
     * 2) Seteaza valorile RO cu diacritice + traducerile DE/EN pentru cheile din cod —
     *    cheia ramane ASCII (stabila in cod), textul afisat e corect in toate limbile.
     *    RO se rescrie mereu (sursa de adevar e seederul); DE/EN se completeaza doar
     *    daca sunt goale, ca sa nu piarda editarile manuale din /admin.
     */
    public function run(): void
    {
        Artisan::call('traduceri:extract');

        foreach (self::valori() as $cheie => $valori) {
            // Cheile dinamice (ex. label-uri de enum afisate cu __($enum->label()))
            // nu sunt gasite de traduceri:extract — le cream aici.
            $traducere = Traducere::firstOrCreate(
                ['cheie' => $cheie],
                ['grup' => 'general', 'valoare' => ['ro' => $cheie, 'de' => null, 'en' => null]],
            );

            if (isset($valori['ro'])) {
                $traducere->setTranslation('valoare', 'ro', $valori['ro']);
            }

            foreach (['de', 'en'] as $loc) {
                // Cheile noi pot avea doar RO — DE/EN raman null (de completat din /admin).
                if (isset($valori[$loc]) && blank($traducere->getTranslation('valoare', $loc, false))) {
                    $traducere->setTranslation('valoare', $loc, $valori[$loc]);
                }
            }

            $traducere->save();
        }
    }

    /**
     * Valorile RO (cu diacritice, unde difera de cheia ASCII) + DE/EN pentru
     * toate cheile UI folosite in Blade-uri. DE: adresare formala (Sie).
     *
     * Toate cheile (ro/de/en) sunt optionale prin design — bucla din run()
     * trateaza absenta oricareia, ca intrarile viitoare sa poata fi partiale.
     *
     * @return array<string, array{ro?: string|null, de?: string|null, en?: string|null}>
     */
    private static function valori(): array
    {
        return [
            // nav
            'Acasa' => ['ro' => 'Acasă', 'de' => 'Startseite', 'en' => 'Home'],
            'Cere oferta' => ['ro' => 'Cere ofertă', 'de' => 'Angebot anfordern', 'en' => 'Request a quote'],
            'Certificari' => ['ro' => 'Certificări', 'de' => 'Zertifizierungen', 'en' => 'Certifications'],
            'Resurse' => ['de' => 'Ressourcen', 'en' => 'Resources'],
            'Blog' => ['de' => 'Blog', 'en' => 'Blog'],
            'Vezi toate proiectele' => ['de' => 'Alle Projekte ansehen', 'en' => 'View all projects'],
            'Vezi blogul' => ['de' => 'Zum Blog', 'en' => 'View the blog'],

            // blocks
            'Sus' => ['de' => 'Nach oben', 'en' => 'Back to top'],
            'Detalii' => ['de' => 'Mehr erfahren', 'en' => 'Details'],

            // footer
            'Luni - Vineri, 09:00 - 18:00' => ['de' => 'Montag – Freitag, 09:00 – 18:00 Uhr', 'en' => 'Monday – Friday, 09:00 – 18:00'],
            'Servicii forestiere si lemn de foc, cu grija pentru padure si mediu. Partener local Galle GmbH Germania.' => [
                'ro' => 'Servicii forestiere și lemn de foc, cu grijă pentru pădure și mediu. Partener local Galle GmbH Germania.',
                'de' => 'Forstdienstleistungen und Brennholz – mit Sorgfalt für Wald und Umwelt. Lokaler Partner der Galle GmbH Deutschland.',
                'en' => 'Forestry services and firewood, with care for the forest and the environment. Local partner of Galle GmbH Germany.',
            ],
            'Companie' => ['de' => 'Unternehmen', 'en' => 'Company'],
            'Despre' => ['de' => 'Über uns', 'en' => 'About'],
            'Servicii' => ['de' => 'Leistungen', 'en' => 'Services'],
            'Lemn de foc' => ['de' => 'Brennholz', 'en' => 'Firewood'],
            'Proiecte' => ['de' => 'Projekte', 'en' => 'Projects'],
            'Contact' => ['de' => 'Kontakt', 'en' => 'Contact'],
            'Termeni' => ['de' => 'AGB', 'en' => 'Terms'],
            'Confidentialitate' => ['ro' => 'Confidențialitate', 'de' => 'Datenschutz', 'en' => 'Privacy'],
            'Cookies' => ['de' => 'Cookies', 'en' => 'Cookies'],
            'Date firma' => ['ro' => 'Date firmă', 'de' => 'Impressum', 'en' => 'Legal notice'],
            'Setari cookies' => ['ro' => 'Setări cookies', 'de' => 'Cookie-Einstellungen', 'en' => 'Cookie settings'],
            'Admin' => ['de' => 'Admin', 'en' => 'Admin'],

            // auth front-end (footer + pagini login/register) — RO + DE/EN
            'Autentificare' => ['ro' => 'Autentificare', 'de' => 'Anmelden', 'en' => 'Log in'],
            'Cont nou' => ['ro' => 'Cont nou', 'de' => 'Neues Konto', 'en' => 'New account'],
            'Iesire' => ['ro' => 'Ieșire', 'de' => 'Abmelden', 'en' => 'Log out'],
            'Parola' => ['ro' => 'Parolă', 'de' => 'Passwort', 'en' => 'Password'],
            'Confirma parola' => ['ro' => 'Confirmă parola', 'de' => 'Passwort bestätigen', 'en' => 'Confirm password'],
            'Tine-ma minte' => ['ro' => 'Ține-mă minte', 'de' => 'Angemeldet bleiben', 'en' => 'Remember me'],
            'Creeaza cont' => ['ro' => 'Creează cont', 'de' => 'Konto erstellen', 'en' => 'Create account'],
            'Nu ai cont?' => ['ro' => 'Nu ai cont?', 'de' => 'Noch kein Konto?', 'en' => 'No account yet?'],
            'Ai deja cont?' => ['ro' => 'Ai deja cont?', 'de' => 'Haben Sie bereits ein Konto?', 'en' => 'Already have an account?'],
            'Minim 8 caractere.' => ['ro' => 'Minim 8 caractere.', 'de' => 'Mindestens 8 Zeichen.', 'en' => 'At least 8 characters.'],
            'Email sau parola gresite.' => ['ro' => 'Email sau parolă greșite.', 'de' => 'E-Mail oder Passwort falsch.', 'en' => 'Incorrect email or password.'],
            'Prea multe incercari. Reincearca peste un minut.' => ['ro' => 'Prea multe încercări. Reîncearcă peste un minut.', 'de' => 'Zu viele Versuche. Bitte versuchen Sie es in einer Minute erneut.', 'en' => 'Too many attempts. Please try again in a minute.'],
            'Intra in contul tau Galle Silva.' => ['ro' => 'Intră în contul tău Galle Silva.', 'de' => 'Melden Sie sich in Ihrem Galle Silva-Konto an.', 'en' => 'Log in to your Galle Silva account.'],
            'Creeaza-ti un cont Galle Silva.' => ['ro' => 'Creează-ți un cont Galle Silva.', 'de' => 'Erstellen Sie ein Galle Silva-Konto.', 'en' => 'Create a Galle Silva account.'],
            'Toate drepturile rezervate.' => ['de' => 'Alle Rechte vorbehalten.', 'en' => 'All rights reserved.'],
            'Partener local' => ['de' => 'Lokaler Partner', 'en' => 'Local partner'],

            // cookies
            'Consimtamant cookie-uri' => ['ro' => 'Consimțământ cookie-uri', 'de' => 'Cookie-Einwilligung', 'en' => 'Cookie consent'],
            'Folosim cookie-uri necesare pentru functionarea site-ului. Cu acordul tau, putem folosi si cookie-uri de analiza sau marketing. Vezi' => [
                'ro' => 'Folosim cookie-uri necesare pentru funcționarea site-ului. Cu acordul tău, putem folosi și cookie-uri de analiză sau marketing. Vezi',
                'de' => 'Wir verwenden Cookies, die für den Betrieb der Website erforderlich sind. Mit Ihrer Einwilligung können wir auch Analyse- oder Marketing-Cookies einsetzen. Siehe',
                'en' => 'We use cookies necessary for the website to function. With your consent, we may also use analytics or marketing cookies. See',
            ],
            'politica de cookies' => ['de' => 'Cookie-Richtlinie', 'en' => 'cookie policy'],
            'si' => ['ro' => 'și', 'de' => 'und', 'en' => 'and'],
            'politica de confidentialitate' => ['ro' => 'politica de confidențialitate', 'de' => 'Datenschutzerklärung', 'en' => 'privacy policy'],
            'Strict necesare' => ['de' => 'Unbedingt erforderlich', 'en' => 'Strictly necessary'],
            'Sesiune si securitate (CSRF). Nu pot fi dezactivate.' => [
                'ro' => 'Sesiune și securitate (CSRF). Nu pot fi dezactivate.',
                'de' => 'Sitzung und Sicherheit (CSRF). Können nicht deaktiviert werden.',
                'en' => 'Session and security (CSRF). These cannot be disabled.',
            ],
            'Analiza' => ['ro' => 'Analiză', 'de' => 'Analyse', 'en' => 'Analytics'],
            'Statistici anonime de utilizare, doar cu acordul tau.' => [
                'ro' => 'Statistici anonime de utilizare, doar cu acordul tău.',
                'de' => 'Anonyme Nutzungsstatistiken, nur mit Ihrer Einwilligung.',
                'en' => 'Anonymous usage statistics, only with your consent.',
            ],
            'Marketing' => ['de' => 'Marketing', 'en' => 'Marketing'],
            'Continut si masurare publicitara, doar cu acordul tau.' => [
                'ro' => 'Conținut și măsurare publicitară, doar cu acordul tău.',
                'de' => 'Werbeinhalte und Werbemessung, nur mit Ihrer Einwilligung.',
                'en' => 'Advertising content and measurement, only with your consent.',
            ],
            'Accept toate' => ['de' => 'Alle akzeptieren', 'en' => 'Accept all'],
            'Refuz' => ['de' => 'Ablehnen', 'en' => 'Decline'],
            'Setari' => ['ro' => 'Setări', 'de' => 'Einstellungen', 'en' => 'Settings'],
            'Salveaza setarile' => ['ro' => 'Salvează setările', 'de' => 'Einstellungen speichern', 'en' => 'Save settings'],

            // forms / splitter (fara jargon: „flow-uri" -> „direcții"; serviciile reale)
            'Pentru cine' => ['de' => 'Für wen', 'en' => 'Who we serve'],
            'Doua flow-uri, o singura calitate germana' => [
                'ro' => 'Două direcții, o singură calitate germană',
                'de' => 'Zwei Wege, eine deutsche Qualität',
                'en' => 'Two paths, one German standard of quality',
            ],
            'Sunt client privat' => ['de' => 'Ich bin Privatkunde', 'en' => 'I am a private customer'],
            'Stejar disponibil acum. Fag si carpen — in curand. Pret in metri steri sau tone. Livrare in 2-5 zile.' => [
                'ro' => 'Stejar disponibil acum. Fag și carpen — în curând. Preț în metri steri sau tone. Livrare în 2-5 zile.',
                'de' => 'Eiche jetzt verfügbar. Buche und Hainbuche — in Kürze. Preis pro Raummeter (Ster) oder Tonne. Lieferung in 2–5 Tagen.',
                'en' => 'Oak available now. Beech and hornbeam — coming soon. Priced per stacked cubic meter (ster) or tonne. Delivery within 2–5 days.',
            ],
            'Sunt firma / institutie' => ['ro' => 'Sunt firmă / instituție', 'de' => 'Ich bin ein Unternehmen / eine Institution', 'en' => 'I am a company / institution'],
            'Servicii dedicate' => ['de' => 'Maßgeschneiderte Leistungen', 'en' => 'Dedicated services'],
            'Forestier, peisagistica, compostare — pentru primarii, institutii si companii. Plata la termen, factura.' => [
                'ro' => 'Exploatare forestieră, transport și curățare terenuri — pentru primării, instituții și companii. Plată la termen, factură.',
                'de' => 'Holzernte, Holztransport und Flächenräumung — für Gemeinden, Institutionen und Unternehmen. Rechnung mit Zahlungsziel.',
                'en' => 'Timber harvesting, log transport and land clearing — for municipalities, institutions and companies. Invoice with payment terms.',
            ],
            'Sunt de acord cu prelucrarea datelor conform' => [
                'de' => 'Ich akzeptiere die Verarbeitung meiner Daten gemäß der',
                'en' => 'I agree to the processing of my data in accordance with the',
            ],
            'Politicii de confidentialitate' => [
                'ro' => 'Politicii de confidențialitate',
                'de' => 'Datenschutzerklärung',
                'en' => 'Privacy Policy',
            ],

            // date-firma (Impressum) — CUI / Reg. Com. raman ca identificatori RO.
            'Date firma / Impressum' => ['ro' => 'Date firmă / Impressum', 'de' => 'Impressum', 'en' => 'Company details / Legal notice'],
            'Identificarea societatii' => ['ro' => 'Identificarea societății', 'de' => 'Angaben zum Unternehmen', 'en' => 'Company identification'],
            'Denumire' => ['de' => 'Firmenname', 'en' => 'Company name'],
            'Cod unic de inregistrare (CUI)' => [
                'ro' => 'Cod unic de înregistrare (CUI)',
                'de' => 'Steuerliche Registrierungsnummer (CUI)',
                'en' => 'Tax registration number (CUI)',
            ],
            'Nr. Registrul Comertului' => [
                'ro' => 'Nr. Registrul Comerțului',
                'de' => 'Handelsregisternummer (Reg. Com.)',
                'en' => 'Trade Register No. (Reg. Com.)',
            ],
            'Data infiintarii' => ['ro' => 'Data înființării', 'de' => 'Gründungsdatum', 'en' => 'Date of incorporation'],
            'Sediu social' => ['de' => 'Eingetragener Sitz', 'en' => 'Registered office'],
            'Reprezentant' => ['de' => 'Vertreter', 'en' => 'Representative'],
            'manager general' => ['de' => 'Geschäftsführer', 'en' => 'General Manager'],
            'Telefon / WhatsApp' => ['de' => 'Telefon / WhatsApp', 'en' => 'Phone / WhatsApp'],
            'Responsabil pentru continut' => ['ro' => 'Responsabil pentru conținut', 'de' => 'Verantwortlich für den Inhalt', 'en' => 'Responsible for content'],
            'prin reprezentantul sau legal' => [
                'ro' => 'prin reprezentantul său legal',
                'de' => 'vertreten durch ihren gesetzlichen Vertreter',
                'en' => 'through its legal representative',
            ],
            'Pentru intrebari legate de protectia datelor, consultati' => [
                'ro' => 'Pentru întrebări legate de protecția datelor, consultați',
                'de' => 'Bei Fragen zum Datenschutz konsultieren Sie bitte die',
                'en' => 'For questions regarding data protection, please see the',
            ],

            // layout
            'Sari la continut' => ['ro' => 'Sari la conținut', 'de' => 'Zum Inhalt springen', 'en' => 'Skip to content'],

            // despre
            'Standarde si certificari' => ['ro' => 'Standarde și certificări', 'de' => 'Standards und Zertifizierungen', 'en' => 'Standards and certifications'],
            'Vezi toate certificarile' => ['ro' => 'Vezi toate certificările', 'de' => 'Alle Zertifizierungen ansehen', 'en' => 'View all certifications'],

            // blog
            'Inapoi la blog' => ['ro' => 'Înapoi la blog', 'de' => 'Zurück zum Blog', 'en' => 'Back to blog'],
            'Blog — ghiduri despre lemn de foc, padure si servicii | Galle Silva' => [
                'ro' => 'Blog — ghiduri despre lemn de foc, pădure și servicii | Galle Silva',
                'de' => 'Blog — Ratgeber zu Brennholz, Wald und Forstdienstleistungen | Galle Silva',
                'en' => 'Blog — guides on firewood, forests and forestry services | Galle Silva',
            ],
            'Ghiduri, studii si noutati despre lemn de foc, gestiunea padurii si servicii forestiere, de la echipa Galle Silva.' => [
                'ro' => 'Ghiduri, studii și noutăți despre lemn de foc, gestiunea pădurii și servicii forestiere, de la echipa Galle Silva.',
                'de' => 'Ratgeber, Studien und Neuigkeiten zu Brennholz, Waldbewirtschaftung und Forstdienstleistungen — vom Team Galle Silva.',
                'en' => 'Guides, studies and news on firewood, forest management and forestry services, from the Galle Silva team.',
            ],
            'Ghiduri, studii, noutati despre lemn de foc, padure si servicii.' => [
                'ro' => 'Ghiduri, studii, noutăți despre lemn de foc, pădure și servicii.',
                'de' => 'Ratgeber, Studien und Neuigkeiten zu Brennholz, Wald und Dienstleistungen.',
                'en' => 'Guides, studies and news on firewood, forests and services.',
            ],

            // pagini legale fara continut inca (site/legal.blade.php)
            'Continut in pregatire. Pentru detalii contactati-ne la' => [
                'ro' => 'Conținut în pregătire. Pentru detalii contactați-ne la',
                'de' => 'Inhalt in Vorbereitung. Für Einzelheiten kontaktieren Sie uns bitte unter',
                'en' => 'Content in preparation. For details, please contact us at',
            ],

            // lemn-de-foc (H1, intro, meta landing-uri locale, sectiuni)
            'Lemn de foc in Prahova, Bucuresti si Ilfov — fag, stejar, carpen' => [
                'ro' => 'Lemn de foc în Prahova, București și Ilfov — fag, stejar, carpen',
                'de' => 'Brennholz in Prahova, Bukarest und Ilfov — Buche, Eiche, Hainbuche',
                'en' => 'Firewood in Prahova, Bucharest and Ilfov — beech, oak, hornbeam',
            ],
            'Vindem lemn de foc de esenta tare — stejar si carpen pe stoc — de la 350 lei/m³, taiat si crapat, cu livrare in Prahova, Ilfov si Bucuresti, fara cantitate minima.' => [
                'ro' => 'Vindem lemn de foc de esență tare — stejar și carpen pe stoc — de la 350 lei/m³, tăiat și crăpat, cu livrare în Prahova, Ilfov și București, fără cantitate minimă.',
                'de' => 'Wir verkaufen Hartholz-Brennholz — Eiche und Hainbuche auf Lager — ab 350 Lei/m³, gesägt und gespalten, mit Lieferung in Prahova, Ilfov und Bukarest, ohne Mindestmenge.',
                'en' => 'We sell hardwood firewood — oak and hornbeam in stock — from 350 Lei/m³, cut and split, delivered in Prahova, Ilfov and Bucharest, with no minimum order.',
            ],
            'Lemn de foc in :localitate — fag, stejar, carpen' => [
                'ro' => 'Lemn de foc în :localitate — fag, stejar, carpen',
                'de' => 'Brennholz in :localitate — Buche, Eiche, Hainbuche',
                'en' => 'Firewood in :localitate — beech, oak, hornbeam',
            ],
            'Livram lemn de foc taiat si crapat in :localitate — de la 350 lei/m³, in 1–3 zile lucratoare.' => [
                'ro' => 'Livrăm lemn de foc tăiat și crăpat în :localitate — de la 350 lei/m³, în 1–3 zile lucrătoare.',
                'de' => 'Wir liefern gesägtes und gespaltenes Brennholz nach :localitate — ab 350 Lei/m³, in 1–3 Werktagen.',
                'en' => 'We deliver cut and split firewood in :localitate — from 350 Lei/m³, within 1–3 working days.',
            ],
            'Lemn de foc :localitate — livrare la domiciliu | Galle Silva' => [
                'de' => 'Brennholz :localitate — Lieferung frei Haus | Galle Silva',
                'en' => 'Firewood :localitate — home delivery | Galle Silva',
            ],
            'Lemn de foc de esenta tare in :localitate, judetul :judet — stejar si carpen pe stoc, taiat si crapat, de la 350 lei/m³. Livrare in 1–3 zile, fara cantitate minima.' => [
                'ro' => 'Lemn de foc de esență tare în :localitate, județul :judet — stejar și carpen pe stoc, tăiat și crăpat, de la 350 lei/m³. Livrare în 1–3 zile, fără cantitate minimă.',
                'de' => 'Hartholz-Brennholz in :localitate, Kreis :judet — Eiche und Hainbuche auf Lager, gesägt und gespalten, ab 350 Lei/m³. Lieferung in 1–3 Tagen, ohne Mindestmenge.',
                'en' => 'Hardwood firewood in :localitate, :judet county — oak and hornbeam in stock, cut and split, from 350 Lei/m³. Delivery within 1–3 days, no minimum order.',
            ],
            'Pret pornire' => ['ro' => 'Preț pornire', 'de' => 'Preis ab', 'en' => 'Starting price'],
            'Putere calorica' => ['ro' => 'Putere calorică', 'de' => 'Heizwert', 'en' => 'Heating value'],
            'Calculator pret' => ['ro' => 'Calculator preț', 'de' => 'Preisrechner', 'en' => 'Price calculator'],
            'Estimam in timp real costul total. Comanda direct sau pe WhatsApp.' => [
                'ro' => 'Estimăm în timp real costul total. Comandă direct sau pe WhatsApp.',
                'de' => 'Wir berechnen die Gesamtkosten in Echtzeit. Bestellen Sie direkt oder per WhatsApp.',
                'en' => 'We estimate the total cost in real time. Order directly or via WhatsApp.',
            ],
            'Comanda lemn' => ['ro' => 'Comandă lemn', 'de' => 'Holz bestellen', 'en' => 'Order firewood'],
            'Trimite-ne datele tale si te contactam in cel mult 24h pentru confirmare.' => [
                'ro' => 'Trimite-ne datele tale și te contactăm în cel mult 24h pentru confirmare.',
                'de' => 'Senden Sie uns Ihre Daten — wir melden uns innerhalb von 24 Stunden zur Bestätigung.',
                'en' => 'Send us your details and we will contact you within 24 hours to confirm.',
            ],
            'Unde livram' => ['ro' => 'Unde livrăm', 'de' => 'Liefergebiete', 'en' => 'Where we deliver'],
            'Cost livrare:' => ['de' => 'Lieferkosten:', 'en' => 'Delivery cost:'],
            'Intrebari frecvente' => ['ro' => 'Întrebări frecvente', 'de' => 'Häufige Fragen', 'en' => 'Frequently asked questions'],

            // pagina FAQ (/intrebari-frecvente) + teaser pe home; etichetele de
            // categorie sunt chei dinamice (__(Faq::CATEGORII[...])) — create aici.
            'FAQ' => ['de' => 'FAQ', 'en' => 'FAQ'],
            'Vezi toate intrebarile' => ['ro' => 'Vezi toate întrebările', 'de' => 'Alle Fragen ansehen', 'en' => 'See all questions'],
            'Cauta o intrebare...' => ['ro' => 'Caută o întrebare…', 'de' => 'Frage suchen…', 'en' => 'Search a question…'],
            'Nu ai gasit raspunsul?' => ['ro' => 'Nu ai găsit răspunsul?', 'de' => 'Antwort nicht gefunden?', 'en' => 'Did not find the answer?'],
            'Scrie-ne si te contactam in 24h.' => ['ro' => 'Scrie-ne și te contactăm în 24h.', 'de' => 'Schreiben Sie uns — wir melden uns innerhalb von 24 Stunden.', 'en' => 'Write to us and we will get back to you within 24 hours.'],
            'Plata' => ['ro' => 'Plată', 'de' => 'Zahlung', 'en' => 'Payment'],
            'Exploatare forestiera' => ['ro' => 'Exploatare forestieră', 'de' => 'Holzernte', 'en' => 'Timber harvesting'],
            'Achizitie masa lemnoasa' => ['ro' => 'Achiziție masă lemnoasă', 'de' => 'Holzankauf', 'en' => 'Timber purchasing'],
            'Curatare terenuri' => ['ro' => 'Curățare terenuri', 'de' => 'Flächenräumung', 'en' => 'Land clearing'],
            'Transport lemn' => ['de' => 'Holztransport', 'en' => 'Timber transport'],
            'Lucrari silvice' => ['ro' => 'Lucrări silvice', 'de' => 'Waldpflegearbeiten', 'en' => 'Silvicultural works'],
            'Intrebari generale' => ['ro' => 'Întrebări generale', 'de' => 'Allgemeine Fragen', 'en' => 'General questions'],
            'Raspunsuri despre lemn de foc, servicii forestiere, livrare si documente.' => [
                'ro' => 'Răspunsuri despre lemn de foc, servicii forestiere, livrare și documente.',
                'de' => 'Antworten zu Brennholz, Forstdienstleistungen, Lieferung und Unterlagen.',
                'en' => 'Answers about firewood, forestry services, delivery and documents.',
            ],
            'Categorii de intrebari' => ['ro' => 'Categorii de întrebări', 'de' => 'Fragenkategorien', 'en' => 'Question categories'],
            'intrebare' => ['ro' => 'întrebare', 'de' => 'Frage', 'en' => 'question'],
            'intrebari' => ['ro' => 'întrebări', 'de' => 'Fragen', 'en' => 'questions'],
            'rezultat' => ['de' => 'Ergebnis', 'en' => 'result'],
            'rezultate' => ['de' => 'Ergebnisse', 'en' => 'results'],
            'Deschide toate' => ['de' => 'Alle öffnen', 'en' => 'Open all'],
            'Inchide toate' => ['ro' => 'Închide toate', 'de' => 'Alle schließen', 'en' => 'Close all'],
            'Nu am gasit nicio intrebare pentru' => [
                'ro' => 'Nu am găsit nicio întrebare pentru',
                'de' => 'Wir haben keine Frage gefunden zu',
                'en' => 'We could not find any question matching',
            ],
            'Sterge cautarea' => ['ro' => 'Șterge căutarea', 'de' => 'Suche zurücksetzen', 'en' => 'Clear search'],
            'Scrie-ne' => ['de' => 'Schreiben Sie uns', 'en' => 'Write to us'],

            // label-uri enum (afisate cu __($enum->label()) — chei create de seeder)
            'Disponibil' => ['de' => 'Verfügbar', 'en' => 'Available'],
            'In curand' => ['ro' => 'În curând', 'de' => 'In Kürze', 'en' => 'Coming soon'],
            'In proces de certificare' => ['ro' => 'În proces de certificare', 'de' => 'Im Zertifizierungsprozess', 'en' => 'Certification in progress'],
            'Activ' => ['de' => 'Aktiv', 'en' => 'Active'],
            'Metru ster' => ['de' => 'Raummeter (Ster)', 'en' => 'Stacked meter (ster)'],
            'Tona' => ['ro' => 'Tonă', 'de' => 'Tonne', 'en' => 'Tonne'],
            'Servicii forestiere' => ['de' => 'Forstdienstleistungen', 'en' => 'Forestry services'],
            'Peisagistica' => ['ro' => 'Peisagistică', 'de' => 'Landschaftsbau', 'en' => 'Landscaping'],
            'Compostare' => ['de' => 'Kompostierung', 'en' => 'Composting'],

            // certificari (block marquee pe home)
            'In curs de obtinere' => ['ro' => 'În curs de obținere', 'de' => 'In Beantragung', 'en' => 'In progress'],
            'Certificat' => ['de' => 'Zertifiziert', 'en' => 'Certified'],
            'prin' => ['de' => 'über', 'en' => 'via'],

            // certificari (pagina)
            'Certificari — FSC, PEFC, ISO 9001/14001, RAL, DEKRA | Galle Silva' => [
                'ro' => 'Certificări — FSC, PEFC, ISO 9001/14001, RAL, DEKRA | Galle Silva',
                'de' => 'Zertifizierungen — FSC, PEFC, ISO 9001/14001, RAL, DEKRA | Galle Silva',
                'en' => 'Certifications — FSC, PEFC, ISO 9001/14001, RAL, DEKRA | Galle Silva',
            ],
            'Certificarile Galle Silva si ale partenerului Galle GmbH: FSC si PEFC in proces, ISO 9001, ISO 14001, RAL si DEKRA active. Calitate validata.' => [
                'ro' => 'Certificările Galle Silva și ale partenerului Galle GmbH: FSC și PEFC în proces, ISO 9001, ISO 14001, RAL și DEKRA active. Calitate validată.',
                'de' => 'Die Zertifizierungen von Galle Silva und des Partners Galle GmbH: FSC und PEFC im Prozess, ISO 9001, ISO 14001, RAL und DEKRA aktiv. Geprüfte Qualität.',
                'en' => 'The certifications of Galle Silva and its partner Galle GmbH: FSC and PEFC in progress; ISO 9001, ISO 14001, RAL and DEKRA active. Validated quality.',
            ],
            'FSC si PEFC — in proces. ISO 9001, ISO 14001, RAL si DEKRA — detinute de Galle GmbH, partenerul nostru german.' => [
                'ro' => 'FSC și PEFC — în proces. ISO 9001, ISO 14001, RAL și DEKRA — deținute de Galle GmbH, partenerul nostru german.',
                'de' => 'FSC und PEFC — im Prozess. ISO 9001, ISO 14001, RAL und DEKRA — gehalten von der Galle GmbH, unserem deutschen Partner.',
                'en' => 'FSC and PEFC — in progress. ISO 9001, ISO 14001, RAL and DEKRA — held by Galle GmbH, our German partner.',
            ],
            'Emis de' => ['de' => 'Ausgestellt von', 'en' => 'Issued by'],
            'Certificari ale grupului Galle GmbH' => [
                'ro' => 'Certificări ale grupului Galle GmbH',
                'de' => 'Zertifizierungen der Galle GmbH Gruppe',
                'en' => 'Certifications of the Galle GmbH group',
            ],
            'Educational' => ['ro' => 'Educațional', 'de' => 'Zum Verständnis', 'en' => 'Educational'],
            'De ce FSC / PEFC e mai important decat ISO pentru lemn?' => [
                'ro' => 'De ce FSC / PEFC e mai important decât ISO pentru lemn?',
                'de' => 'Warum sind FSC / PEFC bei Holz wichtiger als ISO?',
                'en' => 'Why are FSC / PEFC more important than ISO for wood?',
            ],
            'Certificarile FSC si PEFC verifica direct sursa lemnului — provenienta din paduri gestionate sustenabil si lantul de custodie pana la consumator. ISO 9001 / 14001 sunt despre proces si management organizational — utile, dar nu inlocuiesc trasabilitatea produsului.' => [
                'ro' => 'Certificările FSC și PEFC verifică direct sursa lemnului — proveniența din păduri gestionate sustenabil și lanțul de custodie până la consumator. ISO 9001 / 14001 sunt despre proces și management organizațional — utile, dar nu înlocuiesc trasabilitatea produsului.',
                'de' => 'FSC- und PEFC-Zertifizierungen prüfen direkt die Quelle des Holzes — die Herkunft aus nachhaltig bewirtschafteten Wäldern und die Produktkette bis zum Verbraucher. ISO 9001 / 14001 betreffen Prozesse und Organisationsmanagement — nützlich, ersetzen aber nicht die Rückverfolgbarkeit des Produkts.',
                'en' => 'FSC and PEFC certifications directly verify the source of the wood — provenance from sustainably managed forests and the chain of custody down to the consumer. ISO 9001 / 14001 are about process and organisational management — useful, but no substitute for product traceability.',
            ],

            // institutii (pagina)
            'Pentru institutii si primarii — Galle Silva' => [
                'ro' => 'Pentru instituții și primării — Galle Silva',
                'de' => 'Für Institutionen und Gemeinden — Galle Silva',
                'en' => 'For institutions and municipalities — Galle Silva',
            ],
            'Servicii forestiere, peisagistica si compostare cu factura si plata la termen pentru primarii, institutii si companii. Standarde germane Galle GmbH.' => [
                'ro' => 'Servicii forestiere, peisagistică și compostare cu factură și plată la termen pentru primării, instituții și companii. Standarde germane Galle GmbH.',
                'de' => 'Forstdienstleistungen, Landschaftsbau und Kompostierung mit Rechnung und Zahlungsziel für Gemeinden, Institutionen und Unternehmen. Deutsche Standards der Galle GmbH.',
                'en' => 'Forestry services, landscaping and composting with invoice and payment terms for municipalities, institutions and companies. German Galle GmbH standards.',
            ],
            'Pentru institutii si primarii' => [
                'ro' => 'Pentru instituții și primării',
                'de' => 'Für Institutionen und Gemeinden',
                'en' => 'For institutions and municipalities',
            ],
            'Servicii forestiere, peisagistica si compostare — disponibile cu factura si plata la termen pentru primarii, institutii si companii.' => [
                'ro' => 'Servicii forestiere, peisagistică și compostare — disponibile cu factură și plată la termen pentru primării, instituții și companii.',
                'de' => 'Forstdienstleistungen, Landschaftsbau und Kompostierung — mit Rechnung und Zahlungsziel für Gemeinden, Institutionen und Unternehmen.',
                'en' => 'Forestry services, landscaping and composting — available with invoice and payment terms for municipalities, institutions and companies.',
            ],
            'Lucrati la primarie sau institutie publica?' => [
                'ro' => 'Lucrați la primărie sau instituție publică?',
                'de' => 'Arbeiten Sie bei einer Gemeinde oder einer öffentlichen Einrichtung?',
                'en' => 'Do you work for a town hall or a public institution?',
            ],
            'Emitem factura cu plata la termen. Putem participa la achizitii directe sau proceduri SEAP.' => [
                'ro' => 'Emitem factură cu plată la termen. Putem participa la achiziții directe sau proceduri SEAP.',
                'de' => 'Wir stellen Rechnungen mit Zahlungsziel aus. Wir können an Direktvergaben oder SEAP-Verfahren (rumänisches öffentliches Beschaffungsportal) teilnehmen.',
                'en' => 'We issue invoices with payment terms. We can take part in direct awards or SEAP (Romanian public procurement) procedures.',
            ],
            'Cere oferta institutionala' => [
                'ro' => 'Cere ofertă instituțională',
                'de' => 'Institutionelles Angebot anfordern',
                'en' => 'Request an institutional quote',
            ],

            // proiecte (pagini)
            'Proiecte — portofoliu Galle Silva' => [
                'de' => 'Projekte — Portfolio Galle Silva',
                'en' => 'Projects — Galle Silva portfolio',
            ],
            'Portofoliul Galle Silva: lucrari forestiere, peisagistica si compostare pentru primarii, proprietari privati si companii in Prahova, Ilfov si Bucuresti.' => [
                'ro' => 'Portofoliul Galle Silva: lucrări forestiere, peisagistică și compostare pentru primării, proprietari privați și companii în Prahova, Ilfov și București.',
                'de' => 'Das Portfolio von Galle Silva: Forstarbeiten, Landschaftsbau und Kompostierung für Gemeinden, private Eigentümer und Unternehmen in Prahova, Ilfov und Bukarest.',
                'en' => 'The Galle Silva portfolio: forestry works, landscaping and composting for municipalities, private owners and companies in Prahova, Ilfov and Bucharest.',
            ],
            'Portofoliu Galle Silva — lucrari pentru primarii, proprietari privati si companii.' => [
                'ro' => 'Portofoliu Galle Silva — lucrări pentru primării, proprietari privați și companii.',
                'de' => 'Portfolio Galle Silva — Arbeiten für Gemeinden, private Eigentümer und Unternehmen.',
                'en' => 'Galle Silva portfolio — works for municipalities, private owners and companies.',
            ],
            'Nu sunt proiecte publicate inca.' => [
                'ro' => 'Nu sunt proiecte publicate încă.',
                'de' => 'Es sind noch keine Projekte veröffentlicht.',
                'en' => 'No projects published yet.',
            ],
            'Toate proiectele' => ['de' => 'Alle Projekte', 'en' => 'All projects'],

            // contact (pagina + formulare)
            'Contact — Galle Silva | lemn de foc si servicii forestiere' => [
                'ro' => 'Contact — Galle Silva | lemn de foc și servicii forestiere',
                'de' => 'Kontakt — Galle Silva | Brennholz und Forstdienstleistungen',
                'en' => 'Contact — Galle Silva | firewood and forestry services',
            ],
            'Contacteaza Galle Silva pentru lemn de foc, servicii forestiere, peisagistica sau compostare. Raspundem in cel mult 24h. Prahova, Ilfov, Bucuresti.' => [
                'ro' => 'Contactează Galle Silva pentru lemn de foc, servicii forestiere, peisagistică sau compostare. Răspundem în cel mult 24h. Prahova, Ilfov, București.',
                'de' => 'Kontaktieren Sie Galle Silva für Brennholz, Forstdienstleistungen, Landschaftsbau oder Kompostierung. Wir antworten innerhalb von 24 Stunden. Prahova, Ilfov, Bukarest.',
                'en' => 'Contact Galle Silva for firewood, forestry services, landscaping or composting. We reply within 24 hours. Prahova, Ilfov, Bucharest.',
            ],
            'Spune-ne de ce ai nevoie. Te contactam in 24h.' => [
                'ro' => 'Spune-ne de ce ai nevoie. Te contactăm în 24h.',
                'de' => 'Sagen Sie uns, was Sie benötigen. Wir melden uns innerhalb von 24 Stunden.',
                'en' => 'Tell us what you need. We will get back to you within 24 hours.',
            ],
            'Date contact' => ['de' => 'Kontaktdaten', 'en' => 'Contact details'],
            'Telefon' => ['de' => 'Telefon', 'en' => 'Phone'],
            'Program' => ['de' => 'Öffnungszeiten', 'en' => 'Hours'],
            'Zone deservite' => ['de' => 'Einsatzgebiete', 'en' => 'Areas served'],
            'Pentru o discutie rapida —' => [
                'ro' => 'Pentru o discuție rapidă —',
                'de' => 'Für ein schnelles Gespräch —',
                'en' => 'For a quick chat —',
            ],
            'sau email direct.' => ['de' => 'oder direkt per E-Mail.', 'en' => 'or email us directly.'],
            'Multumim!' => ['ro' => 'Mulțumim!', 'de' => 'Vielen Dank!', 'en' => 'Thank you!'],
            'Mesajul tau a fost trimis. Te contactam in cel mult 24h.' => [
                'ro' => 'Mesajul tău a fost trimis. Te contactăm în cel mult 24h.',
                'de' => 'Ihre Nachricht wurde gesendet. Wir melden uns innerhalb von 24 Stunden.',
                'en' => 'Your message has been sent. We will contact you within 24 hours.',
            ],
            'Trimite alt mesaj' => ['de' => 'Weitere Nachricht senden', 'en' => 'Send another message'],
            'Nu completa acest camp' => [
                'ro' => 'Nu completa acest câmp',
                'de' => 'Dieses Feld nicht ausfüllen',
                'en' => 'Do not fill in this field',
            ],
            'Nume' => ['de' => 'Name', 'en' => 'Name'],
            'Firma (optional)' => ['ro' => 'Firmă (opțional)', 'de' => 'Firma (optional)', 'en' => 'Company (optional)'],
            'Email' => ['de' => 'E-Mail', 'en' => 'Email'],
            'Telefon (optional)' => ['ro' => 'Telefon (opțional)', 'de' => 'Telefon (optional)', 'en' => 'Phone (optional)'],
            'Serviciu de interes' => ['de' => 'Gewünschte Leistung', 'en' => 'Service of interest'],
            '— Alege —' => ['de' => '— Bitte wählen —', 'en' => '— Choose —'],
            'Altul' => ['de' => 'Sonstiges', 'en' => 'Other'],
            'Mesaj' => ['de' => 'Nachricht', 'en' => 'Message'],
            'Trimite mesajul' => ['de' => 'Nachricht senden', 'en' => 'Send message'],
            'Se trimite...' => ['de' => 'Wird gesendet...', 'en' => 'Sending...'],
            'Datele sunt folosite doar pentru a-ti raspunde — vezi' => [
                'ro' => 'Datele sunt folosite doar pentru a-ți răspunde — vezi',
                'de' => 'Ihre Daten werden nur zur Beantwortung Ihrer Anfrage verwendet — siehe',
                'en' => 'Your data is used only to reply to you — see',
            ],

            // order form (lemn de foc)
            'Comanda ta a fost preluata. Te contactam in cel mult 24h pentru confirmare.' => [
                'ro' => 'Comanda ta a fost preluată. Te contactăm în cel mult 24h pentru confirmare.',
                'de' => 'Ihre Bestellung ist eingegangen. Wir melden uns innerhalb von 24 Stunden zur Bestätigung.',
                'en' => 'Your order has been received. We will contact you within 24 hours to confirm.',
            ],
            'Pana atunci poti vorbi cu noi pe' => [
                'ro' => 'Până atunci poți vorbi cu noi pe',
                'de' => 'Bis dahin erreichen Sie uns auch über',
                'en' => 'Until then, you can reach us on',
            ],
            'Trimite alta comanda' => ['ro' => 'Trimite altă comandă', 'de' => 'Weitere Bestellung senden', 'en' => 'Send another order'],
            'Email (optional)' => ['ro' => 'Email (opțional)', 'de' => 'E-Mail (optional)', 'en' => 'Email (optional)'],
            'Localitate' => ['de' => 'Ort', 'en' => 'Town/locality'],
            'Cantitate' => ['de' => 'Menge', 'en' => 'Quantity'],
            'Unitate' => ['de' => 'Einheit', 'en' => 'Unit'],
            'Data dorita (optional)' => ['ro' => 'Data dorită (opțional)', 'de' => 'Wunschtermin (optional)', 'en' => 'Preferred date (optional)'],
            'Mesaj (optional)' => ['ro' => 'Mesaj (opțional)', 'de' => 'Nachricht (optional)', 'en' => 'Message (optional)'],
            'Trimite comanda' => ['de' => 'Bestellung senden', 'en' => 'Send order'],
            'Datele sunt folosite doar pentru a procesa comanda ta — vezi' => [
                'ro' => 'Datele sunt folosite doar pentru a procesa comanda ta — vezi',
                'de' => 'Ihre Daten werden nur zur Bearbeitung Ihrer Bestellung verwendet — siehe',
                'en' => 'Your data is used only to process your order — see',
            ],

            // calculator pret
            'Specie' => ['de' => 'Holzart', 'en' => 'Species'],
            'Zona livrare' => ['ro' => 'Zonă livrare', 'de' => 'Liefergebiet', 'en' => 'Delivery area'],
            'Lemn' => ['de' => 'Holz', 'en' => 'Wood'],
            'Livrare' => ['de' => 'Lieferung', 'en' => 'Delivery'],
            'Total estimat' => ['de' => 'Geschätzte Gesamtsumme', 'en' => 'Estimated total'],
            'Pret indicativ. Confirmarea finala dupa contactul de la noi.' => [
                'ro' => 'Preț indicativ. Confirmarea finală după contactul de la noi.',
                'de' => 'Unverbindlicher Richtpreis. Endgültige Bestätigung nach unserer Kontaktaufnahme.',
                'en' => 'Indicative price. Final confirmation after we contact you.',
            ],
        ];
    }
}
