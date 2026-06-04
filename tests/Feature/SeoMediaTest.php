<?php

use Database\Seeders\ArticolSeeder;
use Database\Seeders\LocalitateSeeder;
use Database\Seeders\PaginaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/*
 * ---------- Blog ----------
 */

it('renders the blog index with the seeded articles', function () {
    $this->seed(ArticolSeeder::class);

    $this->get('/blog')
        ->assertOk()
        ->assertSee('Metru ster vs metru cub', false)
        ->assertSee('blog/vreau-sa-vand-padure-pasii-corecti');
});

it('renders an article with Article JSON-LD and its image', function () {
    $this->seed(ArticolSeeder::class);

    $this->get('/blog/metru-ster-vs-metru-cub-lemn-de-foc')
        ->assertOk()
        ->assertSee('"@type":"Article"', false)
        ->assertSee('gramada-busteni-wide', false)
        ->assertSee('/lemn-de-foc', false); // interlinking intern
});

/*
 * ---------- Poze cheie (git-tracked in public/) ----------
 */

it('ships the key real photos in public', function (string $path) {
    expect(is_file(public_path($path)))->toBeTrue("lipseste public/{$path}");
})->with([
    'images/galle/proiecte/harvester-galle-wide.webp',
    'images/galle/proiecte/harvester-galle.webp',
    'images/galle/proiecte/harvester-galle-wide.jpg',
    'images/galle/proiecte/camion-incarcat.webp',
    'images/galle/proiecte/gramada-busteni-wide.webp',
    'images/galle/proiecte/busteni-marcati-wide.webp',
    'images/galle/proiecte/depozit-amurg-wide.webp',
    'images/galle/proiecte/forwarder-drum-wide.webp',
    'images/galle/proiecte/depozit-utilaj.webp',
    'images/galle/proiecte/harvester-lucru-wide.webp',
    'images/galle/proiecte/lemn-de-foc-paleti-wide.webp',
    'images/galle/proiecte/lemn-de-foc-paleti-wide.jpg',
    'images/galle/proiecte/lemn-de-foc-paleti.webp',
    'images/galle/proiecte/lemn-de-foc-paleti.jpg',
]);

/*
 * ---------- SEO tags per pagina ----------
 */

it('renders full SEO tags on the homepage', function () {
    $this->seed(PaginaSeeder::class);

    $this->get('/')
        ->assertOk()
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('hreflang="ro"', false)
        ->assertSee('hreflang="de"', false)
        ->assertSee('hreflang="x-default"', false)
        ->assertSee('og:image', false)
        ->assertSee('harvester-galle-wide.jpg', false)
        ->assertSee('"@type":"WebSite"', false);
});

it('renders SEO tags + og:image from the header image on a service page', function () {
    $this->seed(PaginaSeeder::class);

    $this->get('/servicii/exploatare-forestiera')
        ->assertOk()
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('hreflang="en"', false)
        ->assertSee('harvester-galle-wide.jpg', false)
        ->assertSee('"@type":"Service"', false);
});

it('renders the hero photo + og:image on lemn-de-foc and the local landings', function () {
    $this->seed(PaginaSeeder::class);
    $this->seed(LocalitateSeeder::class);

    // Pagina principala: hero foto responsive (webp wide + patrat) + og:image jpg.
    $this->get('/lemn-de-foc')
        ->assertOk()
        ->assertSee('lemn-de-foc-paleti-wide.webp', false)
        ->assertSee('lemn-de-foc-paleti.webp', false)
        ->assertSee('lemn-de-foc-paleti-wide.jpg', false);

    // Landing-urile locale mostenesc acelasi hero + og:image.
    $this->get('/lemn-de-foc/ploiesti')
        ->assertOk()
        ->assertSee('lemn-de-foc-paleti-wide.webp', false)
        ->assertSee('lemn-de-foc-paleti-wide.jpg', false);
});

it('renders SEO tags on an article', function () {
    $this->seed(ArticolSeeder::class);

    $this->get('/blog/ce-inseamna-apv-si-de-ce-conteaza')
        ->assertOk()
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('og:image', false)
        ->assertSee('harvester-galle-wide.jpg', false);
});

/*
 * ---------- Sitemap ----------
 */

it('includes services, local landings, blog and date-firma in the sitemap', function () {
    // Self-contained: alt test poate suprascrie sitemap-ul din DB-ul de test —
    // il regeneram aici cu datele relevante seed-uite.
    $this->seed(PaginaSeeder::class);
    $this->seed(ArticolSeeder::class);
    $this->seed(LocalitateSeeder::class);
    $this->artisan('sitemap:generate')->assertSuccessful();

    $sitemap = file_get_contents(public_path('sitemap.xml'));

    expect($sitemap)
        ->toContain('/servicii/exploatare-forestiera')
        ->toContain('/servicii/achizitie-masa-lemnoasa')
        ->toContain('/servicii/transport-lemn')
        ->toContain('/lemn-de-foc/ploiesti')
        ->toContain('/lemn-de-foc/campina')
        ->toContain('/blog/metru-ster-vs-metru-cub-lemn-de-foc')
        ->toContain('/date-firma');
});

/*
 * ---------- Diacritice pe home ----------
 */

it('serves the home content with Romanian diacritics', function () {
    $this->seed(PaginaSeeder::class);

    $this->get('/')
        ->assertOk()
        ->assertSee('Pădurea, gestionată cu responsabilitate')
        ->assertSee('Scoatem pădurea din ceață.')
        ->assertSee('Exploatare forestieră');
});
