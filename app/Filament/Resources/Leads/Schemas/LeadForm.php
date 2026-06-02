<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Enums\ComandaStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Date contact (read-only)')
                ->columns(2)
                ->schema([
                    TextInput::make('nume')->disabled(),
                    TextInput::make('firma')->disabled(),
                    TextInput::make('email')->disabled(),
                    TextInput::make('telefon')->disabled(),
                    TextInput::make('serviciu')->disabled(),
                    TextInput::make('source')->disabled(),
                ]),

            Section::make('Mesaj')
                ->schema([
                    Textarea::make('mesaj')->disabled()->rows(4)->columnSpanFull(),
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
