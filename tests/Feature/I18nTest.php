<?php

use App\Http\Middleware\RestoreLocale;
use App\Livewire\LanguageSwitcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('persists the locale in session via SetLocale', function (string $uri, string $expected) {
    $this->get($uri)->assertOk();

    expect(session('locale'))->toBe($expected);
})->with([
    ['/', 'ro'],
    ['/de', 'de'],
    ['/en/despre', 'en'],
]);

it('restores the session locale on requests that skip SetLocale', function () {
    session(['locale' => 'de']);

    $request = Request::create('/livewire/update', 'POST');
    $request->setLaravelSession(app('session.store'));

    (new RestoreLocale)->handle($request, function () {
        expect(app()->getLocale())->toBe('de');

        return response('ok');
    });
});

it('switches language to the equivalent translated route, not the livewire endpoint', function () {
    Livewire::test(LanguageSwitcher::class)
        ->set('routeName', 'servicii')
        ->set('routeParams', [])
        ->call('switch', 'de')
        ->assertRedirect(route('de.servicii'));
});

it('switches back to RO without a locale prefix', function () {
    Livewire::test(LanguageSwitcher::class)
        ->set('routeName', 'despre')
        ->call('switch', 'ro')
        ->assertRedirect(route('despre'));
});

it('keeps route parameters when switching language', function () {
    Livewire::test(LanguageSwitcher::class)
        ->set('routeName', 'proiect')
        ->set('routeParams', ['slug' => 'test-proiect'])
        ->call('switch', 'en')
        ->assertRedirect(route('en.proiect', ['slug' => 'test-proiect']));
});

it('captures the unprefixed route name on mount', function () {
    $response = $this->get('/de/despre');

    $response->assertOk();
    // Snapshot-ul Livewire din pagina contine numele rutei de baza, fara prefix.
    expect($response->getContent())->toContain('despre');
    expect(app()->getLocale())->toBe('de');
});

it('falls back to home when the named route has no translated variant', function () {
    Livewire::test(LanguageSwitcher::class)
        ->set('routeName', 'ruta-inexistenta')
        ->call('switch', 'de')
        ->assertRedirect(route('de.home'));
});
