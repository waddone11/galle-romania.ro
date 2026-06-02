<?php

namespace App\Filament\Resources\Proiects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProiectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('titlu')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('descriere')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('continut')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('locatie')
                    ->default(null),
                TextInput::make('an')
                    ->numeric()
                    ->default(null),
                TextInput::make('categorie')
                    ->default(null),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('ordine')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
