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

function setSocial(array $overrides = []): void
{
    config(['social' => array_merge([
        'facebook' => null,
        'instagram' => null,
        'youtube' => null,
        'tiktok' => null,
        'whatsapp' => null,
        'linkedin' => null,
    ], $overrides)]);
}

/*
 * ---------- Componenta x-social-links ----------
 */

it('renders a link with icon for each configured platform', function () {
    setSocial([
        'facebook' => 'https://facebook.com/gallesilva',
        'whatsapp' => 'https://wa.me/40729961082',
    ]);

    $html = (string) $this->blade('<x-social-links />');

    expect($html)
        ->toContain('https://facebook.com/gallesilva')
        ->toContain('https://wa.me/40729961082')
        ->toContain('aria-label="Facebook"')
        ->toContain('aria-label="WhatsApp"')
        ->toContain('target="_blank"')
        ->toContain('rel="noopener noreferrer"')
        ->not->toContain('aria-label="Instagram"')
        ->not->toContain('aria-label="YouTube"')
        ->not->toContain('aria-label="TikTok"')
        ->not->toContain('aria-label="LinkedIn"');
});

it('renders nothing at all when no platform is configured', function () {
    setSocial();

    $html = trim((string) $this->blade('<x-social-links />'));

    expect($html)->toBe('');
});

/*
 * ---------- Plasare: footer, /contact, /despre ----------
 */

it('shows social icons in the footer when configured', function () {
    setSocial(['instagram' => 'https://instagram.com/gallesilva']);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('https://instagram.com/gallesilva')
        ->toContain('aria-label="Instagram"');
});

it('shows social icons on the contact page', function () {
    setSocial(['youtube' => 'https://youtube.com/@gallesilva']);

    $html = $this->get('/contact')->assertOk()->getContent();

    expect($html)
        ->toContain('https://youtube.com/@gallesilva')
        ->toContain('aria-label="YouTube"');
});

it('shows social icons on the despre page', function () {
    setSocial(['linkedin' => 'https://linkedin.com/company/gallesilva']);

    $html = $this->get('/despre')->assertOk()->getContent();

    expect($html)
        ->toContain('https://linkedin.com/company/gallesilva')
        ->toContain('aria-label="LinkedIn"');
});

it('renders no social icons anywhere when nothing is configured', function () {
    setSocial();

    foreach (['/', '/contact', '/despre'] as $path) {
        $html = $this->get($path)->assertOk()->getContent();

        expect($html)
            ->not->toContain('aria-label="Facebook"')
            ->not->toContain('aria-label="Instagram"')
            ->not->toContain('aria-label="YouTube"')
            ->not->toContain('aria-label="TikTok"')
            ->not->toContain('aria-label="LinkedIn"');
    }
});

it('exposes all six platforms in config/social.php with null defaults', function () {
    $config = require base_path('config/social.php');

    expect(array_keys($config))->toBe([
        'facebook', 'instagram', 'youtube', 'tiktok', 'whatsapp', 'linkedin',
    ]);
});
