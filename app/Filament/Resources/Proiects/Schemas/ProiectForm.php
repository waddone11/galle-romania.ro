<?php

namespace App\Filament\Resources\Proiects\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProiectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Continut traductibil')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")
                            ->label("Titlu ($label)")
                            ->required($loc === 'ro')
                            ->live(onBlur: $loc === 'ro')
                            ->afterStateUpdated(fn ($state, callable $set) => $loc === 'ro' && $set('slug', Str::slug((string) $state))),
                        Textarea::make("descriere.$loc")
                            ->label("Descriere ($label)")
                            ->rows(2),
                        Textarea::make("continut.$loc")
                            ->label("Continut ($label)")
                            ->rows(5),
                    ]),
                ]),

            Section::make('Metadata')
                ->columns(3)
                ->schema([
                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->columnSpan(3),
                    TextInput::make('locatie'),
                    TextInput::make('an')->numeric()->minValue(2000)->maxValue(2100),
                    TextInput::make('categorie'),
                    Toggle::make('is_published')->default(true),
                    TextInput::make('ordine')->numeric()->default(0),
                ]),
        ]);
    }
}
