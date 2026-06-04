<?php

use App\Models\Articol;
use App\Models\Membru;
use App\Models\Proiect;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\CertificareSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\MembruSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\ProiectSeeder;
use Database\Seeders\ServiciuSeeder;
use Database\Seeders\SpecieSeeder;
use Database\Seeders\TraducereSeeder;
use Database\Seeders\ZonaLivrareSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AdminUserSeeder::class);
    $this->seed(SpecieSeeder::class);
    $this->seed(ServiciuSeeder::class);
    $this->seed(CertificareSeeder::class);
    $this->seed(ZonaLivrareSeeder::class);
    $this->seed(FaqSeeder::class);
    $this->seed(MembruSeeder::class);
    $this->seed(PaginaSeeder::class);
    $this->seed(TraducereSeeder::class);
});

it('shows blog and proiecte links in the navbar dropdown and footer', function () {
    $r = $this->get('/');
    $r->assertOk();
    $r->assertSeeText('Resurse');
    $r->assertSee('/proiecte');
    $r->assertSee('/blog');
});

it('renders the proiecte and blog teasers on home', function () {
    Proiect::factory()->create(['titlu' => ['ro' => 'Proiect teaser test', 'de' => null, 'en' => null]]);
    Articol::factory()->create(['titlu' => ['ro' => 'Articol teaser test', 'de' => null, 'en' => null]]);

    $r = $this->get('/');
    $r->assertOk();
    // Blocul proiecte_recente (CMS) + linkul spre portofoliu.
    $r->assertSeeText('Proiecte recente');
    $r->assertSeeText('Proiect teaser test');
    $r->assertSeeText('Vezi toate proiectele');
    // Blocul blog_recent (CMS) + linkul spre blog.
    $r->assertSeeText('Ghiduri & noutăți');
    $r->assertSeeText('Articol teaser test');
    $r->assertSeeText('Vezi blogul');
});

it('seeds medialibrary covers and renders them on /proiecte', function () {
    $this->seed(ProiectSeeder::class);

    expect(Proiect::where('slug', 'gestiune-padure-domeniu-prahova')->first()->getMedia('galerie'))
        ->not->toBeEmpty();

    $r = $this->get('/proiecte');
    $r->assertOk();
    // Cover-urile medialibrary se servesc de pe discul public (/storage/...).
    $r->assertSee('/storage/');
});

it('renders the project gallery on the project detail page', function () {
    $this->seed(ProiectSeeder::class);

    $r = $this->get('/proiecte/gestiune-padure-domeniu-prahova');
    $r->assertOk();
    $r->assertSee('/storage/');
});

it('seeds the team idempotently', function () {
    expect(Membru::count())->toBe(4);

    $this->seed(MembruSeeder::class);

    expect(Membru::count())->toBe(4);
});

it('renders the team block with names and roles on /despre', function () {
    $r = $this->get('/despre');
    $r->assertOk();
    $r->assertSeeText('Echipa');
    $r->assertSeeText('Răzvan Solzaru');
    $r->assertSeeText('Manager general');
    $r->assertSeeText('Roată Alexandru');
});

it('hides inactive members from /despre', function () {
    Membru::where('nume', 'Roată Alexandru')->update(['is_active' => false]);

    $r = $this->get('/despre');
    $r->assertOk();
    $r->assertDontSeeText('Roată Alexandru');
});
