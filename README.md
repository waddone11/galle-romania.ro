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

## Credentiale admin (seed local)

```
URL:      http://localhost/admin/login
Email:    admin@galle-silva.ro
Parola:   parola-temporara-galle-2026
Rol:      super_admin (filament-shield)
```

> Roluri seed-uite: `super_admin`, `admin`, `editor` (vezi `database/seeders/AdminUserSeeder.php`).
> Schimba parola la primul login (sau in `AdminUserSeeder` inainte de prod).

## TODO pentru sectiuni urmatoare

Vezi commits + README updates pe parcurs.
