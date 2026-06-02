<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('intrebare')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('raspuns')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('categorie')
                    ->default(null),
                TextInput::make('ordine')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
