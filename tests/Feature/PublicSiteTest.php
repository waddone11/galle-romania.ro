<?php

use App\Enums\ComandaStatus;
use App\Livewire\ContactForm;
use App\Livewire\Firewood\OrderForm;
use App\Livewire\Firewood\PriceCalculator;
use App\Models\ComandaLemn;
use App\Models\Lead;
use App\Models\Specie;
use App\Models\ZonaLivrare;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\CertificareSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\PaginaSeeder;
use Database\Seeders\ServiciuSeeder;
use Database\Seeders\SpecieSeeder;
use Database\Seeders\TraducereSeeder;
use Database\Seeders\ZonaLivrareSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    // Diacriticele RO pentru cheile UI vin din stratul de traduceri.
    $this->seed(TraducereSeeder::class);
});

it('renders home page with seeded species in the wheel', function () {
    $r = $this->get('/');
    $r->assertOk();
    $r->assertSeeText('Pădurea, ');
    $r->assertSeeText('Stejar');
});

it('renders lemn-de-foc page with calculator and order form', function () {
    $r = $this->get('/lemn-de-foc');
    $r->assertOk();
    $r->assertSeeText('Calculator preț');
    $r->assertSeeText('Comandă lemn');
});

it('renders servicii, despre, certificari, contact, blog, proiecte', function () {
    foreach (['/servicii', '/despre', '/certificari', '/contact', '/blog', '/proiecte'] as $path) {
        $this->get($path)->assertOk();
    }
});

it('routes /de and /en variants to RO controller', function () {
    $this->get('/de')->assertOk();
    $this->get('/en')->assertOk();
});

it('admin panel login screen is accessible (200)', function () {
    $this->get('/admin/login')->assertOk();
});

it('OrderForm Livewire saves a ComandaLemn row with status nou', function () {
    $specie = Specie::first();

    Livewire::test(OrderForm::class)
        ->set('nume', 'Ion Popescu')
        ->set('telefon', '+40700000001')
        ->set('email', 'ion@example.com')
        ->set('localitate', 'Ploiesti')
        ->set('specieId', $specie->id)
        ->set('cantitate', 3)
        ->set('unitate', 'ster')
        ->set('gdpr', true)
        ->call('submit')
        ->assertSet('submitted', true);

    expect(ComandaLemn::count())->toBe(1);
    expect(ComandaLemn::first()->status)->toBe(ComandaStatus::Nou);
    expect(ComandaLemn::first()->nume)->toBe('Ion Popescu');
});

it('ContactForm Livewire saves a Lead row with status nou', function () {
    Livewire::test(ContactForm::class)
        ->set('nume', 'Maria Pop')
        ->set('email', 'maria@example.com')
        ->set('mesaj', 'Doresc oferta pentru serviciu de peisagistica.')
        ->set('gdpr', true)
        ->call('submit')
        ->assertSet('submitted', true);

    expect(Lead::count())->toBe(1);
    expect(Lead::first()->status)->toBe(ComandaStatus::Nou);
});

it('PriceCalculator computes total = pret_lemn * cantitate + cost_livrare', function () {
    $specie = Specie::where('status', 'disponibil')->first();
    $zona = ZonaLivrare::first();

    Livewire::test(PriceCalculator::class)
        ->set('specieId', $specie->id)
        ->set('zonaId', $zona->id)
        ->set('cantitate', 2)
        ->assertSet('cantitate', 2)
        ->tap(function ($component) use ($specie, $zona) {
            $expectedTotal = round($specie->pret_per_unitate * 2 + $zona->cost_livrare, 2);
            expect((float) $component->instance()->total)->toBe($expectedTotal);
        });
});
