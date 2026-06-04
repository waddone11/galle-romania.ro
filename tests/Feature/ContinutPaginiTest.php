<?php

use App\Livewire\Firewood\OrderForm;
use App\Models\ComandaLemn;
use App\Models\Localitate;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\LocalitateSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\SpecieSeeder;
use Database\Seeders\TraducereSeeder;
use Database\Seeders\ZonaLivrareSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AdminUserSeeder::class);
    $this->seed(SpecieSeeder::class);
    $this->seed(ZonaLivrareSeeder::class);
    $this->seed(LocalitateSeeder::class);
    $this->seed(FaqSeeder::class);
    $this->seed(PaginaSeeder::class);
    // Diacriticele RO pentru cheile UI vin din stratul de traduceri.
    $this->seed(TraducereSeeder::class);
});

/*
 * ---------- Pagini de servicii (CMS) ----------
 */

it('renders each service page with Service + FAQPage + BreadcrumbList schema', function (string $slug) {
    $html = $this->get("/servicii/{$slug}")->assertOk()->getContent();

    expect($html)
        ->toContain('"@type":"Service"')
        ->toContain('"@type":"FAQPage"')
        ->toContain('"@type":"BreadcrumbList"')
        ->toContain('Galle Silva SRL');
})->with([
    'exploatare-forestiera',
    'achizitie-masa-lemnoasa',
    'curatare-terenuri',
    'transport-lemn',
    'lucrari-silvice',
]);

it('renders the servicii overview with cards to all 6 services', function () {
    $html = $this->get('/servicii')->assertOk()->getContent();

    expect($html)
        ->toContain('Servicii forestiere complete în Prahova')
        ->toContain('/servicii/exploatare-forestiera')
        ->toContain('/servicii/achizitie-masa-lemnoasa')
        ->toContain('/servicii/curatare-terenuri')
        ->toContain('/servicii/transport-lemn')
        ->toContain('/servicii/lucrari-silvice')
        ->toContain('/lemn-de-foc');
});

it('serves service pages on all three locales', function () {
    $this->get('/de/servicii/exploatare-forestiera')->assertOk();
    $this->get('/en/servicii/exploatare-forestiera')->assertOk();
});

it('redirects the old service routes with 301', function (string $from, string $to) {
    $this->get($from)->assertMovedPermanently()->assertRedirect($to);
})->with([
    ['/servicii/forestiere', '/servicii/exploatare-forestiera'],
    ['/servicii/peisagistica', '/servicii'],
    ['/servicii/compostare', '/servicii'],
    ['/de/servicii/forestiere', '/de/servicii/exploatare-forestiera'],
    ['/en/servicii/compostare', '/en/servicii'],
]);

/*
 * ---------- Lemn de foc imbogatit ----------
 */

it('renders the enriched lemn-de-foc page with pricing and ster vs cub sections', function () {
    $r = $this->get('/lemn-de-foc');
    $r->assertOk();
    $r->assertSeeText('de la 350 lei/m³');
    $r->assertSeeText('Metru ster vs metru cub');
    $r->assertSeeText('Esențe: stejar și carpen pe stoc');
});

/*
 * ---------- Landing-uri locale ----------
 */

it('renders local landing pages with localized H1 and canonical to /lemn-de-foc', function () {
    $html = $this->get('/lemn-de-foc/ploiesti')->assertOk()->getContent();

    expect($html)
        ->toContain('Lemn de foc în Ploiești')
        ->toContain('<link rel="canonical" href="'.url('/lemn-de-foc').'">');
});

it('renders every seeded locality landing page', function () {
    foreach (Localitate::where('is_active', true)->get() as $localitate) {
        $this->get("/lemn-de-foc/{$localitate->slug}")
            ->assertOk()
            ->assertSeeText($localitate->nume);
    }
});

it('returns 404 for an unknown or inactive locality', function () {
    $this->get('/lemn-de-foc/atlantida')->assertNotFound();

    Localitate::where('slug', 'ploiesti')->update(['is_active' => false]);
    $this->get('/lemn-de-foc/ploiesti')->assertNotFound();
});

/*
 * ---------- Comanda cu consimtamant (acceptanta T2) ----------
 */

it('stores an order only when GDPR consent is checked', function () {
    $base = fn () => Livewire::test(OrderForm::class)
        ->set('nume', 'Ion Popescu')
        ->set('telefon', '0712345678')
        ->set('localitate', 'Ploiesti')
        ->set('cantitate', 3);

    $base()->call('submit')->assertHasErrors(['gdpr' => 'accepted']);
    expect(ComandaLemn::count())->toBe(0);

    $base()->set('gdpr', true)->call('submit')->assertHasNoErrors();
    expect(ComandaLemn::count())->toBe(1);
});
