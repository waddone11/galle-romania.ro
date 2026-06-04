<?php

use App\Http\Controllers\SiteController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

/*
 * Public site (3 locale).
 * RO — default, fara prefix.
 * DE — /de/...
 * EN — /en/...
 *
 * Acelasi controller serveste toate, locale-ul e set de SetLocale middleware (din primul segment).
 */

$siteRoutes = function () {
    Route::get('/', [SiteController::class, 'home'])->name('home');

    Route::get('/lemn-de-foc', [SiteController::class, 'lemnDeFoc'])->name('lemn-de-foc');

    Route::get('/servicii', [SiteController::class, 'servicii'])->name('servicii');
    Route::get('/servicii/forestiere', fn () => app(SiteController::class)->servicii('forestiere'))->name('servicii.forestiere');
    Route::get('/servicii/peisagistica', fn () => app(SiteController::class)->servicii('peisagistica'))->name('servicii.peisagistica');
    Route::get('/servicii/compostare', fn () => app(SiteController::class)->servicii('compostare'))->name('servicii.compostare');

    Route::get('/institutii', [SiteController::class, 'institutii'])->name('institutii');
    Route::get('/despre', [SiteController::class, 'despre'])->name('despre');
    Route::get('/certificari', [SiteController::class, 'certificari'])->name('certificari');

    Route::get('/proiecte', [SiteController::class, 'proiecte'])->name('proiecte');
    Route::get('/proiecte/{slug}', [SiteController::class, 'proiect'])->name('proiect');

    Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [SiteController::class, 'articol'])->name('articol');

    Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

    Route::get('/date-firma', [SiteController::class, 'dateFirma'])->name('date-firma');
    Route::get('/termeni', fn () => app(SiteController::class)->legalPage('termeni'))->name('termeni');
    Route::get('/confidentialitate', fn () => app(SiteController::class)->legalPage('confidentialitate'))->name('confidentialitate');
    Route::get('/cookies', fn () => app(SiteController::class)->legalPage('cookies'))->name('cookies');
};

// RO — fara prefix
Route::middleware([SetLocale::class.':ro'])->group($siteRoutes);

// DE
Route::prefix('de')->middleware([SetLocale::class.':de'])->name('de.')->group($siteRoutes);

// EN
Route::prefix('en')->middleware([SetLocale::class.':en'])->name('en.')->group($siteRoutes);
