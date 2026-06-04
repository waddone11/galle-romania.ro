<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $current = 'ro';

    /**
     * Numele rutei curente FARA prefixul de locale (ex. 'servicii', 'proiect').
     * Capturat la incarcarea initiala a paginii — request()->path() nu e de
     * incredere in timpul unui update Livewire (e endpoint-ul de update).
     */
    public string $routeName = 'home';

    /** @var array<string, string> */
    public array $routeParams = [];

    public function mount(): void
    {
        $this->current = app()->getLocale();

        $route = request()->route();
        $name = $route?->getName() ?? 'home';
        $this->routeName = (string) preg_replace('/^(de|en)\./', '', $name);

        // Doar parametrii scalari (slug-uri) — suficient pentru rutele publice.
        $params = $route?->parameters() ?? [];
        $this->routeParams = array_filter($params, fn ($v) => is_string($v));
    }

    public function switch(string $locale)
    {
        if (! in_array($locale, ['ro', 'de', 'en'], true)) {
            return null;
        }

        // Toate rutele publice au variante echivalente 'de.*' / 'en.*'.
        $name = ($locale === 'ro' ? '' : "$locale.").$this->routeName;

        if (! Route::has($name)) {
            $name = $locale === 'ro' ? 'home' : "$locale.home";
        }

        return $this->redirect(route($name, $this->routeParams));
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
