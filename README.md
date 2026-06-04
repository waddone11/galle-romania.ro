# Galle Silva — galle-silva.ro

Site multilingv (RO/DE/EN) + admin Filament pentru **Galle Silva SRL** — partener local **Galle GmbH Germania**.

- **Client privat** → flow lemn de foc (stejar disponibil; fag, carpen în curând).
- **Firma / institutie** → servicii forestiere, peisagistica, compostare; sectiune dedicata primariilor/institutiilor.

> Productie: `galle-silva.ro` (shared hosting ALL-INKL, PHP 8.3, MariaDB 10.11, fara Redis).
> Repo: `waddone11/galle-romania.ro` (nume istoric, diferit de domeniu).

## Stack

| Componenta | Versiune |
|---|---|
| PHP (runtime container) | 8.3 (pinned pentru paritate cu prod) |
| Laravel | 13.8 |
| Laravel Sail | 1.61 |
| MariaDB | 10.11 (pinned in `compose.yaml` pentru paritate cu prod) |
| Mailpit | latest (dev only) |
| DB / cache / queue / session | `database` driver (fara Redis, paritate prod) |

Pachete adaugate stage-by-stage (vezi commits).

## Cerinte locale (Windows)

- **Docker Desktop** rulat ca daemon. WSL2 backend nu e obligatoriu — proiectul ruleaza nativ pe Windows via `docker compose`. Decizia: a fost preferata locatia `C:\work\galle-romania.ro` (request user) in loc de `~/code/...` in WSL2; performance hit pe NTFS vs ext4 este acceptabil pentru dev.
- **Git** + **GitHub CLI** (`gh auth login` pentru push HTTPS, sau PAT echivalent).

## Setup local (de la zero)

```powershell
git clone https://github.com/waddone11/galle-romania.ro C:\work\galle-romania.ro
cd C:\work\galle-romania.ro
docker compose up -d --build
docker exec galle-romaniaro-laravel.test-1 composer install
docker exec galle-romaniaro-laravel.test-1 php artisan key:generate
docker exec galle-romaniaro-laravel.test-1 php artisan migrate --seed
docker exec galle-romaniaro-laravel.test-1 npm ci
docker exec galle-romaniaro-laravel.test-1 npm run build
```

Aplicatia: `http://localhost`. Mailpit UI: `http://localhost:8025`. Admin: `/admin`.

## Comenzi uzuale

In Windows native (fara wrapper `sail`):

```powershell
docker exec galle-romaniaro-laravel.test-1 php artisan <cmd>
docker exec galle-romaniaro-laravel.test-1 composer <cmd>
docker exec galle-romaniaro-laravel.test-1 npm <cmd>
docker compose down                       # stop stack
docker compose up -d                      # start stack
docker compose logs -f laravel.test       # tail logs
```

## Decizii notabile pana acum

