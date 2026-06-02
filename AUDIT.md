# AUDIT — Galle Silva (pre-deploy QA)

> Data: 2026-06-02. Mediu: Windows + Docker Desktop. Stack: Laravel 13, PHP 8.3, MariaDB 10.11, Livewire 4, Filament 5, Tailwind v4.
> Legenda status: **OK** = complet · **PARTIAL** = exista dar incomplet · **LIPSA** = absent.
> Coloana „Dupa FAZA B" reflecta starea dupa reparatii.

## Tabel sintetic

| # | Punct verificat | Inainte | Dupa FAZA B | Note |
|---|---|---|---|---|
| 1 | Asset-uri git-tracked (`public/build`, `public/images/galle`) | **OK** | **OK** | `public/build` = 51 fisiere, `public/images/galle` = 11 fisiere in git. Deploy `git pull` aduce stiluri + poze. |
| 2 | SEO on-page (title, description, canonical, OG, Twitter, lang, hreflang) | **PARTIAL** | **OK** | Lipseau: per-page title/description, `canonical`, `og:image`, `twitter:title/description/image`. Adaugate prin `@props` pe layout + per-pagina. hreflang ro/de/en + x-default existau. |
| 3 | JSON-LD (Organization/LocalBusiness, Product, Service, FAQPage, BreadcrumbList, Article) | **PARTIAL** | **OK** | Doar `Organization` exista. Adaugate: `LocalBusiness` (NAP din Settings) global; `Product` (specii) + `FAQPage` + `BreadcrumbList` pe `/lemn-de-foc`; `Service` + breadcrumb pe `/servicii`; `Article` + breadcrumb pe `/blog/{slug}`; breadcrumb pe proiecte. |
| 4 | GEO/crawl (`sitemap.xml`, `robots.txt`, `llms.txt`) | **OK** | **OK** | `sitemap:generate` (spatie) programat zilnic 03:30; `robots.txt` cu Disallow `/admin` `/livewire`; `llms.txt` factual. NAP din `llms.txt` corectat la valorile din Settings. |
| 5 | Formulare (validare, mesaje RO, anti-spam, UX) | **PARTIAL** | **OK** | Reguli existau; mesaje erau implicit EN, fara honeypot/throttle. Adaugate: honeypot `website`, rate-limit (5/min/IP), mesaje RO complete, UX succes/eroare. |
| 6 | Pagini eroare 404/500 in brand | **LIPSA** | **OK** | Adaugate `errors/404`, `403`, `419`, `429`, `500`, `503` in brand forest/mint, layout standalone. |
| 7 | Favicon + OG default | **PARTIAL** | **OK** | `favicon.ico` exista; lipsea imagine OG default. Adaugata referinta `og:image` → `images/galle/forrest_front.jpg` (asset brand real). |
| 8 | A11y (alt, aria-label, focus, contrast) | **PARTIAL** | **OK** | Imaginile decorative aveau deja `alt=""`; butoanele/iconurile aveau `aria-label`. Adaugat `:focus-visible` global, link WhatsApp din order-form corectat sa foloseasca numarul din Settings. |
| 9 | Performanta/CLS (dimensiuni img, lazy, preload fonturi) | **PARTIAL** | **OK** | Adaugat `width`/`height`+`decoding="async"` pe imaginea mare din footer; `loading="lazy"` deja prezent sub fold. Inaltimile hero/footer sunt fixate in CSS → spatiul e rezervat, fara CLS. Fonturi: self-hosted prin `laravel-vite-plugin` (Bunny build-time, woff2, fara CDN la runtime → GDPR-friendly). Preload font = micro-optimizare optionala, neimplementata. |
| 10 | GDPR (banner cookies + linkuri legale) | **LIPSA** | **OK** | Adaugat banner consimtamant (Alpine + localStorage, fara tracking) cu linkuri `/cookies` si `/confidentialitate`. Paginile legale existau (`/termeni`, `/confidentialitate`, `/cookies`). |
| 11 | Deploy readiness (`DEPLOY.md`, `.env`, `APP_DEBUG`, storage:link) | **OK** | **OK** | `DEPLOY.md` complet (runbook ALL-INKL). `.env.example` fara secrete. Nota productie: setati `APP_ENV=production`, `APP_DEBUG=false` (vezi `DEPLOY.md`). |
| 12 | Locale (switcher, prefixe `/de` `/en`, fallback `ro`) | **OK** | **OK** | `LanguageSwitcher` Livewire activ; prefixe via `SetLocale` middleware; fallback `ro`. |

