# DEPLOY — galle-silva.ro pe ALL-INKL

> Acest document NU declanseaza deploy. E un runbook pas-cu-pas pentru deployerul uman.

## Prerequisite server

- Provider: ALL-INKL.com
- Host: `w02183b4.kasserver.com` (IP `85.13.162.54`)
- DNS: NS5 / NS6.kasserver.com
- PHP CLI: **8.3** selectabil (`/usr/bin/php83`)
- MariaDB 10.11 (1 baza disponibila)
- Cron-uri: 1 disponibil
- Fara Redis, fara Node runtime, fara SSH-root
- Web root planificat: `/www/htdocs/w02183b4/`

## Sesiune SSH initiala

Dupa ce ai SSH activat din panoul KAS:

```bash
ssh w02183b4@w02183b4.kasserver.com
```

In `.user_bashrc`:

```bash
# selecteaza PHP 8.3 ca default pentru CLI
ln -sfv /usr/bin/php83 /usr/bin/php
```

`source .user_bashrc` (sau logout + login). Verifica: `php -v` → `PHP 8.3.x`.

## 1. Clone repo

`laravel new` NU functioneaza pe ALL-INKL (chroot). Folosim git clone direct.

```bash
cd /www/htdocs/w02183b4/
mkdir -p project
cd project
git clone https://github.com/waddone11/galle-romania.ro galle
cd galle
composer install --no-dev --optimize-autoloader
```

## 2. Doc-root pe `public/`

Doua optiuni in panoul KAS — alege una:

**Optiunea A (cleaner):** Configureaza in KAS `Domains → galle-silva.ro → Document root` ca fiind `/project/galle/public`.

**Optiunea B (symlink):** Daca KAS nu permite path custom:

```bash
cd /www/htdocs/w02183b4/
rm -rf galle-silva.ro              # cu grija — sterge orice exista acolo!
ln -s project/galle/public galle-silva.ro
```

## 3. `.env.production`

Copiaza `.env.example` → `.env`, apoi editeaza:

```env
APP_NAME="Galle Silva"
APP_ENV=production
APP_KEY=                  # genereaza cu: php artisan key:generate
APP_DEBUG=false
APP_URL=https://galle-silva.ro
APP_LOCALE=ro
APP_FALLBACK_LOCALE=ro

LOG_CHANNEL=stack
LOG_LEVEL=warning

DB_CONNECTION=mariadb
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=d02183b4_galle
DB_USERNAME=d02183b4_galle
DB_PASSWORD=               # din panoul KAS

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=w02183b4.kasserver.com
MAIL_PORT=587
MAIL_USERNAME=noreply@galle-silva.ro
MAIL_PASSWORD=             # din panoul KAS
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@galle-silva.ro
MAIL_FROM_NAME="Galle Silva"
```

Apoi:

```bash
php artisan key:generate
php artisan storage:link
```

## 4. Migrate + seed

```bash
php artisan migrate --force
php artisan db:seed --class=Database\\Seeders\\AdminUserSeeder --force
php artisan db:seed --force        # poate include seedere existente (idempotent)
```

Verifica admin: `https://galle-silva.ro/admin/login` cu `admin@galle-silva.ro` / parola seed. **Schimba parola imediat dupa primul login.**

## 5. Caches productie

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

(NU `event:cache` daca foloseste reflection complexa pe handlers.)

## 6. Assets (Vite buildat local si comise in repo)

**Decizie:** ALL-INKL nu are Node — deci `public/build/` este **comis in repo** (vezi `.gitignore`).
Avantaj: deploy-ul = `git pull` curat, fara upload separat de assets.
Cost: cresc git diffs cand assets se schimba (acceptabil pentru un proiect cu schimbari rare de UI).

Workflow re-build:

```bash
# pe masina locala / dev:
npm ci
npm run build
git add public/build && git commit -m "build: refresh Vite assets"
git push
```

Pe server, dupa `git pull`, assets sunt deja in `public/build/` — Vite manifest e citit de helper-ul `@vite()` la randare. **Nu mai e nevoie de rsync separat.**

Daca preferi CI (GitHub Actions cu Node + git push automat al `public/build`), e o variatie posibila — dar pentru un proiect cu echipa mica, comiterea directa e cea mai simpla.

## 7. Cron unic ALL-INKL

In panoul KAS → Cron, adauga **un singur** cron, pe `* * * * *`:

```
cd /www/htdocs/w02183b4/project/galle && /usr/bin/php83 artisan schedule:run >> /dev/null 2>&1
```

In `routes/console.php` se adauga (deja prezent in repo dupa nevoie):

```php
Schedule::command('sitemap:generate')->daily();
Schedule::command('queue:work --stop-when-empty --tries=3 --timeout=120')->everyMinute()->withoutOverlapping();
```

`queue:work --stop-when-empty` se opreste cand coada e goala — perfect pe scheduler.

## 8. HTTPS

Din panoul KAS → SSL → Let's Encrypt → activeaza pentru `galle-silva.ro` si `www.galle-silva.ro`. Inroleaza si re-emiterea automata.

## 9. Release workflow ulterior

Pentru fiecare update:

```bash
# local
git push origin main

# server
ssh w02183b4@w02183b4.kasserver.com
cd /www/htdocs/w02183b4/project/galle
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache route:cache view:cache
# urca public/build daca s-a re-buildat assets local
```

## 10. Verificari post-deploy

- `https://galle-silva.ro/` — 200, cu hero si splitter
- `/lemn-de-foc` — calculator + form livreaza in DB
- `/admin/login` — autentificare functionala
- `/sitemap.xml` — generat (sau ruleaza manual `php artisan sitemap:generate`)
- `/llms.txt` — 200
- `/robots.txt` — 200
- Email — trimite un test prin formularul de contact, verifica inboxul

## Cunoscute / atentionari

- **Coada de email** ruleaza prin cron (`queue:work --stop-when-empty`). Trimiterile pot fi delay-uite cu pana la 1 minut.
- **Fara Redis** pe ALL-INKL — toate cache/queue/session sunt in MariaDB. Performanta e ok pentru trafic mic-mediu.
- **Translatable** — RO seed-uit complet; DE/EN au cheile prezente dar valori `null`. Editeaza in `/admin` cand sunt traducerile pregatite.
- **Datele in afara `/www/htdocs/w02183b4/`** nu se salveaza — toate uploads via medialibrary tin in `storage/app/public/` care e linkat in `public/storage/`.
- **FSC/PEFC**: in proces. NU sunt obtinute. Pagina `/certificari` reflecta corect statusul.

## Backup

ALL-INKL face backup auto la MariaDB + filesystem. Pentru o copie suplimentara:

```bash
# DB dump (pe server)
mysqldump -h localhost -u d02183b4_galle -p d02183b4_galle | gzip > /www/htdocs/w02183b4/backups/galle-$(date +%F).sql.gz

# Fisiere
tar -czf /www/htdocs/w02183b4/backups/galle-files-$(date +%F).tar.gz storage public/build
```
