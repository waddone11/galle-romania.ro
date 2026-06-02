<?php

namespace App\Filament\Resources\ZonaLivrares\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ZonaLivrareForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judet')
                    ->required(),
                Textarea::make('localitati')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('cost_livrare')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('nota')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('ordine')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