## Gate-uri NEREZOLVATE (nu inventate — placeholder seed-uite)

Conform regulilor, nu am inventat continut pentru urmatoarele. Raman placeholder-ele din seed/Settings, de confirmat cu clientul inainte de prod:

- **Email exact firma** — folosit consecvent `info@galle-silva.ro` (din `GeneralSettings`). De confirmat adresa finala. (Inainte exista inconsecventa: layout/llms foloseau `contact@galle-silva.ro`; standardizat pe valoarea din Settings.)
- **Unitate & nivel pret lemn** — „lei/metru ster" si intervalele de pret (400–480 lei) raman cele seed-uite; de validat unitatea oficiala si grila finala.
- **Formularea „livrare prin firma lui Razvan"** — neformulata in continut; nu am introdus text despre acest aranjament. De decis copy-ul oficial.
- **Numar telefon/WhatsApp** — `+40 729 961 082` / `40729961082` din Settings (README il marcheaza ca real). Folosit ca atare; de confirmat la go-live.
- **Texte DE/EN** — taburile exista, dar traducerile efective DE/EN nu sunt furnizate (in afara scope, v1.1). Front-ul face fallback pe `ro`.

## Verificari vizuale manuale (pentru om)

Ruleaza `http://localhost` si bifeaza pe desktop (≥1024px) si mobil (<1024px):

### Hero (homepage)
- [ ] Norii se misca lin orizontal (`@keyframes animate`), 5+ nori la inaltimi diferite.
- [ ] „Wheel"-ul (rotorul cu chip-uri orbitand) se roteste continuu; chip-urile raman lizibile.
- [ ] Pill-ul/badge-ul cu gradient conic se invarte (`@property --ang`).
- [ ] Fundalul este padurea reala (`bg_nou.png` / `forrest_back.webp`), nu un placeholder.
- [ ] CTA „Cere oferta" duce la `/contact`.

### Splitter (audienta)
- [ ] Cele doua trasee (Client privat / Firma-institutie) se vad clar si sunt clickabile.

### Carduri
- [ ] Cardurile de servicii/specii au spacing corect, hover vizibil, fara overflow.

### Sectiuni-semnatura
- [ ] „Solutie verde": dome-ul line-art se deseneaza progresiv (`@keyframes draw`).
- [ ] „Durabilitate": split-ul + stat-ul „100%" se afiseaza corect.
- [ ] „Reciclare": simbolul chase animat se invarte continuu (`rec-chase`).

### Footer
- [ ] Straturile de padure (band texturat + silueta `forrest_front`) se suprapun corect, cu silueta reala.
- [ ] Linkurile legale (Termeni/Confidentialitate/Cookies) functioneaza.

### Mobil (<1024px)
- [ ] Hamburger menu deschide/inchide; linkurile navigheaza.
- [ ] Wheel-ul hero este ascuns (nu apare sub 1024px).
- [ ] Sectiunile se stivuiesc vertical, fara scroll orizontal.
- [ ] Banner-ul de cookies apare o singura data si se inchide la accept.
- [ ] Butonul flotant WhatsApp este vizibil si linkul corect.

### Formulare
- [ ] OrderFor­m (`/lemn-de-foc`) si ContactForm (`/contact`): submit valid → mesaj succes RO.
- [ ] Camp gol obligatoriu → mesaj eroare in RO sub camp.

### SEO (view-source)
- [ ] `/` are `<title>`, `meta description`, `canonical`, `og:image`, `link hreflang` ro/de/en.
- [ ] `/lemn-de-foc` contine JSON-LD `Product` + `FAQPage` + `BreadcrumbList`.

## Comenzi de re-verificare

```powershell
docker exec galle-romaniaro-laravel.test-1 ./vendor/bin/pest
docker exec galle-romaniaro-laravel.test-1 ./vendor/bin/pint --test
docker exec galle-romaniaro-laravel.test-1 ./vendor/bin/phpstan analyse --no-progress
docker exec galle-romaniaro-laravel.test-1 php artisan sitemap:generate
docker exec galle-romaniaro-laravel.test-1 npm run build
```
