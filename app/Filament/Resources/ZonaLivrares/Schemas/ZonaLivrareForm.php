<?php

namespace App\Filament\Resources\ZonaLivrares\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ZonaLivrareForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Configurare zona')
                ->columns(2)
                ->schema([
                    TextInput::make('judet')->required(),
                    TextInput::make('cost_livrare')->numeric()->prefix('lei')->required()->default(0),
                    Repeater::make('localitati')
                        ->label('Localitati deservite')
                        ->simple(TextInput::make('localitate')->placeholder('ex: Ploiesti'))
                        ->columnSpanFull()
                        ->reorderable(false)
                        ->defaultItems(0),
                    TextInput::make('ordine')->numeric()->default(0),
                    Toggle::make('is_active')->default(true),
                ]),

            Section::make('Nota (traductibila)')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        Textarea::make("nota.$loc")
                            ->label("Nota ($label)")
                            ->rows(2),
                    ]),
                ]),
        ]);
    }
}
