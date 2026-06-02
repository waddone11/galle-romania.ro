<?php

namespace App\Filament\Resources\Servicius\Schemas;

use App\Enums\ServiciuAudienta;
use App\Enums\ServiciuCategorie;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiciuForm
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
                Select::make('categorie')
                    ->options(ServiciuCategorie::class)
                    ->required(),
                Select::make('audienta')
                    ->options(ServiciuAudienta::class)
                    ->default('ambele')
                    ->required(),
                Textarea::make('descriere')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('continut')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('imagine')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('ordine')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
