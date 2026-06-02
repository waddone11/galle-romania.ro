<?php

namespace App\Filament\Resources\ComandaLemns\Schemas;

use App\Enums\ComandaStatus;
use App\Enums\SpecieUnitate;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ComandaLemnForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Date contact (read-only)')
                ->columns(2)
                ->schema([
                    TextInput::make('nume')->disabled(),
                    TextInput::make('telefon')->disabled(),
                    TextInput::make('email')->disabled(),
                    TextInput::make('localitate')->disabled(),
                ]),

            Section::make('Comanda (read-only)')
                ->columns(3)
                ->schema([
                    Select::make('specie_id')
                        ->relationship('specie', 'slug')
                        ->disabled(),
                    TextInput::make('cantitate')->numeric()->disabled(),
                    Select::make('unitate')->options(SpecieUnitate::class)->disabled(),
                    TextInput::make('data_dorita')->disabled(),
                    TextInput::make('source')->disabled(),
                    Textarea::make('mesaj')->disabled()->columnSpanFull()->rows(3),
                ]),

            Section::make('Status operational')
                ->schema([
                    Select::make('status')
                        ->options(ComandaStatus::class)
                        ->required()
                        ->label('Status'),
                ]),
        ]);
    }
}
