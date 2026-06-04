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

- **T3 — Poze reale + SEO/GEO final + Blog (deploy-ready).** Cele 8 poze procesate (1:1, 1254px, persoane eliminate) sunt optimizate in `public/images/galle/proiecte/` (webp q80 + jpg fallback, varianta patrata 1200px + crop lat 16:9 `-wide`), git-tracked. Mapare: `harvester-galle` (hero exploatare + og:image home), `harvester-lucru` (lucrari silvice), `camion-incarcat` (transport + Cine suntem), `depozit-utilaj` (despre + galerie), `depozit-amurg` (achizitie), `gramada-busteni` (lemn de foc), `busteni-marcati` (achizitie), `forwarder-drum` (curatare). `header_pagina` are camp `imagine` (lat pe desktop, patrat pe mobil prin `<picture media>`); paginile de serviciu + despre au hero foto. **Decizie hero home**: fundalul foto sub stratul de nori animati e invizibil (testat vizual) — hero-ul pastreaza ilustratia custom, poza GALLE e og:image-ul home si hero-ul paginii de exploatare. Blog: 6 articole reale (~350-500 cuvinte, diacritice, interlinking `[text](/url)`, `Article` schema + imagine + og:image). SEO: `WebSite` JSON-LD global, og:image per pagina (camp `og_image` sau imaginea din `header_pagina`), sitemap 39 URL-uri (servicii + 12 landing-uri locale + blog + date-firma). Diacritizare completa: continutul home (seed) + valorile RO ale stringurilor UI (cheile `__()` raman ASCII, `TraducereSeeder` seteaza `valoare.ro` cu diacritice — stabil pentru cod, corect pentru vizitator); textul splitter nu mai contine jargon („flow-uri" → „directii"). Pozele vechi din `proiecte/` (cu persoane vizibile) au fost eliminate; video-ul de depozit ramane.

- **T4 — Traduceri complete DE + EN (tot continutul).** Toate valorile DE/EN sunt completate **direct in seedere** (persista la `migrate:fresh --seed`): cele ~145 chei UI (`TraducereSeeder`, acum cu `firstOrCreate` pentru cheile dinamice — ex. label-uri de enum afisate cu `__($enum->label())`), toate paginile CMS (`PaginaSeeder` — titlu/meta + toate textele din blocurile `sectiuni`, helper `$t(ro, de, en)`), FAQ-urile, cele 6 articole de blog (corp integral), Serviciu/Specie/Certificare/ZonaLivrare/Proiect/Localitate. Germana: ton business, adresare „Sie", terminologie de domeniu (Brennholz, Holzernte, Holzankauf, Rückung, Raummeter/Ster, Polter); termenii RO fara echivalent (APV, SUMAL, CUI, SEAP) raman ca acronime cu o scurta explicatie in limba tinta; brandurile, persoanele si localitatile mici nu se traduc (Bucuresti → Bukarest/Bucharest).
- **T4 — Fix stratul de traduceri (chei cu punct).** `Translator::addLines()` sparge cheile pe `.` (`Arr::set`), deci orice cheie-propozitie (cu punct) nu era gasita la lookup si cadea pe RO — inclusiv diacriticele RO pe footer/cookies. `LoadTraduceri` foloseste acum `handleMissingKeysUsing()` cu potrivire exacta pe map-ul din cache (test de regresie in `ContinutTradusTest`). Coloana `traduceri.cheie` largita la 500 caractere. View-urile care afisau `getTranslation('…', 'ro')` hardcodat (lemn-de-foc, certificari, institutii, proiecte, contact, formulare Livewire) folosesc locale-ul curent cu fallback RO, iar textele statice ramase au fost mutate pe chei `__()`.
- **⚠️ De revizuit (om):** textele juridice traduse (Impressum/„Date firma", etichetele GDPR/cookies) si in general DE-ul pentru piata germana (DSGVO) ar trebui verificate de cineva competent juridic in DE/EN inainte de lansare. Paginile termeni/confidentialitate/cookies inca nu au continut (placeholder tradus); raman pe faza GDPR (F3). Owner-ul poate ajusta orice traducere din `/admin` (taburi RO/DE/EN + resursa Traduceri).

- **T5 — Sectiune certificari pe home (marquee logo-uri + status).** Block CMS nou `certificari` (eyebrow/titlu/subtitlu traductibile; datele vin din modelul `Certificare` — active, ordonate), inserat pe home dupa „De ce Galle" (carduri), inainte de galerie. View `blocks/certificari.blade.php`: banda marquee infinita (CSS pur, `translateX(-50%)`, ~32s, 4 copii ale setului pentru ecrane late), pauza la hover, fade pe margini (`mask-image`), `prefers-reduced-motion` → scroll orizontal fara animatie. Modelul `Certificare` a primit `slug` (unic, backfill din `tip` in migratie), `logo`, `detinator` — editabile din admin. Status pill: `activ` → „Certificat" (mint) + „prin {detinator}"; `in_proces` → „În curs de obținere" (amber), logo estompat (opacity 50%).
  - **Decizie design — carduri verde-inchis, nu albe:** logo-urile primite (FSC, PEFC, RAL) sunt variante albe (pentru fundal inchis), invizibile pe tile alb. Confirmata cu owner-ul varianta cu tile-uri `bg-forest`; sectiunea ramane pe fundal deschis (`bg-mist-warm`). In loc de grayscale→color (logo-urile sunt monocrome), hover = opacitate marita.
  - **Decizii asset-uri:** `fcs.svg` din sursa redenumit `fsc.svg`; PEFC e PNG (`pefc.png`, nu exista SVG in sursa); `dekra.svg` recolorat alb (originalul verde DEKRA avea contrast slab pe forest); **iso-9001/iso-14001 lipseau din sursa** — generate ca badge-uri tipografice SVG (sigiliu „ISO 9001/14001"), confirmate cu owner-ul; logo-ul oficial ISO oricum nu se afiseaza de companiile certificate (trademark ISO). Toate cele 6 in `public/images/certificari/`, git-tracked.
  - **⚠️ FLAG trademark FSC/PEFC:** siglele FSC si PEFC au reguli stricte de utilizare — afisarea lor inainte de finalizarea certificarii poate incalca trademark-ul. Sunt marcate clar „În curs de obținere" si estompate, dar **owner-ul trebuie sa confirme ca are voie sa le afiseze acum**; daca nu, se dezactiveaza din `/admin → Certificari` (toggle `is_active`).
  - **⚠️ De confirmat detinatorul** ISO 9001 / ISO 14001 / RAL / DEKRA: seed-ul zice „prin Galle GmbH" (grupul german), de verificat daca vreuna e pe firma locala — editabil din `/admin → Certificari` (camp `detinator`).

## TODO pentru sectiuni urmatoare

Vezi commits + README updates pe parcurs.
