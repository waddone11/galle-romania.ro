<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $current = 'ro';

    public function mount(): void
    {
        $this->current = app()->getLocale();
    }

    public function switch(string $locale)
    {
        if (! in_array($locale, ['ro', 'de', 'en'], true)) {
            return null;
        }

        // Redirige spre acelasi path, dar cu/fara prefix corespunzator.
        $path = request()->path(); // ex: 'de/servicii' sau '/' (devine '/')
        $segments = explode('/', trim($path, '/'));

        // Sterge un prefix de locale existent (daca primul segment e 'de' sau 'en').
        // explode garanteaza non-empty-list, deci nu mai e nevoie de isset.
        if (in_array($segments[0], ['de', 'en'], true)) {
            array_shift($segments);
        }

        $newPath = ($locale === 'ro' ? '' : "/$locale").'/'.implode('/', $segments);
        $newPath = rtrim($newPath, '/') ?: '/';

        return $this->redirect($newPath);
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
