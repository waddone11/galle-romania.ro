<?php

use App\Models\Traducere;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

uses(RefreshDatabase::class);

it('serves DB translations for the current locale with RO fallback', function () {
    Traducere::create([
        'cheie' => 'Acasa',
        'grup' => 'nav',
        'valoare' => ['ro' => 'Acasa', 'de' => 'Startseite', 'en' => null],
    ]);

    $this->get('/de')->assertOk()->assertSee('Startseite');

    // EN nu e tradus -> fallback pe cheie (RO).
    $this->get('/en')->assertOk()->assertSee('Acasa');
});

it('busts the translations cache when a traducere is saved', function () {
    $t = Traducere::create([
        'cheie' => 'Cere oferta',
        'grup' => 'nav',
        'valoare' => ['ro' => 'Cere oferta', 'de' => null, 'en' => null],
    ]);

    // Incalzeste cache-ul.
    $this->get('/de')->assertOk();
    expect(Cache::has('traduceri.de'))->toBeTrue();

    $t->setTranslation('valoare', 'de', 'Angebot anfordern');
    $t->save();

    expect(Cache::has('traduceri.de'))->toBeFalse();

    $this->get('/de')->assertOk()->assertSee('Angebot anfordern');
});

it('extracts blade __() keys idempotently', function () {
    $this->artisan('traduceri:extract')->assertSuccessful();

    $count = Traducere::count();
    expect($count)->toBeGreaterThan(10);

    // Cheia din navbar exista cu valoarea RO = cheia.
    $acasa = Traducere::where('cheie', 'Acasa')->first();
    expect($acasa)->not->toBeNull()
        ->and($acasa->getTranslation('valoare', 'ro'))->toBe('Acasa');

    // Re-rularea nu dubleaza si nu suprascrie.
    $acasa->setTranslation('valoare', 'de', 'Startseite');
    $acasa->save();

    $this->artisan('traduceri:extract')->assertSuccessful();

    expect(Traducere::count())->toBe($count)
        ->and(Traducere::where('cheie', 'Acasa')->first()->getTranslation('valoare', 'de'))->toBe('Startseite');
});
