<?php

namespace App\Livewire\Concerns;

use Illuminate\Support\Facades\RateLimiter;

/**
 * Anti-spam pentru formularele publice Livewire:
 *  - honeypot (`website`) — camp ascuns; daca e completat, e bot → drop silentios;
 *  - rate limit — max 5 trimiteri / minut / IP.
 *
 * Lead-urile valide se salveaza in continuare; doar botii sunt blocati.
 */
trait HasSpamProtection
{
    /** Honeypot — trebuie sa ramana gol (ascuns vizual + pentru screen-reader). */
    public string $website = '';

    /** Marcat true dupa o trimitere reusita (sau honeypot, ca sa nu dam indicii botilor). */
    public bool $submitted = false;

    /**
     * Returneaza false cand cererea trebuie oprita (spam sau throttle).
     * Pe honeypot seteaza `submitted = true` (succes fals); pe throttle adauga eroare `throttle`.
     */
    protected function passesSpamGuard(string $key): bool
    {
        if ($this->website !== '') {
            $this->submitted = true; // bot a completat honeypot-ul — mimam succesul, nu salvam

            return false;
        }

        $limiterKey = $key.':'.request()->ip();

        if (RateLimiter::tooManyAttempts($limiterKey, 5)) {
            $this->addError('throttle', 'Ai trimis prea multe formulare. Te rugam sa astepti un minut si sa incerci din nou.');

            return false;
        }

        RateLimiter::hit($limiterKey, 60);

        return true;
    }
}
