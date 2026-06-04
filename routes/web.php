<?php

use App\Http\Controllers\SiteController;
use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/lemn-de-foc/{localitate}', [SiteController::class, 'lemnDeFocLocal'])->name('lemn-de-foc.local');

    Route::get('/servicii', [SiteController::class, 'servicii'])->name('servicii');

    // Cele 6 servicii — pagini CMS randate prin slug.
    foreach (['exploatare-forestiera', 'achizitie-masa-lemnoasa', 'curatare-terenuri', 'transport-lemn', 'lucrari-silvice'] as $serviciuSlug) {
        Route::get("/servicii/{$serviciuSlug}", fn () => app(SiteController::class)->serviciuPage($serviciuSlug))->name("servicii.{$serviciuSlug}");
    }

    // 301 din vechea structura (forestiere/peisagistica/compostare).
    $redirect301 = function (string $to) {
        return function () use ($to) {
            $prefix = app()->getLocale() === 'ro' ? '' : '/'.app()->getLocale();

            return redirect()->to($prefix.$to, 301);
        };
    };
    Route::get('/servicii/forestiere', $redirect301('/servicii/exploatare-forestiera'))->name('servicii.forestiere');
    Route::get('/servicii/peisagistica', $redirect301('/servicii'))->name('servicii.peisagistica');
    Route::get('/servicii/compostare', $redirect301('/servicii'))->name('servicii.compostare');

    Route::get('/institutii', [SiteController::class, 'institutii'])->name('institutii');
    Route::get('/despre', [SiteController::class, 'despre'])->name('despre');
    Route::get('/certificari', [SiteController::class, 'certificari'])->name('certificari');

    Route::get('/proiecte', [SiteController::class, 'proiecte'])->name('proiecte');
    Route::get('/proiecte/{slug}', [SiteController::class, 'proiect'])->name('proiect');

    Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [SiteController::class, 'articol'])->name('articol');

    Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

    // Auth front-end (Livewire). Numele standard `login` face sa mearga
    // redirectul Laravel pentru rutele protejate.
    Route::get('/autentificare', fn () => view('site.auth.login'))->name('login');
    Route::get('/inregistrare', fn () => view('site.auth.register'))->name('register');
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $prefix = app()->getLocale() === 'ro' ? '' : '/'.app()->getLocale();

        return redirect()->to($prefix ?: '/');
    })->name('logout');

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
