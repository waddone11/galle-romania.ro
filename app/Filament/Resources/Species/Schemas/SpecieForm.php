<?php

namespace App\Filament\Resources\Species\Schemas;

use App\Enums\SpecieStatus;
use App\Enums\SpecieUnitate;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SpecieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identitate')
                ->description('Slug-ul este folosit in URL. Numele si descrierea sunt traductibile.')
                ->schema([
                    Tabs::make('translatable')
                        ->tabs([
                            Tab::make('Romana')->schema([
                                TextInput::make('nume.ro')
                                    ->label('Nume (RO)')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state ?? ''))),
                                Textarea::make('descriere.ro')->label('Descriere (RO)')->rows(3),
                            ]),
                            Tab::make('Deutsch')->schema([
                                TextInput::make('nume.de')->label('Name (DE)'),
                                Textarea::make('descriere.de')->label('Beschreibung (DE)')->rows(3),
                            ]),
                            Tab::make('English')->schema([
                                TextInput::make('nume.en')->label('Name (EN)'),
                                Textarea::make('descriere.en')->label('Description (EN)')->rows(3),
                            ]),
                        ])
                        ->columnSpanFull(),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                ]),

            Section::make('Comercial')
                ->columns(3)
                ->schema([
                    Select::make('status')
                        ->options(SpecieStatus::class)
                        ->default('in_curand')
                        ->required(),
                    Select::make('unitate')
                        ->options(SpecieUnitate::class)
                        ->default('ster')
                        ->required(),
                    Toggle::make('is_active')->default(true),

                    TextInput::make('pret_pornire')->numeric()->prefix('lei')->step(0.01),
                    TextInput::make('pret_per_unitate')->numeric()->prefix('lei')->step(0.01),
                    TextInput::make('putere_calorica')->numeric()->suffix('kWh/kg')->step(0.01),

                    TextInput::make('imagine')->label('URL imagine')->columnSpan(2),
                    TextInput::make('ordine')->numeric()->default(0),
                ]),
        ]);
    }
}
