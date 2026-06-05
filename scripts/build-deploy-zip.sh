#!/usr/bin/env bash
# Construieste dist/galle-deploy.zip pentru deploy WebFTP (vezi DEPLOY-CPANEL.md).
# Ruleaza de pe masina locala, din radacina proiectului:
#   docker compose exec laravel.test composer install --no-dev --optimize-autoloader
#   docker compose exec laravel.test npm run build
#   bash scripts/build-deploy-zip.sh
#   docker compose exec laravel.test composer install   # restaureaza dev local
#
# IMPORTANT: toate excluderile de proiect sunt ANCORATE la radacina (incep cu /),
# altfel rsync ar exclude si directoare omonime din vendor/ (ex. vendor/**/dist/
# cu livewire.js, vendor/**/tests/) — bug care a rupt primul deploy.
set -euo pipefail
cd "$(dirname "$0")/.."

[ -f vendor/autoload.php ] || { echo "EROARE: vendor/ lipseste — ruleaza composer install --no-dev intai."; exit 1; }
[ -f public/build/manifest.json ] || { echo "EROARE: public/build/manifest.json lipseste — ruleaza npm run build intai."; exit 1; }
[ -f .env.prod ] || { echo "EROARE: .env.prod lipseste (devine .env in zip)."; exit 1; }
if [ -f vendor/bin/pest ]; then
    echo "EROARE: vendor/ contine pachete de dev — ruleaza composer install --no-dev intai."; exit 1
fi
rm -f public/hot

rm -rf dist/stage dist/galle-deploy.zip
mkdir -p dist/stage

rsync -a \
  --exclude='/.git/' --exclude='/.github/' --exclude='/node_modules/' --exclude='/tests/' \
  --exclude='/dist/' --exclude='/database/dumps/' --exclude='/public/hot' --exclude='/public/storage' \
  --exclude='/.playwright-mcp/' --exclude='/.idea/' --exclude='/.claude/' --exclude='/scripts/' \
  --exclude='/.env' --exclude='/.env.prod' --exclude='/certificari/' --exclude='/*.zip' \
  --exclude='/galle_logo.png' --exclude='/galle_logos.png' --exclude='/lemne_de_foc.png' \
  --exclude='/logo_favicon.png' --exclude='/logo_nav.png' --exclude='/navbar-logo.png' \
  --exclude='.DS_Store' \
  ./ dist/stage/

# storage: pastreaza structura, goleste continutul efemer (raman .gitignore-urile)
find dist/stage/storage/framework -type f ! -name .gitignore -delete
find dist/stage/storage/logs -type f ! -name .gitignore -delete
rm -rf dist/stage/storage/pail

# storage/app/public: gol — toate imaginile sunt statice in public/images
# (galeria proiectelor + upload-urile Filament merg pe disk-ul public_images).
find dist/stage/storage/app/public -mindepth 1 ! -name .gitignore -delete 2>/dev/null || true
(cd dist/stage/storage/app/public && find . -mindepth 1 -type d -empty -delete)

# bootstrap/cache: gol (writable), pastreaza .gitignore
find dist/stage/bootstrap/cache -type f ! -name .gitignore -delete

# .env de prod, gata completat
cp .env.prod dist/stage/.env

(cd dist/stage && zip -rq9 ../galle-deploy.zip .)
rm -rf dist/stage

echo "=== Verificari de continut ==="
for f in artisan .env public/build/manifest.json vendor/autoload.php \
         vendor/livewire/livewire/dist/livewire.js \
         public/images/certificari/fsc.svg; do
  unzip -l dist/galle-deploy.zip "$f" > /dev/null 2>&1 && echo "OK  $f" || { echo "LIPSA $f"; exit 1; }
done
unzip -l dist/galle-deploy.zip | tail -1
ls -lh dist/galle-deploy.zip
