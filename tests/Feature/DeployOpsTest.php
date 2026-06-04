<?php

beforeEach(function () {
    config()->set('deploy.secret', 'secret-test');
});

it('raspunde 404 cand operatiunile sunt dezactivate, chiar cu secret corect', function () {
    config()->set('deploy.enabled', false);

    $this->get('/__ops/cache-clear?secret=secret-test')->assertNotFound();
});

it('raspunde 404 cu secret gresit sau lipsa', function () {
    config()->set('deploy.enabled', true);

    $this->get('/__ops/cache-clear?secret=gresit')->assertNotFound();
    $this->get('/__ops/cache-clear')->assertNotFound();
});

it('raspunde 404 cand secretul configurat e gol, indiferent de query', function () {
    config()->set('deploy.enabled', true);
    config()->set('deploy.secret', '');

    $this->get('/__ops/cache-clear?secret=')->assertNotFound();
});

it('ruleaza cache-clear cu secret corect si enabled', function () {
    config()->set('deploy.enabled', true);

    $this->get('/__ops/cache-clear?secret=secret-test')
        ->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=utf-8')
        ->assertSee('optimize:clear');
});

it('refuza migrate-fresh-seed fara tokenul de confirmare', function () {
    config()->set('deploy.enabled', true);

    $this->get('/__ops/migrate-fresh-seed?secret=secret-test')
        ->assertStatus(422)
        ->assertSee('STERGE TOATA BAZA DE DATE');
});

it('ruleaza migrate cu secret corect', function () {
    config()->set('deploy.enabled', true);

    // Smoke real: migratiile sunt deja la zi pe DB-ul de test (RefreshDatabase global
    // nu e folosit aici; migrate pe schema curenta e no-op sigur).
    $this->get('/__ops/migrate?secret=secret-test')
        ->assertOk()
        ->assertSee('php artisan migrate');
});

it('trateaza storage-link existent fara eroare', function () {
    config()->set('deploy.enabled', true);

    $raspuns = $this->get('/__ops/storage-link?secret=secret-test');

    $raspuns->assertOk();
    expect($raspuns->getContent())->toContain('storage');
});
