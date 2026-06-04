<?php

use App\Livewire\ContactForm;
use App\Livewire\Firewood\OrderForm;
use App\Models\ComandaLemn;
use App\Models\Lead;
use App\Models\Specie;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\CertificareSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\ServiciuSeeder;
use Database\Seeders\SpecieSeeder;
use Database\Seeders\ZonaLivrareSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AdminUserSeeder::class);
    $this->seed(SpecieSeeder::class);
    $this->seed(ServiciuSeeder::class);
    $this->seed(CertificareSeeder::class);
    $this->seed(ZonaLivrareSeeder::class);
    $this->seed(FaqSeeder::class);
    $this->seed(PaginaSeeder::class);
    Cache::flush(); // reset rate limiter state between tests
});

/*
 * ---------- SEO on-page ----------
 */

it('renders core SEO tags on the homepage', function () {
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('<title>')
        ->toContain('name="description"')
        ->toContain('rel="canonical"')
        ->toContain('property="og:image"')
        ->toContain('hreflang="ro"')
        ->toContain('hreflang="de"')
        ->toContain('hreflang="en"')
        ->toContain('"@type":"LocalBusiness"');
});

it('renders Product, FAQPage and BreadcrumbList JSON-LD on lemn-de-foc', function () {
    $html = $this->get('/lemn-de-foc')->assertOk()->getContent();

    expect($html)
        ->toContain('"@type":"Product"')
        ->toContain('"@type":"FAQPage"')
        ->toContain('"@type":"BreadcrumbList"');
});

it('renders Service JSON-LD on servicii', function () {
    $html = $this->get('/servicii')->assertOk()->getContent();

    expect($html)->toContain('"@type":"Service"');
});

/*
 * ---------- GEO / crawl files ----------
 *
 * sitemap.xml / robots.txt / llms.txt are served as static files by the web
 * server (ALL-INKL), not by Laravel — so we assert their presence + content on
 * disk rather than via an HTTP route (which would 404 under the test kernel).
 */

it('ships robots.txt with sitemap + admin disallow', function () {
    $robots = file_get_contents(public_path('robots.txt'));

    expect($robots)
        ->toContain('Sitemap:')
        ->toContain('Disallow: /admin');
});

it('ships llms.txt with factual company summary', function () {
    $llms = file_get_contents(public_path('llms.txt'));

    expect($llms)
        ->toContain('Galle Silva')
        ->toContain('Lemn de foc');
});

it('regenerates sitemap.xml with the homepage url', function () {
    $this->artisan('sitemap:generate')->assertSuccessful();

    $sitemap = file_get_contents(public_path('sitemap.xml'));

    expect($sitemap)
        ->toContain('<urlset')
        ->toContain('/lemn-de-foc');
});

/*
 * ---------- Error pages ----------
 */

it('renders a branded 404 page', function () {
    $r = $this->get('/aceasta-pagina-nu-exista-12345');
    $r->assertNotFound();
    $r->assertSee('Pagina nu a fost gasita');
    $r->assertSee('Galle');
});

/*
 * ---------- Anti-spam: honeypot ----------
 */

it('drops order-form submissions when the honeypot is filled', function () {
    $specie = Specie::first();

    Livewire::test(OrderForm::class)
        ->set('website', 'http://spam.example')
        ->set('nume', 'Spam Bot')
        ->set('telefon', '+40700000000')
        ->set('localitate', 'Ploiesti')
        ->set('specieId', $specie->id)
        ->set('cantitate', 1)
        ->set('unitate', 'ster')
        ->call('submit')
        ->assertSet('submitted', true); // faked success, no hint to the bot

    expect(ComandaLemn::count())->toBe(0);
});

it('drops contact-form submissions when the honeypot is filled', function () {
    Livewire::test(ContactForm::class)
        ->set('website', 'http://spam.example')
        ->set('nume', 'Spam Bot')
        ->set('email', 'bot@spam.example')
        ->set('mesaj', 'buy cheap stuff')
        ->call('submit')
        ->assertSet('submitted', true);

    expect(Lead::count())->toBe(0);
});

it('still saves a valid order-form submission with an empty honeypot', function () {
    $specie = Specie::first();

    Livewire::test(OrderForm::class)
        ->set('nume', 'Ion Real')
        ->set('telefon', '+40700000002')
        ->set('localitate', 'Ploiesti')
        ->set('specieId', $specie->id)
        ->set('cantitate', 2)
        ->set('unitate', 'ster')
        ->set('gdpr', true)
        ->call('submit')
        ->assertSet('submitted', true);

    expect(ComandaLemn::count())->toBe(1);
});

/*
 * ---------- Anti-spam: rate limit ----------
 */

it('rate-limits repeated order-form submissions from the same IP', function () {
    $specie = Specie::first();
    $component = Livewire::test(OrderForm::class);

    $fill = fn () => $component
        ->set('nume', 'Repeat Bot')
        ->set('telefon', '+40700000000')
        ->set('localitate', 'Ploiesti')
        ->set('specieId', $specie->id)
        ->set('cantitate', 1)
        ->set('unitate', 'ster')
        ->set('gdpr', true)
        ->call('submit');

    for ($i = 0; $i < 5; $i++) {
        $fill();
    }
    expect(ComandaLemn::count())->toBe(5);

    // 6th within the same minute is blocked with a RO throttle error.
    $fill()->assertHasErrors('throttle');
    expect(ComandaLemn::count())->toBe(5);
});
