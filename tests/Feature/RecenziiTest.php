<?php

use App\Models\Recenzie;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\PaginaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PaginaSeeder::class);
});

/*
 * ---------- Afisare pe home: doar recenzii reale, publicate ----------
 */

it('shows a published recenzie on home with nume, localitate, rating and sursa', function () {
    Recenzie::factory()->published()->create([
        'nume_client' => 'Vasile Test-Popescu',
        'localitate' => 'Ploiesti',
        'rating' => 5,
        'text' => 'Lemn uscat, livrare rapida, recomand cu incredere.',
        'sursa' => 'Google',
    ]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('Ce spun clienții')
        ->toContain('Vasile Test-Popescu')
        ->toContain('Ploiesti')
        ->toContain('Lemn uscat, livrare rapida, recomand cu incredere.')
        ->toContain('Google');
});

it('does not show an unpublished recenzie on home', function () {
    Recenzie::factory()->published()->create(['nume_client' => 'Client Publicat']);
    Recenzie::factory()->create([
        'nume_client' => 'Client Nepublicat',
        'text' => 'Text care nu trebuie sa apara pe site.',
    ]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('Client Publicat')
        ->not->toContain('Client Nepublicat')
        ->not->toContain('Text care nu trebuie sa apara pe site.');
});

it('hides the recenzii section entirely when no recenzie is published', function () {
    Recenzie::factory()->create(['nume_client' => 'Doar Draft']);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->not->toContain('Ce spun clienții')
        ->not->toContain('Doar Draft');
});

it('orders published recenzii by ordine', function () {
    Recenzie::factory()->published()->create(['nume_client' => 'Al Doilea Client', 'ordine' => 2]);
    Recenzie::factory()->published()->create(['nume_client' => 'Primul Client', 'ordine' => 1]);

    $html = $this->get('/')->assertOk()->getContent();

    expect(strpos($html, 'Primul Client'))->toBeLessThan(strpos($html, 'Al Doilea Client'));
});

/*
 * ---------- JSON-LD: Review doar pentru recenzii reale publicate ----------
 */

it('emits Review JSON-LD only for published recenzii', function () {
    Recenzie::factory()->published()->create([
        'nume_client' => 'Autor Schema',
        'text' => 'Recenzie reala pentru schema.',
        'rating' => 4,
    ]);
    Recenzie::factory()->create(['nume_client' => 'Autor Ascuns']);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('"@type":"Review"')
        ->toContain('"reviewBody":"Recenzie reala pentru schema."')
        ->toContain('"Autor Schema"')
        ->not->toContain('Autor Ascuns');
});

it('omits reviewRating from JSON-LD when the recenzie has no rating', function () {
    Recenzie::factory()->published()->create(['rating' => null]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('"@type":"Review"')
        ->not->toContain('reviewRating');
});

it('omits AggregateRating when fewer than 3 published recenzii have a rating', function () {
    Recenzie::factory()->published()->count(2)->create(['rating' => 5]);
    Recenzie::factory()->published()->create(['rating' => null]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)->not->toContain('AggregateRating');
});

it('emits AggregateRating from real ratings when at least 3 published recenzii are rated', function () {
    Recenzie::factory()->published()->create(['rating' => 5]);
    Recenzie::factory()->published()->create(['rating' => 4]);
    Recenzie::factory()->published()->create(['rating' => 3]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('"@type":"AggregateRating"')
        ->toContain('"ratingValue":4')
        ->toContain('"reviewCount":3');
});

it('emits no Review JSON-LD at all when nothing is published', function () {
    Recenzie::factory()->count(2)->create(['rating' => 5]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->not->toContain('"@type":"Review"')
        ->not->toContain('AggregateRating');
});

/*
 * ---------- Model: is_published default false (nimic fals publicat implicit) ----------
 */

it('defaults is_published to false at the database level', function () {
    $recenzie = Recenzie::query()->create([
        'nume_client' => 'Client Nou',
        'text' => 'Recenzie adaugata fara flag explicit.',
    ]);

    expect($recenzie->refresh()->is_published)->toBeFalse();
});

/*
 * ---------- Admin: resursa Filament e accesibila ----------
 */

it('lets the admin open the recenzii resource in Filament', function () {
    $this->seed(AdminUserSeeder::class);
    $admin = User::where('email', config('app.admin_email'))->firstOrFail();

    $this->actingAs($admin)->get('/admin/recenzii')->assertOk();
});
