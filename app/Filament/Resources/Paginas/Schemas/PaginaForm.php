<?php

namespace App\Filament\Resources\Paginas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PaginaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required(),
                Textarea::make('titlu')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('meta_title')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('og_image')
                    ->image(),
                Textarea::make('sectiuni')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('ordine')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
