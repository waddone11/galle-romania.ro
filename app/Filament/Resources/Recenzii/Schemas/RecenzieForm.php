<?php

namespace App\Filament\Resources\Recenzii\Schemas;

use App\Models\Recenzie;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RecenzieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Recenzie')
                ->description('Doar recenzii reale de la clienti. Textul ramane in limba originala a clientului — NU se traduce.')
                ->columns(2)
                ->schema([
                    TextInput::make('nume_client')
                        ->label('Nume client')
                        ->required(),
                    TextInput::make('localitate')
                        ->label('Localitate'),
                    Textarea::make('text')
                        ->label('Text recenzie (limba originala)')
                        ->rows(4)
                        ->required()
                        ->columnSpanFull(),
                    Select::make('rating')
                        ->label('Rating (optional)')
                        ->options(array_combine(range(1, 5), array_map(strval(...), range(1, 5))))
                        ->nullable(),
                    Select::make('serviciu')
                        ->label('Serviciu (context)')
                        ->options(Recenzie::SERVICII)
                        ->nullable(),
                    DatePicker::make('data')
                        ->label('Data recenziei'),
                    TextInput::make('sursa')
                        ->label('Sursa')
                        ->placeholder('Google / WhatsApp / direct'),
                    FileUpload::make('imagine')
                        ->label('Avatar (optional — altfel initiale)')
                        ->image()
                        ->disk('public_images')
                        ->directory('recenzii')
                        ->columnSpanFull(),
                ]),

            Section::make('Publicare')
                ->columns(2)
                ->schema([
                    Toggle::make('is_published')
                        ->label('Publicata pe site')
                        ->helperText('Recenzia apare pe site doar dupa ce o publici explicit.')
                        ->default(false),
                    TextInput::make('ordine')
                        ->numeric()
                        ->default(0),
                ]),
        ]);
    }
}