- **PHP 8.3 in container** (nu 8.5 default-ul Sail Laravel 13) — paritate cu prod ALL-INKL.
- **MariaDB 10.11** (nu 11 default-ul Sail) — paritate cu prod ALL-INKL.
- **Fara Redis** — `QUEUE_CONNECTION/CACHE_STORE/SESSION_DRIVER=database` ca pe prod.
- **APP_LOCALE=ro** ca limba principala.
- **`compose.yaml`** (nume modern, livrat de Sail) in loc de `docker-compose.yml`.
- **Nume container app**: `galle-romaniaro-laravel.test-1` (auto-generated de Docker Compose pe baza folder name `galle-romania.ro` cu punctul si dash-ul stripped).
- Runtime container: Windows native, NU WSL2 — user a cerut explicit `C:\work`.
- **`public/build/` este comis in repo** — ALL-INKL nu are Node, deci deploy-ul = `git pull` clean. Workflow re-build local: `npm run build` apoi `git add public/build && git commit`. Vezi `DEPLOY.md §6`.
- **Filament v5 + Translatable Tabs nativi** — pattern-ul `Filament\Schemas\Components\Tabs` cu camp-uri `field.{locale}` (ro/de/en) este aplicat pe toate 8 Resources de continut (Specie, Serviciu, Proiect, Articol, Certificare, Faq, ZonaLivrare, Pagina) prin helper-ul `App\Filament\Concerns\HasTranslatableTabs`. Editor poate trece intre RO/DE/EN si scrie direct in coloana JSON spatie/translatable.
- **`Pagina.sectiuni` ruleaza pe Filament Builder** cu 10 blocuri: `hero`, `text_imagine`, `splitter`, `carduri`, `cta`, `galerie`, `faq` + cele 3 sectiuni-semnatura `solutie_verde` (dome line-art), `durabilitate_stat` (split + stat 100%) si `reciclare` (simbol animat). Continut textual din fiecare bloc este traductibil (taburi RO/DE/EN). Front: `resources/views/blocks/*.blade.php`.
- **Homepage = 100% CMS-driven.** `resources/views/site/home.blade.php` randeaza exclusiv `Pagina[slug=home].sectiuni`. Fluxul seed-uit (1:1 cu `design/index.html`): `hero → splitter → carduri → solutie_verde → durabilitate_stat → reciclare → cta`. Editabil din `/admin → Pagina = home`.
- **Design real portat (P-FRONT, fidelitate 1:1).** Sursa: `design/index.html` + `design/img/`. Asset-uri reale in `public/images/galle/` (`bg_nou.png`, `forrest_back.webp`, `forrest_front.{webp,jpg,png}`, `cloud1..5.png`, `union.svg`). Animatiile (nori `@keyframes animate`, pill conic-gradient `@property --ang`, wheel `orbit`, footer `forest-band`, eco-svg line-art `draw`, reciclare `rec-chase`) sunt CSS pur in `app.css`, fara librarii externe. Wheel-ul e ascuns sub 1024px. Dome-ul "verde" foloseste varianta hand-coded line-art (nu export-ul SVGator cu JS embed din template) ca sa respecte regula "fara librarii de animatie".
- **NAP/contact din `GeneralSettings`** (footer + WhatsApp flotant): tel/WhatsApp `+40 729 961 082`, email `info@galle-silva.ro`, adresa `Manesti, Str. Principala 302, jud. Prahova`.
- **SEO/GEO complet (P-QA+).** Layout cu `@props` per-pagina (title, meta description, canonical, OG + Twitter, og:image default `forrest_front.jpg`), hreflang ro/de/en + x-default. JSON-LD: `LocalBusiness` global (NAP din Settings) + `Product`/`FAQPage`/`BreadcrumbList` pe `/lemn-de-foc`, `Service` pe `/servicii`, `Article` pe blog, breadcrumb pe detalii. Componenta reutilizabila `<x-json-ld>`. `sitemap:generate` (spatie) programat zilnic; `robots.txt` + `public/llms.txt` factual (NAP corectat).
- **Hardening publice (P-QA+).** Anti-spam pe OrderForm/ContactForm: honeypot `website` + rate-limit 5/min/IP (trait `App\Livewire\Concerns\HasSpamProtection`), mesaje de validare in RO. Banner GDPR cookies (Alpine + localStorage, fara tracking). Pagini eroare in brand (`errors/404,403,419,429,500,503`). `:focus-visible` global + skip-link + `[x-cloak]`.
- **PHPStan level 5 = 0 erori** pe `app/` + `database/`. Pint trecut. Pest 21/21 verzi (8 site + 11 QA hardening + 2 example).
- **Audit pre-deploy: vezi `AUDIT.md`** (tabel statusuri + checklist vizual pentru om + gate-uri nerezolvate).
- **T2 — Servicii ca pagini CMS (slug-based).** Cele 6 servicii (`exploatare-forestiera`, `achizitie-masa-lemnoasa`, `curatare-terenuri`, `transport-lemn`, `lucrari-silvice` + `/lemn-de-foc`) sunt `Pagina` randate prin `SiteController::serviciuPage()` din view-ul generic `site/pagina.blade.php`, cu JSON-LD `Service` + `FAQPage` (din `Faq` cu `categorie = slug`) + `BreadcrumbList`. Vechile `/servicii/forestiere|peisagistica|compostare` fac 301 (forestiere → exploatare-forestiera, restul → /servicii). Blocuri noi in Builder: `header_pagina` (H1 + intro) si `sectiune_text` (H2 + continut; link-uri interne in stil markdown `[text](/url)`, restul HTML-ului escapat). Modelul `Serviciu` ramane doar pentru pagina `/institutii`.
- **T2 — Landing-uri locale `/lemn-de-foc/{localitate}`.** Model `Localitate` (nume, slug, judet, `intro` translatable, is_active, ordine) + resursa Filament `Localitati (landing)`. 12 seed-uri (10 Prahova + Bucuresti + Ilfov), fiecare cu intro unic despre zona (anti thin-content). H1/title/meta localizate, restul continutului mostenit de pe `/lemn-de-foc`, `rel=canonical` catre `/lemn-de-foc`, prezente in sitemap.
- **T2 — Decizii de continut**: carpen trecut „pe stoc" la 350 lei (sustine claim-ul „de la 350 lei/m³" din research); FAQ-urile vechi de lemn de foc/livrare/plata au fost rescrise ca sa nu contrazica noile conditii (1–3 zile, max 7; cash/POS/transfer); continutul nou seed-uit e cu diacritice, DE/EN raman `null` (le completeaza owner-ul din taburile admin); textele home existente nu au fost diacritizate (doar relinkuite) — de uniformizat in T3 daca se doreste.
- **Pagini legale (`/confidentialitate`, `/cookies`, `/termeni`) seed-uite cu continut RO** (blocuri `sectiune_text` in `PaginaSeeder`, randate prin `site/legal.blade.php`). DE/EN raman `null` (fallback pe RO) si se completeaza ulterior din `/admin`. ⚠️ **ATENTIE: textele legale (RO + viitoarele DE/EN) sunt un DRAFT de lucru, NU consultanta juridica — trebuie revizuite de cineva competent (avocat/consultant GDPR) inainte de lansarea publica, in special versiunea germana (DSGVO).** Pagina `/despre` include povestea grupului Galle GmbH (fondat 1990, Elbe-Elster, Brandenburg; 30+ ani, ~38 angajati, sigilii RAL) — mentiunea istorica „25 de ani" a fost eliminata peste tot.
- **Recenzii — doar reale, fara seed.** Model `Recenzie` (tabela `recenzii`: nume_client, localitate, rating 1–5 optional, text in limba originala a clientului — NEtraductibil, serviciu, data, sursa, avatar optional, `is_published` default **false**, ordine) + resursa Filament `Recenzii` (grup Continut, `/admin/recenzii`) + bloc CMS `recenzii` (filtru serviciu + limita; titlu/eyebrow traductibile). Blocul e seed-uit pe home dupa `certificari`; **daca nu exista recenzii publicate, sectiunea nu se randeaza deloc**. JSON-LD emis din bloc: `LocalBusiness.review[]` per recenzie publicata (`reviewRating` doar daca exista rating) + `AggregateRating` calculat din rating-uri reale **doar daca ≥ 3 recenzii publicate au rating** — fara medii inventate. NU exista `RecenzieSeeder` (testimonialele false = inselatoare + risc penalizare Google); factory-ul e doar pentru teste (default nepublicat). Teste: `tests/Feature/RecenziiTest.php` (11 teste — publicare/depublicare, sectiune ascunsa, ordine, schema Review/AggregateRating, default DB false, acces admin).
- **Vizibilitate blog + proiecte + echipa (CMS).** Navbar restructurat: primarele raman `Acasa / Servicii / Lemn de foc / Despre / Contact` + CTA, iar secundarele (`Proiecte`, `Blog`, `Certificari`, `Intrebari frecvente`) stau intr-un dropdown **„Resurse"** (Alpine, click-outside, aria-expanded; pe mobil grup plat sub eticheta „Resurse"). Footer are si link `Blog`. Home primeste 2 teasere CMS noi: `proiecte_recente` (ultimele 3 proiecte publicate, cu cover, dupa `galerie`) si `blog_recent` (ultimele 3 articole, inainte de CTA final) — texte titlu/eyebrow traductibile (RO seed; DE/EN din admin). **Galeria `Proiect` e cablata end-to-end pe medialibrary**: upload multiplu/reorderable in `ProiectForm` (plugin `filament/spatie-laravel-media-library-plugin`), conversii `card` (800x450 crop) + `mare` (1600 max) non-queued, cover real pe `/proiecte`, galerie completa pe `/proiecte/{slug}` (lazy + width/height anti-CLS, placeholder elegant fara imagini); `ProiectSeeder` ataseaza idempotent 2–3 poze reale din `public/images/galle/proiecte/` (`preservingOriginal`). **Echipa de pe `/despre` vine din modelul `Membru`** (nume NEtraductibil, `rol` translatable RO/DE/EN, poza optionala, ordine, is_active) + resursa Filament `Echipa` (grup Continut) + bloc CMS `echipa` (foto rotunda sau avatar cu initiale; blocul `carduri` de pe home neatins). Pozele de echipa se incarca din admin — lista in `docs/poze-necesare.md`. ⚠️ **Deploy ALL-INKL**: imaginile urcate din admin (galerii proiecte, poze echipa) traiesc in `storage/app/public/` — e nevoie de `php artisan storage:link` si de **persistarea `storage/app/public/` intre deploy-uri** (altfel se pierd; vezi `DEPLOY.md`). Pozele seed-uite raman in git (`public/images/`).

