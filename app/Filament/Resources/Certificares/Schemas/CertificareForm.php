<?php

namespace App\Filament\Resources\Certificares\Schemas;

use App\Enums\CertificareStatus;
use App\Enums\CertificareTip;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CertificareForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nume')
                    ->required(),
                Select::make('tip')
                    ->options(CertificareTip::class)
                    ->required(),
                Select::make('status')
                    ->options(CertificareStatus::class)
                    ->default('in_proces')
                    ->required(),
                TextInput::make('numar')
                    ->default(null),
                DatePicker::make('data_emitere'),
                TextInput::make('emitent')
                    ->default(null),
                Textarea::make('descriere')
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
