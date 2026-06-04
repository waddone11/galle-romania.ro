<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

$adminEmail = fn (): string => config('app.admin_email');
$adminPassword = fn (): string => config('app.admin_password');

// ── Pagini ──────────────────────────────────────────────────────────────

it('renders the login page on all locales', function () {
    $this->get('/autentificare')->assertOk()->assertSeeLivewire(Login::class);
    $this->get('/de/autentificare')->assertOk();
    $this->get('/en/autentificare')->assertOk();
});

it('renders the register page on all locales', function () {
    $this->get('/inregistrare')->assertOk()->assertSeeLivewire(Register::class);
    $this->get('/de/inregistrare')->assertOk();
    $this->get('/en/inregistrare')->assertOk();
});

// ── Login ───────────────────────────────────────────────────────────────

it('logs in the seeded admin and redirects to the Filament panel', function () use ($adminEmail, $adminPassword) {
    $this->seed(AdminUserSeeder::class);

    Livewire::test(Login::class)
        ->set('email', $adminEmail())
        ->set('password', $adminPassword())
        ->call('submit')
        ->assertRedirect(url('/admin'));

    $this->assertAuthenticated();
});

it('logs in a client and redirects to home', function () {
    $user = User::factory()->create(['password' => 'parola-client-123']);

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'parola-client-123')
        ->call('submit')
        ->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($user);
});

it('redirects a client to the localized home after login on /de', function () {
    $user = User::factory()->create(['password' => 'parola-client-123']);

    app()->setLocale('de');

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'parola-client-123')
        ->call('submit')
        ->assertRedirect(route('de.home'));
});

it('shows a generic error for wrong credentials', function () {
    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'parola-gresita')
        ->call('submit')
        ->assertHasErrors('email');

    $this->assertGuest();
});

it('throttles repeated failed login attempts', function () {
    $user = User::factory()->create();

    foreach (range(1, 5) as $i) {
        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'parola-gresita')
            ->call('submit');
    }

    // Chiar si cu parola corecta, contul e blocat temporar.
    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('submit')
        ->assertHasErrors('email');

    $this->assertGuest();
});

// ── Register ────────────────────────────────────────────────────────────

it('registers a new user as client and redirects to home', function () {
    Livewire::test(Register::class)
        ->set('name', 'Ion Pop')
        ->set('email', 'ion.pop@example.com')
        ->set('password', 'parola-sigura-1')
        ->set('password_confirmation', 'parola-sigura-1')
        ->call('submit')
        ->assertRedirect(route('home'));

    $user = User::where('email', 'ion.pop@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->role)->toBe('client');

    $this->assertAuthenticatedAs($user);
});

it('rejects registration with an already used email', function () {
    $existing = User::factory()->create();

    Livewire::test(Register::class)
        ->set('name', 'Ion Pop')
        ->set('email', $existing->email)
        ->set('password', 'parola-sigura-1')
        ->set('password_confirmation', 'parola-sigura-1')
        ->call('submit')
        ->assertHasErrors(['email' => 'unique']);

    $this->assertGuest();
});

it('requires a confirmed password of minimum 8 characters', function () {
    Livewire::test(Register::class)
        ->set('name', 'Ion Pop')
        ->set('email', 'ion.pop@example.com')
        ->set('password', 'scurt')
        ->set('password_confirmation', 'scurt')
        ->call('submit')
        ->assertHasErrors(['password' => 'min']);

    Livewire::test(Register::class)
        ->set('name', 'Ion Pop')
        ->set('email', 'ion.pop@example.com')
        ->set('password', 'parola-sigura-1')
        ->set('password_confirmation', 'alta-parola-99')
        ->call('submit')
        ->assertHasErrors(['password' => 'confirmed']);

    $this->assertGuest();
});

// ── Logout ──────────────────────────────────────────────────────────────

it('logs out via POST and redirects to home', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/logout')->assertRedirect('/');

    $this->assertGuest();
});

// ── Footer pe stare ─────────────────────────────────────────────────────

it('shows login and register links in the footer for guests', function () {
    $this->blade('<x-site-footer />')
        ->assertSee(__('Autentificare'))
        ->assertSee(__('Cont nou'))
        ->assertDontSee(url('/admin'), false)
        ->assertDontSee(__('Iesire'));
});

it('shows only logout in the footer for an authenticated client', function () {
    $this->actingAs(User::factory()->create());

    $this->blade('<x-site-footer />')
        ->assertSee(__('Iesire'))
        ->assertDontSee(url('/admin'), false)
        ->assertDontSee('/autentificare', false);
});

it('shows admin and logout links in the footer for an admin', function () use ($adminEmail) {
    $this->seed(AdminUserSeeder::class);

    $this->actingAs(User::where('email', $adminEmail())->firstOrFail());

    $this->blade('<x-site-footer />')
        ->assertSee(url('/admin'), false)
        ->assertSee(__('Iesire'));
});

// ── Autorizare panou ────────────────────────────────────────────────────

it('forbids a client from accessing the Filament panel', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/admin')->assertForbidden();
});