## Credentiale admin (seed local)

```
URL:      http://localhost/admin (sau /autentificare — login front-end cu redirect pe rol)
Email:    ADMIN_EMAIL din .env (fallback: avasilescu1985@gmail.com)
Parola:   ADMIN_PASSWORD din .env (fallback: jamaica6)
Nume:     Adrian Vasilescu
Rol:      role=admin (gate panou) + super_admin (filament-shield, permisiuni per-resursa)
```

> Seeder: `database/seeders/AdminUserSeeder.php` (`updateOrCreate` — idempotent, nu duplica la re-seed).
> Decizie: promptul cerea un `UserSeeder` nou, dar exista deja `AdminUserSeeder` apelat din
> `DatabaseSeeder` si referit in teste — l-am refolosit, nu l-am dublat.
> Roluri Spatie seed-uite: `super_admin`, `admin`, `editor`.

### Auth front-end (login + register, Livewire)

- **Rute** (in `$siteRoutes`, deci si pe `/de` `/en`): `/autentificare` (name `login`), `/inregistrare` (name `register`), `/logout` (POST, name `logout`).
- **Rol — o singura sursa de adevar pentru gate-ul panoului:** coloana `users.role` (`admin` | `client`, default `client`); `canAccessPanel()` = `role === 'admin'`. Permisiunile fine din panou raman pe Spatie/Shield (adminul seed-uit are si rolul `super_admin`). `role` NU e mass-assignable (anti escaladare la register).
- **Login** (`App\Livewire\Auth\Login`): throttle 5 incercari/min pe email+IP, mesaje generice (nu dezvaluie daca emailul exista), `session()->regenerate()`, redirect pe rol: admin → `/admin`, client → home in locale-ul curent.
- **Register** (`App\Livewire\Auth\Register`): nume + email unic + parola min 8 confirmata; user nou = `client`; login automat + redirect home.
- **Footer**: linkuri discrete pe stare — guest: Autentificare + Cont nou; client: Iesire; admin: Admin + Iesire (logout = form POST cu `@csrf`).

