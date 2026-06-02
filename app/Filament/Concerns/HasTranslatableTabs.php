<?php

namespace App\Filament\Concerns;

use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

/**
 * Helper pentru a construi un Tabs RO/DE/EN cu acelasi set de campuri per locale.
 *
 * Folosire:
 *   HasTranslatableTabs::for(fn(string $loc, string $label) => [
 *       TextInput::make("titlu.$loc")->label("Titlu ($label)")->required($loc === 'ro'),
 *       Textarea::make("descriere.$loc")->label("Descriere ($label)")->rows(3),
 *   ])
 */
class HasTranslatableTabs
{
    /**
     * @param  callable(string $locale, string $label): array<int, mixed>  $fieldsBuilder
     */
    public static function for(callable $fieldsBuilder, string $name = 'translatable'): Tabs
    {
        return Tabs::make($name)->tabs([
            Tab::make('Romana')->schema($fieldsBuilder('ro', 'RO')),
            Tab::make('Deutsch')->schema($fieldsBuilder('de', 'DE')),
            Tab::make('English')->schema($fieldsBuilder('en', 'EN')),
        ])->columnSpanFull();
    }
}
