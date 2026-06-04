<?php

namespace App\Filament\Resources\Localitates\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LocalitateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Localitate')
                ->description('Landing local: /lemn-de-foc/{slug}. H1 si intro se construiesc din nume + intro.')
                ->columns(2)
                ->schema([
                    TextInput::make('nume')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                    TextInput::make('judet')->label('Judet')->required(),
                    TextInput::make('ordine')->numeric()->default(0),
                    Toggle::make('is_active')->default(true),
                ]),

            Section::make('Intro (traductibil)')
                ->description('O fraza-doua despre zona — apare sub H1 pe landing. Evita continutul subtire.')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        Textarea::make("intro.$loc")
                            ->label("Intro ($label)")
                            ->rows(3),
                    ]),
                ]),
        ]);
    }
}
