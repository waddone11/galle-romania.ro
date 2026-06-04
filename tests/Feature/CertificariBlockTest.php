<?php

use App\Models\Certificare;
use Database\Seeders\CertificareSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\TraducereSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(CertificareSeeder::class);
    $this->seed(PaginaSeeder::class);
    $this->seed(TraducereSeeder::class);
});

/*
 * ---------- Block certificari pe home (marquee logo-uri) ----------
 */

it('renders the certificari marquee section on home', function () {
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('Calitate certificată, responsabilitate dovedită')
        ->toContain('cert-marquee')
        ->toContain('/images/certificari/fsc.svg')
        ->toContain('/images/certificari/pefc.png')
        ->toContain('/images/certificari/iso-9001.svg')
        ->toContain('/images/certificari/iso-14001.svg')
        ->toContain('/images/certificari/ral.svg')
        ->toContain('/images/certificari/dekra.svg');
});

it('shows FSC and PEFC as in curs de obtinere and the rest as certified via Galle GmbH', function () {
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('În curs de obținere')
        ->toContain('Certificat')
        ->toContain('prin Galle GmbH');
});

it('seeds the 6 certificari idempotently with slug, logo and detinator', function () {
    // Re-rulare seeder: upsert pe slug, fara duplicate.
    $this->seed(CertificareSeeder::class);

    expect(Certificare::count())->toBe(6)
        ->and(Certificare::whereNull('logo')->count())->toBe(0)
        ->and(Certificare::where('slug', 'fsc')->value('status')->value)->toBe('in_proces')
        ->and(Certificare::where('slug', 'iso-9001')->value('detinator'))->toBe('Galle GmbH');
});

it('does not break the certificari page', function () {
    $this->get('/certificari')->assertOk()->assertSee('FSC');
});
