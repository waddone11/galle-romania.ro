# DEPLOY fara SSH — cPanel/KAS (upload zip + phpMyAdmin)

> Runbook pentru deploy pe shared hosting **fara SSH, fara terminal, fara Composer, fara Node**.
> Tot ce cere terminal se face LOCAL; pe server doar urci fisiere, imporți dump-ul DB
> si rulezi cateva comenzi artisan **prin browser** (rutele `/__ops/*`).
>
> Pentru varianta cu SSH (git pull) vezi `DEPLOY.md` — acest ghid o inlocuieste cand SSH nu e disponibil.

## 0. Ce iti trebuie

- Acces la panoul de hosting (KAS/cPanel): File Manager, Databases, phpMyAdmin, Cron.
- PHP **8.3+** selectat pentru domeniu (din panou).
- Arhiva proiectului + dump-ul `galle-prod.sql` (pasii 1–2).

## 1. Pregatire LOCALA (o singura data per release)

```bash
# 1. Dependinte de productie (fara dev) + autoloader optimizat
docker compose exec laravel.test composer install --no-dev --optimize-autoloader

# 2. Asset-uri Vite (manifest + build comis in repo)
docker compose exec laravel.test npm run build

# 3. Sterge serverul de dev Vite daca a ramas activ (altfel prod ar cauta serverul de dev!)
rm -f public/hot

# 4. Dump-ul DB pentru phpMyAdmin (stare curata, utf8mb4)
docker compose exec laravel.test php artisan migrate:fresh --seed
docker compose exec mariadb mysqldump --default-character-set=utf8mb4 \
  --no-create-db --add-drop-table -usail -ppassword laravel > database/dumps/galle-prod.sql
```

> **Nota:** dupa `composer install --no-dev` mediul local nu mai are pachetele de dev
> (Pest/PHPStan/Pint). Cand reiei dezvoltarea: `composer install`.

## 2. Arhiva zip

Include **`vendor/` si `public/build/`** (prod nu are Composer/Node). Exclude ce nu apartine produsului:

```bash
zip -r galle-deploy.zip . \
  -x "node_modules/*" ".git/*" ".env" ".env.prod" "public/hot" \
     "storage/logs/*" "database/dumps/*" "tests/*" ".playwright-mcp/*" \
     ".idea/*" "*.zip"
```

Verifica inainte de upload ca arhiva contine: `vendor/`, `public/build/manifest.json`,
`public/images/`, `storage/` (cu subdirectoarele goale + `.gitignore`-urile lor), `bootstrap/cache/`.

Urca separat (NU sunt in zip): **`.env.prod`** (devine `.env`, pasul 4).

## 3. Upload + doc-root

1. File Manager: urca `galle-deploy.zip` intr-un director de proiect (ex. `/project/galle/`), dezarhiveaza.
2. Seteaza **document root-ul domeniului pe `…/project/galle/public`** (Domains → doc-root).
   Daca panoul nu permite path custom, fa un symlink al directorului de domeniu catre `project/galle/public`.

## 4. `.env`

1. Urca `.env.prod` in radacina proiectului (langa `artisan`) si **redenumeste-l `.env`**.
2. Completeaza din panoul KAS: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `APP_URL=https://domeniul-tau`.
3. **NU** atinge `APP_KEY` — e cheia cu care a fost generat dump-ul; daca o schimbi, sesiunile si datele criptate devin invalide.
4. **SCHIMBA `DEPLOY_SECRET`** cu un string lung aleator (40+ caractere) — vezi sectiunea Securitate.

## 5. Baza de date (phpMyAdmin)

1. Panou → Databases: creeaza baza + userul (noteaza-le in `.env`).
2. phpMyAdmin → selecteaza baza → Import → `database/dumps/galle-prod.sql` (utf8mb4, fara `CREATE DATABASE`/`USE` — se importa in baza selectata).
3. Verifica dupa import: tabelele exista, iar diacriticele arata corect (ex. tabela `articole`, coloana `titlu`).

## 6. Permisiuni

