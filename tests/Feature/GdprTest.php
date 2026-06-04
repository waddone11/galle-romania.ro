<?php

use App\Livewire\ContactForm;
use App\Livewire\Firewood\OrderForm;
use App\Models\ComandaLemn;
use App\Models\Lead;
use Database\Seeders\PaginaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('serves the impressum page in all three locales', function (string $uri) {
    $this->seed(PaginaSeeder::class);

    $this->get($uri)
        ->assertOk()
        ->assertSee('GALLE SILVA SRL')
        ->assertSee('52771440')           // CUI
        ->assertSee('J2025081738000');    // Reg. Com.
})->with(['/date-firma', '/de/date-firma', '/en/date-firma']);

it('links the impressum and cookie settings in the footer', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('date-firma')
        ->assertSee('galle-open-cookie-settings', false);
});

it('rejects the contact form without GDPR consent', function () {
    Livewire::test(ContactForm::class)
        ->set('nume', 'Test')
        ->set('email', 'test@example.com')
        ->set('mesaj', 'Un mesaj de test suficient de lung.')
        ->call('submit')
        ->assertHasErrors(['gdpr' => 'accepted']);

    expect(Lead::count())->toBe(0);
});

it('accepts the contact form with GDPR consent', function () {
    Livewire::test(ContactForm::class)
        ->set('nume', 'Test')
        ->set('email', 'test@example.com')
        ->set('mesaj', 'Un mesaj de test suficient de lung.')
        ->set('gdpr', true)
        ->call('submit')
        ->assertHasNoErrors();

    expect(Lead::count())->toBe(1);
});

it('rejects the firewood order form without GDPR consent', function () {
    Livewire::test(OrderForm::class)
        ->set('nume', 'Test')
        ->set('telefon', '0729000000')
        ->set('localitate', 'Ploiesti')
        ->call('submit')
        ->assertHasErrors(['gdpr' => 'accepted']);

    expect(ComandaLemn::count())->toBe(0);
});

it('shows the granular cookie consent with equal-weight actions', function () {
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('Accept toate')
        ->assertSee('Refuz')
        ->assertSee('Setari')
        ->assertSee('galle_cookie_consent', false)
        ->assertSee('data-consent', false);
});
