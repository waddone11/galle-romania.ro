<?php

namespace App\Filament\Resources\Servicius\Schemas;

use App\Enums\ServiciuAudienta;
use App\Enums\ServiciuCategorie;
use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiciuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Continut traductibil')
                ->description('Titlu, descriere si continut — disponibile in 3 locale.')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")
                            ->label("Titlu ($label)")
                            ->required($loc === 'ro')
                            ->live(onBlur: $loc === 'ro')
                            ->afterStateUpdated(fn ($state, callable $set) => $loc === 'ro' && $set('slug', Str::slug((string) $state))),
                        Textarea::make("descriere.$loc")
                            ->label("Descriere scurta ($label)")
                            ->rows(2),
                        Textarea::make("continut.$loc")
                            ->label("Continut detaliat ($label)")
                            ->rows(5),
                    ]),
                ]),

            Section::make('Configurare')
                ->columns(3)
                ->schema([
                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->columnSpan(3),
                    Select::make('categorie')->options(ServiciuCategorie::class)->required(),
                    Select::make('audienta')->options(ServiciuAudienta::class)->default('ambele')->required(),
                    TextInput::make('imagine')->label('URL imagine'),
                    Toggle::make('is_active')->default(true),
                    TextInput::make('ordine')->numeric()->default(0),
                ]),
        ]);
    }
}