`storage/` (recursiv) si `bootstrap/cache/` trebuie sa fie scriibile de PHP: **755** de regula
e suficient pe KAS (PHP ruleaza ca userul tau); daca apar erori de scriere, pune **775**.

## 7. Comenzi artisan prin browser (`/__ops/*`)

Ruleaza in ordine, in browser (inlocuieste `SECRET` cu valoarea din `.env`):

```
https://domeniul-tau/__ops/storage-link?secret=SECRET
https://domeniul-tau/__ops/config-cache?secret=SECRET
```

- **NU rula** `/__ops/migrate-fresh-seed` — datele sunt deja in dump! Acea ruta STERGE baza de date
  (de aceea cere si `&confirm=RESET-GALLE`).
- Alte rute disponibile: `/__ops/cache-clear` (goleste cache-urile), `/__ops/migrate` (migratii noi la update-uri).
- Rutele raspund **404** daca `DEPLOY_OPS_ENABLED` nu e `true` sau secretul e gresit. Fiecare apel e logat cu IP.
- Nu exista `route:cache` — rutele folosesc closures (ar crapa); nu il rula manual niciodata.

## 8. Cron unic

Panou → Cron, la **fiecare minut**:

```
cd /www/htdocs/USERUL_TAU/project/galle && /usr/bin/php83 artisan schedule:run >> /dev/null 2>&1
```

(scheduler-ul ruleaza sitemap-ul zilnic si coada de email-uri `queue:work --stop-when-empty`).

## 9. Verificare pe URL de test + securizare

Inainte sa pointezi domeniul final, testeaza pe URL-ul tehnic/de test:

- `/` (hero + splitter), `/de` si `/en` (traduceri), `/lemn-de-foc` (calculator + comanda salveaza in DB),
  `/admin/login`, `/sitemap.xml`, `/robots.txt`, formularul de contact trimite email.

Apoi **inchide rutele de deploy**:

1. `.env`: `DEPLOY_OPS_ENABLED=false`
2. Acceseaza o ultima data `/__ops/config-cache?secret=SECRET` ca sa se aplice (dupa asta rutele raspund 404).

HTTPS: activeaza Let's Encrypt din panou pentru domeniu + www.

## 10. Update-uri viitoare (re-deploy)

1. Local: build + zip ca la pasii 1–2 (fara dump nou!).
2. Urca si dezarhiveaza peste fisierele existente, **DAR**:
   - **NU suprascrie `storage/`** — `storage/app/public/` contine pozele urcate din admin!
     (cel mai sigur: exclude `storage/*` din zip-ul de update).
   - **NU urca `.env`** peste cel de pe server.
   - **NU rula** `/__ops/migrate-fresh-seed` si **NU re-importa dump-ul** — ai pierde datele de productie.
3. In `.env` pune temporar `DEPLOY_OPS_ENABLED=true` (apoi `/__ops/cache-clear?secret=…` ca sa se aplice — sau sterge manual `bootstrap/cache/config.php` din File Manager).
4. Ruleaza: `/__ops/migrate?secret=…` (schema noua, aditiv) apoi `/__ops/config-cache?secret=…`.
5. La final: `DEPLOY_OPS_ENABLED=false` + `/__ops/config-cache?secret=…`.

## Securitate (OBLIGATORIU de citit)

- **`DEPLOY_SECRET=waddone11` din repo e SLAB si a circulat prin chat/cod** — pe server foloseste
  un string lung aleator (ex. `openssl rand -hex 32` local) si nu-l mai scrie nicaieri public.
- **`DEPLOY_OPS_ENABLED=false`** (sau sterge `routes/deploy.php`) imediat dupa setup. Rutele
  raspund 404 cand sunt dezactivate, dar cel mai sigur endpoint e cel care nu exista.
- `/__ops/migrate-fresh-seed` **STERGE TOATA BAZA DE DATE** — exista doar pentru reset complet
  controlat; niciodata pe productie dupa importul initial.
- `APP_KEY` din `.env.prod` = cheia locala (compatibila cu dump-ul). Daca o schimbi, sesiunile
  si orice valoare criptata devin invalide.
- Schimba parola adminului din `/admin` dupa primul login.