### ⚠️ Flag-uri de securitate (de rezolvat inainte de productie)

- **Parola fallback (`jamaica6`) e slaba si e comisa in git** (seeder + acest README). Inainte de productie: seteaza `ADMIN_PASSWORD` doar in `.env` (necomis), scoate fallback-ul plaintext din `AdminUserSeeder`, si **schimba parola dupa primul login**.
- **Linkul „Admin" din footer** apare doar pentru admini autentificati, dar `/admin` ramane accesibil public (pagina de login Filament). Recomandat la lansare: rate-limit/IP-allowlist pe `/admin`.
- **Inregistrarea publica e activa**; conturile `client` nu au inca o zona dedicata (ajung pe home) — utila pe viitor (ex. istoric comenzi). Daca nu vrei register public la lansare, scoate ruta `/inregistrare` + linkul din footer.
- **Verificarea email si resetarea parolei NU sunt incluse** (optionale) — se adauga cand e configurat SMTP. `email_verified_at` e setat din seeder doar pentru admin.
- Un client autentificat care intra pe `/admin` primeste 403 (Filament, `canAccessPanel` false) — redirectul spre home era optional, nu l-am implementat.
- **Rutele de deploy `/__ops/*` (`routes/deploy.php`)**: exista DOAR pentru prod fara SSH. `DEPLOY_SECRET=waddone11` din repo/chat e **slab si compromis** — pe server se inlocuieste cu un string lung aleator (`openssl rand -hex 32`). Dupa setup: `DEPLOY_OPS_ENABLED=false` (sau sterge `routes/deploy.php`) + re-ruleaza config-cache. Ruta `migrate-fresh-seed` **STERGE toata baza de date** (cere `&confirm=RESET-GALLE`) — niciodata pe prod dupa importul initial. Detalii in `DEPLOY-CPANEL.md`.
- **APP_KEY partajata local↔prod** (`.env.prod` copiaza cheia locala, intentionat — compatibilitate cu dump-ul). Daca se roteste pe prod, sesiunile si valorile criptate devin invalide.

