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
 * ---------- /certificari — listare detaliata (grid, nu carousel) ----------
 */

it('lists all 6 certificari with logo, status, descriere and detinator on /certificari', function () {
    $html = $this->get('/certificari')->assertOk()->getContent();

    expect($html)
        // toate cele 6 logo-uri
        ->toContain('/images/certificari/fsc.svg')
        ->toContain('/images/certificari/pefc.png')
        ->toContain('/images/certificari/iso-9001.svg')
        ->toContain('/images/certificari/iso-14001.svg')
        ->toContain('/images/certificari/ral.svg')
        ->toContain('/images/certificari/dekra.svg')
        // status pills: FSC/PEFC in curs, restul certificate prin Galle GmbH
        ->toContain('În curs de obținere')
        ->toContain('prin Galle GmbH')
        // descrierile vin din Certificare.descriere
        ->toContain('gestionarea responsabilă a pădurilor')
        ->toContain('sisteme de management al calității');
});

it('groups certificari clearly: obtinute vs in proces', function () {
    $html = $this->get('/certificari')->assertOk()->getContent();

    expect($html)
        ->toContain('Certificări ale grupului Galle GmbH')
        ->toContain('În proces de certificare');
});

it('uses Pagina certificari for title and meta', function () {
    $html = $this->get('/certificari')->assertOk()->getContent();

    expect($html)->toContain('Certificari FSC, PEFC, ISO — Galle Silva si Galle GmbH');
});

/*
 * ---------- /despre — varianta compacta + link spre /certificari ----------
 */

it('shows the compact certificari element with logos and link on /despre', function () {
    $html = $this->get('/despre')->assertOk()->getContent();

    expect($html)
        ->toContain('/images/certificari/fsc.svg')
        ->toContain('/images/certificari/dekra.svg')
        ->toContain('Vezi toate certificările')
        ->toContain(route('certificari'));
});

/*
 * ---------- Seeder idempotent: descrierea editata din admin nu e suprascrisa ----------
 */

it('keeps an admin-edited descriere when the seeder runs again', function () {
    $fsc = Certificare::where('slug', 'fsc')->firstOrFail();
    $fsc->setTranslation('descriere', 'ro', 'Text editat din admin.');
    $fsc->save();

    $this->seed(CertificareSeeder::class);

    expect(Certificare::where('slug', 'fsc')->firstOrFail()->getTranslation('descriere', 'ro'))
        ->toBe('Text editat din admin.');
});
