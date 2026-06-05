<?php

namespace App\Filament\Resources\Membri\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MembruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Membru')
                ->description('Numele nu se traduce; rolul are taburi RO/DE/EN. Fara poza, pe site apare un avatar cu initiale.')
                ->columns(2)
                ->schema([
                    TextInput::make('nume')
                        ->label('Nume')
                        ->required(),
                    FileUpload::make('imagine')
                        ->label('Poza (optional — altfel initiale)')
                        ->image()
                        ->avatar()
                        ->disk('public_images')
                        ->directory('membri'),
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("rol.$loc")
                            ->label("Rol ($label)")
                            ->required($loc === 'ro'),
                    ]),
                ]),

            Section::make('Afisare')
                ->columns(2)
                ->schema([
                    Toggle::make('is_active')
                        ->label('Activ pe site')
                        ->default(true),
                    TextInput::make('ordine')
                        ->numeric()
                        ->default(0),
                ]),
        ]);
    }
}