- **T3 — Poze reale + SEO/GEO final + Blog (deploy-ready).** Cele 8 poze procesate (1:1, 1254px, persoane eliminate) sunt optimizate in `public/images/galle/proiecte/` (webp q80 + jpg fallback, varianta patrata 1200px + crop lat 16:9 `-wide`), git-tracked. Mapare: `harvester-galle` (hero exploatare + og:image home), `harvester-lucru` (lucrari silvice), `camion-incarcat` (transport + Cine suntem), `depozit-utilaj` (despre + galerie), `depozit-amurg` (achizitie), `gramada-busteni` (lemn de foc), `busteni-marcati` (achizitie), `forwarder-drum` (curatare). `header_pagina` are camp `imagine` (lat pe desktop, patrat pe mobil prin `<picture media>`); paginile de serviciu + despre au hero foto. **Decizie hero home**: fundalul foto sub stratul de nori animati e invizibil (testat vizual) — hero-ul pastreaza ilustratia custom, poza GALLE e og:image-ul home si hero-ul paginii de exploatare. Blog: 6 articole reale (~350-500 cuvinte, diacritice, interlinking `[text](/url)`, `Article` schema + imagine + og:image). SEO: `WebSite` JSON-LD global, og:image per pagina (camp `og_image` sau imaginea din `header_pagina`), sitemap 39 URL-uri (servicii + 12 landing-uri locale + blog + date-firma). Diacritizare completa: continutul home (seed) + valorile RO ale stringurilor UI (cheile `__()` raman ASCII, `TraducereSeeder` seteaza `valoare.ro` cu diacritice — stabil pentru cod, corect pentru vizitator); textul splitter nu mai contine jargon („flow-uri" → „directii"). Pozele vechi din `proiecte/` (cu persoane vizibile) au fost eliminate; video-ul de depozit ramane.

