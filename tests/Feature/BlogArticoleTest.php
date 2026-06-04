<?php

use App\Models\Articol;
use Database\Seeders\ArticolSeeder;
use Database\Seeders\TraducereSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(ArticolSeeder::class);
    $this->seed(TraducereSeeder::class);
});

const ARTICOLE_NOI = [
    'lemn-uscat-vs-lemn-verde-cum-recunosti',
    'cum-depozitezi-corect-lemnul-de-foc',
    'lemn-de-foc-paletizat-sau-vrac',
    'acte-cumparare-lemn-de-foc-aviz-factura-sumal',
    'transport-lemn-aviz-sumal-ce-trebuie-sa-stii',
    'cum-alegi-firma-serioasa-exploatare-forestiera',
    'harvester-forwarder-utilaje-moderne-padure',
    'de-ce-conteaza-rariturile-si-curatirile-in-padure',
    'scos-cioate-metode-utilaje-cand-este-necesar',
    'defrisare-teren-pentru-constructie-pasi-verificari',
];

it('seeds 16 published articles (6 istorice + 10 extinse)', function () {
    expect(Articol::count())->toBe(16)
        ->and(Articol::where('is_published', true)->count())->toBe(16);
});

it('is idempotent — re-running the seeder does not duplicate articles', function () {
    $this->seed(ArticolSeeder::class);

    expect(Articol::count())->toBe(16);
});

it('lists articles on /blog (paginated, articolele noi mai vechi pe pagina 2)', function () {
    // Pagina 1: cele mai recente (istorice + cele mai noi dintre extinse).
    $r = $this->get('/blog');
    $r->assertOk();
    $r->assertSeeText('Scos cioate');

    // Articolele extinse cu published_at mai vechi apar pe pagina 2.
    $r2 = $this->get('/blog?page=2');
    $r2->assertOk();
    $r2->assertSeeText('Lemn uscat vs lemn verde');
});

it('renders every new article at /blog/{slug}', function (string $slug) {
    $this->get("/blog/{$slug}")->assertOk();
})->with(ARTICOLE_NOI);

it('falls back to RO content on /de and /en article pages', function () {
    $slug = 'lemn-uscat-vs-lemn-verde-cum-recunosti';

    $this->get("/de/blog/{$slug}")->assertOk()->assertSeeText('Lemnul bun pentru foc');
    $this->get("/en/blog/{$slug}")->assertOk()->assertSeeText('Lemnul bun pentru foc');
});

it('gives every new article a substantial body (~1000+ cuvinte)', function () {
    foreach (ARTICOLE_NOI as $slug) {
        $articol = Articol::where('slug', $slug)->firstOrFail();
        $cuvinte = count(preg_split('/\s+/u', trim($articol->getTranslation('continut', 'ro')), -1, PREG_SPLIT_NO_EMPTY) ?: []);

        expect($cuvinte)->toBeGreaterThan(950, "Articolul {$slug} are doar {$cuvinte} cuvinte");
    }
});

it('renders markdown-lite as HTML (headings + internal links), not literal markdown', function () {
    $r = $this->get('/blog/lemn-uscat-vs-lemn-verde-cum-recunosti');
    $r->assertOk();
    // Subtitlurile ## devin <h2>, nu raman text brut.
    $r->assertSee('<h2 class="font-display', false);
    $r->assertDontSee('## Ce înseamnă lemn verde');
    // Interlinking-ul [text](/url) devine ancora interna.
    $r->assertSee('href="/lemn-de-foc"', false);
    $r->assertSee('href="/blog/cum-depozitezi-corect-lemnul-de-foc"', false);
});

it('handles imagine = null without errors and keeps Article schema', function () {
    $articol = Articol::where('slug', 'scos-cioate-metode-utilaje-cand-este-necesar')->firstOrFail();
    expect($articol->imagine)->toBeNull();

    $r = $this->get("/blog/{$articol->slug}");
    $r->assertOk();
    $r->assertSee('"@type":"Article"', false);
});

it('respects accuracy rules in the new content', function () {
    foreach (ARTICOLE_NOI as $slug) {
        $continut = Articol::where('slug', $slug)->firstOrFail()->getTranslation('continut', 'ro');

        // Nicio afirmatie de certificare obtinuta (FSC/PEFC doar "in proces", daca apar).
        expect(mb_stripos($continut, 'certificat FSC'))->toBeFalse()
            ->and(mb_stripos($continut, 'certificare obținută'))->toBeFalse();
    }

    // Pretul corect apare in articolele de lemn de foc.
    $lemnFoc = Articol::where('slug', 'lemn-uscat-vs-lemn-verde-cum-recunosti')->firstOrFail();
    expect($lemnFoc->getTranslation('continut', 'ro'))->toContain('de la 350 lei/m³');
});
