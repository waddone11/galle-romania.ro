<?php

use Database\Seeders\PaginaSeeder;
use Database\Seeders\TraducereSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the seeded DE/EN page content instead of the RO fallback', function (string $locale, string $expected, string $roText) {
    $this->seed(PaginaSeeder::class);

    $this->get("/$locale/servicii")
        ->assertOk()
        ->assertSee($expected)
        ->assertDontSee($roText);
})->with([
    'de' => ['de', 'Komplette Forstdienstleistungen in Prahova', 'Servicii forestiere complete în Prahova'],
    'en' => ['en', 'Complete forestry services in Prahova', 'Servicii forestiere complete în Prahova'],
]);

it('translates UI keys that contain dots (regression: addLines breaks dotted keys)', function () {
    $this->seed(TraducereSeeder::class);

    // Cheia din footer e o propozitie intreaga, cu punct — inainte cadea mereu pe RO.
    $this->get('/de')
        ->assertOk()
        ->assertSee('Forstdienstleistungen und Brennholz', false)
        ->assertSee('Zum Inhalt springen');

    $this->get('/en')
        ->assertOk()
        ->assertSee('Forestry services and firewood', false)
        ->assertSee('Skip to content');
});

it('keeps RO diacritics for dotted keys on the RO site', function () {
    $this->seed(TraducereSeeder::class);

    $this->get('/')
        ->assertOk()
        ->assertSee('funcționarea site-ului', false);
});
