<?php

use Database\Seeders\CertificareSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\ServiciuSeeder;
use Database\Seeders\SpecieSeeder;
use Database\Seeders\TraducereSeeder;
use Database\Seeders\ZonaLivrareSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(SpecieSeeder::class);
    $this->seed(ServiciuSeeder::class);
    $this->seed(CertificareSeeder::class);
    $this->seed(ZonaLivrareSeeder::class);
    $this->seed(FaqSeeder::class);
    $this->seed(PaginaSeeder::class);
    $this->seed(TraducereSeeder::class);
});

/*
 * ---------- config/company.php ----------
 */

it('exposes the legal company data in config/company.php with real defaults', function () {
    expect(config('company.denumire'))->toBe('GALLE SILVA SRL')
        ->and(config('company.cui'))->toBe('52771440')
        ->and(config('company.tva'))->toBeFalse()
        ->and(config('company.reg_com'))->toBe('J2025081738000')
        ->and(config('company.euid'))->toBe('ROONRC.J2025081738000')
        ->and(config('company.caen'))->toContain('0220')
        ->and(config('company.data_infiintare'))->toBe('2025-10-24')
        ->and(config('company.cod_postal'))->toBe('107375')
        ->and(config('company.administrator'))->toBe('Ion Narcis Marin');
});

/*
 * ---------- /date-firma (Impressum) ----------
 */

it('renders the Impressum with all legal data from config', function () {
    $html = $this->get('/date-firma')->assertOk()->getContent();

    expect($html)
        ->toContain('GALLE SILVA SRL')
        ->toContain('52771440')
        ->toContain('J2025081738000')
        ->toContain('ROONRC.J2025081738000')
        ->toContain('0220')
        ->toContain('24.10.2025')
        ->toContain('Str. Principala nr. 302')
        ->toContain('107375')
        ->toContain('Prahova')
        ->toContain('Ion Narcis Marin');
});

it('shows the plain CUI when the company is not a VAT payer', function () {
    config(['company.tva' => false]);

    $html = $this->get('/date-firma')->assertOk()->getContent();

    expect($html)
        ->toContain('52771440')
        ->not->toContain('RO52771440')
        ->not->toContain('Platitor de TVA');
});

it('shows RO-prefixed CUI and the VAT mention when the company is a VAT payer', function () {
    config(['company.tva' => true]);

    $html = $this->get('/date-firma')->assertOk()->getContent();

    expect($html)
        ->toContain('RO52771440')
        ->toContain('Platitor de TVA');
});

/*
 * ---------- Footer: linia legala ----------
 */

it('shows the discreet legal line in the footer', function () {
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('GALLE SILVA SRL')
        ->toContain('CUI 52771440')
        ->toContain('Reg. Com. J2025081738000');
});

/*
 * ---------- JSON-LD (LocalBusiness) ----------
 */

it('enriches the LocalBusiness JSON-LD with legal data from config', function () {
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('"legalName":"GALLE SILVA SRL"')
        ->toContain('"taxID":"52771440"')
        ->toContain('"foundingDate":"2025-10-24"')
        ->toContain('"postalCode":"107375"')
        ->toContain('"addressRegion":"Prahova"');
});

it('uses the RO-prefixed taxID in JSON-LD when VAT payer', function () {
    config(['company.tva' => true]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)->toContain('"taxID":"RO52771440"');
});

/*
 * ---------- GDPR: persoana de contact ----------
 */

it('names the administrator from config as data contact on /confidentialitate', function () {
    $html = $this->get('/confidentialitate')->assertOk()->getContent();

    expect($html)->toContain('Ion Narcis Marin');
});
