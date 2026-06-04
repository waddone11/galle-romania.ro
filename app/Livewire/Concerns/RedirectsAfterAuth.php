<?php

namespace App\Livewire\Concerns;

use App\Models\User;

trait RedirectsAfterAuth
{
    /**
     * Redirect pe rol: admin → panoul Filament, client → home in locale-ul curent.
     */
    protected function redirectForUser(User $user): void
    {
        if ($user->role === 'admin') {
            $this->redirect(url('/admin'));

            return;
        }

        $this->redirect($this->homeUrl());
    }

    protected function homeUrl(): string
    {
        $locale = app()->getLocale();

        return $locale === 'ro' ? route('home') : route($locale.'.home');
    }
}
