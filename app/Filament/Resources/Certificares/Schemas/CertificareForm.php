<?php

namespace App\Filament\Resources\Certificares\Schemas;

use App\Enums\CertificareStatus;
use App\Enums\CertificareTip;
use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CertificareForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identitate')
                ->columns(2)
                ->schema([
                    TextInput::make('nume')->required()->columnSpanFull(),
                    Select::make('tip')->options(CertificareTip::class)->required(),
                    Select::make('status')->options(CertificareStatus::class)->default('in_proces')->required(),
                    TextInput::make('numar'),
                    DatePicker::make('data_emitere'),
                    TextInput::make('emitent'),
                    TextInput::make('ordine')->numeric()->default(0),
                    Toggle::make('is_active')->default(true),
                ]),

            Section::make('Descriere (traductibila)')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        Textarea::make("descriere.$loc")
                            ->label("Descriere ($label)")
                            ->rows(3),
                    ]),
                ]),
        ]);
    }
}
