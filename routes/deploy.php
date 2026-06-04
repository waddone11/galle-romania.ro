<?php

use App\Http\Middleware\DeployOpsGate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
 * Comenzi artisan prin browser — pentru prod FARA SSH/terminal (cPanel/KAS).
 * Protejate de DeployOpsGate: DEPLOY_OPS_ENABLED=true + ?secret= corect, altfel 404.
 *
 * DUPA SETUP: pune DEPLOY_OPS_ENABLED=false in .env (sau sterge fisierul asta)
 * si re-ruleaza config-cache. Vezi DEPLOY-CPANEL.md.
 */

// Ruleaza o comanda artisan si intoarce output-ul ca text simplu.
$ruleaza = function (string $comanda, array $parametri = []): string {
    Artisan::call($comanda, $parametri);

    return '$ php artisan '.$comanda."\n".Artisan::output();
};

$caText = fn (string $output) => response($output, 200, ['Content-Type' => 'text/plain; charset=utf-8']);

Route::prefix('__ops')->middleware(DeployOpsGate::class)->group(function () use ($ruleaza, $caText) {
    // Goleste toate cache-urile (config/route/view/event/compiled).
    Route::get('/cache-clear', fn () => $caText($ruleaza('optimize:clear')));

    // Cache de productie. NU route:cache — rutele folosesc closures si ar crapa.
    Route::get('/config-cache', fn () => $caText($ruleaza('config:cache').$ruleaza('view:cache')));

    // Symlink public/storage -> storage/app/public (idempotent).
    Route::get('/storage-link', function () use ($ruleaza, $caText) {
        if (file_exists(public_path('storage'))) {
            return $caText("storage:link — link-ul public/storage exista deja, nimic de facut.\n");
        }

        return $caText($ruleaza('storage:link'));
    });

    // Migratii noi (aditive) — sigur la re-deploy.
    Route::get('/migrate', fn () => $caText($ruleaza('migrate', ['--force' => true])));

    // DISTRUCTIV: sterge si re-seedeaza TOATA baza de date.
    // Cere si ?confirm=RESET-GALLE pe langa secret.
    Route::get('/migrate-fresh-seed', function () use ($ruleaza, $caText) {
        if (request()->query('confirm') !== 'RESET-GALLE') {
            return response(
                "REFUZAT.\n\n"
                ."!!! ATENTIE: aceasta comanda STERGE TOATA BAZA DE DATE !!!\n"
                ."Toate comenzile, lead-urile, recenziile, pozele asociate si orice\n"
                ."continut editat din admin se PIERD definitiv si se inlocuiesc cu seed-ul.\n\n"
                ."NU o rula pe productie dupa importul dump-ului initial.\n"
                ."Daca esti absolut sigur, adauga &confirm=RESET-GALLE la URL.\n",
                422,
                ['Content-Type' => 'text/plain; charset=utf-8'],
            );
        }

        return $caText($ruleaza('migrate:fresh', ['--seed' => true, '--force' => true]));
    });
});
