<?php

namespace App\Filament\Resources\Traduceres\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use App\Models\Traducere;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TraducereForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Cheie')
                ->description('Cheia este textul RO folosit in site. Nu o modifica dupa creare — doar valorile per limba.')
                ->columns(2)
                ->schema([
                    TextInput::make('cheie')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->disabled(fn (?Traducere $record): bool => $record !== null)
                        ->dehydrated(fn (?Traducere $record): bool => $record === null)
                        ->columnSpanFull(),
                    Select::make('grup')
                        ->options([
                            'nav' => 'Navigatie',
                            'footer' => 'Footer',
                            'forms' => 'Formulare',
                            'blocks' => 'Block-uri',
                            'cookies' => 'Cookies',
                            'general' => 'General',
                        ])
                        ->default('general')
                        ->required(),
                ]),

            Section::make('Valori (per limba)')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        Textarea::make("valoare.$loc")
                            ->label("Valoare ($label)")
                            ->rows(2)
                            ->required($loc === 'ro'),
                    ]),
                ]),
        ]);
    }
}
