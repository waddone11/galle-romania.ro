<?php

namespace App\Filament\Resources\Faqs\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use App\Models\Faq;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Continut traductibil')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("intrebare.$loc")
                            ->label("Intrebare ($label)")
                            ->required($loc === 'ro'),
                        Textarea::make("raspuns.$loc")
                            ->label("Raspuns ($label)")
                            ->rows(4)
                            ->required($loc === 'ro'),
                    ]),
                ]),

            Section::make('Configurare')
                ->columns(3)
                ->schema([
                    Select::make('categorie')
                        ->options(Faq::CATEGORII),
                    TextInput::make('ordine')->numeric()->default(0),
                    Toggle::make('is_published')->default(true),
                ]),
        ]);
    }
}
