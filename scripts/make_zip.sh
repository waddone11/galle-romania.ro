#!/usr/bin/env bash
# Zip INCREMENTAL de update pentru prod — WebFTP „Unpack archives after uploading"
# peste /galle-silva.com/ (continut fara folder de top, cade direct peste app/, public/...).
#
# Exclude tot ce NU trebuie atins pe server:
#   - vendor/ (e deja pe prod, neschimbat — vezi --with-vendor)
#   - .env / .env.* (configul de prod ramane al serverului!)
#   - storage/ integral + public/storage (symlink)
#   - pozele urcate din admin: public/images/{proiecte,membri,recenzii,og}
#     (disk-ul Filament `public_images` — vezi config/filesystems.php)
#
# Utilizare:
#   ./scripts/make_zip.sh                # build + zip incremental (fara vendor)
#   ./scripts/make_zip.sh --no-build     # zip fara rebuild assets
#   ./scripts/make_zip.sh --with-vendor  # include si vendor/ (dupa schimbari composer;
#                                        #   ruleaza intai composer install --no-dev!)
#
# Dupa upload + unpack pe prod:
#   /__ops/cache-clear?secret=...   (+ /__ops/migrate?secret=... daca ai migratii noi)
set -euo pipefail
cd "$(dirname "$0")/.."

BUILD=1
WITH_VENDOR=0
for arg in "$@"; do
    case "$arg" in
        --no-build) BUILD=0 ;;
        --with-vendor) WITH_VENDOR=1 ;;
        *) echo "Flag necunoscut: $arg (stiute: --no-build, --with-vendor)"; exit 1 ;;
    esac
done

if [ "$BUILD" = 1 ]; then
    docker compose exec laravel.test npm run build
fi
rm -f public/hot
[ -f public/build/manifest.json ] || { echo "EROARE: lipseste public/build/manifest.json — ruleaza build-ul."; exit 1; }

if [ "$WITH_VENDOR" = 1 ] && [ -f vendor/bin/pest ]; then
    echo "EROARE: vendor/ contine pachete de DEV. Pentru prod ruleaza intai:"
    echo "  docker compose exec laravel.test composer install --no-dev --optimize-autoloader"
    echo "(si dupa zip: composer install, ca sa-ti recapeti Pest/PHPStan local)"
    exit 1
fi

rm -rf dist/stage-update dist/galle-update.zip
mkdir -p dist/stage-update

# Excluderile de proiect sunt ANCORATE cu / la inceput (lectia vendor/**/dist).
EXCLUDES=(
    --exclude='/.git/' --exclude='/.github/' --exclude='/node_modules/' --exclude='/tests/'
    --exclude='/dist/' --exclude='/database/dumps/' --exclude='/scripts/'
    --exclude='/.playwright-mcp/' --exclude='/.idea/' --exclude='/.claude/'
    --exclude='/.env' --exclude='/.env.*'
    --exclude='/public/hot' --exclude='/public/storage'
    --exclude='/storage/'
    --exclude='/public/images/proiecte/' --exclude='/public/images/membri/'
    --exclude='/public/images/recenzii/' --exclude='/public/images/og/'
    --exclude='/certificari/' --exclude='/*.zip'
    --exclude='/galle_logo.png' --exclude='/galle_logos.png' --exclude='/lemne_de_foc.png'
    --exclude='/logo_favicon.png' --exclude='/logo_nav.png' --exclude='/navbar-logo.png'
    --exclude='.DS_Store'
)
if [ "$WITH_VENDOR" = 0 ]; then
    EXCLUDES+=(--exclude='/vendor/')
fi

rsync -a "${EXCLUDES[@]}" ./ dist/stage-update/

# bootstrap/cache fara continut compilat (raman doar .gitignore-urile)
find dist/stage-update/bootstrap/cache -type f ! -name .gitignore -delete

(cd dist/stage-update && zip -rq9 ../galle-update.zip .)
rm -rf dist/stage-update

echo "=== Verificari ==="
for interzis in .env "storage/" "public/storage" "public/images/proiecte/" ; do
    if unzip -l dist/galle-update.zip | awk '{print $4}' | grep -q "^${interzis}"; then
        echo "EROARE: '$interzis' a ajuns in zip!"; exit 1
    fi
done
if [ "$WITH_VENDOR" = 0 ] && unzip -l dist/galle-update.zip | awk '{print $4}' | grep -q '^vendor/'; then
    echo "EROARE: vendor/ a ajuns in zip-ul incremental!"; exit 1
fi
if [ "$WITH_VENDOR" = 1 ] && ! unzip -l dist/galle-update.zip | grep -q 'vendor/autoload.php'; then
    echo "EROARE: --with-vendor dar vendor/autoload.php lipseste!"; exit 1
fi
echo "OK — fara .env, fara storage/, fara public/storage, fara upload-urile din admin$( [ "$WITH_VENDOR" = 0 ] && echo ', fara vendor' )."

echo
ls -lh dist/galle-update.zip
echo
echo "Dupa upload + „Unpack after upload\" in /galle-silva.com/ pe prod, ruleaza in browser:"
echo "  /__ops/cache-clear?secret=...    (+ /__ops/migrate?secret=... daca ai migratii noi)"
