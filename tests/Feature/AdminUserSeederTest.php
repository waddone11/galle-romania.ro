<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

$adminEmail = fn (): string => config('app.admin_email');
$adminPassword = fn (): string => config('app.admin_password');

it('seeds the admin user with credentials from env (or fallback)', function () use ($adminEmail, $adminPassword) {
    $this->seed(AdminUserSeeder::class);

    $admin = User::where('email', $adminEmail())->first();

    expect($admin)->not->toBeNull()
        ->and($admin->name)->toBe('Adrian Vasilescu')
        ->and($admin->email_verified_at)->not->toBeNull()
        ->and(Hash::check($adminPassword(), $admin->password))->toBeTrue();
});

it('lets the seeded admin access the Filament panel', function () use ($adminEmail) {
    $this->seed(AdminUserSeeder::class);

    $admin = User::where('email', $adminEmail())->firstOrFail();

    expect($admin->canAccessPanel(Filament::getPanel('admin')))->toBeTrue();
});

it('lets the seeded admin load the panel dashboard', function () use ($adminEmail) {
    $this->seed(AdminUserSeeder::class);

    $admin = User::where('email', $adminEmail())->firstOrFail();

    $this->actingAs($admin)->get('/admin')->assertOk();
});

it('redirects guests from /admin to the Filament login', function () {
    $this->get('/admin')->assertRedirect();
});

it('seeds the admin user with role admin', function () use ($adminEmail) {
    $this->seed(AdminUserSeeder::class);

    $admin = User::where('email', $adminEmail())->firstOrFail();

    expect($admin->role)->toBe('admin');
});

it('defaults new users to role client', function () {
    $user = User::factory()->create();

    expect($user->role)->toBe('client');
});

it('denies panel access to a client user', function () {
    $user = User::factory()->create();

    expect($user->canAccessPanel(Filament::getPanel('admin')))->toBeFalse();
});

it('grants panel access by role column, not Spatie roles', function () {
    $user = User::factory()->create();
    $user->forceFill(['role' => 'admin'])->save();

    expect($user->refresh()->canAccessPanel(Filament::getPanel('admin')))->toBeTrue();
});

it('does not duplicate the admin user on re-seed', function () use ($adminEmail) {
    $this->seed(AdminUserSeeder::class);
    $this->seed(AdminUserSeeder::class);

    expect(User::where('email', $adminEmail())->count())->toBe(1);
});

it('shows a discreet Admin link to /admin in the footer for admins', function () use ($adminEmail) {
    $this->seed(AdminUserSeeder::class);

    $this->actingAs(User::where('email', $adminEmail())->firstOrFail());

    $this->blade('<x-site-footer />')->assertSee(url('/admin'), false);
});
