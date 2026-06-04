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
use Illuminate\Support\Str;

class CertificareForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identitate')
                ->columns(2)
                ->schema([
                    TextInput::make('nume')->required(),
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                    Select::make('tip')->options(CertificareTip::class)->required(),
                    Select::make('status')->options(CertificareStatus::class)->default('in_proces')->required(),
                    TextInput::make('logo')
                        ->label('Logo (cale)')
                        ->placeholder('/images/certificari/fsc.svg')
                        ->columnSpanFull(),
                    TextInput::make('numar'),
                    DatePicker::make('data_emitere'),
                    TextInput::make('emitent'),
                    TextInput::make('detinator')
                        ->label('Detinator (ex. Galle GmbH)')
                        ->helperText('Completeaza daca certificarea e detinuta de grup, nu de firma locala.'),
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
