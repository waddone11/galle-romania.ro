<?php

use App\Models\Faq;
use Database\Seeders\FaqSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\SpecieSeeder;
use Database\Seeders\TraducereSeeder;
use Database\Seeders\ZonaLivrareSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(FaqSeeder::class);
    $this->seed(PaginaSeeder::class);
    $this->seed(TraducereSeeder::class);
});

it('renders /intrebari-frecvente with all published questions grouped by category', function () {
    $r = $this->get('/intrebari-frecvente');
    $r->assertOk();
    $r->assertSeeText('Întrebări frecvente');

    // Toate intrebarile publicate sunt pe pagina (inclusiv cele din faq.json).
    foreach (Faq::where('is_published', true)->get() as $faq) {
        $r->assertSeeText($faq->getTranslation('intrebare', 'ro'));
    }

    // Etichete de grup pentru categoriile principale.
    $r->assertSeeText('Lemn de foc');
    $r->assertSeeText('Livrare');
    $r->assertSeeText('Întrebări generale');
});

it('serves the FAQ page on all three locales', function () {
    $this->get('/intrebari-frecvente')->assertOk();
    $this->get('/de/intrebari-frecvente')->assertOk();
    $this->get('/en/intrebari-frecvente')->assertOk();
});

it('includes a FAQPage JSON-LD schema with every published question', function () {
    $html = $this->get('/intrebari-frecvente')->getContent();

    expect($html)->toContain('"@type":"FAQPage"');

    preg_match('/<script type="application\/ld\+json">(\{"@context":"https:\/\/schema\.org","@type":"FAQPage".*?\})<\/script>/s', $html, $m);
    expect($m)->not->toBeEmpty();

    $schema = json_decode($m[1], true);
    expect($schema['mainEntity'])->toHaveCount(Faq::where('is_published', true)->count());
});

it('seeds the researched faq.json questions idempotently', function () {
    expect(Faq::where('intrebare->ro', 'Lemnul de foc este uscat sau trebuie lăsat la uscat?')->count())->toBe(1);

    // Re-rulare seeder => fara dubluri.
    $this->seed(FaqSeeder::class);
    expect(Faq::where('intrebare->ro', 'Lemnul de foc este uscat sau trebuie lăsat la uscat?')->count())->toBe(1);

    // Nicio categorie cu underscore.
    expect(Faq::where('categorie', 'like', '%\_%')->count())->toBe(0);
});

it('redirects /faq to /intrebari-frecvente with 301', function () {
    $this->get('/faq')->assertRedirect('/intrebari-frecvente')->assertStatus(301);
    $this->get('/de/faq')->assertRedirect('/de/intrebari-frecvente')->assertStatus(301);
});

it('keeps the lemn-de-foc FAQ section and FAQPage schema intact', function () {
    $this->seed(SpecieSeeder::class);
    $this->seed(ZonaLivrareSeeder::class);

    $r = $this->get('/lemn-de-foc');
    $r->assertOk();
    $r->assertSeeText('Cât costă un metru cub de lemn de foc?');
    expect($r->getContent())->toContain('"@type":"FAQPage"');
});

it('shows the FAQ teaser on home and the nav/footer links', function () {
    $this->seed(SpecieSeeder::class);

    $r = $this->get('/');
    $r->assertOk();
    $r->assertSee('/intrebari-frecvente');
    $r->assertSeeText('Vezi toate întrebările');
});

/*
 * ---------- Restilizare /intrebari-frecvente (hero + search flotant + rail + acordeoane) ----------
 */

it('renders the restyled FAQ page with search, anchors, rail and accessible accordions', function () {
    $html = $this->get('/intrebari-frecvente')->assertOk()->getContent();
    $total = Faq::where('is_published', true)->count();

    expect($html)
        // search + contor live (valoarea initiala randata pe server)
        ->toContain('id="faq-cauta"')
        ->toContain('>'.$total.'</span>')
        // ancore de categorie + link-uri in rail/pills
        ->toContain('id="cat-lemn-de-foc"')
        ->toContain('href="#cat-lemn-de-foc"')
        // carduri acordeon accesibile
        ->toContain('data-faq-card')
        ->toContain('aria-expanded');
});

it('keeps the category order: lemn de foc, livrare, plata first', function () {
    $html = $this->get('/intrebari-frecvente')->assertOk()->getContent();

    $lemn = strpos($html, 'id="cat-lemn-de-foc"');
    $livrare = strpos($html, 'id="cat-livrare"');
    $plata = strpos($html, 'id="cat-plata"');

    expect($lemn)->not->toBeFalse()
        ->and($livrare)->not->toBeFalse()
        ->and($plata)->not->toBeFalse()
        ->and($lemn)->toBeLessThan($livrare)
        ->and($livrare)->toBeLessThan($plata);
});

it('shows toggle-all, empty-state scaffolding and the contact CTA banner', function () {
    $html = $this->get('/intrebari-frecvente')->assertOk()->getContent();

    expect($html)
        ->toContain('Deschide toate')
        ->toContain('Închide toate')
        ->toContain('Șterge căutarea')
        ->toContain('Nu ai găsit răspunsul?')
        ->toContain('Cere ofertă')
        ->toContain('href="/contact"');
});

it('aligns the home FAQ teaser with the new accordion card style', function () {
    $this->seed(SpecieSeeder::class);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)->toContain('data-faq-card');
});
