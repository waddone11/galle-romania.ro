<?php

namespace App\Filament\Resources\Articols\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticolForm
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
                Textarea::make('excerpt')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('continut')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('imagine')
                    ->default(null),
                TextInput::make('categorie')
                    ->default(null),
                DateTimePicker::make('published_at'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