- **T4 — Traduceri complete DE + EN (tot continutul).** Toate valorile DE/EN sunt completate **direct in seedere** (persista la `migrate:fresh --seed`): cele ~145 chei UI (`TraducereSeeder`, acum cu `firstOrCreate` pentru cheile dinamice — ex. label-uri de enum afisate cu `__($enum->label())`), toate paginile CMS (`PaginaSeeder` — titlu/meta + toate textele din blocurile `sectiuni`, helper `$t(ro, de, en)`), FAQ-urile, cele 6 articole de blog (corp integral), Serviciu/Specie/Certificare/ZonaLivrare/Proiect/Localitate. Germana: ton business, adresare „Sie", terminologie de domeniu (Brennholz, Holzernte, Holzankauf, Rückung, Raummeter/Ster, Polter); termenii RO fara echivalent (APV, SUMAL, CUI, SEAP) raman ca acronime cu o scurta explicatie in limba tinta; brandurile, persoanele si localitatile mici nu se traduc (Bucuresti → Bukarest/Bucharest).
- **T4 — Fix stratul de traduceri (chei cu punct).** `Translator::addLines()` sparge cheile pe `.` (`Arr::set`), deci orice cheie-propozitie (cu punct) nu era gasita la lookup si cadea pe RO — inclusiv diacriticele RO pe footer/cookies. `LoadTraduceri` foloseste acum `handleMissingKeysUsing()` cu potrivire exacta pe map-ul din cache (test de regresie in `ContinutTradusTest`). Coloana `traduceri.cheie` largita la 500 caractere. View-urile care afisau `getTranslation('…', 'ro')` hardcodat (lemn-de-foc, certificari, institutii, proiecte, contact, formulare Livewire) folosesc locale-ul curent cu fallback RO, iar textele statice ramase au fost mutate pe chei `__()`.
- **⚠️ De revizuit (om):** textele juridice traduse (Impressum/„Date firma", etichetele GDPR/cookies) si in general DE-ul pentru piata germana (DSGVO) ar trebui verificate de cineva competent juridic in DE/EN inainte de lansare. Paginile termeni/confidentialitate/cookies inca nu au continut (placeholder tradus); raman pe faza GDPR (F3). Owner-ul poate ajusta orice traducere din `/admin` (taburi RO/DE/EN + resursa Traduceri).

- **T5 — Sectiune certificari pe home (marquee logo-uri + status).** Block CMS nou `certificari` (eyebrow/titlu/subtitlu traductibile; datele vin din modelul `Certificare` — active, ordonate), inserat pe home dupa „De ce Galle" (carduri), inainte de galerie. View `blocks/certificari.blade.php`: banda marquee infinita (CSS pur, `translateX(-50%)`, ~32s, 4 copii ale setului pentru ecrane late), pauza la hover, fade pe margini (`mask-image`), `prefers-reduced-motion` → scroll orizontal fara animatie. Modelul `Certificare` a primit `slug` (unic, backfill din `tip` in migratie), `logo`, `detinator` — editabile din admin. Status pill: `activ` → „Certificat" (mint) + „prin {detinator}"; `in_proces` → „În curs de obținere" (amber), logo estompat (opacity 50%).
  - **Decizie design — carduri verde-inchis, nu albe:** logo-urile primite (FSC, PEFC, RAL) sunt variante albe (pentru fundal inchis), invizibile pe tile alb. Confirmata cu owner-ul varianta cu tile-uri `bg-forest`; sectiunea ramane pe fundal deschis (`bg-mist-warm`). In loc de grayscale→color (logo-urile sunt monocrome), hover = opacitate marita.
  - **Decizii asset-uri:** `fcs.svg` din sursa redenumit `fsc.svg`; PEFC e PNG (`pefc.png`, nu exista SVG in sursa); `dekra.svg` recolorat alb (originalul verde DEKRA avea contrast slab pe forest); **iso-9001/iso-14001 lipseau din sursa** — generate ca badge-uri tipografice SVG (sigiliu „ISO 9001/14001"), confirmate cu owner-ul; logo-ul oficial ISO oricum nu se afiseaza de companiile certificate (trademark ISO). Toate cele 6 in `public/images/certificari/`, git-tracked.
  - **⚠️ FLAG trademark FSC/PEFC:** siglele FSC si PEFC au reguli stricte de utilizare — afisarea lor inainte de finalizarea certificarii poate incalca trademark-ul. Sunt marcate clar „În curs de obținere" si estompate, dar **owner-ul trebuie sa confirme ca are voie sa le afiseze acum**; daca nu, se dezactiveaza din `/admin → Certificari` (toggle `is_active`).
  - **⚠️ De confirmat detinatorul** ISO 9001 / ISO 14001 / RAL / DEKRA: seed-ul zice „prin Galle GmbH" (grupul german), de verificat daca vreuna e pe firma locala — editabil din `/admin → Certificari` (camp `detinator`).
- **T5 — Certificari consecvente pe /certificari + /despre (componenta partajata).** Cardul de certificare e extras in componenta Blade `x-certificare-card` cu prop `variant`: `marquee` (home, markup identic cu cel de dinainte — zero regresii vizuale), `detail` (/certificari: logo + nume + status pill + descriere + emitent + detinator) si `compact` (/despre: tile mic logo + nume + status). Toate variantele stau pe card `bg-forest` (logo-urile sunt variante albe — vezi decizia de design de mai sus; echivalentul „grayscale" pentru in-proces ramane opacitatea 50%). `/certificari` listeaza toate certificarile active ca grid responsive (1 col mobil / 2 desktop), grupate clar: „Certificări ale grupului Galle GmbH" (status `activ`) si „În proces de certificare" (FSC + PEFC); titlu/meta vin din `Pagina[slug=certificari]` (editabile din admin), sectiunea educationala FSC vs ISO ramane. `/despre` are banda compacta de certificari (grid 2/3/6 coloane) + link „Vezi toate certificarile" → `/certificari`. Descrierile din `CertificareSeeder` au fost rescrise mai explicit (ce e standardul + cine il detine, RO cu diacritice + DE/EN) si **seed-ul completeaza descrierea per limba doar daca e goala** — editarile din `/admin → Certificari` nu mai sunt suprascrise la re-seed (test de regresie in `CertificariPageTest`). FLAG-ul de trademark FSC/PEFC de mai sus ramane valabil si pe `/certificari`.

- **Date firma centralizate (`config/company.php`).** Datele legale (denumire, CUI, Reg. Com., EUID, CAEN, data infiintarii, sediu, administrator, telefon, email) stau in `config/company.php` cu default-urile reale (date publice de registru) si override din `.env` (chei `COMPANY_*`, comentate in `.env.example` — nu le lasa goale, `env()` ar suprascrie default-ul cu sir gol). Consumatori: footer (linie legala discreta), `/date-firma` (Impressum integral din config), `/confidentialitate` (operator + persoana de contact, prin seed), JSON-LD global (`legalName`/`taxID`/`foundingDate`/`address` cu `postalCode`). NAP-ul (telefon/email/adresa) ramane editabil din admin prin `GeneralSettings`; migrarea `align_general_settings_nap` aliniaza doar placeholder-ele initiale cu config-ul, fara sa calce editarile din admin. Dupa modificarea `COMPANY_*` pe server: `php artisan config:cache`.
  - **⚠️ FLAG TVA:** directorul ONRC indica „platitor TVA / TVA la incasare / split TVA". `COMPANY_VAT` ramane `false` pana confirma contabilul; cand devine `true`, codul fiscal se afiseaza automat `RO52771440` (Impressum + `taxID` in schema).
  - **⚠️ FLAG administrator vs reprezentant:** la registru „administrator" = Ion Narcis Marin (default in config, afisat pe Impressum + contact GDPR); pe site „manager general" = Razvan Solzaru. De confirmat cine e reprezentantul legal si ajustat `COMPANY_ADMIN` daca e cazul.
  - Al doilea numar de mobil (incomplet) din registru NU se publica. Textele legale raman de revizuit de cineva competent (DSGVO) — vezi flag-ul T4.

- **Restilizare /intrebari-frecvente — centru de ajutor modern.** Pagina FAQ a fost redesenata complet (`site/faq.blade.php`): hero forest cu subtitlu (titlu/intro raman editabile din CMS — blocul `header_pagina` al Paginii e consumat manual de view pentru hero-ul custom; alte blocuri adaugate pe pagina NU se mai randeaza generic), search box flotant peste marginea benzii (rounded-full, lupa, contor live „X intrebari / X rezultate” cu `aria-live`), layout desktop pe 2 coloane: rail sticky de categorii (icon `x-galle-icon` + nume + badge numar, evidentiere mint prin scroll-spy cu IntersectionObserver, click → scroll lin care respecta `prefers-reduced-motion`) / pe mobil pills orizontale scrollabile sticky sub navbar (snap-x, no-scrollbar). Carduri acordeon: `bg-white rounded-2xl ring-1`, hover lift (`motion-safe:`), buton rotund mint cu chevron rotit la deschidere, accent `border-l` mint, dezvaluire lina prin animatie pe `grid-template-rows` (`[0fr]→[1fr]`, fara plugin Alpine), buton real cu `aria-expanded`/`aria-controls`, implicit toate inchise + „Deschide toate / Inchide toate” (eveniment window `faq-toate`). Filtru live cu normalizare diacritice (NFD pe ambele parti), ascunde categoriile fara rezultate, empty state cu „Sterge cautarea” + link contact, CTA banner forest cu „Scrie-ne” si „Cere oferta” → /contact. Teaserul FAQ de pe home (`blocks/faq.blade.php`) foloseste acelasi stil de card (consecventa). Icoane noi in `x-galle-icon`: `card` (plata), `intrebare` (general). FAQPage JSON-LD + rutele pe 3 locale neatinse; teste extinse in `FaqPageTest` (search/ancore/rail, ordine categorii, toggle-all/empty-state/CTA, teaser home). Verificat vizual cu Playwright (desktop + mobil + filtru + empty state + cautare fara diacritice).
- **Home teasere FAQ + Blog ca split 50/50 (in stilul `durabilitate_stat`), cu verdele alternand.** Blocul `faq` are acum doua moduri: `split` (home: panou `bg-forest` pe DREAPTA cu typo display „FAQ?" — accent mint pe „?" —, subtitlu traductibil + buton spre `/intrebari-frecvente`; 6 acordeon-carduri pe alb in stanga) si modul clasic (paginile de servicii, neatinse). Cardul-acordeon e extras in partialul comun `blocks/partials/faq-card-list.blade.php` (acelasi markup ca `/intrebari-frecvente`). `blog_recent` e split in oglinda (verde pe STANGA, „BLOG." + „Ghiduri & noutati" mint + buton spre `/blog`; 4 articole in grid 2x2 pe alb, anti-CLS pastrat). Pe mobil ambele se stivuiesc cu panoul verde sus, compact. Ordinea home ramane `durabilitate_stat (verde stanga) → faq (verde dreapta) → blog_recent (verde stanga) → cta` — zig-zag coerent.
- **Pozele de blog generate (10/10).** `public/images/blog/{slug}.webp+jpg` (1254x705) generate cu Gemini „nano-banana" dupa conceptele din `docs/blog-imagini-necesare.md` — fara persoane, fara text. `ArticolSeeder` le ataseaza automat (path in DB la seed). Inlocuirea unei poze = suprascrii fisierele, fara re-seed.

- **Traduceri DE/EN complete pentru tot continutul nou (sesiunea deploy).** Zero scurgeri RO pe `/de` si `/en` (verificat automat pe toate cele ~48 pagini × 2 limbi): cele 10 articole extinse de blog au corp integral DE+EN (`data/blog/{slug}.de.md` / `.en.md`, titlu/excerpt in `blog.json` — `ArticolSeeder` le incarca), cele 18 FAQ-uri din `faq.json` (campuri `intrebare_de/en`, `raspuns_de/en`), paginile legale termeni/confidentialitate/cookies + despre (povestea grupului) + blocul certificari de pe home + pagina `/intrebari-frecvente` (`PaginaSeeder`), cheile UI de autentificare (`TraducereSeeder`). Breadcrumb-urile JSON-LD folosesc `__('Acasa')` + prefixul de limba (controller + blade-urile articol/proiect/lemn-de-foc). Exonime: `Localitate::numeLocalizat()` — București → Bukarest/Bucharest pe paginile de localitate; restul localitatilor/persoanelor raman netraduse. Termenii „partidă"/„parchet" apar intentionat citati (cu glosa) in DE/EN. Texte juridice traduse = traducere de lucru, de revizuit juridic (vezi flag T4).
- **Deploy fara SSH (cPanel/KAS).** `DEPLOY-CPANEL.md` = runbook complet (zip cu `vendor/`+`public/build`, import `database/dumps/galle-prod.sql` in phpMyAdmin, `.env.prod` → `.env`, rute `/__ops/*` pentru artisan prin browser, cron unic). `config/deploy.php` + `routes/deploy.php` + `DeployOpsGate` (404 fara secret/enabled, log cu IP, `hash_equals`; teste in `DeployOpsTest`). NU exista `route:cache` in flux — rutele au closures. Dump-ul si `.env.prod` sunt gitignored.

## TODO pentru sectiuni urmatoare

Vezi commits + README updates pe parcurs.
