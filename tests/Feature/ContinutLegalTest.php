<?php

use Database\Seeders\MembruSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\TraducereSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PaginaSeeder::class);
    // Diacriticele RO pentru cheile UI vin din stratul de traduceri.
    $this->seed(TraducereSeeder::class);
});

/*
 * ---------- Pagini legale (CMS, seed RO; DE/EN fallback pe RO) ----------
 */

it('renders each legal page with seeded content in all locales', function (string $slug, string $marker) {
    foreach (['', '/de', '/en'] as $prefix) {
        $this->get("{$prefix}/{$slug}")
            ->assertOk()
            ->assertSee($marker, false);
    }
})->with([
    'confidentialitate' => ['confidentialitate', 'Operatorul de date'],
    'cookies' => ['cookies', 'Ce cookie-uri folosim'],
    'termeni' => ['termeni', 'Preturi si comenzi'],
]);

it('links legal pages internally to date-firma and cookies', function () {
    $this->get('/confidentialitate')
        ->assertOk()
        ->assertSee('href="/date-firma"', false)
        ->assertSee('href="/cookies"', false);

    $this->get('/termeni')
        ->assertOk()
        ->assertSee('href="/date-firma"', false);
});

/*
 * ---------- Despre: povestea grupului (din 1990, fara „25 de ani") ----------
 */

it('renders despre with the corrected group story in all locales', function () {
    foreach (['', '/de', '/en'] as $prefix) {
        $this->get("{$prefix}/despre")
            ->assertOk()
            ->assertSee('Parte din grupul Galle GmbH')
            ->assertDontSee('25 de ani');
    }
});

it('keeps the despre team section intact', function () {
    // Echipa vine acum din modelul Membru (blocul CMS `echipa`), nu din Pagina.
    $this->seed(MembruSeeder::class);

    $this->get('/despre')
        ->assertOk()
        ->assertSeeText('Răzvan Solzaru')
        ->assertSeeText('Ion Narcis Marin');
});

it('no longer mentions 25 de ani on the home page', function () {
    $this->get('/')->assertOk()->assertDontSee('25 de ani');
});
