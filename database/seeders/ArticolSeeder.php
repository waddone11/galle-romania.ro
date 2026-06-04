<?php

namespace Database\Seeders;

use App\Models\Articol;
use Illuminate\Database\Seeder;

class ArticolSeeder extends Seeder
{
    /**
     * 6 articole de blog cu continut SEO real (RO cu diacritice, DE/EN null).
     * Link-urile interne folosesc sintaxa [text](/url) — randata de site/articol.
     */
    public function run(): void
    {
        $t = fn (string $ro): array => ['ro' => $ro, 'de' => null, 'en' => null];

        $rows = [
            [
                'slug' => 'metru-ster-vs-metru-cub-lemn-de-foc',
                'titlu' => $t('Metru ster vs metru cub la lemnul de foc: diferența pe înțelesul tuturor'),
                'excerpt' => $t('Sterul și metrul cub nu sunt același lucru — diferența poate însemna 35-40% din banii tăi. Uite cum le deosebești și cum verifici la recepție.'),
                'continut' => $t("Când cumperi lemn de foc, prețul se exprimă fie în metri cubi, fie în metri steri. Diferența nu e un moft tehnic — e exact diferența dintre cât lemn primești și cât aer plătești.\n\nMetrul cub (m³) înseamnă lemn plin: un cub imaginar de 1x1x1 metri umplut complet cu masă lemnoasă, fără spații. Așa se măsoară buștenii și lemnul rotund în acte.\n\nMetrul ster înseamnă lemn stivuit: tot un cub de 1x1x1 metri, dar umplut cu lemne tăiate și crăpate, aranjate unele peste altele. Între bucăți rămân inevitabil spații de aer — iar aerul nu arde.\n\nFactorul de conversie practic: un ster conține aproximativ 0,6–0,65 m³ de lemn plin, în funcție de cât de drepte sunt lemnele, de lungimea lor și de cât de îngrijit e stivuită grămada. Cu alte cuvinte, ca să obții un metru cub de lemn plin, ai nevoie de circa un ster și jumătate.\n\nCum verifici la recepție: cere să se descarce lemnul stivuit, nu vrac — sau stivuiește-l tu înainte să confirmi cantitatea. Măsoară lungimea, înălțimea și adâncimea stivei și înmulțește-le. Dacă ai comandat 5 steri și stiva are 5 metri lungime, 1 metru înălțime și 1 metru adâncime, ești în regulă. La lemnul livrat vrac, volumul aparent e cu 30-40% mai mare decât cel stivuit — un camion care „arată plin\" nu garantează nimic.\n\nUn vânzător corect îți spune de la început în ce unitate vinde și cum poți verifica. Noi livrăm [lemn de foc](/lemn-de-foc) cântărit sau măsurat la ster, cu documente de proveniență — iar dacă vrei să verifici stiva la descărcare, șoferul te așteaptă."),
                'categorie' => 'ghid',
                'imagine' => '/images/galle/proiecte/gramada-busteni-wide.webp',
                'published_at' => now()->subDays(34),
                'is_published' => true,
            ],
            [
                'slug' => 'fag-stejar-sau-carpen-ce-lemn-de-foc-alegi',
                'titlu' => $t('Ce lemn de foc e mai bun: fag, stejar sau carpen?'),
                'excerpt' => $t('Toate trei sunt esențe tari și ard bine — dar fiecare are particularități. Comparație practică, plus când are sens să combini cu esențe moi.'),
                'continut' => $t("Fagul, stejarul și carpenul sunt cele trei esențe tari clasice pentru încălzit în România. Toate au densitate mare și ardere de durată — dar nu sunt identice.\n\nCarpenul e campionul puterii calorice: aproximativ 4,2–4,3 kWh/kg, cea mai densă esență folosită curent la foc. Arde lent, face jar consistent și ține căldura ore întregi. Dezavantaj: se aprinde mai greu și se despică mai dificil.\n\nStejarul vine imediat după: ~4,2 kWh/kg, ardere lentă și jar de durată. Conține taninuri, deci are nevoie de uscare mai lungă (ideal doi ani) ca să ardă curat. Uscat corect, e excelent pentru cazane și sobe cu acumulare.\n\nFagul e cel mai echilibrat: ~4,0 kWh/kg, se aprinde ușor, arde uniform, cu flacără frumoasă — motiv pentru care e preferatul șemineelor. Se usucă mai repede decât stejarul și se despică ușor.\n\nCând combini cu esențe moi: lemnul moale (plop, salcie, brad) arde repede și face flacără mare, dar jar puțin. E util la aprindere și la încălzirea rapidă a unei încăperi reci — aprinzi cu esență moale, întreții cu esență tare. Pentru foc continuu peste noapte, esența tare e singura alegere corectă.\n\nConcluzia practică: pentru cazan sau sobă cu acumulare — carpen sau stejar; pentru șemineu și ardere la vedere — fag; pentru buget echilibrat — un amestec de esențe tari funcționează foarte bine.\n\nVerifică mereu umiditatea: orice esență, oricât de nobilă, arde prost și murdar peste 20% umiditate. Vezi ce avem pe stoc la [lemn de foc](/lemn-de-foc) — stejar, carpen și fag, tăiat și crăpat, livrat în Prahova, Ilfov și București."),
                'categorie' => 'ghid',
                'imagine' => '/images/galle/proiecte/depozit-amurg-wide.webp',
                'published_at' => now()->subDays(27),
                'is_published' => true,
            ],
            [
                'slug' => 'cat-lemn-de-foc-pentru-o-iarna',
                'titlu' => $t('Cât lemn de foc îți trebuie pentru o iarnă?'),
                'excerpt' => $t('Estimare orientativă pe tipuri de locuință și sisteme de încălzire — plus regula simplă cu care calculezi necesarul propriu.'),
                'continut' => $t("Întrebarea pe care o primim cel mai des toamna: „câți steri să iau?\". Răspunsul corect depinde de trei lucruri — cât de mare e spațiul încălzit, cât de bine e izolat și cu ce arzi.\n\nRepere orientative pentru un sezon rece (noiembrie–martie):\n\nApartament sau casă mică (50–80 m²), încălzită cu o sobă bună: 4–6 steri de esență tare. Dacă soba e veche și fără acumulare, adaugă 1-2 steri.\n\nCasă medie (100–140 m²) cu centrală pe lemne sau două sobe: 8–12 steri. Izolația face diferența mare aici — o casă neizolată poate consuma ușor și 15.\n\nCasă mare (peste 150 m²) cu cazan pe lemne: 12–18 steri, în funcție de izolație și de temperatura de confort.\n\nRegula simplă de calcul: pornește de la consumul iernii trecute. Dacă nu-l știi, estimează 1 ster la 10-12 m² pentru o locuință mediu izolată cu sobă clasică, apoi ajustează după primul sezon. Mai bine să-ți rămână un ster decât să rămâi fără în ianuarie, când prețurile sunt maxime și livrările lente.\n\nCâteva sfaturi care reduc consumul: arde doar lemn uscat (sub 20% umiditate) — lemnul verde pierde până la o treime din căldură evaporând apa; curăță coșul înainte de sezon; nu sufoca focul — arderea înăbușită murdărește coșul și risipește lemnul.\n\nLa noi nu există cantitate minimă de comandă — poți lua și un singur ster, de probă, să vezi calitatea. Folosește [calculatorul de preț](/lemn-de-foc) ca să afli pe loc cât te costă necesarul tău, cu livrare în Prahova, Ilfov și București, sau [trimite-ne o comandă](/lemn-de-foc) direct din pagină."),
                'categorie' => 'ghid',
                'imagine' => '/images/galle/proiecte/camion-incarcat-wide.webp',
                'published_at' => now()->subDays(20),
                'is_published' => true,
            ],
            [
                'slug' => 'vreau-sa-vand-padure-pasii-corecti',
                'titlu' => $t('Vreau să vând pădure: pașii corecți pentru un proprietar'),
                'excerpt' => $t('De la actele de proprietate la APV și plata finală — ce trebuie să știi ca să-ți valorifici pădurea corect și legal, fără surprize.'),
                'continut' => $t("Ai moștenit sau deții o pădure și vrei să o valorifici? Procesul e mai simplu decât pare, dacă îl iei în ordinea corectă.\n\nPasul 1 — clarifică proprietatea. Ai nevoie de actele de proprietate (titlu, extras de carte funciară) și de identificarea exactă a parcelei. Dacă moștenirea nu e dezbătută, începe cu succesiunea — nimeni nu poate cumpăra legal de la un proprietar neclarificat.\n\nPasul 2 — evaluarea. Un cumpărător serios vine la fața locului și se uită la: specii (stejarul și fagul valorează mai mult decât plopul), vârsta și diametrul arborilor, volumul estimat, panta și accesul (un drum forestier bun poate crește prețul semnificativ). Cere evaluarea în scris.\n\nPasul 3 — APV-ul. Recoltarea legală se face doar pe baza unui act de punere în valoare (APV), întocmit prin ocolul silvic: arborii sunt marcați, măsurați și inventariați într-o partidă. APV-ul îți spune negru pe alb ce volum se recoltează — e protecția ta principală împotriva subevaluării.\n\nPasul 4 — alege forma de vânzare. Pe picior: vinzi arborii nerecoltați, cumpărătorul se ocupă de tot (exploatare, transport, acte) — tu primești banii și atât. Fasonat: recoltezi tu (sau plătești un prestator) și vinzi lemnul gata tăiat, la drum auto — preț mai bun pe metru cub, dar și risc și bătăi de cap mai mari. Pentru majoritatea proprietarilor mici, vânzarea pe picior e alegerea practică.\n\nPasul 5 — verifică-ți cumpărătorul. Cere: atestat de exploatare valabil, contract scris cu preț ferm și termene de plată, dovada că lucrează cu SUMAL (sistemul de trasabilitate a lemnului). Evită înțelegerile verbale și avansurile „pe încredere\".\n\nNoi [cumpărăm masă lemnoasă](/servicii/achizitie-masa-lemnoasa) pe picior sau fasonată, cu evaluare gratuită la fața locului, contract și plată prin bancă — iar de partea tehnică se ocupă echipa noastră de [exploatare forestieră](/servicii/exploatare-forestiera)."),
                'categorie' => 'ghid',
                'imagine' => '/images/galle/proiecte/busteni-marcati-wide.webp',
                'published_at' => now()->subDays(13),
                'is_published' => true,
            ],
            [
                'slug' => 'ce-inseamna-apv-si-de-ce-conteaza',
                'titlu' => $t('Ce înseamnă APV și de ce contează'),
                'excerpt' => $t('Actul de punere în valoare e documentul care face diferența între recoltare legală și tăiere ilegală. Ce conține și ce primește proprietarul.'),
                'continut' => $t("APV — actul de punere în valoare — e documentul tehnic fără de care niciun arbore nu se taie legal în România. Dacă deții pădure sau cumperi lemn, merită să înțelegi ce face.\n\nCe este, concret: APV-ul e inventarul oficial al arborilor destinați recoltării dintr-o parcelă. Îl întocmește personalul silvic autorizat (de regulă prin ocolul silvic): arborii sunt aleși conform amenajamentului silvic, marcați cu ciocanul silvic — marca rotundă pe care o vezi pe trunchiuri — măsurați și înregistrați. Rezultatul e o „partidă\": lista cu specii, număr de arbori, volume estimate pe sortimente.\n\nDe ce contează pentru proprietar: APV-ul îți spune exact ce volum de lemn se recoltează din pădurea ta — baza corectă pentru orice negociere de preț. Fără APV, „vânzarea\" e o estimare după ochi, aproape întotdeauna în defavoarea ta. Tot APV-ul e și documentul care dovedește că recoltarea respectă amenajamentul — adică pădurea ta rămâne pădure, gestionată, nu rasă.\n\nDe ce contează pentru cumpărătorul de lemn: lemnul cu proveniență legală se trasează de la APV, prin autorizația de exploatare, până la avizele de însoțire generate în SUMAL la fiecare transport. Când cumperi lemn de foc cu acte, lanțul ăsta e garanția că nu finanțezi tăieri ilegale.\n\nCe primește proprietarul, pe scurt: partida (lista APV) cu volumele pe specii; autorizația de exploatare emisă înainte de începerea lucrării; procesul-verbal de predare a parchetului la final — dovada că terenul a fost lăsat curat, conform regulilor.\n\nDacă ești la prima exploatare și hârtiile te sperie, e normal — sunt multe și au termene. Echipa noastră de [exploatare forestieră](/servicii/exploatare-forestiera) lucrează doar cu acte complete și te ghidează pas cu pas, împreună cu ocolul silvic, de la marcarea arborilor până la predarea parchetului."),
                'categorie' => 'ghid',
                'imagine' => '/images/galle/proiecte/harvester-galle-wide.webp',
                'published_at' => now()->subDays(7),
                'is_published' => true,
            ],
            [
                'slug' => 'defrisare-teren-sau-curatare-vegetatie-diferenta',
                'titlu' => $t('Defrișare teren sau curățare vegetație? Diferența practică și legală'),
                'excerpt' => $t('Nu orice teren cu copaci e „pădure\" în acte — iar diferența schimbă tot: autorizații, costuri, termene. Ghid scurt ca să știi în ce situație ești.'),
                'continut' => $t("„Vreau să defrișez un teren\" — așa începe aproape orice discuție. Dar legal și practic, contează enorm un singur lucru: terenul e fond forestier sau nu?\n\nTeren neforestier cu vegetație: o pășune năpădită de arbuști, o livadă abandonată, un teren intravilan cu copaci crescuți sălbatic, un teren agricol lăsat în paragină. Aici vorbim despre curățare de vegetație — lucrare pe care o poți face ca proprietar, în general fără autorizații silvice. Tai vegetația, scoți cioatele, frezezi rădăcinile, nivelezi — și terenul e gata pentru construcție sau agricultură. Pentru arbori izolați din intravilan, unele primării cer un aviz de tăiere — un drum scurt la primărie te lămurește.\n\nFond forestier: dacă terenul figurează în acte ca pădure (fond forestier național), regulile se schimbă radical. Scoaterea din fondul forestier e o procedură de excepție — lungă, costisitoare și cu compensări — iar tăierea fără ea înseamnă infracțiune, indiferent că ești proprietar. Aici nu există scurtături: orice intervenție trece prin ocolul silvic și prin amenajament.\n\nCum afli în ce situație ești: verifică extrasul de carte funciară la rubrica de folosință (pădure / pășune / arabil / curți-construcții). La dubii, întreabă ocolul silvic pe raza căruia e terenul — gratuit și rapid.\n\nCe presupune curățarea profesionistă de teren: tăierea și tocarea vegetației, scosul cioatelor (smulgere sau frezare — frezarea mărunțește cioata sub nivelul solului, fără cratere), strângerea și valorificarea materialului lemnos, nivelarea finală. Cu utilaje dedicate, un teren de casă se curăță în zile, nu în săptămâni.\n\nNoi facem [curățare și defrișare de terenuri](/servicii/curatare-terenuri) neforestiere fără suprafață minimă — de la o curte cu câțiva pomi până la hectare întregi — iar dacă terenul tău se dovedește fond forestier, îți spunem direct și te orientăm către procedura corectă, nu către o lucrare care te bagă în belea."),
                'categorie' => 'ghid',
                'imagine' => '/images/galle/proiecte/forwarder-drum-wide.webp',
                'published_at' => now()->subDays(2),
                'is_published' => true,
            ],
        ];

        foreach ($rows as $row) {
            Articol::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
