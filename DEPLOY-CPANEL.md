# DEPLOY fara SSH — galle-silva.com pe ALL-INKL (WebFTP + phpMyAdmin)

> Runbook pentru deploy pe shared hosting **fara SSH, fara terminal, fara Composer, fara Node**.
> Tot ce cere terminal se face LOCAL; pe server doar urci `dist/galle-deploy.zip` prin WebFTP
> (cu „Unpack archives after uploading"), imporți dump-ul DB si rulezi cateva comenzi artisan
> **prin browser** (rutele `/__ops/*`).
>
> Server: `w02183b4.kasserver.com`, PHP **8.4**, MariaDB 10.11. DB: `d0474469` / user `d0474469` / host `localhost`.
> Email: `info@galle-silva.com` (SMTP pe acelasi server, port 587 TLS).
> Pentru varianta cu SSH (git pull) vezi `DEPLOY.md` — acest ghid o inlocuieste cand SSH nu e disponibil.

## 1. Pregatire LOCALA (regenerare artefacte)

Artefactele sunt deja generate (vezi `dist/` si `database/dumps/`), dar pentru un release nou:

```bash
# 1. Stare finala curata in DB + verificari verzi
docker compose exec laravel.test php artisan migrate:fresh --seed
docker compose exec laravel.test vendor/bin/pest          # inainte de --no-dev!

# 2. Dump DB pentru phpMyAdmin (utf8mb4, fara CREATE DATABASE/USE)
docker compose exec mariadb mysqldump --default-character-set=utf8mb4 \
  --no-create-db --add-drop-table -usail -ppassword laravel > database/dumps/galle-prod.sql

# 3. Vendor de productie + asset-uri
docker compose exec laravel.test composer install --no-dev --optimize-autoloader
docker compose exec laravel.test npm run build
rm -f public/hot

# 4. Zip-ul de deploy (continut FARA folder de top; include vendor/, public/build,
#    storage/ cu media 1-8 + structura goala, si .env-ul de prod copiat din .env.prod)
#    — vezi istoricul comenzilor / sesiunea Claude pentru scriptul de staging complet.

# 5. La final, restaureaza pachetele de dev local:
docker compose exec laravel.test composer install
```

**Continutul zip-ului:** tot codul + `vendor/` + `public/build/` + `public/images/` +
`storage/` (media proiectelor `app/public/1..8` + structura goala cu `.gitignore`-uri) +
`.env` **gata completat** (copia `.env.prod`, inclusiv parolele DB/SMTP). **Exclus:** `node_modules`,
`.git`, `tests`, `database/dumps`, `public/hot`, simlink-ul `public/storage` (il creeaza `/__ops/storage-link`),
loguri, cache-uri compilate, sursele de logo din root.

## 2. Upload prin WebFTP

1. WebFTP ALL-INKL → **Upload** → directorul destinatie **`/galle-silva.com/`** →
   alege `dist/galle-deploy.zip` → bifeaza **„Unpack archives after uploading"**.
2. Dupa unpack, in `/galle-silva.com/` trebuie sa existe direct `artisan`, `app/`, `public/`, `vendor/`, `.env`, …

## 3. Doc-root pe `public/`

KAS → setari domeniu `galle-silva.com` → **directorul domeniului = `/galle-silva.com/public`**.

## 4. `.env` (verificare)

`.env`-ul din zip e **gata completat** (DB `d0474469`, SMTP `info@galle-silva.com`, parolele incluse —
copiate din `.env.prod` local). Prin WebFTP doar **verifica** `DB_PASSWORD` si `MAIL_PASSWORD`;
completeaza-le doar daca le-ai schimbat intre timp in KAS.

**NU** atinge `APP_KEY` — e cheia cu care a fost generat dump-ul; daca o schimbi, sesiunile si datele criptate devin invalide.

## 5. Baza de date (phpMyAdmin)

1. phpMyAdmin → selecteaza DB **`d0474469`** → **Import** → `database/dumps/galle-prod.sql`
   (utf8mb4; nu contine `CREATE DATABASE`/`USE`, se importa in baza selectata).
2. Verifica dupa import: tabelele exista, diacriticele arata corect (ex. tabela `articole`, coloana `titlu`).

## 6. Permisiuni

`storage/` (recursiv) si `bootstrap/cache/` trebuie sa fie scriibile de PHP: **755** e de regula
suficient pe KAS (PHP ruleaza ca userul tau); daca apar erori de scriere, pune **775**.

## 7. Comenzi artisan prin browser (`/__ops/*`)

Ruleaza in ordine, in browser:

```
https://galle-silva.com/__ops/storage-link?secret=waddone11
https://galle-silva.com/__ops/config-cache?secret=waddone11
```

- **NU rula** `/__ops/migrate-fresh-seed` — datele sunt deja in dump! Acea ruta STERGE baza de date
  (de aceea cere si `&confirm=RESET-GALLE`).
- Alte rute: `/__ops/cache-clear` (goleste cache-urile), `/__ops/migrate` (migratii noi la update-uri).
- Rutele raspund **404** daca `DEPLOY_OPS_ENABLED` nu e `true` sau secretul e gresit. Fiecare apel e logat cu IP.
- Nu exista `route:cache` — rutele folosesc closures (ar crapa); nu il rula manual niciodata.

## 8. Cron unic (PHP 8.4 CLI)

KAS → Cron, la **fiecare minut**:

```
cd /www/htdocs/w02183b4/galle-silva.com && /usr/bin/php84 artisan schedule:run >> /dev/null 2>&1
```

(scheduler-ul ruleaza sitemap-ul zilnic si coada de email-uri `queue:work --stop-when-empty`).

## 9. Testare + securizare finala

Testeaza: `/` (hero + splitter), `/de` si `/en` (traduceri), `/lemn-de-foc` (calculator + comanda salveaza
in DB), `/admin/login`, `/sitemap.xml`, `/robots.txt`, formularul de contact trimite email pe `info@galle-silva.com`.

Apoi **inchide rutele de deploy**:

1. WebFTP → `.env`: `DEPLOY_OPS_ENABLED=false` si **schimba `DEPLOY_SECRET`** cu un string lung aleator.
2. Acceseaza o ultima data `/__ops/config-cache?secret=waddone11` ca sa se aplice (dupa asta rutele raspund 404).
3. Schimba parola adminului din `/admin` dupa primul login.

HTTPS: activeaza Let's Encrypt din KAS pentru `galle-silva.com` + `www`.

## 10. Update-uri viitoare (re-deploy)

1. Local: build + zip ca la pasul 1 (fara dump nou!).
2. Urca si dezarhiveaza peste fisierele existente, **DAR**:
   - **NU suprascrie `storage/`** — `storage/app/public/` contine pozele urcate din admin!
     (cel mai sigur: scoate `storage/` din zip-ul de update).
   - **NU urca `.env`** peste cel de pe server (are parolele si secretul schimbat).
   - **NU rula** `/__ops/migrate-fresh-seed` si **NU re-importa dump-ul** — ai pierde datele de productie.
3. In `.env` pune temporar `DEPLOY_OPS_ENABLED=true` + sterge manual `bootstrap/cache/config.php`
   din WebFTP (config-ul e cache-uit; stergerea il re-citeste din `.env`).
4. Ruleaza: `/__ops/migrate?secret=…` (schema noua, aditiv) apoi `/__ops/config-cache?secret=…`.
5. La final: `DEPLOY_OPS_ENABLED=false` + `/__ops/config-cache?secret=…`.

## Securitate (OBLIGATORIU de citit)

- **`DEPLOY_SECRET=waddone11` e SLAB si a circulat prin chat/cod** — dupa setup inlocuieste-l
  cu un string lung aleator (ex. `openssl rand -hex 32` local) si nu-l mai scrie nicaieri public.
- **`DEPLOY_OPS_ENABLED=false`** (sau sterge `routes/deploy.php`) imediat dupa setup.
- **Zip-ul si `.env.prod` contin parole reale** (DB + SMTP) — nu le comite in git (sunt gitignored:
  `/dist/`, `.env.prod`, `database/dumps/`), nu le trimite pe canale publice.
- `/__ops/migrate-fresh-seed` **STERGE TOATA BAZA DE DATE** — doar pentru reset complet controlat.
- `APP_KEY` = cheia locala (compatibila cu dump-ul). Daca o rotesti, sesiunile si valorile criptate devin invalide.
